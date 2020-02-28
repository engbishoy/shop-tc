<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="imge/png" href="{{asset('imges/imgsite/SWAP.png')}}">
 
<link rel="stylesheet" href="{{asset('normal user/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('normal user/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('normal user/css/animate.css')}}">

<link rel="stylesheet" href="{{asset('normal user/css/style2.css')}}">
</head>
<body>

@yield('content')



@if(isset(auth()->user()->id))
<script>
localStorage.setItem('uid',{{auth()->user()->id}});
</script>
@endif

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('normal user/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('normal user/js/bootstrap.min.js')}}"></script>

<script src="{{asset('normal user/js/project.js')}}"></script>
<script src="{{asset('normal user/js/wow.min.js')}}"></script>
<script> new WOW().init();</script>
<script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
<script>
  $(function() {  

    $("body .friends").niceScroll({
      cursorwidth: "10px",
      cursorcolor:"orange"
    });
    
});
</script>

</body>
</html>
