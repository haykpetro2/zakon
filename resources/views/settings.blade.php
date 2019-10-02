@extends('layouts.main')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
@endsection

@section('content')


<div class="content settings">
    <div class="container-fluid ">

        <div class="settings_block">
            <div class="row">
                <div class="col-md-3 settings_padding">
                    <div class="settings_top">
                        <img src="{{ asset('images/icons/settings_login.png') }}" class="settings_image" alt="...">
                        <div class="card-body">
                            <h5 class="settings_title text-center f-30">Логин</h5>
                        </div>
                    </div>
                    <div class="settings_bottom">
                        <input type="text" placeholder="логин" value="{{ \Illuminate\Support\Facades\Auth::user()->login }}" disabled>
                        <a href="#" class="f-30" data-toggle="modal" data-target="#loginModal">Изменить</a>
                    </div>
                </div>
                <div class="col-md-3 settings_padding">
                    <div class="settings_top">
                        <img src="{{ asset('images/icons/settings_password.png') }}" class="settings_image" alt="...">
                        <div class="card-body">
                            <h5 class="settings_title text-center f-30">Пароль</h5>
                        </div>
                    </div>
                    <div class="settings_bottom">
                        <input type="text" placeholder="пароль"  value="{{ \Illuminate\Support\Facades\Auth::user()->password_settings }}" disabled>
                        <a href="#" class="f-30" data-toggle="modal" data-target="#passwordModal">Изменить</a>
                    </div>
                </div>
                <div class="col-md-3 settings_padding">
                    <div class="settings_top">
                        <img src="{{ asset('images/icons/settings_phone.png') }}" class="settings_image" alt="...">
                        <div class="card-body">
                            <h5 class="settings_title text-center f-30">Телефон</h5>
                        </div>
                    </div>
                    <div class="settings_bottom">
                        <input type="text" placeholder="телефон" value="{{ \Illuminate\Support\Facades\Auth::user()->phone }}" class="m-0" disabled>
                        <p class="m-0 text-left not_req">Не обязательно</p>
                        <a href="#" class="f-30" data-toggle="modal" data-target="#phoneModal">Изменить</a>
                    </div>
                </div>
                <div class="col-md-3 settings_padding">
                    <div class="settings_top">
                        <img src="{{ asset('images/icons/settings_email.png') }}" class="settings_image" alt="...">
                        <div class="card-body">
                            <h5 class="settings_title text-center f-30">e-mail</h5>
                        </div>
                    </div>
                    <div class="settings_bottom">
                        <input type="text" placeholder="почта" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" class="m-0" disabled>
                        <p class="m-0 text-left not_req">Не обязательно</p>
                        <a href="#" class="f-30" data-toggle="modal" data-target="#emailModal">Изменить</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 p-5 settings_padding">
                    <div class="settings_top">
                        <img src="{{ asset('images/icons/settings_lang.png') }}" class="settings_image" alt="...">
                        <div class="card-body">
                            <h5 class="settings_title text-center f-30">Язык</h5>
                        </div>
                    </div>
                    <div class="settings_bottom">
                        <input type="text" placeholder="русский" value="{{ LaravelLocalization::getCurrentLocaleName() }}" disabled>
                        <a href="#" class="f-30" data-toggle="modal" data-target="#languageModal">Изменить</a>
                    </div>
                </div>
                <div class="col-md-3 p-5 settings_padding">
                    <div class="settings_top">
                        <img src="{{ asset('images/icons/settings_payment_details.png') }}" class="settings_image" alt="...">
                        <div class="card-body">
                            <h5 class="settings_title text-center f-30">Реквизиты оплаты</h5>
                        </div>
                    </div>
                    <div class="settings_bottom">
                        <a href="#" class="settings_old_input" data-toggle="modal" data-target="#payDetailsModal">Смотреть</a>
                        <a href="#" class="f-30 delete_card">Удалить</a>&nbsp; <a href="#" class="f-30" data-toggle="modal" data-target="#payDetailsModal">Изменить</a>
                    </div>
                </div>
                <div class="col-md-3 p-5 settings_padding">
                    <div class="settings_top">
                        <img src="{{ asset('images/icons/settings_history.png') }}" class="settings_image" alt="...">
                        <div class="card-body">
                            <h5 class="settings_title text-center f-30">История выставления счетов</h5>
                        </div>
                    </div>
                    <div class="settings_bottom">
                        <a href="#" class="settings_old_input">Смотреть</a>
                        <a href="#" class="f-30">Удалить</a>
                    </div>
                </div>
                <div class="col-md-3 p-5 settings_padding">
                    <div class="settings_top">
                        <img src="{{ asset('images/icons/settings_delete.png') }}" class="settings_image" alt="...">
                        <div class="card-body">
                            <h5 class="settings_title text-center f-30">Аккаунт</h5>
                        </div>
                    </div>
                    <div class="settings_bottom">
                        <input type="text" placeholder="thht//12345" disabled>
                        <a href="#" class="f-30 delete_account">Удалить аккаунт</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Login modal -->

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('change-login') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="edit_settings">
                            <input type="text" placeholder="Введите новый логин" name="login" class="change_settings change_login">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <button type="button" class="settings_save mt-5 save_login">ОК</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Password modal -->

    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('change-password') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="edit_settings">
                            <input type="password" placeholder="Введите новый пароль" name="password" class="change_settings change_password">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <button type="button" class="settings_save mt-5 save_password">ОК</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Phone modal -->

    <div class="modal fade" id="phoneModal" tabindex="-1" role="dialog" aria-labelledby="phoneModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('change-phone') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="edit_settings">
                            <input type="text" placeholder="Введите новый номер" class="change_settings change_phone">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <button type="button" class="settings_save mt-5 save_phone">ОК</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Email modal -->

    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('change-email') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="edit_settings">
                            <input type="text" placeholder="Введите почту" name="email" class="change_settings change_email">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <button type="button" class="settings_save mt-5 save_email">ОК</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Payment Details modal -->

    <div class="modal fade" id="payDetailsModal" tabindex="-1" role="dialog" aria-labelledby="payDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('change-card') }}" method="POST">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="paydetail_block">
                        <div class="row">
                            <div class="col">
                                <label for="card_name">Имя</label>
                                <input type="text" placeholder="IVAN" id="card_name" name="first_name" value="{{ (isset($card->first_name)) ? $card->first_name : ''  }}" class="change_settings change_first_name">
                            </div>
                            <div class="col">
                                <label for="card_lastname">Фамилия</label>
                                <input type="text" placeholder="IVANOV" id="card_lastname" name="last_name" value="{{ (isset($card->last_name)) ? $card->last_name : ''  }}" class="change_settings change_last_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label for="card_number">Номер карты</label>
                                <input type="text" placeholder="1234567890123456" id="card_number" name="number" value="{{ (isset($card->number)) ? $card->number : ''  }}" class="change_settings change_number">
                            </div>
                            <div class="col-md-3">
                                <label for="card_code">Код</label>
                                <input type="text" placeholder="CSC/CVV" id="card_code" name="code" value="{{ (isset($card->code)) ? $card->code : ''  }}" class="change_settings change_code">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 card_dates">
                                <label for="card_date">Дата</label>
                                <input type="text" placeholder="XX" id="card_date" name="month" value="{{ (isset($card->month)) ? $card->month : ''  }}" class="change_settings mr-2 change_month">
                                <span> / </span>
                                <input type="text" placeholder="XXXX" name="year" value="{{ (isset($card->year)) ? $card->year : ''  }}" class="change_settings ml-2 change_year">
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="settings_save save_card">Добавить карту</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Language modal -->

    <div class="modal fade" id="languageModal" tabindex="-1" role="dialog" aria-labelledby="languageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="edit_settings">
                        <select class="change_settings_lang">
                            <option value="">@lang('main.choose_language')</option>
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <option value="{{ $localeCode }}" data-url="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="settings_save mt-5">ОК</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('footer')
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            $(document).on('click', '.save_login', function () {
                var login = $('.change_login').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('change-login') }}",
                    method: 'post',
                    data: {
                        login: login,
                    },
                    success: function (data) {
                        $('.error_msg').html(data);
                        if ($.isEmptyObject(data.error)) {
                            location.reload();
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });

            $(document).on('click', '.save_password', function () {
                var password = $('.change_password').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('change-password') }}",
                    method: 'post',
                    data: {
                        password: password,
                    },
                    success: function (data) {
                        $('.error_msg').html(data);
                        if ($.isEmptyObject(data.error)) {
                            location.reload();
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });

            $(document).on('click', '.save_phone', function () {
                var phone = $('.change_phone').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('change-phone') }}",
                    method: 'post',
                    data: {
                        phone: phone,
                    },
                    success: function (data) {
                        $('.error_msg').html(data);
                        if ($.isEmptyObject(data.error)) {
                            location.reload();
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });

            $(document).on('click', '.save_email', function () {
                var email = $('.change_email').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('change-email') }}",
                    method: 'post',
                    data: {
                        email: email,
                    },
                    success: function (data) {
                        $('.error_msg').html(data);
                        if ($.isEmptyObject(data.error)) {
                            location.reload();
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });

            $(document).on('change', '.change_settings_lang', function () {
                var lang_url = $(this).find(':selected').data('url');
                location.href = lang_url;
            });

            $(document).on('click', '.save_card', function () {
                var first_name = $('.change_first_name').val(),
                    last_name = $('.change_last_name').val(),
                    number = $('.change_number').val(),
                    code = $('.change_code').val(),
                    month = $('.change_month').val(),
                    year = $('.change_year').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('change-card') }}",
                    method: 'post',
                    data: {
                        first_name: first_name,
                        last_name: last_name,
                        number: number,
                        code: code,
                        month: month,
                        year: year,
                    },
                    success: function (data) {
                        $('.error_msg').html(data);
                        if ($.isEmptyObject(data.error)) {
                            location.reload();
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });

            /* Delete */

            $(document).on('click', '.delete_account' , function () {
                Swal.fire({
                    title: 'Вы уверены?',
                    text: "Вы не сможете вернуть это!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить!',
                    cancelButtonText:
                        'Отменить',
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Удалена!',
                            'Ваш аккаунт удален.',
                            'success'
                        );
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        jQuery.ajax({
                            url: "{{ route('delete-user') }}",
                            method: 'post',
                            data: {
                                id: 1,
                            },
                            success: function () {
                                location.reload();
                            }
                        });
                    }
                })
            });

            $(document).on('click', '.delete_card' , function () {
                Swal.fire({
                    title: 'Вы уверены?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить!',
                    cancelButtonText:
                        'Отменить',
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Удалена!',
                            'Ваш аккаунт удален.',
                            'success'
                        );
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        jQuery.ajax({
                            url: "{{ route('delete-card') }}",
                            method: 'post',
                            data: {
                                id: 1,
                            },
                            success: function (data) {
                                location.reload();
                            }
                        });
                    }
                })
            });

        });

        function printErrorMsg (msg) {

            $(".print-error-msg").find("ul").html('');

            $(".print-error-msg").css('display','block');

            $.each( msg, function( key, value ) {

                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

            });

        }



    </script>

@endsection