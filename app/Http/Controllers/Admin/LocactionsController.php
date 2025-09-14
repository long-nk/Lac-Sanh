<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\Comforts;
use App\Models\LocationAreas;
use App\Models\Locations;
use App\Models\PageInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\Exception;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class LocactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Locations::orderBy('sort', 'asc')->get();
        return view('backend.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listArea = Areas::where('status', 1)->get();
        return view('backend.locations.create', compact('listArea'));
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
            $list_area = [];
            $list_area = $request->input('list_area');

            $path = "images/uploads/locations";
            $image = $request->image;
            $file_path = "";
            if ($request->image) {
                $extension = $image->extension();
                $file_name = "location_" . time() .  '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
            }

            $data = [
                'name' => $request->name,
                'country' => $request->country,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'image' => $file_path,
                'sort' => $request->sort,
                'rate' => $request->rate,
                'summary' => $request->summary,
                'content' => $request->content,
                'region' => $request->region,
                'type' => $request->type,
                'check' => $request->check,
//                'hidden' => $request->hidden,
                'status' => $request->status,
            ];
            $location = Locations::create($data);
            if(!empty($list_area)) {
                foreach ($list_area as $area) {
                    $data = [
                        'location_id' => $location->id,
                        'area_id' => $area,
                    ];
                    LocationAreas::create($data);
                }
            }

            \DB::commit();

            return redirect()->route('locations.region', ['region' => $location->region]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back();
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
        $location = Locations::find($id);
        $listArea = Areas::where('status', 1)->get();
        $location_area = LocationAreas::where('location_id', $location->id)->pluck('area_id')->toArray();
        return view('backend.locations.edit', compact('location', 'listArea', 'location_area'));
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

            $location = Locations::find($id);
            if(!isset($location)){
                throw new Exception("Not found!");
            }

            $list_area = [];
            $list_area = $request->input('list_area');

            $location_area = LocationAreas::where('location_id', $location->id)->pluck('area_id')->toArray();

            if(!empty($list_area)) {
                $idDel = array_diff($location_area, $list_area);
                $idAdd = array_diff($list_area, $location_area);
                foreach ($idAdd as $item => $value) {
                    $datas = [
                        'location_id' => $location->id,
                        'area_id' => $value,
                    ];
                    LocationAreas::create($datas);
                }
                LocationAreas::where('location_id', $location->id)->whereIn('area_id', $idDel)->delete();
            }

            $path = "images/uploads/locations";
            $image = $request->image;
            if ($image) {
                if (\Illuminate\Support\Facades\File::exists($location->image)) {
                    File::delete($location->image);
                }
                $extension = $image->extension();
                $file_name = "location_" . time() . '.' . $extension;
                $file_path = $path . '/' . $file_name;
                $image->move($path . '/', $file_name);
                $location->image = $file_path;
            }
            $location->name = $request->name;
            $location->country = $request->country;
            $location->slug = Str::slug($request->name);
            $location->status = $request->status;
            $location->sort = $request->sort;
            $location->rate = $request->rate;
            $location->summary = $request->summary;
            $location->content = $request->content;
            $location->region = $request->region;
            $location->type = $request->type;
            $location->check = $request->check;
//            $location->hidden = $request->hidden;
            $location->save();

            \DB::commit();
            return redirect()->route('locations.region', ['region' => $location->region]);
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
        $location = Locations::find($id);

        if (empty($location)) {
            return redirect()->back();
        }
        if(File::exists($location->image)) {
            File::delete($location->image);
        }
        LocationAreas::where('location_id', $location->id)->delete();
        $location->delete();
        return redirect()->back();
    }

    public function getAreasByLocation(Request $request)
    {
        $location = Locations::find($request->id);
        $listArea = $location->areas;
//        if(count(@$listArea) == 0) {
//            $listArea = Areas::where('status', 1)->get();
//        }
        return view('backend.hotels.list_area', compact('listArea'));
    }

    public function listRegion($region) {
        $location_regions = Locations::where('region', $region)->orderBy('sort', 'asc')->get();
        return view('backend.locations.index', compact('location_regions','region'));
    }

    public function setHidden()
    {
        return view('backend.locations.set_hidden');
    }

    public function changeStatus(Request $request)
    {
        $item = PageInfo::first();

        if ($item) {
            if($request->type == Comforts::KS) {
                $item->hotel == 1 ? $item->hotel = 0 : $item->hotel = 1;
            } elseif($request->type == Comforts::TO) {
                $item->villa == 1 ? $item->villa = 0 : $item->villa = 1;
            }  elseif($request->type == Comforts::HS) {
                $item->homestay == 1 ? $item->homestay = 0 : $item->homestay = 1;
            }  elseif($request->type == Comforts::RS) {
                $item->resort == 1 ? $item->resort = 0 : $item->resort = 1;
            }  elseif($request->type == Comforts::DT) {
                $item->yacht == 1 ? $item->yacht = 0 : $item->yacht = 1;
            }
            $item->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
