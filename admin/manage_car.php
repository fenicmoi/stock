
<!-- บริหารจัดการรถยนต์ -->
<?php
include "header.php"; 
$yid=chkYearMonth();
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
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fas fa-car fa-2x"></i>  <strong>บริหารจัดการรถราชการ</strong>
                		<a href="" class="btn btn-default  pull-right" data-toggle="modal" data-target="#modalAdd">
                     		<i class="fas fa-plus"></i> เพิ่มรถราชการ
                    	</a>
						<a href="buy.php" class="btn btn-default pull-right"><i class="fas fa-home"></i> หน้าหลัก</a>
                </div>  
                <br>
                <table class="table table-bordered table-hover" id="tbHire">
                 <thead class="bg-info">
                        <tr> 
                            <th>ที่</th>
                            <th>ประเภทรถ</th>
                            <th>ยี่ห้อ</th>
                            <th>รุ่น</th>
                            <th>หมายเลขทะเบียน</th>
                            <th>สถานะ</th>
                            <th>แก้ไข</th>
                        </tr>              
                 </thead>
                 <tbody>
                 <?php
					while ( $row = dbFetchArray( $result ) ) {?>
                            <tr>
                                <td>
                                <?php
                                    if($row['hire_id']==$last_id){
                                        echo $row['rec_no']; ?>/<?php echo $row['yname'];  
                                    }else{
                                        echo $row['rec_no']; ?>/<?php echo $row['yname'];
                                    }
                                ?>
                                 </td>
                               
                                <?php 
                                    $hire_id=$row['hire_id'];
                                   // print $hire_id;
                                ?>
                                <td>
									<a href="#" onClick="loadData('<?php print $hire_id;?>','<?php print $u_id; ?>');" 
                                            data-toggle="modal" data-target=".bs-example-modal-table">
                                        <?php echo iconv_substr($row['title'],0,200,"UTF-8")."...";?> 
                                    </a>
                                </td>  
								<td><?php echo thaiDate($row['datein']); ?></td>
                               <td><?php echo number_format($row['money']); ?></td>
								<td><?php echo $row['dep_name'];?></td>
								<td><a href="report/rep-hire-item.php?hire_id=<?php print $hire_id?>" class="btn btn-info" target="_blank"><i class="fas fa-print"></i></a></td>
                                <td><a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                            </tr>
                        <?php } ?>
                 </tbody>
                </table>
				<div class="panel-footer"></div>
            </div> 
        </div> <!-- col-md-10 -->
    </div>    <!-- end row  -->

 <!--เพิ่มข้อมูล -->
 <div id="modalAdd" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> เพิ่มรถราชการ</h4>
            </div>
            <div class="modal-body">
                <form method="post">
                          <label class="badge">วันที่บันทึก: <?php echo DateThai(); ?></label>
                          <?php 
                            $sql="SELECT *FROM depart WHERE dep_id=$dep_id";
                            $result=dbQuery($sql);
                            $row=dbFetchArray($result);
                        ?>
                          <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">ประเภทรถ</span>
                                  <select class="form-control" name="car_type" id="car_type">
                                    <option>---โปรดเลือก---</option>
                                    <option>รถยนต์ 7 ที่นั่ง</option>
                                    <option>รถกระบะ 4 ประตู</option>
                                    <option>รถกระบะ 2 ประตู</option>
                                    <option>รถตู้</option>
                                    <option>รถมอเตอร์ไซต์</option>
                                    <option>รถหกล้อ</option>
                                  </select>
                                </div>
                            </div>
                         </div> 
                        
                         <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">ยี่ห้อ</span>
                                    <input type="text" name="brand" id="brand" class="form-control">
                                </div>
                         </div>
                        
                        <div class="form-group">
                            <div class="input-group"> 
                                <span class="input-group-addon">วงเงินการจ้าง</span>
                                <input type="number" class="form-control" id="money" name="money" required="">  
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="input-group"> 
                                <span class="input-group-addon">ผู้รับจ้าง</span>
                                <input type="text" class="form-control" id="employee" name="employee"  required="" > 
                            </div>
                        </div>     
                        <div class="form-group form-inline">
                            <div class="input-group">
                             <span class="input-group-addon"><label for="datehire">วันทำสัญญา :</label></span>
                            <input class="form-control" type="date" name="datehire"  id="datehire" onKeyDown="return false" required > 
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <div class="input-group">
                             <span class="input-group-addon"><label for="datehire">วันส่งงาน :</label></span>
                            <input class="form-control" type="date" name="date_submit"  id="date_submit" onKeyDown="return false" required > 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group"> 
                                <span class="input-group-addon">ผู้ลงนาม</span>
                                <input type="text" class="form-control" id="signer" name="signer"  placeholder="ผู้ลงนาม" value="ผู้ว่าราชการจังหวัด" required="" > 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">หลักประกันสัญญา</i></span>
                                <input type="number" class="form-control" id="guarantee" name="guarantee"  value="0"  required="" ;> 
                            </div>
                        </div>
                       
                       
                        
                            <center>
                                <button class="btn btn-success" type="submit" name="save">
                                    <i class="fa fa-save fa-2x"></i> บันทึก
                                </button>
                            </center>                                                         
                      
                  </div>
                  <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </form>
            </div> <!-- main body -->
        </div> <!-- modal content -->
    </div>   <!-- modal dialog -->
            <!-- End Model -->  
    

