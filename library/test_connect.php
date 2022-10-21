<?php  
$mysqli = new mysqli("localhost", "root","hellojava","stock");  
/* check connection */
if ($mysqli->connect_errno) {  
    printf("Connect failed: %sn", $mysqli->connect_error);  
    exit();  
}  
if(!$mysqli->set_charset("utf8")) {  
    printf("Error loading character set utf8: %sn", $mysqli->error);  
    exit();  
}