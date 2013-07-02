<div data-role="page" id="add_photo">
	<div data-role="content">
		<h1>File Upload</h1>
		<form id="image-upload" enctype="multipart/form-data">
			<label for="file">Pick a file: </label>
				<input type="file" name="file" id="file" />
			
			<label for="image_name">Choose a name: </label>
				<input type="text" name="image_name" id="image_name" />

			<label for="image_comments">Have any comments: </label>
				<textarea name="image_comments" id="image_comments"></textarea>

			<button data-theme="a">Submit</button>
		</form>
	</div>

	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
				<li><a href="#my_photos" data-icon="home">My Photos</a></li>
				<li><a href="#search_photos" data-icon="search">Search Photos</a></li>
				<li><a href="#add_photo" data-icon="plus" class="ui-btn-active">Add Photo</a></li>
			</ul>

		</div>
	</div>
</div>