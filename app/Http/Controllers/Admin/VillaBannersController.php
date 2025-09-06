<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\File;
use App\Models\Locations;
use App\Models\VillaBanners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use File;
use Image;

class VillaBannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $location = Locations::find($request->id);
        $bannerList = VillaBanners::where('location_id', $request->id)->orderBy('sort')->orderBy('created_at', 'desc')->get();

        return view('backend.villa_banners.index', compact('bannerList', 'location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $location = $request->location_id;
        return view('backend.villa_banners.create', compact('location'));
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
            DB::beginTransaction();
            $path = "images/banners";
            $image = $request->image_desktop;
            $file_path_desktop = "";
            if ($request->image_desktop) {
                $extension = $image->extension();
                $file_name = "banner_villa_desktop" . time() .  '.' . $extension;
                $file_path_desktop = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
            }

            $image = $request->image_mobile;
            $file_path_mobile = "";
            if ($request->image_mobile) {
                $extension = $image->extension();
                $file_name = "banner_villa_mobile" . time() .  '.' . $extension;
                $file_path_mobile = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
            }

            $data = [
                'name' => $request->name,
                'location_id' => $request->location_id,
                'link' => $request->link,
                'image_desktop' => $file_path_desktop,
                'image_mobile' => $file_path_mobile,
                'type' => $request->type,
                'sort' => $request->sort,
                'status' => $request->status,
            ];
            VillaBanners::create($data);
            DB::commit();

            return redirect()->route('villa_banners.index', ['id' => $request->location_id])->with('message-success', 'Thêm mới thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('message-error', 'Thêm mới thất bại!');
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
    public function edit($id)
    {
        $banner = VillaBanners::find($id);
        return view('backend.villa_banners.edit', compact('banner'));
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
        try {
            DB::beginTransaction();

            $banner = VillaBanners::find($id);
            if(!isset($banner)){
                throw new Exception("Not found!");
            }


            $path = "images/banners";
            $image = $request->image_desktop;
            if ($image) {
                if(\Illuminate\Support\Facades\File::exists($banner->image_desktop)) {
                    File::delete($banner->image_desktop);
                }
                $extension = $image->extension();
                $file_name = "banner_villa_desktop" . time() . '.' . $extension;
                $file_path_desktop = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $banner->image_desktop = $file_path_desktop;
            }

            $image = $request->image_mobile;
            if ($image) {
                if(\Illuminate\Support\Facades\File::exists($banner->image_mobile)) {
                    File::delete($banner->image_mobile);
                }
                $extension = $image->extension();
                $file_name = "banner_villa_mobile" . time() . '.' . $extension;
                $file_path_mobile = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $banner->image_mobile = $file_path_mobile;
            }

            $banner->name = $request->name;
            $banner->link = $request->link;
            $banner->sort = $request->sort;
            $banner->type = $request->type;
            $banner->status = $request->status;
            $banner->save();

            DB::commit();
            return redirect()->route('villa_banners.index', ['id' => $banner->location_id])->with('message-success', 'Cập nhật thành công!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->withInput()->with('message-error', 'Xảy ra lỗi khi cập nhật: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $banner = VillaBanners::find($id);

            if (empty($banner)) {
                return redirect()->back()->withInput()->with('message-error', 'Không tìm thấy banner');
            }

            if(\Illuminate\Support\Facades\File::exists($banner->image_desktop)) {
                File::delete($banner->image_desktop);
            }

            if(\Illuminate\Support\Facades\File::exists($banner->image_mobile)) {
                File::delete($banner->image_mobile);
            }

            $banner->delete();
            return redirect()->back()->withInput()->with('message-success', 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('message-error', 'Xảy ra lỗi khi xóa: ' . $e->getMessage());
        }
    }
}
