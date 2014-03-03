<?php
    require "flickr.inc.php";
    require "apikey.inc.php";
    
    $flickr = new Flickr($flickr_apikey, $flickr_secret);
    $url = "http://flickr.com/services/auth/?" . $flickr->getSignedParams(array("perms"=>"write"));
    
    header("Location: " . $url);
