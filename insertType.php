<?php   
include("library/database.php");
if(isset($_POST['cnumber'])){

   $gnumber = $_POST['gnumber'];
   $cname = $_POST['cname'];
   $cnumber = $_POST['cnumber'];
   $cstatus = $_POST['cstatus'];

    $sql = "INSERT INTO st_class(cnumber, cname, cstatus, gid) VALUES ($cnumber, '$cname', $cstatus, $gnumber)";
   
    $result = dbQuery($sql);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}

?>