@extends('layouts.main')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/paper.css') }}">
@endsection

@section('content')

    <div id="login" class="container-fluid">
        <img src="{{asset('images/logo.png')}}" alt="">
        <div class="row h-100 align-items-end">
            <div class="login col-md-10 col-lg-8">
                <h3 class="text-white f-72">@lang('auth.login')</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="email"></label>
                            <input type="text" id="email" class="form-control" name="login" value="{{ old('login') }}" placeholder="@lang('auth.user_login')">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="password"></label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="@lang('auth.password')">
                            @if ($errors->any())
                                <span class="invalid-feedback" role="alert">
                                    <strong class="f-36">{{$errors->first()}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 col-sm-12 col-12 form-group">
                            <h3 class="f-48">
                                <a class="text-white" href="{{ route('password.request') }}">@lang('auth.forget_password')</a>
                            </h3>
                        </div>
                        <div class="col-md-6 col-sm-12 col-12 form-group text-right paper">

                            <label class="text-white f-24 mt-2">
                                <input class="cb pristine" name="remember" type="checkbox">
                                &nbsp;
                                @lang('auth.remember_me')
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <button type="submit" class="btn btn-success f-48 ">@lang('auth.sign_in')</button>
                        </div>
                    </div>
                </form>
                <h3 class="mt-4 f-60"><a href="{{ route('register') }}" class="text-white">@lang('auth.register')</a></h3>
            </div>

        </div>
    </div>
@endsection

@section('footer')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var q = document.querySelectorAll(".cb");
            for (var i in q) {
                if (+i < q.length) {
                    q[i].addEventListener("click", function () {
                        let c = this.classList,
                            p = "pristine";
                        if (c.contains(p)) {
                            c.remove(p);
                        }
                    });
                }
            }
        });
    </script>
@endsection