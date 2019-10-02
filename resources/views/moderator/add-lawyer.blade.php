@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork">
    <div class="container-fluid py-5 h-100">
        <div class="row h-100 mb-0">
            <div class="col-lg-8 mx-auto brd-6 p-5 adding-form">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="p-5 my-5" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group pr-3 mb-0 col-md-4">
                            <input type="text" class="form-control form-control-lg mb-5" name="first_name" placeholder="Введите Имя" value="{{ old('first_name') }}">
                            <input type="password" class="form-control form-control-lg mb-5" name="password" placeholder="Введите пароль">
                            <input type="text" class="form-control form-control-lg mb-5" name="age" placeholder="Введите возраст" value="{{ old('age') }}">

                        </div>
                        <div class="form-group px-3 mb-0 col-md-4">
                            <input type="text" class="form-control form-control-lg mb-5" name="last_name" placeholder="Введите Фамилию" value="{{ old('last_name') }}">
                            <input type="password" class="form-control form-control-lg mb-5" name="confirm-password" placeholder="Повторите пароль" >
                            <input type="text" class="form-control form-control-lg mb-5" name="city" placeholder="Введите город проживаня" value="{{ old('city') }}">

                        </div>
                        <div class="form-group pl-3 mb-0 col-md-4">
                            <span class="hiddenFileInput">
                                <input type="file" class="form-control" name="image"/>
                            </span>
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group pr-3 col-md-4">
                            <input type="text" class="form-control form-control-lg" name="phone" placeholder="Введите номер телефон" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group px-3 col-md-4">
                            <input type="email" class="form-control form-control-lg" name="email" placeholder="e-mail" value="{{ old('email') }}">
                        </div>
                        <div class="form-group pl-3 col-md-4">
                            <input type="text" class="form-control form-control-lg" placeholder="Введите номер карты" name="card" value="{{ old('card') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group pr-3 col-md-4">
                            <label for="lawyer_contract" class="btn f-24">
                                <i class="fas fa-plus mr-2"></i>Загрузить договор
                                <input type="file" id="lawyer_contract" name="contract">
                            </label>
                        </div>
                        <div class="form-group px-3 col-md-4">
                            <input type="hidden" name="roles" value="Lawyer">
                        </div>
                        <div class="form-group pl-3 col-md-4">
                            <input type="submit" class="form-control form-control-lg" value="Получить доступ">
                        </div>
                    </div>




                </form>

            </div>
        </div>

    </div>

</header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection