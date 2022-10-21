<?php 
session_start();
// if  login and logout  
if(isset($_SESSION['UserID'])){ 
    include("menu_admin.php");
}else{
    include("menu_nonadmin.php");
}
?>
