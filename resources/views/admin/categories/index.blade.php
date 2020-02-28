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
              All Category
              <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Add Category</li>
            </ol>
          </section>
          
          @include('layouts.message')

          <br>
                <section class="content">
                   @if($cat->count()>0)
                     <table class="table" style="text-align:center">
                        <thead>
                            <tr>
                              <th scope="col" style="text-align:center"><h3>Photo</h3></th>
                              <th scope="col" style="text-align:center"><h3>Name</h3></th>
                              <th scope="col" style="text-align:center"><h3>Description</h3></th>
                            <th scope="col" style="text-align:center"><h3>Control</h3></th>
                            </tr>
                        </thead>
                   @foreach ($cat as $cats)
      
  <tbody>
    <tr>
      <td><img class="img-responsive" style="width: 64px;margin: auto;" src="{{asset('/imges/imgcats/'.$cats->photo)}}"></td>
      <td><h4> {{$cats->name}}</h4></td>
      <td><h4>{!!Str::limit($cats->description,20)!!}</h4></td>
      <td>
   
      <span class='btn btn-success' style='font-size:16px'><a style="color:white;text-decoration:none;" href='{{route('edticategory',['id'=>$cats->id])}}'><i class='fa fa-edit'></i> Edit</a></span>
   <span> 
   <form style="display:inline-block" action='{{route('deletecategory',['id'=>$cats->id])}}' method="POST">
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

                   @endif
                   
                   </section>

          </div>
        
          @endsection
          