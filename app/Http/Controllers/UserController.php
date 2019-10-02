<?php


namespace App\Http\Controllers;


use App\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(10);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'city' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $avatarName = 'avatar-'.time().'-'.request()->image->getClientOriginalName();

        $request->image->storeAs('public/lawyers',$avatarName);


        $input = $request->all();

        if($request->hasFile('contract')){
            $contract_name = 'contract-'.time().'-'.request()->contract->getClientOriginalName();

            $request->contract->storeAs('public/contracts',$contract_name);

            $input['contract'] = $contract_name;
        }

        $input['password'] = Hash::make($input['password']);
        $input['image'] = $avatarName;

        $first = substr($request->password, 0 , 1);
        $last = substr($request->password, -1);
        $password_settings = $first.'******'.$last;
        $input['password_settings'] = $password_settings;

        $user = User::create($input);
        if($request->card){
            Card::create([
                'user_id' => $user->id,
                'number' => $request->card
            ]);
        }
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('users.edit',compact('user','roles','userRole'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }

    /**
     * Settings
     */

    public function settings(){
        $card = Card::find(Auth::user()->id);
        return view('settings', compact('card'));
    }

    public function change_login(Request $request){
        $validator = Validator::make($request->all(), [
            'login' => 'required|unique:users',
        ]);

        if ($validator->passes()) {
            $input = $request->all();
            $user = User::find(Auth::user()->id);
            $user->update($input);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function change_password(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if ($validator->passes()) {
            $first = substr($request->password, 0 , 1);
            $last = substr($request->password, -1);
            $password_settings = $first.'******'.$last;
            $user = User::find(Auth::user()->id);
            $user->update([
                'password' => Hash::make($request->password),
                'password_settings' => $password_settings,
            ]);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function change_phone(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users',
        ]);

        if ($validator->passes()) {
            $input = $request->all();
            $user = User::find(Auth::user()->id);
            $user->update($input);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function change_email(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
        ]);

        if ($validator->passes()) {
            $input = $request->all();
            $user = User::find(Auth::user()->id);
            $user->update($input);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function change_card(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'number' => 'required|unique:cards|min:16|max:16',
            'code' => 'required|numeric',
            'month' => 'required',
            'year' => 'required',
        ]);

        if ($validator->passes()) {
            Card::updateOrCreate(
                ['id' => Auth::user()->id],
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'number' => $request->number,
                    'code' => $request->code,
                    'month' => $request->month,
                    'year' => $request->year,
                ]
            );
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function delete_card(){
        $card = Card::find(Auth::user()->id);
        $card->delete();
    }

    public function delete_user(){
        $user = User::find(Auth::user()->id);
        $user->delete();
    }

    public function edit_lawyer($id){
        $lawyer = User::find($id);
        $card = Card::where('user_id', $id)->first();
        return view('lawyer.edit-profile' , compact('lawyer', 'card'));
    }

    public function edit_lawyer_form(Request $request){
        $this->validate($request, [
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if($request->hasFile('image')){
            $avatarName = 'avatar-'.time().'-'.request()->image->getClientOriginalName();
            $request->image->storeAs('public/lawyers',$avatarName);
            $input['image'] = $avatarName;
        }

        if($request->hasFile('contract')){
            $contract_name = 'contract-'.time().'-'.request()->contract->getClientOriginalName();

            $request->contract->storeAs('public/contracts',$contract_name);

            $input['contract'] = $contract_name;
        }

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        if($request->card){
            Card::updateOrCreate(
                ['user_id' => $request->lawyer_id],
                ['number' => $request->card]
            );
        }

        $user = User::find($request->lawyer_id);
        $user->update($input);

        return redirect()->back();
    }

    public function office($id = null){
        if($id && !Auth::user()->hasRole('Moderator') ){
            abort(404);
        }elseif (Auth::user()->hasRole('Moderator')){
            return view('office', compact('id'));
        }else{
            return view('office');
        }
    }

    public function problem($id = null){
        $user = Auth::user();
        return view('mail.problem-desc', compact('user' , 'id' ));
    }

}