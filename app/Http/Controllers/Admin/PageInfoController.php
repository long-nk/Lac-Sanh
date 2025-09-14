<?php

namespace App\Http\Controllers\Admin;

use App\Models\Locations;
use App\Models\PageInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PageInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageInfo = PageInfo::first();
        if(!$pageInfo) {
            return redirect()->route('info.create', compact('pageInfo'));
        }

        return view('backend.info.index', compact('pageInfo'));
    }

    public function create()
    {
        return view('backend.info.create');
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();

            $path = "images/uploads/logo";
            $image = $request->logo;
            $logo_path = "";
            if ($request->logo) {
                $file_name = "logo";
                $logo_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
            }

            $path = "images/uploads/qr_codes";
            $image = $request->qr_code;
            $copy_path = "";
            if ($request->qr_code) {
                $file_name = "qr_code";
                $copy_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
            }
            $data = [
                'name' => $request->name,
                'slogan' => $request->slogan,
                'logo' => $logo_path,
                'address' => $request->address,
                'address2' => $request->address2,
                'phone_number' => $request->phone_number,
                'phone_number2' => $request->phone_number2,
                'email' => $request->email,
                'mst' => $request->mst,
                'copy_right' => $copy_path,
                'manager' => $request->manager,
                'facebook' => $request->facebook,
                'youtube' => $request->youtube,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'bank' => $request->bank,
                'account' => $request->account,
                'card' => $request->card
            ];
            PageInfo::create($data);
            DB::commit();

            return redirect()->route('info.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = PageInfo::where('id', $id)->first();
        return view('backend.info.edit', compact('info'));
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
            $pageInfo = PageInfo::findOrFail($id);

            $rules = [
                'name' => 'required|max:255',
                'phone_footer' => 'required',
                'address' => 'required',
                'logo'        => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,ico|max:2048',
                'logo_top'    => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,ico|max:2048',
                'logo_footer' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,ico|max:2048',
                'qr_code'     => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $request->only([
                'name','full_name','summary','address','address2','phone_footer','phone_number',
                'phone_number2','copy_right','alt_favicon','alt_logo','alt_logo_footer','email',
                'mst','manager','facebook','messenger','twitter','tiktok','youtube','zalo',
                'term','map','status','header','css','body','footer','bank','account','content',
                'number','export_status','link_website','link_company','mail_setup','sale_name1',
                'sale_phone1','sale_name2','sale_phone2'
            ]);

            // xử lý upload file
            $uploadFields = [
                'logo'        => 'logo',
                'logo_top'    => 'logo_top',
                'logo_footer' => 'logo_footer',
                'qr_code'     => 'qr_code',
            ];

            foreach ($uploadFields as $field => $prefix) {
                if ($request->hasFile($field)) {
                    $path = "images/uploads/" . ($field == 'qr_code' ? 'qr_codes' : 'logo');

                    // Xóa file cũ
                    if ($pageInfo->$field && File::exists(public_path($pageInfo->$field))) {
                        File::delete(public_path($pageInfo->$field));
                    }

                    $file      = $request->file($field);
                    $extension = $file->getClientOriginalExtension();
                    $file_name = $prefix . '_' . time() . '.' . $extension;

                    $file->move(public_path($path), $file_name);

                    $data[$field] = $path . '/' . $file_name;
                }
            }

            $pageInfo->update($data);

            return redirect()->route('info.index')->with('message-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật website: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('message-error', 'Xảy ra lỗi khi cập nhật!');
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
        $info = PageInfo::where('id', $id)->delete();

        return redirect()->route('info.index');
    }
}






