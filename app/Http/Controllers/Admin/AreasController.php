<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\HotelAreas;
use App\Models\LocationAreas;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\Exception;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Areas::all();
        return view('backend.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.areas.create');
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

//            foreach ($list_location as $item => $value) {
                $data = [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
//                    'location_id' => $value,
                    'status' => $request->status,
                ];
                Areas::create($data);
//            }
            \DB::commit();

            return redirect()->route('areas.index');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('message-error', $e->getMessage());
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
        $area = Areas::find($id);

        return view('backend.areas.edit', compact('area'));
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

            $area = Areas::find($id);
            if(!isset($area)){
                throw new Exception("Not found!");
            }

            $area->name = $request->name;
            $area->slug = Str::slug($request->name);
            $area->status = $request->status;
            $area->save();

            \DB::commit();
            return redirect()->route('areas.index');
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollback();
            return redirect()->back();
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
        $area = Areas::find($id);

        if (empty($area)) {
            return redirect()->back();
        }
        HotelAreas::where('area_id', $id)->delete();
        LocationAreas::where('area_id', $id)->delete();
        $area->delete();
        return redirect()->back();
    }
}
