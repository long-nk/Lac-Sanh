<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedules;
use App\Models\Tours;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tour = Tours::find($request->id);
        $schedules = Schedules::where('tour_id', $request->id)->get();
        return view('backend.schedules.index', compact('schedules', 'tour'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tour = Tours::find($request->id);
        return view('backend.schedules.create', compact('tour'));
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
            'detail' => $request->detail,
            'status' => $request->status,
            'sort' => $request->sort
        ];

        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('message-error', 'Tên và thông tin chi tiết không được để trống');
        } else {
            try {
                \DB::beginTransaction();

                schedules::create($data);

                \DB::commit();

                return redirect()->route('schedules.index', ['id' => $request->tour_id])->with('message-success', 'Thêm mới lịch trình thành công!');
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
        $schedule = Schedules::find($id);
        return view('backend.schedules.edit', compact('schedule'));
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
            'detail' => $request->detail,
            'sort' => $request->sort,
            'status' => $request->status
        ];


        $validator = \Validator::make($data, [
            'name' => 'required|max:255',
            'detail' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('message-error', 'Tên và thông tin lịch trình không được để trống');
        } else {
            try {
                \DB::beginTransaction();

                $schedule = schedules::find($id);

                $schedule->update($data);

                \DB::commit();
                return redirect()->route('schedules.index', ['id' => $schedule->tour_id])->with('message-success', 'Cập nhật thành công!');
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollback();
                return redirect()->back()->withInput()->with('message-error', 'Cập nhật lịch trình thất bại!');

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
        $schedule = schedules::find($id);

        if (empty($schedule)) {
            return redirect()->back()->withInput()->with('message-error', 'Không tìm thấy lịch trình');
        }
        $schedule->delete();
        return redirect()->back()->withInput()->with('message-success', 'Xóa lịch trình thành công!');
    }
}
