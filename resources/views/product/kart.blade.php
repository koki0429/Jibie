@extends('layout.common')
@section('title', 'トップページ')
@section('pageCss')
<link rel="stylesheet" href="/assets/css/product/kart.css">
@endsection
@section('pageJs')
<script src="{{asset('/assets/javascript/flash.blade.js')}}"></script>
@endsection
@include('layout.header')
@section('content')
    @if(session('flash_messageKart'))
        <div class="flash_message attention">
            <h2>{{ session('flash_messageKart') }}</h2>
        </div>
    @endif
    <div class="karts">
        @if(!empty($products))
            <?php $i = 0; ?>
            @foreach($products as $key => $value)
                @foreach($value as $inkey => $product)
                {{ Form::open(['route' => 'product.kartChange']) }}
                    <div class="p-productShow p-kart">
                        <div class="p-prShow_img">
                            <img src="{{asset('storage/' . $product->image)}}" class="c-img_showProduct" alt="商品画像">
                        </div>
                        <div class="p-prShow_details">
                            <h3 class="proShow_name">{{$product -> name}}</h3>
                            <?php $price = number_format($product->price); ?>
                            <p class="p-proShow_detail"><span>価格：<?php echo $price; ?></span></p>
                            <p class="p-proShow_detail"><span>在庫数：{{$product -> stock}}</span></p>
                            <p class="p-proShow_detail p-proShow_desc"><span>商品紹介 : {{$product -> detail}}</span></p>
                            <p class="p-proShow_detail">注文数 : {{ Form::number('quantity', $quantity[$i], ['class' => 'c-inputNumber', 'min' => 1]) }}</p>
                            <div class="p-kartButtons">
                                {{ Form::submit('更新', ['name' => 'update', 'class' => 'p-kartButton p-rctBtn']) }}
                                {{ Form::submit('削除', ['name' => 'delete', 'class' => 'p-kartButton p-rctBtn', 'onclick' => "return confirm('本当に削除しますか?')"]) }}
                            </div>
                        </div>
                    </div>
                    <?php $sums[] = $product->price * $quantity[$i]; ?>
                    <?php $i++; ?>
                    {{ Form::hidden('user_id', Auth::user()->id) }}
                    {{ Form::hidden('product_id', $product->id) }}
                {{ Form::close() }}
                @endforeach
            @endforeach
            <div class="p-sumValue">
                <?php $sum = array_sum($sums); ?>
                <p class="p-sum">合計値 : ¥ <?php echo number_format($sum); ?></p>
            </div>
            <div class="content c-stripeButton">
                <form action="{{ route('stripe.post') }}" method="POST">
                    <div class="p-kartConfirm">
                        <div class="p-stripeDetails">
                            <label for="receiver" class="p-stripeDetail p-kartLabel">受取人</label><br>
                            <input class="p-stripeDetail" type="text" name="name" value="<?php echo Auth::user()->name; ?>"><p class="p-stripeDetail" style="display: inline-block;">様</p><br>
                            <label for="address" class="p-stripeDetail p-kartLabel">お届け先住所</label><br>
                            <input class="p-stripeDetail p-kartAddress" type="text" name="address" value="<?php echo Auth::user()->prefecture . Auth::user()->city . Auth::user()->address; ?>"><br>
                        </div>
                    </div>
                    {{ csrf_field() }}
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ env('STRIPE_KEY') }}"
                            data-amount="<?php echo $sum; ?>"
                            data-name="決済情報"
                            data-label="決済をする"
                            data-description="情報を入力してください"
                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                            data-locale="auto"
                            data-currency="JPY">
                        </script>
                        <input type="hidden" name="sum" value="<?php echo $sum; ?>">
                        <input type="hidden" name="user_id" value="<?php echo Auth::user()->id; ?>">
                </form>
            </div>
        @else
            <h2 class="p-kartNull">カートに入っている商品はありません。</h2>
        @endif
    </div>
@endsection
@include('layout.footer')
