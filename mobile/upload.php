<?php
	require('SimpleImage.php');

	$return = array(
		'success' => false,
		'feedback' => 'Sorry, there was an unexpected error'
	);

	if($file = $_FILES['file']) {
		$filepath = '../common/images/';
		$time = time();

		move_uploaded_file($file['tmp_name'], $filepath.$time);
		$image = new SimpleImage(); 
		$image->load($filepath.$time); 
		$image->resizeToWidth(250); 
		$image->save($filepath.$time); 

		$return['img_src'] = $filepath.$time;
		$return['image_name'] = $_POST['image_name'];
		$return ['image_comments'] = $_POST['image_comments'];
		$return['feedback'] = 'Your image was uploaded successfully';
		$return['success'] = true;
	} else {
		$return['feedback'] = 'You need to upload a file';
	}
	echo json_encode($return);

?>