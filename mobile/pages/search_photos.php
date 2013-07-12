<div data-role="page" id="search_photos">
	<div data-role="header">
		<form id="search-form">
			<input name="search" id="search" placeholder="Search" type="search"/>
		</form>
	</div>

	<div data-role="content">
		<div class="view-main-content"></div>
		<script type="template/underscore" id="search_results_template">
			<ul data-role="listview" data-inset="true" class="view-results view-temp">
				<% _.each(results, function(result) { %>
					<li data-id="<%= result.thingId %>">
						<a href="#view_photo?id=<%= result.thingId %>&search=<%= search %>">
							<img src="<%= config.image_location %><%= result.thingId %><%= config.small_image %>">
							<h2><%= result.name %></h2>
							<p><%= result.metadata.location.readable %></p>
						</a>
					</li>
				<% }); %>
			</ul>
		</script>
	</div>

	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
				<li><a href="#my_photos" data-icon="home">My Photos</a></li>
				<li><a href="#search_photos" data-icon="search" class="ui-btn-active">Search Photos</a></li>
				<li><a href="#add_photo" data-icon="plus">Add Photo</a></li>
			</ul>

		</div>
	</div>
</div>