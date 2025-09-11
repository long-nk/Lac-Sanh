<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Introduces;
use App\Models\Questions;
use App\Models\RelatedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class IntroducesController extends Controller
{
    public function index()
    {
        $contents = Introduces::whereNull('parent_id')->orderBy('sort')->orderBy('created_at', 'desc')->get();
        return view('backend.introduces.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent_id = $request->id ?? null;
        return view('backend.introduces.create', compact('parent_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->get('title'),
            'slug' => $request->slug ?  Str::slug($request->slug, '-') : Str::slug($request->title, '-'),
            'content' => $request->get('content'),
            'parent_id' => $request->get('parent_id'),
            'status' => $request->get('status'),
            'sort' => (int) ($request->get('sort') ?? 1),
        ];

        $request->validate([
            'title' => [
                'required'
            ],
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
        ]);

        try {
            DB::beginTransaction();
            $path = "images/uploads/introduces";
            $image = $request->image;
            $file_path = "";
            if ($request->image) {
                $extension = $image->extension();
                $file_name = "introduce_" . time() . '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $data['image'] = $file_path;
            }
            Introduces::create($data);
            DB::commit();
            return redirect()->route('introduces.index')->with('message-success', 'Tạo mới thành công!');
        } catch (\Exception $e) {
            dd($e);
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->route('introduces.index')->with('message-error', $e->getMessage());
        }

    }

    public function storeNews(Request $request)
    {
        $type = $request->type;
        $data = [
            'title' => $request->title,
            'title_seo' => $request->title_seo,
            'slug' => $request->slug ?  Str::slug($request->slug, '-') : Str::slug($request->title_seo, '-'),
            'summary' => $request->summary,
            'content' => $request->content,
            'alt' => $request->alt,
            'meta' => $request->meta,
            'parent_id' => $request->parent_id,
            'sort' => (int) ($request->get('sort') ?? 1),
            'star' => $request->star,
            'point' => $request->point,
            'view' => $request->view,
            'type' => $request->type ?? Introduces::NEWS,
            'check' => $request->get('check'),
            'user_id' => auth()->user()->id,
            'status' => $request->status,
            'script' => $request->script
        ];

        $request->validate([
            'title' => [
                'required',
                Rule::unique('contents', 'title')->whereNull('deleted_at'),
            ],
            'title_seo' => [
                'required',
                Rule::unique('contents', 'title_seo')->whereNull('deleted_at'),
            ],
            'slug' => [
                'required',
                Rule::unique('contents', 'slug')->whereNull('deleted_at'),
            ],
//            'faqs' => 'array',
//            'faqs.*.question' => 'required|string|max:255',
//            'faqs.*.answer' => 'nullable|string|max:1000',
        ], [
            'title.required' => 'Tên bài viết không được để trống.',
            'title.unique' => 'Tên bài viết đã tồn tại.',
            'title_seo.required' => 'Tiêu đề SEO không được để trống.',
            'title_seo.unique' => 'Tiêu đề SEO này đã tồn tại.',
            'slug.required' => 'Đường dẫn (slug) không được để trống.',
            'slug.unique' => 'Đường dẫn (slug) này đã tồn tại.',
//            'faqs.*.question.required' => 'Câu hỏi không được để trống.',
//            'faqs.*.answer.required' => 'Câu trả lời không được để trống.',
        ]);

        try {
            DB::beginTransaction();
            $path = "images/uploads/news";
            $image = $request->image;
            $file_path = "";
            if ($request->image) {
                $extension = $image->extension();
                $file_name = "news_" . time() . '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $data['image'] = $file_path;
            }

            $content = Introduces::create($data);


            if($request->products) {
                foreach ($request->products as $productId) {
                    DB::table('related_items')->insert([
                        'item_id' => $content->id,
                        'item_type' => Introduces::class,
                        'related_id' => $productId,
                        'related_type' => Product::class
                    ]);
                }
            }

            if($request->news) {
                foreach ($request->news as $newsId) {
                    DB::table('related_items')->insert([
                        'item_id' => $content->id,
                        'item_type' => Introduces::class,
                        'related_id' => $newsId,
                        'related_type' => Introduces::class
                    ]);
                }
            }

            $faqs = $request->input('faqs', []);
            foreach ($faqs as $faq) {
                if (!empty($faq['question']) || !empty($faq['answer'])) {
                    $question = Questions::create([
                        'name' => $faq['question'],
                        'slug' => Str::slug($faq['question']),
                        'intro' => $faq['answer'],
                    ]);

                    DB::table('question_contents')->insert([
                        'question_id' => $question->id,
                        'content_id' => $content->id,
                        'type' => Introduces::TIN_TUC
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('introduces.index')->with('message-success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->withInput()->with('message-error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Introduces::find($id);

        return view('backend.introduces.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'title' => $request->get('title'),
//            'slug' => $request->slug ?  Str::slug($request->slug, '-') : Str::slug($request->title, '-'),
            'status' => $request->get('status'),
            'content' => $request->get('content'),
            'sort' => (int) ($request->get('sort') ?? 1),
        ];

        try {

            $content = Introduces::find($id);

            $rules = [
                'title' => ['required'],
//                'slug' => ['required'],
            ];

            if ($request->title !== $content->title) {
                $rules['title'][] = Rule::unique('contents', 'title')
                    ->ignore($id) // nên dùng $id thay vì $request->id
                    ->whereNull('deleted_at');
            }

//            if ($request->slug !== $content->slug) {
//                $rules['slug'][] = Rule::unique('contents', 'slug')
//                    ->ignore($id)
//                    ->whereNull('deleted_at');
//            }

            $request->validate($rules, [
                'title.required' => 'Tiêu đề không được để trống.',
//                'title.unique' => 'Tiêu đề này đã tồn tại.',
//                'slug.required' => 'Slug không được để trống.',
//                'slug.unique' => 'Slug này đã tồn tại.',
            ]);

            $path = "images/uploads/introduces";
            $image = $request->image;
            if ($image) {
                if (File::exists($content->image)) {
                    File::delete($content->image);
                }
                $file_name = "introduce_" . time();
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $data['image'] = $file_path;
            }

            $content->update($data);

            return redirect()->route('introduces.index')->with('message-success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('message-error', $e->getMessage());
        }

    }

    public function updateNews(Request $request)
    {
        $data = [
            'title' => $request->title,
            'title_seo' => $request->title_seo,
            'slug' => $request->slug ?  Str::slug($request->slug, '-') : Str::slug($request->title_seo, '-'),
            'summary' => $request->summary,
            'content' => $request->content,
            'alt' => $request->alt,
            'meta' => $request->meta,
            'sort' => (int) ($request->get('sort') ?? 1),
            'star' => $request->star,
            'point' => $request->point,
            'view' => $request->view ?? rand(50, 1000),
            'check' => $request->check,
            'user_id' => Auth::user()->id,
                'user_update_id' => Auth::user()->id,
            'status' => $request->status,
            'script' => $request->script
        ];
        $request->validate([
            'title' => [
                'required',
                Rule::unique('contents', 'title')
                    ->ignore($request->id)
                    ->whereNull('deleted_at')
            ],
            'title_seo' => [
                'required',
                Rule::unique('contents', 'title_seo')
                    ->ignore($request->id)
                    ->whereNull('deleted_at')
            ],
            'slug' => [
                'required',
                Rule::unique('contents', 'slug')
                    ->ignore($request->id)
                    ->whereNull('deleted_at')
            ],
            'faqs' => 'array',
            'faqs.*.question' => 'required|string|max:255',
            'faqs.*.answer' => 'nullable|string|max:1000',
        ], [
            'title.required' => 'Tên bài viết không được để trống.',
            'title.unique' => 'Tên bài viết đã tồn tại.',
            'title_seo.required' => 'Tiêu đề SEO không được để trống.',
            'title_seo.unique' => 'Tiêu đề SEO này đã tồn tại.',
            'slug.required' => 'Slug không được để trống.',
            'slug.unique' => 'Slug này đã tồn tại.',
            'faqs.*.question.required' => 'Câu hỏi không được để trống.',
            'faqs.*.answer.required' => 'Câu trả lời không được để trống.',
        ]);

        try {
            DB::beginTransaction();
            $news = Introduces::find($request->id);

            $path = "images/uploads/news";
            $image = $request->image;
            if ($image) {
                if (File::exists($news->image)) {
                    File::delete($news->image);
                }
                $file_name = "news" . time();
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $news->image = $file_path;
            }

            $news->title = $data['title'];
            $news->title_seo = $data['title_seo'];
            $news->slug = $data['slug'];
            $news->summary = $data['summary'];
            $news->content = $data['content'];
            $news->alt = $data['alt'];
            $news->meta = $data['meta'];
            $news->check = $data['check'];
            $news->star = $data['star'];
            $news->point = $data['point'];
            $news->view = $data['view'];
            $news->sort = $data['sort'];
            $news->status = $data['status'];
            $news->user_update_id = $data['user_update_id'];
            $news->script = $data['script'];
            $news->save();

            if ($request->has('products')) {
                DB::table('related_items')->where('item_id', $news->id)->where('item_type', Introduces::class)->where('related_type', Product::class)->delete();
                foreach ($request->products as $productId) {
                    DB::table('related_items')->insert([
                        'item_id' => $news->id,
                        'item_type' => Introduces::class,
                        'related_id' => $productId,
                        'related_type' => Product::class
                    ]);
                }
            }

            if ($request->has('news')) {
                DB::table('related_items')->where('item_id', $news->id)->where('item_type', Introduces::class)->where('related_type', Introduces::class)->delete();
                foreach ($request->news as $relatedId) {
                    DB::table('related_items')->insert([
                        'item_id' => $news->id,
                        'item_type' => Introduces::class,
                        'related_id' => $relatedId,
                        'related_type' => Introduces::class
                    ]);
                }
            }


            if ($request->has('faqs')) {
                $existingFaqIds = $news->questions ? $news->questions->pluck('id')->toArray() : []; // Get the current FAQ IDs

                foreach ($request->faqs as $index => $faq) {
                    $faqData = [
                        'name' => $faq['question'],
                        'intro' => $faq['answer'] ?? null,
                        'content_id' => $news->id,
                        'type' => Introduces::TIN_TUC
                    ];

                    // If there is an existing FAQ to update
                    if (isset($faq['id']) && in_array($faq['id'], $existingFaqIds)) {
                        $existingFaq = Questions::find($faq['id']);
                        $existingFaq->update($faqData);
                        // Remove the ID from existing FAQs so we know which ones need to be deleted
                        $existingFaqIds = array_diff($existingFaqIds, [$faq['id']]);
                    } else {
                        // If it's a new FAQ, create it
                        $createdFaq = Questions::create($faqData);
                        // Attach the new question to the content in question_contents table
                        $news->questions()->attach($createdFaq->id, ['type' => Introduces::TIN_TUC]);
                    }
                }

                // Delete FAQs that were removed
                foreach ($existingFaqIds as $faqId) {
                    // Detach the question from the content first
                    $news->questions()->detach($faqId);

                    // Then delete the question itself
                    Questions::find($faqId)?->delete();
                }
            }

            DB::commit();
            return redirect()->route('introduces.index')->with('message-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->withInput()->with('message-error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $content = Introduces::find($id);

            if (empty($content)) {
                return redirect()->back()->with('message-error', 'Không tìm thấy bài viết!');
            }
            if ($content->questions) {
                // Lặp qua các câu hỏi và xóa các bản ghi trong bảng question_contents
                foreach ($content->questions as $question) {
                    // Xóa mối liên kết trong bảng question_contents
                    DB::table('question_contents')->where('question_id', $question->id)->delete();

                    // Xóa câu hỏi
                    $question->delete();
                }
            }
            if ($content->child()) {
                $content->child()->delete();
            }
            DB::table('related_items')
                ->where('item_type', Introduces::class)
                ->where('item_id', $content->id)
                ->delete();

            DB::table('related_items')
                ->where('related_type', Introduces::class)
                ->where('related_id', $content->id)
                ->delete();
            $content->delete();
            return redirect()->back()->with('message-success', 'Xóa bài viết thành công!');
        } catch (\Exception $exeption) {
            Log::error($exeption->getMessage());
            return redirect()->back()->with('message-error', $exeption->getMessage());
        }

    }

    public function listAll(Request $request)
    {
        try {
            $news = Introduces::find($request->id);
            $listContent = Introduces::where('parent_id', $news->id)->get();
            return view('backend.introduces.list', compact('news', 'listContent'));
        } catch (\Exception $e) {
            Log::error('Lỗi lấy danh sách tin tức: ' . $e->getMessage());
            return redirect()->back()->with('message-error' . $e->getMessage());
        }
    }

    public function searchRelated(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string',
            'type' => 'required|in:0,1',
            'product_id' => 'required|exists:products,id',
        ]);

        $type = $request->type;
        $productId = $request->product_id;
        $keyword = $request->keyword;

        if ($type == RelatedItem::TYPE_PRODUCT) {
            $content = \App\Models\Product::where('name', 'LIKE', "%{$keyword}%")
                ->where('id', '!=', $productId)
                ->first();
        } elseif($type == RelatedItem::TYPE_NEWS) {
            $content = \App\Models\Introduces::where('title', 'LIKE', "%{$keyword}%")->first();
        } elseif($type == RelatedItem::TYPE_SERVICE) {
            $content = \App\Models\Services::where('title', 'LIKE', "%{$keyword}%")->first();
        }

        if (!$content) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy nội dung phù hợp']);
        }

        $exists = \DB::table('product_contents')->where([
            ['product_id', $productId],
            ['content_id', $content->id],
            ['type', $type]
        ])->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Đã tồn tại trong danh sách']);
        }

        \DB::table('product_contents')->insert([
            'product_id' => $productId,
            'content_id' => $content->id,
            'type' => $type
        ]);

        return response()->json([
            'success' => true,
            'name' => $type == RelatedItem::TYPE_PRODUCT ? $content->name : $content->title
        ]);
    }
}
