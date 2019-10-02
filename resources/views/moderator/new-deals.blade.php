@extends('layouts.main')

@section('header')

@endsection

@section('content')
<header id="main" class="paperwork">
    <div class="container-fluid py-5 h-100">
        <div class="row h-100 mb-0">
            <div class="col-lg-11 mx-auto">
                <div class="table-responsive">
                    <table class="table text-center f-28">
                        <tbody>
                            @foreach($deals as $deal)
                                <tr>
                                    <td><a href="{{ route('set-price' , $deal->id) }}"  class="text-dark">{{ $deal->name }}</a></td>
                                    <td>{{ $deal->lawyer_name }} </td>
                                    <td>{{ \App\User::find($deal->user_id)->login }}</td>
                                    <td>{{ $deal->price }} р.</td>
                                    <td>{{ date('d.m.Y', $deal->date) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection