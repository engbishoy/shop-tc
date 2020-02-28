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
              Add User
              <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Add user</li>
            </ol>
          </section>
          
          @include('layouts.message')
          <br>
                <section class="content">
        
<form action="{{route('adduser')}}" method="POST"  enctype="multipart/form-data">
    {{ csrf_field() }}
    @method('POST')
        <div class="form-group">
          <label>Name</label>
          <input type="text" name='name' class="form-control">
        </div>   
         <div class="form-group">
          <label>E-Mail Address</label>
          <input type="email" name='email' class="form-control">
        </div>    
        <div class="form-group">
          <label>Password</label>
<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        </div>   
         <div class="form-group">
          <label>Confirm Password</label>
<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>   
         <div class="form-group">
          <label>Choose Photo</label>
          <input type="file" name='photo' class="form-control">
        </div>
            <div class="form-group">
          <label>phone number</label>
          <input type="number" name='phone' class="form-control">
        </div>
          <div class="form-group">
          <label>User Type</label>
          <select class="form-control" name='usertype'>
          <option value="0">Normal user</option>
          <option value="1">Admin user</option>
          </select>
                  </div>
        <input type="submit" value="Register" class="btn btn-primary pull-right">
      </form>
                </section>
          </div>
        
          @endsection
          