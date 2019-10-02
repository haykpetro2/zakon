@extends('layouts.new')

@section('style')
    <style>
        .mce-notification-warning {display: none;}
    </style>
@endsection

@section('content')

    <div class="container">

        {!! Form::model($page, ['method' => 'PATCH','route' => ['pages.update', $page->id]]) !!}
            <div class="form-group">
                <label for="page_content">Название:</label>
                <input type="text" class="form-control" name="name" value="{{ $page->name }}">
                <label for="page_content">Контент:</label>
                <textarea id="page_content" name="page_content">{!! $page->page_content !!}</textarea>
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Сохранить</button>
        {!! Form::close() !!}
    </div>
@endsection

@section('footer')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea#page_content',
            width: '100%',
            height: 300
        });
    </script>
@endsection