<?php
function redirect($url=false, $time = 0){
	$url = $url ? $url : $_SERVER['HTTP_REFERER'];
	
	if(!headers_sent()){
		if(!$time){
			header("Location: {$url}"); 
		}else{
			header("refresh: $time; {$url}");
		}
	}else{
		echo "<script> setTimeout(function(){ window.location = '{$url}' },". ($time*1000) . ")</script>";	
	}
}
function echoSelectOption($arr,$selected = false){
	if (is_array($arr) && !empty($arr))
		foreach ($arr as $k => $v) {
			if ($selected && $selected == $k)
				echo '<option value="' . $k . '" selected>' . $v . '</option>';
			else echo '<option value="' . $k . '">' . $v . '</option>';
		}
}
