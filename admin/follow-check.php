
<!-- ลงรับแฟ้มงาน  สำหรับเลขา-->
<?php
include "header.php";
//ตรวจสอบปีเอกสารว่าเป็นปีปัจจุบันหรือไม่
    list($yid,$yname,$ystatus)=chkYear();  
    $yid=$yid;
    $yname=$yname;
    $ystatus=$ystatus;

$u_id=$_SESSION['ses_u_id'];
?>
<div class="row">
    <div class="col-md-2" >
        <?php
        $menu=  checkMenu($level_id);
        include $menu;
        ?>
    </div>  <!-- col-md-2 -->

    <div class="col-md-10">
        <div class="panel panel-default" style="margin: 20">
            <div class="panel-heading"><i class="fa fa-wpexplorer fa-2x" aria-hidden="true"></i>  <strong>ระบบติดตามแฟ้มเสนอลงนาม</strong>
                <a href="add_object.php" class="btn btn-primary  pull-right" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มแฟ้ม</a>
            </div> 
            <br>
            <table class="table table-bordered table-hover" id="tbHire">
            <thead class="bg-info">
                <tr>
                    <th>Sys.no</th>
                    <!-- <th>ทะเบียน</th> -->
                    <th>เรื่อง</th>
                    <th>แฟ้มเข้า</th>
                    <th>ความเร่งด่วน</th>
                    <th>เจ้าของเรื่อง
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
            <?php

                //ตรวจสอบชื่อผู้ใช้ก่อน ว่าเป็น governor หรือไม่ ถ้าใช่ sql1  ถ้าไม่ sql2
                $sql="SELECT u_id,u_name FROM user WHERE u_id=$u_id";
                $result=dbQuery($sql);
                $row=dbFetchAssoc($result);
                $u_name=$row['u_name'];
                if($u_name=='governor'){
                     $sql="SELECT f.*,u.u_id,b.sec_id,s.speed_name ,d.dep_name,b.sec_id
                      FROM fllow as f
                      INNER JOIN boss as b ON b.rec_id = f.rec_id
                      INNER JOIN user as u ON u.u_id = b.sec_id
                      INNER JOIN speed as s ON s.speed_id = f.speed_id
                      INNER JOIN depart as d ON d.dep_id = f.dep_id
                      WHERE f.status=3
                        ";
                }else{
                      $sql="SELECT f.*,u.u_id,b.sec_id,s.speed_name ,d.dep_name,b.sec_id
                      FROM fllow as f
                      INNER JOIN boss as b ON b.rec_id = f.rec_id
                      INNER JOIN user as u ON u.u_id = b.sec_id
                      INNER JOIN speed as s ON s.speed_id = f.speed_id
                      INNER JOIN depart as d ON d.dep_id = f.dep_id
                      WHERE b.sec_id = $u_id
                ";
                }
              
               // print $sql;
                $result=dbQuery($sql);
                while($row=dbFetchArray($result)){ ?>
                <tr>
                    <?php $f_id=$row['f_id'];?>
                    <td><?=$row['f_id'];?></td>
                    <td>
                        <a href="#" 
                                onClick="loadData('<?php print $f_id;?>','<?php print $u_id; ?>');" 
                                data-toggle="modal" data-target=".bs-example-modal-table">
                                <?php echo $row['title'];?> 
                        </a>
                    </td> 
                    <td>
                        <?=DateThai($row['date_current'])?>
                    </td>
                    <td>
                       <?=$row['speed_name']?>
                    </td>
                    <td>
                        <?=$row['dep_name']?>
                    </td>
                    <td>
                    <?php
                            $status=$row['status'];
                            switch ($status) {
                                case 0:
                                    echo "<button class='btn btn-default'>ยังไม่ลงรับ</button>";
                                    break;
                                case 1:
                                    echo "<button class='btn btn-info'>ลงรับแล้ว</button>";
                                    break;
                                case 2:
                                    echo "<button class='btn btn-success'>ลงนามแล้ว</button>";
                                    break;
                                case 3:
                                    echo "<button class='btn btn-primary'>ผ่านชั้นถัดไป</button>";
                                    break;
                                case 4:
                                    echo "<button class='btn btn-danger'>แก้ไข/ส่งคืน</button>";
                                    break;
                                case 5:
                                    echo "<button class='btn btn-warning'>ขอพบเจ้าของเรื่อง</button>";
                                    break;
                            }
                    ?>           
                    </td>               
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

            <!--แก้ไขข้อมูล -->
            <div id="modalAdd" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-list"></i> ติดตามแฟ้ม</h4>
                  </div>
                  <div class="modal-body">
                      <form method="post">
                          <label class="badge">วันที่ทำรายการ: <?php echo DateThai();?></label>
                        <div class="form-group">
                          <div class="input-group"> 
                              <span class="input-group-addon"><span class="glyphicon glyphicon-list"></span></span>
                              <input type="text" class="form-control" id="title" name="title"  placeholder="เรื่อง"  required="">
                          </div>
                        </div>
                        <?php 
                            $sql="SELECT * from boss WHERE status=1 ORDER BY keyman";
                            $result = dbQuery($sql);
                           // $rec_id=$row['rec_id'];
                        ?>
                        <div class="form-group">
                            <div class="input-group"> 
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list"></span></span>
                                <select class="form-control" name="rec_id" id="rec_id">
                                    <option>---เลือกผู้ลงนาม---</option>
                                    <?php 
                                    while ($row=dbFetchArray($result)) {?>
                                        <option  value="<?=$row['rec_id']?>"><?=$row['name']?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                       
                        <?php 
                        $sql="SELECT u_id,firstname,lastname,position FROM user  WHERE u_id=$u_id";
                        $result=dbQuery($sql);
                        $row=dbFetchAssoc($result);
                        ?>
                        <div class="form-group">
                            <label>ผู้เสนอ</label>
                            <div class="input-group"> 
                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                <input type="text" class="form-control" id="u_id" name="u_id" value="<?=$row['firstname']?>">
                            </div>
                        </div>     
                        <?php
                          $sql="SELECT * from speed  ORDER BY speed_id";
                          $result = dbQuery($sql);
                        ?>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list"></span></span>
                                <select class="form-control" name="speed_id" id="speed_id">
                                    <option value="">เลือกความเร่งด่วน</option>
                                    <?php 
                                        while ($row=dbFetchArray($result)) {?>
                                            <option  value="<?=$row['speed_id']?>"><?=$row['speed_name']?></option>
                                        <?}?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="datehire">กำหนดลงนามก่อนวันที่ :</label><input class="form-control" type="date" name="dateline"  id="dateline" required >
                        </div>
                         <?php 
                        $sql="SELECT * FROM section WHERE sec_id=$dep_id";
                        $result=dbQuery($sql);
                        $row=dbFetchArray($result);
                        ?>
                        <div class="form-group">
                            <div class="input-group"> 
                                <span class="input-group-addon"><span class="fa fa-user-secret"></span></span>
                                <input type="text" class="form-control" id="signer" name="signer" value="<?=$row['sec_name']?>"> 
                            </div>
                        </div>
                     
                        <?php 
                        $sql="SELECT * FROM depart WHERE dep_id=$dep_id";
                        $result=dbQuery($sql);
                        $row=dbFetchArray($result);
                        ?>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-building"></span></span>
                                <input type="text" class="form-control" id="dep_id" name="dep_id"  value="<?php print $row['dep_name'];?>" > 
                            </div>
                        </div>
                            <center>
                                <button class="btn btn-primary btn-lg" type="submit" name="save">
                                    <i class="fa fa-database fa-2x"></i> บันทึก
                                </button>
                            </center>                                                         
                      </form>
                  </div>
                  <div class="modal-footer bg-info">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Model -->   
        </div> <!-- col-md-10 -->
    </div>    <!-- end row  -->

<!--  modal แสงรายละเอียดข้อมูล -->
        <div  class="modal fade bs-example-modal-table" tabindex="-1" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-info"></i> รายละเอียด</h4>
                    </div>
                    <div class="modal-body no-padding">
                        <div id="divDataview"></div>     
                    </div> <!-- modal-body -->
                    <div class="modal-footer bg-info">
                         <button type="button" class="btn btn-danger" data-dismiss="modal">close X</button>
                    </div>
                </div>
            </div>
        </div>
<!-- จบส่วนแสดงรายละเอียดข้อมูล  -->

<?php
// ส่วนการจัดการข้อมูล
if(isset($_POST['save'])){
    $date_current=date('Y-m-d');  //วันที่บันทึก
    $dateline=$_POST['dateline'];
	$title=$_POST['title'];
	$rec_id=$_POST['rec_id'];     //ผู้ลงนาม
    $speed_id=$_POST['speed_id']; //ความเร่งด่วน

    list($yid,$yname,$ystatus)=chkYear();  
    $yid=$yid;
    $yname=$yname;
    $ystatus=$ystatus;
    
	dbQuery('BEGIN');
	$sql="INSERT INTO fllow (title,status,rec_id,dep_id,sec_id,u_id,yid,speed_id,dateline,date_current)
                VALUES('$title',0,$rec_id,$dep_id,$sec_id,$u_id,$yid,$speed_id,'$dateline','$date_current')";
   // echo $sql;
    
	$result=dbQuery($sql);
	if($result){
		dbQuery("COMMIT");
		echo "<script>
        swal({
            title:'เรียบร้อย',
            type:'success',
            showConfirmButton:true
            },
            function(isConfirm){
                if(isConfirm){
                    window.location.href='follow.php';
                }
            }); 
        </script>";
	}else{
		dbQuery("ROLLBACK");
		echo "<script>
        swal({
            title:'มีบางอย่างผิดพลาด! กรุณาตรวจสอบ',
            type:'error',
            showConfirmButton:true
            },
            function(isConfirm){
                if(isConfirm){
                    window.location.href='follow.php';
                }
            }); 
        </script>";
	}
}

if(isset($_POST['update'])){
    $result=$_POST['result'];
    $f_id=$_POST['f_id'];
    $remark=$_POST['remark'];
   // $boss=$_POST['boss']; 
	$sql = "UPDATE  fllow SET status=$result,remark='$remark' WHERE f_id=$f_id";
	$result = dbQuery($sql);
	echo "<script>
    swal({
     title:'เรียบร้อย',
     type:'success',
     showConfirmButton:true
     },
     function(isConfirm){
         if(isConfirm){
             window.location.href='follow-check.php';
         }
     }); 
   </script>";
}



?>
<script type="text/javascript">
function loadData(f_id,u_id) {
    var sdata = {
        f_id : f_id,
        u_id : u_id 
    };
$('#divDataview').load('show_follow_update.php',sdata);
}
</script>

<script type='text/javascript'>
       $('#tbHire').DataTable( {
        "order": [[ 0, "desc" ]]
    } )
</script>
