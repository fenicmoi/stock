<?php   
include "library/database.php";

@$tnumber = $_POST['tnumber'];
@$tname = $_POST['tname'];


if($tnumber != ""){
   $sql = "SELECT count(*) AS cntClass FROM st_typetype WHERE tnumber= $tnumber";

   $result = dbQuery($sql);
   $responseName = "<span class='alert alert-success'><i class='fas fa-smile'></i> ไม่ซ้ำ</span>";

   if(dbNumRows($result)){
      $row = dbFetchArray($result);

      $count = $row['cntClass'];
    
      if($count > 0){
          $responseName = "<span class='alert alert-danger'><i class='fas fa-angry'></i> ข้อมูลซ้ำ!  มีรหัส $tnumber อยู่แล้ว</span>";
      }
   
   }
   echo @$responseName;
   die;
}

if($tname != ""){
    $sql = "SELECT count(*) AS cntClass FROM st_typetype WHERE tname= '$tname'";
 
    $result = dbQuery($sql);
    $responseName = "<span class='alert alert-success'><i class='fas fa-smile'></i> ไม่ซ้ำ</span>";
 
    if(dbNumRows($result)){
       $row = dbFetchArray($result);
 
       $count = $row['cntClass'];
     
       if($count > 0){
           $responseName = "<span class='alert alert-danger'><i class='fas fa-angry'></i> ข้อมูลซ้ำ!  มีชื่อรายการนี $tname อยู่แล้ว</span>";
       }
    
    }
    echo @$responseName;
    die;
 }

   

?>