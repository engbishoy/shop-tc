@extends('normal users.layouts.main')
@section('content')
@include('normal users.layouts.navbar')


<div class="chat-page">

    <div class="row">
      <div class="col-sm-4 col-xs-12">
          @include('normal users.chat.sidebarfriends')

      </div>
      <div class="col-sm-8 col-xs-12">

        <img class="img-responsive wow bounceInRight"data-wow-dulation=".5s" data-wow-delay=".5s" data-wow-offset="200"  src="{{asset('imges/imgsite/group-of-friends-png-hd-friends-png-file-940.png')}}">
    </div> 
    </div> 
</div>  

@endsection