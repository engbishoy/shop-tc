@extends('normal users.layouts.main')
@section('content')

@include('normal users.layouts.navbar')



  <div class="allitems">
    <div class="container">
        <h2 style="font-weight: bold;margin-bottom: 30px;text-align:center"> Product Details</h2>
 
                <div class="myitem" style="padding-bottom:60px">
                   
                        <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <?php
                        $ex=explode(',',$item->photo);
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


    
                         <div class="col-sm-8 col-xs-12">
                          @if($item->status_product==1)
                         <span style="padding:5px 10px; color:white; background:red;font-weight:bold">New</span>
                         @endif
                         @if($item->status_products==2)
                         <span style="padding:5px 15px; color:white; background:green;font-weight:bold;">Used</span>
                         @endif
          
                         <br><br>
                         <div class="row">
                            <div class="col-sm-6 col-xs-7">
                         <div class='title'>
                         <span style='font-weight:bold; font-size:28px'>{{Str::title($item->name)}}</span>
                         <h4 style="font-weight: bold;font-size: 15px"><i class="fa fa-map-marker" style="color: #15aabf;"></i>{{ ' '.$item->location}}</h4>
     
                         <h5 style="color: #585858; font-weight:bold"><i style="color: #1111a0; padding-right:7px;font-weight:bold" class="fa fa-user"></i>{{$item->user->name}} </h5>
                         <h5 style="color: #585858; font-weight:bold"><i style="color: #FE980F; padding-right:7px;font-weight:bold" class="fa fa-calendar"></i>{{$item->created_at->format('d-M') . " "}} <i style="color: #FE980F; padding-right:7px;font-weight:bold" class="fa fa-clock-o"></i> {{ $item->created_at->format('H:i')}}</h5>
     
                       </div>
                      </div>

                      @if(isset(auth()->user()->id))

                      @if($item->user->id!=auth()->user()->id)

                      
                      <div class="col-sm-6 col-xs-7">
                        @if($requeststatuewait->count()>0)
                           <button type="submit" class="btn-primary wait" style="
                        padding: 10px;
                        font-size: 20px;
                        border: none;
                        border-radius: 3px;"><i class="fa fa-spinner"></i> waiting</button> 
                        <style> 
                          .sendrequest ,.confirm{
                            display: none
                          }
                        </style>
                        @endif

                        @if($requeststatueaccept->count()>0)
                        <button type="submit" class="btn-primary confirm" style="
                     padding: 10px;
                     font-size: 20px;
                     border: none;
                     border-radius: 3px;"><i class="fa fa-user-friends"></i> Friend</button> 
                     <style> 
                       .sendrequest , .wait{
                         display: none
                       }
                     </style>
                     @endif

                        <div class="request">

                            <form action="{{route('addrequest')}}" class="sendrequest" method="POST">
                              @csrf
                              @method('POST')
                              <input type="hidden" class="user2" name="user_id2" value="{{$item->user->id}}">
                              <button type="submit" class="btn-primary" style="
                              padding: 10px;
                              font-size: 20px;
                              border: none;
                              border-radius: 3px;"><i class="fa fa-user-plus"></i> Add request</button> 
                            </form>


                            <script>
                              $('.sendrequest').on('click',function(){
                                $(this).hide();
                              });
                            </script>


                          </div>
                      </div>
                    @endif
                    @endif
                  </div>
                       <h4 style="color: #272727;"> Category : <strong> {{$item->categories->name}} </strong> </h4>
    
                       <h4 style="color: #272727;"> Made in : <strong> {{$item->country}} </strong> </h4>
                       <h4 style="color: #272727;"> Number Product : <strong> {{$item->number_product}} </strong> </h4>
                       <h4 style="color: #272727;"> Description : <strong> {{$item->description}} </strong> </h4>
                       
     
                         <div id="fb-root"></div>
     <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=2275867285794016&autoLogAppEvents=1"></script>
     <div class="fb-comments" data-href="http://127.0.0.1:81/item/{{$item->id}}" data-width="" data-numposts="5"></div>
                     
    

    </div>
                        </div>
                        </div>
     

    </div>
  </div>



  @include('normal users/layouts/footer');

@endsection