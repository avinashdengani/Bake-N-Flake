<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use app\Models\User;

class OrderSuccesfull extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public User $user;
    public $transactions = [];
    public $products = [];
    public $quantities = [];
    public $amounts = [];
    public $order_id;
    public function __construct(User $user, $transactions)
    {
        $this->user = $user;
        $this->transactions = $transactions;
        $this->order_id = $this->transactions[0]->order_id;
        foreach($this->transactions as $transaction) {
            $product = Product::where('id', $transaction->product_id)->get();
            array_push($this->products, $product);
            array_push($this->quantities, $transaction->quantity);
            array_push($this->amounts, $transaction->amount);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orderSuccessfull')->subject('Congratulations! ' . $this->user->name .' your order has been placed succesfully');
    }
}
