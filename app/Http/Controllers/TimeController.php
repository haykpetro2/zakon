<?php

namespace App\Http\Controllers;

use App\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Time::orderByDesc('id')->paginate(10);
        return view('times.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('times.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'week_day' => 'required',
            'times' => 'required',
        ]);

        $json = json_encode($request->times);

        $input = $request->all();
        $input['times'] = $json;

        Time::create($input);

        return redirect()->route('times.index')
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
        $user = Time::find($id);
        return view('times.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Time::find($id);
        $times = json_decode($category->times);

        return view('times.edit', compact('category', 'times'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'week_day' => 'required',
            'times' => 'required',
        ]);

        $json = json_encode($request->times);

        $input = $request->all();
        $input['times'] = $json;

        $time = Time::find($id);
        $time->update($input);

        return redirect()->route('times.index')
            ->with('success', 'Обнавлен');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Time::find($id)->delete();
        return redirect()->route('times.index')
            ->with('success', 'Удален');
    }


}
