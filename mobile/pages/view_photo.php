<div data-role="page" id="view_photo">
	<div data-role="header">
		<div class="view_photo_header"></div>
		<script type="template/underscore" id="result_title_template">

		</script>
	</div>

	<div data-role="content">
		<div class="view_photo_content"></div>
		<div class="image_comments"></div>
		<script type="template/underscore" id="result_view_template">
			<div class="view-temp">
				<h1><%= name %></h1>
				<img src="<%= config.image_location %><%= thingId %><%= config.large_image %>">
				<p><%= description %>

				<form id="save-comment">
					<textarea name="comment" id="comment"></textarea>
					<button data-theme="a" id="comment_submit">Submit</button>
				</form>
			</div>
		</script>

		<script type="template/underscore" id="image_comment_template">
			<div class="comment">
				<p><%= comment %></p>
			</div>
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