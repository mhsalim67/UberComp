$(function() {
  //create the thingbroker instance
  var tb = $.ThingBroker();
  tb.postThing({thingId: "mychat"});

  //function for image uploading
  $("#image-upload").submit(function() {
    //use the ajaxsubmit library
    $(this).ajaxSubmit({
      url: 'upload.php',
      type: 'POST',
      success: function(response) {
        //post the event with the returned location
        var resp = JSON.parse(response);
        tb.postEvent("mychat", {location: resp['location']});
      }
    });

    return false;
  });
});