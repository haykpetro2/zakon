<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id = null)
    {
        if($id && !Auth::user()->hasRole('Moderator')){
            abort(404);
        }
        $chat = App::make('chat');
        $current_user = Auth::user();
        if($id && Auth::user()->hasRole('Moderator')){
            $conversations = $chat->conversations()->setUser(User::find($id))->get();
        }else{
            $conversations = $chat->conversations()->setUser($current_user)->get();
        }
        $users = array();
        foreach ($conversations as $conversation) {
            $users_all = $conversation->users;
            foreach ($users_all as $user) {
                if($user->id != $current_user->id){
                    $users[] = $user->id;
                }
            }
        }
        $users = User::whereIn('id', $users)->get();
        return view('chat.chat-client', compact('conversations','users','id'));
    }

    public function create_conversation($user_id, $question_id){
        $chat = App::make('chat');
        $current_id = Auth::user()->id;
        $conversation = $chat->conversations()->between($current_id, $user_id);
        if( is_null($conversation) ){
            $participants=[$current_id,$user_id];
            $conversation = $chat->createConversation($participants);
        }
        $cur_question = Question::find($question_id);
        $cur_question->update([
            'lawyer_id' => $current_id
        ]);

        $chat_user = User::find($user_id);
        $chat_user->update([
            'chat_ready' => 1
        ]);

        return redirect()->route('conversations', $conversation->id);
    }

    public function moder_conversation($user_id){
        $chat = App::make('chat');
        $current_id = Auth::user()->id;
        $conversation = $chat->conversations()->between($current_id, $user_id);
        if( is_null($conversation) ){
            $participants=[$current_id,$user_id];
            $conversation = $chat->createConversation($participants);
        }

        return redirect()->route('conversations', $conversation->id);
    }

    public function conversations($id, $user_view = null)
    {
        $chat = App::make('chat');
        if($user_view){
            $current_user = User::find($user_view);
        }else{
            $current_user = Auth::user();
        }
        $user_id = Auth::user()->id;

        /* Current Conversation */
        $conversation = $chat->conversations()->getById($id);

        /* Chat User */

        $chat_user = $conversation->users;

        $check_perm = array();
        foreach ($chat_user as $cus){

            $check_perm[] = $cus->id;
            if(User::find($cus->id)->hasRole('Lawyer')){
                $lid = $cus->id;
            }else{
                $uid = $cus->id;
            }
        }

        $lawyer = User::find($lid);

        /* Conversations List */
        if ( !in_array($current_user->id, $check_perm) && Auth::user()->hasRole('Moderator') ){
            $conversations = $chat->conversations()->setUser($lawyer)->get();
        }else{
            $conversations = $chat->conversations()->setUser($current_user)->get();
        }

        /* Users */
        $users_list = array();
        foreach ($conversations as $convers) {
            $users_all = $convers->users;
            foreach ($users_all as $user) {
                if($user->id != $current_user->id){
                    $users_list[] = $user->id;
                }
            }
        }

        /* Messages */
        if ( !in_array($current_user->id, $check_perm) && Auth::user()->hasRole('Moderator') ){
            $messages = $chat->conversation($conversation)->setUser($lawyer)->getMessages();
        }else{
            $messages = $chat->conversation($conversation)->setUser($current_user)->getMessages();
        }

        if ( !in_array($user_id, $check_perm) && !Auth::user()->hasRole('Moderator') ){
            abort(404);
        }

        if ($current_user->hasRole('Lawyer') || $current_user->hasRole('Moderator')){
            /* Question id */

            $question = Question::where('user_id', $uid)->where('lawyer_id', $lid)->first();

            return view('chat.conversations-lawyer', compact('conversations', 'messages', 'id', 'user_id', 'chat_user', 'question', 'user_view' ));
        }else{
            $question = Question::where('user_id', $uid)->where('lawyer_id', $lid)->first();
            return view('chat.conversations', compact('conversations', 'messages', 'id', 'user_id', 'chat_user', 'question', 'user_view' ));
        }

    }

    public function send_message(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $chat = App::make('chat');
        $current_id = Auth::user();
        $conversation = $chat->conversations()->getById($request->conversation_id);

        $message = $request->message;

        $chat->message($message)
            ->from($current_id)
            ->to($conversation)
            ->send();

        if ($request->hasFile('image')){
            $avatarName = 'chat-'.time().'-'.request()->image->getClientOriginalName();

            $request->image->storeAs('public/conversations',$avatarName);

            $url = asset('storage/conversations/'.$avatarName);

            $message = $chat->message($url)
                ->type('image')
                ->from($current_id)
                ->to($conversation)
                ->send();

        }

        return redirect()->back();
    }

}
