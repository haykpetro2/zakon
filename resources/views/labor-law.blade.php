@extends('layouts.main')

@section('header')

@endsection

@section('content')

<div class="content labor_law">

    <div class="loabor_law_main">
        <div class="row">
            <div class="col-md-4">
                <div class="llaw_links">
                    @foreach($categories as $i => $category)
                        @if($i < 2)
                            <a href="{{ route('solved-example', $category->id) }}"  class="f-36">{{ $category->cat_name }}</a>
                        @endif
                        {{--<a href="{{ route('solved-example', '2') }}"  class="f-36">@lang('main.labor_law')</a>--}}
{{--                        <a href="{{ route('solved-example', '2') }}"  class="f-36">@lang('main.administrative_law')</a>--}}
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="llaw_links">
                    @foreach($categories as $i => $category)
                        @if($i > 1 && $i < 4)
                            <a href="{{ route('solved-example', $category->id) }}"  class="f-36">{{ $category->cat_name }}</a>
                        @endif
                    @endforeach
                    {{--<a href="{{ route('solved-example', '2') }}"  class="f-36">@lang('main.corporate_law_business')</a>--}}
                    {{--<a href="{{ route('solved-example', '2') }}"  class="f-36">@lang('main.passport_visa_services')</a>--}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="llaw_links">
                    @foreach($categories as $i => $category)
                        @if($i > 3)
                            <a href="{{ route('solved-example', $category->id) }}"  class="f-36">{{ $category->cat_name }}</a>
                        @endif
                    @endforeach
                    {{--<a href="{{ route('solved-example', '2') }}"  class="f-36">@lang('main.civil_law')</a>--}}
                    {{--<a href="{{ route('solved-example', '2') }}"  class="f-36">@lang('main.criminal_law')</a>--}}
                </div>
            </div>
        </div>
    </div>

    @include('layouts.menu')


</div>

@endsection

@section('footer')

@endsection