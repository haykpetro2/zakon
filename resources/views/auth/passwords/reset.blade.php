@extends('layouts.main')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection

@section('content')

    <div class="content new_password">
        <div class="container">
            <form method="POST" action="{{ route('new_pass', $user_id) }}" class="newpass_block row">
                @csrf
                <div class="col-md-4">
                    <input type="password" placeholder="@lang('auth.enter_new_password')" name="password_confirmation" class="newpass_input">
                </div>
                <div class="col-md-4">
                    <input type="password" placeholder="@lang('auth.repeat_new_password')" name="password" class="newpass_input">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="newpass_submit text-center text-dark">@lang('auth.login')</button>
                </div>
                @if ($errors->has('password'))
                    <div class="col-md-12 text-center">
                        <span class="invalid-feedback" role="alert">
                            <strong class="f-36">
                                {{ $errors->first('password') }}
                            </strong>
                        </span>
                    </div>
                @endif
            </form>
        </div>
    </div>

@endsection

@section('footer')

@endsection