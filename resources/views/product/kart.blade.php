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
                            <p class="p-proShow_detail">注文数 : {{ Form::number('quantity', $quantity[$i], ['class' => 'c-inputNumber', 'min' => 1, 'max' => $product->stock]) }}</p>
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
                <?php $sum = $sum + 1000; ?>
                <p class="p-deriveryPrice">小計 : ¥<?php echo $sum; ?>円</p>
                <p class="p-deriveryPrice">配達料・手数料 : ¥0円</p>
                <p class="p-sum">合計値 : ¥ <?php echo number_format($sum); ?></p>
            </div>
            <div class="content c-stripeButton">
                <form action="{{ route('stripe.post') }}" method="POST">
                    <div class="p-kartConfirm">
                        <div class="p-stripeDetails">
                            <p class="p-stripeDetail p-kartLabel">受取人</p><br>
                            <p class="p-stripeDetail">{{ Auth::user()->name }}様</p><br>
                            <p class="p-stripeDetail p-kartLabel">お届け先住所</p><br>
                            <p class="p-stripeDetail">〒{{ Auth::user()->zipcode }}</p>
                            <p class="p-stripeDetail">{{ Auth::user()->prefecture . Auth::user()->city . Auth::user()->address }}</p><br>
                        </div>
                    </div>
                    <div class="p-profileButtom">
                        <a href="{{ route('profile.show') }}" class="p-kartButton p-rctBtn p-profileEdit">情報を編集する</a>
                    </div>
                    <div class="p-deriveryDate">
                        <p class="p-deriveryTitle">※お届け日時(必ず入力してください)</p><br>
                        <select name="date" class="p-derivery">
                            @for($i = 3; $i <= 7; $i++)
                                <option value="<?php echo date('Y/m/d', strtotime("+$i day")); ?>"><?php echo date('Y/m/d', strtotime("+$i day")); ?></option>
                            @endfor
                        </select>
                        <select name="time" class="p-derivery">
                            <option value="午前中">午前中</option>
                            <option value="14:00~16:00">14:00~16:00</option>
                            <option value="16:00~18:00">16:00~18:00</option>
                            <option value="18:00~20:00">18:00~20:00</option>
                            <option value="19:00~21:00">19:00~21:00</option>
                        </select>
                    </div>
                    {{ csrf_field() }}
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ env('STRIPE_KEY') }}"
                            data-amount="<?php echo $sum; ?>"
                            data-email="<?php echo Auth::user()->email; ?>"
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
