<?php    

//insert subproject
if(isset($_POST['save'])){                  // ถ้ามีการกดปุ่ม  save
    
    $pid= $_POST['pid'];                    // รหัสโครงการ
    $listname = $_POST['listname'];
    $descript = $_POST['descript'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $howto = $_POST['howto'];
    $reciveDate = $_POST['reciveDate'];
    $lawID = $_POST['lawID'];
    $age = $_POST['age'];
    $reciveOffice = $_POST['reciveOffice'];
    $status = $_POST['status'];
  
    $tid = $_POST['tnumber'];                
    $cid = $_POST['cnumber'];                  
    $gid = $_POST['gnumber'];


    if($_POST['acopy'] == 1 ){             //ถ้ามีการเลือกให้ทำซ้ำครุภัณฑ์

        if($_POST['chkPassport'] == 1){      //ตรวจสอบว่าต้องการให้สร้างรหัสทรัพย์สินด้วยหรือไม่

            $moneyID = $_POST['numStart'];     //รหัสสินทรัยพ์ที่ต้องการเริ่มต้น  (ปกติจะมี 12 หลัก)
            $numRep = $_POST['txtRep'];  //จำนวนที่ต้องการทำซ้ำ

            for ($i=0; $i < $numRep; $i++) {   //เริ่มออกเลขพัสดุตามจำนวนที่ต้องการ
  
                //ส่วนการดึงระดับพัสดุ โดยใช้วิธีการเลือกทั้งรายการในประเภทไปเลย  ในการทำงาน
                $sql_recid = "SELECT recid FROM subproject WHERE  tid = $tid AND cid = $cid AND gid = $gid"; 
                $result_recid = dbQuery($sql_recid);
                $numrow = dbNumRows($result_recid);
                
                if($numrow == 0 ){         
                    $numrow = 1;    //ถ้าไม่มีเลย  ให้  numrow = 1
                }else{
                    $numrow = $numrow + 1;      //ถ้ามี numrow +1
                }
    
    
                    //ส่วนการสร้างชุดหมายเลขครุภัณฑ์
                    $sql_gid = "SELECT gnumber FROM st_group WHERE gid = $gid";
                    $result_gid = dbQuery($sql_gid);
                    $row_gid = dbFetchArray($result_gid);
                    $gnumber = $row_gid['gnumber'];
    
    
                    //ดึงหมายเลขประเภท
                    $sql_cid = "SELECT cnumber FROM st_class WHERE cid = $cid";
                    $result_cid = dbQuery($sql_cid);
                    $row_cid =dbFetchArray($result_cid);
                    $cnumber = $row_cid['cnumber'];
    
                    //ดึงหมายเลขชนิด  
                    $sql_tid = "SELECT tnumber FROM st_typetype WHERE tid = $tid";
                    $result_tid = dbQuery($sql_tid);
                    $row_tid = dbFetchArray($result_tid);
                    $tnumber = $row_tid['tnumber'];
    
                    //ส่วนสร้างชุดหมายเลขสินทรัพย์
    
    
                    //จัดการ format
                    $recid  = strlen($numrow);    //นับจำนวนหลักของจำนวนแถว
    
                    if($recid == 1){                //0001
                        $mask = "000".$numrow;
                    }elseif($recid ==2){            //001
                        $mask = "00".$numrow;
                    }elseif($recid == 3){           //01
                        $mask = "0".$numrow;
                    }elseif($recid == 4 ){
                        $mask = $numrow;
                    }
    
                    $fedID = $cnumber."-".$tnumber."-".$mask;

                    $format = formatMoney($moneyID);       //ชุดสร้างการตัดเลข 0


                    
                    $sql_insert ="INSERT INTO subproject(
                        recid, listname, fedID, moneyID, descript, amount, price, howto, reciveDate, lawID, age, reciveOffice, status, pid, tid, cid, gid
                    ) VALUES($numrow, '$listname', '$fedID', '$format$moneyID', '$descript', '$amount', $price, '$howto', '$reciveDate', '$lawID', '$age',
                        '$reciveOffice', '$status', $pid, $tid, $cid, $gid
                    ) ";
                        $result = dbQuery($sql_insert);
                    $moneyID++;   //เพิ่มรหัสสินทรัพย์อัตโนมัติ
            }  //end for

        }else{   //ถ้าไม่มีการทำซ้ำรหัสสินทรัพย์
            $moneyID = $_POST['moneyID'];     //รับค่าจากรหัสสินทรัพย์ปกติ
            $numRep = $_POST['txtRep'];  //จำนวนที่ต้องการทำซ้ำ
            for ($i=0; $i < $numRep; $i++) { 

                //ส่วนการดึงระดับพัสดุ โดยใช้วิธีการเลือกทั้งรายการในประเภทไปเลย  ในการทำงาน
                $sql_recid = "SELECT recid FROM subproject WHERE  tid = $tid AND cid = $cid AND gid = $gid"; 
                $result_recid = dbQuery($sql_recid);
                $numrow = dbNumRows($result_recid);
                
                if($numrow == 0 ){         
                    $numrow = 1;    //ถ้าไม่มีเลย  ให้  numrow = 1
                }else{
                    $numrow = $numrow + 1;      //ถ้ามี numrow +1
                }
    
    
                    //ส่วนการสร้างชุดหมายเลขครุภัณฑ์
                    $sql_gid = "SELECT gnumber FROM st_group WHERE gid = $gid";
                    $result_gid = dbQuery($sql_gid);
                    $row_gid = dbFetchArray($result_gid);
                    $gnumber = $row_gid['gnumber'];
    
    
                    //ดึงหมายเลขประเภท
                    $sql_cid = "SELECT cnumber FROM st_class WHERE cid = $cid";
                    $result_cid = dbQuery($sql_cid);
                    $row_cid =dbFetchArray($result_cid);
                    $cnumber = $row_cid['cnumber'];
    
                    //ดึงหมายเลขชนิด  
                    $sql_tid = "SELECT tnumber FROM st_typetype WHERE tid = $tid";
                    $result_tid = dbQuery($sql_tid);
                    $row_tid = dbFetchArray($result_tid);
                    $tnumber = $row_tid['tnumber'];
    
                    //ส่วนสร้างชุดหมายเลขสินทรัพย์
    
    
                    //จัดการ format
                    $recid  = strlen($numrow);    //นับจำนวนหลักของจำนวนแถว
    
                    if($recid == 1){                //0001
                        $mask = "000".$numrow;
                    }elseif($recid ==2){            //001
                        $mask = "00".$numrow;
                    }elseif($recid == 3){           //01
                        $mask = "0".$numrow;
                    }elseif($recid == 4 ){
                        $mask = $numrow;
                    }
    
                    $fedID = $cnumber."-".$tnumber."-".$mask;
                    
                    $sql_insert ="INSERT INTO subproject(
                        recid, listname, fedID, moneyID, descript, amount, price, howto, reciveDate, lawID, age, reciveOffice, status, pid, tid, cid, gid
                    ) VALUES($numrow, '$listname', '$fedID', '$moneyID', '$descript', '$amount', $price, '$howto', '$reciveDate', '$lawID', '$age',
                        '$reciveOffice', '$status', $pid, $tid, $cid, $gid
                    ) ";

                    $result = dbQuery($sql_insert);

                   // echo "<script>alert('nocheck')</script>";
            }  //end for
        }   // end if  
    }else{     //ถ้าไม่มีการทำใดๆ  เลย
        $moneyID = $_POST['moneyID'];     //รับค่าจากรหัสสินทรัพย์ปกติ
        $sql_recid = "SELECT recid FROM subproject WHERE  tid = $tid AND cid = $cid AND gid = $gid";   //ส่วนการดึงระดับพัสดุ โดยใช้วิธีการเลือกทั้งรายการในประเภทไปเลย  ในการทำงาน
        $result_recid = dbQuery($sql_recid);
        $numrow = dbNumRows($result_recid);
            
        if($numrow == 0 ){         
            $numrow = 1;    //ถ้าไม่มีเลย  ให้  numrow = 1
        }else{
             $numrow = $numrow + 1;      //ถ้ามี numrow +1
        }

                //ส่วนการสร้างชุดหมายเลขครุภัณฑ์
                $sql_gid = "SELECT gnumber FROM st_group WHERE gid = $gid";
                $result_gid = dbQuery($sql_gid);
                $row_gid = dbFetchArray($result_gid);
                $gnumber = $row_gid['gnumber'];


                //ดึงหมายเลขประเภท
                $sql_cid = "SELECT cnumber FROM st_class WHERE cid = $cid";
                $result_cid = dbQuery($sql_cid);
                $row_cid =dbFetchArray($result_cid);
                $cnumber = $row_cid['cnumber'];

                //ดึงหมายเลขชนิด  
                $sql_tid = "SELECT tnumber FROM st_typetype WHERE tid = $tid";
                $result_tid = dbQuery($sql_tid);
                $row_tid = dbFetchArray($result_tid);
                $tnumber = $row_tid['tnumber'];

                //ส่วนสร้างชุดหมายเลขสินทรัพย์


                //จัดการ format
                $recid  = strlen($numrow);    //นับจำนวนหลักของจำนวนแถว

                if($recid == 1){                //0001
                    $mask = "000".$numrow;
                }elseif($recid ==2){            //001
                    $mask = "00".$numrow;
                }elseif($recid == 3){           //01
                    $mask = "0".$numrow;
                }elseif($recid == 4 ){
                    $mask = $numrow;
                }

                $fedID = $cnumber."-".$tnumber."-".$mask;


                
                $sql_insert ="INSERT INTO subproject(
                    recid, listname, fedID, moneyID, descript, amount, price, howto, reciveDate, lawID, age, reciveOffice, status, pid, tid, cid, gid
                ) VALUES($numrow, '$listname', '$fedID', '$moneyID', '$descript', '$amount', $price, '$howto', '$reciveDate', '$lawID', '$age',
                    '$reciveOffice', '$status', $pid, $tid, $cid, $gid
                ) ";
                $result = dbQuery($sql_insert);         
               
                

    }   //end  check acopy

        
        if($result){
            echo "<script> alert('บันทึกรายการเรียบร้อยแล้ว')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='sub_project.php'>";
        }else{
            echo "<script> alert('มีบางอย่างผิดพลาด') </script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='sub_project.php'>";
        }  //check result 
        

  
}    //check button

