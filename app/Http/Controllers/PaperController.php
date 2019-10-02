<?php

namespace App\Http\Controllers;

use App\Category;
use App\Paper;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    public function index(Request $request)
    {
        $data = Paper::orderByDesc('id')->paginate(10);
        return view('papers.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $categories = Category::all();
        return view('papers.create' , compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();
        Paper::create($input);
        return redirect()->route('papers.index');
    }

    public function show($id)
    {
        $user = Paper::find($id);
        return view('papers.show', compact('user'));
    }

    public function edit($id)
    {
        $page = Paper::find($id);
        $categories = Category::all();

        return view('papers.edit', compact('page' , 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();
        $page = Paper::find($id);
        $page->update($input);

        return redirect()->route('papers.index')
            ->with('success', 'Информация обнавлен');
    }

    public function destroy($id)
    {
        Paper::find($id)->delete();
        return redirect()->route('papers.index')
            ->with('success', 'Информация удалено');
    }

    /* Custom functions */

    public function paperwork(){
        $categories = Category::all();
        return view('papers.paperwork', compact('categories'));
    }

    public function ajax_papers(Request $request){
        $paper_ids = $request->papers;

        $papers = Paper::whereNotIn('id', $paper_ids)->paginate(2);

        if($papers){
            echo '';
        }

        foreach ($papers as $paper) {
            echo '<p class="card-text f-24 mt-3 mx-3">
                        <a href="' . route('consulting' , ['get' , 'category' => $request->category_id, 'name' => $paper->name ]) . '" >' . $paper->name . '</a>
                        <input type="hidden" name="paper_id" value="' . $paper->id . '" class="paper_ids">
                    </p>';
        }

    }

}
