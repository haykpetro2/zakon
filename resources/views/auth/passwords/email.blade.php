@extends('layouts.main')

@section('header')

@endsection

@section('content')
<div id="reset" class="container-fluid">
    <div class="row vh-100 align-items-center">
        <div class="col-md-10 offset-col-0 offset-sm-1 offset-md-2">
            <h2 class="text-white f-36">@lang('auth.reset_heading')</h2>
            <div class="col-md-8 col-sm-10 col-lg-6 col-xl-5 mt-5 pt-5">
                <form method="POST" action="{{ route('reset') }}">
                    @csrf
                    <div class="form-group">
                        <label for="code"></label>
                        <input type="text" id="code" name="code" class="form-control" placeholder="@lang('auth.enter_codeword')">
                    </div>
                    <div class="form-group">
                        <label for="log"></label>
                        <input type="text" id="log" name="login" class="form-control" value="{{ old('login') }}" placeholder="@lang('auth.enter_log')">
                        @if ($errors->any())
                            <span class="invalid-feedback" role="alert">
                                <strong class="f-36">{{$errors->first()}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="submit"></label>
                        <button type="submit" id="submit" class="btn btn-light form-control f-48"> @lang('auth.next')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')

@endsection