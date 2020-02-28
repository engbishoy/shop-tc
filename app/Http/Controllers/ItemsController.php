<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\categories;
use App\products;
use App\requests;
use App\chat;
use App\Notifications\requestnotifi;
use Hash;
use Carbon\Carbon;
class itemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


// main site

public function showproduct($id){
    $item=products::find($id);

    
   if(isset(auth()->user()->id)){
    $requeststatuewait=requests::where([
        ['user_id1','=',auth()->user()->id],
        ['user_id2','=',$item->user->id],
        ['accept','=',0]
    ]);
    $requeststatueaccept=requests::where([
        ['user_id1','=',auth()->user()->id],
        ['user_id2','=',$item->user->id],
        ['accept','=',1]
    ]);
   }else {
       $requeststatueaccept='';
       $requeststatuewait='';
   }
    $cat=categories::all();
    return view('normal users.items.showitem')->with('item',$item)
    ->with('cat',$cat)
    ->with('requeststatuewait',$requeststatuewait)
    ->with('requeststatueaccept',$requeststatueaccept);
}

// request

public function addrequest(Request $request){
    $requ=requests::create([
        'user_id1' => auth()->user()->id,
        'user_id2' => $request->user_id2,
        ]);

    $user=User::find($request->user_id2); 
    $user->notify(new \App\Notifications\requestnotifi($requ));
    return redirect()->back();
}

//readnotifi
public function readnotifi(){
    $user=auth()->user();    
    $user->unreadNotifications_addrequest->markAsRead();

}



//read notification confirm
public function readnotificonfirm(){
    $user=auth()->user();    
    $user->unreadnotifications_confirmrequest->markAsRead();

}


//confirm notification

public function confirmrequest(Request $request){

    $requ=requests::where([
        ['user_id1','=',$request->userid1],
        ['user_id2','=',$request->userid2]
    ])->update(array('accept' => 1));


    $userid=User::find($request->userid1);

    $userid2=User::find($request->userid2);
    $photo=$userid2->photo;
    $name=$userid2->name;

    $userid->notify(new \App\Notifications\confirmrequestnotifi($photo,$name));

    return redirect()->back();

}

//delete notification

public function delete_request(Request $request){

    requests::where([
        ['user_id1','=',$request->userid1],
        ['user_id2','=',$request->userid2]
    ])->delete();
    auth()->user()->notifications()->where('id','=',$request->notifiid)->delete();
    return redirect()->back();
}

//chat 

public function chat(){

    $cat=categories::all();
    $requests=requests::where([
        ['user_id1','=',auth()->user()->id],
        ['accept','=',1]
    ])->orWhere([
        ['user_id2','=',auth()->user()->id],
        ['accept','=',1]  
    ])->get();

    return view('normal users.chat.index')->with('requests',$requests)->with('cat',$cat);

}




public function chatgetuser($id){
    $user=User::find($id);
    $message=chat::where([
        ['from','=',$user->id],
        ['to','=',auth()->user()->id]
    ])->orWhere([
        ['from','=',auth()->user()->id],
        ['to','=',$user->id]
    ])->get();

    //end



    //to get sidbar friends
    $cat=categories::all();
    $requests=requests::where([
        ['user_id1','=',auth()->user()->id],
        ['accept','=',1]
    ])->orWhere([
        ['user_id2','=',auth()->user()->id],
        ['accept','=',1]  
    ])->get();
            
    return view('normal users.chat.message')->with('user',$user)->with('message',$message) 
     ->with('requests',$requests)->with('cat',$cat);;
}
 
    //seen

    public function seen(){
    auth()->user()->unreadNotifications_message->markAsRead();
    }

//typing chat

public function typingchat($id){

    $myid=auth()->user()->id;
    $myphoto=auth()->user()->photo;
    broadcast(new \App\Events\typingchat($id,$myid,$myphoto));

}


