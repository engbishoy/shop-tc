@extends('normal users.layouts.main')
@section('content')
@include('normal users.layouts.navbar')
        

<h2 style='text-align: center;font-weight: bold;padding: 30px'>About Us</h2>

<div class="aboutus" style="padding: 40px">
<div class="container-fluid">
<div class="row">
    <div class="col-md-4 col-sm-5 col-xs-12  wow bounceInLeft" data-wow-dulation=".5s" data-wow-delay=".5s" data-wow-offset="200">
        <img style="
        height: 480px;
        border: 2px solid;
        box-shadow: 0px 0px 23px black;" src="{{asset('normal user/img/img_site/slideshow/210e3b0a-a1a9-434f-b623-54fa04f3e9ec.jpg')}}" class="img-responsive">
    </div>
        
    <div class="col-md-8 col-sm-7 col-xs-12 wow bounceInRight" data-wow-dulation=".5s" data-wow-delay=".5s" data-wow-offset="200">


            <div class="info" style="font-family: inherit;color: black">

                    <div class="question" style="margin-bottom: 20px">
                            <h3 style="font-weight: bold; padding-bottom: 20px"> Who Are We ?</h3>
                         </div>
                   
                    <p class="lead" style="font-weight: bold;color: #1d1d1d;">

                            Commerce site Responsive on all devices is a sale and purchase you can publish the product you want to, but must approve the administrator of the product to be displayed on the site also you can modify and deleteyou want to, but must approve the administrator of the product to be displayed on the site easy you want There are also services provide easy communication with Owner by request a friend send to the owner of the product and then accept by requesting a friend send to the owner of the product and then accept and start a process of conversation with the seller to agree on Details necessaryand start a process of conversation with the seller to agree on Details necessary for the purchase for the purchase process and there is also a contact form to communicate process and there is also a contact form to communicate with the administrator with the administrator and report any problem and report any problem and there is also a full control panel to control the site
                </div>

    </div>
</div>
</div>
</div>






@include('normal users/layouts/footer');

@endsection
