@extends('layout.common')
@section('title', '詳細ページ')
@section('pageCss')
<link rel="stylesheet" href="/assets/css/product/show.css">
@endsection
@section('pageJs')
<script src="{{asset('/assets/javascript/flash.blade.js')}}"></script>
@endsection
@include('layout.header')
@section('content')
    @if(session('flash_messageShow'))
        <div class="flash_message attention">
            <h2>{{ session('flash_messageShow') }}</h2>
        </div>
    @endif
    <div class="p-productShow">
        <div class="p-prShow_img">
            <img src="{{asset('storage/' . $product->image)}}" class="c-img_showProduct" alt="商品画像">
        </div>
        <div class="p-prShow_details">
            {{ Form::open(['route' => 'product.kartCreate']) }}
                {{ Form::hidden('product_id', $product->id) }}
                <h3 class="proShow_name">{{$product -> name}}</h3>
                <?php $price = number_format($product->price); ?>
                <p class="p-proShow_detail"><span>価格：<?php echo $price; ?></span></p>
                <p class="p-proShow_detail"><span>在庫数：{{$product -> stock}}</span></p>
                <p class="p-proShow_detail p-proShow_desc"><span>商品紹介 : {{$product -> detail}}</span></p>
                <p class="p-proShow_detail">注文数 : {{ Form::number('quantity', 1, ['class' => 'c-inputNumber', 'min' => 1, 'max' => $product->stock]) }}</p>
                <div class="p-reactionButton">
                    @if($product->stock > 0)
                        <input type="submit" class="p-kartIn p-rctBtn" value="カートに入れる">
                    @else
                        <input type="submit" name="notproduct" class="p-kartIn p-rctBtn" value="カートに入れる">
                    @endif
                </div>
                @auth
                    {{ Form::hidden('user_id', Auth::user()->id) }}
                @endauth
            {{ Form::close() }}
        </div>
    </div>
@endsection
@include('layout.footer')
