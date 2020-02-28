@extends('normal users.layouts.main')
@section('content')

@include('normal users.layouts.navbar')

<div class="category">
  <div class="container-fluid">

<h2 style="text-align: center;font-weight: bold;padding:60px">All Categories</h2>


@if(count($cat)>0)
<div class="row">
@foreach ($cat as $cats)
<div class="col-md-3 col-xs-6">
  <div class="product" style="margin-bottom: 20px">
    <a href="/category/{{$cats->id}}">
    <img style="width:380px" src="{{asset('imges/imgcats/'. $cats->photo)}}" class="img-responsive img-item">
    <h4 style="text-align: center;"><a title="{{$cats->name}}" href="/category/{{$cats->id}}" style="font-weight: bold;text-align: center"> {{Str::title(Str::limit($cats->name,33))}}</a></h4>
    <a href="/category/{{$cats->id}}" class="btn btn-primary" style="padding: 10px 20px; display:block;font-size: large;margin-top:10px"> Show more</a>
 
  </a>
  </div>

  </div>

@endforeach
</div>
@else
<h2 style="text-align: center;font-weight: bold;color: red">No items found</h2>
@endif


  </div>
</div>

@include('normal users/layouts/footer');


@endsection
