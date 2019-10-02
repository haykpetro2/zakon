@extends('layouts.new')

@section('style')

@endsection

@section('content')

    <div class="container">

        {!! Form::model($page, ['method' => 'PATCH','route' => ['papers.update', $page->id]]) !!}
            <div class="form-group">

                <label for="">Название:</label>
                <input type="text" class="form-control" name="name" value="{{ $page->name }}">

                <label for="">Контент:</label>
                <select name="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ ($page->$category == $category->id) ? 'checked' : '' }}>{{ $category->cat_name }}</option>
                    @endforeach
                </select>

            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Сохранить</button>
        {!! Form::close() !!}
    </div>
@endsection

@section('footer')

@endsection