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

function format_time($timestamp = 0, $to_input = false){
	if( !is_numeric( $timestamp ) ){
		return false;
	}
	if($to_input){
		return date('Y-m-d', $timestamp);
	}
	return date('d.m.Y', $timestamp);
}

function get_news_image($hash_name = ''){
		if ($hash_name ){
			return asset('storage/news/'.$hash_name);
		}
		return asset('storage/news/info.png');
}

function news_create_folder($hash_name = ''){
	if( $hash_name == '' ){
		return false;
	}
	
	$path = public_path('/storage/news/'.$hash_name);

	if(is_dir($path)){
		return true;
	}else{
		@mkdir($path, 0777, true);
	}

	if(is_dir($path)){
		return true;
	}
	return false;

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