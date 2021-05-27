ご購入いただき、誠にありがとうございました！<br>
<br>
{{ $name }}様<br>
<br>
今回は、JIBIE STOREをご利用いただき、誠にありがとうございました。<br>
<br>
下記のご注文を確かに承りました。<br>
内容に間違えがないかをご確認くださいませ。<br>
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>
<?php $i = 0; ?>
@foreach($karts as $kart)
    @foreach($products[$i] as $product)
        <?php $price = number_format($product['price']); ?>
        {{ $product['name'] }}：{{ $price }}
    @endforeach
    ×{{ $kart['quantity'] }}<br>
    お届け希望日 : {{ $date }},{{ $time }}<br>
    <?php $i++; ?>
@endforeach
<?php $sum = number_format($sum); ?>
合計：{{ $sum }}円（税込）<br>
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>
<br>
疑問・不明点や、キャンセルについては、メールにてお問い合わせください。
<br>
発送後については、再度メールにて通知致します。
<br>
これからも宮崎の広大な自然で育ったジビエ肉を、全国の皆様に食べていただけるよう精進し続けます。<br>
<br>
今後とも、JIBIE STOREよろしくお願い致します。
<br>
□お問い合わせ先<br>
ジビエ 黒木
代表：黒木 章
住所：〒889-1403 宮崎県児湯郡新富町大字上富田6336-2
TEL&FAX：(0983) 33-5059
携帯：090-4582-1808
<br>
