<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourHotels;
use App\Models\Tours;
use Illuminate\Http\Request;
use File;
use Image;
class TourHotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tour = Tours::find($request->id);
        $hotels = TourHotels::where('tour_id', $request->id)->get();
        return view('backend.tour_hotels.index', compact('hotels', 'tour'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tour = Tours::find($request->id);
        return view('backend.tour_hotels.create', compact('tour'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'tour_id' => $request->tour_id,
            'rate' => $request->rate,
            'time' => $request->time,
            'status' => $request->status,
            'sort' => $request->sort
        ];

        $validator = \Validator::make($data, [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('message-error', 'Tên khách sạn không được để trống');
        } else {
            try {
                \DB::beginTransaction();

                $path = "images/tour_hotels";
                $image = $request->image;
                $file_path = "";
                if ($request->image) {
                    $extension = $image->extension();
                    $file_name = "tour_hotel_" . time() .  '.' . $extension;
                    $file_path = $path . '/' . $file_name;
                    $image->move($path . '/', $file_name);
                    $data['image'] = $file_path;
                }

                TourHotels::create($data);

                \DB::commit();

                return redirect()->route('tour_hotels.index', ['id' => $request->tour_id])->with('message-success', 'Thêm mới khách sạn thành công!');
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollback();
                return redirect()->back()->withInput()->with('message-error', 'Thêm mới thất bại!');
            }
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
        $hotel = TourHotels::find($id);
        return view('backend.tour_hotels.edit', compact('hotel'));
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
        $data = [
            'name' => $request->name,
            'rate' => $request->rate,
            'time' => $request->time,
            'status' => $request->status,
            'sort' => $request->sort
        ];

        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('message-error', 'Tên khách sạn không được để trống');
        } else {
            try {
                \DB::beginTransaction();

                $hotel = TourHotels::find($id);

                $path = "images/tour_hotels";
                $image = $request->image;
                if ($image) {
                    if(\Illuminate\Support\Facades\File::exists($hotel->image)) {
                        File::delete($hotel->image);
                    }
                    $extension = $image->extension();
                    $file_name = "tour_hotel_" . time() . '.' . $extension;
                    $file_path = $path . '/' . $file_name;
                    $image->move($path . '/', $file_name);
                    $hotel->image = $file_path;
                }

                $hotel->update($data);

                \DB::commit();
                return redirect()->route('tour_hotels.index', ['id' => $hotel->tour_id])->with('message-success', 'Cập nhật thành công!');
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollback();
                return redirect()->back()->withInput()->with('message-error', 'Cập nhật khách sạn thất bại!');

            }
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
        $hotel = TourHotels::find($id);

        if (empty($hotel)) {
            return redirect()->back()->withInput()->with('message-error', 'Không tìm thấy khách sạn');
        }
        $hotel->delete();
        return redirect()->back()->withInput()->with('message-success', 'Xóa khách sạn thành công!');
    }
}
