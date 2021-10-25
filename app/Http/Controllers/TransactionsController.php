<?php

namespace App\Http\Controllers;

use App\Mail\OrderSuccesfull;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\OrderGenerated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TransactionsController extends Controller
{

    public function index()
    {
        dd(auth()->user()->transactions());
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Category $category,  Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart()->get();
        $order_id = round( microtime(true) * 1000 ) . $user->id .$product->id . $category->id;
        $transactions = [];

        foreach($cart as $c) {
            $product = Product::where('id', $c->product_id)->get();
            $transaction = $user->transactions()->create([
                'quantity' => $c->quantity,
                'address' => $user->address,
                'mobile_no' => $user->mobile_no,
                'product_id' => $c->product_id,
                'order_id' => $order_id,
                'amount' => $product[0]->selling_price
            ]);
            array_push($transactions, $transaction);
            $c->delete();
        }

        retry(5, function () use ($user, $transactions) {
            Mail::to($user)->send(new OrderSuccesfull($user, $transactions));
        });
        $user = User::find(1);
        $user->notify(new OrderGenerated($user, $order_id));

        session()->flash('success', 'Order Successfull. Our team will contact you soon');
        return redirect()->back();
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function edit(Transaction $transaction)
    {
        //
    }

    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function destroy(Transaction $transaction)
    {
        //
    }
}
