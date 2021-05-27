<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\kart;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return view('product/index', compact('products'));
    }

    public function show($id){
        $product = Product::findOrFail($id);

        return view('product/show', compact('product'));
    }

    public function about(){
        return view('product/about');
    }

    public function kart(Request $request){
        if(empty($request->user_id)){
            session()->flash('flash_message', 'カートに入れるためには、ログインしてください。');
            return view('product/index');
        }else{
            $searchs = Kart::get()->where('user_id', $request->user_id)->where('del_flag', '0');
            foreach($searchs as $search){
                $products[] = Product::get()->where('id', $search->product_id);
                $quantity[] = $search->quantity;
            }

            if(empty($products)){
                return view('product/kart');
            }else{
                return view('product/kart', compact('products', 'quantity'));
            }
        }
    }

    public function kartCreate(Request $request){
        if(!empty($request->notproduct)){
            session()->flash('flash_messageShow', '在庫不足のため、カートに入れることができません。');
            return $this->show($request->product_id);
        }

        $judge = Kart::where('user_id', $request->user_id)->where('product_id', $request->product_id)->where('del_flag', '0')->first();
        if(empty($request->user_id)){
            $products = Product::all();

            session()->flash('flash_message', 'カートに入れるためには、ログインしてください。');
            return view('product/index', compact('products'));
        }else if(empty($judge)){
            $kart = new kart();
            $kart->product_id = $request->product_id;
            $kart->quantity = $request->quantity;
            $kart->user_id = $request->user_id;
            $kart->save();

            $searchs = Kart::get()->where('user_id', $request->user_id)->where('del_flag', '0');
            foreach($searchs as $search){
                $products[] = Product::get()->where('id', $search->product_id);
                $quantity[] = $search->quantity;
            }

            return view('product/kart', compact('products', 'quantity'));
        }else{
            $searchs = Kart::get()->where('user_id', $request->user_id)->where('del_flag', '0');
            foreach($searchs as $search){
                $products[] = Product::get()->where('id', $search->product_id);
                $quantity[] = $search->quantity;
            }

            session()->flash('flash_messageKart', 'すでにカートに入っています。');
            return view('product/kart', compact('products', 'quantity'));
        }
    }

    public function kartChange(Request $request){
        if($request->update == '更新'){
            $kart = Kart::where('user_id', $request->user_id)->where('product_id', $request->product_id)->where('del_flag', '0')->first();
            $kart->quantity = $request->quantity;
            $kart->save();
        }else if($request->delete == '削除'){
            $kart = Kart::where('user_id', $request->user_id)->where('product_id', $request->product_id)->where('del_flag', '0')->first();
            $kart->delete();
        }

        $searchs = Kart::where('user_id', $request->user_id)->where('del_flag', '0')->get();
        if(empty($searchs[0])){
            return $this->index();
        }else{
            foreach($searchs as $search){
                $products[] = Product::get()->where('id', $search->product_id);
                $quantity[] = $search->quantity;
            }

            return view('product/kart', compact('products', 'quantity'));
        }
    }

    public function thanks(){
        return view('product/thanks');
    }
}
