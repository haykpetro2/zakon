@extends('layouts.main')

@section('content')
    <div id="register" class="container-fluid">
        <div class="row vh-100 align-items-center">
            <div class="col-md-12">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 before after pb-4">
                                <h2 class="text-center f-36 text-white">@lang('auth.register')</h2>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-4 one">
                            <div class="form-group">
                                <label for="email"></label>
                                <input type="text" id="email" class="form-control" placeholder="@lang('auth.enter_login')" name="login" value="{{ old('login') }}">
                                @if ($errors->has('login'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="code"></label>
                                <input type="text" id="code" class="form-control" placeholder="@lang('auth.codeword')" name="code" value="{{ old('code') }}">
                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-4 two  text-center">
                            <button type="submit" class="btn btn-outline-dark">
                                <span>@lang('auth.press')</span>
                            </button>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-4 three">
                            <div class="form-group ">
                                <label for="password"></label>
                                <input type="password" id="password" class="form-control" name="password" placeholder="@lang('auth.enter_password')">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password_confirm"></label>
                                <input type="password" id="password_confirm" class="form-control" name="password_confirmation" placeholder="@lang('auth.confirm_password')">
                            </div>
                        </div>
                        <div class="col-md-12 effect-none before after pb-4">
                            <h2 class="text-center f-36 text-white"></h2>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection