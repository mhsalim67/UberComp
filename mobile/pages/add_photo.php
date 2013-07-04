<div data-role="page" id="add_photo">
	<div data-role="content">
		<h1>File Upload</h1>
		<form id="image-upload" enctype="multipart/form-data">
			<label for="file">Pick a file: </label>
				<input type="file" name="file" id="file" required/>
			
			<label for="image_name">Choose a name: </label>
				<input type="text" name="image_name" id="image_name" required/>

			<label for="image_comments">Have any comments: </label>
				<textarea name="image_comments" id="image_comments" required></textarea>

			<button data-theme="a" id="image_submit">Submit</button>
		</form>

		<div data-role="popup" id="location_support" data-position-to="window"
			 data-overlay-theme="a" class="ui-content">
			<a href="#" data-rel="back" data-role="button" 
				data-theme="a" data-icon="delete" data-iconpos="notext" 
				class="ui-btn-right">Close</a>
			<p>Sorry, location is either not supported on your device or you didn't allow it</p>
			<p>You won't be able to upload photos without location support</p>
		</div>

		<div data-role="popup" id="feedback" data-position-to="window"
			 data-overlay-theme="a" class="ui-content">
			<a href="#" data-rel="back" data-role="button" 
				data-theme="a" data-icon="delete" data-iconpos="notext" 
				class="ui-btn-right">Close</a>
			<p id="form_feedback"></p>
		</div>
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