<!--  modal แสงรายละเอียดข้อมูล -->
        <div  class="modal fade bs-example-modal-table" tabindex="-1" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-info"></i> รายละเอียด</h4>
                    </div>
                    <div class="modal-body no-padding">
                        <div id="divDataview"></div>     
                    </div> <!-- modal-body -->
                    <div class="modal-footer bg-danger">
                         <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด X</button>
                    </div>
                </div>
            </div>
        </div>
<!-- จบส่วนแสดงรายละเอียดข้อมูล  -->

<?php
// ส่วนการจัดการข้อมูล
if(isset($_POST['save'])){

    $datein=date('Y-m-d');
    $title=$_POST['title'];
    $money=$_POST['money'];
    $employee=$_POST['employee'];
    $datehire=$_POST['datehire'];
    $signer=$_POST['signer'];
    $guarantee=$_POST['guarantee'];
    $date_submit=$_POST['date_submit'];
    
  
    //echo $yid[0];
    //echo "this is datein=".$datein;
    //ตัวเลขรันอัตโนมัติ
    $sql="SELECT hire_id,rec_no
          FROM hire
          WHERE yid=$yid[0]
          ORDER BY hire_id DESC
          LIMIT 1";
    //print $sql;
    //print $yid[0];
    $result=dbQuery($sql);
    $row = dbFetchAssoc($result);
    $rec_no=$row['rec_no'];

    if($rec_no==0){
       $rec_no=1;
    }else{
       $rec_no++; 
    } 
    //echo "rec_no=".$rec_no;

    
    //echo "This is $rec_no=".$rec_no;
    //dbQuery('BEGIN');
    $sql="INSERT INTO hire (rec_no,datein,title,money,employee,date_hire,signer,guarantee,date_submit,dep_id,sec_id,u_id,yid)
                VALUES($rec_no,'$datein','$title',$money,'$employee','$datehire','$signer',$guarantee,'$date_submit',$dep_id,$sec_id,$u_id,$yid[0])";
    
    
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
                    window.location.href='hire.php';
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
                    window.location.href='hire.php';
                }
            }); 
        </script>";
    }     
}
?>

<script type="text/javascript">
function loadData(hire_id,u_id) {
    var sdata = {
        hire_id : hire_id,
        u_id : u_id 
    };
$('#divDataview').load('show_hire_detail.php',sdata);
}
</script>

