<?php

namespace App\Http\Controllers;

use App\Product;
use Cart;
use Illuminate\Http\Request;
use Session;

class ShoppingController extends Controller
{
    public function addToCart()
    {
        $product = Product::find(request()->product_id);
        $cartItem = Cart::add([
            'id'    => $product->id,
            'name'  => $product->name,
            'qty'   => request()->qty,
            'price'  => $product->price,
            'weight' => 0
        ]);

        Cart::associate($cartItem->rowId,'App\Product');

        Session::flash('success', 'Product Added to Cart');

        return redirect()->route('cart');
    }
    public function cart()
    {
        //Cart::destroy();
        return view('cart');
    }

    public function cartDelete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }

    public function cartIncrease($id, $qty)
    {
        Cart::update($id, $qty+1);
        return redirect()->back();
    }

    public function cartDecrease($id, $qty)
    {
        Cart::update($id, $qty - 1);
        return redirect()->back();
    }

    public function rapidAdd($id)
    {
        $product = Product::find($id);
        $cartItem = Cart::add([
            'id'    => $product->id,
            'name'  => $product->name,
            'qty'   => 1,
            'price' => $product->price,
            'weight'=> 0
        ]);

        Cart::associate($cartItem->rowId, 'App\Product');

        Session::flash('success', 'Product Added to Cart');

        return redirect()->route('cart');
    }

}