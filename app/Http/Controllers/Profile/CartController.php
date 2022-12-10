<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {

    }

    public function addToCart(Request $request)
    {
        // $values = $request->user()->carts->first();
        // dd($values);
        // dd(unserialize($values->attributes['id']));


        // $user = Cart::where('user_id', $request->input('user_id'))->get()->pluck('id');
        // dd($cart);
        // if(!is_null($cart)) {

        // }
        // // $cart = Cart::where('user_id', $request->input('user_id'))->get();
        // dd($cart);
        // $cart = new Cart();
        $cart = Cart::whereNull('state')->first();

        if(!is_null($cart)){
            $cart = Cart::where('product_id', $request->input('product_id'))->first();
            $cart->product()->associate($request->input('product_id'));
            $cart->user()->associate($request->user()->id);
            $cart->qty = $request->input('qty');
            if($cart->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
        } else {
        $cart = new Cart();
        $cart->product()->associate($request->input('product_id'));
        $cart->user()->associate($request->user()->id);
        $cart->qty = $request->input('qty');
        if($cart->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
        }
    }

    public function removeFromCart(Request $request)
    {

    }
}
