
$(document).ready(function(){
	$("#dropdown").click(function(){
		$("#content").slideToggle();
	});	
	$("#dropdown1").click(function(){
		$("#content1").slideToggle();
	});
	$("#dropdown2").click(function(){
		$("#content2").slideToggle();
	});
	$("#dropdown3").click(function(){
		$(".content3").slideToggle();
	});
});

/*SMOOTH SCROLLING*/
$(document).ready(function(){
	var scrollbar = $('.scroll');
	scrollbar.click(function(e){
		e.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top}, 1000);
	});
});

/*SELECTING A PROFILE PICTURE				kaso di pa gumagana
$(document).ready(function(){
	var loadFile = function(event) {
		var output = document.getElementById('output');
		output.src = URL.createObjectURL(event.target.files[0]);
	};
});

/*$(window).scroll(function(){
	var scrollbarLocation = $(this).scrollTop();
	console.log(scrollbarLocation);
	scrollLink.each(function(){
		var sectionOffset = $(this.hash).offset().top-20;
		if (sectionOffset <= scrollbarLocation) {
			$(this).parent().addClass('active');
			$(this).parent().siblings().removeClass('active');
		}
	});
});*/

 function yScroll(){
 	var banner = document.getElementById('banner');
 	var navbar = document.getElementById('navbar');
 	var yPos = window.pageYOffset;

 	if (yPos > 150) {
 		banner.style.height = "400px";
		navbar.style.height = "30px";
 		navbar.style.backgroundColor = "#37424b";
 		navbar.style.color = "white";
 		navbar.style.transition = "0.2s";
 	}
 	else{
 		banner.style.height = "0px";
 		navbar.style.height = "0px";
 		navbar.style.backgroundColor = "transparent";
 		navbar.style.color = "black";
 		navbar.style.transition = "0.2s";
 	}
 }
 window.addEventListener("scroll", yScroll);