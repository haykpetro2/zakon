@extends('layouts.main')

@section('header')

@endsection

@section('content')

    <div class="container-fluid vh-100 set_price">
        <div class="row h-100 align-items-center">
            <div class="set_price_bg h-100 theme_orange_bg_2"></div>
            <div class="set_price_bg my-auto">
                <form action="{{ route('create-deal', $question->id) }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control inputs f-36 mt-3" placeholder="Дело №.. Развод" value="{{ isset($question->name) ? $question->name : ''  }}" name="name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control inputs f-36 mt-3" placeholder="ФИО юриста" value="{{ isset($question->lawyer_name) ? $question->lawyer_name : '' }}" name="lawyer_name" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <input type="date" class="form-control inputs f-36 mt-3" name="date" value="{{ isset($question->date) ? date('Y-m-d' , $question->date) : '' }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="number" class="form-control inputs f-36 mt-3" placeholder="Цена" name="price" value="{{ isset($question->price) ? $question->price : '' }}" required>
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col">
                            <button class="btn btn-outline-light w-100 f-36 mt-3 br-0" type="submit">Отправить</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-light w-100 f-36 mt-3 br-0" type="submit" role="button"
                                    @if(Auth::user()->hasRole('Lawyer')) disabled @endif >Опубликовать
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection