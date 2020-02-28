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
              All items
              <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">All items</li>
            </ol>
          </section>
          
          @include('layouts.message')

          <br>
                <section class="content">
                  <div style="padding-bottom:40px" class="col-md-3 col-md-offset-9 col-xs-6 col-xs-offset-6">
                    <form action="{{route('resultitem')}}" method="get" class="sidebar-form">
                      @csrf
                      @method('GET')
                        <div class="input-group">
                          <input type="text" name="search-item" class="form-control" placeholder="Search item">
                          <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                              </span>
                        </div>
                      </form>
                  </div>
                   @if($item->count()>0)
                   @foreach($item as $items)
                   <div class="myitem" style="padding-bottom:60px">
                   
                   <div class="row">
                   <div class="col-sm-4 col-xs-12">
                   <img class="img-responsive" src="{{asset('imges/imgitems/'.$items->photo)}}">
                   </div>
                    <div class="col-md-8 col-xs-12">
                    <div class="col-md-8 col-xs-6">
                     @if($items->status==1)
                    <span style="padding:5px 10px; color:white; background:red;font-weight:bold">New</span>
                    @endif
                    @if($items->status==2)
                    <span style="padding:5px 15px; color:white; background:red;font-weight:bold;">Used</span>
                    @endif
                    </div>


                   <div class="col-md-4 col-xs-6">
                    <span class='btn btn-success' style='font-size:16px'><a style="color:white;text-decoration:none;" href='{{route('edititem',['id'=>$items->id])}}'><i class='fa fa-edit'></i> Edit</a></span>
   <span> 
   <form style="display:inline-block" action='{{route('deleteitem',['id'=>$items->id])}}' method="POST">
   @csrf
   @method('DELETE')
  <input type='submit' class='btn btn-danger' style="font-size:16px" value='delete'>
   </form>
   </span>
                   
                    </div>




                    <br><br>
                    <div class='title'>
                    <span style='font-weight:bold; font-size:28px'>{{Str::title($items->name)}}</span>
                    <h4 style="font-weight: bold;font-size: 15px"><i class="fa fa-map-marker" style="color: #15aabf;"></i>{{ ' '.$items->location}}</h4>

                    <h5 style="color: #585858; font-weight:bold"><i style="color: #1111a0; padding-right:7px;font-weight:bold" class="fa fa-user"></i>{{$items->user->name . " "}} </h5>
                    <h5 style="color: #585858; font-weight:bold"><i style="color: #FE980F; padding-right:7px;font-weight:bold" class="fa fa-calendar"></i>{{$items->created_at->toDateString() . " "}} <i style="color: #FE980F; padding-right:7px;font-weight:bold" class="fa fa-clock-o"></i> {{ $items->created_at->toTimeString()}}</h5>
                   </div>
                     <h3 style="color: #272727;"> Price : <strong style="color: #FE980F"> {{$items->Price}} </strong> </h3>
                    <h4 style="color: #272727;"> Brand : <strong> {{$items->brand}} </strong> </h4>
                    <h4 style="color: #272727;"> Made in : <strong> {{$items->country}} </strong> </h4>
                    <h4 style="color: #272727; overflow-wrap: break-word"> Description : <strong> {{$items->description}} </strong> </h4>
                    
                   </div>
                   </div>
                   {{$item->links()}}
                   </div>
                   @endforeach
                   <!-- @else
                   <h2 style='text-align:center; color:red;font-weight:bold'> not found items </h2>
                   @endif
              
                   </section>

          </div>
        
          @endsection
          