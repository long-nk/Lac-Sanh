<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comforts;
use App\Models\HotelVouchers;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use File;
use Image;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Vouchers::with('hotels', 'hotelVouchers')->get();
        return view('backend.vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vouchers.create');
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
            'code' => $request->code,
            'percent' => $request->percent,
            'term' => $request->term,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'time' => $request->time,
            'number' => $request->number,
            'cost' => $request->cost
        ];

        $validator = \Validator::make($data, [
            'code' => 'required|max:255',
            'percent' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('message-error', 'Mã voucher và phần trăm không được để trống');
        } else {
            try {
                \DB::beginTransaction();

                $path = "images/vouchers";
                $image = $request->image;
                $file_path = "";
                if ($request->image) {
                    $extension = $image->extension();
                    $file_name = "voucher_" . time() .  '.' . $extension;
                    $file_path = $path . '/' . $file_name;
                    $image->move($path . '/', $file_name);
                    $data['image'] = $file_path;
                }

                $list_type = [];
                $list_type = $request->input('list_type');

                if(!empty($list_type)) {
                    foreach ($list_type as $item => $value) {
                        if(in_array(Comforts::KS, $list_type)) {
                            $data['hotel'] = 1;
                        } else {
                            $data['hotel'] = 0;
                        }
                        if(in_array(Comforts::TO, $list_type)) {
                            $data['tour'] = 1;
                        } else {
                            $data['tour'] = 0;
                        }
//                        if(in_array(Comforts::RS, $list_type)) {
//                            $data['resort'] = 1;
//                        } else {
//                            $data['resort'] = 0;
//                        }
//                        if(in_array(Comforts::HS, $list_type)) {
//                            $data['homestay'] = 1;
//                        } else {
//                            $data['homestay'] = 0;
//                        }
//                        if(in_array(Comforts::DT, $list_type)) {
//                            $data['yacht'] = 1;
//                        } else {
//                            $data['yacht'] = 0;
//                        }
                    }

                }

                Vouchers::create($data);

                \DB::commit();

                return redirect()->route('vouchers.index');
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollback();
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
        $voucher = Vouchers::find($id);
        return view('backend.vouchers.edit', compact('voucher'));
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
            'status' => $request->status,
            'code' => $request->code,
            'percent' => $request->percent,
            'term' => $request->term,
            'start_date' => $request->start_date,
            'time' => $request->time,
            'number' => $request->number,
            'cost' => $request->cost
        ];


        $validator = \Validator::make($data, [
            'code' => 'required|max:255',
            'percent' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('message-error', 'Mã giảm giá và phần trăm không được để trống');
        } else {
            try {
                \DB::beginTransaction();

                $voucher = Vouchers::find($id);

                $path = "images/vouchers";
                $image = $request->image;
                if ($image) {
                    if(\Illuminate\Support\Facades\File::exists($voucher->image)) {
                        File::delete($voucher->image);
                    }
                    $extension = $image->extension();
                    $file_name = "voucher_" . time() . '.' . $extension;
                    $file_path = $path . '/' . $file_name;
                    $image->move($path . '/', $file_name);
                    $data['image'] = $file_path;
                }

                $list_type = [];
                $list_type = $request->input('list_type');

                if(!empty($list_type)) {
                    foreach ($list_type as $item => $value) {
                        if(in_array(Comforts::KS, $list_type)) {
                            $data['hotel'] = 1;
                        } else {
                            $data['hotel'] = 0;
                        }
                        if(in_array(Comforts::TO, $list_type)) {
                            $data['tour'] = 1;
                        } else {
                            $data['tour'] = 0;
                        }
//                        if(in_array(Comforts::RS, $list_type)) {
//                            $voucher->resort = 1;
//                        } else {
//                            $voucher->resort = 0;
//                        }
//                        if(in_array(Comforts::HS, $list_type)) {
//                            $voucher->homestay = 1;
//                        } else {
//                            $voucher->homestay = 0;
//                        }
//                        if(in_array(Comforts::DT, $list_type)) {
//                            $voucher->yacht = 1;
//                        } else {
//                            $voucher->yacht = 0;
//                        }
                    }

                }

                $voucher->update($data);

                \DB::commit();
                return redirect()->route('vouchers.index');
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollback();
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
        $voucher = Vouchers::find($id);

        if (empty($voucher)) {
            return redirect()->back();
        }
        $voucher->delete();
        return redirect()->back();
    }
}
