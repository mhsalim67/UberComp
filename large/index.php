<html>  
  <head>  
    <title>UberComp</title>  

  <!-- 1) Include the libraries -->
    <script type="text/javascript" src="../common/config.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="../common/jquery.thingbroker-0.3.0.js"></script>
    <!-- Optional
    <script type="text/javascript" src="jquery.thingbroker-0.3.0.min.js"></script>
    -->

  <!-- 2) Use CSS to make things pretty -->
    <style type="text/css">

    </style>

  </head>  

  <body>
    <div id="chat"></div>

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
          $("#chat").append("<img src='"+response['img_src']+"' />");
        }
      }
      //make sure the thing listens/follows the proper thingid, use custom callback
      $("#chat").thing({listen: true, callback: handleResponse});
      $("#chat").thing({follow: config.app_name});

    </script>

  </body>
</html>
