$(function() {
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
			var resp = JSON.parse(response);
			tb.postEvent(config.app_name, {
				location: resp['location'],
				name: resp['image_name'],
				comments: resp['image_comments']
			});
		}
	});

	return false;
	});
});