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
	<link rel="stylesheet" type="text/css" href="Style/mystyle.css" />
	<script>
		var map;
		function initialize() {
		  var mapOptions = {
			zoom: 13,
			center: new google.maps.LatLng(44.636672,-63.591421),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  };
		  map = new google.maps.Map(document.getElementById('map-canvas'),
			  mapOptions);

		}
function addIcons(response){
	var image = {
    url: 'img/dal.png',
    size: new google.maps.Size(50, 47),
  };
  var myLatLng = new google.maps.LatLng(response.position.latitude,response.position.longitude);
  var marker = new google.maps.Marker({
        position: myLatLng,
		icon: image,
		title: response.img_name,
        map: map});
		map.setCenter(marker.getPosition());
		var contentString = '<div id="content">'+
      '<h3>'+'<img src="'+config.image_qrcode+response.img_src+
	  '"alt="qr code" width="80" height="80" align="middle"/>'+response.img_name+'</h3>'+
      '<div id="bodyContent" class="your-selector">'+
      "<img style='border:10px solid #FFFFFF' src="+
	  config.image_location+response.img_src+config.small_image+' /></br>'+response.comments+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString,
	  maxWidth: 300
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
  <!-- 2) Dividing the large screen -->
   <!-- 3) latestImage location -->
	<div id="latestImage"style="position:absolute;bottom:0;width:100%;height:10%;"></div>
  <!-- 5) Map location -->
    <div id="map-canvas" style="position:absolute;top:0;width:100%;height:90%;"></div>
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
					console.log(response);
					addIcons(response);
        }
      }
      //make sure the thing listens/follows the proper thingid, use custom callback
      $("#latestImage").thing({listen: true, callback: handleResponse});
      $("#latestImage").thing({follow: config.app_name});
	  $("#latestImage").append("<img src="+config.image_qrcode+'response.img_src alt="qr code" width="80" height="80" align="middle"/>');

    </script>

  </body>
</html>