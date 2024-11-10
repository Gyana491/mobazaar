<?php

require('db.php');
$host= $_SERVER['DOCUMENT_ROOT']."/mobazaar"; 

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https://";
} else {
    $protocol = "http://";
}
$hostname = $protocol . $_SERVER['HTTP_HOST']."/mobazaar";
$domain = $protocol . $_SERVER['HTTP_HOST'];


?>