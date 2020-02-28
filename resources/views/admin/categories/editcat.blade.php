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
              Edit Category
              <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Edit Category</li>
            </ol>
          </section>
          
          @include('layouts.message')

          <br>
                <section class="content" style=" padding: 94px 20px;">
        
<form action="{{route('updatecategory',['id'=>$cat->id])}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
        @method('PUT')

        <div class="form-group">
          <label>Category name</label>
          <input type="text" name='name' value='{{$cat->name}}' class="form-control">
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea id='article-ckeditor' name="describe" class="form-control" style="height: 130px"  placeholder="write something">{!!$cat->description!!}</textarea>
        </div>
        <div class="form-group">
          <label> Select Photos</label>  
               <img src='{{asset('imges/imgsite/33.png')}}'>
               <input class="add-img" type="file" name="photo_category" style="margin-left:89px">
                </div>
        <input type="submit" value="Save" class="btn btn-primary pull-right">
      </form>
                </section>
          </div>
        
          @endsection
          