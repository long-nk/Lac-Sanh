<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comforts;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mockery\Exception;

class ComfortSpecialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listComfortSpecial = Comforts::where('special', 1)->get();
        return view('backend.comfort_specials.index', compact('listComfortSpecial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.comfort_specials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();

//            $path = "images/uploads/comforts";
//            $image = $request->image;
//            $file_path = "";
//            if ($request->image) {
//                $extension = $image->extension();
//                $file_name = "comfort_" . time() .  '.' . $extension;
//                $file_path = $path . '/' . $file_name;
//                $image->move($path . '/', $file_name);
//            }

            $data = [
                'name' => $request->name,
//                'parent_id' => $request->parent_id,
//                'image' => $file_path,
//                'type' => $request->type,
                'special' => 1,
                'status' => $request->status,
            ];
            Comforts::create($data);
            \DB::commit();

            return redirect()->route('comfort_specials.index');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comfort = Comforts::find($id);
        return view('backend.comfort_specials.edit', compact('id', 'comfort'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();

            $comfort = Comforts::find($id);

            if(!isset($comfort)){
                return redirect()->back()->with('message-error', 'Không tìm thấy yêu cầu');
            }

//            $path = "images/uploads/comforts";
//            $image = $request->image;
//            if ($image) {
//                if($comfort->image != "") {
//                    File::delete($comfort->image);
//                }
//                $extension = $image->extension();
//                $file_name = "comfort_" . time() . '.' . $extension;
//                $file_path = $path . '/' . $file_name;
//                $image->move($path . '/', $file_name);
//                $comfort->image = $file_path;
//            }
            $comfort->name = $request->name;
//            $comfort->parent_id = $request->parent_id;
            $comfort->status = $request->status;
//            $comfort->special = $request->type;
            $comfort->save();

            \DB::commit();
            return redirect()->route('comfort_specials.index');
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollback();
            return redirect()->back()->with('message-error', 'Lỗi cập nhật, vui lòng thử lại sau');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comfort = Comforts::find($id);
        $comfort->delete();

        return redirect()->route('comfort_specials.index');
    }

    public function listAll(Request $request) {
        $listComfortRoom = Comforts::where('type', $request->type)->whereNull('parent_id')->get();

        return view('backend.comfort_specials.index', compact('listComfortRoom'));
    }
}
