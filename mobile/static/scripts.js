$(function() {
	if (!navigator.geolocation) {
		//handle geolocation not available (jquery mobile popup)
	}


	//create the thingbroker instance
	var tb = $.ThingBroker();
	tb.postThing({thingId: config.app_name});

	//function for image uploading
	$("#image-upload").submit(function() {
	//use the ajaxsubmit library
	$(this).ajaxSubmit({
		url: 'upload.php',
		type: 'POST',
		success: function(response) {
			//post the event with the returned location
			var curr_pos = new Object();
			navigator.geolocation.getCurrentPosition(function(position) {
	  			curr_pos.latitude = position.coords.latitude;
	  			curr_pos.longitude = position.coords.longitude;

				var resp = JSON.parse(response);
				tb.postEvent(config.app_name, {
					location: resp['img_src'],
					name: resp['image_name'],
					comments: resp['image_comments'],
					position: curr_pos
				});
	  		}, function(error) {
	  			//handle the user not allowing location
	  		});

		}
	});

	return false;
	});
});