<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contents;
use App\Models\FileItem;
use App\Models\Introduces;
use App\Models\Prices;
use App\Models\QuestionContents;
use App\Models\Questions;
use App\Models\Services;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions_admin = Questions::orderBy('sort')->orderBy('created_at', 'desc')->get();
        return view('backend.questions.index', compact('questions_admin'));
    }

    public function sitemap()
    {
        $questions = Questions::get();

        return view('backend.questions.sitemap', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $question = $request->id;
        $content_id = $request->content_id;
        $type = $request->type;
        $contents = [];
        $listContent = [];
        if ($type == Category::TYPE_ABOUT) {
            $contents = Introduces::orderBy('sort')->get();
            $listContent = Introduces::orderBy('sort')->pluck('id')->toArray();
        } elseif ($type == Category::TYPE_NEWS) {
            $contents = Contents::where('status', 1)->orderBy('sort')->orderBy('parent_id')->orderBy('created_at', 'desc')->get();
            $listContent = Contents::where('status', 1)->orderBy('sort')->pluck('id')->toArray();
        } elseif ($type == Category::TYPE_SERVICE) {
            $contents = Services::where('type', Services::SERVICE)->where('status', 1)->orderBy('sort')->orderBy('parent_id')->orderBy('created_at', 'desc')->get();
            $listContent = Services::where('status', 1)->orderBy('sort')->pluck('id')->toArray();
        } elseif ($type == Category::TYPE_PRICE) {
            $contents = Prices::where('status', 1)->orderBy('sort')->orderBy('parent_id')->orderBy('created_at', 'desc')->get();
            $listContent = Prices::where('status', 1)->orderBy('sort')->pluck('id')->toArray();
        } elseif ($type == Questions::TYPE_TERM) {
            $contents = Services::where('type', Services::TERM)->where('status', 1)->orderBy('sort')->orderBy('parent_id')->orderBy('created_at', 'desc')->get();
            $listContent = Services::where('status', 1)->orderBy('sort')->pluck('id')->toArray();
        }

        return view('backend.questions.create', compact('question', 'content_id', 'type', 'contents', 'listContent'));
    }

    public function storeQuestions(Request $request)
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('questions', 'name'),
                ],
                'intro' => [
                    'required'
                ],
            ], [
                'name.required' => 'Câu hỏi không được để trống.',
                'name.unique' => 'Câu hỏi này đã tồn tại.',
                'intro.required' => 'Câu trả lời không được để trống.',
            ]);

            $data = [
                'name' => $request->name,
                'slug' => $request->slug,
                'intro' => $request->intro,
                'status' => $request->status,
                'sort' => $request->sort
            ];
            $list_content = [];
            $list_content = $request->input('list_content');
            $question = Questions::create($data);
            if (!empty($list_content)) {
                foreach ($list_content as $item => $value) {
                    $list = [
                        'question_id' => $question->id,
                        'content_id' => $value,
                        'type' => $request->type,
                    ];
                    QuestionContents::create($list);
                }
            }
            $content_id = $request->id ?? $value;
            $type = $request->type;
            if ($type == Category::TYPE_ABOUT) {
                $content = Introduces::find($content_id);
            } elseif ($type == Category::TYPE_NEWS) {
                $content = Contents::find($content_id);
            } elseif ($type == Category::TYPE_SERVICE) {
                $content = Services::find($content_id);
            } elseif ($type == Category::TYPE_PRICE) {
                $content = Prices::find($content_id);
            } elseif ($type == Questions::TYPE_TERM) {
                $content = Services::find($content_id);
            }
            $title = $content->title ?? '';
            return redirect()->route('questions.list', ['type' => $request->type, 'id' => $content_id, 'title' => $title])->with('message-success', 'Thêm mới thành công');;
        } catch (\Exception $e) {
            Log::error('Lỗi khi gán FAQs cho bài viết: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('message-error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $name = $request->name;

            $data = [
                'name' => $name,
                'parent_id' => $request->parent_id ?? null,
                'intro' => $request->intro,
                'slug' => Str::slug($name, '-'),
                'status' => $request->status,
                'sort' => $request->sort
            ];

            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('questions', 'name'),
                ],
                'intro' => [
                    'required'
                ],
            ], [
                'name.required' => 'Câu hỏi không được để trống.',
                'name.unique' => 'Câu hỏi này đã tồn tại.',
                'intro.required' => 'Câu trả lời không được để trống.',
            ]);

            Questions::create($data);

            return redirect()->route('questions.index');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm mới FAQs cho bài viết: ' . $e->getMessage());
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
    public function edit(Request $request, $id)
    {
        $question = Questions::find($id);
        $type = $request->type;
        $content_id = $request->content_id;
        $listQuestionContent = [];
        $question_contents = [];
        if ($type) {
            if ($type == Category::TYPE_ABOUT) {
                $listQuestionContent = Introduces::where('status', 1)->orderBy('sort')->get();
            } elseif ($type == Category::TYPE_NEWS) {
                $listQuestionContent = Contents::where('status', 1)->orderBy('sort')->get();
            } elseif ($type == Category::TYPE_SERVICE) {
                $listQuestionContent = Services::where('status', 1)->where('type', Services::SERVICE)->orderBy('sort')->get();
            } elseif ($type == Category::TYPE_PRICE) {
                $listQuestionContent = Prices::where('status', 1)->orderBy('sort')->get();
            } elseif ($type == Questions::TYPE_TERM) {
                $listQuestionContent = Services::where('status', 1)->where('type', Services::TERM)->orderBy('sort')->get();
            }

            $question_contents = QuestionContents::where('question_id', $id)->where('type', $request->type)->pluck('content_id')->toArray();
        }

        return view('backend.questions.edit', compact('question', 'type', 'content_id', 'question_contents', 'listQuestionContent'));
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
        try {
            $name = $request->name;
            $type = $request->type;
            $content_id = $request->content_id;

            $list_content = [];
            $list_content = $request->input('list_content');

            $data = [
                'name' => $name,
                'parent_id' => $request->parent_id,
                'intro' => $request->intro,
                'slug' => Str::slug($name, '-'),
                'status' => $request->status,
                'sort' => $request->sort
            ];

            $request->validate([
                'name' => [
                    'required',
                    // Chỉ thêm rule unique nếu name đã thay đổi
                    Rule::unique('questions', 'name')
                        ->ignore($id)
                ],
                'intro' => 'required',
            ], [
                'name.required' => 'Câu hỏi không được để trống.',
                'name.unique' => 'Câu hỏi này đã tồn tại.',
                'intro.required' => 'Câu trả lời không được để trống.',
            ]);

            $question = Questions::where('id', $id)->first();

            $question_content = QuestionContents::where('question_id', $id)->where('type', $type)->pluck('content_id')->toArray();

            if (!empty($list_content)) {
                $idDel = array_diff($question_content, $list_content);
                $idAdd = array_diff($list_content, $question_content);
                foreach ($idAdd as $item => $value) {
                    $datas = [
                        'content_id' => $value,
                        'question_id' => $id,
                        'type' => $type
                    ];
                    QuestionContents::create($datas);
                }
                QuestionContents::where('question_id', $question->id)->where('type', $type)->whereIn('content_id', $idDel)->delete();
            } else {
                QuestionContents::where('question_id', $question->id)->where('type', $type)->delete();
            }

//            $path = "images/uploads/questions";
//            $image = $request->image;
//            if ($image) {
//                if (\Illuminate\Support\Facades\File::exists($question->image)) {
//                    File::delete($question->image);
//                }
//                $extension = $image->extension();
//                $file_name = "question_" . time() . '.' . $extension;
//                $file_path = $path . '/' . $file_name;
//                $image->move($path . '/', $file_name);
//                $question->image = $file_path;
//            }

            $question->name = $data['name'];
            $question->intro = $data['intro'];
            $question->slug = $data['slug'];
            $question->status = $data['status'];
            $question->sort = $data['sort'];
            $question->parent_id = $data['parent_id'];
            $question->save();

            if ($type == Category::TYPE_ABOUT) {
                $content = Introduces::find($content_id);
            } elseif ($type == Category::TYPE_NEWS) {
                $content = Contents::find($content_id);
            } elseif ($type == Category::TYPE_SERVICE) {
                $content = Services::find($content_id);
            } elseif ($type == Category::TYPE_PRICE) {
                $content = Prices::find($content_id);
            } elseif ($type == Questions::TYPE_TERM) {
                $content = Services::find($content_id);
            }
            $title = $content->title ?? '';

            return redirect()->back()->withInput()->with('message-success', ' Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật gán question cho bài viết: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('message-error', $e->getMessage());
        }


    }

    public function updateQuestion(Request $request)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'intro' => $request->intro,
            'sort' => (int) ($request->get('sort') ?? 1),
            'status' => $request->status,
        ];

        try {
            DB::beginTransaction();
            $question = Questions::find($request->id);

            $path = "images/uploads/questions";
            $image = $request->image;
            if ($image) {
                if (\Illuminate\Support\Facades\File::exists($question->image)) {
                    File::delete($question->image);
                }
                $extension = $image->extension();
                $file_name = "question_" . time() . '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $question->image = $file_path;
            }

            $question->name = $data['name'];
            $question->slug = $data['slug'];
            $question->intro = $data['intro'];
            $question->sort = $data['sort'];
            $question->status = $data['status'];
            $question->save();

            DB::commit();
            return redirect()->back()->withInput()->with('message-success', 'Cập nhật thành công!');
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
            $question = Questions::findOrFail($id);

            // Xóa liên kết bảng trung gian
            QuestionContents::where('question_id', $question->id)->delete();

            // Xóa con nếu có
            if ($question->child()->exists()) {
                $question->child()->delete();
            }

            $question->delete();

            if (request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'Xóa thành công!']);
            }

            return redirect()->back()->withInput()->with('message-success', 'Xóa thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }

            return redirect()->back()->withInput()->with('message-error', $e->getMessage());
        }
    }


    public function list_all(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        $title = '';

        if ($type == Category::TYPE_ABOUT) {
            $content = Introduces::find($id)->title;
        } elseif ($type == Category::TYPE_NEWS) {
            $content = Contents::find($id);
        } elseif ($type == Category::TYPE_SERVICE || $type == Questions::TYPE_TERM) {
            $content = Services::find($id)->tilte;
        } elseif ($type == Category::TYPE_PRICE) {
            $content = Prices::find($id)->tilte;
        }
        $title = $content->title ?? '';
        $questions_admin = Questions::whereHas('questionContents', function ($query) use ($id, $type) {
            $query->where('content_id', $id)
                ->where('type', $type);
        })->get();

        return view('backend.questions.list', compact('questions_admin', 'title', 'type', 'id'));

    }
}
