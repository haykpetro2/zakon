@extends('layouts.main')

@section('header')

@endsection

@section('content')

    <div class="content chat chat_lawyer">

        <div class="chat_header d-flex justify-content-between">
            <div class="col-md-4 col-sm-12 chat_users">
                <div class="row ml-5 chat_client_names">
                    @foreach($conversations as $c => $conversation)
                        <div class="col-md-4 col-sm-4 col">
                            @php
                                $chat_users = $conversation->users;
                                foreach ($chat_users as $chat_user_lawyer){
                                    if($chat_user_lawyer->id != $user_view ){
                                        $this_user = $chat_user_lawyer->id;
                                    }
                                }
                            @endphp
                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Moderator') )
                                <a href="{{ route('conversations', [$conversation->id, $this_user] ) }}">
                            @else
                                <a href="{{ route('conversations', $conversation->id ) }}">
                            @endif
                                @foreach($conversation->users as $i => $user)
                                    @if( !is_null($user_view) )
                                        @if($user->id != $user_view)
                                            <h3 class="f-36 white_color py-5">
                                                @if($user->first_name)
                                                    {{ $user->first_name }}
                                                @elseif($user->login)
                                                    {{ $user->login }}
                                                @else
                                                    Noname
                                                @endif
                                            </h3>
                                        @endif
                                    @else
                                        @if($user->id != Auth::user()->id)
                                            <h3 class="f-36 white_color py-5">
                                                @if($user->first_name)
                                                    {{ $user->first_name }}
                                                @elseif($user->login)
                                                    {{ $user->login }}
                                                @else
                                                    Noname
                                                @endif
                                            </h3>
                                        @endif
                                    @endif
                                    @if($c > 3)
                                        @break
                                    @endif
                                @endforeach
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-8 col-sm-12 chat_buttons chat1_buttons">
                <div class="chat_header_texts">
                    @foreach($chat_user as $c => $chat_u)
                        @if( !is_null($user_view) )
                            @if($chat_u->id != $user_view)
                                <p class="f-30"><a href="{{ route('documents' , $chat_u->id) }}">Документы</a></p>
                                @php
                                    $chat = App::make('chat');
                                    $moder_chat = $chat->conversations()->between($chat_u->id, 1);
                                @endphp
                                @if(is_null($moder_chat))
                                    <p class="f-30"><a href="{{ route('set-price' , $question->id) }}" >Назначить цену</a></p>
                                @endif
                            @endif
                        @else
                            @if($chat_u->id != $user_id)
                                <p class="f-30"><a href="{{ route('documents' , $chat_u->id) }}">Документы</a></p>
                                @php
                                    $chat = App::make('chat');
                                    $moder_chat = $chat->conversations()->between($chat_u->id, 1);
                                @endphp
                                @if(is_null($moder_chat))
                                    <p class="f-30"><a href="{{ route('set-price' , $question->id) }}" >Назначить цену</a></p>
                                @endif
                            @endif
                        @endif
                    @endforeach
                </div>
                <div class="chat_header_my_image chat1">
                    <img src="{{ asset('images/chat_my_image.png') }}" alt="my image">
                </div>
            </div>
        </div>

        <div class="chat_after_header">
            <div class="col-md-12">
                <div class="d-flex justify-content-end align-items-end">
                    <div class="chat_after_header_texts">
                        @foreach($chat_user as $c => $chat_u)
                            @if($chat_u->id != $user_id)
                                <p class="f-36">{{ $chat_u->first_name . ' ' . $chat_u->last_name }}</p>
                                @if($chat_u->isOnline())
                                    <p class="f-30">Онлайн</p>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="chat_after_header_space">

                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="chat_block">
                <div class="chat_messages">
                    @foreach($messages as $message)
                        @if( !is_null($user_view) )
                            @if($message->user_id == $user_view )
                                <div class="message_left">
                                    @if(strpos($message->body, '/storage/conversations/chat-') !== false)
                                        <a href="{{ $message->body }}"><img src="{{ $message->body }}" alt=""></a>
                                    @else
                                        <p>{{ $message->body }}</p><i class="fas fa-check" style="{{ ($question->answer == $message->body) ? 'display: block;' : '' }}"></i>
                                    @endif
                                </div>
                            @else
                                <div class="message_right">
                                    <p>{{ $message->body }}</p>
                                </div>
                            @endif
                        @else
                            @if($message->user_id == $user_id || \Illuminate\Support\Facades\Auth::user()->hasRole('Moderator'))
                                <div class="message_left">
                                    @if(strpos($message->body, '/storage/conversations/chat-') !== false)
                                        <a href="{{ $message->body }}"><img src="{{ $message->body }}" alt=""></a>
                                    @else
                                        <p>{{ $message->body }}</p><i class="fas fa-check" style="{{ ($question->answer == $message->body) ? 'display: block;' : '' }}"></i>
                                    @endif
                                </div>
                            @else
                                <div class="message_right">
                                    <p>{{ $message->body }}</p>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
                <form action="{{ route('send-message') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="chat_bottom">
                        <div class="input-group send_message">
                            <input type="text" class="form-control" placeholder="Введите сообщение" name="message">
                            <i class="fas fa-link choose_chat_image"></i>
                        </div>
                        <button class="f-36 text-white">Отправить</button>
                    </div>
                    <input type="file" name="image" class="chat_image">
                    <input type="hidden" name="conversation_id" value="{{ $id }}">
                </form>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('footer')
    @foreach($chat_user as $c => $chat_u)
        @if($chat_u->id != $user_id)
            @php
                $chat = App::make('chat');
                $moder_chat = $chat->conversations()->between($chat_u->id, 1);
            @endphp
            @if(is_null($moder_chat))
                <script>
                    $(document).ready(function () {
                        $(document).on('click', '.fa-check', function () {
                            $('.message_left i').hide();
                            $(this).css('display', 'block');
                            var answer = $(this).parent().find('p').text();

                            jQuery.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "{{ route('set-answer') }}",
                                method: 'post',
                                data: {
                                    id: '{{ $question->id }}',
                                    answer: answer,
                                },
                                success: function(result){

                                }});
                        })
                    });
                </script>
            @endif
        @endif
    @endforeach
@endsection