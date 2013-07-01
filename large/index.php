<html>  
  <head>  
    <title>UberComp</title>  

  <!-- 1) Include the libraries -->
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
      var thing = $.ThingBroker().getThing("mychat");
      if(thing === null) {
        thing = $.ThingBroker().postThing({thingId: "mychat"});
      }
      //custom response handler (appends the image source)
      function handleResponse(json, params, obj) {
        if(json[0] && json[0]['info'] && json[0]['info']['location']) {
          $("#chat").append("<img src='"+json[0]['info']['location']+"' />");
        }
      }
      //make sure the thing listens/follows the proper thingid, use custom callback
      $("#chat").thing({listen: true, callback: handleResponse});
      $("#chat").thing({follow: "mychat"});

    </script>

  </body>
</html>
