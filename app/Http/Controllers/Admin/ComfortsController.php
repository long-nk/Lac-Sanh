<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comforts;
use App\Models\Hotels;
use App\Models\Locations;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mockery\Exception;

class ComfortsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comforts = Comforts::all();
        return view('backend.comforts.index', compact('comforts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comforts = Comforts::where('status', 1)->get();
        return view('backend.comforts.create', compact('comforts'));
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
        $comfort = Comforts::find($id);
        return view('backend.comforts.edit', compact('id', 'comfort'));
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
                return redirect()->back()->withInput()->with('message-error', 'Không tìm thấy tiện ích');
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
            return redirect()->back()->withInput()->with('message-error', 'Lỗi cập nhật, vui lòng thử lại sau');
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
        if($comfort->children) {
            $comfort->children->each(function($child) {
                $child->delete();
            });
        }
        $type = $comfort->type;
        $comfort->delete();

        return redirect()->route('comforts.listAll', ['type' => $type]);
    }

    public function listAll(Request $request)
    {
        $listComfortRoom = Comforts::where('type', $request->type)->whereNull('parent_id')->get();

        return view('backend.comforts.index', compact('listComfortRoom'));
    }

    public function editComfortVillas(Request $request)
    {
        $type = $request->type;
        $comfort_villas = Comforts::where('type', $type)->whereNotNull('parent_id')->where('status', 1)->get();
        $listComfortVilla = Comforts::where('type', $type)->whereNotNull('parent_id')->where('check', $type)->where('status', 1)->pluck('id')->toArray();
        if($type == Comforts::KS) {
            $title = 'Khách sạn';
        }
        if($type == Comforts::TO) {
            $title = 'Villa';
        }
        if($type == Comforts::HS) {
            $title = 'Homestay';
        }
        if($type == Comforts::RS) {
            $title = 'Resort';
        }
        if($type == Comforts::DT) {
            $title = 'Du thuyền';
        }
        if($type == Comforts::RM) {
            $title = 'Phòng';
        }
        if(empty($listComfort)) {
            $listComfort = [];
        }
        return view('backend.comforts.edit_comfort_villas', compact('comfort_villas', 'listComfortVilla', 'type', 'title'));
    }

    public function updateComfortVillas(Request $request)
    {
        try {
            $type = $request->type;
            if($type != Comforts::RM) {
                $listVilla = Hotels::where('type', $type)
                    ->where('status', 1)
                    ->pluck('id');

                $comfort_villas = Comforts::where('type', $type)->where('status', 1)->pluck('id')->toArray();
                $listComfort = $request->list_comfort ?? [];
                if($listComfort) {
                    $idAdd = array_intersect($comfort_villas, $listComfort);
                    $idDel = array_diff($comfort_villas, $idAdd);
                    Comforts::whereIn('id', $idAdd)->update(['check' => $type]);
                    Comforts::whereIn('id', $idDel)->update(['check' => null]);
                    foreach ($listComfort as $comfort) {
                        // Loop through each villa
                        foreach ($listVilla as $villaId) {
                            // Check if the comfort is already assigned to the villa
                            $exists = DB::table('hotel_comforts')
                                ->where('hotel_id', $villaId)
                                ->where('comfort_id', $comfort)
                                ->exists();

                            // If the comfort is not assigned, insert a new record
                            if (!$exists) {
                                DB::table('hotel_comforts')->insert([
                                    'hotel_id' => $villaId,
                                    'comfort_id' => $comfort,
                                    'created_at' => now(),
                                ]);
                            }
                        }
                    }
                }

                // Check and remove comforts not selected
                $allComforts = DB::table('hotel_comforts')
                    ->whereIn('hotel_id', $listVilla)
                    ->groupBy('comfort_id')
                    ->havingRaw('COUNT(DISTINCT hotel_id) = ?', [count($listVilla)])
                    ->pluck('comfort_id');

                $comfortsToRemove = $allComforts->diff($listComfort);

                if ($comfortsToRemove->isNotEmpty()) {
                    DB::table('hotel_comforts')
                        ->whereIn('comfort_id', $comfortsToRemove)
                        ->whereIn('hotel_id', $listVilla)
                        ->delete();
                }
            } else  {
                $listRoom = Rooms::where('status', 1)
                    ->pluck('id');
                $comfort_rooms = Comforts::where('type', $type)->where('status', 1)->pluck('id')->toArray();
                $listComfort = $request->list_comfort ?? [];
                if($listComfort) {
                    $idAdd = array_intersect($comfort_rooms, $listComfort);
                    $idDel = array_diff($comfort_rooms, $idAdd);
                    Comforts::whereIn('id', $idAdd)->update(['check' => $type]);
                    Comforts::whereIn('id', $idDel)->update(['check' => null]);
                    foreach ($listComfort as $comfort) {
                        // Loop through each villa
                        foreach ($listRoom as $roomId) {
                            // Check if the comfort is already assigned to the villa
                            $exists = DB::table('room_comforts')
                                ->where('room_id', $roomId)
                                ->where('comfort_id', $comfort)
                                ->exists();

                            // If the comfort is not assigned, insert a new record
                            if (!$exists) {
                                DB::table('room_comforts')->insert([
                                    'room_id' => $roomId,
                                    'comfort_id' => $comfort,
                                    'created_at' => now(),
                                ]);
                            }
                        }
                    }
                }

                // Check and remove comforts not selected
                $allComforts = DB::table('room_comforts')
                    ->whereIn('room_id', $listRoom)
                    ->groupBy('comfort_id')
                    ->havingRaw('COUNT(DISTINCT room_id) = ?', [count($listRoom)])
                    ->pluck('comfort_id');

                $comfortsToRemove = $allComforts->diff($listComfort);

                if ($comfortsToRemove->isNotEmpty()) {
                    DB::table('room_comforts')
                        ->whereIn('comfort_id', $comfortsToRemove)
                        ->whereIn('room_id', $listRoom)
                        ->delete();
                }
            }

            return redirect()->back()->withInput()->with('message-success', 'Cập nhật thành công!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('message-error', 'Cập nhật không thành công!');
        }

    }

    public function listComfort(Request $request) {
        $type = $request->type;
        $listComfortAll = Comforts::where('type', $type)->where('check', $type)->where('status', 1)->get();
        return view('backend.comforts.list_comfort', compact('listComfortAll', 'type'));
    }
}
