<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Mail\PurchaseSuccessful;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Cart::content()->count() == 0)
        {
            Toastr::info('Your cart is still empty. do some shopping','info');
            return redirect()->back();
        }
        return view('checkout');
    }


    public function pay()
    {
        Stripe::setApiKey("sk_test_XF7FlOXny7sMnUl1rJZSkoko");
    
        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'selling books',
            'source' => request()->stripeToken
        ]);

        //Session::flash('success', 'Purchase successfull. wait for our email.');
       

        Cart::destroy();

        Mail::to(request()->stripeEmail)->send(new PurchaseSuccessful);
        Toastr::success('Purchase successfull. wait for our email.','Success');
        
        return redirect('/');
    }
}
