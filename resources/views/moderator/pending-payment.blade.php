@extends('layouts.main')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
@endsection

@section('content')

<header id="main" class="paperwork">
    <div class="container-fluid">
        @foreach($payments as $payment)
            <div class="row mb-0 pt-5">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <tbody>
                            <tr>
                                <td><a href="" class="text-dark">{{ $payment->name }}</a></td>
                                <td>Юрист {{ $payment->lawyer_name }}</td>
                                <td class="paid">оплачено</td>
                                <td>34********8000</td>
                                <td>{{ $payment->price }} руб</td>
                                <td>{{ date('d.m.Y', $payment->date) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3 class="w-100 text-right">
                        <a href="" role="button" data-toggle="modal" data-target="#returnModal" class="f-28 text-dark px-5 hv-dark">Вернуть</a>
                        <a href="" role="button" data-toggle="modal" data-target="#payModal" class="f-28 text-dark px-5 hv-dark">Оплатить юристу</a>
                    </h3>
                </div>
            </div>
        @endforeach
    </div>
</header>

<!-- Pay modal -->

<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pay_modal">
                        <label for="payName">ФИО Юриста
                            <input type="text" id="payName" placeholder="ФИО Юриста" name="name" class="change_settings">
                        </label>
                        <label for="payCard">Номер карты
                            <input type="text" id="payCard" placeholder="Номер карты" name="card" class="change_settings">
                        </label>
                        <label for="payPercent">Удержать процент
                            <input type="text" id="payPercent" placeholder="Процент" name="percent" class="change_settings">
                        </label>
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <button type="button" class="pay_button mt-5">Подтвердить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Return modal -->

<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pay_modal">
                        <label for="returnLogin">Логин
                            <input type="text" id="returnLogin" placeholder="Логин" name="login" class="change_settings">
                        </label>
                        <label for="returnCard">Номер карты
                            <input type="text" id="returnCard" placeholder="Номер карты" name="card" class="change_settings">
                        </label>
                        <label for="returnSum">Сумма
                            <input type="text" id="returnSum" placeholder="Сумма" name="sum" class="change_settings">
                        </label>
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <button type="button" class="return_button mt-5">Вернуть</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
        $(document).on('click', '.pay_button' , function () {
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
                        'Оплачено!',
                        'Успешно оплачено.',
                        'success'
                    );
                }
            })
        });

        $(document).on('click', '.return_button' , function () {
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
                        'Оплачено!',
                        'Успешно оплачено.',
                        'success'
                    );
                }
            })
        });
    </script>
@endsection