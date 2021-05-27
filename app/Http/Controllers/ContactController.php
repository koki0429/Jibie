<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactSendmail;
use App\Mail\SettlementSendmail;
use App\Models\kart;
use App\Models\User;
use App\Models\Product;

class ContactController extends Controller
{
    public function index(){
        return view('contact/index');
    }

    public function confirm(Request $request){
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'content' => 'required'
        ]);

        $inputs = $request->all();

        return view('contact.confirm', ['inputs' => $inputs]);
    }

    public function send(Request $request){
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'content' => 'required'
        ]);

        $action = $request->input('action');

        $inputs = $request->except('action');

        if($action !== 'submit'){
            return redirect()
                ->route('contact.index')
                ->withInput($inputs);
        }else{
            \Mail::to($inputs['email'])->send(new ContactSendmail($inputs));

            $request->session()->regenerateToken();

            return view('contact.thanks');
        }
    }

    public function sendAfterSettlement(Request $request){
        $user_id = $request->user_id;
        $karts = Kart::where('user_id', $user_id)->where('del_flag', '0')->get();
        $products = [];
        foreach($karts as $kart){
            $products[] = Product::where('id', $kart->product_id)->get();
        }
        $user = User::where('id', $user_id)->first();

        $datas = [
            'name' => $request->name,
            'karts' => $karts,
            'email' => $user->email,
            'sum' => $request->sum,
            'products' => $products,
            'date' => $request->date,
            'time' => $request->time
        ];

        \Mail::to($user['email'])->send(new SettlementSendmail($datas));

        $request->session()->regenerateToken();

        return view('product.index');
    }
}
