@extends('layouts.main')

@section('header')

@endsection

@section('content')

    <header id="main" class="information ">
        <div class="container-fluid">
            <div class="row mb-0">
                <div class="col-lg-12 p-0">
                    <img src="{{ asset('images/backgrounds/site-info.png') }}" alt="" class="w-100">
                    @include('layouts.menu')
                </div>
            </div>
        </div>
        <div class="content">

            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-12">
                        <form method="get" action="{{ route('search.result') }}" class="form-inline mr-auto">
                            <input type="text" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" class="form-control f-36 br-0 w-100"  placeholder="Search events or blog posts..." aria-label="Search">
{{--                            <button class="btn btn-info btn-rounded my-0" type="submit">Поиск</button>--}}
                        </form>
                        <br>
                        @if ( $searchResults-> isEmpty())
                            <h2>Извините, по данному запросу ничего не найдено <b>"{{ $searchterm }}"</b>.</h2>
                        @else
                            <h2>Найдено {{ $searchResults->count() }} резултатов <b>"{{ $searchterm }}"</b></h2>
                            <hr />
                            @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                                @if( ucwords($type) == 'Questions' )
                                    <h2>Вопросы</h2>
                                @elseif(ucwords($type) == 'Reviews')
                                    <h2>Отзывы</h2>
                                @else
                                    <h2>Документы</h2>
                                @endif

                                @foreach($modelSearchResults as $searchResult)
                                    @if(ucwords($type) == 'Documents')
                                        <ul class="p-0">
                                            <a href="{{ route('consulting', ['get' , 'category' => $searchResult->searchable->category, 'name' => $searchResult->searchable->document_name ]) }}" style="color: #000 !important;">{{ $searchResult->title }}</a>
                                        </ul>
                                    @elseif( ucwords($type) == 'Reviews' )
                                        <ul class="p-0">
                                            <a href="{{ route('search-review', $searchResult->searchable->id) }}" style="color: #000 !important;">{{ $searchResult->title }}</a>
                                        </ul>
                                    @else
                                        <ul class="p-0">
                                            <a href="{{ $searchResult->url }}" style="color: #000 !important;">{{ $searchResult->title }}</a>
                                        </ul>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </header>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@endsection