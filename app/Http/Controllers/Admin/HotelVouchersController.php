<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelComforts;
use App\Models\Hotels;
use App\Models\HotelVouchers;
use App\Models\Vouchers;
use Doctrine\DBAL\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HotelVouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.hotel_vouchers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $voucher = Vouchers::find($id);
        $vouchers = Vouchers::where('id', '!=', $voucher->id)->where('status', 1);
        $hotels = Hotels::where('status', 1)->get();
        return view('backend.hotel_vouchers.create', compact('voucher', 'vouchers', 'hotels'));
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

            $list_hotel = [];
            $list_hotel = $request->input('list_hotel');

            foreach ($list_hotel as $item => $value) {
                $data = [
                    'hotel_id' => $value,
                    'voucher_id' => $request->voucher_id,
                ];
                HotelVouchers::create($data);
            }

            \DB::commit();

            return redirect()->route('vouchers.index');
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollback();
            return redirect()->back()->with('message-error', 'Lỗi khi tạo, vui lòng thử lại sau');
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
        $hotel_voucher = HotelVouchers::find($id);
        $hotels = Hotels::where('status', 1)->get();
        $hotel_vouchers = HotelVouchers::where('voucher_id', $hotel_voucher->voucher_id)->pluck('hotel_id')->toArray();
        return view('backend.hotel_vouchers.edit', compact( 'hotel_voucher', 'hotels', 'hotel_vouchers'));
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
            $list_hotel = [];
            $list_hotel = $request->input('list_hotel');

            $hotel_voucher = HotelVouchers::where('voucher_id', $request->voucher_id)->pluck('hotel_id')->toArray();

            if ($list_hotel) {
                $idDel = array_diff($hotel_voucher, $list_hotel);
                $idAdd = array_diff($list_hotel, $hotel_voucher);
                foreach ($idAdd as $item => $value) {
                    $datas = [
                        'voucher_id' => $request->voucher_id,
                        'hotel_id' => $value,
                    ];
                    HotelVouchers::create($datas);
                }
                HotelVouchers::where('voucher_id', $request->voucher_id)->whereIn('hotel_id', $idDel)->delete();
            }
            return redirect()->route('vouchers.index');
        } catch (Exception $e) {
            return redirect->back()->with('message-error', 'Đã có lỗi khi cập nhật, vui lòng thử lại sau');
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
        $voucher = HotelVouchers::find($id);

        if (empty($voucher)) {
            return redirect()->back();
        }
        $voucher->delete();
        return redirect()->back();
    }
}
