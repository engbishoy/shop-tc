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


		<h2 style="font-weight: bold;text-align: center">Manege Items</h2>
		
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

                  <div class="table-responsive" style="overflow: visible">          
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Status Product</th>
                            <th>Made in</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Control</th>
                          </tr>
                          @foreach($item as $items)
                          <tr>                            
                            <?php
                            $ex=explode(',',$items->photo);
                            ?>
                            @for($i=0;$i<count($ex);$i++)
                            <td><img class="img-responsive" style="width: 64px;margin: auto;" src="{{asset('/imges/imgitems/'.$ex[0])}}"></td>
                            @break;
                            @endfor 



                            <td><h4 style="font-weight: bold">{{$items->user->name}}</h4></td>
                            @if($items->status_product==1)
                            <td><h4 style="font-weight: bold;color:red">New</h4></td>
                            @endif
                            @if($items->status_product==2)
                            <td><h4 style="font-weight: bold;color:green">Used</h4></td>
                            @endif
                            <td><h4 style="font-weight: bold">{{$items->country}}</h4></td>
                            <td><h4 style="font-weight: bold">{{$items->location}}</h4></td>
                            <td><h4 style="font-weight: bold">{{$items->categories->name}}</h4></td>
                            <td>

                              @if($items->approve==0)
                                <form style="display:inline-block" action='{{route('approved',['id'=>$items->id])}}' method="POST">
                                    @csrf
                                    @method('PUT')
                                   <button type='submit' class='btn btn-info' style="font-size:16px"><i class="fa fa-thumbs-up"></i> Approve</button>
                                    </form>
                                @endif
                                    <a href='{{route('showitem',['id'=>$items->id])}}' style="font-size:16px" class="btn btn-primary"> Show more</a>

                                <form style="display:inline-block" action='{{route('deleteitem',['id'=>$items->id])}}' method="POST">
                                @csrf
                                @method('DELETE')
                               <button type='submit' class='btn btn-danger' style="font-size:16px"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                                
                                </span>



                            </td>
                         
                         
                          </tr>
                          @endforeach

                        </thead>
                        <tbody>
                   
                        </tbody>
                      </table>
                        </div>
                        @else
                        <h2 style='text-align:center; color:red;font-weight:bold'> not found items </h2>
                        @endif
                        {{$item->links()}}

                 
              

                   </section>
                   
          </div>
        
          @endsection
          