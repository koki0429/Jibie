@extends('layout.common')
@section('title', '詳細ページ')
@section('pageCss')
<link rel="stylesheet" href="/assets/css/product/show.css">
@endsection
@section('pageJs')
@endsection
@include('layout.header')
@section('content')
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
                <p class="p-proShow_detail">注文数 : {{ Form::number('quantity', 1, ['class' => 'c-inputNumber', 'min' => 1]) }}</p>
                <div class="p-reactionButton">
                    <input type="submit" class="p-kartIn p-rctBtn" value="カートに入れる">
                </div>
                @auth
                    {{ Form::hidden('user_id', Auth::user()->id) }}
                @endauth
            {{ Form::close() }}
        </div>
    </div>
@endsection
@include('layout.footer')
