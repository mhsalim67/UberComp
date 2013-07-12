$(function() {
	var location_enabled = true,
		search_results_template = _.template($("#search_results_template").html()),
		result_view_template = _.template($("#result_view_template").html()),
		image_comment_template = _.template($("#image_comment_template").html()),
		$_GET = {};

	//create the thingbroker instance
	var tb = $.ThingBroker();
	tb.postThing({thingId: config.app_name});

	$.mobile.pageContainer.on("pagebeforechange", function(e, data) {
		$_GET = data.options.pageData;
	});

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

	$("#search_photos").bind("pageshow", function(event) {
		updateSearchResults();
	});

	$("#view_photo").bind("pageshow", function(event) {
		if(!($_GET && $_GET.id)) {
			$.mobile.changePage("#search_photos");
			return false;
		}
		var thing = $.ThingBroker().getThings({
			fields: ['thingId'],
			queries: [$_GET.id]
		});
		thing = thing[0];
		$(".view-temp").remove();
		$(".view_photo_content").append(
			result_view_template({
				name: thing.name,
				thingId: thing.thingId,
				description: thing.description
			})
		);

		$("#save-comment").trigger("create");
		$("#save-comment").submit(function() {
			var comment = $("#comment").val();
			var new_event = tb.postEvent($_GET.id, {comment: comment}),
				date = new Date(new_event.serverTimestamp);

			$(".image_comments").prepend(
				image_comment_template({
					comment: comment,
					time: date.getDate()+"-"+date.getMonth()+"-"+
						date.getFullYear()+" at "+date.getHours()+":"+
						date.getMinutes()
				})
			);
			$("#comment").val("");
			$(".image_comments").listview("refresh");

			return false;
		});

		var comments = tb.getEvents($_GET.id);
		_.each(comments, function(comment) {
			var date = new Date(comment.serverTimestamp);
			$(".image_comments").append(
				image_comment_template({
					comment: comment.info.comment,
					time: date.getDate()+"-"+date.getMonth()+"-"+
						date.getFullYear()+" at "+date.getHours()+":"+
						date.getMinutes()
				})
			);
		});
		$(".image_comments").listview().listview("refresh");

	});

	$("#search-form").submit(function() {
		var query = $("#search").val(),
			args = {};
		if(query) {
			args.fields = ['name']; 
			args.queries = [query];
			args.search = query;
		}
		updateSearchResults(args);
		return false;
	});

	function updateSearchResults(args) {
		var search = {
			fields: ['type'],
			queries: ['image']
		};
		if(args && args.fields && args.queries) {
			search.fields = search.fields.concat(args.fields);
			search.queries = search.queries.concat(args.queries);
		}
		
		var things = $.ThingBroker().getThings({
			fields: search.fields,
			queries: search.queries
		});
		search = '';
		if(args && args.search) {
			search = args.search;
		}

		$(".view-temp").remove();
		$(".view-main-content").append(
			search_results_template({
				results: things,
				search: search
			})
		);
		$(".view-results").listview().listview("refresh");
	}

	//function for image uploading
	$("#image-upload").submit(function() {
		var self = this;
		var curr_pos = new Object();

		if(location_enabled) {
			navigator.geolocation.getCurrentPosition(function(position) {
				curr_pos.latitude = position.coords.latitude;
				curr_pos.longitude = position.coords.longitude;
				curr_pos.readable = ""
				var deferred = $.Deferred();
				$.ajax({
					url: "http://maps.googleapis.com/maps/api/geocode/json?sensor=true&latlng="+curr_pos.latitude+","+curr_pos.longitude,
					success: function(response) {
						_.each(response['results'], function(data) {
							if(data.types[0] == "locality") {
								curr_pos.readable = data.formatted_address;
								return true;
							}
						});

						deferred.resolve();
					}
				});

				$.when(deferred).done(function() {
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
								$.ThingBroker().postThing({
									thingId: resp['img_src'].toString(),
									name: resp['image_name'],
									description: resp['image_comments'],
									type: 'image',
									metadata: {
										'location': curr_pos
									}
								});
							} 
							$("#form_feedback").html(resp['feedback']);
							$("#feedback").popup().popup("open");
						}
					});
				});	
			}, function(error) {
				$("#location_support").popup().popup("open");
				//handle the user not allowing location
			});
		}
	return false;
	});
});