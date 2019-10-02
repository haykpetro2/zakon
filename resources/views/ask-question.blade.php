@extends('layouts.main')

@section('header')

@endsection

@section('content')


    <div class="content ask_question1">

    @include('layouts.menu')

    <div class="container-fluid h-100">
        <div class="row align-items-center h-100">
            <div class="col-md-5 select_question">
                <div class="w-100">
                    <h2 class="f-36 text-center text-white">Задать вопрос</h2>
                    <form action="{{ route('send-question') }}" method="post">
                        @csrf
                        <div class="select_question_block">
                            <h4 class="f-24 text-white ml-5 mb-4">Выберите</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach($categories as $category)
                                        <label class="checkContainer white_color f-18">{{ $category->cat_name }}
                                            <input type="radio" name="category" value="{{ $category->id }}" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    <textarea name="question" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>

                        @if (Auth::check())
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        @endif

                        <input type="submit" class="f-36 ask_que_btn" value="Отправить">
                    </form>
                </div>
            </div>
            <div class="col-md-7 h-100 d-flex align-items-center flex-wrap">

                <div class="que_top_blank"></div>

                <div class="quenames">
                    <h1 class="f-60">{{ $question->name }}</h1>
                    <p class="f-30 quename_text">{{ $question->question }} </p>
                    <p class="f-30 quename_text">{{ $question->answer }} </p>

                    <div class="ask_que_bottom_texts">
                        <span>{{ date('d.m.Y',$question->date) }}</span>
                        <span>{{ $question->lawyer_name }}</span>
                        @if(isset($user->city))
                            <span>г.{{ $user->city }}</span>
                        @endif
                        <span>{{ $question->price }}р.</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


@endsection

@section('footer')

@endsection