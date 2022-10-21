<?php   
include "library/database.php";


if(isset($_POST['gnumber'])){

   $gnumber = $_POST['gnumber'];


   $sql = "SELECT count(*) AS cntGroup FROM st_group WHERE gnumber= $gnumber";

   $result = dbQuery($sql);
   @$response = "<span style='color: green;'>ไม่ซ้ำ.</span>";

   if(dbNumRows($result)){
      $row = dbFetchArray($result);

      $count = $row['cntGroup'];
    
      if($count > 0){
          @$response = "<span style='color: red;'>ข้อมูลซ้ำ.</span>";
      }
   
   }
}

   echo @$response;
   die;

?>