<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'libs/googleAPI/src'); 

//Google API PHP Library includes
require_once 'Google/Client.php';
require_once 'Google/Service/Oauth2.php';

// Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
 $application_name = 'iia-login';
 $client_id = '150499247857-stmljcg52e86i5o2h5cinh83u3ntub38.apps.googleusercontent.com';
 $client_secret = 'VlW-J6ehMpS37eELYS6vh1x0';
 $redirect_uri = 'http://vmxsabolp.fei.stuba.sk/iia_project/index.php?login';
 $developer_key = 'AIzaSyDrzJLZB984UUL9k36CLXp177GYF1rxvV0';
 
//Create Client Request to access Google API
$client = new Google_Client();
$client->setApplicationName($application_name);
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setDeveloperKey($developer_key);
//$client->addScope("https://www.googleapis.com/auth/userinfo.email");
$client->setScopes(array(
    'https://www.googleapis.com/auth/userinfo.email',
    'https://www.googleapis.com/auth/userinfo.profile',
));

//Send Client Request
$objOAuthService = new Google_Service_Oauth2($client);

//Logout
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
  $client->revokeToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect user back to page
}

//Authenticate code from Google OAuth Flow
//Add Access Token to Session
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

//Set Access Token to make Request
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
}

//Get User Data from Google Plus
if ($client->getAccessToken()) {
  $userData = $objOAuthService->userinfo->get();

  if(!empty($userData)) {
      $person = $db->getPersonByGoogle($userData["email"])[0];
      if ($person) {
          $_SESSION['user_name'] = $person->getLdap();
          if ($person->getPerson_type()==1) {
              $_SESSION['teacher_id'] = $person->getId();
          }
          else {
              $_SESSION['admin_id'] = $person->getId();
          }
          $_SESSION['access_token'] = $client->getAccessToken();
      }
      else {
          unset($_SESSION['access_token'],$_SESSION['user_name']);
          $client->revokeToken();
      }
  }
  
} else {
  $authUrl = str_replace("&", "&amp;", $client->createAuthUrl());
  print "<a class='login btn btn-danger' href='$authUrl'>Google Login</a>";
}
?>
