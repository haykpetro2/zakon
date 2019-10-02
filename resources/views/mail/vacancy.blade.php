{!! ($name) ? '<h3>Имя ' . $name . '</h3>' : '' !!}
{!! ($phone) ? '<h3>Телефон ' . $phone . '</h3>' : '' !!}
{!! ($email) ? '<h3>Почта ' . $email . '</h3>' : '' !!}

<h2>Сообщение</h2>

<p>{{ ($vacancies_message) ? $vacancies_message : '' }}</p>