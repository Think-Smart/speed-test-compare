<?php
if (isset($_GET['id']))
require '../config.php';

$speedtest = new speedtest();

$speedtest->delete_speedtest($_GET['id']);

redirect();
?>