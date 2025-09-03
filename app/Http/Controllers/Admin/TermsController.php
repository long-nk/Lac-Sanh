<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Questions;
use App\Models\Contents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TermsController extends Controller
{
    public function index()
    {
        $contents = Contents::where('type', Contents::TERM)->orderBy('sort')->orderBy('created_at', 'desc')->get();
        return view('backend.terms.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
//        $parents = Contents::whereNull('parent_id')->orderBy('sort')->orderBy('created_at', 'desc')->get();
        return view('backend.terms.create');
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
//            'content' => $request->get('content'),
            'status' => $request->get('status'),
            'sort' => (int) ($request->get('sort') ?? 1),
        ];

        $request->validate([
            'title' => [
                'required',
                Rule::unique('services', 'title')->where('type', Contents::TERM)->whereNull('deleted_at'),
            ],
            'slug' => [
                'required',
                Rule::unique('services', 'slug')->where('type', Contents::TERM)->whereNull('deleted_at'),
            ],
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.unique' => 'Tiêu đề này đã tồn tại.',
            'slug.required' => 'Đường dẫn (slug) không được để trống.',
            'slug.unique' => 'Đường dẫn (slug) này đã tồn tại.',
        ]);

            try {
                DB::beginTransaction();
                $path = "images/uploads/terms";
                $image = $request->image;
                $file_path = "";
                if ($request->image) {
                    $extension = $image->extension();
                    $file_name = "term_" . time() .  '.' . $extension;
                    $file_path = $path . '/' . $file_name;
                    $image->move($path . '/', $file_name);
                }
                $data['image'] = $file_path;
                Contents::create($data);
                DB::commit();
                return redirect()->route('terms.index')->with('message-success', 'Tạo mới thành công!');
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                DB::rollback();
                return redirect()->route('terms.index')->with('message-error', 'Xảy ra lỗi khi tạo mới, vui lòng thử lại!');
            }
    }

    public function storeTerm(Request $request)
    {
        $data = [
            'title' => $request->title,
            'title_seo' => $request->title_seo,
            'slug' => $request->slug ?  Str::slug($request->slug, '-') : Str::slug($request->title_seo, '-'),
            'summary' => $request->summary,
            'content' => $request->content,
            'alt' => $request->alt,
            'meta' => $request->meta,
//            'parent_id' => $request->parent_id,
            'type' => $request->type ?? Contents::TERM,
            'sort' => (int) ($request->get('sort') ?? 1),
            'star' => $request->star,
            'point' => $request->point,
            'view' => $request->view ?? rand(50, 500),
            'user_id' => auth()->user()->id,
            'status' => $request->status,
            'script' => $request->script
        ];

        $request->validate([
            'title' => [
                'required',
                Rule::unique('contents', 'title')->where('type', Contents::TERM)->whereNull('deleted_at'),
            ],
            'title_seo' => [
                'required',
                Rule::unique('contents', 'title_seo')->where('type', Contents::TERM)->whereNull('deleted_at'),
            ],
            'slug' => [
                'required',
                Rule::unique('contents', 'slug')->where('type', Contents::TERM)->whereNull('deleted_at'),
            ],
        ], [
            'title.required' => 'Tên bài viết không được để trống.',
            'title.unique' => 'Tên bài viết đã tồn tại.',
            'title_seo.required' => 'Tiêu đề seo không được để trống.',
            'title_seo.unique' => 'Tiêu đề seo này đã tồn tại.',
            'slug.required' => 'Đường dẫn (slug) không được để trống.',
            'slug.unique' => 'Đường dẫn (slug) này đã tồn tại.',
        ]);

        try {
            DB::beginTransaction();
            $path = "images/uploads/terms";
            $image = $request->image;
            $file_path = "";
            if ($request->image) {
                $extension = $image->extension();
                $file_name = "term_" . time() . '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $data['image'] = $file_path;
            }

            $content = Contents::create($data);
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
                        'type' => Questions::TYPE_NEWS
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('terms.index')->with('message-success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('message-error', 'Lỗi khi thêm mới, vui lòng thử lại sau');
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
        $content = Contents::find($id);
//        $parents = Contents::whereNull('parent_id')->orderBy('sort')->orderBy('created_at', 'desc')->get();
        return view('backend.terms.edit', compact('content'));
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
            'slug' => $request->slug ?  Str::slug($request->slug, '-') : Str::slug($request->title, '-'),
            'summary' => $request->summary,
            'content' => $request->get('content'),
            'status' => $request->get('status'),
            'sort' => (int) ($request->get('sort') ?? 1),
        ];

        $request->validate([
            'title' => [
                'required',
                Rule::unique('services', 'title')
                    ->ignore($request->id)
                    ->where('type', Contents::TERM)
                    ->whereNull('deleted_at')
            ],
            'slug' => [
                'required',
                Rule::unique('services', 'slug')
                    ->ignore($request->id)
                    ->where('type', Contents::TERM)
                    ->whereNull('deleted_at')
            ]
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.unique' => 'Tiêu đề này đã tồn tại.',
            'slug.required' => 'Slug không được để trống.',
            'slug.unique' => 'Slug này đã tồn tại.',
        ]);
            try {
                DB::beginTransaction();

                $content = Contents::find($id);

                $path = "images/uploads/terms";
                $image = $request->image;
                if ($image) {
                    if(File::exists($content->image)) {
                        File::delete($content->image);
                    }
                    $extension = $image->extension();
                    $file_name = "term_" . time() . '.' . $extension;
                    $file_path = $path . '/' . $file_name;
                    $image->move($path . '/', $file_name);
                    $content->image = $file_path;
                }

                $content->title = $data['title'];
                $content->slug = $data['slug'];
                $content->summary = $data['summary'];
                $content->content = $data['content'];
                $content->status = $data['status'];
                $news->user_update_id = Auth::user()->id;
                $content->sort = $data['sort'];
                $content->save();

                DB::commit();
                return redirect()->route('terms.index')->with('message-success', 'Cập nhật thành công');
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                DB::rollback();
                return redirect()->route('terms.index')->with('message-error', 'Xảy ra lỗi khi cập nhật, vui lòng thử lại!');
            }
    }

    public function updateTerm(Request $request)
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
            'view' => $request->view ?? rand(50, 500),
            'status' => $request->status,
            'script' => $request->script
        ];
        $request->validate([
            'title' => [
                'required',
                Rule::unique('contents', 'title')
                    ->ignore($request->id)
                    ->where('type', Contents::TERM)
                    ->whereNull('deleted_at')
            ],
            'title_seo' => [
                'required',
                Rule::unique('contents', 'title_seo')
                    ->ignore($request->id)
                    ->where('type', Contents::TERM)
                    ->whereNull('deleted_at')
            ],
            'slug' => [
                'required',
                Rule::unique('contents', 'slug')
                    ->ignore($request->id)
                    ->where('type', Contents::TERM)
                    ->whereNull('deleted_at')
            ]
        ], [
            'title.required' => 'Tên bài viết không được để trống.',
            'title.unique' => 'Tên bài viết đã tồn tại.',
            'title_seo.required' => 'Tiêu đề seo không được để trống.',
            'title_seo.unique' => 'Tiêu đề seo này đã tồn tại.',
            'slug.required' => 'Slug không được để trống.',
            'slug.unique' => 'Slug này đã tồn tại.',
        ]);

        try {
            DB::beginTransaction();
            $news = Contents::find($request->id);

            $path = "images/uploads/terms";
            $image = $request->image;
            if ($image) {
                if (File::exists($news->image)) {
                    File::delete($news->image);
                }
                $file_name = "term_" . time();
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
            $news->sort = $data['sort'];
            $news->star = $data['star'];
            $news->point = $data['point'];
            $news->view = $data['view'];
            $news->status = $data['status'];
            $news->user_update_id = Auth::user()->id;
            $news->script = $data['script'];
            $news->save();

            if ($request->has('faqs')) {
                $existingFaqIds = $news->question_terms ? $news->question_terms->pluck('id')->toArray() : []; // Get the current FAQ IDs

                foreach ($request->faqs as $index => $faq) {
                    $faqData = [
                        'name' => $faq['question'],
                        'intro' => $faq['answer'] ?? null,
                        'content_id' => $news->id,
                        'type' => Questions::TYPE_NEWS
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
                        $news->questions()->attach($createdFaq->id, ['type' => Questions::TYPE_NEWS]);
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
            return redirect()->back()->with('message-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('message-error', $e->getMessage());
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
            $content = Contents::find($id);

            if (empty($content)) {
                return redirect()->back()->with('message-error', 'Không tìm thấy bài viết!');
            }
            if ($content->question_terms) {
                // Lặp qua các câu hỏi và xóa các bản ghi trong bảng question_contents
                foreach ($content->question_terms as $question) {
                    // Xóa mối liên kết trong bảng question_contents
                    DB::table('question_contents')->where('question_id', $question->id)->delete();

                    // Xóa câu hỏi
                    $question->delete();
                }
            }
            if ($content->child()) {
                $content->child()->delete();
            }
            $image = public_path('' . $content->image);
            if (File::exists($image)) {
                File::delete($image);
            }
            $content->delete();
            return redirect()->back()->withInput()->with('message-success', 'Xóa bài viết thành công!');
        } catch (\Exception $exeption) {
            Log::error($exeption->getMessage());
            return redirect()->back()->with('message-error', $exeption->getMessage());
        }

    }
}
