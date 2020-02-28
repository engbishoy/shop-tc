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
              My items
              <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">My items</li>
            </ol>
          </section>
          
          @include('layouts.message')

          <br>
                <section class="content">
               
                   <div class="myitem"  style="padding-bottom:60px">
                   
                   <div class="row">
                   <div class="col-sm-4 col-xs-12">
                      <?php
                      $ex=explode(',',$items->photo);
                      ?>
                      @for($i=0;$i<count($ex);$i++)
                      <img style="width:380px" src="{{asset('imges/imgitems/' .$ex[0])}}" class="img-responsive img-item large">
                      @break;
                      @endfor   
                      <br>
                      <br>
                      <div class="icon-itemimg" style="display: inline-flex">
                      @for($i=0;$i<count($ex);$i++)
                      <img style="width:60px; margin-right:10px" src="{{asset('imges/imgitems/' .$ex[$i])}}" class="img-responsive small">
                      @endfor  
                      </div>
                      
                    </div>
                    <div class="col-md-8 col-xs-12">
                    <div class="col-md-8 col-xs-6">
                     @if($items->status_product==1)
                    <span style="padding:5px 10px; color:white; background:red;font-weight:bold">New</span>
                    @endif
                    @if($items->status_product==2)
                    <span style="padding:5px 15px; color:white; background:red;font-weight:bold">Used</span>
                    @endif
                    </div>



                    <br><br>
                    <div class='title'>
                        <span style='font-weight:bold; font-size:28px'>{{Str::title($items->name)}}</span>
                        <h4 style="font-weight: bold;font-size: 20px"><i class="fa fa-map-marker" style="color: #15aabf;"></i>{{ ' '.$items->location}}</h4>
    
                        <h5 style="color: #585858; font-weight:bold"><i style="color: #1111a0; padding-right:7px;font-weight:bold" class="fa fa-user"></i>{{$items->user->name}} </h5>
                        <h5 style="color: #585858; font-weight:bold"><i style="color: #FE980F; padding-right:7px;font-weight:bold" class="fa fa-calendar"></i>{{$items->created_at->format('d-m') . " "}} <i style="color: #FE980F; padding-right:7px;font-weight:bold" class="fa fa-clock-o"></i> {{ $items->created_at->toTimeString()}}</h5>
    
                      </div>
                   <h4 style="color: #272727;"> Category : <strong> {{$items->categories->name}} </strong> </h4>

                   <h4 style="color: #272727;"> Made in : <strong> {{$items->country}} </strong> </h4>
                   <h4 style="color: #272727;"> Number Product : <strong> {{$items->number_product}} </strong> </h4>
                   <h4 style="color: #272727;"> Description : <strong> {{$items->description}} </strong> </h4>
                   <div id="fb-root"></div>
                   <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=2275867285794016&autoLogAppEvents=1"></script>
                   <div class="fb-comments" data-href="http://127.0.0.1:81/admin/item/{{$items->id}}" data-width="" data-numposts="5"></div>
                                     
                   </div>
                   </div>
                   
                   </div>

                  
                   
                   </section>

          </div>
        
          @endsection
          