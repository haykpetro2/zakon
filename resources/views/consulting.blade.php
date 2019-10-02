@extends('layouts.main')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection

@section('content')

<header id="main" class="paperwork consulting_mobile">
    <div class="container-fluid consulting vh-100">
        <form action="{{ route('send-question') }}" method="post">
            @csrf
            <div class="row  mb-0">

                <div class="col-md-8 offset-md-3 col-lg-8 offset-lg-3 col-xl-6 offset-xl-5 nav_bg">
                    <div class="row">
                        <div class="col-lg-4 pt-5 px-5">
                            <h2 class="f-24 white_color mt-4 pt-5 text-center">Выберите</h2>

                            @foreach($categories as $category)
                                <label class="checkContainer white_color f-18 mt-4">{{ $category->cat_name }}
                                    <input type="radio" name="category" value="{{ $category->id }}" {{ (isset($_GET['category'])  && $_GET['category'] == $category->id) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                            @if ($errors->has('category'))
                                <div class="error">{{ $errors->first('category') }}</div>
                            @endif
                            @if($lawyer)
                                <p class="white_color f-18">{{ $lawyer->first_name . ' ' . $lawyer->last_name }}</p>
                            @elseif(isset($_GET['name']))
                                <p class="white_color f-18">{{ $_GET['name'] }}</p>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::check())

                            @elseif(Cookie::get('user_phone') && \App\User::where('phone', Cookie::get('user_phone'))->first()->chat_ready == 1)
                                <p>Юрист готов вам ответить - <a href="{{ route('registration', \App\User::where('phone', Cookie::get('user_phone'))->first()->id) }}">Регестрация</a></p>
                            @elseif(Cookie::get('user_phone'))
                                <p>Ваш запрос отправлен.</p>
                            @elseif(session()->has('success'))
                                <p class="text-white">{{ session()->get('success') }}</p>
                            @endif
                        </div>
                        <div class="col-lg-8">
                            <h1 class="f-48 white_color text-center mt-5">Задайте свой вопрос</h1>

                            <div class="form-row">
                                <div class="col">
                                    @if (Auth::check())
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    @else
                                        @if ($errors->has('phone'))
                                            <div class="error">{{ $errors->first('phone') }}</div>
                                        @endif
                                        <input type="text" name="phone" placeholder="Телефон" class="consult_phone f-18">
                                    @endif
                                    @if ($errors->has('question'))
                                        <div class="error">{{ $errors->first('question') }}</div>
                                    @endif
                                    <textarea class="form-control bg-transparent white_color br-white f-18 mt-3" rows="1" name="question" placeholder="Введите вопрос"></textarea>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="col">
                                    <button class="btn btn-outline-light f-36 mt-3 br-0 br-white btn-block" type="submit" role="button">Отправить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="lawyer_id" value="{{ $lawyer_id }}">
            </div>
        </form>
        @include('layouts.menu')
    </div>
</header>

<section class="container-fluid consulting_section vh-100">
    <div class="row bg-2c">
        <div class="col-lg-12 py-5">
            <h2 class="white_color f-36 text-center my-3">Как это работает?</h2>

            <div class="row">
                <div class="col-lg-4 arrow">
                    <img src="{{ asset('images/Repeat%20Grid%209.png') }}" class="d-block mx-auto"  alt="">
                    <p class="white_color f-24 text-center w-75 mx-auto">
                        Задайте свой подробный
                        юридический вопрос
                    </p>
                </div>
                <div class="col-lg-4 arrow">
                    <img src="{{ asset('images/kok.png') }}" class="d-block mx-auto" alt="">
                    <p class="white_color f-24 text-center w-75 mx-auto">
                        Получите ответ от юриста, который
                        специализируется на вашем вопросе
                    </p>
                </div>
                <div class="col-lg-4">
                    <img src="{{ asset('images/like-button.png') }}" class="d-block mx-auto" alt="">
                    <p class="white_color f-24 text-center w-75 mx-auto">
                        <br/>Вопрос решен
                    </p>
                </div>

            </div>

        </div>
    </div>

    <div class="row vh-100 statistics pt-2 pb-5 px-4">

        @foreach($categories as $i => $category)
            <div class="m-0 f-36 white_color @if($i == 0){{ 'mt-4' }} @elseif($i == 5 ){{ 'mt-5 mb-5' }} @else {{ 'mt-3' }} @endif @if($i == 5){{ 'pt-3 pb-5' }} @else {{ 'pt-5' }} @endif w-{{ 70-($i*4) }}">
                <h2 class=" @if($i == 5){{ 'mb-4' }} @else {{ 'mb-0' }} @endif f-36">{{ $category->cat_name }}
                    <span class="float-right">
                        @if( is_null($lawyer) )
                            <a href="{{ route('solved-example' , $category->id ) }}" >{{ count(\App\Question::where('category', $category->id)->where('moderation' , 'success')->get()) }}</a>
                        @else
                            <a href="{{ route('user-reviews' , [$lawyer_id, $category->id]) }}" >{{ count(\App\Question::where('category', $category->id)->where('lawyer_id', $lawyer->id)->where('moderation' , 'success')->get()) }}</a>
                        @endif
                    </span>
                </h2>
            </div>
        @endforeach

    </div>

    <div class="statistics_mobile row flex-column flex-nowrap">

        @foreach($categories as $i => $category)
            <div class="mobile_stats f-36">
                <div class="stat_title w-{{ 80-($i*4) }}">
                    <a href="#" class="mb-0">{{ $category->cat_name }}</a>
                </div>
                <div class="stat_numbers">
                    @if( is_null($lawyer) )
                        <a href="{{ route('solved-example' , $category->id ) }}" >{{ count(\App\Question::where('category', $category->id)->where('moderation' , 'success')->get()) }}</a>
                    @else
                        <a href="{{ route('user-reviews' , [$lawyer_id, $category->id]) }}" >{{ count(\App\Question::where('category', $category->id)->where('lawyer_id', $lawyer->id)->where('moderation' , 'success')->get()) }}</a>
                    @endif
                </div>
            </div>
        @endforeach

    </div>

</section>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection