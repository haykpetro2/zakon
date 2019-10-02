@extends('layouts.main')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listnav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-year-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
@endsection

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light archive py-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto text-dark">
                <li class="nav-item active">
                    <a class="nav-link f-36" href="{{ route('home' , \Illuminate\Support\Facades\Auth::user()->id) }}">Главная <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link f-36" href="{{ route('add-lawyer') }}" >Добавить юриста</a>
                </li>
            </ul>
            <div class="col-lg-6">
                <form action="{{ route('search.result') }}" method="GET" autocomplete="off" class="form-inline my-2 my-lg-0 ">

                    <input type="text" autocomplete="off" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" placeholder="Поиск" class="form-control f-36 br-0 w-100" id="search">

                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="card-deck moder_info py-3">
            <div class="card mx-5 theme_orange_bg white_color text-center br-0">
                <a href="{{ route('new-deals') }}" >
                    <div class="card-body pt-5 pb-0">
                        <h3 class="card-title f-40 py-5">Новые сделки</h3>

                    </div>
                    <div class="card-footer theme_orange_bg border-0 pb-5">
                        <h4 class="card-text f-72">{{ count(\App\Question::where('moderation', 'success')->get()) }}</h4>
                    </div>
                </a>
            </div>
            <div class="card mx-5 theme_orange_bg white_color text-center br-0">
                <a href="{{ route('moderator-report') }}" >
                    <div class="card-body pt-5 pb-0">
                        <h3 class="card-title f-40 py-5">Жалобы</h3>

                    </div>
                    <div class="card-footer theme_orange_bg border-0 pb-5">
                        <h4 class="card-text f-72">{{ count(\App\Report::all()) }}</h4>
                    </div>
                </a>
            </div>
            <div class="card mx-5 theme_orange_bg white_color text-center br-0">
                <a href="{{ route('pending-payment') }}" >
                    <div class="card-body pt-5 pb-0">
                        <h3 class="card-title f-40 py-5">Ждут оплаты</h3>

                    </div>
                    <div class="card-footer theme_orange_bg border-0 pb-5">
                        <h4 class="card-text f-72">0</h4>
                    </div>
                </a>

            </div>
            <div class="card mx-5 theme_orange_bg white_color text-center br-0">

                <a href="{{ route('moderation') }}" >
                    <div class="card-body pt-5 pb-0">
                        <h3 class="card-title f-40">Отзывы и решенные вопросы</h3>

                    </div>
                    <div class="card-footer theme_orange_bg border-0 pb-5">
                        <h4 class="card-text f-72">{{ count(\App\Question::where('moderation', 'processing')->get()) }}</h4>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row theme_grey_bg_2 white_color p-4">
            <h2 class="d-block w-100 f-60">Все клиенты</h2>
            <div id="myList-nav" class="listNav py-3"></div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul id="myList">
                    @foreach($users as $user)
                        <li><a href="{{ route('office' , $user->id) }}">{{ $user->login }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid moderator_archive">
        <div class="row archive_main moder_main">
            <div class="col-lg-5 col-12 col-sm-12 col-md-12 left-side"></div>
            <div class="col-lg-7 col-12 col-sm-12 col-md-12 right-side pt-5 mt-5">
                <div class="row">
                    <h2 class="f-48 pl-4">Все дела</h2>
                    <div class="col-lg-12">
                        <div id="accordion">
                            @foreach($categories as $c => $category)
                                <div class="card">
                                    <div class="card-header" id="heading-{{$c}}">
                                        <h5 class="mb-0">
                                            <a role="button" data-toggle="collapse" href="#collapse-{{$c}}" aria-expanded="true" aria-controls="collapse-{{$c}}">
                                                {{ $category->cat_name }}
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse-{{$c}}" class="collapse {{ ($c == 0) ? 'show' : '' }}" data-parent="#accordion" aria-labelledby="heading-1">
                                        <div class="card-body">

                                            <div id="accordion-{{$c}}">
                                                @php
                                                    $years = \App\Document::where('category' , $category->id)->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->orderByRaw('created_at DESC')->get()->groupBy(function($val) {return \Carbon\Carbon::parse($val->created_at)->format('Y');});
                                                @endphp
                                                @foreach($years as $y => $year)
                                                    <div class="card">
                                                        <div class="card-header" id="heading-{{ $c }}-{{ $y }}">
                                                            <h5 class="mb-0">
                                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-{{ $c }}-{{ $y }}" aria-expanded="false" aria-controls="collapse-{{ $c }}-{{ $y }}">
                                                                    {{ $y }}
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapse-{{ $c }}-{{ $y }}" class="collapse" data-parent="#accordion-{{$c+1}}" aria-labelledby="heading-{{ $c }}-{{ $y }}">
                                                            <div class="card-body">

                                                                <div id="accordion-{{ $c }}-{{ $y }}">
                                                                    @php

                                                                        $months = \App\Document::where('category' , $category->id)->orderByRaw('date DESC')->get()->groupBy(function($val) { return \Carbon\Carbon::parse(date('Y-m-d',$val->date))->format('Y-m'); });

                                                                    @endphp
                                                                    @foreach($months as $m => $month)
                                                                        @php
                                                                            $current_month = date('m', $month[0]['date']);
                                                                            $check_date = explode('-' , $m);
                                                                        @endphp
                                                                        @if($check_date[0] == $y && $check_date[1] == $current_month)
                                                                            <div class="card">
                                                                                <div class="card-header" id="heading-{{ $c }}-{{ $y }}-{{ $m }}">
                                                                                    <h5 class="mb-0">
                                                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-{{ $c }}-{{ $y }}-{{ $m }}" aria-expanded="false" aria-controls="collapse-1-1-1">

                                                                                            {{ $month_name[$check_date[1]] }}
                                                                                        </a>
                                                                                    </h5>
                                                                                </div>
                                                                                <div id="collapse-{{ $c }}-{{ $y }}-{{ $m }}" class="collapse" data-parent="#accordion-{{ $c }}-{{ $y }}" aria-labelledby="heading-{{ $c }}-{{ $y }}-{{ $m }}">
                                                                                    <div class="card-body h-300">
                                                                                        <div class="owl-carousel owl-theme position-absolute">
                                                                                            @php
                                                                                                $documents = \App\Document::where('category' , $category->id)->whereYear('created_at', '=', $y)->whereMonth('created_at', '=', $check_date[1])->get();
                                                                                            @endphp
                                                                                            @foreach($documents as $document)
                                                                                                <div class="item">
                                                                                                    <img src="{{ asset('images/Rectangle%20208.png') }}" alt="">
                                                                                                    <p> {{ date('m.d.Y', $document->date) }}</p>
                                                                                                    <p>
                                                                                                        <span class="text-dark fs_1rem" >{{ $document->document_name }}</span>
                                                                                                    </p>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-absolute w-75 theme_orange_bg white_color">
                <div class="row mr-0 p-5">
                    <div class="col-lg-6 f-60 lh-60 px-4">Архив консультаций и документов</div>

                </div>
            </div>

        </div>

        <div class="row theme_grey_bg_2 white_color p-4">
            <h2 class="d-block w-100 f-60">Юристы</h2>
            <div id="myList1-nav" class="listNav"></div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul id="myList1">
                    @foreach($lawyers as $l => $lawyer)
                        <li class="nav-header" data-toggle="collapse" data-target="#lawyer{{ $l }}" data-parent="#myList1">
                            {{ $lawyer->first_name }}
                            <ul class="nav nav-list collapse" id="lawyer{{ $l }}">
                                <li>
                                    <div class="container-fluid">
                                        <div class="row py-5">
                                            <div class="col-lg-3 text-center py-5">
                                                <h3 class="f-30 pt-5"><a href="">{{ $lawyer->first_name . ' ' . $lawyer->last_name }}</a></h3>
                                                <h4 class="f-24"><a href="{{ route('chat', $lawyer->id) }}"  class="text-dark">смотреть переписки</a></h4>
                                            </div>
                                            <div class="col-lg-9 ">
                                                <div class="row text-center">
                                                    @foreach($categories as $i => $category)
                                                        <div class="col-lg-2">
                                                            <h3 class="f-24">{{ $category->cat_name }}</h3>
                                                            <h3 class="f-24 pt-5"><a href="{{ route('feedback-detailed' , [$category->id , $lawyer->id]) }}"  class="text-dark f-24">{{ count(\App\Question::where('category', $category->id)->where('moderation' , 'processing')->where('lawyer_id', $lawyer->id)->get()) }}</a></h3>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row py-5">
                                                    <div class="col-lg-11">
                                                        @php
                                                            $last_deal = \App\Question::where('lawyer_id', $lawyer->id)->first();
                                                        @endphp
                                                        @if( !is_null($last_deal) )
                                                            <h3 class="f-30"><a href="{{ route('offer', $last_deal->id) }}">Последняя работа: {{ $last_deal->name }} </a> <span class="float-right"> {{ date('d.m.Y' , $last_deal->date) }} год</span></h3>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row theme_orange_bg_3">
            <h2 class="white_color p-5 f-60">Оплата консультаций</h2>
        </div>

        <div class="row">
            <div class="col-lg-11 mx-auto">
                <div class="table-responsive">
                    <table class="table text-center">
                        <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td><a href="{{ route('offer', 1) }}"  class="text-dark">Развод №125</a></td>
                            <td>Юрист {{ $payment->lawyer_name }}</td>
                            <td class="{{ ($payment->paid == 'true') ? 'paid' : 'unpaid' }}">оплачено</td>
                            <td>34********8000</td>
                            <td>{{ date('d.m.Y', $payment->date) }}</td>
                            <td><a href="" role="button" data-toggle="modal" data-target="#returnModal" class="text-dark">Вернуть</a></td>
                            <td><a href="" role="button" data-toggle="modal" data-target="#payModal" class="text-dark">Оплатить юристу</a></td>
                        </tr>
                        @endforeach
{{--                        <tr>--}}
{{--                            <td><a href="{{ route('offer', 1) }}"  class="text-dark">Деление имущества №142</a></td>--}}
{{--                            <td>Юрист Г.М. Александров </td>--}}
{{--                            <td class="unpaid">не оплачено</td>--}}
{{--                            <td></td>--}}
{{--                            <td>01.02.2019</td>--}}
{{--                            <td><a href="" class="text-dark">Вернуть</a></td>--}}
{{--                            <td><a href="" class="text-dark">Оплатить юристу</a></td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td><a href="{{ route('offer', 1) }}"  class="text-dark">…………. №45</a></td>--}}
{{--                            <td>Юрист А.А. Нестругин</td>--}}
{{--                            <td class="paid">оплачено</td>--}}
{{--                            <td>65********6789</td>--}}
{{--                            <td>31.01.2019</td>--}}
{{--                            <td><a href="" class="text-dark">Вернуть</a></td>--}}
{{--                            <td><a href="" class="text-dark">Оплатить юристу</a></td>--}}
{{--                        </tr>--}}

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-2 mx-auto text-center">
                <a href="" class="text-dark f-72 "><i class="fas fa-chevron-down"></i></a>
            </div>
        </div>

        <div class="row theme_orange_bg_3">
            <h2 class="white_color p-5 f-60">Учет обращений за консультациями </h2>
        </div>

        <div class="row">
            <div class="col-lg-11 p-0 mx-auto br-gray">
                <div id="calendar"></div>
            </div>
            <div class="col-lg-11 my-4 mx-auto">
                <div class="row theme_orange_bg_3">
                    <h2 class="white_color p-3 f-36 deal_counts">3 обращение</h2>
                </div>
                <div class="row theme_grey_bg_2 ajax_content">
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36">Логин</h3></div>
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 text-center">Вопрос обращения</h3></div>
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 text-right">Юрист</h3></div>
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 ajax_deal_user">Ирина</h3></div>
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 text-center ajax_deal_name">Развод</h3></div>
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 text-right ajax_deal_lawyer"><a href="">Алексей Петрович</a></h3></div>
                </div>
            </div>
        </div>

        <!-- Statistics -->

        <div class="row moder_statistics">
            <div class="col-lg-7 col-12 col-sm-12 col-md-12 left-side pt-5 mt-5">
                <div id="accordion1" class="pt-5 mt-5">
                    <div class="card">
                        <div class="card-header px-5 py-0 theme_grey_bg_2" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn white_color f-36" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    За месяц
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion1">
                            <div class="card-body">
                                @php
                                    $currentDate = strtotime(date("Y-m-d"));
                                    $month_str = $currentDate - (60*60*24*31);
                                @endphp
                                @foreach($categories as $c => $category)
                                    <div class="row px-5 py-4 justify-content-between">
                                        <span class="f-36">{{ $category->cat_name }}</span>
                                        <span class="f-36">{{ count(\App\Question::where('date', '>=' , $month_str)->where('moderation', 'success')->where('category', $category->id)->get()) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header px-5 py-0 theme_grey_bg_2" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn white_color f-36" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    За полгода
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion1">
                            <div class="card-body">
                                @php
                                    $currentDate = strtotime(date("Y-m-d"));
                                    $month_str = $currentDate - (60*60*24*183);
                                @endphp
                                @foreach($categories as $c => $category)
                                    <div class="row px-5 py-4 justify-content-between">
                                        <span class="f-36">{{ $category->cat_name }}</span>
                                        <span class="f-36">{{ count(\App\Question::where('date', '>=' , $month_str)->where('moderation', 'success')->where('category', $category->id)->get()) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header px-5 py-0 theme_grey_bg_2" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn white_color f-36 collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    За год
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion1">
                            <div class="card-body">
                                @php
                                    $currentDate = strtotime(date("Y-m-d"));
                                    $month_str = $currentDate - (60*60*24*365);
                                @endphp
                                @foreach($categories as $c => $category)
                                    <div class="row px-5 py-4 justify-content-between">
                                        <span class="f-36">{{ $category->cat_name }}</span>
                                        <span class="f-36">{{ count(\App\Question::where('date', '>=' , $month_str)->where('moderation', 'success')->where('category', $category->id)->get()) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header px-5 py-0 theme_grey_bg_2" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn white_color f-36 collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    За 5 лет
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion1">
                            <div class="card-body">
                                @php
                                    $currentDate = strtotime(date("Y-m-d"));
                                    $month_str = $currentDate - (60*60*24*1825);
                                @endphp
                                @foreach($categories as $c => $category)
                                    <div class="row px-5 py-4 justify-content-between">
                                        <span class="f-36">{{ $category->cat_name }}</span>
                                        <span class="f-36">{{ count(\App\Question::where('date', '>=' , $month_str)->where('moderation', 'success')->where('category', $category->id)->get()) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-12 col-sm-12 col-md-12 right-side">
                <div class="row">

                </div>
            </div>
            <div class="position-absolute w-75 theme_orange_bg white_color">
                <div class="row mr-0 p-5">
                    <div class="col-lg-6 f-60 lh-60 p-3">Статистика</div>

                </div>
            </div>

        </div>

        <!-- All consultations count -->

        <div class="row  mt-5">
            <h2 class="white_color theme_orange_bg_3 w-100 p-4 f-60"> Учет проведенных консультаций</h2>
            <div class="col-lg-12 p-5">
                <div id="accordion2" class="row">
                    @foreach($categories as $c => $category)
                        <div class="card col-lg-4">
                            <div class="card-header" id="heading2-{{ $c }}">
                                <h5 class="mb-0">
                                    <a role="button" data-toggle="collapse" href="#collapse2-{{ $c }}" aria-expanded="true" aria-controls="collapse2-{{ $c }}">
                                        {{ $category->cat_name }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse2-{{ $c }}" class="collapse {{ ($c == 0) ? 'show' : '' }}" data-parent="#accordion2" aria-labelledby="heading2-{{ $c }}">
                                <div class="card-body">
                                    <div id="accordion2-{{ $c }}">
                                        @php
                                            $years = \App\Question::where('category', '=' , $category->id)->where('moderation', 'success')->orderByRaw('date DESC')->get()->groupBy(function($val) { return \Carbon\Carbon::parse(date('Y-m-d',$val->date))->format('Y'); });
                                        @endphp
                                        @foreach($years as $y => $year)
                                            <div class="card">
                                                <div class="card-header" id="heading2-{{ $c }}-{{ $y }}">
                                                    <h5 class="mb-0">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-{{ $c }}-{{ $y }}" aria-expanded="false" aria-controls="collapse2-{{ $c }}-{{ $y }}">
                                                            <p>{{ $y }} <span class="pl-5">{{ count($year) }}</span></p>
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapse2-{{ $c }}-{{ $y }}" class="collapse" data-parent="#accordion2-1" aria-labelledby="heading2-{{ $c }}-{{ $y }}">
                                                    <div class="card-body">

                                                        <div id="accordion2-{{ $c }}-{{ $y }}">
                                                            @php

                                                                $months = \App\Question::where('category',$category->id)->orderByRaw('date DESC')->get()->groupBy(function($val) { return \Carbon\Carbon::parse(date('Y-m-d',$val->date))->format('Y-m'); });

                                                            @endphp
                                                            @foreach($months as $m => $month)
                                                                @php
                                                                $current_month = date('m', $month[0]['date']);
                                                                $check_date = explode('-' , $m);
                                                                @endphp
                                                                @if($check_date[0] == $y && $check_date[1] == $current_month)
                                                                    <div class="card">
                                                                        <div class="card-header" id="heading2-{{ $c }}-{{ $y }}-{{ $m }}">
                                                                            <h5 class="mb-0">
                                                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-{{ $c }}-{{ $y }}-{{ $m }}" aria-expanded="false" aria-controls="collapse2-{{ $c }}-{{ $y }}-{{ $m }}">
                                                                                    <p>{{ $month_name[$check_date[1]] }} <span class="pl-5">{{ count($month) }}</span></p>
                                                                                </a>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Pay modal -->

    <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="pay_modal">
                            <label for="payName">ФИО Юриста
                                <input type="text" id="payName" placeholder="ФИО Юриста" name="name" class="change_settings">
                            </label>
                            <label for="payCard">Номер карты
                                <input type="text" id="payCard" placeholder="Номер карты" name="card" class="change_settings">
                            </label>
                            <label for="payPercent">Удержать процент
                                <input type="text" id="payPercent" placeholder="Процент" name="percent" class="change_settings">
                            </label>
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <button type="button" class="pay_button mt-5">Подтвердить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Return modal -->

    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="pay_modal">
                            <label for="returnLogin">Логин
                                <input type="text" id="returnLogin" placeholder="Логин" name="login" class="change_settings">
                            </label>
                            <label for="returnCard">Номер карты
                                <input type="text" id="returnCard" placeholder="Номер карты" name="card" class="change_settings">
                            </label>
                            <label for="returnSum">Сумма
                                <input type="text" id="returnSum" placeholder="Сумма" name="sum" class="change_settings">
                            </label>
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <button type="button" class="return_button mt-5">Вернуть</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/jquery-listnav.js') }}"></script>
        <script src="{{ asset('js/bootstrap-year-calendar.js') }}"></script>
    <script src="{{ asset('js/bootstrap-year-calendar.ru.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop:true,
                items:6,
                margin:150,
                nav:false,
                dots: false,
                responsive:{
                    0:{
                        items:3
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:3
                    },
                    1366:{
                        items:6
                    }
                }
            });
            $("#myList").listnav({
                initHidden: false,
                initLetter: '',        // filter the list to a specific letter on init ('a'-'z', '-' [numbers 0-9], '_' [other])
                includeAll: true,      // Include the ALL button
                incudeOther: false,    // Include a '...' option to filter non-english characters by
                includeNums: true,     // Include a '0-9' option to filter by
                flagDisabled: true,    // Add a class of 'ln-disabled' to nav items with no content to show
                removeDisabled: false, // Remove those 'ln-disabled' nav items (flagDisabled must be set to true for this to function)
                noMatchText: 'Нет совпадении', // set custom text for nav items with no content to show
                showCounts: false,      // Show the number of list items that match that letter above the mouse
                cookieName: null,      // Set this to a string to remember the last clicked navigation item requires jQuery Cookie Plugin ('myCookieName')
                onClick: null,         // Set a function that fires when you click a nav item. see Demo 5
                prefixes: [],          // Set an array of prefixes that should be counted for the prefix and the first word after the prefix ex: ['the', 'a', 'my']
                filterSelector: '',     // Set the filter to a CSS selector rather than the first text letter for each item
                allText: '#',

            });
            $("#myList1").listnav({
                initHidden: false,
                initLetter: '',        // filter the list to a specific letter on init ('a'-'z', '-' [numbers 0-9], '_' [other])
                includeAll: true,      // Include the ALL button
                incudeOther: false,    // Include a '...' option to filter non-english characters by
                includeNums: true,     // Include a '0-9' option to filter by
                flagDisabled: true,    // Add a class of 'ln-disabled' to nav items with no content to show
                removeDisabled: false, // Remove those 'ln-disabled' nav items (flagDisabled must be set to true for this to function)
                noMatchText: 'Нет совпадении', // set custom text for nav items with no content to show
                showCounts: false,      // Show the number of list items that match that letter above the mouse
                cookieName: null,      // Set this to a string to remember the last clicked navigation item requires jQuery Cookie Plugin ('myCookieName')
                onClick: null,         // Set a function that fires when you click a nav item. see Demo 5
                prefixes: [],          // Set an array of prefixes that should be counted for the prefix and the first word after the prefix ex: ['the', 'a', 'my']
                filterSelector: '',     // Set the filter to a CSS selector rather than the first text letter for each item
                allText: '#',

            });
            $('#calendar').calendar({
                language: 'ru',
                displayWeekNumber: false,
                displayWeekDays: false,

                cols: 12,
                colsMd:4,
                colsLg:3,
                colsXl:3,
                clickDay: function(e) {
                    var date = e.date;
                    jQuery.ajax({
                        url: "{{ route('date-questions') }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            date: date
                        },
                        success: function (data) {
                            $('.deal_counts').text(data[1]+' обращение');
                            $('.ajax_content').html(data[0]);
                        }
                    });
                }

            })

        })
    </script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
        $(document).on('click', '.pay_button' , function () {
            Swal.fire({
                title: 'Вы уверены?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить!',
                cancelButtonText:
                    'Отменить',
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Оплачено!',
                        'Успешно оплачено.',
                        'success'
                    );
                }
            })
        });

        $(document).on('click', '.return_button' , function () {
            Swal.fire({
                title: 'Вы уверены?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить!',
                cancelButtonText:
                    'Отменить',
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Оплачено!',
                        'Успешно оплачено.',
                        'success'
                    );
                }
            })
        });
    </script>
@endsection