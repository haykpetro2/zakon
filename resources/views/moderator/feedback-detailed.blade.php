@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork">
    <div class="container-fluid h-100">
        <div class="row h-100 mb-0 ">

            <div class="col-lg-12 px-5">
                <div class="row align-items-center">
                @if($id)
                    <h1 class="f-60 py-5">{{ \App\Category::find($id)->cat_name }}</h1>
                    <h4 class="f-36 py-5 ml-5">{{ $user->login }}</h4>
                @endif
                </div>

                @foreach($deals as $deal)
                    <div class="row br-gray-6 p-5 mb-4">
                        <!-- Question details -->
                        <form action="{{ route('success-deal') }}" method="POST" class="w-100 row">
                            @csrf
                            <div class="col-lg-12 mt-3">
                                <div class="d-flex justify-content-between">
                                    <h2 class="f-36">{{ $deal->id . ' - ' . $deal->name }}</h2>
                                    <p class="f-36">{{ date('d.m.Y' , $deal->date) }}</p>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-row">
                                    <div class="col">
                                        <textarea class="form-control f-36 mt-3" rows="3" required="" placeholder="Вопрос и его решения юристом" readonly>Вопрос - {{ $deal->question }}&#13;&#10;Решения - {{ $deal->answer }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h3 class="w-100 text-right f-36">{{ \App\User::find($deal->user_id)->login }}</h3>
                            </div>
                            <div class="col-lg-6">
                                <select name="theme" id="deal_theme">
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 ml-auto">
                                <div class="d-flex">
                                    <button type="button" class="btn btn-outline-dark text-dark w-100 br-0 mt-5 p-2 f-36 mr-4 mod_buttons mod_hide">Закрыть</button>
                                    <button type="submit" class="btn btn-outline-dark text-dark w-100 br-0 mt-5 p-2 f-36 mod_buttons">Опубликовать</button>
                                    <input type="hidden" name="id" value="{{ $deal->id }}">
                                </div>
                            </div>
                        </form>

                        <!-- Review details -->
                        <form action="{{ route('success-review') }}" method="POST" class="w-100 row">
                            @csrf
                            <div class="col-lg-12 mt-5">
                                <h2 class="f-36 100">Оценка за дело - {{ ($deal->speed + $deal->communication + $deal->result + $deal->professional)/4 }}</h2>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-row">
                                    <div class="col">
                                        <textarea class="form-control f-36 mt-3" rows="3" required="" placeholder="Отзыв" readonly>{{ $deal->review }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6 ml-auto">
                                <div class="d-flex">
                                    <input type="hidden" name="id" value="{{ $deal->id }}">
                                    <button type="button" class="btn btn-outline-dark text-dark w-100 br-0 mt-5 p-2 f-36 mr-4 mod_buttons mod_hide_review">Закрыть</button>
                                    <button type="submit" class="btn btn-outline-dark text-dark w-100 br-0 mt-5 p-2 f-36 mod_buttons">Опубликовать</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click' , '.mod_hide' , function () {
                var id = $(this).parent().find('input').val();
                jQuery.ajax({
                    url: "{{ route('hide-deal') }}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });
            $(document).on('click' , '.mod_hide_review' , function () {
                var id = $(this).parent().find('input').val();
                jQuery.ajax({
                    url: "{{ route('hide-review') }}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection