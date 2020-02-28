<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=User::orderby('created_at','DESC')->where('id','!=',auth()->user()->id)->paginate(10);
        return view('admin.users.index')->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.createuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'photo' => ['image','nullable'],
            'usertype'=>'required',
            'phone'=>'required'
        ]);


        $user=new User;
        $user->Name=$request->name;
        $user->email=$request->email;
        $user->password = Hash::make($request->password);
        $user->admin=$request->usertype;
        $user->phonenumber=$request->phone;


        //photo
        if($request->hasFile('photo')){
        $photo=$request->photo;
        $photoname=time().'-'.$photo->getClientOriginalName();
        $photo->move(base_path().'/public/imges/imguser',$photoname);      
        $user->photo= $photoname;  
        }else{
            $user->photo='download.png';
        }
    $user->save();
    return redirect()->back()->with('success','the user added successfuly');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user=User::find($id);
        return view('admin.users.edituser')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user=User::find($id);
        $user->admin=$request->make;
        $user->save();
        return redirect()->route('alluser');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=User::find($id);
        $user->delete();
        return redirect()->back()->with('success','the user '.$user->name.' deleted successfully');
    }
}
