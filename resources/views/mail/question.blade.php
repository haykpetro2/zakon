<h1>Вопрос</h1>

{!! (isset($phone)) ? '<p>Пользователь не зарегистрирован - тел. ' . $phone .'</p>' : ''  !!}

<p>{{ $question }}</p>

<a href="{{ route('start-chat', [$user_id , $que_id] ) }}">Начать переписку</a>