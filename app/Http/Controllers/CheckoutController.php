<?php

namespace App\Http\Controllers;

use App\Mail\ApproveOrder;
use App\Models\Order;
use App\Models\PageInfo;
use App\Models\ProductOption;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataMail = [];
        try {

            $status = 0;

            $trans = Transaction::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment' => $request->payment,
                'note' => $request->notes,
                'total' => $request->total,
                'status' => $status,
            ]);

            $dataMail['donhang'] = $trans->toArray();
            if (session('cart')) {
                foreach (session('cart') as $id => $item) {
                    $order = Order::create([
                        'transaction_id' => $trans->id,
                        'product_id' => $id,
                        'quantity' => $item['quantity'],
                        'sale' => $item['price'],
                        'option_id' => @$item['option_id']
                    ]);
                    $order = null;
                    $cart = DB::table('orders')
                        ->select('orders.*', 'products.name', 'products.image', 'products.price')
                        ->join('products', 'products.id', '=', 'orders.product_id')
                        ->join('transactions', 'transactions.id', '=', 'orders.transaction_id')
                        ->where('orders.transaction_id', '=', $trans->id)
                        ->get();
                    $dataMail['donhang']['chitiet'][] = $cart;
                    $dataMail['donhang']['giohang'][] = $item;

                }

                $orders = session('cart');
                $pageInfo = PageInfo::first();
                Mail::to($trans['email'])->send(new SendMail($dataMail));
                Mail::to($pageInfo->email2)->send(new ApproveOrder($dataMail));
                session()->forget('cart');
                return view('frontend.orders.checkout_success', compact('trans', 'cart', 'orders'));
            }

        } catch (\Exception $e) {
            report($e);
            return redirect()->route('home');
        }
    }

    public function sendOrderMail($data)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function destroyCheckout(Request $request)
    {
        if ($request->id) {
            $trans = Transaction::where('id', '=', $request->id)->first();
            $trans->status = 2;
            $trans->reason = $request->reason;
            $trans->save();
            return view('frontend.orders.checkout_destroy');
        }
    }

}
