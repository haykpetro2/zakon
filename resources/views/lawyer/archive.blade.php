@extends('layouts.main')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listnav.css') }}">
@endsection

@section('content')

<nav class="navbar navbar-expand-lg navbar-light archive">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto text-dark">
            <li class="nav-item">
                <a class="nav-link f-36" href="{{ route('chat' , \Illuminate\Support\Facades\Auth::user()->id) }}" >Чаты</a>
            </li>
            <li class="nav-item">
                @if($offer)
                    <a class="nav-link f-36" href="{{ route('offer' , $offer->id) }}" >Оплата</a>
                @endif
            </li>
            <li class="nav-item active">
                <a class="nav-link f-36" href="{{ route('home') }}" >Главная <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 mr-5">
            <a href="{{ route('edit-profile', \Illuminate\Support\Facades\Auth::user()->id) }}"  class="my-2 my-sm-0 f-28">Редактировать профиль</a>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row archive_main">
        <div class="col-lg-5 col-12 col-sm-12 col-md-12 left-side"></div>
        <div class="col-lg-7 col-12 col-sm-12 col-md-12 right-side pt-5 mt-5">
            <div class="row">
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

                                                                    $months = \App\Document::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->where('category' , $category->id)->orderByRaw('date DESC')->get()->groupBy(function($val) { return \Carbon\Carbon::parse(date('Y-m-d',$val->date))->format('Y-m'); });

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
                                                                                        $documents = \App\Document::where('category' , $category->id)->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->whereYear('created_at', '=', $y)->whereMonth('created_at', '=', $check_date[1])->get();
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
            <div class="row mr-0 px-5 pt-5 pb-2">
                <div class="col-lg-6 f-60 lh-60 px-4">Архив консультаций и документов</div>
                <div class="col-lg-6 py-3">
                    <form action="{{ route('search.result') }}" method="GET" autocomplete="off">
                        <div class="form-group">
                            <div class="icon-addon addon-lg">
                                <input type="text" autocomplete="off" class="form-control f-36 br-0" id="support" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}">
                                <label for="support" rel="tooltip"><i class="material-icons">search</i></label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="row theme_grey_bg_2 white_color p-4">
        <h2 class="d-block w-100 f-60">Мои клиенты</h2>
        <div id="myList-nav" class="listNav"></div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul id="myList">
                @foreach($conversations as $conversation)
                    @php
                        $users = $conversation->users;
                    @endphp
                    @foreach($users as $user)
                        @if($user->id != \Illuminate\Support\Facades\Auth::user()->id )
                            @php
                                $chat = App::make('chat');
                                $user2 = \App\User::find($user->id);
                                $conversation = $chat->conversations()->between(\Illuminate\Support\Facades\Auth::user(), $user2);
                            @endphp
                            <li><a href="{{ route('conversations', $conversation->id) }}" >{{ $user->login }}</a></li>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/jquery-listnav.js') }}"></script>
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
        })
    </script>
@endsection