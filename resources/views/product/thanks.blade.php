@extends('layout.common')
@section('title', 'トップページ')
@section('pageCss')
<link rel="stylesheet" href="/assets/css/product/thanks.css">
@endsection
@section('pageJs')
<script src="{{asset('/assets/javascript/index.blade.js')}}"></script>
<script src="{{asset('/assets/javascript/button.blade.js')}}"></script>
<script src="{{asset('/assets/javascript/flash.blade.js')}}"></script>
@endsection
@include('layout.header')
@section('content')
    <div class="p-thanks load_up">
        <h2 class="p-thanksHeader">ご購入いただき、誠にありがとうございました。</h2>
        <p class="p-thanksMessage">早急に商品発送させていただきますので、<br>
        暫しお待ちください。<br>
        メールにて、注文詳細を送信しておりますので、<br>
        ご確認よろしくお願いします。
        </p>
        <div class="p-anker">
            <a href="{{ route('product.index') }}" class="p-rctBtn p-rctBtn">ホームに戻る</a>
        </div>
    </div>
@endsection
@include('layout.footer')
