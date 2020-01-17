<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">

  <title>HTML5 Video Slider Demo</title>

  <!-- jQuery (required) -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>

  <!-- Anything Slider -->
  <link rel="stylesheet" href="style.css">
  <script src="js/jquery.anythingslider.js"></script>
  <script src="js/jquery.easing.1.2.js"></script>

  <script>
    // DOM Ready
    $(function(){
      $('#slider').anythingSlider({
        easing: 'easeInOutSine',
        animationTime: 1000,
          buildArrows         : false,      // If true, builds the forwards and backwards buttons
          buildNavigation     : false,      // If true, builds a list of anchor links to link to each panel
          buildStartStop      : false,      // If true, builds the start/stop button and adds slideshow functionality
          // play the video on the first slide
          onInitialized: function(e, slider) {
            var vid = slider.$currentPage.find('video');
            if (vid.length && typeof(vid[0].pause) !== 'undefined') {
              vid[0].play();
              vid[0].onplay = poll(vid);
            }
          },
          // start video again
          onSlideComplete: function(slider) {
            var vid = slider.$currentPage.find('video');
            if (vid.length && typeof(vid[0].pause) !== 'undefined') {
              vid[0].play();
              vid[0].onplay = poll(vid);
            }
            //Reset time of prev video (now that it's out of view)
            var prevVid = slider.$lastPage.find('video');
            if (prevVid.length && typeof(prevVid[0].pause) !== 'undefined') {
              prevVid[0].currentTime = 0;
            }
          },
        });
      //Add the event listener to the current video
      function poll(vid) {
        vid[0].addEventListener('ended', vidEnded,false);
        function vidEnded(e) {
          if(!e) { e = window.event; }
          $('#slider').data('AnythingSlider').goForward();
        }
      }
    });
  </script>

</head>

<body>
  <ul id="slider">
    <li class="panel1">
      <video>
        <source src="vid1.mp4" type="video/mp4">
      </video>
    </li>
    <li class="panel2">
      <video>
        <source src="vid2.mp4" type="video/mp4">
      </video>
    </li>
  </ul>
</body>
</html>