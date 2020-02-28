@if(count($requests)>0)
        @foreach ($requests as $request)

        @if($request->user_id1!=auth()->user()->id)
        <div class="user-friend" style="position: relative;margin-bottom: 20px;cursor:pointer">
        <a href="/getuser/{{$request->user_id1}}" style="text-decoration: none;
            color: white;">
        <img src="{{asset('imges/imguser/'.$request->userid1->photo)}}" style="width: 56px;
        padding-right: 2px;
        border-radius: 100%;
        height: 48px;">
        <span style="font-weight:bold">{{$request->userid1->name}}</span>
        <span class="online" id={{$request->user_id1}} style="border-radius: 100%;
        background: #2bca2b;
        width: 9px;
        height: 9px;
        position: absolute;
        top: 17px;
        right: 5px;"></span>
        
    </a>
        </div>
        @endif

        @if($request->user_id2!=auth()->user()->id)
        <div class="user-friend" style="position: relative;margin-bottom: 20px;cursor:pointer">
        <a href="/getuser/{{$request->user_id2}}" style="    text-decoration: none;
            color: white;">
        <img src="{{asset('imges/imguser/'.$request->userid2->photo)}}" style="width: 56px;
        padding-right: 2px;
        border-radius: 100%;
        height: 48px;">
        <span style="font-weight:bold">{{$request->userid2->name}}</span>
        <span class="online" style="border-radius: 100%;
        background: #2bca2b;
        width: 9px;
        height: 9px;
        position: absolute;
        top: 17px;
        right: 5px;" id={{$request->user_id2}}></span>
      
    </a>
</div>
        @endif

        @endforeach
        @else

        <h4 style="color: #a70000;
        text-align: center;
        font-weight: bold;
        margin-top: 40px;">No found friends</h4>
        @endif