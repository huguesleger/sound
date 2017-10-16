var windowHeight;
var windowWidth;


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
                    width: "60%",
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
  var borderLeft = $('.left').innerWidth();
  var borderRight = $('.right').innerWidth();
  var content = windowWidth - (borderLeft + borderRight);
  
  $('.app').css({width:content, left:"55px"});

    
////////// hauteur du header/////////
var windowHeight = $(window).innerHeight(); 
$('.header').css('height',windowHeight);
    
    
    
    
});


