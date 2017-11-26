/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
// var for audio content

var audio = document.getElementById('audio');


// html5 function - toggle play/pause btn and audio
  
$("#plays_btn").click(function() {


   
    if (audio.paused === false) {
        audio.pause();
        $("#play_btn").show();
        $("#pause_btn").hide();
    } else {
        audio.play();
        $("#play_btn").hide();
        $("#pause_btn").show();
    }
$('#prev_btn').click(function(){
    
    audio.currentTime = 0;
    audio.pause();
     $("#play_btn").show();
        $("#pause_btn").hide();
});


    
});


// function for timeline

audio.addEventListener("timeupdate", function() {

    var currentTime = audio.currentTime,
        duration = audio.duration,
        currentTimeMs = audio.currentTime * 1000;
    $('.progressbar_range').stop(true, true).animate({'width': (currentTime + .25) / duration * 100 + '%'}, 250, 'linear');
});



// count function for timeleft

audio.addEventListener("timeupdate", function() {
    var timeleft = document.getElementById('timeleft'),
        duration = parseInt( audio.duration ),
        currentTime = parseInt( audio.currentTime ),
        timeLeft = duration - currentTime,
        s, m;
    
    s = timeLeft % 60;
    m = Math.floor( timeLeft / 60 ) % 60;
    
    s = s < 10 ? "0"+s : s;
    m = m < 10 ? "0"+m : m;
    
    $('#timeleft').text("-"+m+":"+s);
    $('#timeSound').text(duration);
    
    
});



   }); 
    