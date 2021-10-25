<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsCartContoller extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->get();
        $products = [];
        $quantities = [];
        $totalMrp = 0;
        $totalDiscount = 0;
        $totalAmount = 0;
        $deliveryCharge = 40;
        foreach($cart as $c) {
            $tempProduct = Product::where('id' , $c->product_id)->get();
            $quantity = $c->quantity;
            $totalMrp = $totalMrp + $tempProduct[0]->mrp * $c->quantity;
            $totalDiscount = $totalDiscount + (($tempProduct[0]->discount * $tempProduct[0]->mrp)/100) * $c->quantity;
            $product = [$tempProduct , $quantity];
            array_push($products , $product);
        }
        $totalAmount = $totalMrp - $totalDiscount;
        return view('cart.index', compact(['products', 'totalMrp', 'totalDiscount', 'totalAmount', 'deliveryCharge']));
    }


}
