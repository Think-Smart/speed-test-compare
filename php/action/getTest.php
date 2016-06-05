<?php
require '../config.php';

header('Content-type: application/json');

$speedtest = new speedtest();

echo json_encode($speedtest->getSpeedTest($_POST['id']));
?>