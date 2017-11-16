<?php

function debug($var, $exit = false, $return_value = false){
	if($return_value){
		return print_r($var, true);
	}
	echo '<pre>'.print_r($var, true).'</pre>';
	if($exit){
		exit;
	}
}
