  /* global targetPageClass */


    
   var windowWidth = $(window).innerWidth();
   var windowHeight = $(window).innerHeight();
   var titleHeightPresent = $('#Present').innerHeight();


//// chargement page
$(window).load(function(){
         if($('body').hasClass('home-page')){
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
            } else {
                     $('.navbar-default').css('opacity','1');
                     $('.frame-left').addClass('bl');
                     $('.frame-top').addClass('bt');
                     $('.frame-right').addClass('br');
                     $('.frame-bottom').addClass('bb');   
                 }  
        });
        

 
    

$(document).ready(function(){
    
   
    ///////////////////////////////////////////
   /// si aucun resultat sur recherche sound///
  
   var prod = $('#searching p').length;
   
    if( prod === 0){

//        $('#prod').append('<div class="col-md-6 no-result alert alert-nofind alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Aucun résultat pour cette recherche</div>');

        $('#prod').append('<div id="NoResult"><div class="no-result"><p>Aucun résultat</p> <svg xmlns="http://www.w3.org/2000/svg" class="wave-title" viewBox="0 0 238 29"><path d="M1382.78,3879.29c-20.73,15.59-38.41,15.59-59.15,0-13.52-10.17-25.06-10.17-38.57,0-20.54,15.44-37.29,15.44-57.83,0-13.67-10.28-22.9-10.28-36.58,0l-5.64-7.54c16.62-12.5,30.59-13,47.87,0,16.29,12.25,28.31,13.7,46.54,0,17.28-13,33.34-12.42,49.86,0,16.95,12.75,30.25,13.25,47.86,0,17.29-13,28.59-13,45.87,0l-5.64,7.54C1403.48,3868.84,1396.68,3868.84,1382.78,3879.29Z" transform="translate(-1185 -3862)"/></svg><p class="no-result-lite">pour cette recherche <br> <i class="fa fa-circle fa-pulse" aria-hidden="true"></i><i class="fa fa-circle fa-pulse" aria-hidden="true"></i><i class="fa fa-circle fa-pulse" aria-hidden="true"></i></p></div></div>');
            $('.no-result').css({
        top: ($(window).height() - $('.no-result').outerHeight()) / 2,
         right: ($(window).width() - $('.no-result').outerWidth()) / 2,
    });
    } else {
       $('#prod').remove('.no-result'); 
    }
    
   /////////////////////////////////////////
   /////////////nav-mobile///////////////
   
   
    if(windowWidth <= 767){
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
    
    //////////////////////////////////////////
    //////nav desktop genres sound////////////
    
      if(windowWidth > 768){
        $('.main-icon-genre').click(function(){
        $('.wraper').toggleClass('wraper-open');
        $('.genres').toggleClass('genres-open');
        $('.push-prod').toggleClass('push-down');
        $('.navbar-brand').addClass('white');
        $('#content').toggleClass('push-content');
              
    $this = $(this);
    if($this.hasClass('is-open')){
	$this.removeClass('is-open , is-open-color');
//        $('body').css('overflowY','visible');
        $('#colorLogo').find("path").attr('fill','#000');
        $('.main-content').show();
        $('.menu-tint').hide(410);

    }else{
        $this.addClass('is-open is-open-color');
        }
        });
    }
    
    
    
////////////////////////////////
//////////////////////////////

///////// border page prod
//if ($('body').hasClass('productions')){
//   $('.frame-left, .frame-right').addClass('visible-x');
//   $('.frame-top, .frame-bottom').addClass('visible-y'); 
//};


///////// hauteur du header selon style et device

if ($('#headerDefault').hasClass('active')){
    $('#headerSlider').remove();
    if (windowWidth >1200){
         $('.header').css('height',windowHeight - titleHeightPresent + 90+"px"); 
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



/// class texte present position mobile//
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
  
        ///////////footer/////////////
           if(windowWidth < 1024 ){      
            $('.email').hide();
            $('.social-icon').insertBefore('.copy');
        }else  {
            $('.email').show();
            $('.social-icon').insertAfter('.email');
        }
 
 
        

    // on va recuperer la hauteur de la div promotion
    // quand je deppasse la section promotion
    // je declanche la function au scroll
    //qui affiche la div footer
    
    
    
//    if ( $(window).scrollTop() <=(promo)){
//        $('.credit').removeClass('visible');
//    } else {
//        $('.credit').addClass('visible');
//    }

//    $(window).on('scroll', function(){
//        var promo = $('.page-container').outerHeight() - $('.footer').outerHeight() +250 ;
//
//	if( $(document).scrollTop()> promo ){
//		 $('.footer').addClass('visible');
//	} else {
//		$('.footer').removeClass('visible');
//	}
//
//});


    if(windowWidth < 768){
        $('#subContact').addClass('text-center');
        $('#btnSubContact').css('float','none');
    } else {
        $('#subContact').removeClass('text-center');
        $('#btnSubContact').css('float','right');
    }



    });
    
    
    
    
        $(window).resize(function(){ 
                
        var windowWidth = $(window).innerWidth();
        var windowHeight = $(window).innerHeight(); 
        var titleHeightPresent = $('#Present').innerHeight();
        
        
        
         /////////////////////////////////////////
   /////////////nav-mobile///////////////
   
   
    if(windowWidth <= 767){
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


 if(windowWidth < 768){
        $('#subContact').addClass('text-center');
        $('#btnSubContact').css('float','none');
    } else {
        $('#subContact').removeClass('text-center');
        $('#btnSubContact').css('float','right');
    }



        ///////////footer/////////////
           if(windowWidth < 1024 ){      
            $('.email').hide();
            $('.social-icon').insertBefore('.copy');
        }else  {
            $('.email').show();
            $('.social-icon').insertAfter('.email');
        }
        
        
  
});
   

    
 