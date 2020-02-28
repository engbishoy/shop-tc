@section('title')
Home
@endsection
@extends('normal users.layouts.main')
@section('content')

@include('normal users.layouts.navbar')



<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>
  
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img class="slide-img" src="{{asset('normal user/img/img_site/slideshow/Fuji_EN_SalesDeals_Hero_Nov18_1X._CB479603407_.png')}}">
      </div>
      <div class="item">
        <img class="slide-img "src="{{asset('normal user/img/img_site/slideshow/pexels-photo-1153213.jpeg')}}">
      </div>
      <div class="item">
        <img class="slide-img" src="{{asset('normal user/img/img_site/slideshow/pexels-photo.jpg')}}">
      </div>
 
    </div>
  
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  

  <div class="allitems">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-sm-3 col-xs-12" style="margin-bottom: 10px">
            <div class="title">
                <h2>Categories</h2>
              </div>
              <div class="sidebar">
          				<ul class="cat">
                    @foreach($cat as $cats)
                    <li><a href="/category/{{$cats->id}}">{{$cats->name}}</a></li>
                    @endforeach
                    @if(count($cat)>8)
                    <li><a href="/category/all">See More</a></li>
                    @endif
          				</ul>
              </div>	
        </div>
        <div class="col-sm-9 col-xs-12">
            <div class="title">
            <h2>Latest <strong> (6) </strong> Product</h2>
            </div>
            @if(count($item)>0)
          @foreach ($item as $items)
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="product" style="margin-bottom: 20px">
              <a href="/item/{{$items->id}}">
                <?php
                $ex=explode(',',$items->photo);
                ?>
                @for($i=0;$i<count($ex);$i++)
                <img style="width:380px" src="{{asset('imges/imgitems/'.$ex[0])}}" class="img-responsive img-item">
                @break;
                @endfor
             
             
              <h4><a title="{{$items->name}}" href="" style="font-weight: bold;"> {{Str::title(Str::limit($items->name,33))}}</a></h4>
              <i class="fa fa-calendar" style="color: #4a4a4a;"> {{' '.$items->created_at->format('d-M')}}</i>
              <i class="fa fa-clock" style="color: #4a4a4a;">{{' '.$items->created_at->format('H:i')}}</i>
              <h4 style="font-weight: bold;font-size: 15px"><i class="fa fa-map-marker-alt" style="color: #15aabf;"></i>{{ ' '.$items->location}}</h4>
              <br>
              <a href="/item/{{$items->id}}" class="btn btn-primary" style="padding: 10px 20px; display:block;font-size: large;margin-top:10px"> Show more</a>
           
            </a>
            </div>

            </div>
     
        @endforeach

        @else
        <h2 style="text-align: center;color: red;font-weight: bold;    padding-top: 204px;">No items found</h2>
        @endif
        </div>
      </div>
    </div>
  </div>



    
		<div class="staticts" style="margin-bottom: 40px;text-align: center">
      <div class="back">
        <div class="container">
          <div class="row">
            <div class=" col-xs-4  wow bounceIn" data-wow-dulation=".5s" data-wow-delay=".5s" data-wow-offset="200">
            <div class="users" style="color: white;font-weight: bold">
              <h2 style="font-size: 60px">{{count($users)}}</h2>
              <i class="fa fa-users fa-4x"></i>
              <br>
              <h3>Users</h3>
            </div>
            </div>
            <div class="col-xs-4  wow bounceIn" data-wow-dulation="1s" data-wow-delay="1s" data-wow-offset="200">
            <div class="cats" style="color: white;font-weight: bold">
              <h2 style="font-size: 60px">{{count($cat)}}</h2>
              <i class="fa fa-list-alt fa-4x"></i>
              <br>
              <h3>Categories</h3>
            </div>
            </div>
            <div class="col-xs-4  wow bounceIn" data-wow-dulation="1.5s" data-wow-delay="1.5s" data-wow-offset="200">
            <div class="items" style="color: white;font-weight: bold">
              <h2 style="font-size: 60px">{{count($item)}}</h2>
              <i class="fa fa-list fa-4x"></i>
              <br>
              <h4>Products</h4>
            </div>
            </div>
      
          </div>
        </div>
      </div>
    </div>




    <div class="how-work" style="padding: 3px;">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-sm-4 col-xs-12 wow bounceInLeft" data-wow-dulation="1s" data-wow-delay="1s" data-wow-offset="200">
              <img src="{{asset('imges/imgsite/swapdom.jpg.900x0_q100_blur.jpg')}}" class="img-responsive img-work">
              </div>
              <div class="col-md-7 col-sm-8 col-xs-12 wow bounceInRight" data-wow-dulation="2s" data-wow-delay="1s" data-wow-offset="200">
                <div class="info" style="font-family: Ubuntu-Regular;color: black">
                <div class="question" style="margin-bottom: 20px">
                   <h3 style="font-weight: bold"> What is SHOP.TC?</h3>
                </div>
                <p class="lead">
                    Commerce site Responsive on all devices is a sale and purchase       you can publish the product you want to, but must approve the administrator
                    of the product to be displayed on the site  also you can modify and deleteyou want to, but must approve the administrator of the product to be displayed on the site
                    easy you want There are also services provide easy communication with Owner
                    by request a friend send to the owner of the product and then accept by requesting a friend send to the owner of the product and then accept
                    and start a process of conversation with the seller to agree on Details necessaryand start a process of conversation with the seller to agree on Details necessary for the purchase       for the purchase  process and there is also a contact form to communicate process and there is also a contact form to communicate with the administrator
                    with the administrator and report any problem and report any problem and there is also a full control panel to control the site
              
                </p>
                </div>
                </div>
        </div>
      </div>
    </div>



@include('normal users/layouts/footer');


@endsection