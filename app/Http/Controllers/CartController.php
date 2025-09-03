<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.carts.index');
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
        //
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
        //
    }

    public function addToCart(Request $request)
    {
        $id = $request->id;
        $number = $request->number;

        $product = Product::find($id);

        $cart = Session::get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $number;
        } else {
            $cart[$id] = [
                "product_id" => $id,
                "name" => $product->name,
                "image" => $product->image,
//                "quantity" => $number,
                "price" => $product->price,
            ];
        }

        $order = $cart[$id];
        session()->put('cart', $cart);

        return view('frontend.carts.list_cart', compact('order'));
    }

    public function addToListCart(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
//        $number = $request->number;
        $cart = Session::get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $number;
        } else {
            $cart[$id] = [
                "product_id" => $id,
                "name" => $product->name,
                'option_id' => null,
                "image" => $product->image,
//                    "quantity" => $number,
                "price" => $product->sale ?? $product->price,
            ];
        }


        session()->put('cart', $cart);

        return view('frontend.carts.index');
    }

    public function removeProduct(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }

            return view('frontend.carts.list_cart');
        }
    }

    public function removeProductCart(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return view('frontend.carts.list_product');
    }

    public function updateNumberCheckout(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $cart = session()->get('cart');
//        $cart[$id]["quantity"] = $quantity;
        session()->put('cart', $cart);
        return view('frontend.carts.list_product');
    }


}
