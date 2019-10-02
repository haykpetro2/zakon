@extends('layouts.main')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
@endsection

@section('content')

<header id="main" class="paperwork reception">
    <div class="container-fluid">
        <form action="{{ route('reception-time') }}" method="POST">
            @csrf
            <div class="row vh-100 mb-0">
                <div class="col-lg-5 p-5">
                    <h1 class="text-center f-72 mx-auto my-4">Записаться на прием</h1>
                    <h3 class="my-5 f-30">Сделайте запись по телефону или онлайн
                        <a href="tel:+79871232345" class="text-dark">8(987)123-23-45</a></h3>
                    <hr>
                    <h3 class="mt-4 mb-5 f-30">Выберите даты, которые для вас удобны.</h3>
                    <h2 class="f-36">
                        <label for="my_hidden_input">Вы записаны: &nbsp;</label>
                        <input type="text" class="f-36 w-50 date-picker" id="my_hidden_input" value="{{ $date ? $date->date . ' ' . $date->time : '' }}" readonly>
                        @if($date)
                            @php
                                $coupon = \App\Reception::where('date', $date->date)->where('time', $date->time)->first();
                            @endphp
                        <a href="{{ route('print-coupon', $coupon->id) }}"  class="f-18 text-dark position-relative" id="book_modal">нажать</a>
                        @endif
                    </h2>
                    <button class="btn btn-outline-dark text-dark w-50 br-0 mt-5 p-2 f-48" id="next">Далее</button>
                </div>
                <div class="col-lg-7 mb-xm">
                    <input type="hidden" name="dates" class="selected_dates" value="">
                    <div id="datepicker"></div>
                </div>
            </div>
        </form>

        @include('layouts.menu')

    </div>

</header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.ru.min.js') }}"></script>
    <script>
        $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "ru",
            multidate: 5,
            multidateSeparator: ", ",
            // todayHighlight: true,
            templates: {
                leftArrow: '<i class="fas fa-chevron-left"></i>',
                rightArrow: '<i class="fas fa-chevron-right"></i>'
            },
            startDate: new Date(),
        });
        $('#datepicker').on('changeDate', function() {
            var dates = $('#datepicker').datepicker('getFormattedDate');
            $('.selected_dates').val( dates );
            // $('#my_hidden_input').val(
            //     $('#datepicker').datepicker('getFormattedDate')
            // );
        });
    </script>
@endsection
