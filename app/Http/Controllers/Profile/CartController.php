<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {
        /**
         * if state is null or paid
         * send with query string
         */
        if($request->query())
            $carts = Cart::where('user_id', $request->user()->id)
                ->where('state', $request->query('state'))
                ->get()
                ->toArray();

        if($carts)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $carts,
            ], 200);
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
        // $userId = Cart::where('user_id', $request->user()->id)->first();
        // dd($cart);
        // $cart = Cart::where('product_id', $request->input('product_id'))->first();
        // dd($cart);
        $cart = Cart::whereNull('state')
            ->where('user_id', $request->user()->id)
            ->where('product_id', $request->input('product_id'))
            ->first();

        if(!is_null($cart)) {
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
        $cart = Cart::whereNull('state')
            ->where('user_id', $request->user()->id)
            ->where('product_id', $request->input('product_id'))
            ->first();
        if($cart->delete())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }
}
