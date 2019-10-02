@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="solved review">
        <div class="container-fluid">
            <div class="row vh-100 mb-0">
                @include('layouts.menu')
            </div>
            <div class="row my-5 search">
                <div class="col-lg-11 mx-auto">
                    <form action="{{ route('search-review') }}" method="GET">
                        <div class="input-group p-4">
                            <input type="text" class="form-control form-control-lg f-24 br-0 p-5 w-75 solved_search" name="q" placeholder="Введите текст или номер вопроса" value="{{ (isset($_GET['q']) ) ? $_GET['q'] : '' }}">
                            <span class="input-group-btn w-25">
                                <button class="btn btn-dark btn-lg br-0 h-100 w-100 f-30" type="submit">Искать</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <h2>Отзывы</h2>
        </div>
</header>

<section class="container-fluid solved_section mt-5">

    @if( isset($review) )
        @php
            $current_review = $review->id;
            $question = \App\Question::find($review->id);
        @endphp
        <div class="row px-5 pb-5 selected_review questions">
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
                <span class="m-5 px-5">г. {{ \App\User::find($review->lawyer_id)->city }}</span>
            </p>
        </div>
    @endif

    @if(isset($details))
        @foreach($details as $review)
            @php
                $question = \App\Question::find($review->id);
            @endphp
            @if(isset($current_review) && $current_review != $review->id)
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
                    <span class="m-5 px-5">г. {{ \App\User::find($review->lawyer_id)->city }}</span>
                </p>
            </div>
            @endif
        @endforeach
    @endif

    {{ $details ->links() }}

</section>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection