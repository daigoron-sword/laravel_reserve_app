  <!--footer start-->
  <section class="footer" id="footer">
    <div class="container">
      <ul>
        <li><a href="#"><i class="fa fa-twitter fa-2x"></i></a></li>
        <li><a href="#"><i class="fa fa-facebook fa-2x"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin fa-2x"></i></a></li>
        <li><a href="#"><i class="fa fa-vimeo-square fa-2x"></i></a></li>
        <li><a href="#"><i class="fa fa-dribbble fa-2x"></i></a></li>
      </ul>
    </div>
    <p class="text-center"><a href="#wrapper" class="gototop"><i class="fa fa-chevron-up fa-2"></i></a></p>
  </section>
  <!--footer end-->     
  </div>
<!--wrapper end--> 

<!--modernizr js--> 
<script type="text/javascript" src="{{ asset('js/modernizr.custom.26633.js') }}"></script> 
<!--jquary min js--> 
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script> 
<script src="js/bootstrap.min.js"></script> 

<!--for placeholder jquery--> 
<script type="text/javascript" src="{{ asset('js/jquery.placeholder.js') }}"></script> 

<!--for header jquery--> 
<script type="text/javascript" src="{{ asset('js/stickUp.js') }}"></script> 
<script src="{{ asset('js/jquery.superslides.js') }}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
jQuery(function($) {
$(document).ready( function() {
  //enabling stickUp on the '.navbar-wrapper' class
	$('.navbar-wrapper').stickUp({
		parts: {
      0: 'banner',
      1: 'aboutus',
      2: 'skillset',
      3: 'experience',
      4: 'education',
      5: 'ourwork',
      6: 'contact'
		},
		itemClass: 'menuItem',
		itemHover: 'active',
		topMargin: 'auto'
		});
	});
	

});
</script>
<script>
	$('#banner').superslides({
    animation: 'fade',
    play: 5000
	});
</script>  

<!--for portfolio jquery--> 
<script src="{{ asset('js/jquery.isotope.js') }}" type="text/javascript"></script> 
<link type="text/css" rel="stylesheet" id="theme" href="{{ asset('css/jquery-ui-1.8.16.custom.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
<script type="text/javascript" src="{{ asset('js/jquery.ui.widget.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('js/jquery.ui.rlightbox.js') }}"></script> 

<!--contact form js--> 
<script type="text/javascript" src="{{ asset('js/jquery.contact.js') }}"></script> 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(40.6700, -73.9400), // New York
					scrollwheel: false,
                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);
				
				

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(40.6700, -73.9400),
                    map: map,
                    title: 'Hello!'
                });
            }
        </script>

<script src="{{ asset('js/jquery.easing.js') }}"></script> 
<script src="{{ asset('js/jquery.mousewheel.js') }}"></script> 
<script defer src="{{ asset('js/slideroption.js') }}"></script> 

<!--for theme custom jquery--> 
<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>