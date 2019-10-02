@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork problem">
    <div class="container-fluid">
        <div class="row vh-100 mb-0">
            <div class="col-lg-12 vacancy-bg">

            </div>

            <div class="col-lg-3 col-md-6 col-10 mx-auto vacancy-form-bg white_color">
                <h1 class="my-4">@lang('main.describe_the_problem')</h1>

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

                <form action="{{ route('send-problem') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="login" class="form-control inputs f-36 mt-3" value="{{ (isset($user->login)) ? $user->login : '' }}" placeholder="@lang('main.login')" required>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="phone" class="form-control inputs f-36 mt-3" value="{{ (isset($user->phone)) ? $user->phone : '' }}" placeholder="@lang('main.phone_if_desired')">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="email" name="email" class="form-control inputs f-36 mt-3" value="{{ (isset($user->email)) ? $user->email : '' }}" placeholder="@lang('main.email_if_desired')">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <textarea class="form-control inputs f-36 mt-3" name="problem" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" value="{{ (!is_null($id)) ? $id : 0 }}" name="user">
                    <input type="hidden" value="{{ (\Illuminate\Support\Facades\Auth::check()) ? \Illuminate\Support\Facades\Auth::user()->id : 0 }}" name="sender">
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

@endsection
