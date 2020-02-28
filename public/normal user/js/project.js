
  // JavaScript Document
$(function(){
	"use strict";
	$(".small").on("click",function(){
		$(this).addClass("active1").siblings().removeClass("active1");
		
		$(".large").attr('src',$(this).attr('src'));
	});
      
});


// chat 
