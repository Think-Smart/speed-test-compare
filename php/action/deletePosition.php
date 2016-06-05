<?php
if (isset($_GET['id']))
require '../config.php';

$speedtest = new speedtest();

$speedtest->delete_position($_GET['id']);

redirect();
?>