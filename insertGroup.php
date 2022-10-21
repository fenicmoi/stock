<?php   
include("library/database.php");
if(isset($_POST['gnumber'])){

    $gname = $_POST['gname'];
    $gnumber = $_POST['gnumber'];
    $gstatus = $_POST['gstatus'];

    $sql = "INSERT INTO st_group (gnumber, gname, gstatus) VALUES ($gnumber, '$gname', $gstatus)";
    $result = dbQuery($sql);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}

?>