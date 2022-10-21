<?php 
include "library/database.php";
//hellojava
//$id = 0;

if(isset($_POST['id'])){
   $id = $_POST['id'];

   echo "<script>console.log(".$id."</script>";

   $sql = "SELECT sid FROM subproject WHERE sid = $id ";
   $result = dbQuery($sql);
   $numrow = dbNumRows($result);

   if($numrow > 0){
     $sql = "UPDATE subproject SET del = 0  WHERE sid=$id";
     dbQuery($sql);

     echo 1;  
     exit;
   }
    echo 0;
    exit;
}else{
  echo 0;
  exit;
}

