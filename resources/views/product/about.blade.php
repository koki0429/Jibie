@extends('layout.common')
@section('title', 'トップページ')
@section('pageCss')
<link rel="stylesheet" href="/assets/css/product/about.css">
@endsection
@section('pageJs')
<script src="{{asset('/assets/javascript/index.blade.js')}}"></script>
@endsection
@include('layout.header')
@section('content')
    <div class="p-about load_up">
        <h1 class="p-aboutinfo">会社概要</h1>
        <div class="p-aboutDetails">
            <div class="p-aboutDetails_colums">
                <ul>
                    <li class="p-value">所在地</li>
                    <li class="p-value">会社名</li>
                    <li class="p-value">電話番号</li>
                    <li class="p-value">代表者指名</li>
                    <li class="p-value">創立</li>
                </ul>
            </div>
            <div class="p-aboutDetails_values">
                <ul>
                    <li class="p-value">株式会社黒木ジビエ</li>
                    <li class="p-value">宮崎県児湯郡新富町三納代6336</li>
                    <li class="p-value">0000-0000-0000</li>
                    <li class="p-value">黒木ジビエ</li>
                    <li class="p-value">2020年4月29日</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@include('layout.footer')
