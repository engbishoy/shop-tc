<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categories;
class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cat=categories::orderby('created_at','desc')->get();
        return view('admin.categories.index')->with('cat',$cat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.addcat');
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
            'name'=>'required|max:50',
            'describe'=>'required',
            'photo_category'=>'image|required'
        ]);
        
            //
        $cat=new categories;
        $cat->name= $request->name;
        $cat->description= $request->describe;


        $photo=$request->photo_category;
        $photoname=time().'-'.$photo->getClientOriginalName();
        $photo->move(base_path().'/public/imges/imgcats',$photoname);
        $cat->photo=$photoname;

        $cat->save();
        return redirect()->back()->with('success','the category done !');
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
     
        $cat=categories::find($id);
        return view('admin.categories.editcat')->with('cat',$cat);
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
            'name'=>'required|max:50',
            'describe'=>'required',
            'photo_category'=>'image|nullable',

            ]);
        $cat=categories::find($id);
        $cat->name= $request->name;
        $cat->description= $request->input('describe');

        if($request->hasFile("photo_category")){

        $photo=$request->photo_category;
        $photoname=time().'-'.$photo->getClientOriginalName();
        $photo->move(base_path().'/public/imges/imgcats',$photoname);
        $cat->photo=$photoname;

        }
        $cat->save();
        return redirect()->route('allcategory')->with('success','the category updated done !');
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
        
        $cat=categories::find($id);
        $cat->delete();
        return redirect()->back()->with('success','the category deleted !');
    }
}
