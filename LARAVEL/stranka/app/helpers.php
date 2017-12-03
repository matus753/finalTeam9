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

function isLogged(){
	$user = session()->get('user');
	if($user['logged']){
		return true;
	}else{
		return false;
	}
	return false;
}