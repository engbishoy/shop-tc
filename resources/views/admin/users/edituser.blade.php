@extends('layouts.main')
@section('content')

@include('layouts.navbar')




<div class="wrapper">

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
  @include('layouts.sidbar')
        </aside>
               <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Edit Validation User
              <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"> Edit Validation user</li>
            </ol>
          </section>
          
          @include('layouts.message')
          <br>
                <section class="content">
			       <div class="row">
                  <div class="col-md-3 col-sm-4 col-xs-3">
                  <img src="{{asset('imges/imguser/'.$user->photo)}}" class="img-responsive">
                  </div>
                  <div class="col-md-9 col-sm-8 col-xs-9">
                  @if($user->admin==0)
    <h3 style="font-weight:bold">Normal User</h3>
      @else
     <h3 style="font-weight:bold" >Admin User</h3>
      @endif
                  <h4 style="font-weight:bold">Name :  {{$user->name}}</h4>
                  <h4 style="font-weight:bold">Email :  {{$user->email}}</h4>
                  <h4 style="font-weight:bold">phone :  {{$user->phonenumber}}</h4>

                  <form action="{{route('updateuser',['id'=>$user->id])}}" method="POST"  enctype="multipart/form-data">
    {{ csrf_field() }}
    @method('PUT')
		@if($user->admin==0)
         <input type="hidden" value="1" name="make">
         <input type="submit" value="Make admin " class="btn btn-primary">
        @else
         <input type="hidden" value="0" name="make">
         <input type="submit" value="Make normal user " class="btn btn-primary">
         @endif
      </form>

                  </div>
                  </div>


                </section>
          </div>
        
          @endsection
          