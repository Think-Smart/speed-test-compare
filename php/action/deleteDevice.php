<?php
if (isset($_GET['id']))
require '../config.php';

$speedtest = new speedtest();

$speedtest->delete_device($_GET['id']);

redirect();
?>