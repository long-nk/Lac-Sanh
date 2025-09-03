<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Pages::orderBy('created_at', 'desc')->get();
        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('backend.pages.create');
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
            'title' => $request->title,
            'title_seo' => $request->title_seo,
            'slug' => $request->slug ?  Str::slug($request->slug, '-') : Str::slug($request->title_seo, '-'),
            'summary' => $request->summary,
            'content' => $request->content,
            'link' => $request->link,
            'user_id' => auth()->user()->id,
            'status' => $request->status,
        ];

        $request->validate([
            'title' => [
                'required',
                Rule::unique('pages', 'title')->whereNull('deleted_at'),
            ],
            'title_seo' => [
                'required',
                Rule::unique('pages', 'title_seo')->whereNull('deleted_at'),
            ],
        ], [
            'title.required' => 'Tên trang không được để trống.',
            'title.unique' => 'Tên trang đã tồn tại.',
            'title_seo.required' => 'Tiêu đề SEO không được để trống.',
            'title_seo.unique' => 'Tiêu đề SEO này đã tồn tại.',
        ]);

        try {
            DB::beginTransaction();
            Pages::create($data);
            DB::commit();
            return redirect()->route('pages.index')->with('message-success', 'Thêm mới thành công');
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
        $page = Pages::find($id);

        return view('backend.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $data = [
            'title' => $request->title,
            'title_seo' => $request->title_seo,
            'slug' => $request->slug ?  Str::slug($request->slug, '-') : Str::slug($request->title_seo, '-'),
            'summary' => $request->summary,
            'content' => $request->content,
            'link' => $request->link,
            'user_update_id' => Auth::user()->id,
            'status' => $request->status,
        ];
        $request->validate([
            'title' => [
                'required',
                Rule::unique('pages', 'title')
                    ->ignore($request->id)
                    ->whereNull('deleted_at')
            ],
            'title_seo' => [
                'required',
                Rule::unique('pages', 'title_seo')
                    ->ignore($request->id)
                    ->whereNull('deleted_at')
            ],
        ], [
            'title.required' => 'Tên trang không được để trống.',
            'title.unique' => 'Tên trang đã tồn tại.',
            'title_seo.required' => 'Tiêu đề SEO không được để trống.',
            'title_seo.unique' => 'Tiêu đề SEO này đã tồn tại.',
        ]);

        try {
            DB::beginTransaction();
            $news = Pages::find($request->id);

            $news->title = $data['title'];
            $news->title_seo = $data['title_seo'];
            $news->slug = $data['slug'];
            $news->summary = $data['summary'];
            $news->content = $data['content'];
            $news->link = $data['link'];
            $news->status = $data['status'];
            $news->user_update_id = $data['user_update_id'];
            $news->save();

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
            $content = Pages::find($id);

            if (empty($content)) {
                return redirect()->back()->with('message-error', 'Không tìm thấy trang!');
            }

            $content->delete();
            return redirect()->back()->with('message-success', 'Xóa trang thành công!');
        } catch (\Exception $exeption) {
            Log::error($exeption->getMessage());
            return redirect()->back()->with('message-error', $exeption->getMessage());
        }

    }

}
