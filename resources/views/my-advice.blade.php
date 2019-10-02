@extends('layouts.main')

@section('header')

@endsection

@section('content')

<div class="content my_advice">

    <div class="page_title text-center">
        <h1 class="f-60">Мои консультации</h1>
    </div>

    <div class="container">
        <div class="timeline">
            @foreach($advices as $advice)
                <div class="row no-gutters justify-content-end justify-content-md-around align-items-start  timeline-nodes">
                    <div class="col-10 col-md-5 order-3 order-md-1 timeline-content d-flex justify-content-between">
                        <div class="time_left">
                            <a href="{{ route('offer', $advice->id) }}" ><img src="{{ asset('storage/lawyers/'.\App\User::where('id', $advice->lawyer_id)->first()->image) }}" alt="Advice image" width="156" height="148"></a>
                        </div>
                        <div class="time_right">
                            <h3><a href="{{ route('offer', $advice->id) }}" >{{ $advice->lawyer_name }}</a></h3>
                            <p><a href="{{ route('offer', $advice->id) }}" >{{ str_limit($advice->name, 84) }}</a></p>
                        </div>
                    </div>
                    <div class="col-2 col-sm-1 px-md-3 order-2 timeline-image text-md-center">
                        <time><a href="{{ route('offer', $advice->id) }}">{{ date('d.m.y',strtotime($advice->date)) }}</a></time>
                    </div>
                    <div class="col-10 col-md-5 order-1 order-md-3 py-3 timeline-date">

                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection

@section('footer')

@endsection