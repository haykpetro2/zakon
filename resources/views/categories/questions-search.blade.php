@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork solved ask_mob">
    <div class="container-fluid">
        <div class="row vh-100 mb-0 ask_h100">
            <div class="col-lg-8 col-12 col-md-8 pl-5 py-5 pr-0">
                <h1 class="theme_orange_color f-60">{{ $category->cat_name }}</h1>
                <div class="row mt-5 mb-0 ask_question py-2 theme_grey_bg_3">
                    <div class="col-lg-12 p-5 mob_ask">
                        <h2 class="white_color f-36 w-50 d-inline-block">Задайте свой вопрос </h2>
                        <a class="btn btn-outline-light br-0 py-2 px-5 f-24" href="{{ route('consulting', ['get' , 'category' => $category->id ]) }}"  role="button">Задать вопрос</a>
                        <div class="count white_color p-3">
                            <h3 class="f-72 text-center mb-0">{{ count($questions) }}</h3>
                            <h4 class="f-24 text-center mb-0">решенные вопросы</h4>
                        </div>
                    </div>
                </div>
                <div class="row py-4 mb-0">
                    <div class="col-lg-11 f-36">
                        {{ $category->cat_description }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-1 col-md-4 bg-image ">

            </div>
        </div>
        @include('layouts.menu')
    </div>
</header>

<section class="container-fluid solved_section">
    <div class="row my-5 ask_2_mob">
        <div class="col-lg-11 mx-auto">
            <form action="{{ route('search-question', $category->id) }}" method="GET">
                <div class="input-group p-4">
                    <input type="text" class="form-control form-control-lg f-24 br-0 p-5 w-75 solved_search" name="q" placeholder="Введите текст или номер вопроса" value="{{ (isset($_GET['q']) ) ? $_GET['q'] : '' }}">
                    <span class="input-group-btn w-25">
                        <button class="btn btn-dark btn-lg br-0 h-100 w-100 f-30" type="submit">Поиск</button>
                  </span>
                </div>
            </form>
        </div>
    </div>

    @if(isset($details))
        @foreach($details as $question)
            <div class="row px-5 pb-5 questions">
                <h2 class="f-48 w-100">{{ $question->name }}</h2>
                <p class="f-24 w-100">{{ $question->id }}</p>
                <div class="col-lg-2 theme_orange_bg p-5 f-60 text-center ">{{ $question->price }}Р</div>
                <div class="col-lg-2 theme_grey_bg_2 white_color col-md-3">
                    <a class="btn btn-outline-light br-white br-0 mt-3 py-2 px-5 text-left f-24 md-w-100" href="{{ route('ask-question', $question->id) }}"  role="button">Прочитать
                        ответ</a>
                </div>
                <div class="col-lg-1 theme_grey_bg_2 "></div>
                <div class="col-lg-7 theme_grey_bg_2 white_color f-24 lh-28 py-3 px-5 text-justify">
                    {{ $question->question }}
                </div>
                <p class="f-24 text-right w-100 my-4">
                    <span class="px-5">{{ date('d.m.Y', $question->date) }}</span>
                    <span class="ml-5 px-5">{{ $question->lawyer_name }}</span>
                    <span class="m-5 px-5">г. {{ \App\User::find($question->lawyer_id)->city }}</span></p>
            </div>
        @endforeach
        {{ $details ->links() }}
    @endif


</section>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection