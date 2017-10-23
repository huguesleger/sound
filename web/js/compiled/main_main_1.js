
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
                    $('#bg-header').show;
                    $('#bg-header').velocity({
//                    translateX: "-40%",
                    width: "70%",
                    right: "0",
                   
                    opacity : 1
                    
                }, {
                    duration: 600,
                    easing: [0.7,0,0.3,1],
                    complete: function(){
                        $('.home').addClass('animate-border divide');
//                        $('#bg-header').css({left:'0'});
                        
                    }
                });
                    }
                });
            },1500);
        });
        

////////// largeur contenu moins la tailles des borders//////////
$(window).resize(function(){
  var content = null;
  var windowWidth = $(window).innerWidth();
  var windowHeight = $(window).innerHeight(); 
  var borderLeft = $('.left').innerWidth();
  var borderRight = $('.right').innerWidth();
  var content = windowWidth - (borderLeft + borderRight); 
  
   if(windowWidth < 1200){
    $('.app').css({width:"100%"});
//    $('.header').css('height','auto');

    } else {
    $('.app').css({width:content});
    ////////// hauteur de la fenetre window/////////
    $('.header').css('height',windowHeight);
  }
});


$(document).ready(function(){
    
    
   /////////////////////////////////////////
   /////////////nav-mobile///////////////
   
   var windowWidth = $(window).innerWidth();
   
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



});

/////////ajoute section avec big phrase
// en dessous du header version mobile

 $(document).ready(function(){   
   var windowWidth = $(window).innerWidth();
   if(windowWidth >= 768 ){
         $('#BigPhrase').hide(); 
    
   }else  {
       $( "#BigPhrase" ).show();
      
   }
});




 $(window).resize(function(){   
   var windowWidth = $(window).innerWidth();
   if(windowWidth >= 768 ){
         $('#BigPhrase').hide(); 
    
   }else  {
       $( "#BigPhrase" ).show();
      
   }
});


/// class texte position mobile//
///////////////////////////////////////

$(document).ready(function(){
   var windowWidth = $(window).innerWidth();
   if(windowWidth >= 768 ){
          $('#Txt p').removeClass('txt-txt');
          $('#Txt p').addClass('txt-center');
    
   }else  {
       $('#Txt p').removeClass('txt-center');
          $('#Txt p').addClass('txt-txt');
      
   } 
   
   
    
});
    $(document).ready(function(){
          
        $ ( '.carousel' ). carousel ({ interval : 0 });
    });