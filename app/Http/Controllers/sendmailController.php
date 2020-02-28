<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\sendmail;
   use App\categories;
class sendmailController extends Controller
{
    //
    public function contact(){
        $cat=categories::all();
        return view('normal users.contact')->with('cat',$cat);
    }

    public function send(Request $request){
        $request->validate([
            'name'=>'required|max:30',
            'email'=>'required|email',
            'phone'=>'required|min:11|max:11',
            'message'=>'required'
        ]);
        $data = array(
            'name'      =>  $request->name,
            'email'      =>  $request->email,
            'message'   =>   $request->message,
            'phone'   =>   $request->phone
        );

     Mail::to('kirolloswafic@gmail.com')->send(new sendmail($data));
     return back()->with('success', 'Thanks for contacting us!');

    }
}
