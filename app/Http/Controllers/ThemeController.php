<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Theme::orderByDesc('id')->paginate(10);
        return view('themes.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('themes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
        ]);

        $input = $request->all();

        $user = Theme::create($input);

        return redirect()->route('themes.index')
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
        $user = Theme::find($id);
        return view('themes.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Theme::find($id);


        return view('themes.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cat_name' => 'required',
        ]);


        $input = $request->all();

        $user = Theme::find($id);
        $user->update($input);

        return redirect()->route('themes.index')
            ->with('success', 'Тема обнавлен');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Theme::find($id)->delete();
        return redirect()->route('themes.index')
            ->with('success', 'Тема удалено');
    }

    public function single($id){
        $theme = Theme::find($id);
        $questions = Question::where('moderation', 'success')
            ->where('theme', $id)
            ->paginate(10);
        return view('themes.themes', compact('theme', 'questions') );
    }

    public function search_question($id = null){
        $q = Input::get ( 'q' );

        $questions = Question::where('moderation', 'success')
            ->where('theme', $id)
            ->where('id', 'LIKE', '%'.$q.'%')
            ->orWhere('question','LIKE','%'.$q.'%')
            ->where('category', $id)
            ->paginate(10);

        $theme = Theme::find($id);

        if(count($questions) > 0 )
            return view('themes.themes-search', compact('q' , 'questions' , 'theme'))->withDetails($questions)->withQuery ( $q );
        else{
            $questions = Question::where('moderation', 'success')
                ->where('theme', $id)
                ->paginate(10);
            return view ('themes.themes-search', compact('q' , 'theme', 'questions'))->with('message', 'No Details found. Try to search again !');
        }
    }



}
