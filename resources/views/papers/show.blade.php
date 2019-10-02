@extends('layouts.new')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Детали</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('papers.index') }}"> Назад</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                {{ $user->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Контент:</strong>
                {{ $user->value }}
            </div>
        </div>
    </div>
@endsection