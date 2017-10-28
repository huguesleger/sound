
//// chargement page
$(window).load(function(){
            setTimeout(function(){
                $('#svg').velocity({
                    opacity : 0.1,
                    translateY: "-80px"
                }, {
                    duration: 600,
                    complete: function(){
                        $('#hola').css('z-index','99');
                        $('#hola').hide();
                        $('#bg-header').show();
                        $('#animTexteIntro').hide();
                        $('#navSlider').hide();
                        $('.pochette-disc').hide();
                        $('.navbar-default').css('opacity','0');
                        //mobile//////
                        $('.anim-hello').hide();
                        $('.txt-hello').hide();
                        ///////////////
                        $('.frame-left, .frame-right').addClass('visible-x');
                        $('.frame-top, .frame-bottom').addClass('visible-y');
                        $('#bg-header').velocity({
                    width: "75%",
                    right: "0",
                    opacity : 1
                }, {
                    duration: 600,
                    easing: [0.7,0,0.3,1],
                    complete: function(){
                        $('.navbar-default').css('opacity','1');
                        $('.pochette-disc').show();
                        $('#animTexteIntro').show();
                       //mobile//////
                        $('.anim-hello').show();
                        $('.txt-hello').show();
                        ///////////////

//                        $('.carousel-indicators').show();
                      
                        $(window).on('scroll', function(){
	if( $(window).scrollTop()> 15 ){
            
            $('#animTexteIntro').hide();
            $('.slide-txt').show();
            $('.carousel-inner').show();
            $('#navSlider').show();
	} else {
		$('#animTexteIntro').show();
               
                $('.slide-txt').hide();
                 $('.carousel-inner').hide();
                 $('#navSlider').hide();
	}

});            
                   }
                });
               
                $('#headerSlider').velocity({
                    opacity : 1
                }, {
                    duration: 600,
                    easing: [0.7,0,0.3,1],
                    complete: function(){
                        $('.navbar-default').css('opacity','1');           
                    }
                });
                
        
                    }
                });
            },1500);
        });
        



$(document).ready(function(){
    
 

    
    
    
   var windowWidth = $(window).innerWidth();
   var windowHeight = $(window).innerHeight();
   var titleHeightPresent = $('#Present').innerHeight();
    
    
   /////////////////////////////////////////
   /////////////nav-mobile///////////////
   
   
    if(windowWidth < 768){
        $('.main-icon').click(function(){
        $('.menu-type').toggleClass('open');
        $('.navbar-brand').addClass('white');
        $('#content').toggleClass('push-content');
              
    $this = $(this);
    if($this.hasClass('is-open')){
	$this.removeClass('is-open , is-open-color');
//        $('body').css('overflowY','visible');
        $('#colorLogo').find("path").attr('fill','#000');
        $('.main-content').show();
        $('.menu-tint').hide(410);
        $('.nav-mobile').hide();
    }else{
        $this.addClass('is-open is-open-color');
        $('.nav-mobile').show().addClass('open');
        }
        });
    }
    
    
    
////////////////////////////////
//////////////////////////////



///////// hauteur du header selon et style et device

if ($('#headerDefault').hasClass('active')){
    $('#headerSlider').remove();
    if (windowWidth >1200){
         $('.header').css('height',windowHeight - titleHeightPresent +12+"px"); 
    } else if (windowWidth <1200) {
      $('.header').css('height','40vh');   
    }
} else {
     $('#headerDefault').removeClass('active');
     $('.header').css('height','auto');   
}

if (windowWidth <768){
   $('#header-mobile').addClass('active');
if($('#header-mobile').hasClass('active')){
     $('.header').css('height','auto');   
}
}else {
    $('#header-mobile').removeClass('active');
}








/////////ajoute section avec big phrase
// en dessous du header version mobile

  
   if(windowWidth >= 768 ){
         $('#BigPhrase').hide(); 
    
   }else  {
       $( "#BigPhrase" ).show();
      
   }



/// class texte position mobile//
///////////////////////////////////////


   if(windowWidth >= 1024 ){
          $('#Txt p').removeClass('txt-txt');
          $('#Txt p').addClass('txt-center');
    
   }else  {
       $('#Txt p').removeClass('txt-center');
          $('#Txt p').addClass('txt-txt');
      
   } 
   
   

  
  ////////cache Header Style en version mobile  
   if(windowWidth <768){
             $('#headerSlider').hide();
         } else {
              $('#headerSlider').show();
         }
         
          if(windowWidth <768){
             $('#headerDefault').hide();
         } else {
              $('#headerDefault').show();
         }
  /////////////////////////////////
  /////////////////////////////////
    });
    
    
        $(window).resize(function(){ 
               
        var windowWidth = $(window).innerWidth();
        var windowHeight = $(window).innerHeight(); 
        var titleHeightPresent = $('#Present').innerHeight();
   
         if(windowWidth <768){
             $('#headerSlider').hide();
         } else {
              $('#headerSlider').show();
         }
         
          if(windowWidth <768){
             $('#headerDefault').hide();
         } else {
              $('#headerDefault').show();
         }
         

   if(windowWidth >= 768 ){
         $('#BigPhrase').hide(); 
    
   }else  {
       $( "#BigPhrase" ).show();
      
   }

   if(windowWidth >= 1024 ){
          $('#Txt p').removeClass('txt-txt');
          $('#Txt p').addClass('txt-center');
    
   }else  {
       $('#Txt p').removeClass('txt-center');
          $('#Txt p').addClass('txt-txt');   
   }
   
   
   
   if ($('#headerDefault').hasClass('active')){
    $('#headerSlider').remove();
    if (windowWidth >1200){
         $('.header').css('height',windowHeight - titleHeightPresent); 
    } else if (windowWidth <1200) {
      $('.header').css('height','40vh');    
    }
} else {
     $('#headerDefault').removeClass('active');
     $('.header').css('height','auto');   
}

if (windowWidth <768){
    $('#header-mobile').addClass('active');
if($('#header-mobile').hasClass('active')){
     $('.header').css('height','auto');   
}
}else {
    $('#header-mobile').removeClass('active');
}

  
});
   

    
 