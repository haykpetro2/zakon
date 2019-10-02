@extends('layouts.main')

@section('header')

@endsection

@section('content')

    <header id="main" class="paperwork contact">
        <div class="container-fluid">
            <div class="row vh-100 mb-0">
                <div class="col-lg-5 col-12 col-md-6 grey p-5 contact-small">
                    <div class="row p-5 contact-info">
                        <div class="col-lg-12 p-5">
                            <img src="{{ asset('images/logo-contact.png') }}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="col-lg-12 px-5 pb-5">
                            <h2 class="white_color f-48">@lang('main.contacts')</h2>
                        </div>
                        <div class="col-lg-9 px-5 pb-2">
                            <h3 class="white_color f-24 lh-40">{{ ($address->value) ? $address->value : '' }}</h3>
                        </div>
                        <div class="col-lg-9 px-5 pb-2">
                            <h3 class="white_color f-24 lh-40">@lang('main.tel') {{ ($phone->value) ? $phone->value : '' }}</h3>
                        </div>
                        <div class="col-lg-9 px-5">
                            <h3 class="white_color f-24 lh-40">e-mail: {{ ($email->value) ? $email->value : '' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-12 col-md-6 bg-image contact-small">
                    <div id="map"></div>
                </div>
            </div>

            @include('layouts.menu')
        </div>

    </header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL-63RGD-oqVKATwIDf_ZEA90t2XHMLhY&amp;callback=initMap"
            async="" defer=""></script>
    <script>
        function initMap() {
            let map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 55.830449,
                    lng: 37.502004
                },
                zoom: 17,

            });
            new google.maps.Marker({
                map: map,
                draggable: !0,
                position: {
                    lat: 55.830449,
                    lng: 37.502004
                }
            });

        }
    </script>
@endsection