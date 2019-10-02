@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork theme_grey_bg lawyers">
    <div class="container-fluid ">
        <div class="row py-5 ml-3 our_lawyers_heading">
            <h1 class="f-60 white_color">@lang('main.our_lawyers')</h1>
        </div>
        <div class="card-group flex-row row">
            @foreach($lawyers as $key => $lawyer)
                <div class="card col-3 p-0 theme_grey_bg">
                    <img src="{{ asset('storage/lawyers/'.$lawyer->image) }}" class="card-img-top w-100 h-50" alt="...">
                    <div class="card-img-overlay">
                        @if($lawyer->isOnline())
                            <p class="card-text white_color f-24">@lang('main.online')</p>
                        @else

                        @endif
                    </div>
                    <div class="card-body bg-black_41 h-35 invisible">
                        <a href="{{ route('user-reviews' , $lawyer->id) }}"  class="ml-3 f-24">@lang('main.reviews')</a>
                        <h5 class="card-title white_color ml-3 f-30 mb-5">@lang('main.description')</h5>

                    </div>
                    <div class="card-footer bg-black_41 h-15 invisible">
                        <a class="btn btn-outline-light btn-block br-0 p-1 f-30" href="{{ route('consulting' , $lawyer->id) }}"  role="button">@lang('main.appeal')</a>
                    </div>
                </div>
            @endforeach

        </div>

        @include('layouts.menu')
    </div>

</header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection