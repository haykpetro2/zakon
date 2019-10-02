@extends('layouts.main')

@section('header')

@endsection

@section('content')

    <header id="main" class="paperwork coupon">
        <div class="container-fluid py-5 h-100">
            <form action="{{ route('coupon-upload') }}" method="POST">
                @csrf
                <div class="row h-50 coupon_mobfull mb-0 mt-5">
                    <div class="col-lg-11 mx-auto brd-6 p-5 coupon_info">
                        <h1 class="white_color py-3 f-60">Талон</h1>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Moderator') || !is_null($reception->name) )
                            <input class="white_color py-3 f-48 coupon_input" name="name" value="И.И.Иванов" {{ ($user->hasRole('Moderator')) ? '' : 'readonly' }}>
                        @endif
                        <input class="white_color py-3 f-48 coupon_input" name="address" value="Адрес" {{ ($user->hasRole('Moderator')) ? '' : 'readonly' }}>
                        <input class="white_color py-3 f-48 coupon_input" name="date" value="Время: {{ $reception->date . ' ' . $reception->time }}" {{ ($user->hasRole('Moderator')) ? '' : 'readonly' }}>

                    </div>
                </div>
                <div class="row mt-5 py-5 coupon_mob_bottom">
                    <div class="col-lg-11 mx-auto ">

                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                            @if($user->hasRole('Moderator'))
                                <div class="btn-group mr-2" role="group" aria-label="Second group">
                                    <button type="submit" class="btn btn-light-o f-30 br-0">Сохранить</button>
                                </div>
                                <div class="btn-group mr-2" role="group" aria-label="Third group">
                                    <a class="btn btn-light-o f-30 br-0" href="#" role="button">Отменить</a>
                                </div>
                            @endif
                            <div class="btn-group" role="group" aria-label="First group">
                                <a class="btn btn-light-o f-30 br-0" href="#" role="button" onclick="window.print()">Распечатать</a>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

            @include('layouts.menu')
        </div>

    </header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection