/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

//date api plugin
window.moment = require('moment');
//end




$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


//request notification header

$('.readnotifi').on('click',function(){

    $.ajax({
        type:'get',
        cache:false,
        data:'',
        url:'/readnotifi',
        success:function(){
            $('.request-count').hide();
        }

    });
    

});





//confirm request notification header

$('.readnoticonfirm').on('click',function(){

    $.ajax({
        type:'get',
        cache:false,
        data:'',
        url:'/readnotificonfirm',
        success:function(){
            $('.badge-notificonfirm').hide();
        }

    });


});



$('.sendmessage').on('submit',function(e){
    e.preventDefault();
    if($('.sendmessage .msg').val()!='' || $('.sendmessage .chat-photo-upload').val()!=''){

    $.ajax({
        method:'POST',
        url:'/sendmessage',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType:'json',
        success:function(data){
        $('body').append(`
        <div style="color: white;
        background-color: #fe3030;
        border-color: #ebccd1;
        padding: 13px;
        display: inline-block;
        position: absolute;
        top: 187px;
        right: 0;
        z-index: 9;
        border: none;" class="error-photo-chat wow bounceInRight" data-wow-duration="1s">${data['chat_photo_upload']}</div>
        `);  
        $('body .error-photo-chat').delay(10000).fadeOut(1000);
        }

    });
}


    $('.msg').val('');
    $('.chat-photo-upload').val('');      
    $('.gallary').hide();
});


//seen 


    $('.msg-icon').on("click",function(){

        $.ajax({
        method:'get',
        url:'/seen',
        data:'',
        success:function(){
            $('.message-count').hide();
        }
        });

        });


//typing

$('.msg').on("keydown",function(){

var touser=$('.touser').val();
$.ajax({
method:'get',
url:'/typing/'+ touser,
data:''
});
});

// chat scroll bottom
$('.body-chat').animate({scrollTop:$('.body-chat').prop('scrollHeight')});


// image upload chat
  // Multiple images preview in browser
  var imagesPreview = function(input, placeToInsertImagePreview) {

    if (input.files) {
        var filesAmount = input.files.length;

        for (var i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                $($.parseHTML('<img class="thumbnail" style="width: 86px;height: 65px;">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
            }

            reader.readAsDataURL(input.files[i]);
        }
    }

};

$('.chat-photo-upload').on('change', function() {
    imagesPreview(this, '.gallary');

});




//navbar notification
$('.readnotifi').on('click',function(){

});



});



// broadcast events chat
window.Echo.private('chat.' + localStorage.getItem('uid'))
.listen('sendmessage', (e) => {
    $('.body-chat').animate({scrollTop:$('.body-chat').prop('scrollHeight')});
    if($('.body-msg').attr('id')==`${e.chat.to}`){



if(e.chat.image!='' && e.chat.message!=''){
    $('.body-msg').append(`
    <div class="row">
    <div class="col-xs-offset-8 col-xs-4 my-message" style="position: relative">

<div class="msg">${e.chat.message}</div>
    </div>
    </div>
    
    `);


    var test=e.chat.image;
    var arr=test.split(',');
    for(var i=0;i<arr.length;i++){
        var photo=arr[i];
        $('.body-msg').append(`
        <div class="row">
        <div class="col-xs-offset-8 col-xs-4" style="position: relative">
        <img class="img-responsive" src="/imges/imgchat/${photo}">
        </div>
        </div>
        
        `);
    }


}else if(e.chat.message!=''){
    $('.body-msg').append(`
    <div class="row">
    <div class="col-xs-offset-8 col-xs-4 my-message" style="position: relative">

<div class="msg">${e.chat.message}</div>
    </div>
    </div>
    
    `);
}else if(e.chat.image!=''){
  
    var test=e.chat.image;
    var arr=test.split(',');
    for(var i=0;i<arr.length;i++){
        var photo=arr[i];
        $('.body-msg').append(`
        <div class="row">
        <div class="col-xs-offset-8 col-xs-4" style="position: relative">
        <img class="img-responsive" src="/imges/imgchat/${photo}">
        </div>
        </div>
        
        `);
}

}


    }
});



window.Echo.private('recieve.' + localStorage.getItem('uid'))
.listen('recieve_message', (e) => {
    $('.body-chat').animate({scrollTop:$('.body-chat').prop('scrollHeight')});
    
    if($('.body-msg').attr('id')==`${e.fromid}`){



if(e.recievemessage!='' && e.recievephoto!=''){
    $('.body-msg').append(`
    <div class="row">
    <div class="col-xs-6 friend-message" style="position: relative">
    <img src="/imges/imguser/${e.photo}" style="width: 55px;
    border-radius: 100%;
    height: 53px;">
<div class="msg">${e.recievemessage}</div>

<span class="fa fa-caret-left" style="position: absolute;
     top: 14px;
     left: 81px;
     color: white;"></span>
    </div>
    </div>
    
    `);


    var test=e.recievephoto;
    var arr=test.split(',');
    for(var i=0;i<arr.length;i++){
        var photo=arr[i];
        $('.body-msg').append(`
        <div class="row">
        <div class="col-xs-6 friend-message" style="position: relative">
        <img style="padding-left: 72px;" class="img-responsive" src="/imges/imgchat/${photo}">
        </div>
        </div>
        
        `);
    }


}else if(e.recievemessage!=''){
    $('.body-msg').append(` 
    <div class="row">
    <div class="col-xs-6 friend-message" style="position: relative">
    <img src="/imges/imguser/${e.photo}" style="width: 55px;
    border-radius: 100%;
    height: 53px;">

<div class="msg">${e.recievemessage}</div>
    </div>
    </div>
    
    `);
}else if(e.recievephoto!=''){
     
    $('.body-msg').append(` 
    <div class="row">
    <div class="col-xs-6 friend-message" style="position: relative">
    <img src="/imges/imguser/${e.photo}" style="width: 55px;
    border-radius: 100%;
    height: 53px;">
    </div>
    </div>
    `);

    var test=e.recievephoto;
    var arr=test.split(',');
    for(var i=0;i<arr.length;i++){
        var photo=arr[i];
        $('.body-msg').append(`
        <div class="row">
        <div class="col-xs-6 friend-message" style="position: relative">
        <img style="padding-left: 72px;margin-top: -55px;" class="img-responsive" src="/imges/imgchat/${photo}">
        </div>
        </div>
        
        `);
}

}




}
});


//typing event 

window.Echo.private('typing.'+localStorage.getItem('uid'))
.listen('typingchat', (e) => {
    //scroll
    $('.body-chat').animate({scrollTop:$('.body-chat').prop('scrollHeight')});
    //end
    
    if($('.body-msg').attr('id')==`${e.myid}`){
        setTimeout(function() {
            $('.user-typing').fadeIn();
          }, 500);
          
          setTimeout(function() {
            $('.user-typing').fadeOut();
          }, 1000);
          
}

});




//end



//notifications

window.Echo.private('App.User.' + localStorage.getItem('uid'))
    .notification((n) => {
        if(`${n.type}`=='App\\Notifications\\requestnotifi'){

        $('.request-count').show();

      var test=parseInt( $('.request-count').text());
      $('.request-count').text(test+1);
      $('.no-friends').hide();



      $('body').append(`
<div class="notification-request wow bounceInLeft" data-wow-duration="1s" style="padding: 5px 10px;
position: fixed;
bottom: 30px;
left: 50px;
background: #3c763d;
color: #e3e3e3;
border: 1px solid;
box-shadow: 0px 0px 12px 0px #3c763d;
border-radius: 4px;z-index: 10">
<img style="width:45px" src="/imges/imguser/${n.userphoto}">
 <span style="font-weight: bold;font-size:14px"> ${n.username}</span>
<p style="padding-left: 48px;">Send your friend request</p>

</div>
      `);

      jQuery('body .notification-request').each(function(){
        $(this).delay(10000).fadeOut(2000);
   });



      $(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
      $('.notification-request-header').append(`
      
      
      <li>

      <div class="requests-friend" style="border-bottom: 1px solid #4b5d63;
      padding-bottom: 13px;">
      <a href="#" style="color:white">
      <img style="width:40px" src="/imges/imguser/${n.userphoto}">
     <span> ${n.username}</span>
      </a>

     
      
      <form class="delete-request" method="post" style="display: inline"> 

          <input type="hidden"  name="userid1" class="userid1" value="${n.user_id1}">
          <input type="hidden" name="userid2" class="userid2" value="${n.user_id2}">
          <input type="hidden" name="notifiid" value="${n.id}">
          
          <button type="submit" class="btn btn-danger pull-right delete_req" >Delete</button>      
      </form>
          

      <form class="confirmrequest" method="POST" style="display: inline">
      
      <input type="hidden"  name="userid1" class="userid1" value="${n.user_id1}">
      <input type="hidden" name="userid2" class="userid2" value="${n.user_id2}">
    
      <button type="submit" class="btn btn-primary confirm-request pull-right "   id="${n.id}" style="margin-right: 10px">Confirm</button>
      </form>

    </div>
    
  </li>       


      `);

      $('.delete-request').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:'/delete-request',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(){
                location.reload();
            }
            
          });
        });




        
      $('.confirmrequest').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:'/confirmrequest',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(){
                location.reload();
            }
            
          });
        });



    
    });

}








if(`${n.type}`=='App\\Notifications\\confirmrequestnotifi'){
    $('.badge-notificonfirm').show();
    var test=parseInt( $('.badge-notificonfirm').text());
      $('.badge-notificonfirm').text(test+1);
      $('.no-notifi').hide();


  $('body').append(`
<div class="notification-request wow bounceInLeft" data-wow-duration="1s" style="padding: 5px 10px;
position: fixed;
bottom: 30px;
left: 50px;
background: #3c763d;
color: #e3e3e3;
border: 1px solid;
box-shadow: 0px 0px 12px 0px #3c763d;
border-radius: 4px;z-index: 10">
<img style="width:45px" src="/imges/imguser/${n.confirmuserphoto}">
<span style="font-weight: bold;font-size:14px"> ${n.confirmusername}</span>
<p style="padding-left: 48px;">Accept your friend request</p>

</div>
`);
jQuery('body .notification-request').each(function(){
    $(this).delay(10000).fadeOut(2000);
});


$('.notifi-confirm').append(`

<li>
<div class="confirm-friend" style="border-bottom: 1px solid #4b5d63;
                            padding-bottom: 13px;">
                            <a href="#" style="color:white;text-decoration:none">
                            <img style="width:40px" src="/imges/imguser/${n.confirmuserphoto}">
                           <span style="font-weight: bold">  ${n.confirmusername} </span>
                            </a>
                            <span>accept your friend request</span>

                          </div>
                          
    
  </li>       
`);

}

//message notification
if(`${n.type}`=='App\\Notifications\\message_notification'){

    $('.message-count').show();
    var test=parseInt( $('.message-count').text());
      $('.message-count').text(test+1);
      $('.no-message').hide();

    $('body').append(`

    <div class="notification-message wow bounceInLeft" data-wow-duration="1s" style="padding: 5px 10px;
    position: fixed;
    bottom: 30px;
    left: 50px;
    background: #3c763d;
    color: #e3e3e3;
    border: 1px solid;
    box-shadow: 0px 0px 12px 0px #3c763d;
    border-radius: 4px;z-index: 10">
    <a href="/getuser/${n.fromuserid}" style="color:white;text-decoration:none">
    <img style="width:45px" src="/imges/imguser/${n.fromuserphoto}">
    <span style="font-weight: bold;font-size:14px"> ${n.fromusername}</span>
    <p style="padding-left: 48px;">Send your message</p>
    </a>
    </div>
    `);
    jQuery('body .notification-message').each(function(){
        $(this).delay(10000).fadeOut(2000);
    });




}


});

    


//online presence channel

window.Echo.join('online')
.here((users) => {
    console.log(users);
    // all users here
    users.forEach(user => {
        jQuery('.online').each(function(){
            if($(this).attr('id')==`${user.id}`){
                $(this).show();
            }
        });

        // panel-header chat statues
        if($('.right-online').attr('id')==`${user.id}`){
            $('.right-online').show();
        }
        //end

    });
  

})
.joining((user) => {
    jQuery('.online').each(function(){
        if($(this).attr('id')==`${user.id}`){
            $(this).show();
        }
    });
    // panel-header chat statues
    if($('.right-online').attr('id')==`${user.id}`){
        $('.right-online').show();
    }

    // offline hide
    if($('.right-offline').attr('id')==`${user.id}`){
    $('.right-offline').hide();
    }
    //end

})
.leaving((user) => {
    jQuery('.online').each(function(){
        if($(this).attr('id')==`${user.id}`){
            $(this).hide();
        }
    });

        // panel-header chat statues
        if($('.right-online').attr('id')==`${user.id}`){
            $('.right-online').hide();
        }

  if($('.right-offline').attr('id')==`${user.id}`){
    $('.right-offline').show();
    }    

});
