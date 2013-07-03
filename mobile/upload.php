<?php
	require('SimpleImage.php');

	$response = array(
		'success' => false,
		'feedback' => 'Sorry, there was an unexpected error'
	);

	if($file = $_FILES['file']) {
		if($file['error'] > 0) {
			$response['feedback'] = 'Sorry, there was an upload error';
		} else {
			$filepath = '../common/images/';
			$time = time();

			if(move_uploaded_file($file['tmp_name'], $filepath.$time)) {
				$image = new SimpleImage(); 
				$image->load($filepath.$time); 
				$image->resizeToWidth(250); 
				$image->save($filepath.$time); 

				$response['img_src'] = $filepath.$time;
				$response['image_name'] = $_POST['image_name'];
				$response['image_comments'] = $_POST['image_comments'];
				$response['feedback'] = 'Your image was uploaded successfully';
				$response['success'] = true;
			} else {
				$response['feedback'] = 'Sorry, there was an error saving your image';
			}
		}
	} else {
		$response['feedback'] = 'You need to upload a file';
	}
	echo json_encode($response);

?>