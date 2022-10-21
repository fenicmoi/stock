<?php 
include "library/database.php";
$id = 0;

if(isset($_POST['id'])){
   $id = $_POST['id'];    //รหัสโครงการ


   //เลือกโครงการ
   $sql = "SELECT  del  FROM project WHERE pid = $id ";
   $result = dbQuery($sql);
   $numrow = dbNumRows($result);

   //ถ้ามีโครงการตรงกับไอดี
   if($numrow > 0){
     
     //แก้ subproject
     $sql = "UPDATE subproject SET del = 0 WHERE pid = $id";
     dbQuery($sql);

     $sql = "UPDATE project SET del = 0  WHERE pid=$id";
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

