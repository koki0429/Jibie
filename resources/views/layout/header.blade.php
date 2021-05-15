@section('header')
<div class="l_header">
    <div class="l_header__top">
        <p class="l_header__titile">JIBIE STORE</p>
        <div class="l_header__userInfomation">
            @auth
                <p class="p-loginName">{{ Auth::user()->name }}さん</p>
                <a href="{{ route('profile.show') }}"><i class="far fa-address-card"></i></a>
                <a href="{{ route('product.kart', ['user_id' => Auth::user()]) }}"><i class="fas fa-cart-plus"></i></a>
            @else
                <p class="p-loginName">ログインしてください。</p>
                <a href="{{ route('login') }}"><i class="far fa-address-card"></i></a>
                <a href="{{ route('login') }}"><i class="fas fa-cart-plus"></i></a>
            @endauth
        </div>
    </div>
    <ul class="l_header__navlists">
        <a href="<?php echo url("/product"); ?>" class="l_header__navlist"><li>HOME</li></a>
        <a href="<?php echo url("/product#jump_product"); ?>" class="l_header__navlist"><li>PRODUCT</li></a>
        <a href="{{ route('contact.index') }}" class="l_header__navlist"><li>CONTACT</li></a>
        <a href="<?php echo url("/product#jump_access") ?>" class="l_header__navlist"><li>ACCSECC</li></a>
        <a href="{{ route('product.about') }}" class="l_header__navlist"><li>ABOUT</li></a>
    </ul>
</div>
@endsection
