<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
//use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use File;
use Image;

class SitemapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.sitemaps.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sitemap = 0;
        $filePath = public_path('sitemap.xml');
        if (File::exists($filePath)) {
            $sitemap = 1;
        }
        return view('backend.sitemaps.create', compact('sitemap'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'sitemap' => 'required|file|mimes:xml|max:2048',
            ]);

            $file = $request->file('sitemap');

            // Di chuyển file vào thư mục public và đổi tên thành sitemap.xml
            $file->move(public_path(), 'sitemap.xml');

            return redirect()->back()->withInput()->with('message-success', 'Cập nhật sitemap thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật sitemap ' . $e->getMessage());
            return redirect()->back()->withInput()->with('message-error' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('backend.sitemaps.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function delete()
    {
        try {
            $filePath = public_path('sitemap.xml');

            if (File::exists($filePath)) {
                File::delete($filePath);
                return redirect()->back()->withInput()->with('message-success', 'Đã xóa sitemap.xml thành công!');
            } else {
                return redirect()->back()->withInput()->with('message-error', 'File sitemap.xml không tồn tại!');
            }

        } catch (\Exception $e) {
            Log::error('Lỗi xóa sitemap.xml: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('message-error', 'Lỗi xóa sitemap.xml: ' . $e->getMessage());
        }
    }
}
