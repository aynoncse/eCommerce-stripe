<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseSuccessfull;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Cart;
use Illuminate\Support\Facades\Mail;
use Session;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }
    public function pay(){
        Stripe::setApiKey('sk_test_tJfFvFkHTiv6MLtZuK5jSScn00eZ1FZvgz');
        //dd(request()->all());
        $token = request()->stripeToken;
        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'Ecommerce Practive Selling Books',
            'source' => $token,
        ]);

        Session::flash('success', 'Purchase successfull, please check your email');
        Cart::destroy();

        Mail::to(request()->stripeEmail)->send(new PurchaseSuccessfull);

        return redirect('/');
    }
}
