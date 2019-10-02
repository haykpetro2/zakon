@extends('layouts.new')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Детали</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('times.index') }}"> Назад</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                {{ $user->week_day }}
            </div>
        </div>
    </div>
@endsection