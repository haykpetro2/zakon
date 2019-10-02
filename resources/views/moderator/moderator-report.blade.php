@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork">
    <div class="container-fluid py-5 h-100">
        <div class="row h-100 mb-0">

            <div class="col-lg-12 px-5">
                @foreach($reports as $report)
                    <div class="row">
                        <div class="col-lg-1 mt-3">
                            <h2 class="f-40">
                                @php
                                    if($report->sender != 0){
                                        $link = url('/moder-chat' , $report->sender);
                                    }else{
                                        $link = '#';
                                    }
                                @endphp
                                <a href="{{ $link }}"  class="text-dark mod_report_btn">
                                    @if(isset($report->login))
                                        {{ $report->login }}
                                    @elseif( isset($report->email) )
                                        {{ $report->email }}
                                    @elseif( isset($report->phone) )
                                        {{ $report->phone }}
                                    @endif
                                </a>
                            </h2>
                        </div>
                        <div class="col-lg-11">
                            <div class="form-row">
                                <div class="col">
                                    <textarea class="form-control f-40 mt-3" rows="3" required="" placeholder="Жалоба">{{ $report->problem }}</textarea>
                                </div>
                            </div>
                            <h3 class="w-100 text-right f-36">
                                @if($report->sender != 0)
                                    <a href="{{ url('/moder-chat' , $report->sender) }}" class="text-dark pr-5 mod_report_btn">Связаться</a>
                                @endif {{ date('d-m-Y', strtotime($report->created_at)) }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection