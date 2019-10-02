@extends('layouts.main')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/rate.css') }}">
@endsection

@section('content')

    <div class="content rate">
        @if(!empty($successMsg))
            <div class="w-100 vh-100 d-flex justify-content-center align-items-center">
                <h1 class="text-white">{{ $successMsg }}</h1>
            </div>
        @else
            <form method="POST" action="{{ route('add-review') }}">
                @csrf
                <div class="container-fluid">
                    <div class="rate_header">
                        <h1><span>Пожалуйста</span>,<br>оцените работу юриста</h1>
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                    </div>
                    <div class="rate_separator"></div>

                    <div class="row rate_comment">
                        <div class="col-md-7 rating_block">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="rate_user" name="speed" autocomplete="off">
                                        <option value="10" selected="selected">10</option>
                                        <option value="9">9</option>
                                        <option value="8">8</option>
                                        <option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                    <p class="f-30 rate_text">Скорость</p>
                                </div>
                                <div class="col-md-3">
                                    <select class="rate_user" name="communication" autocomplete="off">
                                        <option value="10" selected="selected">10</option>
                                        <option value="9">9</option>
                                        <option value="8">8</option>
                                        <option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                    <p class="f-30 rate_text">Общение</p>
                                </div>
                                <div class="col-md-3">
                                    <select class="rate_user" name="result" autocomplete="off">
                                        <option value="10" selected="selected">10</option>
                                        <option value="9">9</option>
                                        <option value="8">8</option>
                                        <option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                    <p class="f-30 rate_text">Результат</p>
                                </div>
                                <div class="col-md-3">
                                    <select class="rate_user" name="professional" autocomplete="off">
                                        <option value="10" selected="selected">10</option>
                                        <option value="9">9</option>
                                        <option value="8">8</option>
                                        <option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                    <p class="f-30 rate_text">Профессиональность</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 comment">
                            <input type="hidden" name="user_id" value="{{ $question->user_id }}">
                            <input type="hidden" name="lawyer_id" value="{{ $question->lawyer_id }}">
                            <input type="hidden" name="category" value="{{ $question->category }}">
{{--                            <input type="hidden" name="redirect_id" value="{{ $question->category }}">--}}
                            <input type="hidden" name="question_id" value="{{ $id }}">
                            <textarea name="review" class="rating_comment" cols="30" rows="6" placeholder="Оставьте отзыв"></textarea>
                            <button type="submit" class="add_rate f-30">Отправить</button>
                        </div>
                    </div>

                </div>
            </form>
        @endif
    </div>

@endsection

@section('footer')
    <script src="{{ asset('js/jquery.barrating.js') }}"></script>
    <script src="{{ asset('js/examples.js') }}"></script>
@endsection