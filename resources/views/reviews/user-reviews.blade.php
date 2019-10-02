@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="solved review user-reviews">
    <div class="container-fluid">
        <div class="row vh-100 mb-0">
            @include('layouts.menu')
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <div class="col mx-auto text-white text-center review-info">
                        <div>
                        Отзывы о {{ mb_substr($user->first_name, 0 , 1) . '. ' . $user->last_name }}
                        @if(isset($category_name))
                            <p>по решению вопросов {{ $category_name->cat_name }}</p>
                        @endif
                    </div>
                    </div>
                    <div class="col-md-12 mt-4 mob_stats text-white text-center">
                        <div class="about-lawyer">
                            <div class="text-right float-left">Скорость
                                <span class="theme_orange_bg">{{ $speed }}</span>
                            </div>
                            <div class="text-left float-left">
                                <span class="theme_grey_bg_2">{{ $professional  }}</span>
                                Профессиональность
                            </div>
                        </div>
                        <div class="about-lawyer al_2">
                            <div class="text-right float-left">
                                <span class="order-1 al_bottom">Общение</span>
                                <span class="theme_grey_bg_2">{{ $communication}}</span>
                            </div>
                            <div class="text-left float-left">
                                <span class="theme_orange_bg">{{ $result }}</span>
                                <span class="order-1 al_bottom">Результат</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</header>

