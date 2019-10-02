@extends('layouts.main')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection

@section('content')

<header id="main" class="homepage">
    <div class="container-fluid home_top">
        <div class="row">
            <div class="col-md-2 py-5 home_mob_logo">
                <a href="">
                    <img src="{{ asset('images/logo.png') }}" class="img-responsive d-block mx-auto" alt="">
                </a>
            </div>
        </div>
        <div class="row mx-4 header_custom_mt">
            <div class="col-md-9 col-12">
                <h1 class="white_color f-72">@lang('home.legal_services')</h1>
                <h2 class="white_color mt-5 f-36">@lang('home.entrust_problem_professionals')</h2>
            </div>
            <div class="col-md-3 col-12 pl-5">
                <h2 class="white_color f-48 ml-5"><a href="{{ route('office') }}" >@lang('home.virtual_office')</a></h2>
                <h3 class="white_color f-36 ml-5">{{ ($info_email) ? $info_email->value : 'email' }}</h3>
            </div>
        </div>
        <div class="row mx-4">
            <div class="col-md-2 col-6">
                <h5 class="white_color">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if( LaravelLocalization::getCurrentLocaleName() != $properties['name'])
                            <a rel="alternate" class="f-24" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a><br/>
                        @endif
                    @endforeach
                </h5>
            </div>
            <div class="col-md-2 offset-md-7 col-6 pl-5">
                <h3 class="white_color f-36 ml-5 mob_home_info"><a href="{{ route('info') }}">@lang('home.site_info')</a></h3>
            </div>
        </div>
        <div class="row mx-4">
            <div class="col-md-12">
                <form action="{{ route('search.result') }}" method="GET" autocomplete="off">
                    <div class="form-group">
                        <div class="icon-addon addon-lg">
                            <input type="text" autocomplete="off" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" placeholder="@lang('home.search_documents_and_advice')" class="form-control form-control-lg f-36 br-0" id="search">
                            <label for="search"  rel="tooltip" title="search"><i class="material-icons">search</i></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @include('layouts.menu')
    </div>

</header>

<div class="container-fluid section_first">

    <div class="row section_first_row">
        <div class="col-md-2 offset-md-2 col-12 offset-2 ml-auto docs_margin">
            <div class="w-100 bg-black white_color ">
                <p class="f-80 text-center lh-100">{{ ($info_documents) ? $info_documents->value : $documents }}</p>
            </div>
            <p class="f-28 text-center lh-24">@lang('home.executed_documents')</p>
        </div>
        <div class="col-md-2 col-12 consult_margin">
            <div class="w-100 bg-black white_color">
                <p class="f-80 text-center lh-155">{{ ($info_consultations) ? $info_consultations->value : $questions }}</p>
            </div>
            <p class="f-28 text-center lh-24">@lang('home.consultations')</p>
        </div>
        <div class="col-md-2 col-12 consult_margin ml-xs">
            <div class="w-100 bg-black white_color">
                <p class="f-80 text-center lh-155">{{ ($info_public) ? $info_public->value : '30%' }}</p>
            </div>
            <p class="f-28 text-center lh-24">@lang('home.public_law')</p>
        </div>
        <div class="col-md-2 col-12 private_law_margin pr-0">
            <div class="w-100 bg-black white_color f-80 text-center">
                <p class="f-80 text-center lh-195">{{ ($info_private) ? $info_private->value : '70%' }}</p>
            </div>
            <p class="f-28 text-center lh-24">@lang('home.private_right')</p>
        </div>
    </div>

    <div class="row populars">
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-12"><img class="img-fluid w-100" src="{{ asset('images/backgrounds/sergey-zolkin-192937-unsplash.png') }}" alt=""></div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                <h3 class="text-center f-60 white_color theme_orange_bg col-md-11 mx-auto py-2 mt-5">@lang('home.popular_themes')</h3>
                <div class="col-md-12 col-lg-10 offset-lg-1 mt-5 mt-md mt-xl">
                    <div class="row home_public">
                        @foreach($themes as $t => $theme)
                            <div class="col-md-6">
                                <a class="btn btn-outline-dark btn-block br-0 p-3 f-24 mb-5" href="{{ route('theme', $theme->id) }}" role="button">{{ $theme->name }}</a>
                                <input type="hidden" class="theme_ids" value="{{ $theme->id }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt-5 more">
                <div class="col-md-12">
                    <button type="button" class="btn btn-block br-0 p-3 f-24 mb-5 home_more_ajax">@lang('home.more')</button>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="container-fluid common_docs p-163">
    <div class="row triangle">
        <div class="col-md-8 col-10 mx-auto grey_bg_096 white_color p-147">
            <h3 class="text-center f-60">@lang('home.simple_documents')</h3>
            <div class="row">
                <div class="col-md-6 mx-auto mt-5">
                    {{--@if( Auth::check() )--}}
                        {{--<a class="btn btn-outline-light btn-block br-0 p-3 f-36" href="{{ route('documents', Auth::user()->id) }}"  role="button">@lang('home.issue_document')</a>--}}
                    {{--@else--}}
                        <a class="btn btn-outline-light btn-block br-0 p-3 f-36" href="{{ route('paperwork') }}"  role="button">@lang('home.issue_document')</a>
                    {{--@endif--}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid consult">
    <div class="row p-147">
        <h3 class="text-center consult_title f-60">@lang('home.consultations')</h3>
        <div class="col-md-3 mx-auto mt-5">
            <a class="btn btn-outline-warning btn-block br-0 p-3 f-36" href="{{ route('consulting') }}"  role="button">@lang('home.ask_question')</a>
        </div>
    </div>
</div>

<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 offset-xl-2 col-md-4 col-lg-4">
                <ul>
                    <li><a href="{{ route('home') }}" class="active">@lang('home.home')</a></li>
                    <li><a href="{{ route('about') }}">@lang('home.about_resource')</a></li>
                    <li><a href="{{ route('lawyers') }}">@lang('home.lawyers')</a></li>
                    <li><a href="{{ route('solved-example', 1) }}" >@lang('home.activity')</a></li>
                    <li><a href="{{ route('review') }}">@lang('home.reviews')</a></li>
                    <li><a href="{{ route('vacancies') }}">@lang('home.cooperation')</a></li>
                    <li><a href="{{ route('info') }}">@lang('home.site_information')</a></li>
                </ul>
            </div>
            <div class="col-xl-2 col-md-4 col-lg-4">
                <ul>
                    <li><a href="{{ route('paperwork') }}" class="active">@lang('home.issue_documents')</a></li>
                    <li><a href="{{ route('consulting') }}" class="active">@lang('home.consultation')</a></li>
                    <li><a href="{{ route('labor-law') }}">@lang('home.services_and_prices')</a></li>
                    <li><a href="{{ route('labor-law') }}">@lang('home.service_category')</a></li>
                    <li><a href="{{ route('reception') }}">@lang('home.make_appointment')</a></li>
                    <li><a href="#" data-target="#exampleModal" data-toggle="modal">@lang('home.support')</a></li>
                </ul>
            </div>
            <div class="col-xl-3 offset-xl-1 f-24 col-md-4 col-lg-4">
                <p class="text-white">@lang('home.contacts')</p>
                <p>{{ ($info_address) ? $info_address->value : '' }}</p>
                <p>тел. {{ ($info_phone) ? $info_phone->value : '' }}</p>
                <p>e-mail: {{ ($info_email) ? $info_email->value : '' }}</p>
                <p class="text-white">@lang('home.subscribe_us')</p>
                <div class="social_icons">
                    <a href="{{ ($info_vk) ? $info_vk->value : '' }}" ><i class="fab fa-vk"></i></a>
                    <a href="{{ ($info_fb) ? $info_fb->value : '' }}" ><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ ($info_insta) ? $info_insta->value : '' }}" ><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

@endsection

@section('footer')
    <script>
        $(document).ready(function () {

            $(document).on('click', '.home_more_ajax' , function () {
                var theme_ids = $('.theme_ids'),
                    themes = [];
                    // cur = $(this).parent().find('.card-footer'),
                    // card = $(this).parents('.card'),
                    // category_id = $(this).parent().find('.paper_category_id').val();
                for(var i = 0; i < theme_ids.length; i++){
                    themes.push($(theme_ids[i]).val());
                }
                $.ajax({
                    url: "{{ route('more-themes') }}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        themes: themes
                    },
                    success: function (data) {
                        for(var i = 0; i < data.length; i++){
                            var url = '{{ route("theme", ":id") }}';
                            url = url.replace(':id', data[i].id);
                            $('.home_public').append('<div class="col-md-6">\n' +
                                '                                <a class="btn btn-outline-dark btn-block br-0 p-3 f-24 mb-5" href="'+url+'" role="button">'+data[i].name+'</a>\n' +
                                '                                <input type="hidden" class="theme_ids" value="'+data[i].id+'">\n' +
                                '                            </div>');
                        }
                    }
                });
            });

        });
    </script>
@endsection