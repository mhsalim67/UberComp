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
		var fake_coordinates = 0;
		<!-- Fake coordinates just for the userstudy -->
		var fake_coordinates_array =[[44.647418, -63.580434],[44.624896, -63.571014],[44.625647, -63.604145],[44.648366, -63.621483],[44.639276,-63.589725]];
		var map;
		<!-- Counter to keep 10 items on the map -->
		var counter =1;
		<!-- In the first run when there is no items on the map, it wont let the program to try remove items that there are not on them; so there wont be an error -->
		var stat = 0;
		<!--AN ararray of markers to place on the map  -->
		var marker = [];
		var infowindow;
		<!--Defining map options such as: zoom level, center of the map, type of map-->
		function initialize() {
		  var mapOptions = {
			zoom: 14,
			center: new google.maps.LatLng(44.636672,-63.591421),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  };
		  map = new google.maps.Map(document.getElementById('map-canvas'),
			  mapOptions);

		}
		<!--every time user send an item to the map, this function will be called to add the image as a marker to the map  -->
		<!--dal.png is the an ivisible marker, and side defined the size of popout windows on the map -->
function addIcons(response){
	var image = {
    url: 'img/dal.png',
    size: new google.maps.Size(50, 47),
  };
    var myLatLng;
			<!--this is function we added for fake items during users study, only first 4 iamges use the fake coordinate, after that it use user real coordinate, By changing 4 to -1 we always have the real coordinate -->
  if(fake_coordinates <4){
     myLatLng = new google.maps.LatLng(fake_coordinates_array[fake_coordinates][0],fake_coordinates_array[fake_coordinates][1]);
		 fake_coordinates++;
	}else{
	     myLatLng = new google.maps.LatLng(fake_coordinates_array[4][0],fake_coordinates_array[4][1]);

	}
			<!-- having 10 items on the map -->
  if (counter == 10){
	counter = 1;
	stat = 1;
  }
  if(stat==1){
  marker[counter].infowindow.close();
  }
  marker [counter] = new google.maps.Marker({
        position: myLatLng,
		icon: image,
		title: response.img_name,
        map: map
		});
	<!--Defining html style for the pop out windows  -->

		var contentString = '<div id="content"  ><table border="0" > <tbody><tr><td rowspan="2" width="100" height="62"><img src="'+
	  config.image_location+response.img_src+config.small_image+'" /></td><td width="50" height="12">'+response.img_name+'</td></tr><tr><td width="50" height="50">'+
      '<img src="'+config.image_qrcode+response.img_src+
	  '"alt="qr code" width="50" height="50"  align="top"/></td></tr><tr><td colspan="2" width="200" ><div class="your-selector ">'+
      response.comments+'</div></td></tr></tbody></table></div>';
	<!-- adding the pop out windows th the marker, this windows has the name, comments and the image -->

   marker[counter].infowindow = new google.maps.InfoWindow({
      content: contentString,
	  maxWidth: 200
	  });
	  
		<!--for the touch screen display, users can click on the map to have more windows  -->
  google.maps.event.addListener(marker[counter], 'click', function() {
	marker[counter].infowindow.open(map,marker);	
  });		
  		<!--windows will be open by defult in non touch screen displays  -->
  marker[counter].infowindow.open(map,marker[counter]);	
counter ++;  
}
		google.maps.event.addDomListener(window, 'load', initialize);
    </script>
     
  </head>  
  <body>
  <!-- 2) Dividing the large screen -->
   <!-- 3) latestImage location -->
	<div id="latestImage" class="Overlay"></div>
  <!-- 5) Map location -->
    <div id="map-canvas" style="position:absolute;top:0;width:100%;height:100%;"></div>
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