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

function format_time_event($timestamp = 0){
	if( !is_numeric( $timestamp ) ){
		return false;
	}
	return date('j.n.Y', $timestamp);
}
/**
 * return news image uri by hash name
 */
function get_news_image($news_hash = '', $hash_name = ''){
	if ($hash_name && $news_hash){
		return asset('storage/news/'.$news_hash.'/'.$hash_name);
	}
	return asset('images/info.png');
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

function get_documents_file($category_hash = '', $hash_name_folder = '', $hash_file = ''){
	if ($category_hash != '' && $hash_name_folder != '' && $hash_file != ''){
		return asset('storage/documents/'.$category_hash.'/'.$hash_name_folder.'/'.$hash_file);
	}
	return false;
}



function subjects_category_create_folder($hash_name = ''){
	if( $hash_name == '' ){
		return false;
	}
	
	$path = public_path('/storage/subjects/'.$hash_name);

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


function subjects_create_folder($hash_name_category = '', $hash_name = ''){
	if( $hash_name == '' || $hash_name_category == '' ){
		return false;
	}
	
	$path = public_path('/storage/subjects/'.$hash_name_category.'/'.$hash_name);

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

function get_subjects_file($category_hash = '', $hash_name_folder = '', $hash_file = ''){
	if ($category_hash != '' && $hash_name_folder != '' && $hash_file != ''){
		return asset('storage/subjects/'.$category_hash.'/'.$hash_name_folder.'/'.$hash_file);
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
	return asset('images/default_male_img.png');
}

function has_permission($perm){
	if(is_string($perm) && strlen($perm) > 0){
		if(isLogged()){
			$user = session()->get('user');
			if(is_array($user['role']) && count($user['role']) > 0){
				if( $user['role'][0] == 'locale' ){
					return true;
				}
			}

			if(!is_array($user['role'])){
				return false;
			}

			if(in_array('admin', $user['role'])){
				return true;
			}

			if(in_array($perm, $user['role'])){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}else{
		return false;
	}
	return false;
}

function isLogged(){
	if(session()->has('user')){
		$user = session()->get('user');
		if($user['logged']){
			if(is_array($user['role']) && count($user['role']) > 0){
				if( $user['role'][0] == 'locale' ){
					return true;
				}
			}

			if($user['check'] == '' || !is_string($user['check'])){
				return false;
			}
			
			if(!is_numeric($user['id']) || $user['id'] == 0){
				return false;
			}
		
			$usr = DB::table('staff')->where('s_id', $user['id'])->first();
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

function get_user_id(){
	if(isLogged()){
		$user = session()->get('user');
		return $user['id'];
	}
	return false;
}

function getDay( $date ){
	return (int)explode(".", $date)[0];
}

function getMonth( $date ){
	return (int)explode(".", $date)[1];
}

function getYear( $date ){
	return (int)explode(".", $date)[2];
}

function storage_deletor($type = ""){
	if(!is_string($type)){
		return false;
	}

	$res = DB::table('deletor')->where('type', $type)->get();
	if(!$res){
		return true;
	}

	

	$path = base_path('storage/app/public/');
	foreach($res as $r){
		switch($type){
			case 'news':
				$check = DB::table('news')->where('hash_id', $r->path)->first();
				if($check){
					return true;
				}
				$path .= 'news/'.$r->path;
			break;
			case 'documents':
				$tmp = explode('/', $r->path);
				$check = DB::table('documents')->where('hash_name', $tmp[1])->first();
				if($check){
					return true;
				}
				$path .= 'documents/'.$r->path;
			break;
			case 'subjects':
				$tmp = explode('/', $r->path);
				$check = DB::table('subjects_subcategories')->where('hash_name', $tmp[1])->first();
				if($check){
					return true;
				}
				$path .= 'subjects/'.$r->path;
			break;
			default:
				return false;
		}
		
		if(is_dir($path)){
			array_map('unlink', glob("$path/*.*"));
			rmdir($path);
			DB::table('deletor')->where('type', $type)->where('path', $r->path)->delete();
			return true;
		}
	}
	
	return false;
}


function sendNews($_title_sk, $_content_sk, $_title_en, $_content_en){
	$mail = new PHPMailer\PHPMailer\PHPMailer();
	$mail->isSMTP();
	$mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
	$mail->SMTPAuth = true;
	$mail->Username = 'fei.uamt@gmail.com';   //username
	$mail->Password = 'Fei2018Uamt$';   //password
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;                    //SMTP port
	$mail->setFrom('fei.uamt@gmail.com', 'FEI UAMT');

	$recepients  = DB::table('newsletter')->get();
	//$header = "From: UAM FEI \r\n";
	foreach($recepients as $r){
		$email = $r->email;
		$lang_db = $r->lang;

		if($lang_db == "SK"){
			if(!empty($_title_sk) && !empty($_content_sk)){
				//mail($email, $_title_sk, $_content_sk, $header);
				$mail->addAddress($email, $email);
				$mail->isHTML(true);
				$mail->Subject = $_title_sk;
				$mail->Body    = $_content_sk;
				$mail->send();
			}
		}
		if($lang_db == "EN"){
			if(!empty($_title_en) && !empty($_content_en)){
				//mail($email, $_title_en, $_content_en, $header);
				$mail->addAddress($email, $email);
				$mail->isHTML(true);
				$mail->Subject = $_title_en;
				$mail->Body    = $_content_en;
				$mail->send();
			}
		}
	}
}