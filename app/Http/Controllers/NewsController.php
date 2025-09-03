<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Contents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $hots = Contents::where('type', Contents::TIN_TUC)->where('check', 1)->orderBy('sort')->orderBy('created_at', 'desc')->limit(5)->get();
            $ids = $hots->pluck('id')->toArray();
            $contents = Contents::with('fileItem')->whereNotIn('id', $ids)->where('type', Contents::TIN_TUC)
                ->orderBy('sort')->orderBy('created_at', 'desc')->paginate(12);

            return view('frontend.news.index', compact('contents', 'hots'));
        } catch (Exception $e) {
            Log::error('Lỗi lấy danh sách tin tức', $e->getMessage());
            return redirect()->back()->with('message-error', 'Lỗi xảy ra, vui lòng thử lại sau!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $content = Contents::find($request->id);
            $content->view += 1;
            $content->save();
            $hots = Contents::where('type', Contents::TIN_TUC)
                ->where('id', '!=', $content->id)
                ->where('check', 1)
                ->orderBy('sort')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            $hotIds = $hots->pluck('id')->toArray();

            $news = Contents::where('type', Contents::TIN_TUC)
                ->where('id', '!=', $content->id)
                ->whereNotIn('id', $hotIds)
                ->orderBy('sort')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            $randoms = Contents::where('type', Contents::TIN_TUC)->where('id', '!=', $content->id)->inRandomOrder()->limit(5)->get();
            $contentRelateds = Contents::where('type', $content->type)->where('id', '!=', $content->id)->orderBy('sort')->orderBy('created_at', 'desc')->limit(10)->get();
            return view('frontend.news.detail',compact('content', 'contentRelateds', 'news', 'hots', 'randoms'));
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', "Lỗi xem chi tiết bài viết, vui lòng thử lại sau");

        }

    }

    public function showDetail($slug, $id)
    {
        $slug = $slug . '-' . $id;
        $arr = explode('-', $slug);
        $content = Content::where('id', end($arr))->first();
        $listNewsSuggest = Content::where('content_div', 1)->inRandomOrder()->get();
        return view('frontend.news.detail',compact('content', 'listNewsSuggest'));
    }

    public function listType() {

        $tintuc = Content::where('content_div', 1)->get();

        return view('frontend.news.index', compact('tintuc'));
    }

    public function listAll($slug)
    {
        $cat = Category::where('slug', $slug)->first();

        $tintuc = Content::where('category_id', $cat->id)->paginate(15);

        return view('frontend.news.index', compact('tintuc', 'cat'));
    }


    public function listCompany()
    {
        $tintuc = Content::join('categories', 'categories.id', 'contents.category_id')->where('categories.type', 2)->paginate(15);
        return view('frontend.news.company', compact('tintuc'));
    }

    public function getCompany($slug) {
        $cat = Category::where('slug', $slug)->first();

        $tintuc = Content::where('category_id', $cat->id)->paginate(15);

        return view('frontend.news.company', compact('tintuc', 'cat'));
    }

    public function getProjects() {
        $listProject = Content::where('content_div', Content::TYPE_PROJECTS)->paginate(15);
//        dd($listProject);
        return view('frontend.projects.index', compact('listProject'));
    }

}
