<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use App\Models\Product;
use App\Models\Kart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    public function stripe(){
        return view('stripe/stripe');
    }

    public function stripePost(Request $request){
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $request->sum,
                'currency' => 'jpy'
            ));

            $karts = Kart::where('user_id', $request->user_id)->get();
            foreach($karts as $kart){
                $kart->del_flag = 1;
                $kart->save();
                $quantity = $kart->quantity;
                $product = Product::where('id', $kart->product_id)->first();
                $product->stock = $product->stock - $quantity;
                $product->save();
            }

            return view('product/thanks');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
