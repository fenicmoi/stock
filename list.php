<?php   

$UserID =  $_SESSION['UserID'];
$level = $_SESSION["Userlevel"];


if($userID=''){
    echo "<script>window.location.href='index.php'</script>";
}

?>

<div class="container-fluid">
<div class="row  mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class ="card-header bg-secondary text-white">
                    <span class="font-weight-bold"><i class="fas fa-th"></i>  รายการทรัพย์สินจังหวัด</span>
                    <a href="?menu=project" class="btn btn-primary  float-right">
                        <i class="fas fa-home"></i> กลับหน้าโครงการ
                    </a>
                </div>
                
                <div class="card-body">
                   <table class="table table-striped table-bordered" id="myTable">
                       <thead class="thead-inverse">
                           <tr>
                               <th><h6>เลขที่โครงการ</h6></th>
                               <th><h6>รหัสครุภัณฑ์</h6></th>
                               <th><h6>รายการ</h6></th>
                               <th><h6>รหัสสินทรัพย์</h6></th>
                               <th><h6>รายละเอียด</h6></th>
                               <th><h6>จำนวน</h6></th>
                               <th><h6>ราคา/หน่วย</h6></th>
                               <th><h6>วิธีการได้มา</h6></th>
                               <th><h6>วันตรวจรับ</h6></th>
                               <th><h6>เลขที่สัญญา</h6></th>
                               <th><h6>อายุการใช้งาน</h6></th>
                               <th><h6>หน่วยงานใช้ทรัพย์สิน</h6></th>
                               <th><h6>สถานะ</h6></th>
                           </tr>
                           </thead>
                           <tbody> 
                                <?php   
                                    if($_SESSION["Userlevel"] =="A"){ 
                                        $sql = "SELECT * FROM subproject ORDER BY sid ASC";
                                    }else{
                                        $sql = "SELECT s.* FROM subproject s 
                                                INNER JOIN project p ON  p.pid = s.pid 
                                                INNER JOIN user u ON u.ID = p.uid  
                                                WHERE p.uid = $UserID
                                                ORDER BY sid ASC
                                           ";
                                    }
                                   
                                    $result = dbQuery($sql);
                                    $count = 1;
                                    while ($row = dbFetchArray($result)) {
                                      echo "<tr>
                                                <td>".$row['pid']."</a></td>
                                                <td>".$row['fedID']."</td>
                                                <td>".$row['listname']."</td>
                                                <td>".$row['moneyID']."</td>
                                                <td>".$row['descript']."</td>
                                                <td>".$row['amount']."</td>
                                                <td>".number_format($row['price'])."</td>
                                                <td>".$row['howto']."</td>
                                                <td>".thaiDate($row['reciveDate'])."</td>
                                                <td>".$row['lawID']."</td>
                                                <td>".$row['age']."</td>
                                                <td>".$row['reciveOffice']."</td>
                                                <td>".$row['status']."</td>"; ?>
                                            </tr>
                                <?php             
                                        $count++;
                                    }
                                ?>
                           </tbody>
                   </table>
                </div>
            </div>
        </div><!-- col-md-12 -->

    </div><!-- row  -->

        <!-- Modal Display Edit -->
        <div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="fas fa-pen"></i> แก้ไขรายละเอียดรายการ </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                         <div id="divDataview"> </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>                                  

</div> <!-- container 2 -->

<?php 
 if(isset($_POST['save'])){

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
        echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='list.php'>";
    }else{
        echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
        echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='list.php'>";
    }

    
 }

?>

<script>
    function load_edit(sid){
     console.log(sid);
	 var sdata = {
         sid : sid,
     };
	$("#divDataview").load("edit-supproject.php",sdata);
}
</script>



   
