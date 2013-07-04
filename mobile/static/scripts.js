$(function() {
	var location_enabled = true;
	$("#add_photo").bind("pageshow", function(event) {
		if (!navigator.geolocation) {
			//handle geolocation not available (jquery mobile popup)
			location_enabled = false;
			$("#file").attr('disabled', true);
			$("#image_name").attr('disabled', true);
			$("#image_comments").attr('disabled', true);
			$("#image_submit").attr('disabled', true);
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

		if(location_enabled) {
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
						if(resp['success']) {
							tb.postEvent(config.app_name, {
								img_src: resp['img_src'],
								img_name: resp['image_name'],
								comments: resp['image_comments'],
								position: curr_pos
							});
						} 
						$("#form_feedback").html(resp['feedback']);
						$("#feedback").popup().popup("open");
					}
				});
			}, function(error) {
				$("#location_support").popup().popup("open");
				//handle the user not allowing location
			});
		}
	return false;
	});
});