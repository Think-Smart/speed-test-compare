<?php
require '../config.php';

header('Content-type: application/json');

$speedtest = new speedtest();

$speedtest->edit_position($_POST);

if ($speedtest->has_error()) {
	$response_array['status'] = 'error';
	$response_array['msg'] = $speedtest->error(); 
} else {
	$response_array['status'] = 'success';
}
echo json_encode($response_array);
?>