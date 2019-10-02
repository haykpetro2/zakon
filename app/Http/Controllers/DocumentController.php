<?php

namespace App\Http\Controllers;

use App\Category;
use App\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $chat = App::make('chat');

        $cur_user = Auth::user();

        $hasPerm = $chat->conversations()->between($cur_user->id, $id);
        $hasPerm = is_object($hasPerm);

        if($cur_user->id != $id && !$hasPerm && !Auth::user()->hasRole('Moderator')){
            abort(404);
        }

        $years = Document::where('user_id', '=' , $id)
            ->orderByRaw('created_at DESC')
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('Y');
            });

        if(isset($_GET['year'])){
            $documents = Document::where('user_id', '=' , $id)->whereYear('created_at', '=', $_GET['year'])->get();
        }else{
            $documents = Document::where('user_id', '=' , $id)->get();
        }

        $categories = Category::all();

        return view('documents' , compact('id' , 'documents', 'years', 'categories'));
    }

    public function upload_document(Request $request){
        $this->validate($request, [
            'document_name' => 'required',
            'document_file' => 'required|max:20480',
            'category' => 'required',
        ]);

        $avatarName = 'document-'.time().'-'.request()->document_file->getClientOriginalName();

        $request->document_file->storeAs('public/documents',$avatarName);

        $input = $request->all();
        $input['date'] = strtotime( date("Y-m-d") );
        $input['document_file'] = $avatarName;


        Document::create($input);

        return redirect()->back();
    }

}
