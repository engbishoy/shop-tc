<div class="header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-4">
        <h2><a class="logo" href="/">SHOP.TC</a></h2>

      </div>

      
      <div class="col-lg-offset-5 col-lg-4 col-md-offset-4 col-md-5  col-sm-offset-3 col-sm-6  col-xs-8">
          <form action="/resultbysection" method="GET" class="search" style="margin-top: 11px">
            @csrf
            @method('GET')
          <div class="input-group">
              <div class="input-group-btn">
                <select class='form-control input-lg select-cat' name='section'>
                  @foreach($cat as $cats)
                  <option value="{{$cats->id}}">{{$cats->name}}</option>

                  @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <input type="text" name="search-item" class="form-control input-lg search-product" placeholder="Search">
                </div>
              </div>
              <button class="icon" type="submit"><i class="fa fa-search icon-search"></i></button>
          </form>
         
      </div>

    </div>
  </div>
</div>








<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li><a href="/">Home</a></li>
          <li><a href="/aboutus">About Us</a></li>
          <li><a href="/products/all">Products</a></li>
          <li><a href="/category/all">Categories</a></li>
          @if(isset(auth()->user()->id))
          <li><a href="/chat">Chat</a></li>
          @endif
          <li><a href="/contactus">Contact Us</a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
              <div class="regestration">
                  @if(isset(auth()->user()->id) & isset(auth()->user()->email_verified_at))
                  @if(auth()->user()->email_verified_at!='')
        


                  <li class="dropdown">
                    @if(count(auth()->user()->unreadNotifications_addrequest )>0)
                      <span class="badge request-count" style="position: absolute;
                      top: 0px;
                      right: 12px;
                      z-index: 1;
                      color:white;
                      background: #d50000
                      ">{{count(auth()->user()->unreadNotifications_addrequest )}}</span>
                      @elseif(count(auth()->user()->unreadNotifications_addrequest)==0)
                      <span class="badge request-count" style="position: absolute;
                      top: 0px;
                      right: 12px;
                      z-index: 1;
                      color:white;
                      background: #d50000;
                      display:none
                      ">0</span>
                      @endif
                      
                      <a class="dropdown-toggle readnotifi" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-friends"></i></a>
                    
                     
                      <ul class="dropdown-menu notification-request-header">
                          <h5 style="font-size: 14px;margin-bottom: 28px;padding-left: 10px">Friend Requests</h5>



                          @if(count(auth()->user()->notifications_addrequest )>0)

                        @foreach (auth()->user()->notifications_addrequest as $notification)
                        <li>

                          <div class="requests-friend" style="border-bottom: 1px solid #4b5d63;
                          padding-bottom: 13px;">
                          <a href="#" style="color:white">
                          <img style="width:40px" src="{{asset('imges/imguser/' .$notification->data['userphoto'])}}">
                         <span> {{$notification->data['username']}} </span>
                          </a>

                         
                          
                          <form action="/delete-request" method="POST" style="display: inline">
                            @csrf
                            @method('POST')
                              <input type="hidden"  name="userid1" class="userid1" value="{{$notification->data['user_id1']}}">
                              <input type="hidden" name="userid2" class="userid2" value="{{auth()->user()->id}}">
                              <input type="hidden" name="notifiid" value="{{$notification->id}}">
                              
                              <button type="submit" class="btn btn-danger pull-right" >Delete</button>      
                          </form>
                              

                        
                          @php
                           $dontaccept=App\requests::where([
                            ['accept','=',0],
                            ['user_id1','=',$notification->data['user_id1']],
                            ['user_id2','=',auth()->user()->id],
                           ]);

                           $accept=App\requests::where([
                            ['accept','=',1],
                            ['user_id1','=',$notification->data['user_id1']],
                            ['user_id2','=',auth()->user()->id],
                           ]);
                          @endphp

                          <form action="/confirmrequest" method="POST" style="display: inline">
                            @csrf
                            @method('POST')
                          <input type="hidden"  name="userid1" class="userid1" value="{{$notification->data['user_id1']}}">
                          <input type="hidden" name="userid2" class="userid2" value="{{auth()->user()->id}}">
                        
                          @if($dontaccept->count()>0)
                          <button type="submit" class="btn btn-primary confirm-request pull-right " style="margin-right: 10px">Confirm</button>
                            @endif
                          </form>
                          
                            @if($accept->count()>0)
                          
                          <button class="btn btn-primary confirm-request pull-right " style="margin-right: 10px"><i class="fa fa-check"></i> Friend</button>
                            @endif


                            <button class="btn btn-primary confirm-ajax pull-right " style="margin-right: 10px;display: none"><i class="fa fa-check"></i> Friend</button>



                        </div>
                        
                      </li>                            
                        @endforeach
                       
                        @else

                        <h4 style="text-align: center;
                        color: #c42525;
                        font-weight: bold;" class="no-friends">No found requests</h4>

                        @endif
                      </ul>
                    </li>







                    <li class="dropdown">


                        @if(count(auth()->user()->unreadNotifications_message )>0)
                        <span class="badge message-count" style="position: absolute;
                        top: 3px;
                        right: 7px;
                        z-index: 1;
                        color: white;
                        background: #d50000;
                        ">{{count(auth()->user()->unreadNotifications_message )}}</span>
                        @elseif(count(auth()->user()->unreadNotifications_message)==0)
                        <span class="badge message-count" style="position: absolute;
                        top: 3px;
                        right: 7px;
                        z-index: 1;
                        color: white;
                        background: #d50000;
                        display:none
                        ">0</span>
                        @endif



                        <a href="#" class="dropdown-toggle msg-icon" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope"></i></a>
                        <ul class="dropdown-menu notification-message-header">

                          @if(count(auth()->user()->notifications_message)>0)
                          @foreach (auth()->user()->notifications_message as $notification )
                          <li>
                          <div class="message-notifi" style="border-bottom: 1px solid #4b5d63;
                          padding-bottom: 13px;">
                          <a href='/getuser/{{$notification->fromuserid}}' class="message-from-friend" style="color:white;text-decoration:none">
                          <img style="width:40px; border-radius: 100%;" src="{{asset('imges/imguser/' .$notification->data['fromuserphoto'])}}">
                         <span style="font-weight: bold"> {{$notification->data['fromusername']}} </span>
                        <p class="msg-notifi" id={{$notification->data['fromuserid']}} style="
                        margin-left: 46px;
                        color: #b1b1b1;
                        margin-top: -8px;">send your message</p>  
                        </a>
                        <span class="pull-right date" style="margin-top: -46px;
                        color: #d6d6d6;">{{$notification->created_at->format('h:i A | d-M')}}</span>
                          
                        </div>
                          </li>
                                                     
                          @endforeach
                          @else

                          
                        <h4 style="text-align: center;
                        color: #c42525;
                        font-weight: bold;" class="no-message">No found messages</h4>

                         @endif
                        </ul>
                      </li>
                      





                  <li class="dropdown">


                      @if(count(auth()->user()->unreadNotifications_confirmrequest )>0)
                      <span class="badge badge-notificonfirm" style="position: absolute;
                      top: 0px;
                      right: 12px;
                      z-index: 1;
                      color:white;
                      background: #d50000
                      ">{{count(auth()->user()->unreadNotifications_confirmrequest )}}</span>
                      @elseif(count(auth()->user()->unreadNotifications_confirmrequest)==0)
                      <span class="badge badge-notificonfirm" style="position: absolute;
                      top: 0px;
                      right: 12px;
                      z-index: 1;
                      color:white;
                      background: #d50000;
                      display:none
                      ">0</span>
                      @endif

                      <a href="#" class="dropdown-toggle readnoticonfirm" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i></a>
                      <ul class="dropdown-menu  notification-header-confirm notifi-confirm">
                       

                          @if(count(auth()->user()->notifications_confirmrequest )>0)

                          @foreach (auth()->user()->notifications_confirmrequest as $notification)
                          <li>
  
                            <div class="confirm-friend" style="border-bottom: 1px solid #4b5d63;
                            padding-bottom: 13px;">
                            <a href="#" style="color:white;text-decoration:none">
                            <img style="width:40px" src="{{asset('imges/imguser/' .$notification->data['confirmuserphoto'])}}">
                           <span style="font-weight: bold"> {{$notification->data['confirmusername']}} </span>
                            </a>
                            <span>accept your friend request</span>

                          </div>
                          
                        </li>                            
                          @endforeach
                         
                          @else
  
                          <h4 style="text-align: center;
                          color: #c42525;
                          font-weight: bold;" class="no-notifi">No found notification</h4>
  
                          @endif


                      </ul>
                    </li>



                  <li class="dropdown nav-right-profile" style="list-style: none">
                      <img class="img-responsive nav-right-imgprofile" src="{{asset('imges/imguser/' .auth()->user()->photo)}}">
                    <a href="#" class="dropdown-toggle name-profile" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu my-profile">
                      <li><a href="/myprofile/{{auth()->user()->id}}">My Profile</a></li>
                      <li><a href="/createitem">Add Product</a></li>
                      <li><a href="/myitem">My Products</a></li>
                      <li> 
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>
              
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
        
                    </li>
                    </ul>
                  </li>


                  @endif
                  
                  @else
                  <a class="register" href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i> Login</a>
                  <a class="register" href="{{ route('register') }}"><i class="fa fa-user-circle"></i> Sign up</a>
        
                  @endif
                
              </div>
            </ul>



    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>