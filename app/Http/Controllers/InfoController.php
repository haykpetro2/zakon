<?php

namespace App\Http\Controllers;

use App\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Info::orderByDesc('id')->paginate(10);
        return view('infos.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('infos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();
        Info::create($input);
        return redirect()->route('infos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Info::find($id);
        return view('infos.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Info::find($id);


        return view('infos.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();
        $page = Info::find($id);
        $page->update($input);

        return redirect()->route('infos.index')
            ->with('success', 'Информация обнавлен');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Info::find($id)->delete();
        return redirect()->route('infos.index')
            ->with('success', 'Информация удалено');
    }

    public function contact(){
        $phone = Info::where('name', 'Phone')->first();
        $email = Info::where('name', 'Email')->first();
        $address = Info::where('name', 'Address')->first();
        return view('infos.contact' , compact('phone','email', 'address'));
    }

    public function report(){
        $phone = Info::where('name', 'Phone')->first();
        $email = Info::where('name', 'Email')->first();
        return view('infos.report' , compact('phone','email'));
    }

}
