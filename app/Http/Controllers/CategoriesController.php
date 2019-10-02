<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Category::orderByDesc('id')->paginate(10);
        return view('categories.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cat_name' => 'required',
            'image' => 'required'
        ]);

        $input = $request->all();

        $categoryName = 'category-'.time().'-'.request()->image->getClientOriginalName();
        $request->image->storeAs('public/categories',$categoryName);
        $input['image'] = $categoryName;

        $user = Category::create($input);

        return redirect()->route('categories.index')
            ->with('success', 'Создан');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Category::find($id);
        return view('categories.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);


        return view('categories.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cat_name' => 'required',
            'image' => 'required',
        ]);


        $input = $request->all();

        $categoryName = 'category-'.time().'-'.request()->image->getClientOriginalName();
        $request->image->storeAs('public/categories',$categoryName);
        $input['image'] = $categoryName;

        $user = Category::find($id);
        $user->update($input);

        return redirect()->route('categories.index')
            ->with('success', 'Категория обнавлен');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Категория удалено');
    }

    public function single($id){
        $category = Category::find($id);
        $questions = Question::where('moderation', 'success')
            ->where('category', $id)
            ->paginate(10);
        return view('categories.solved-example', compact('category', 'questions') );
    }

    public function search_question($id = null){
        $q = Input::get ( 'q' );

        $questions = Question::where('moderation', 'success')
            ->where('category', $id)
            ->where('id', 'LIKE', '%'.$q.'%')
            ->orWhere('question','LIKE','%'.$q.'%')
            ->where('category', $id)
            ->paginate(10);

        $category = Category::find($id);

        if(count($questions) > 0 )
            return view('categories.questions-search', compact('q' , 'questions' , 'category'))->withDetails($questions)->withQuery ( $q );
        else{
            $questions = Question::where('moderation', 'success')
                ->where('category', $id)
                ->paginate(10);
            return view ('categories.questions-search', compact('q' , 'category', 'questions'))->with('message', 'No Details found. Try to search again !');
        }
    }

    public function services(){
        $categories = Category::all();
        return view('labor-law', compact('categories'));
    }

}
