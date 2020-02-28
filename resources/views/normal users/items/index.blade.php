@extends('normal users.layouts.main')
@section('content')

@include('normal users.layouts.navbar')



          
          @include('layouts.message')

          <br>
          

          <div class="allitems">
              <div class="container-fluid">
                  <h2 style="font-weight: bold;margin-bottom: 30px; text-align: center">All Product</h2>
                  <div style="padding-bottom:40px" class="col-md-3 col-md-offset-9 col-xs-9 col-xs-offset-3">
                      <form action="/resultitem" method="get">
                        @csrf
                        @method('GET')
                          <div class="input-group">
                            <input type="text" name="search-item" style="background:#2b363a;;border-radius: 5px" class="form-control input-lg" placeholder="Search item">
                                  <button type="submit" name="search" id="search-btn" style="border: none;
                                  position: absolute;
                                  right: 1px;
                                  z-index: 12;
                                  background: none;
                                  color: white;
                                  font-size: 15px;
                                  top: 10px;"><i class="fa fa-search"></i>
                                  </button>
                          </div>
                        </form>
                    </div>
                    @if(count($item)>0)
                <div class="row">
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
          
                </div>
                @else
                <h2 style="color:red;font-weight: bold;text-align: center">No Products found</h2>
                @endif
          {{$item->links()}}
              </div>
            </div>
          
          
            @include('normal users/layouts/footer');

          @endsection
          