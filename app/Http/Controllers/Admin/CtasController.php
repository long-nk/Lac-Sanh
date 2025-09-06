<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\cta;

//use Illuminate\Support\Facades\File;
use App\Models\Ctas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use File;
use Image;

class CtasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ctaList = Ctas::orderBy('sort')->get();

        return view('backend.ctas.index', compact('ctaList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ctas.create');
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
            DB::beginTransaction();
            $path = "images/uploads/ctas";
            $image = $request->image;
            $file_path = "";

            if ($image) {
                $extension = $image->extension();
                $file_name = "cta_" . time() . '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move(public_path($path), $file_name); // Đảm bảo lưu đúng vào public/
            }

            // Tạo nội dung HTML cho trường 'link'
            $title = $request->title;
            $name = $request->name;
            $imageHtml = $file_path
                ? '<img src="' . asset($file_path) . '" alt="' . e($request->alt) . '">'
                : '<button type="button" class="btn-cta-contact"
                    style="background: #fdb448;border: 1px solid;padding: 8px 20px;font-size: 1rem;border-radius: 5px;margin-top: 10px;font-weight: bold;cursor: pointer;">'
                . e($name) .
                '</button>';

            $html = '
        <div class="button-cta"
             style="text-align: center;margin-top: 30px !important;margin-bottom: 15px">
            <p class="title-cta" style="font-size: 1.2rem !important;">' . e($title) . '</p>
            <a href="#" id="openQuoteBtn" class="link-cta quote-button">'
                . $imageHtml .
                '</a>
        </div>';

            $data = [
                'title' => $title,
                'name' => $name,
                'image' => $file_path,
                'alt' => $request->alt,
                'meta' => $request->meta,
                'sort' => (int)($request->get('sort') ?? 1),
                'status' => $request->status,
                'user_id' => Auth::user()->id,
                'user_update_id' => Auth::user()->id,
                'link' => $html,
            ];

            Ctas::create($data);
            DB::commit();

            return redirect()->route('ctas.index')->with('message-success', 'Thêm mới thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('message-error', 'Thêm mới thất bại');
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
        $cta = Ctas::find($id);
        return view('backend.ctas.edit', compact('cta'));
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
            DB::beginTransaction();

            $cta = Ctas::find($id);
            if (!$cta) {
                throw new Exception("Không tìm thấy bản ghi!");
            }

            $path = "images/uploads/ctas";
            $image = $request->image;
            $file_path = $cta->image;

            // Nếu có ảnh mới => xoá ảnh cũ và upload ảnh mới
            if ($image) {
                if (File::exists($cta->image)) {
                    File::delete($cta->image);
                }
                $extension = $image->extension();
                $file_name = "cta_" . time() . '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move(public_path($path), $file_name);
            }

            if(empty($image)) {
                $image = $path . '/' . $cta->image;
            }
            // Tạo nội dung HTML cho trường 'link'
            $title = $request->title;
            $name = $request->name;
            $imageHtml = $image
                ? '<img src="' . asset($file_path) . '" alt="' . e($request->alt) . '">'
                : '<button type="button" class="btn-cta-contact"
                    style="background: #fdb448;border: 1px solid;padding: 8px 20px;font-size: 1rem;border-radius: 5px;margin-top: 10px;font-weight: bold;cursor: pointer;">'
                . e($name) .
                '</button>';

            $html = '
        <div class="button-cta"
             style="text-align: center;margin-top: 30px !important;margin-bottom: 15px">
            <p class="title-cta" style="font-size: 1.2rem !important;">' . e($title) . '</p>
            <a href="#" id="openQuoteBtn" class="link-cta quote-button">'
                . $imageHtml .
                '</a>
        </div>';

            // Cập nhật dữ liệu
            $cta->name = $name;
            $cta->image = $file_path;
            $cta->alt = $request->alt;
            $cta->meta = $request->meta;
            $cta->sort = (int)($request->get('sort') ?? 1);
            $cta->user_update_id = Auth::user()->id;
            $cta->status = $request->status;
            $cta->link = $html;

            $cta->save();
            DB::commit();

            return redirect()->back()->withInput()->with('message-success', 'Cập nhật thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->withInput()->with('message-error', 'Cập nhật thất bại');
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
            $cta = Ctas::find($id);
            $image = @$cta->image;
            if (empty($cta)) {
                return redirect()->back()->withInput()->with('message-error', 'Không tìm thấy cta');
            }
            $cta->delete();
            $check = Ctas::where('image', $image)->first();
            if (empty($check)) {
                if (File::exists($image)) {
                    File::delete($image);
                }
            }

            return redirect()->back()->withInput()->with('message-success', 'Xóa thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi xóa cta', $e->getMessage());
            return redirect()->back()->withInput()->with('message-error', $e->getMessage());
        }
    }
}
