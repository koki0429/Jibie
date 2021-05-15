@extends('layout.common')
@section('title', 'トップページ')
@section('pageCss')
<link rel="stylesheet" href="/assets/css/product/index.css">
@endsection
@section('pageJs')
<script src="{{asset('/assets/javascript/index.blade.js')}}"></script>
<script src="{{asset('/assets/javascript/button.blade.js')}}"></script>
<script src="{{asset('/assets/javascript/flash.blade.js')}}"></script>
@endsection
@include('layout.header')
@section('content')
    @if(session('flash_message'))
        <div class="flash_message attention">
            <h2>{{ session('flash_message') }}</h2>
        </div>
    @endif
    <div class="c-button scroll_up" id="scroll_to_top">top</div>
    <div class="p-main_introduction">
        <h1 class="p-main_introductionTitle">宮崎の肉。</h1>
        <p class="p-main_introductionText">
            自然豊かな森で育った天然のジビエ。<br>
            良質な脂、筋肉質な赤み肉。<br>
            一回食べてみてん。<br>
        </p>
    </div>
    <div class="p-main_cook load_up">
        <h2 class="c_title">Cooking</h2>
        <article class="p-main_cookContents">
            <div class="p-main_cookBox">
                <img class="c-img_cooking" src="/assets/images/logo_main_cokking.jpg" alt="料理の画像">
                <h3 class="p-main_cookName">鹿の刺身</h3>
                <p class="p-main_cookDesc">
                    臭みのない鹿の刺身。<br>
                    しょうが醤油が一番合います。<br>
                    日本酒のお供にどうぞ。
                </p>
            </div>
            <div class="p-main_cookBox">
                <img class="c-img_cooking" src="/assets/images/logo_main_cokking.jpg" alt="料理の画像">
                <h3 class="p-main_cookName">鹿の刺身</h3>
                <p class="p-main_cookDesc">
                    臭みのない鹿の刺身。<br>
                    しょうが醤油が一番合います。<br>
                    日本酒のお供にどうぞ。
                </p>
            </div>
            <div class="p-main_cookBox">
                <img class="c-img_cooking" src="/assets/images/logo_main_cokking.jpg" alt="料理の画像">
                <h3 class="p-main_cookName">鹿の刺身</h3>
                <p class="p-main_cookDesc">
                    臭みのない鹿の刺身。<br>
                    しょうが醤油が一番合います。<br>
                    日本酒のお供にどうぞ。
                </p>
            </div>
        </article>
    </div>
    <div id="jump_product"></div>
    <div class="products scroll_up">
        <h2 class="c_title">Products</h2>
        <section class="product">
            <?php $i = 0; ?>
            @foreach($products as $product)
            @if($i == 0 || $i % 3 == 0)
                <a class="p-product_anker productFix" href="/product/{{$product->id}}">
                    <img src="{{asset('storage/' . $product->image)}}" class="c-img_product" alt="商品画像">
                    <p class="p_name">{{$product->name}}</p>
                    <?php $price = number_format($product->price); ?>
                    <p class="p_price">¥<?php echo $price; ?></p>
                </a>
                <?php $i++; ?>
            @else
                <a class="p-product_anker" href="/product/{{$product->id}}">
                    <img src="{{asset('storage/' . $product->image)}}" class="c-img_product" alt="商品画像">
                    <p class="p_name">{{$product->name}}</p>
                    <?php $price = number_format($product->price); ?>
                    <p class="p_price">¥<?php echo $price; ?></p>
                </a>
                <?php $i++; ?>
            @endif
            @endforeach
        </section>
    </div>
@endsection
@include('layout.footer')
