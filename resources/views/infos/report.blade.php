@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork reception reception_time">
    <div class="container-fluid">
        <div class="row vh-87 mb-0 report">
            <div class="col-lg-3 my-auto pl-5 pr-0">
                <h1 class=" text-center f-60  "><a href="{{ route('problem-desc') }}" class="theme_orange_color" >@lang('main.complain')</a></h1>
            </div>
            <div class="col-lg-1 my-auto pl-5 ml-3">
                <div class="vert-line"></div>
            </div>
            <div class="col-lg-5 my-auto h-50 offset-lg-1">
                <h2 class="white_color f-60">@lang('main.problem_not_sloved')</h2>
                <h3 class="white_color f-48 mb-5">@lang('main.contact_us')</h3>
                <p class="white_color f-48 mt-5"><a href="tel:+79123456789">@lang('main.tel') : {{ ($phone) ? $phone->value : '' }}</a> </p>
                <p class="white_color f-48"><a href="mailto:{{ ($email) ? $email->value : '' }}">e-mail : {{ ($email) ? $email->value : '' }}</a></p>
            </div>
        </div>

        @include('layouts.menu')
    </div>

</header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection