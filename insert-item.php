<?php  
//header('Content-Type: application/json');
include("library/database.php");
 $pid= $_POST['pid'];         // รหัสโครงการ
 $acopy = $_POST['acopy'];    // ทำซ้ำหรือไม่
 $numRep = $_POST['txtRep'];  //จำนวนที่ต้องการทำซ้ำ


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
 $status = $_POST['status'];

 $tid = $_POST['tnumber'];
 $cid = $_POST['cnumber'];
 $gid = $_POST['gnumber'];

 //ตรวจสอบว่ามี  รายการครุภัณฑ์ประเภทเดียวกันอยู่หรือไม่
 $sql_recid = "SELECT recid FROM subproject WHERE  tid = $tid AND cid = $cid AND gid = $gid";
 $result_recid = dbQuery($sql_recid);
 $numrow = dbNumRows($result_recid);
 if($numrow == 0 ){         //ถ้าไม่มี  ให้นับ 1
     $numrow = 1;
 }else{
     $numrow = $numrow+1;   //ถ้ามีอยู่แล้ว +1

 }

//ดึงหมายเลขกลุ่มครุภัณฑ์
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

    //จัดการ format
 $recid  = strlen($numrow);

if($recid == 1){
    $mask = "000".$numrow;
}elseif($recid ==2){
    $mask = "00".$numrow;
}elseif($recid == 3){
    $mask = "0".$numrow;
}

$fedID = $cnumber."-".$tnumber."-".$mask;

$sql_insert ="INSERT INTO subproject(recid, listname, fedID, moneyID, descript, amount, price, howto, reciveDate, lawID, age, 
                          reciveOffice, status, pid, tid, cid, gid, del) 
              VALUES($numrow, '$listname', '$fedID', '$moneyID', '$descript', '$amount', $price, '$howto', '$reciveDate', '$lawID', '$age',
                         '$reciveOffice', '$status', $pid, $tid, $cid, $gid, 1)";
$result = dbQuery($sql_insert);
if($result){
    echo  1;
    exit;
}else{
    echo  0;
    exit;
}
?>