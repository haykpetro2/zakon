@extends('layouts.new')

@section('style')

@endsection

@section('content')

    <div class="container">
        <form action="{{ route('infos.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Название:</label>
                <input type="text" class="form-control" name="name">
                <label for="">Контент:</label>
                <input class="form-control" name="value">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection

@section('footer')

@endsection