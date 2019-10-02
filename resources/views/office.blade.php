@extends('layouts.main')

@section('header')

@endsection

@section('content')
<div id="main">
    <div class="bread">
        <h1 class="breadcrumg_title">@lang('main.virtual_office')</h1>
        <div class="d-flex align-items-center mob_logout">
            <h4 class="office_login">{{ Auth::user()->login }}</h4>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Выход
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>
<div class="content virtual_office">
    <div class="container-fluid ">

        <div class="card-group row">
            <div class="card col office_orange_block py-4">
                <a href="{{ route('home') }}"  class="text-center">
                    <img src="{{ asset('images/icons/home.png') }}" class="office_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36">@lang('main.home')</h5>
                    </div>
                </a>
            </div>
            <div class="card col office_gray_block py-4">
                <a href="{{ route('consulting') }}"  class="text-center">
                    <img src="{{ asset('images/icons/consultations.png') }}" class="office_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36">@lang('main.start_consultation')</h5>
                    </div>
                </a>
            </div>
            <div class="card col office_orange_block py-4">
                <a href="{{ route('paperwork') }}"  class="text-center">
                    <img src="{{ asset('images/icons/create-document.png') }}" class="office_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36">@lang('main.create_document')</h5>
                    </div>
                </a>
            </div>
            <div class="card col office_gray_block py-4">
                <a href="{{ route('labor-law') }}"  class="text-center">
                    <img src="{{ asset('images/icons/categories.png') }}" class="office_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36">@lang('main.categories_and_services')</h5>
                    </div>
                </a>
            </div>
            <div class="card col office_orange_block py-4">
                <a href="#" class="text-center hide_search">
                    <img src="{{ asset('images/icons/search.png') }}" class="office_image office_search_button" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36 office_search_button">@lang('main.search')</h5>
                    </div>
                </a>
                <form action="{{ route('search.result') }}" method="GET" autocomplete="off" class="d-flex align-items-center h-100">
                    <div class="input-group open_search align-items-center m-auto">
                        <img src="{{ asset('images/icons/search-small.png') }}" class="office_search_image" alt="Поиск">
                        <input type="text" class="form-control office_search"  name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}">
                    </div>
                </form>
            </div>
        </div>

        <div class="card-group row">
            <div class="card col office_gray_block py-4">
                <a href="{{ route('chat', (isset($id)) ? $id : Auth::user()->id) }}"  class="text-center">
                    <img src="{{ asset('images/icons/chat.png') }}" class="office_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36">@lang('main.chat')</h5>
                    </div>
                </a>
            </div>
            <div class="card col office_orange_block py-4">
                <a href="{{ route('documents', (isset($id)) ? $id : Auth::user()->id) }}"  class="text-center">
                    <img src="{{ asset('images/icons/my-documents.png') }}" class="office_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36">@lang('main.my_documents')</h5>
                    </div>
                </a>
            </div>
            <div class="card col office_gray_block py-4">
                <a href="{{ route('my-advice', (isset($id)) ? $id : Auth::user()->id) }}"  class="text-center">
                    <img src="{{ asset('images/icons/history.png') }}" class="office_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36">@lang('main.consultation_archive')</h5>
                    </div>
                </a>
            </div>
            <div class="card col office_orange_block py-4">
                <a href="{{ route('report') }}"  class="text-center">
                    <img src="{{ asset('images/icons/support.png') }}" class="office_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36">@lang('main.support_center')</h5>
                    </div>
                </a>
            </div>
            <div class="card col office_gray_block py-4">
                <a href="{{ route('settings') }}"  class="text-center">
                    <img src="{{ asset('images/icons/settings.png') }}" class="office_image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center f-36">@lang('main.settings')</h5>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $(document).on('click' , '.office_search_button', function () {
                $('.hide_search').hide();
                $('.open_search').css('display' , 'flex');
            });
        });
    </script>
@endsection