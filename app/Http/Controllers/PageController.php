<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Page::orderByDesc('id')->paginate(10);
        return view('pages.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'page_content' => 'required',
        ]);

        $input = $request->all();
        Page::create($input);
        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Page::find($id);
        return view('pages.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);


        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'page_content' => 'required',
        ]);

        $input = $request->all();
        $page = Page::find($id);
        $page->update($input);

        return redirect()->route('pages.index')
            ->with('success', 'Страница обнавлен');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::find($id)->delete();
        return redirect()->route('pages.index')
            ->with('success', 'Страница удалено');
    }

    public function info(){
        $info = Page::where('name' , 'Информация по сайту')->first();
        return view('pages.info', compact('info'));
    }

    public function about(){
        $about = Page::where('name' , 'О компании')->first();
        return view('pages.about', compact('about'));
    }

    public function offer_terms(){
        $terms = Page::where('name' , 'Ознакомьтесь с условиями оферты')->first();
        return view('pages.offer-terms', compact('terms'));
    }

}
