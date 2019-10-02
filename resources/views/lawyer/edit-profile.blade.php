@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork">
    <div class="container-fluid py-5 h-100">
        <div class="row h-100 mb-0">
            <div class="col-lg-8 mx-auto brd-6 p-5 adding-form">
                <form class="p-5 my-5" method="post" action="{{ route('edit-lawyer-profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group pr-3 mb-0 col-md-4">
                            <input type="text" class="form-control form-control-lg mb-5" placeholder="Введите Имя" name="first_name" value="{{ ( isset($lawyer->first_name) ) ? $lawyer->first_name : '' }}">
                            <input type="password" class="form-control form-control-lg mb-5" placeholder="Введите пароль" name="password">
                            <input type="text" class="form-control form-control-lg mb-5" placeholder="Введите возраст" name="age" value="{{ ( isset($lawyer->age) ) ? $lawyer->age : '' }}">

                        </div>
                        <div class="form-group px-3 mb-0 col-md-4">
                            <input type="text" class="form-control form-control-lg mb-5" placeholder="Введите Фамилию" name="last_name" value="{{ ( isset($lawyer->last_name) ) ? $lawyer->last_name : '' }}">
                            <input type="password" class="form-control form-control-lg mb-5" placeholder="Повторите пароль" name="confirm-password">
                            <input type="text" class="form-control form-control-lg mb-5" placeholder="Введите город проживаня" name="city" value="{{ ( isset($lawyer->city) ) ? $lawyer->city : '' }}">

                        </div>
                        <div class="form-group pl-3 mb-0 col-md-4">
                            <!--                            <input type="file" class="form-control" multiple="">-->
                            <span class="hiddenFileInput">
                                <input type="file" class="form-control" name="image"/>
                            </span>
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group pr-3 col-md-4">
                            <input type="text" class="form-control form-control-lg mb-5" placeholder="Введите номер телефон" name="phone" value="{{ ( isset($lawyer->phone) ) ? $lawyer->phone : '' }}">
                        </div>
                        <div class="form-group px-3 col-md-4">
                            <input type="email" class="form-control form-control-lg mb-5" placeholder="e-mail" name="email" value="{{ ( isset($lawyer->email) ) ? $lawyer->email : '' }}">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group pr-3 col-md-4">
                            <input type="text" class="form-control form-control-lg" placeholder="Введите номер карты" name="card" value="{{ ( isset($card->number ) ) ? $card->number : '' }}">
                        </div>
                        <div class="form-group px-3 col-md-4">
                            <span class="hiddenFileInput1">
                                <input type="file" class="form-control" name="contract"/>
                                <a href="{!! asset('storage/contracts/'.$lawyer->contract . '') !!}" class="contract_link">Договор</a>
                            </span>
                        </div>
                        <div class="form-group pl-3 col-md-4">
                            <input type="hidden" name="lawyer_id" value="{{ $lawyer->id }}">
                            <input type="submit" class="form-control form-control-lg" value="Сохранить">
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