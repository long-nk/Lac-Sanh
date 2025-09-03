<?php

namespace App\Http\Controllers\Admin;

use App\Models\Locations;
use App\Models\PageInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        $infor = PageInfo::first();
        if(!$infor) {
            return redirect()->route('info.create', compact('infor'));
        }

        return view('backend.info.index', compact('infor'));
    }

    public function create()
    {
        return view('backend.info.create');
    }

    public function store(Request $request) {
        try {
            \DB::beginTransaction();

            $path = "images/uploads/logo";
            $image = $request->logo;
            $logo_path = "";
            if ($request->logo) {
                $file_name = "logo";
                $logo_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
            }

            $path = "images/uploads/QR";
            $image = $request->qr_code;
            $file_path = "";
            if ($image) {
                $file_name = "qr_code";
                $file_path = $path . '/' . $file_name;
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
                'manager' => $request->manager,
                'card' => $request->card,
                'bank' => $request->bank,
                'account' => $request->account,
                'qr_code' => $file_path,
            ];
            PageInfo::create($data);
            \DB::commit();

            return redirect()->route('info.index');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
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
            $infor = PageInfo::first();
            $rules = [
                'name' => 'required|max:255',
                'phone_number' => 'required',
                'address' => 'required',
                'slogan' => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = [
                'name' => $request->name,
                'slogan' => $request->slogan,
                'address' => $request->address,
                'address2' => $request->address2,
                'phone_number' => $request->phone_number,
                'phone_number2' => $request->phone_number2,
                'email' => $request->email,
                'email2' => $request->email2,
                'mst' => $request->mst,
                'manager' => $request->manager,
                'card' => $request->card,
                'bank' => $request->bank,
                'account' => $request->account,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
                'tiktok' => $request->tiktok,
                'messenger' => $request->messenger,
            ];
            $path = "images/uploads/logo";
            $image = $request->logo;
            if ($image) {
                if(File::exists($infor->logo)) {
                    File::delete($infor->logo);
                }
                $file_name = "logo";
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $infor->logo = $file_path;
            }

            $path = "images/uploads/logo";
            $image = $request->logo_mb;
            if ($image) {
                if(File::exists($infor->logo_mb)) {
                    File::delete($infor->logo_mb);
                }
                $file_name = "logo_mb";
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $infor->logo_mb = $file_path;
            }

            $path = "images/uploads/QR";
            $image = $request->qr_code;
            if ($image) {
                if(File::exists($infor->qr_code)) {
                    File::delete($infor->qr_code);
                }
                $file_name = "qr_code";
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $infor->qr_code = $file_path;
            }
            $result = $infor->update($data);

            if ($result) {
                return redirect()->route('info.index');
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
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






