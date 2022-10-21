<?php   
session_start();
if(isset($_SESSION['UserID'])){
    include("header.php");
    include("navbar.php");
    include("deskboard.php");
    include("footer.php");   
}else{
    echo "<script>window.location.href='index.php'</script>";
}

?>