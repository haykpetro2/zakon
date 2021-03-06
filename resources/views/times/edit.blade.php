@extends('layouts.new')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактировать</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('times.index') }}"> Назад</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($category, ['method' => 'PATCH','route' => ['times.update', $category->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>День:</strong>
                {!! Form::text('week_day', null, array('placeholder' => 'Название','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Время:</strong>
                @for($i = 0; $i < 25; $i++)
                    <div class="">
                        <label for="">{{ $i }}:00
                            <input type="checkbox" name="times[]" value="{{ $i }}:00" {{ ( in_array($i.':00', $times) ) ? 'checked' :'' }}>
                        </label>
                    </div>
                @endfor
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection