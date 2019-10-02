@extends('layouts.main')

@section('header')

@endsection

@section('content')

    <div class="content chat">

        <div class="chat_header d-flex justify-content-between">
            <div class="col-md-4 col-sm-12 chat_users">
                <div class="row ml-5">
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
                                            <img src="{{ asset('storage/lawyers/'.$user->image) }}" alt="chat image" class="chat_images">
                                        @endif
                                    @else
                                        @if($user->id != Auth::user()->id)
                                            <img src="{{ asset('storage/lawyers/'.$user->image) }}" alt="chat image" class="chat_images">
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
            <div class="col-md-8 col-sm-12 chat_buttons">
                <div class="chat_header_texts">
                    <p class="f-30"><a href="{{ route('documents' , Auth::user()->id) }}">Добавить документ</a></p>
                    <p class="f-30"><a href="{{ route('offer', $question->id) }}">Оферта</a></p>
                    <p class="f-30"><a href="{{ route('offer', $question->id) }}">Оплатить консультацию</a></p>
                </div>
                <div class="chat_header_my_image">
                    @foreach($chat_user as $chat_u)
                        @if( !is_null($user_view) )
                            @if($chat_u->id != $user_view)
                                <img src="{{ asset('storage/lawyers/'.$chat_u->image) }}" alt="my image" class="chat_big_image">
                            @endif
                        @else
                            @if($chat_u->id != $user_id)
                                <img src="{{ asset('storage/lawyers/'.$chat_u->image) }}" alt="my image" class="chat_big_image">
                            @endif
                        @endif
                    @endforeach
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

@endsection