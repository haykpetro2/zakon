@extends('layouts.new')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Категории</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Создать категорию</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Название</th>
            <th>Описание</th>
            <th width="280px">Действие</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->cat_name }}</td>
                <td>{{ $user->cat_description }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('categories.edit',$user->id) }}">Редактировать</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>


    {!! $data->render() !!}


@endsection