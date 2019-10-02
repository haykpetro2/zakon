@extends('layouts.new')

@section('style')

@endsection

@section('content')

    <div class="container">

        {!! Form::model($page, ['method' => 'PATCH','route' => ['infos.update', $page->id]]) !!}
            <div class="form-group">

                <label for="">Название:</label>
                <input type="text" class="form-control" name="name" value="{{ $page->name }}">

                <label for="">Контент:</label>
                <input class="form-control" name="value" value="{{ $page->value }}">

            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Сохранить</button>
        {!! Form::close() !!}
    </div>
@endsection

@section('footer')

@endsection