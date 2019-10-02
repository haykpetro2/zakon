<?php

namespace App\Http\Controllers;

use App\Category;
use App\Document;
use App\Info;
use App\Question;
use App\Review;
use App\Theme;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Spatie\Searchable\Search;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index($id = null)
    {
        if( $id && is_null(User::find($id)) ){
            abort(404);
        }
        $chat = App::make('chat');
        $user = Auth::user();

        /* Documents count */
        $documents = count(Document::all());

        /* Questions count */

        $questions = count(Question::where('moderation' , 'success')->get());

        /* Categories */
        $categories = Category::all();

        /* Infos */
        $info_phone = Info::where('name', 'Phone')->first();
        $info_email = Info::where('name', 'Email')->first();
        $info_address = Info::where('name', 'Address')->first();
        $info_vk = Info::where('name', 'VK')->first();
        $info_fb = Info::where('name', 'FB')->first();
        $info_insta = Info::where('name', 'Insta')->first();
        $info_documents = Info::where('name', 'Documents')->first();
        $info_consultations = Info::where('name', 'Consultations')->first();
        $info_public = Info::where('name', 'Public Law')->first();
        $info_private = Info::where('name', 'Private Law')->first();

        /* Month names */
        $month_name = array(
            '01' => 'Январь',
            '02' => 'Февраль',
            '03' => 'Март',
            '04' => 'Апрель',
            '05' => 'Май',
            '06' => 'Июнь',
            '07' => 'Июль',
            '08' => 'Август',
            '09' => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь',
        );

        /* Themes */

        $themes = Theme::take(6)->get();

        /* Payments */

        $payments = Question::where('paid', 'true')->paginate(5);

        if(!is_null($id) && !$user->hasRole('Moderator')){
            abort(404);
        }elseif ($id == 1 && $user->hasRole('Moderator')){
            return view('users.home', compact('documents', 'questions', 'info_phone', 'info_email', 'info_address', 'info_vk', 'info_fb', 'info_insta', 'info_documents', 'info_consultations', 'info_public', 'info_private', 'themes' ));
        }elseif( !is_null($id) && $user->hasRole('Moderator') && User::find($id)->hasRole('Lawyer') ){
            $conversations = $chat->conversations()->setUser(User::find($id))->get();
            $offer = Question::where('lawyer_id' , $id)->latest()->first();
            return view('lawyer.archive' , compact( 'categories','month_name', 'conversations', 'offer'));
        }elseif (!is_null($id) && $user->hasRole('Moderator') && User::find($id)->hasRole('User') ){
            return view('users.home', compact('documents', 'questions', 'info_phone', 'info_email', 'info_address', 'info_vk', 'info_fb', 'info_insta', 'info_documents', 'info_consultations', 'info_public', 'info_private', 'themes' ));
        }

        if ($user){

            if ($user->hasRole('Moderator')){
                $users = User::role('User')->get();
                $lawyers = User::role('Lawyer')->get();

                return view('moderator.moderator' , compact('users', 'lawyers', 'categories' , 'month_name', 'payments'));
            }elseif($user->hasRole('Lawyer')){
                $user = Auth::user();
                $conversations = $chat->conversations()->setUser($user)->get();
                $lawyer_documents = Document::where('user_id' , Auth::user()->id);
                $offer = Question::where('lawyer_id' , Auth::user()->id)->latest()->first();
                return view('lawyer.archive', compact('conversations', 'categories', 'lawyer_documents' , 'month_name', 'offer'));
            }else{
                return view('users.home', compact('documents', 'questions', 'info_phone', 'info_email', 'info_address', 'info_vk', 'info_fb', 'info_insta', 'info_documents', 'info_consultations', 'info_public', 'info_private', 'themes'));
            }

        }else{
            return view('users.home', compact('documents', 'questions','info_phone', 'info_email', 'info_address', 'info_vk', 'info_fb', 'info_insta', 'info_documents', 'info_consultations', 'info_public', 'info_private', 'themes'));
        }
    }

    public function search( Request $request)
    {

        $searchterm = $request->input('query');

        $searchResults = (new Search())
            ->registerModel(Question::class, 'question')
            ->registerModel(Review::class, 'review')
            ->registerModel(Document::class, 'document_name')
            ->perform($request->input('query'));

        return view('search', compact('searchResults', 'searchterm'));
    }

    public function more_themes(Request $request){

        $themes = Theme::whereNotIn('id', $request->themes)->take(4)->get();

        return $themes;
    }

}
