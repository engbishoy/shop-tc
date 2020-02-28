@extends('normal users.layouts.main')
@section('content')
@include('normal users.layouts.navbar')

<div class="chat-page">
<div class="container-fluid">
        <div class="row">
          <div class="col-sm-4 col-sm-5 col-xs-12">
              @include('normal users.chat.sidebarfriends')
    
          </div>

          <style>
            
@media(min-width:300px) and (max-width:767px){
  .sidebar-chat{
    display:none
  }
}
          </style>

          <div class="col-sm-8 col-sm-7 col-xs-12 getuser">

        <div class="chat-user">
                <div class="panel panel-default">
                    <div class="panel-heading" style="position: relative;background-color: #394e63;
                    padding:8px 16px;
                    font-family: sans-serif;">
                    <a class="back-chat" href="/chat">
                    <i class="fa fa-arrow-left" style="color: white;padding-right:12px;"></i>
                    </a>
                    <img src="{{asset('imges/imguser/'.$user->photo)}}" style="width: 56px;
                    padding-right: 2px;
                    border-radius: 100%;
                    height: 48px;">
                    <span style="font-weight:bold">{{$user->name}}</span> 

                <div class="right-online" id={{$user->id}} style="display:none;position: absolute;
                right: 26px;
                top: 22px;">
                <p style="font-weight: bold"> online </p>
                <span class="online-friend pull-right" style="border-radius: 100%;
                background: #2bca2b;
                width: 9px;
                height: 9px;
                position: absolute;
                top: 6px;
                left: -14px;"></span> 
    
            </div>
               <div class="right-offline" id={{$user->id}} style="display:none; position: absolute;
                    right: 26px;
                    top: 22px;">
                    <p style="font-weight: bold"> offline </p>
                    <span class="offline-friend pull-right" style="border-radius: 100%;
                    background: #b3b3b3;
                    width: 9px;
                    height: 9px;
                    position: absolute;
                    top: 6px;
                    left: -14px;"></span> 
        
                </div>

                </div>
        
                <div class="body-chat" style="background: #eeeeee;
                height: 291px;
                overflow-y: scroll;">
                    <div class="panel-body body-msg" id={{$user->id}}>
                      
                    @foreach($message as $messages)
                    <div class="row">
                    <div class="col-xs-6 friend-message" style="position: relative">
                    @if($messages->from!=auth()->user()->id)
        
                      <img src="{{asset('imges/imguser/'.$messages->chatuser1->photo)}}" style="width: 55px;
                      border-radius: 100%;
                      height: 53px;">
                      @if($messages->message!='')
                      <div class="msg" id={{$messages->id}}>{{$messages->message}}</div>
                      @endif
                      @if($messages->image!='')
                      @php
                      $ex=explode(',',$messages->image);
                      @endphp
        
                      @for($i=0;$i<count($ex);$i++)
                      <img class="img-responsive" style="padding-left: 76px;padding-bottom: 10px;" src="{{asset('imges/imgchat/'.$ex[$i])}}">
                      @endfor
                      @endif
                     <span class="fa fa-caret-left" style="position: absolute;
                     top: 14px;
                     left: 81px;
                     color: white;"></span>
        
                     <div class="date" style="
                     position: relative;
            left: 74px;
            color: #7c7c7c;
            font-size:11px;
            ">{{$messages->created_at->format('h:i A | d-M')}} </div>
                     @endif
                    </div>
        
                    <div class="col-xs-offset-2 col-xs-4 my-message" style="position: relative">
                            @if($messages->from==auth()->user()->id)
                            @if($messages->message!='')
                            <div class="msg" id={{$messages->id}}>{{$messages->message}}</div>
                            @endif
                            @if($messages->image!='')
                            @php
                            $ex=explode(',',$messages->image);
                            @endphp
              
                            @for($i=0;$i<count($ex);$i++)
                            <img class="img-responsive" style="padding-bottom: 10px;" src="{{asset('imges/imgchat/'.$ex[$i])}}">
                                
                            @endfor
        
                            @endif
                        <span class="date" style="
                        position: absolute;
                        left: 26px;
                        color: #7c7c7c;font-size:11px;">{{$messages->created_at->format('h:i A | d-M')}} </span>
               
                             @endif
                      </div>
        
        
                    </div>
                      @endforeach
                      
                    
                    </div>
                    <div class="user-typing" style="display:none">
                            <img src="{{asset('imges/imguser/'.$user->photo)}}" style="width: 26px;margin-left: 15px;">
                            <img class='typing-gif' style="width: 55px;" src="{{asset('imges/imgsite/tenor.gif')}}">
                            </div>

                </div>
        
                    
        
                  </div>  
                  
                  <form action="/sendmessage" class="sendmessage" method="POST" style="position: relative;margin-top: -21px;" enctype="multipart/form-data">
                    <input type="text" id={{$user->id}} autocomplete="off" name="msg" placeholder="Type your message ...." class="form-control msg">
                    
                    <i class="fa fa-image fa-2x" style="color: #384c61;
                    position: absolute;
                    top: 2px;
                    right: 54px;
                    cursor: pointer"></i>  
                    <input type="file"  name="chat_photo_upload[]" class="chat-photo-upload" style="position: absolute;
                    top: 5px;
                    right: 56px;
                    width: 26px;
                    opacity:0;" multiple>


                    <div class="gallary" style="display:inline-flex"></div>
        
                    <input type="hidden" class="fromuser" name="from" value={{auth()->user()->id}}>
                    <input type="hidden" class="touser" name="to" value={{$user->id}}>
                   <button type="submit" style="position: absolute;
                   top: 0;
                   right: 1px;
                   background: #2c3e50;
                   color: white;
                   padding: 7px 14px;
                   border: none;"> <i class="fa fa-paper-plane"></i> </button>
                  </form>
        
        
              
            </div>        
        </div>        
    </div>        
  </div>        
</div>        



@endsection








