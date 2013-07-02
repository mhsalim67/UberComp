<?php
	require('SimpleImage.php');

	ini_set('display_errors', 1);
	$file = $_FILES['file'];
	$filepath = '../common/images/';
	$time = time();

	move_uploaded_file($file['tmp_name'], $filepath.$time);
	$image = new SimpleImage(); 
	$image->load($filepath.$time); 
	$image->resizeToWidth(250); 
	$image->save($filepath.$time); 

	$return = array(
		'img_src' => $filepath.$time,
		'image_name' => $_POST['image_name'],
		'image_comments' => $_POST['image_comments']
	);
	echo json_encode($return);

?>