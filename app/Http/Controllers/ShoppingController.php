<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingController extends Controller
{
    public function add_to_cart()
    {
        $pdt = Product::find(request()->pdt_id);

        //return $pdt;
        
        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => request()->qty,
            'price' => $pdt->price
        ]);

        //dd(request()->all());
        //dd(Cart::content());
        Cart::associate($cartItem->rowId, 'App\Product');
        Toastr::success('Product added to cart successfully','Success');

        return redirect()->back();
    }

    public function cart()
    {
        //Cart::destroy();
        return view('cart');
    }


    public function cart_delete($id)
    {
        Cart::remove($id);
        Toastr::success('Product removed from cart successfully','Success');
        return redirect()->back();
    }

    public function incr($id, $qty)
    {
        //return $qty;
        Cart::update($id, $qty + 1);
        //Toastr::success('Product qunatity updated cart successfully','Success');
        return redirect()->back();
    }
    public function decr($id, $qty)
    {
        Cart::update($id, $qty - 1);

        Toastr::success('Product qunatity updated cart successfully','Success');
        //Session::flash('success', 'Product qunatity updated cart successfully');

        return redirect()->back();
    }


    public function rapid_add($id)
    {
        $pdt = Product::find($id);

        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => 1,
            'price' => $pdt->price
        ]);

        Cart::associate($cartItem->rowId, 'App\Product');

        Toastr::success('Product added to cart successfully','Success');

        return redirect()->back();
    }

}
