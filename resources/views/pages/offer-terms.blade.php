@extends('layouts.main')

@section('header')

@endsection

@section('content')

<div class="content my_advice">

    <div class="page_title text-center">
        <h1 class="f-60">Ознакомьтесь с условиями оферты</h1>
    </div>

    <div class="container">
        @if($terms)
            {!! $terms->page_content !!}
        @endif
    </div>

</div>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection