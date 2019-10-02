<div class="modal right fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="f-36 py-3">Искать по ключевым словам</h2>
                <form action="{{ route('search.result') }}" method="GET" autocomplete="off">
                    <div class="form-group">
                        <div class="icon-addon addon-lg">
                            <input type="text" autocomplete="off" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" class="form-control f-36 br-0" id="support">
                            <label for="support" rel="tooltip"><i class="material-icons">search</i></label>
                        </div>
                    </div>
                </form>
                <h3 class="f-36">Популярные вопросы</h3>
                <div class="row pl-3">
                    @php
                    $questions = \App\Question::where('moderation' , 'success')->take(7)->get();
                    @endphp
                    @foreach($questions as $question)
                    <div class="col-lg-12 ">
                        <p class="f-36"><strong>{{ $question->question }}</strong></p>
                        <p class="f-36">{{ Str::limit($question->answer, 30) }}</p>
                        <a href="{{ route('ask-question', $question->id) }}"  class="answer-more f-28">Читать дальше</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary btn-block f-36 br-0" href="{{ route('report') }}">Перейти в центр помощи</a>
            </div>
        </div>
    </div>
</div>