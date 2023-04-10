(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('.slider').slider({
      "indicators": false
    });
    $('.materialboxed').materialbox();


    var sound = new Howl({
      src: ['https://donihanna.space/music.mp3'],
    });

    var play_button = $('#musik');
    play_button.click(function() {
      if (play_button.hasClass('bi bi-play-fill')) {
        play_button.attr('class', 'bi bi-music-note pulse');
        sound.play();
      } else {
        play_button.attr('class', 'bi bi-play-fill');
        sound.pause();
      }
    });
    // if (play_button.attr('class', 'bi bi-play-fill')) {
    //   console.log('play');
    // } else {
    //   play_button.attr('class', 'bi bi-music-note')
    //   play_button.click(function() {
    //     sound.stop();
    //   });
    //   console.log('stop');
    // }

  }); // end of document ready
})(jQuery); // end of jQuery name space

// Set the date we're counting down to
var countDownDate = new Date("Jan 28, 2023 08:00:00").getTime();
    
// Update the count down every 1 second
var x = setInterval(function() {

// Get today's date and time
var now = new Date().getTime();
  
// Find the distance between now and the count down date
var distance = countDownDate - now;
    
// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
// Output the result in an element with id="demo"
document.getElementById("time").innerHTML = days + " Days " + hours + " Hours "
+ minutes + " Minutes " + seconds + " Second ";
    
// If the count down is over, write some text 
if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "EXPIRED";
  }
}, 1000);

var url_string = window.location.href; // www.test.com?name=test
var url = new URL(url_string);
var paramValue = url.searchParams.get("name");
if (paramValue == null) {
  document.getElementById("name").innerHTML = "Our wedding day in";
  document.getElementById("nameBanner").innerHTML = "We invite you to celebrate our wedding";
} else {
  document.getElementById("name").innerHTML = "Hi " + paramValue + ", please come to our wedding day in ";
  document.getElementById("nameBanner").innerHTML = "Hi " + paramValue + ", we invite you to celebrate our wedding";
}

// 2. This code loads the IFrame Player API code asynchronously.
// var tag = document.createElement('script');

// tag.src = "https://www.youtube.com/iframe_api";
// var firstScriptTag = document.getElementsByTagName('script')[0];
// firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// // 3. This function creates an <iframe> (and YouTube player)
// //    after the API code downloads.
// var player;
// function onYouTubeIframeAPIReady() {
//   player = new YT.Player('player', {
//     // width: '100%',
//     videoId: 'e6FFsY-9MZo',
//     playerVars: { 'controls': 0, 'autoplay': 1, 'playsinline': 1, 'loop': 1, 'modestbranding': 1, 'playlist': 'e6FFsY-9MZo'},
//     events: {
//       'onReady': onPlayerReady
//     }
//   });
// }
  
// // 4. The API will call this function when the video player is ready.
// function onPlayerReady(event) {
// //   event.target.mute();
//   event.target.playVideo();
// }

// 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                videoId: 'XRuDQ6aYeD0',
                playerVars: {
                    'playsinline': 1,
                    "autoplay": 1, // and 0 means off
                    "controls": 0,
                    "showinfo": 0,
                    "modestbranding": 0,
                    "loop": 1,
                    "fs": 0,
                    "cc_load_policy": 0,
                    "iv_load_policy": 3,
                },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }


        function onPlayerReady(event) {
            event.target.mute();
            setTimeout(function() {
               event.target.playVideo();
            }, 0.01);
        }
        
        // function running(event){
        //     var data = players[videoId]['data'];
        //     setTimeout(function() {
        //       event.target.setVolume(50);
        //       event.target.playVideo();
        //     }, 0.01);
        // }

        function onPlayerStateChange(event) {
            if (event.target.getPlayerState() === 0) {
                setTimeout(function() {
                    event.target.playVideo();
                }, 0);
            }
        }

        function stopVideo() {
            player.stopVideo();
        }

// function playAudio() {
//   var sound = document.getElementById('musik');
//   if (sound.paused && sound.currentTime >= 0 && !sound.started) {
//       sound.play();
//       $("i#musik").attr("class", "ri-music-2-line ")
//   } else {
//       sound.pause();
//       $("i#musik").attr("class", "ri-play-fill ")
//   }
// }