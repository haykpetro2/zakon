@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork ">
    <div class="container-fluid">
        <div class="row vh-100 mb-0">
            <div class="col-lg-12 vacancy-bg">

            </div>
                <div class="col-lg-3 col-md-6 col-10 mx-auto vacancy-form-bg white_color">
                    <h1 class="my-4">@lang('main.apply')</h1>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('success'))
                        <p class="text-white">{{ session()->get('success') }}</p>
                    @endif

                    <form action="{{ route('send-vacancies') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control inputs f-36 mt-3" placeholder="@lang('main.full_name')" name="name">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control inputs f-36 mt-3" placeholder="@lang('main.phone')" name="phone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input type="email" class="form-control inputs f-36 mt-3" placeholder="email" name="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <textarea class="form-control inputs f-36 mt-3" name="vacancies_message"></textarea>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <button class="btn btn-outline-light f-36 mt-3 br-0 btn-block" type="submit" role="button">@lang('main.send')</button>
                            </div>
                        </div>
                    </form>
                </div>

        </div>

        @include('layouts.menu')
    </div>

</header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection