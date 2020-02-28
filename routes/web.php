<?php
use App\User;
use App\categories;
use App\products;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//navbar items 



//search in navbar
route::get('/resultbysection',function(){
    $cat=categories::all();

$item=products::where([ ['name','like','%'.request('search-item').'%'],['cat_id',request('section')] ])->paginate(8);
return view('normal users.items.result')->with('item',$item)->with('cat',$cat);

});

//all category
route::get('/category/all',function(){
    $cat=categories::all();
    return view('normal users.categories.index')->with('cat',$cat);
});


//all items


route::get('/products/all',function(){
    $cat=categories::all();
    $item=products::orderBy('created_at','DESC')->paginate(12);
    return view('normal users.items.index')->with('item',$item)->with('cat',$cat);
});



//show category item
route::get('/category/{id}',function($id){
    $cat=categories::all();
    $item=products::orderBy('created_at','DESC')->where('cat_id','=',$id)->paginate(24);
    return view('normal users.items.item_cat')->with('cat',$cat)->with('item',$item);
});



//end

Route::get('/',function(){
    $users=User::all();
    $cat=categories::orderBy('created_at','DESC')->take(8)->get();
    $item=products::orderBy('created_at','DESC')->where('approve',1)->take(6)->get();
    return view('normal users.index')->with('cat',$cat)->with('item',$item)->with('users',$users);
});





//chat

//user get to chat
Route::get('/chat','ItemsController@chat')->middleware('auth');
route::get('/getuser/{id}','ItemsController@chatgetuser')->middleware('auth');
//send message

route::post('/sendmessage','ItemsController@sendmessage');

//end


// show item
route::get('/item/{id}','ItemsController@showproduct');


// requests
route::post('/addrequest','ItemsController@addrequest')->name('addrequest')->middleware('auth');



// notification read

route::get('/readnotifi','ItemsController@readnotifi')->middleware('auth');

// notification message

route::get('/readmessage/{id}','ItemsController@readmessage')->middleware('auth');


// notification confirm read

route::get('/readnotificonfirm','ItemsController@readnotificonfirm')->middleware('auth');

// typing in chat
route::get('/typing/{id}','ItemsController@typingchat');

// seen in chat
route::get('/seen','ItemsController@seen');


// confirm request

route::post('/confirmrequest','ItemsController@confirmrequest')->middleware('auth');

//delete request
route::post('/delete-request','ItemsController@delete_request')->middleware('auth');

//end




route::get('/resultitem',function(){
    $cat=categories::all();
    $item=products::orderby('created_at','DESC')->where('name','like','%' . request('search-item'). '%')->paginate(24);
    return view('normal users.items.result')->with('cat',$cat)->with('item',$item);
});



// user ,add item ,my item ,myprofile

//myprofile

route::get('/myprofile/{id}','ItemsController@editprofile')->middleware('auth');
route::put('/update/{id}','ItemsController@updateprofile')->middleware('auth');

//add item

route::get('/createitem','ItemsController@homecreateitem')->middleware('auth');
route::post('/storeitem','ItemsController@homestoreitem')->middleware('auth');

//myitem

route::get('/myitem','ItemsController@homemyitem')->middleware('auth');

route::get('/edititem/{id}','ItemsController@homemyitemedit')->middleware('auth');
route::put('/updateitem/{id}','ItemsController@homemyitemupdate')->middleware('auth');

route::delete('/deleteitem/{id}','ItemsController@homemyitemdelete')->middleware('auth');


//end



// contact us 
route::get('/contactus','sendmailController@contact');

route::post('/sendmail','sendmailController@send');

//end



//about us


route::get('/aboutus',function(){
$cat=categories::all();
return view('normal users.aboutus')->with('cat',$cat);
});


//chat upload 
route::get('/file-upload-chat','ItemsController@uploadtest');



//admin
Route::get('/admin', 'HomeController@admin')->middleware('admin');

Route::group(['prefix' => 'admin','middleware'=>'admin'], function () {



    //categories route
    route::get('/addcategory','categoryController@create')->name('addcategory');
    route::post('/storecategory','categoryController@store')->name('storecategory');


    route::get('/allcategory','categoryController@index')->name('allcategory');

    route::get('/editcategory/{id}','categoryController@edit')->name('edticategory');
    route::put('/updatecategory/{id}','categoryController@update')->name('updatecategory');

    route::delete('/deletecategory/{id}','categoryController@destroy')->name('deletecategory');


    // item route
    route::get('/createitem','ItemsController@create')->name('createitem');
    route::post('/storeitem','ItemsController@store')->name('storeitem');
    
    //my item
    route::get('/myitem','ItemsController@myitem')->name('myitem');
    route::get('/edititem/{id}','ItemsController@edit')->name('edititem');
    route::put('/updateitem/{id}','ItemsController@update')->name('updateitem');
    // all item 
    route::get('/allitem','ItemsController@index')->name('allitem');
    route::get('/showitem/{id}','ItemsController@show')->name('showitem');
    route::put('/approved/{id}','ItemsController@approve')->name('approved');

    route::delete('/deleteitem/{id}','ItemsController@destroy')->name('deleteitem');

//search item 
route::get('/result item',function(){
    $item=products::orderby('created_at','DESC')->where('name','like','%' . request('search-item'). '%')->paginate(5);
    return view('admin.items.result')->with('item',$item);
})->name('resultitem');


    // add users
route::get('/createuser','userController@create')->name('createuser');
route::post('/adduser','userController@store')->name('adduser');
route::get('/alluser','userController@index')->name('alluser');
route::get('/edituser/{id}','userController@edit')->name('edituser');
route::put('/updateuser/{id}','userController@update')->name('updateuser');
route::delete('/deleteuser/{id}','userController@destroy')->name('deleteuser');

//search user 
route::get('/result user',function(){
    $user=User::orderby('created_at','DESC')->where('name','like','%' . request('search-user'). '%')->paginate(5);
    return view('admin.users.result')->with('user',$user);
})->name('resultuser');


});

Route::get('/confirm', function () {
    return view('404');
});

Auth::routes(['verify'=>true]);
route::get('/confirm',function(){

})->middleware('verified');
Route::get('/home', 'HomeController@index')->name('home');
