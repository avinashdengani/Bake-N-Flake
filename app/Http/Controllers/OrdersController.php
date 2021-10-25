<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{
    public function index()
    {
        Gate::authorize('admin');
        auth()->user()->unreadNotifications->markAsRead();
        $orders = [];
        $amounts = array(array());
        $quantities = array(array());
        $users = [];
        $transactions = Transaction::latest('updated_at')->paginate(10);
        foreach($transactions as $transaction) {
            array_push($orders,  $transaction->order_id);
            $amounts[$transaction->order_id][] = $transaction->amount;
            $quantities[$transaction->order_id][] = $transaction->quantity;
        }
        $orders = array_unique($orders);
        $dates = [];
        $allOrderWiseTransactions = [];
        foreach($orders as $order) {
            $orderWiseTransaction = Transaction::where('order_id', $order)->get();
            array_push($dates, $orderWiseTransaction[0]->created_date);
            array_push($users, User::where('id', $orderWiseTransaction[0]->user_id)->first());
            array_push($allOrderWiseTransactions, $orderWiseTransaction);
        }
        $finalOrders = array(array());
        foreach($allOrderWiseTransactions as $allOrderWiseTransaction) {

            foreach($allOrderWiseTransaction as $transaction){
                $product = array(
                    'product' => Product::where('id', $transaction->product_id)->get()
                );
                $finalOrders[$transaction->order_id][] = $product;
            }
        }
        return view('orders.index', compact(['finalOrders', 'orders', 'dates', 'amounts', 'quantities', 'users']));
    }
    public function yourOrders()
    {
        $transactions = auth()->user()->transactions()->latest('created_at')->get();
        $orders = [];
        $allOrderWiseTransactions = [];
        $amounts = array(array());
        $quantities = array(array());

        foreach($transactions as $transaction) {
            array_push($orders,  $transaction->order_id);
            $amounts[$transaction->order_id][] = $transaction->amount;
            $quantities[$transaction->order_id][] = $transaction->quantity;
        }
        $orders = array_unique($orders);
        $dates = [];
        foreach($orders as $order) {
            $orderWiseTransaction = Transaction::where('order_id', $order)->get();
            array_push($dates, $orderWiseTransaction[0]->created_date);
            array_push($allOrderWiseTransactions, $orderWiseTransaction);
        }
        $finalOrders = array(array());
        foreach($allOrderWiseTransactions as $allOrderWiseTransaction) {

            foreach($allOrderWiseTransaction as $transaction){
                $product = array(
                    'product' => Product::where('id', $transaction->product_id)->get()
                );
                $finalOrders[$transaction->order_id][] = $product;
            }
        }
        return view('orders.your-orders', compact(['finalOrders', 'orders', 'dates', 'amounts', 'quantities']));
    }
}
