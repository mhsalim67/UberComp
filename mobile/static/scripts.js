$(function() {
	$("#add_photo").bind("pageshow", function(event) {
		if (!navigator.geolocation) {
			//handle geolocation not available (jquery mobile popup)
			$("#location_support").popup().popup("open");
		}
	});

	//create the thingbroker instance
	var tb = $.ThingBroker();
	tb.postThing({thingId: config.app_name});

	//function for image uploading
	$("#image-upload").submit(function() {
		var self = this;
		var curr_pos = new Object();

		navigator.geolocation.getCurrentPosition(function(position) {
			curr_pos.latitude = position.coords.latitude;
			curr_pos.longitude = position.coords.longitude;
			//use the ajaxsubmit library
			$(self).ajaxSubmit({
				url: 'upload.php',
				type: 'POST',
				success: function(response) {
					//post the event with the returned location
					var resp = JSON.parse(response);
					tb.postEvent(config.app_name, {
						img_src: resp['img_src'],
						name: resp['image_name'],
						comments: resp['image_comments'],
						position: curr_pos
					});
				}
			});
		}, function(error) {
			$("#location_support").popup().popup("open");
			//handle the user not allowing location
		});
	return false;
	});
});