@extends('layouts.new')

@section('style')

@endsection

@section('content')

    <div class="container">
        <form action="{{ route('papers.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Название:</label>
                <input type="text" class="form-control" name="name">
                <label for="">Категория:</label>
                <select name="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection

@section('footer')

@endsection