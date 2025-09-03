<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Mail\ApproveOrder;
use App\Mail\CheckoutSuccess;
use App\Mail\MailRegisterSuccess;
use App\Mail\UnApprovedOrder;
use App\Models\Hotels;
use App\Models\Order;
use App\Models\Orders;
use App\Models\PageInfo;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class OrdersController extends Controller {

    public function index() {
        $orders = Orders::with('room')->orderBy('created_at', 'desc')->get();
        return view('backend.orders.index', compact('orders'));
    }

    public function show() {

    }

    public function edit($id) {
        $data = Orders::with('room')->find($id);
        return view('backend.orders.edit', compact('data'));
    }

    public function approveOrder(Request $request) {
        try {
            DB::beginTransaction();
            $order = Orders::find($request->order);
            $order->status = Orders::DAT_THANH_CONG;
            $hotel = Hotels::find($order->room->hotel_id);
            $hotel->booked_room += $order->number;
            if($hotel->booked_room <= $hotel->room) {
                $hotel->save();
                $order->save();
                Mail::to($order->email)->send(new ApproveOrder($order));
                DB::commit();
                return redirect()->back()->with('message-success', 'Duyệt đơn thành công!');
            } else {
                DB::rollBack();
                return redirect()->back()->with('message-error', 'Số phòng trống không đủ. Hãy kiểm tra lại');
            }
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', 'Xảy ra lỗi khi duyệt!');
        }
    }

    public function approveOrderVilla(Request $request) {
        try {
            DB::beginTransaction();
            $order = Orders::find($request->order);
            $order->price = $request->price ?? 0;
            $order->voucher = $request->voucher ?? 0;
            $order->surcharge = $request->surcharge ?? 0;
            $order->vat = $request->vat ?? 0;
            $order->total = $request->total ?? 0;
            $order->status = Orders::DAT_THANH_CONG;
            $hotel = Hotels::find($order->hotel_id);
            $hotel->booked_room += $order->number;
            if($hotel->booked_room <= $hotel->room) {
                $hotel->save();
                $order->save();
                Mail::to($order->email)->send(new ApproveOrder($order));
                DB::commit();
                return redirect()->back()->with('message-success', 'Duyệt đơn thành công!');
            } else {
                DB::rollBack();
                return redirect()->back()->with('message-error', 'Số phòng trống không đủ. Hãy kiểm tra lại');
            }
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', 'Xảy ra lỗi khi duyệt!');
        }
    }

    public function unApproveOrder(Request $request) {
        try {
            DB::beginTransaction();
            $order = Orders::find($request->order);
            $order->status = Orders::HUY_DON;
            $order->save();
            Mail::to($order->email)->send(new UnApprovedOrder($order));
            DB::commit();
            return redirect()->back()->with('message-success', 'Hoàn tất trả phòng!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', 'Đã có lỗi khi trả phòng!');
        }
    }

    public function checkout(Request $request) {
        try {
            DB::beginTransaction();
            $order = Orders::find($request->order);
            $order->status = Orders::HOAN_THANH;
            $hotel = Hotels::find(@$order->room->hotel_id);
            if(!empty($hotel)) {
                $hotel->booked_room -= $order->number;
                if($hotel->booked_room < 0) {
                    $hotel->booked_room = 0;
                }
                $hotel->save();
                $order->save();
                Mail::to($order->email)->send(new CheckoutSuccess($order));
                DB::commit();
                return redirect()->back()->with('message-success', 'Hoàn tất trả phòng!');
            }
            return redirect()->back()->with('message-error', 'Không tìm thấy thông tin khách sạn. Vui lòng kiểm tra lại!');

        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', 'Đã có lỗi khi trả phòng!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $order = Orders::find($id);
            $order->status = $request->status;
            $order->save();
            return redirect()->route('orders.index')->with('message-success', 'Cập nhật trạng thái thành công!');
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', 'Xảy ra lỗi khi cập nhật trạng thái!');
        }

    }

    public function exportCSV() {
        $q = new OrderExport();
        return Excel::download($q, 'danh_sach_don_hang.xlsx');
    }


    public function destroy($id){
        try {
            $order = Orders::find($id);
            $order->delete();
            return redirect()->back()->with('message-success', 'Xóa thành công!');
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-success', 'Lỗi khi xóa đơn!');
        }
    }

}