//send message
public function sendmessage(Request $request){

    $validate= Validator::make($request->all(), [
        'chat_photo_upload.*'=>'nullable|image'
    ]);
 

    if($validate->fails()){
        return response()->json($validate->errors());
    }


    $multiphoto='';

    $photo=$request->file('chat_photo_upload');
    if($photo){
        foreach($photo as $photos){
            
        $photoname=time().'_'.$photos->getClientOriginalName();
        $photos->move(base_path().'/public/imges/imgchat/',$photoname);
        $phototest[]=$photoname;
    }
    $multiphoto=implode(',',$phototest);

}
    
    $messagechat='';
    if($request->msg!=''){
        $messagechat=$request->msg;
    }

$message= chat::create([
    'from' =>auth()->user()->id,
    'to' => $request->to,
    'message' => $messagechat,
    'image' => $multiphoto,

]);

// message from user
broadcast(new \App\Events\sendmessage($message));
//end

//message to user
$to=$request->to;
$photouser=auth()->user()->photo;
$msg=$messagechat;
$recieveimg=$multiphoto;
broadcast(new \App\Events\recieve_message($to,auth()->user()->id,$photouser,$msg,$recieveimg));



// notifications message

$userid=User::find($request->to);
 $userid->notify(new \App\Notifications\message_notification($message));


}

//end



public function editprofile($id)
{
$profile=User::find($id);
$cat=categories::all();
return view('normal users.profile')->with('profileid',$profile)->with('cat',$cat);

}

public function updateprofile(Request $request, $id)
{
    $request->validate([

        'name' => ['required', 'string', 'max:20'],
        'password' => ['nullable','min:8'],
        'photo'=>['nullable','image'],
        'phone'=>['required','max:11','min:11']
    ]);


    $profile=User::find($id);
    $profile->name=$request->name;
    if(!empty($request->password)){
    $profile->password=Hash::make($request->password);
    }
    $profile->phonenumber=$request->phone;
    if($request->hasFile('photo')){
    $photo=$request->photo;
    $photoname=time().'-'.$photo->getClientOriginalName();
    $photo->move(base_path().'/public/imges/imguser/',$photoname);
    $profile->photo=$photoname;
    }
    $profile->save();
    return redirect()->back();



}


public function homecreateitem()
{
    //
    $cats=categories::all();
    return view('normal users.items.additem')->with('cat',$cats);
}


/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function homestoreitem(Request $request)
{
    //
  
    $request->validate([
        'name'=>'required|max:191',
        'describe'=>'required',
        'country'=>'required',
        'status'=>'required',
        'number'=>'required',
        'category'=>'required',
        'location'=>'required',
        'imgesitem.*'=>'image|required'

    ]);
   
    $item=new products;
    $item->name=$request->name;
    $item->description=$request->describe;
    $item->country=$request->country;
    $item->number_product=$request->number;
    $item->status_product=$request->status;
    $item->user_id=auth()->user()->id;
    $item->cat_id=$request->category;
    $item->location=$request->location;

$files=$request->file('imgesitem');
    foreach($files as $file){
        $photoname=time().'-'.$file->getClientOriginalName();
        $file->move(base_path().'/public/imges/imgitems',$photoname);
        $phototest[]=$photoname;
    }
    $implod=implode(',',$phototest);
    $item->photo=$implod;

if(auth()->user()->admin==1){
    $item->approve=1;

}

    $item->save();
    return redirect()->back()->with('success','Thank you '. auth()->user()->name .' The product added successfully please wait to accept from admin');




}




public function homemyitem()
{
    //
    $cats=categories::all();
    $item=products::orderby('created_at','desc')->where('user_id',auth()->user()->id)->get();
    return view('normal users.items.myitem')->with('item',$item)->with('cat',$cats);
}

public function homemyitemedit($id)
{

$cats=categories::all();
$value=products::find($id);
return view('normal users.items.edititem')->with('value',$value)->with('cat',$cats);

}


public function homemyitemupdate(Request $request,$id)
{
    
    

    $request->validate([
        'name'=>'required|max:191',
        'describe'=>'required',
        'country'=>'required',
        'status'=>'required',
        'number'=>'required',
        'category'=>'required',
        'location'=>'required',
        'imgesitem.*'=>'image|required'
    ]);

    $item=products::find($id);

    $item->name=$request->name;
    $item->description=$request->describe;
    $item->country=$request->country;
    $item->number_product=$request->number;
    $item->status_product=$request->status;
    $item->cat_id=$request->category;

    $item->location=$request->location;


    $files=$request->file('imgesitem');
    if($files){

    foreach($files as $file){
        $photoname=time().'-'.$file->getClientOriginalName();
        $file->move(base_path().'/public/imges/imgitems',$photoname);
        $phototest[]=$photoname;
    }
    $implod=implode(',',$phototest);
    $item->photo=$implod;

    }
    $item->save();
    return redirect('/myitem')->with('success','Updated successfully');

}

public function homemyitemdelete($id)
{
$myitem=products::find($id);
$myitem->delete();
return redirect()->back()->with('success','Delete Successfully');

}


//end










//admin


    public function index()
    {
        //
        $item=products::orderby('created_at','desc')->paginate(10);
        return view('admin.items.index')->with('item',$item);
        
    }


    public function myitem()
    {
        //
        $item=products::orderby('created_at','desc')->where('user_id',auth()->user()->id)->get();
        return view('admin.items.myitem')->with('item',$item);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cat=categories::all();
        return view('admin.items.additem')->with('cat',$cat);
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
            'name'=>'required|max:191',
            'describe'=>'required',
            'country'=>'required',
            'status'=>'required',
            'number'=>'required',
            'category'=>'required',
            'location'=>'required',
            'imgesitem.*'=>'image|required'

        ]); 
       
        $item=new products;
        $item->name=$request->name;
        $item->description=$request->describe;
        $item->country=$request->country;
        $item->number_product=$request->number;
        $item->status_product=$request->status;
        $item->user_id=auth()->user()->id;
        $item->cat_id=$request->category;
        $item->location=$request->location;

        $files=$request->file('imgesitem');
        foreach($files as $file){
            $photoname=time().'-'.$file->getClientOriginalName();
            $file->move(base_path().'/public/imges/imgitems',$photoname);
            $phototest[]=$photoname;
        }
        $implod=implode(',',$phototest);
        $item->photo=$implod;
    

        if(auth()->user()->admin==1){
            $item->approve=1;
        
        }
        $item->save();
        return redirect()->back()->with('success','successfully Done');;


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
        $items=products::find($id);
        return view('admin.items.showitem')->with('items',$items);
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
        $cat=categories::all();
 
        $value=products::find($id);
        return view('admin.items.edititem')->with('value',$value)->with('cat',$cat);
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

        $request->validate([
            'name'=>'required|max:191',
            'describe'=>'required',
            'country'=>'required',
            'status'=>'required',
            'number'=>'required',
            'category'=>'required',
            'location'=>'required',
            'imgesitem.*'=>'image|required'

        ]);

        $item=products::find($id);

        $item->name=$request->name;
        $item->description=$request->describe;
        $item->country=$request->country;
        $item->number_product=$request->number;
        $item->status_product=$request->status;
        $item->cat_id=$request->category;

        $item->location=$request->location;

      
$files=$request->file('imgesitem');
if($files){
    foreach($files as $file){
        $photoname=time().'-'.$file->getClientOriginalName();
        $file->move(base_path().'/public/imges/imgitems',$photoname);
        $phototest[]=$photoname;
    }
    $implod=implode(',',$phototest);
    $item->photo=$implod;
}
        $item->save();
        return redirect()->route('myitem')->with('success','Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {
        //
        $item=products::find($id);
        $item->approve=1;
        $item->save();
        return redirect()->back()->with('success','Approved Successfully');
    }



    public function destroy($id)
    {
        //
        $item=products::find($id);
        $item->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
