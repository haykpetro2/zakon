@extends('layouts.main')

@section('header')

@endsection

@section('content')

<div class="container-fluid vh-100 oferta">
    <div class="row h-100 align-items-center p-5">
        <div class="col-lg-12 h-100 br-orange">
            <div class="row h-100 align-items-center">
                <div class="col-lg-3 col-1 col-sm-1"></div>
                <div class="col-lg-9 col-11 col-sm-11 form-side">
                    <p class="white_color text-right f-30 mx-5 mb-5">
                        @if($deal->status == 'open')
                            Дело открыто
                        @else
                            Дело закрыто
                        @endif
                    </p>
                    <form action="" method="post" class="px-5 ml-5 offer_form" id="report">
                        @csrf
                        <p class="white_color f-30">{{ $deal->name }}</p>
                        <p class="white_color f-30">Юрист {{ $deal->lawyer_name }}</p>
                        @if(Auth::user()->hasRole('Lawyer'))
                            <p class="white_color f-30">Клиент {{ (isset($client_name->login)) ? $client_name->login : 'Пользователь не зарегистрирован' }}</p>
                        @endif
                        <p class="white_color f-30">Дата {{ $deal->date }}</p>
                        <label class="checkContainer white_color f-30">Оплачено
                            @if( Auth::user()->hasRole('Lawyer') )
                                <a href="{{ route('set-price', $deal->id) }}"  class="ml-5">Назначить цену</a>
                            @else
                                <a href="{{ route('payment-systems') }}"  class="ml-5">Оплатить</a>
                            @endif
                            <input type="checkbox" name="paid" class="offer_paid"
                            @if($deal->paid == 'true')
                                checked
                            @endif
                            @if(!Auth::user()->hasRole('Moderator'))
                                disabled
                            @endif>
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkContainer white_color f-30">Консультация проведена (заполняет юрист)
                            <input type="checkbox" name="held" class="offer_held"
                             @if(Auth::user()->hasRole('Lawyer') || Auth::user()->hasRole('Moderator'))

                             @else
                                disabled
                             @endif
                             @if($deal->held == 'true')
                                checked
                             @endif>
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkContainer white_color f-30">Вопрос решен (заполняет клиент)
                            <input type="checkbox" name="resolved" class="offer_resolved"
                            @if(Auth::user()->hasRole('User') || Auth::user()->hasRole('Moderator'))

                            @else
                                disabled
                            @endif
                            @if($deal->resolved == 'true')
                                checked
                            @endif>
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkContainer white_color f-30"><a href="{{ route('offer-terms') }}" >С условием оферты ознакомлен и согласен(а) <small class="theme_grey_color">смотреть</small></a>
                            <input type="checkbox" name="terms" class="offer_terms"
                            @if(Auth::user()->hasRole('User') || Auth::user()->hasRole('Moderator'))

                            @else
                                disabled
                            @endif
                            @if($deal->terms == 'true')
                                checked
                            @endif>
                            <span class="checkmark"></span>
                        </label>
                        <a href="{{ route('problem-desc', $id) }}"  class="f-30 theme_orange_color">Пожаловаться</a>

                        <input type="hidden" name="offer_id" class="offer_id" value="{{ $id }}">

                    </form>
                    <a href="{{ route('rate' , $id) }}" class="white_color f-30 rate_us">Оценить</a>
                    <p class="white_color text-right f-30 mt-5 pt-5 go_chat">
                        @if(Auth::user()->hasRole('Lawyer'))
                            {{--<a href="{{ route('conversations', $conversation->id) }}"  class="mx-5">Перейти к переписке</a>--}}
                        @endif
                        <a href="{{ route('ask-question', $id) }}" class="mx-5">Посмотреть решение</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script>

        $(document).on('change', 'input[type=checkbox]', function () {
            $('.offer_form').submit();
        });

        $(document).on('submit', '.offer_form', function (e) {
            var paid = $('.offer_paid').is(':checked'),
                held = $('.offer_held').is(':checked'),
                resolved = $('.offer_resolved').is(':checked'),
                id = $('.offer_id').val(),
                terms = $('.offer_terms').is(':checked');

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('offer-check') }}",
                method: 'post',
                data: {
                    id: id,
                    paid: paid,
                    held: held,
                    resolved: resolved,
                    terms: terms,
                },
                success: function(result){
                    if(result != ''){
                        alert(result);
                        $( ".offer_held" ).prop( "checked", false );
                    }
                }});
        });
    </script>
@endsection