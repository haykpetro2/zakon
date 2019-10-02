@extends('layouts.main')

@section('header')

@endsection

@section('content')

<div class="content my_advice">

    <div class="page_title text-center">
        <h1 class="f-60">@lang('main.about_company')</h1>
    </div>

    <div class="container">
        @if($about)
            {!! $about->page_content !!}
        @endif
    </div>

</div>
@endsection

@section('footer')

@endsection