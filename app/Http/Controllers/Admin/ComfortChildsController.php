<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comforts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mockery\Exception;

class ComfortChildsController extends Controller
{
    public function index()
    {
        $comforts = Comforts::where('special', 0)->get();
        return view('backend.comfort_childs.index', compact('comforts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comforts = Comforts::where('status', 1)->where('special', 0)->get();
        return view('backend.comfort_childs.create', compact( 'comforts'));
    }

    public function createChild($id)
    {
        $comfort = Comforts::find($id);
        $comforts = Comforts::where('status', 1)->where('special', 0)->get();
        return view('backend.comfort_childs.create', compact('comfort', 'comforts'));
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

            $path = "images/uploads/comforts";
            $image = $request->image;
            $file_path = "";
            if ($request->image) {
                $extension = $image->extension();
                $file_name = "comfort_" . time() .  '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
            }

            $data = [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'image' => $file_path,
                'type' => $request->type,
                'status' => $request->status,
            ];
            Comforts::create($data);
            \DB::commit();

            return redirect()->route('comforts.listAll', ['type' => $request->type]);
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
        $comforts = Comforts::where('status', 1)->where('special', 0)->get();
        return view('backend.comfort_childs.edit', compact('id', 'comfort', 'comforts'));
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
                return redirect()->back()->with('message-error', 'Không tìm thấy tiện ích');
            }

            $path = "images/uploads/comforts";
            $image = $request->image;
            if ($image) {
                if($comfort->image != "") {
                    File::delete($comfort->image);
                }
                $extension = $image->extension();
                $file_name = "comfort_" . time() . '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $comfort->image = $file_path;
            }
            $comfort->name = $request->name;
            $comfort->parent_id = $request->parent_id;
            $comfort->status = $request->status;
            $comfort->type = $request->type;
            $comfort->save();

            \DB::commit();
            return redirect()->route('comforts.listAll', ['type' => $request->type]);
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
        if(File::exists($comfort->image)) {
            File::delete($comfort->image);
        }
        $type = $comfort->type;
        $comfort->delete();

        return redirect()->route('comforts.listAll', ['type' => $type]);
    }

    public function listAll(Request $request) {
        $comforts = Comforts::where('type', $request->type)->whereNull('parent_id')->where('special', 0)->get();
        return view('backend.comforts.index', compact('comforts'));
    }
}