<section class="container-fluid solved_section mt-5">
    @if(isset($reviews))
        @foreach($questions as $q => $question)
            @foreach($reviews as $r => $review)
                @if($q == $r)
                    <div class="row px-5 pb-5 questions">
                        <h2 class="f-48 w-100">{{ $question->name }}</h2>
                        <p class="f-24 w-100">{{ $review->id }}</p>
                        <div class="col-lg-2 theme_orange_bg p-5 f-60 text-center ">{{ ($review->speed + $review->communication + $review->result + $review->professional) / 4 }}</div>
                        <div class="col-lg-2 theme_grey_bg_2 white_color">
                            <button class="btn btn-outline-light br-white br-0 mt-3 py-2 px-5 text-left f-24 md-w-100">{{ $question->price }} Р</button>
                        </div>
                        <div class="col-lg-1 theme_grey_bg_2"></div>
                        <div class="col-lg-7 theme_grey_bg_2 white_color f-24 lh-28 py-3 px-5 text-justify">
                            {{ $review->review }}
                        </div>
                        <p class="f-24 text-right w-100 my-4">
                            <span class="px-5">{{ date('d.m.Y',$question->date) }}</span>
                            <span class="ml-5 px-5">{{ $question->lawyer_name }}</span>
                            <span class="m-5 px-5">г. {{ $user->city }}</span>
                        </p>
                    </div>
                @endif
            @endforeach
        @endforeach
    @else
        @foreach($user->questions as $q => $question)
            @foreach($user->reviews as $r => $review)
                @if($q == $r)
                    <div class="row px-5 pb-5 questions">
                        <h2 class="f-48 w-100">{{ $question->name }}</h2>
                        <p class="f-24 w-100">{{ $review->id }}</p>
                        <div class="col-lg-2 theme_orange_bg p-5 f-60 text-center ">{{ ($review->speed + $review->communication + $review->result + $review->professional) / 4 }}</div>
                        <div class="col-lg-2 theme_grey_bg_2 white_color">
                            <button class="btn btn-outline-light br-white br-0 mt-3 py-2 px-5 text-left f-24 md-w-100">{{ $question->price }} Р</button>
                        </div>
                        <div class="col-lg-1 theme_grey_bg_2"></div>
                        <div class="col-lg-7 theme_grey_bg_2 white_color f-24 lh-28 py-3 px-5 text-justify">
                            {{ $review->review }}
                        </div>
                        <p class="f-24 text-right w-100 my-4">
                            <span class="px-5">{{ date('d.m.Y',$question->date) }}</span>
                            <span class="ml-5 px-5">{{ $question->lawyer_name }}</span>
                            <span class="m-5 px-5">г. {{ $user->city }}</span>
                        </p>
                    </div>
                @endif
            @endforeach
        @endforeach
    @endif
    {{--<div class="row px-5 pb-5 questions">--}}
        {{--<h2 class="f-48 w-100">Название вопроса</h2>--}}
        {{--<p class="f-24 w-100">123 ( номер вопроса)</p>--}}
        {{--<div class="col-lg-2 theme_orange_bg p-5 f-60 text-center ">9.2</div>--}}
        {{--<div class="col-lg-2 theme_grey_bg_2 white_color">--}}
            {{--<a class="btn btn-outline-light br-white br-0 mt-3 py-2 px-5 text-left f-24 md-w-100" href="#"--}}
               {{--role="button">2000 Р</a>--}}
        {{--</div>--}}
        {{--<div class="col-lg-1 theme_grey_bg_2"></div>--}}
        {{--<div class="col-lg-7 theme_grey_bg_2 white_color f-24 lh-28 py-3 px-5 text-justify">--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
        {{--</div>--}}
        {{--<p class="f-24 text-right w-100 my-4">--}}
            {{--<span class="px-5">14.07.19</span>--}}
            {{--<span class="ml-5 px-5">И.И.Иванов</span>--}}
            {{--<span class="m-5 px-5">г. Москва</span></p>--}}
    {{--</div>--}}
    {{--<div class="row px-5 pb-5 questions">--}}
        {{--<h2 class="f-48 w-100">Название вопроса</h2>--}}
        {{--<p class="f-24 w-100">123 ( номер вопроса)</p>--}}
        {{--<div class="col-lg-2 theme_orange_bg p-5 f-60 text-center ">8.9</div>--}}
        {{--<div class="col-lg-2 theme_grey_bg_2 white_color">--}}
            {{--<a class="btn btn-outline-light br-white br-0 mt-3 py-2 px-5 text-left f-24 md-w-100" href="#"--}}
               {{--role="button">500 Р</a>--}}
        {{--</div>--}}
        {{--<div class="col-lg-1 theme_grey_bg_2"></div>--}}
        {{--<div class="col-lg-7 theme_grey_bg_2 white_color f-24 lh-28 py-3 px-5 text-justify">--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
        {{--</div>--}}
        {{--<p class="f-24 text-right w-100 my-4">--}}
            {{--<span class="px-5">14.07.19</span>--}}
            {{--<span class="ml-5 px-5">И.И.Иванов</span>--}}
            {{--<span class="m-5 px-5">г. Москва</span></p>--}}
    {{--</div>--}}
    {{--<div class="row px-5 pb-5 questions">--}}
        {{--<h2 class="f-48 w-100">Название вопроса</h2>--}}
        {{--<p class="f-24 w-100">123 ( номер вопроса)</p>--}}
        {{--<div class="col-lg-2 theme_orange_bg p-5 f-60 text-center ">10</div>--}}
        {{--<div class="col-lg-2 theme_grey_bg_2 white_color">--}}
            {{--<a class="btn btn-outline-light br-white br-0 mt-3 py-2 px-5 text-left f-24 md-w-100" href="#"--}}
               {{--role="button">6000 Р</a>--}}
        {{--</div>--}}
        {{--<div class="col-lg-1 theme_grey_bg_2"></div>--}}
        {{--<div class="col-lg-7 theme_grey_bg_2 white_color f-24 lh-28 py-3 px-5 text-justify">--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
            {{--отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв отзыв--}}
        {{--</div>--}}
        {{--<p class="f-24 text-right w-100 my-4">--}}
            {{--<span class="px-5">14.07.19</span>--}}
            {{--<span class="ml-5 px-5">И.И.Иванов</span>--}}
            {{--<span class="m-5 px-5">г. Москва</span></p>--}}
    {{--</div>--}}

</section>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection