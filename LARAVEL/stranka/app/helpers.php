<?php
/*

Vseobecny helper pre stranku UAMT
Autor: Martin Trocha

*/


function debug($var, $exit = false, $return_value = false){
	if($return_value){
		return print_r($var, true);
	}
	echo '<pre>'.print_r($var, true).'</pre>';
	if($exit){
		exit;
	}
}
/**
 * format time
 */
function format_time($timestamp = 0, $to_input = false){
	if( !is_numeric( $timestamp ) ){
		return false;
	}
	if($to_input){
		return date('Y-m-d', $timestamp);
	}
	return date('d.m.Y', $timestamp);
}
/**
 * return news image uri by hash name
 */
function get_news_image($news_hash = '', $hash_name = ''){
		if ($hash_name && $news_hash){
			return asset('storage/news/'.$news_hash.'/'.$hash_name);
		}
		return asset('storage/news/info.png');
}

function get_events_image($img_hash = ''){
	if ($img_hash != ''){
		return asset('storage/events/'.$img_hash);
	}
	return false;
}
/**
 * returns media file
 */
function get_media_file($hash_name = ''){
	if ($hash_name){
		return asset('storage/media/'.$hash_name);
	}
	return "xxx";
}
/**
 * create news folder if not exists
 */
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

/**
 * create news folder if not exists
 */
function documents_category_create_folder($hash_name = ''){
	if( $hash_name == '' ){
		return false;
	}
	
	$path = public_path('/storage/documents/'.$hash_name);

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

function documents_create_folder($hash_name_category = '', $hash_name = ''){
	if( $hash_name == '' || $hash_name_category == '' ){
		return false;
	}
	
	$path = public_path('/storage/documents/'.$hash_name_category.'/'.$hash_name);

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

function get_documents_file($hash_name_folder = '', $hash_file = ''){
	if ($hash_name_folder != '' && $hash_file != ''){
		return asset('storage/media/'.$hash_name_folder.'/'.$hash_file);
	}
	return false;
}


/**
 * create gallery folder if not exists
 */
function photo_gallery_create_folder($hash_name = ''){
	if( $hash_name == '' || !is_string($hash_name) ){
		return false;
	}
	
	$path = public_path('/storage/gallery/'.$hash_name);
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
/**
 * check if gallery folder exists
 */
function gallery_folder_exists($hash_name = ''){
	if( $hash_name == '' || !is_string($hash_name) ){
		return false;
	}

	$path = public_path('/storage/gallery/'.$hash_name);
	if(is_dir($path)){
		return true;
	}
	return false;
}
/**
 * returns gallery folder by hash
 */
function get_gallery_folder($hash_name = ''){
	if ($hash_name){
		return asset('storage/gallery/'.$hash_name);
	}
	return false;
}

/*
	Return photo uri from set folder and photo name
*/
function get_gallery_photo($hash_name_folder = '', $photo_hash){
	if ($hash_name_folder && $photo_hash && is_string($hash_name_folder) && is_string($photo_hash)){
		return asset('storage/gallery/'.$hash_name_folder.'/'.$photo_hash);
	}
	return false;
}
/*
	Returns photo uri from staff folder
*/
function get_profile_photo($photo_hash = ''){
	if ($photo_hash && is_string($photo_hash)){
		return asset('storage/staff/'.$photo_hash);
	}
	return false;
}

function has_permission($perm){
	if(is_string($perm) && strlen($perm) > 0){
		
	}else{
		return false;
	}
	return false;
}

function isLogged(){
	if(session()->has('user')){
		$user = session()->get('user');
		if($user['logged']){
			if($user['check'] == '' || !is_string($user['check'])){
				return false;
			}
			
			if(!is_numeric($user['id']) || $user['id'] == 0){
				return false;
			}
		
			$usr = DB::table('staff')->where('id', $user['id'])->first();
			$tmp = sha1(md5($usr->name.$usr->surname).$usr->surname);
			if($tmp == $user['check']){
				return true;
			}
			return false;
		}else{
			return false;
		}
		return false;
	}
	return false;
}

function getMonth( $date ){
	return (int)explode(".", $date)[1];
}

function getYear( $date ){
	return (int)explode(".", $date)[2];
}


