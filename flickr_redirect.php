<?php
    require "apikey.inc.php";
	function getSignedParams($args, $api_key, $secret) {
        $args["api_key"] = $api_key;
        ksort($args);
        $auth_sig = "";
        foreach ($args as $key => $value) {
            $auth_sig .= $key . $value;
        }
        $api_sig = md5($secret . $auth_sig);
        $args["api_sig"] = $api_sig;
        $sep = "";
        $url = "";
        foreach ($args as $key => $value) {
            $auth_sig .= $key . $value;
            $url = $url . $sep . $key . "=" . $value;
            $sep = "&";
        }
        return $url;
    }
	session_start();
    $token  = $_SESSION['flickr_token'];
    if (isset($_GET['auth_token']) && $_GET['auth_token'] == "true")
    	$_GET['auth_token'] = $token;
	$args = array_merge(array("format" => "json", "api_key" => $api_key), $_GET);
	header("Location: " . "https://api.flickr.com/services/rest/?" . getSignedParams($args, $flickr_apikey, $flickr_secret));
