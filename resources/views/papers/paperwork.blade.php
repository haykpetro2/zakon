@extends('layouts.main')

@section('header')

@endsection

@section('content')

<header id="main" class="paperwork">
    <div class="container-fluid ">
        <div class="row py-2 ml-3">
            <h1 class="f-60">@lang('main.paperwork')</h1>
        </div>
            <div class="card-group row">
                @foreach($categories as $c => $category)
                    <div class="card col-md-2 col-lg-2 col-12 {{ ($c % 2 == 0 || $c == 0 ) ? 'grey_card' : 'orange_card' }} py-4">
                        <img src="{{ asset('storage/categories/'.$category->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center f-30 mb-5">{{ $category->cat_name }}</h5>

                        </div>
                        <div class="card-footer">
                            @foreach($category->papers as $p => $paper)
                                <p class="card-text f-24 mt-3 mx-3">
                                    <a href="{{ route('consulting' , ['get' , 'category' => $category->id, 'name' => $paper->name ]) }}" >{{ $paper->name }}</a>
                                    <input type="hidden" name="paper_id" value="{{ $paper->id }}" class="paper_ids">
                                </p>
                            @if($p == 1)
                                    @break
                                @endif
                            @endforeach
                        </div>
                        <input type="hidden" name="category_id" value="{{ $category->id }}" class="paper_category_id">
                        <span class="{{ ($c % 2 == 0 || $c == 0 ) ? 'more_round_grey' : 'more_round_orange' }}"></span>
                    </div>
                @endforeach
            </div>

        <div class="row mx-auto py-5">
            <h4 class="text-center w-100">@lang('main.didnt_find_right_document')</h4>
            <div class="col-md-6 col-lg-4 mx-auto mt-5 mt-md mt-xl mb-xm">
                <a class="btn btn-outline-dark text-dark btn-block br-0 p-2 f-30" href="{{ route('consulting') }}"  role="button">@lang('main.appeal')</a>
            </div>
        </div>

        @include('layouts.menu')
    </div>

</header>

@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $(document).on('click' , '.more_round_grey , .more_round_orange' , function () {

                var paper_ids = $('.paper_ids'),
                    papers = [],
                    cur = $(this).parent().find('.card-footer'),
                    card = $(this).parents('.card'),
                    category_id = $(this).parent().find('.paper_category_id').val();
                for(var i = 0; i < paper_ids.length; i++){
                    papers.push($(paper_ids[i]).val());
                }

                jQuery.ajax({
                    url: "{{ route('ajax-papers') }}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        papers: papers,
                        category_id: category_id
                    },
                    success: function (data) {
                        if(data == ''){
                            // $('.paper_not_found').show();
                        }else{
                            card.css('height' , $('.paperwork .card').height()+180);
                            cur.append(data);
                        }
                    }
                });
            });
        });
    </script>
@endsection