<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ReviewsController extends Controller
{
    public function rating($id)
    {

        if (Auth::user()->hasRole('Lawyer')) {
            abort('404');
        }

        $chat = App::make('chat');
        $question = Question::where('id', $id)->firstOrFail();
        $conversation = $chat->conversations()->between($question->lawyer_id, Auth::user()->id);
        $already = Review::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$conversation) {
            abort(404);
        } elseif ($already) {
            return view('rate')->with('successMsg', 'Already commented');
        } else {
            return view('rate', compact('question' , 'id'));
        }
    }

    public function add_review(Request $request)
    {
        $this->validate($request, [
            'review' => 'required'
        ]);

        $input = $request->all();
        $input['moderation'] = 'processing';

        Review::create($input);

        return redirect()->route('offer', $request->question_id);
    }

    public function user_reviews($id , $category = null)
    {
        $user = User::find($id);
        if (!$user->hasRole('Lawyer')) {
            abort(404);
        }

        if($category){
            $category_name = Category::find($category);
            $reviews = Review::where('lawyer_id',$id)->where('category',$category)->get();
            $questions = Question::where('lawyer_id',$id)->where('category',$category)->get();
            $speed = array();
            $communication = array();
            $result = array();
            $professional = array();
            foreach ($reviews as $review){
                $speed[] = $review->speed;
                $communication[] = $review->communication;
                $result[] = $review->result;
                $professional[] = $review->professional;
            }

            if (!empty($speed)){
                $speed = array_sum($speed)/count($speed);
                $communication = array_sum($communication)/count($communication);
                $result = array_sum($result)/count($result);
                $professional = array_sum($professional)/count($professional);
            }else{
                $speed = 0;
                $communication = 0;
                $result = 0;
                $professional = 0;
            }



            return view('reviews.user-reviews', compact( 'user','reviews', 'category_name', 'questions', 'speed', 'communication', 'result', 'professional') );

        }else{
            /* Ratings */
            $speed = round($user->reviews->avg('speed'), 1);
            $communication = round($user->reviews->avg('communication'), 1);
            $result = round($user->reviews->avg('result'), 1);
            $professional = round($user->reviews->avg('professional'), 1);

            return view('reviews.user-reviews', compact( 'user', 'speed', 'communication', 'result', 'professional') );

        }

    }

    public function review(){
        $reviews = Review::where('moderation', 'success')->paginate(10);
        $questions = Question::where('moderation', 'success')->paginate(10);
        return view('reviews.review', compact('reviews', 'questions'));
    }

    public function search_review($id = null){
        $q = Input::get ( 'q' );
        $date = date_create_from_format('d.m.Y', $q);
        if ($date === FALSE) {
            $date = 0;
        }else{
            $date = strtotime($q);
        }

        if($id){
            $review = Review::find($id);
        }

        $reviews = DB::table('questions')
            ->join('reviews', 'questions.id', '=', 'reviews.question_id')
            ->select('questions.*', 'reviews.*')
            ->where('reviews.review','LIKE','%'.$q.'%')
            ->orWhere('reviews.id','LIKE','%'.$q.'%')
            ->orWhere('questions.lawyer_name','LIKE','%'.$q.'%')
            ->orWhere('questions.date','=',$date)
            ->paginate(10);
        if(count($reviews) > 0 && isset($review))
            return view('reviews.review-search', compact('q' , 'review'))->withDetails($reviews)->withQuery ( $q );
        else return view ('reviews.review-search')->withMessage('No Details found. Try to search again !');
    }

}
