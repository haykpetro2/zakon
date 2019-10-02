@extends('layouts.main')

@section('header')

@endsection

@section('content')

    <div class="content chat">

        <div class="chat_header d-flex justify-content-between">
            <div class="col-md-4 col-sm-12 chat_users">
                <div class="row ml-5 text-white">
                    @if( $users->isEmpty() )
                        <h2 class="text-center text-white my-5 mx-auto">No conversations</h2>
                    @else
                        @foreach($conversations as $c => $conversation)
                            <div class="col-md-4 col-sm-4 col">
                                @php
                                $chat_users = $conversation->users;
                                foreach ($chat_users as $chat_user){
                                    if($chat_user->id != $id ){
                                        $this_user = $chat_user->id;
                                    }
                                }
                                @endphp
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Moderator') )
                                    <a href="{{ route('conversations', [$conversation->id, $this_user] ) }}">
                                @else
                                    <a href="{{ route('conversations', $conversation->id ) }}">
                                @endif
                                    @foreach($conversation->users as $i => $user)
                                        @if(is_null($id) )
                                            @if($user->id != Auth::user()->id)
                                                @if( Auth::user()->hasRole('Lawyer') )
                                                    <h3 class="f-40 white_color py-5">
                                                        @if($user->first_name)
                                                            {{ $user->first_name }}
                                                        @elseif($user->login)
                                                            {{ $user->login }}
                                                        @else
                                                            Noname
                                                        @endif
                                                    </h3>
                                                @else
                                                    <img src="{{ asset('storage/lawyers/'.$user->image) }}" alt="chat image" class="chat_images">
                                                @endif
                                            @endif
                                        @else
                                            @if($user->id != $id)
                                                @if( \App\User::find($id)->hasRole('Lawyer') )
                                                    <h3 class="f-40 white_color py-5">
                                                        @if($user->first_name)
                                                            {{ $user->first_name }}
                                                        @elseif($user->login)
                                                            {{ $user->login }}
                                                        @else
                                                            Noname
                                                        @endif
                                                    </h3>
                                                @else
                                                    <img src="{{ asset('storage/lawyers/'.$user->image) }}" alt="chat image" class="chat_images">
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>

@endsection

@section('footer')

@endsection