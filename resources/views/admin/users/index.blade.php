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
              All Users
              <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">All Users</li>
            </ol>
          </section>
          
          @include('layouts.message')

          <br>
                <section class="content">
                    <div style="padding-bottom:40px" class="col-xs-3">
                        <form action="{{route('resultuser')}}" method="get" class="sidebar-form">
                          @csrf
                          @method('GET')
                            <div class="input-group">
                              <input type="text" name="search-user" class="form-control" placeholder="Search User">
                              <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                  </span>
                            </div>
                          </form>
                      </div>
                   @if($user->count()>0)
                   		<div class="table-responsive" style="overflow-x:visible">          
                     <table class="table">
                        <thead>
                            <tr>
                            <th scope="col"><h4>photo</h4></th>
                            <th scope="col"><h4>User name</h4></th>
                            <th scope="col"><h4>Email</h4></th>
                            <th scope="col"><h4>Phone number</h4></th>
                            <th scope="col"><h4>Validation</h4></th>
                            <th scope="col"><h4>Control</h4></th>
                            </tr>
                        </thead>
                   @foreach ($user as $users)
      
  <tbody>
    <tr>
      <td><img class="img-responsive" style="width:50px" src="{{asset('imges/imguser/'.$users->photo)}}"></td>
      <td><h4> {{$users->name}}</h4></td>
      <td><h4> {{$users->email}}</h4></td>
      <td><h4> {{$users->phonenumber}}</h4></td>
      <td>

      @if($users->admin==0)
      <h4>Normal User</h4>
      @else
            <h4>Admin User</h4>
      @endif
      </td>
      <td>
      <span class='btn btn-success' style='font-size:16px'><a style="color:white;text-decoration:none;" href='{{route('edituser',['id'=>$users->id])}}'><i class='fa fa-edit'></i> Edit</a></span>
   <span> 
   <form style="display:inline-block" action='{{route('deleteuser',['id'=>$users->id])}}' method="POST">
   @csrf
   @method('DELETE')
  <input type='submit' class='btn btn-danger' style="font-size:16px" value='delete'>
   </form>
   </span>
      </td>
    </tr>
  </tbody>
                   @endforeach
                   </table>
                   </div>
                   @else
                   <h2>No found users</h2>
                   @endif
                   
                   </section>

          </div>
        
          @endsection
          