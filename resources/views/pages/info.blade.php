@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="information ">
    <div class="container-fluid">
        <div class="row mb-0">
            <div class="col-lg-12 p-0">
                <img src="{{ asset('images/backgrounds/site-info.png') }}" alt="" class="w-100">
                @include('layouts.menu')
            </div>
        </div>
    </div>
    <div class="content">

        <div class="page_content">
            @if($info)
                {!! $info->page_content !!}
            @endif
        </div>

        <a href="{{ route('office') }}" class="info_btn f-36 mb-5">Виртуальный ОФИС</a>
    </div>
</header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection