@extends('normal users.layouts.main')
@section('content')

@include('normal users.layouts.navbar')



          
          @include('layouts.message')

          <br>
          
<div class="profile">
    <div class="container">
	<div class="panel panel-default">
        <div class="panel-heading">My Profile</div>
        <div class="panel-body">
      
                 
      <form class="form-horizontal" action="/update/{{$profileid->id}}" method="POST"  enctype="multipart/form-data">
          {{ csrf_field() }}
          @method('PUT')
                 <div class="row">
                                      
                        <div class="form-group form-group-lg">
                                <label class="col-lg-3 col-sm-4 col-xs-12 control-label" style="top: 42px;"> Photo profile</label>  
                                   <div class="col-lg-8 col-sm-8 col-xs-12 ">
                           <input type="file"  name="photo" class="form-control photoprofile">
                               <img class="img-responsive" style="
                               width: 133px;
                               border-radius: 100%;
                               border: 2px solid #0a79d8;" src="{{asset('imges/imguser/'.auth()->user()->photo)}}">
                         </div>
                      
                             </div>   


                             <div class="form-group form-group-lg">
                                    <label class="col-lg-3 col-sm-4 col-xs-12 control-label">Full Name</label>  
                                       <div class="col-lg-8 col-sm-8 col-xs-12 ">
                               <input type="text" name="name" class="form-control"  value="{{auth()->user()->name}}">
                             </div>
                          
                                 </div>   
                  <div class="form-group form-group-lg">
                     <label class="col-lg-3 col-sm-4 col-xs-12 control-label">Password</label>  
                        <div class="col-lg-8 col-sm-8 col-xs-12 ">
                <input type="password" name="password" class="form-control">
                <span style="color: red;
                font-weight: bold;">"You can leave the field empty if you don't want change password "</span>
              </div>
           
                  </div>
                    
                  <div class="form-group form-group-lg">
                        <label class="col-lg-3 col-sm-4 col-xs-12 control-label">Phone number</label>  
                           <div class="col-lg-8 col-sm-8 col-xs-12 ">
                   <input type="number" name="phone" value="{{auth()->user()->phonenumber}}" class="form-control" required="required">
                 </div>
              
                     </div>
                     
                     
                     
           <div class="form-group">
      
              <div class="col-lg-offset-3  col-sm-offset-4 col-sm-10">
          <button class="btn btn-success" style="margin-top:20px" type="submit" name="submit"><i class="fa fa-edit"></i> Edit Profile</button>
              </div>
                  </div>				
                  </form>
          
              </div>
            </div>
        </div>
    </div>
      

@endsection