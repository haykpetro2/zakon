<?php

namespace App\Http\Controllers;

use App\Category;
use App\Info;
use App\Report;
use App\Review;
use App\Theme;
use App\User;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QuestionsController extends Controller
{

    public function index($id = null) {
        if($id == 'get'){
            $lawyer_id = 0;
        }else{
            $lawyer_id = $id;
        }
        $lawyer = User::find($lawyer_id);

        if($lawyer && !$lawyer->hasRole('Lawyer')){
            abort(404);
        }

        $categories = Category::all();

        return view('consulting' , compact('lawyer_id','lawyer','categories'));
    }

    public function send_question(Request $request){

        if(Auth::check()){
            $validator = $this->validate($request, [
                'category' => 'required',
                'question' => 'required',
            ]);

            $new_questions = Question::create([
                'user_id' => $request->user_id,
                'lawyer_id' => $request->lawyer_id,
                'category' => $request->category,
                'question' => $request->question
            ]);

            $data = $request->all();
            $data['que_id'] = $new_questions->id;


        }else{
            $validator = $this->validate($request, [
                'category' => 'required',
                'question' => 'required',
                'phone' => 'required|unique:users',
            ]);

            $new_user = User::updateOrCreate([
                'phone' => $request->phone,
                'chat_ready' => 0
            ]);

            $new_questions = Question::create([
                'user_id' => $new_user->id,
                'lawyer_id' => $request->lawyer_id,
                'category' => $request->category,
                'question' => $request->question
            ]);

            $data = $request->all();

            $data['phone'] = $request->phone;
            $data['lawyer_id'] = $request->lawyer_id;
            $data['user_id'] = $new_user->id;
            $data['que_id'] = $new_questions->id;


            Cookie::queue('user_phone', $request->phone, 2678400);

        }

        Mail::send('mail.question', $data, function($message) use ($data) {
            if( !is_null($data['lawyer_id']) ){
                $form_email = User::find($data['lawyer_id'])->email;
            }else{
                $form_email = Info::where('name', 'Email From')->first()->value;
            }
            $message->to($form_email, 'Пользователь')->subject('Новый вопрос');
            $message->from('examplte@gmail.com','Закон Прост');
        });

        return redirect()->route('consulting')->with('success','Отправлено');

    }


    /**
     * New
     */

    public function deal($id = null){
        $chat = App::make('chat');
        $deal = Question::where('id', $id)->firstOrFail();
        $client_name = User::find($deal->user_id);
        $conversation = $chat->conversations()->between($deal->lawyer_id, $client_name);
        if(is_null($conversation)){
            abort(404);
        }else{
            return view('offer', compact(['deal', 'id', 'client_name', 'conversation']));
        }
    }

    public function create_deal(Request $request , $id){
        $this->validate($request , [
            'name' => 'required',
            'lawyer_name' => 'required',
            'date' => 'required',
            'price' => 'required|numeric',
        ]);

        $time = strtotime($request->date);

        $deal = Question::where('id', $id)->update([
                'name' => $request->name,
                'lawyer_name' => $request->lawyer_name,
                'date' => $time,
                'price' => $request->price,
            ]);

        return redirect()->route('offer', $id);

    }

    public function offer_check(Request $request){
        $input = $request->all();

        $deal = Question::find($input['id']);

        if(Auth::user()->hasRole('Lawyer') && is_null($deal->answer) && $input['held'] == 'true' ){
            return 'Укажите ответ в переписке';
        }

        if($input['paid'] == 'true' && $input['held'] == 'true' && $input['resolved'] == 'true' && $input['terms'] == 'true'){
            $input['status'] = 'closed';
            if(!is_null($deal->answer)){
                $input['moderation'] = 'processing';
            }
        }else{
            $input['status'] = 'open';
        }

        $deal->update($input);

    }

    public function set_price($id){
        $question = Question::find($id);
        $lawyer_id = Auth::user()->id;
        return view('lawyer.set-price', compact('id', 'lawyer_id', 'question'));
    }

    public function ask_question($id){
        $question = Question::where('id',$id)->firstOrFail();
        $user = User::find($question->lawyer_id)->firstOrFail();
        $categories = Category::all();
        return view('ask-question', compact('question', 'user', 'categories'));
    }

    public function my_advice($id){
        if($id && !Auth::user()->hasRole('Moderator') && Auth::user()->id != (int)$id){
            abort(404);
        }
        $advices = Question::where('user_id',$id)->where('moderation', 'success')->get();
        return view('my-advice', compact('advices'));
    }

    public function set_answer(Request $request){

        Question::where('id', $request->id)->update([
            'answer' => $request->answer,
        ]);

    }

    public function date_questions(Request $request){
        $normal_date = substr($request->date, 0, strpos($request->date, " GMT"));

        $date = strtotime($normal_date);
        $deals = Question::where('date' , $date)->get();

        $content = '<div class="col-lg-4 py-5"><h3 class="white_color f-36">Логин</h3></div>
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 text-center">Вопрос обращения</h3></div>
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 text-right">Юрист</h3></div>';
        foreach ($deals as $deal){
            $content .= '
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 ajax_deal_user"><a href="' . route('office' , $deal->user_id) .'" target="_blank">' . User::find($deal->user_id)->login .'</a></h3></div>
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 text-center ajax_deal_name"><a href="' . route('ask-question' , $deal->id) .'" target="_blank">' . $deal->question .'</a></h3></div>
                    <div class="col-lg-4 py-5"><h3 class="white_color f-36 text-right ajax_deal_lawyer"><a href="' . route('home' , $deal->lawyer_id) .'" target="_blank">' . $deal->lawyer_name .'</a></h3></div>';
        }

        $data = [$content , count($deals)];

        return $data;
    }

    public function new_deals(){
        $deals = Question::where('moderation', 'success')->get();
        return view('moderator.new-deals', compact('deals'));
    }

    public function deal_report(){
        $reports = Report::all();
        return view('moderator.moderator-report', compact('reports'));
    }

    public function lawyer_feedback($id , $user){
        $deals = DB::table('questions')
            ->join('reviews', 'questions.id', '=', 'reviews.question_id')
            ->select('questions.*', 'reviews.*')
            ->where('questions.category' , $id)
            ->where('questions.lawyer_id' , $user)
            ->where('questions.moderation', 'processing')
            ->orWhere('reviews.moderation', 'processing')
            ->where('questions.category' , $id)
            ->where('questions.lawyer_id' , $user)
            ->get();
        if($deals->isEmpty()){
            $deals = Question::where('category' , $id)
                ->where('lawyer_id' , $user)
                ->where('moderation', 'processing')
                ->get();
        }
        $user = User::find($user);
        $themes = Theme::all();
        return view('moderator.feedback-detailed' , compact('deals' , 'id', 'user', 'themes') );
    }

    public function moderation(){
        $deals = DB::table('questions')
            ->join('reviews', 'questions.id', '=', 'reviews.question_id')
            ->select('questions.*', 'reviews.*')
            ->where('questions.moderation', 'processing')
            ->orWhere('reviews.moderation', 'processing')
            ->get();
        if($deals->isEmpty()){
            $deals = Question::where('moderation', 'processing')->get();
        }
        $themes = Theme::all();
        return view('moderator.moderation' , compact('deals' ,'themes') );
    }

    public function success_deal(Request $request){
        $deal = Question::find($request->id);
        $deal->update([
            'theme' => $request->theme,
            'moderation' => 'success'
        ]);
        return redirect()->back();
    }

    public function hide_deal(Request $request){
        $deal = Question::find($request->id);
        $deal->update([
            'moderation' => 'hide'
        ]);
    }

    public function success_review(Request $request){
        $deal = Review::find($request->id);
        $deal->update([
            'moderation' => 'success'
        ]);
        return redirect()->back();
    }

    public function hide_review(Request $request){
        $deal = Review::find($request->id);
        $deal->update([
            'moderation' => 'hide'
        ]);
    }

    public function pending_payment(){
        $payments = Question::where('paid', 'true')->get();
        return view('moderator.pending-payment', compact('payments'));
    }

}
