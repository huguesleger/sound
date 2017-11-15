$(document).ready(function(){

var player = $('.js-audio-player');
var playbackClass = 'is-playing';
var fadeDuration = 500;





player.each(function(index) {
  var $this = $(this);
   var id = 'audio-player-' + index;

  $this.attr('id', id);

  $this.find('.js-control')[0].addEventListener('click', function() {
    resetPlayback(id);
    playback($this, $this.find('audio'));
    $this.find('.audio-player__control-icon').toggleClass('animate-audio1 ');
    $this.find('.audio-player__control-icon2').toggleClass('animate-audio2 ');
   
   
   
   
   
  });
  
  // Reset state once audio has finished playing
  $this.find('audio')[0].addEventListener('ended', function() {
    resetPlayback();
     $this.find('.audio-player__control-icon').removeClass('animate-audio1 ');
     $this.find('.audio-player__control-icon2').removeClass('animate-audio2 ');
  });
  




  
  
});


function playback(player, audio) {
  if (audio[0].paused) {
    audio[0].play();
    audio.animate({ volume: 1 }, fadeDuration);
    player.addClass(playbackClass);
  } else {
    audio.animate({ volume: 0 }, fadeDuration, function() {
      audio[0].pause();
    });
    player.removeClass(playbackClass);
  }
  
}

function resetPlayback(id) {
  player.each(function() {
    var $this = $(this);

    if ($this.attr('id') !== id) {
      $this.find('audio').animate({ volume: 0 }, fadeDuration, function() {
        $(this)[0].pause();
      });
      $this.removeClass(playbackClass);
    }
  }); 
  
}



});