function formatMoney($moneyID){
    $count = strlen($moneyID);
  switch ($count) {
      case 1:
          $format = 10000000000;
          return $format;
          break;
      case 2:
          $format = 1000000000;
          return $format;
          break;
     case 3:
          $format = 100000000;
          return $format;
          break;
     case 4:
          $format = 10000000;
          return $format;
          break;   
    case 5:
          $format = 1000000;
          return $format;
          break;
    case 6:
          $format = 100000;
          return $format;
          break;
    case 7:
          $format = 10000;
          return $format;
          break;
    case 8:
          $format = 1000;
          return $format;
          break;
    case 9:
          $format = 100;
          return $format;
          break;
    case 10:
          $format = 10;
          return $format;
          break;    
    case 11:
          $format = 1;
          return $format;
          break;     
    default:
      $format = 10000000000;
      return $format;
      break;
  }

}

    //edit 
    if(isset($_POST['btnEdit'])){
         $pid = $_POST['pid'];
         $sid = $_POST['sid'];
         $listname = $_POST['listname'];
         $moneyID = $_POST['moneyID'];
         $descript = $_POST['descript'];
         $amount = $_POST['amount'];
         $price = $_POST['price'];
         $howto = $_POST['howto'];
         $reciveDate = $_POST['reciveDate'];
         $lawID = $_POST['lawID'];
         $age = $_POST['age'];
         $reciveOffice = $_POST['reciveOffice'];
         $status  = $_POST['status'];
    
         $sql = "UPDATE subproject SET  
                        listname = '$listname',
                        moneyID = '$moneyID',
                        descript = '$descript',
                        amount = '$amount',
                        price = $price,
                        howto = '$howto',
                        reciveDate = '$reciveDate',
                        lawID = '$lawID',
                        age = '$age',
                        reciveOffice = '$reciveOffice',
                 status = '$status'
                 WHERE  sid = $sid  
                ";
    
        $result  = dbQuery($sql);
    
        if($result){
            echo "<script>alert('แก้ไขข้อมูลแล้ว')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='menu=subproject&pid=$pid'>";
        }else{
            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='index.php?menu=subproject&pid=$pid'>";
        }
    
     }

?>
