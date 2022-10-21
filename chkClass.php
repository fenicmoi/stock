<?php   
include "library/database.php";

$cname = $_POST['cname'];
$cnumber = $_POST['cnumber'];
$cstatus = $_POST['cstatus'];

if($cstatus != ""){
   $sql = "SELECT count(*) AS cntClass FROM st_class WHERE cnumber= $cnumber";

   $result = dbQuery($sql);
   $responseName = "<span class='alert alert-success'><i class='fas fa-smile'></i> ไม่ซ้ำ</span>";

   if(dbNumRows($result)){
      $row = dbFetchArray($result);

      $count = $row['cntClass'];
    
      if($count > 0){
          $responseName = "<span class='alert alert-danger'><i class='fas fa-angry'></i> ข้อมูลซ้ำ!  มีรหัส $cnumber อยู่แล้ว</span>";
      }
   
   }
   echo @$responseName;
   die;
}

   

?>