@extends('layouts.main')

@section('header')

@endsection

@section('content')
    <header id="main" class="paperwork reception reception_time">
        <div class="container-fluid">
            <div class="row vh-100 mb-0 timing_form">
                <div class="col-lg-12">
                    <div class="row bg-light py-5">
                        <div class="col-lg-12 mx-auto">
                            <h1 class="text-center f-48">Выберите время, которое вам удобно</h1>
                        </div>
                    </div>
                    <form action="{{ route('create-reception') }}" method="post">
                        @csrf
                        <div class="row">
                            @foreach ($dates as $i => $date)
                                <div class="col-lg-2 {{ $i == 0 ? 'offset-lg-1' : '' }} col-6">
                                    <p class="white_color f-36">{{ $date }}</p>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @php
                                                $week_day = date("N", strtotime($date));
                                                $times = \App\Time::where('week_day' , $week_day)->first();
                                                $times = json_decode($times->times);
                                            @endphp

                                            @foreach($times as $t => $time)
                                                @php
                                                    $check = \App\Reception::where('date' , $date )->where('time' , $time)->first();
                                                @endphp

                                                @if($check)
                                                    <label class="btn btn-primary times f-36 inactive-time">
                                                        <input type="radio" name="date" class="d-none"
                                                               disabled>{{ $time }}
                                                    </label>
                                                @else
                                                    <label class="btn btn-primary times f-36 select_reception">
                                                        <input type="radio" name="date"
                                                               value="{{ $date . ' ' . $time }}"
                                                               class="d-none">{{ $time }}
                                                    </label>
                                                @endif
                                                @if($t == 3) @break @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-lg-12 px-5 mt-3">
                                <div class="form-group">
                            <textarea class="form-control f-36" id="message" rows="5" placeholder="Опишите кратко вашу проблему. Вы можете оставить номер телефона для связи, либо мы
свяжемся с вами в чате." name="question" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3 px-5 ml-auto my-3">
                                <button class="btn btn-light f-36 br-0 btn-block recept_time_btn" type="submit">
                                    Отправить
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    </form>

                </div>

            </div>

            @include('layouts.menu')
        </div>

    </header>
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.ru.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.select_reception', function () {
                if($(this).find('input').is(':checked')) {
                    $('.select_reception').css('color', 'white');
                    $(this).css('color','gray');
                }
            });
        });
    </script>
@endsection