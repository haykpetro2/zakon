@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork">
    <div class="container-fluid ">
        <div class="row py-2 ml-3">
            <h1 class="f-60">Способы оплаты</h1>
        </div>

        <div class="payment_systems row ml-3">
            <div class="col-md-6">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6">
                        <img src="{{ asset('images/payment-systems/visa.png') }}" class="payment_images" alt="VISA">
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <img src="{{ asset('images/payment-systems/mastercard.png') }}" class="payment_images mastercard" alt="MasterCard">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <img src="{{ asset('images/payment-systems/sberbank.png') }}" class="payment_images" alt="Сбербанк">
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <img src="{{ asset('images/payment-systems/unionpay.png') }}" class="payment_images unionpay" alt="UnionPay">
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6">
                        <img src="{{ asset('images/payment-systems/qiwi.png') }}" class="payment_images" alt="Qiwi">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <img src="{{ asset('images/payment-systems/paypal.png') }}" class="payment_images" alt="PayPal">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <img src="{{ asset('images/payment-systems/webmoney.png') }}" class="payment_images" alt="WebMoney">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <img src="{{ asset('images/payment-systems/mir.png') }}" class="payment_images" alt="Мир">
                    </div>
                </div>
            </div>
        </div>

    </div>

</header>

@endsection

@section('footer')

@endsection