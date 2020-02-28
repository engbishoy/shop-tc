@extends('normal users.layouts.main')
@section('content')

@include('normal users.layouts.navbar')


<div class="contact">
    <div class="container">

            @include('layouts.message')

    <h2 style="text-align: center;padding:45px 0;font-weight: bold">Contact Us</h2>
                
            <div class="col-md-offset-3 col-xs-offset-2 col-md-6 col-xs-8">
           
<form class="mail" action="/sendmail" method="POST">
    @csrf
    @method('POST')
    <div class="forms">		
<input type="text" style="
height: 53px;
font-size: 18px;
border-radius: 5px;
background: #f4f4f4; padding-left:40px" required name="name" autocomplete="off" class="form-control username" value="<?php if(isset($name)){echo $name;} ?>" placeholder="Type your User name">

<i class="fa fa-user fa-2x" style="position: absolute;
left: 24px;
margin-top: -38px;
z-index: 9;"></i>

</div>	

<div class="forms">
    
<input type="email" autocomplete="off" style="
height: 53px;
font-size: 18px;
border-radius: 5px;
background: #f4f4f4; padding-left:40px" class="form-control email" required name="email" placeholder="Type your email address">

<i class="fa fa-envelope fa-2x" style="position: absolute;
left: 24px;
margin-top: -38px;
z-index: 9;"></i>

</div>
<div class="forms">
    
<input type="number" autocomplete="off" style="
height: 53px;
font-size: 18px;
border-radius: 5px;
background: #f4f4f4; padding-left:40px" class="form-control number" required name="phone" placeholder="Type your phone number">

<i class="fa fa-phone fa-2x" style="position: absolute;
left: 24px;
margin-top: -38px;
z-index: 9;"></i>


</div>

<div class="form-group">
<textarea class="form-control rounded-0 msg" name="message" required id="exampleFormControlTextarea1" style="padding: 22px;font-size: 20px;height:190px" placeholder="Type your message" rows="10"><?php if(isset($msg)){echo $msg;} ?></textarea>

</div>
<div class="form-group">
<input type="submit" name=sub class="form-control btn-primary submail" value="Send Message">
</div>
</form>



</div>


</div>
</div>



@include('normal users/layouts/footer');


@endsection