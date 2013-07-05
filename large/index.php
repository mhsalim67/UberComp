<html>  
  <head>  
    <title>UberComp</title>  
<style>
      html, body, #map-canvas {
        margin: 0;
        padding: 0;
        height: 100%;
      }
</style>
  <!-- 1) Include the libraries -->
    <script type="text/javascript" src="../common/config.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="../common/jquery.thingbroker-0.3.0.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script>
		var map;
		function initialize() {
		  var mapOptions = {
			zoom: 12,
			center: new google.maps.LatLng(44.636672,-63.591421),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  };
		  map = new google.maps.Map(document.getElementById('map-canvas'),
			  mapOptions);
			  
		}
function addIcons(response){

	
	var image = {
    url: 'img/dal.png',
    // This marker is 20 pixels wide by 32 pixels tall.
    size: new google.maps.Size(50, 47),
    // The origin for this image is 0,0.
    //origin: new google.maps.Point(0,0),
    // The anchor for this image is the base of the flagpole at 0,32.
    //anchor: new google.maps.Point(0, 32)
  };
  var myLatLng = new google.maps.LatLng(response.position.latitude,response.position.longitude);
  var marker = new google.maps.Marker({
        position: myLatLng,
		icon: image,
		title: response.img_name,
        map: map});
		
		
		var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h3 id="firstHeading" class="firstHeading">'+response.img_name+'</h3>'+
      '<div id="bodyContent">'+
	  '<img src='+response['img_src']+' /></br>'+
	  '<img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=response.QRlink"alt="qr code"  width="100" height="100"/></br>'

      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
		
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });		
  infowindow.open(map,marker);		
		
		
}
		google.maps.event.addDomListener(window, 'load', initialize);
    </script>
     
  </head>  
  <body>
    <div id="chat"></div>
    <div id="map-canvas"></div>
    <script type="text/javascript">
      //Make sure the thing is created
      var thing = $.ThingBroker().getThing(config.app_name);
      if(thing === null) {
        thing = $.ThingBroker().postThing({thingId: config.app_name});
      }
      //custom response handler (appends the image source)
      function handleResponse(json, params, obj) {
        var response;
        if(json[0] && json[0]['info']) {
          response = json[0]['info'];
        }
        /*
          response['img_src']   gives access to the relative url of the image
          response['img_name']  name given to the image by the user
          response['position']  has 2 elements: longitude, latitude for the user location
          response['comments']  comments about the image by the uploading user
        */
        if(response && response['img_src']) {
         // $("#chat").append("<img src='"+response['img_src']+"' />");
		  			console.log(response.img_src );
					console.log(response.img_name);
		  			console.log(response.position);
		  			console.log(response.comments);
		  			console.log(response);

					addIcons(response);
        }
      }
      //make sure the thing listens/follows the proper thingid, use custom callback
      $("#chat").thing({listen: true, callback: handleResponse});
      $("#chat").thing({follow: config.app_name});

    </script>

  </body>
</html>
