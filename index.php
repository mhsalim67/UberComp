<html>

	<head>

	</head>
	<body>
	
		<form action="index.php" method="POST" enctype="multipart/form-data">
			<input type="file" id="file" name="file" />
			<input type="submit" name="submit" value="Submit" />
		</form>

		<?php

			if(isset($_FILES)) {
				echo "<pre>";
				print_r($_FILES);
				echo "</pre>";
			}

			if(isset($_POST['submit'])) {
				echo "<pre>";
				print_r($_POST);
				echo "</pre>";
			}

		?>

		<?php
			phpinfo();
		?>

	</body>
</html>