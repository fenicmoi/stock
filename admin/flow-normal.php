
<?php
date_default_timezone_set('Asia/Bangkok');
include "header.php"; 
$u_id=$_SESSION['ses_u_id'];
?>
<script>
	$( document ).ready( function () {
		$( "#dateSearch" ).hide();
		$( "tr" ).first().hide();


		$( "#hideSearch" ).click( function () {
			$( "tr" ).first().show( 1000 );
		} );


		$( '#typeSearch' ).change( function () {
			var typeSearch = $( '#typeSearch' ).val();
			if ( typeSearch == 4 ) {
				$( "#dateSearch" ).show( 500 );
				$( "#search" ).hide( 500 );
			} else {
				$( "#dateSearch" ).hide( 500 );
				$( "#search" ).show( 500 );
			}
		} )


	} );
</script>
<?php    
   //ตรวจสอบปีเอกสารว่าเป็นปีปัจจุบันหรือไม่
    list($yid,$yname,$ystatus)=chkYear();  
    $yid=$yid;
    $yname=$yname;
    $ystatus=$ystatus;
?>
        <div class="col-md-2" >
           <?php
                $menu =  checkMenu($level_id);
                include $menu;
           ?>
        </div>
    
        <div  class="col-md-10">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>  <strong>หนังสือส่ง [ปกติ]</strong>
                    <a href="" class="btn btn-default pull-right" data-toggle="modal" data-target="#modalReserv">
                    <i class="fas fa-hand-point-up"></i> จองเลข
                     </a>
                    <a href="" class="btn btn-default btn-md pull-right" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus " aria-hidden="true"></i> ลงทะเบียนส่ง</a>
                    <button id="hideSearch" class="btn btn-default pull-right"><i class="fas fa-search"> ค้นหา</i></button>
                </div>
                 <table class="table table-bordered table-hover">
                        <thead class="bg-info">
                            	<tr bgcolor="black">
                                    <td colspan="8">
                                        <form class="form-inline" method="post" name="frmSearch" id="frmSearch">
                                            <div class="form-group">
                                                <select class="form-control" id="typeSearch" name="typeSearch">
                                                    <option value="1">เลขส่ง</option>
                                                    <option value="2" selected>ชื่อเรื่อง</option>
                                                </select>

                                                <div class="input-group">
                                                    <input class="form-control" id="search" name="search" type="text" size="80" placeholder="Keyword สั้นๆ">
                                                    <div class="input-group" id="dateSearch">
                                                        <span class="input-group-addon"><i class="fas fa-calendar-alt"></i>วันที่เริ่มต้น</span>
                                                        <input class="form-control" id="dateStart" name="dateStart" type="date">
                                                        <span class="input-group-addon"><i class="fas fa-calendar-alt"></i>วันที่สิ้นสุด</span>
                                                        <input class="form-control" id="dateEnd" name="dateEnd" type="date">
                                                    </div>
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-primary" type="submit" name="btnSearch" id="btnSearch">
                                                                <i class="fas fa-search "></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <tr>
                                <th>เลขหนังสือ</th>
                                <th>เรื่อง</th>
                                <th>ลงวันที่</th>
                                <th>แก้ไข</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($level_id < 3){
                                    $sql="SELECT * FROM  flownormal ORDER BY cid DESC";
                                }else{
                                    $sql="SELECT * FROM  flownormal WHERE u_id = $u_id ORDER BY cid DESC";
                                }
                                
                                 //ส่วนการค้นหา
                                 if(isset($_POST['btnSearch'])){
                                     @$typeSearch = $_POST[ 'typeSearch' ]; //ประเภทการค้นหา
                                     @$txt_search = $_POST[ 'search' ]; //กล่องรับข้อความ
                                    $sql="SELECT * FROM  flownormal";
                                     if ( @$typeSearch == 1 ) { //ค้นด้วยเลขเลขส่ง
                                        if($level_id <= 2){     
                                            $sql .= " WHERE rec_no LIKE '%$txt_search%' ";
                                        }else{
                                            $sql .= " WHERE rec_no LIKE '%$txt_search%'  AND m.dep_id=$dep_id  AND sec_id=$sec_id  ";
                                        }
                                    } elseif ( @$typeSearch == 2 ) { //ค้นด้วยชื่อชื่อเรื่อง
                                        if($level_id <=2){
                                            $sql .= " WHERE title LIKE '%$txt_search%' ";
                                        }else{
                                            $sql .= " WHERE title LIKE '%$txt_search%'   AND dep_id=$dep_id  AND sec_id=$sec_id ";
                                        }
                                        $sql .= "ORDER BY cid DESC";
                                    }

                                 }//isset 
                              // print $level_id;
                                //print $sql;
                                $result = page_query( $dbConn, $sql, 10 );
                                while($row = dbFetchArray($result)){?>
                                    <tr>
                                    <td><?php echo $row['prefex'];?> / <?php echo $row['rec_no']; ?></td>
                                    <td>
                                        <?php 
                                         $cid=$row['cid']; 
                                         $doctype='flow-normal';  //ใช้แยกประเภทตารางเพื่อส่งไปให้ file paper
                                         ?>
                                        <a href="#" 
                                            onClick="loadData('<?php print $cid;?>','<?php print $u_id; ?>');" 
                                            data-toggle="modal" data-target=".bs-example-modal-table">
                                             <?php echo $row['title'];?> 
                                    </a>
                                    </td>
                                    <td><?php echo thaiDate($row['dateline']); ?></td>
                                    <td>
                                                <?php 
                                                $curDate = date('Y-m-d');
                                                $dateLine = $row['dateline'];
                                                //$date_diff= DateDiff($curDate,$dateLine);
                                                $date_diff = getNumDay($dateLine,$curDate);

                                                if($date_diff <= 3){?>
                                                    <a class="btn btn-success" href="flow-normal-edit.php?u_id=<?=$u_id?>&cid=<?=$cid?>"><i  class="fas fa-edit"></i></a>
                                                <?php }else if($date_diff > 3){ ?>
                                                    <center><i  class="fas fa-lock fa-2x"></i></center>
                                                <?php } ?>   
                                    </td>
                                    </tr>
                                    <?php  }?>

                        </tbody>
                    </table>
                    <div class="panel-footer">
							<center>
								<a href="flow-normal.php" class="btn btn-primary"><i class="fas fa-home"></i> หน้าหลัก</a>
								<?php 
									page_link_border("solid","1px","gray");
									page_link_bg_color("lightblue","pink");
									page_link_font("14px");
									page_link_color("blue","red");
									page_echo_pagenums(10,true); 
								?>
							</center>
					</div>
            </div> <!-- panel -->
           
             <!-- Model -->
            <!-- เพิ่มหนังสือ -->
            <div id="modalAdd" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> ลงทะเบียนหนังสือส่งปกติ</h4>
                  </div>
                  <div class="modal-body bg-success"> 
                     <form name="form" method="post" enctype="multipart/form-data">
                        <table width="800">
                            <tr>
                                <td> 
                                    <div class="form-group form-inline">
                                        <label for="typeDoc">ประเภทหนังสือ :</label>
                                        <input class="form-control" name="typeDoc" type="radio" value="0" checked> ปกติ
                                        <input class="form-control" name="typeDoc" type="radio" value="1" disabled=""> เวียน
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="yearDoc">ปีเอกสาร : </label>
                                        <input class="form-control"  name="yearDoc" type="text" value="<?php print $yname; ?>" disabled="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <div class="form-group form-inline">
                                        <label for="currentDate">วันที่ทำรายการ :</label>
                                        <input class="form-control" type="text" name="currentDate" value="<?php print DateThai();?>" disabled="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group form-inline"> 
                                        <label for="obj_id">วัตถุประสงค์ : </label>
                                        <select name="obj_id" class="form-control" required>
                                            <?php 
                                                 //วัตถุประสงค์
                                                $sql="SELECT * FROM object ORDER BY obj_id";
                                                $result = dbQuery($sql);
                                                while ($row=dbFetchArray($result)){
                                                echo "<option  value=".$row['obj_id'].">".$row['obj_name']."</option>";
                                            }?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                $sql = "SELECT section.sec_code,user.firstname,user.sec_id  FROM section,user  WHERE user.u_id = $u_id AND user.sec_id = section.sec_id " ;
                                //print $sql;
                                $result =  dbQuery($sql);
                                $rowPrefex= dbFetchArray($result);
                                $prefex=$rowPrefex['sec_code'];
                                $firstname=$rowPrefex['firstname'];
                            ?>
                            <tr>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="prefex">เลขประจำส่วนราชการ : </label>
                                        <input type="text" class="form-control" name="prefex" id="prefex" placeholder="ตย 0017.1" required  >
                                    </div>    
                                </td>
                                <td>
                                 <div class="form-group form-inline">
                                     <label>เลขทะเบียนส่ง : <kbd>ออกโดยระบบ</kbd></label>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                //ชั้นความเร็ว
                                $sql="SELECT * FROM speed ORDER BY speed_id";
                                $result= dbQuery($sql);
                            ?>
                            <tr>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="speed">ชั้นความเร็ว : </label>
                                        <select name="speed_id" id="speed_id" class="form-control">
                                                <?php 
                                                    while ($rowSpeed=dbFetchArray($result)){
                                                        echo "<option  value=".$rowSpeed['speed_id'].">".$rowSpeed['speed_name']."</option>";
                                                    }?>
                                        </select>
                                    </div>
                                </td>
                                <?php
                                      //ชั้นความลับ
                                    $sql="SELECT * FROM secret ORDER BY sec_id";
                                    $result = dbQuery($sql);
                                ?>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="sec_id">ชั้นความลับ :</label>
                                        <select name="sec_id" id="sec_id" class="form-control">
                                                <?php
                                                    while($rowSecret=dbFetchArray($result)){
                                                        echo "<option value=".$rowSecret['sec_id'].">".$rowSecret['sec_name']."</option>";
                                                    }?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        </div>

                        <i class="badge">รายละเอียด</i>
                        <div class="well">  
                            <table width=100%>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">เรื่อง : </span>
                                                <input class="form-control" type="text" size=100  name="title" id="title" size="50" required placeholder="เรื่องหนังสือ">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">        
                                            <span class="input-group-addon">ผู้ลงนาม : </span>
                                            <input class="form-control" type="text" size=100  name="sendfrom" id="sendfrom" placeholder="ผู้ลงนาม" required>
                                            </div>
                                        </div>
                                    </td>
                                   
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon">ผู้รับ : </span>
                                            <input class="form-control" type="text" size=100   name="sendto" id="sendto"   required placeholder="ระบุผู้รับหนังสือ">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                   
                                    <td>
                                        <div class="form-group form-inline">
                                            <div class="input-group">
                                                <span class="input-group-addon">ลงวันที่ :</span>
                                                <input class="form-control" type="date" name="datepicker"  id="datepicker" required >
                                            </div>
                                       </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">อ้างถึง</span>
                                                <input class="form-control" type="text"  size="50" name="refer" id="refer" value="-" ><br>
                                            </div> 
                                        </div>   
                                     </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group">
                                                <span class="input-group-addon">สิ่งที่ส่งมาด้วย</span>
                                                <input class="form-control" type="text" size="40" name="attachment" value="-" >
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">ผู้เสนอ</span>
                                                <input class="form-control" type="text" size="30"  name="practice" value="<?=$firstname?>">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                             <span class="input-group-addon">ที่เก็บเอกสาร</span>
                                                <input class="form-control" type="text" size="30"  name="file_location" placeholder="ระบุที่เก็บเอกสาร" required>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                         </div> <!-- class well -->    
                         
                               <center>
                                    <button class="btn btn-primary btn-lg" type="submit" name="save">
                                    <i class="fa fa-floppy-o fa-2x"></i> บันทึก
                                    <input id="u_id" name="u_id" type="hidden" value="<?php echo $u_id; ?>"> 
                                    <input id="yid" name="yid" type="hidden" value="<?php echo $yid; ?>"> 
                                    </button>
                               </center>    
                     </form>
                  </div>
                  <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                  </div>
                </div>  <!-- model content -->
              </div>
            </div>
            <!-- End Model -->     
            </div>

        </div>  <!-- col-md-10 -->
    </div>  <!-- container -->
    <!--  modal แสงรายละเอียดข้อมูล -->
        <div  class="modal fade bs-example-modal-table" tabindex="-1" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-info"></i> รายละเอียด</h4>
                    </div>
                    <div class="modal-body no-padding">
                        <div id="divDataview">
                            <!-- สวนสำหรับแสดงผลรายละเอียด   อ้างอิงกับไฟล์  show_command_detail.php -->                             
                        </div>     
                    </div> <!-- modal-body -->
                    <div class="modal-footer bg-info">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                    </div>
                </div>
            </div>
        </div>
    </div>                                                 
<?php

include_once 'function.php';
error_reporting( error_reporting() & ~E_NOTICE );//ปิดการแจ้งเตือน
date_default_timezone_set('Asia/Bangkok'); //วันที่


if(isset($_POST['save'])){   //กดปุ่มบันทึกจากฟอร์มบันทึก
    //$yid=$_POST['yid'];
    $uid=$_POST['u_id'];
    $obj_id=$_POST['obj_id'];
    $typeDoc=$_POST['typeDoc'];
    $prefex=$_POST['prefex'];
    $title=$_POST['title'];
    $speed_id=$_POST['speed_id'];
    //$sec_id=$_POST['sec_id'];
    $sendfrom=$_POST['sendfrom'];
    $sendto=$_POST['sendto'];
    $refer=$_POST['refer'];
    $attachment=$_POST['attachment'];
    $practice=$_POST['practice'];
    $file_location=$_POST['file_location'];
    $dateline=$_POST['datepicker'];
    $datelout=date('Y-m-d h:i:s');
    $follow=$_POST['follow'];
    $open=$_POST['open'];
  
  
    if($ystatus==0){
        echo "<script>swal(\"ระบบจัดการปีปฏิทินมีปัญหา  ติดต่อ Admin!\") </script>";
        echo "<meta http-equiv='refresh' content='1;URL=flow-circle.php'>";
    }else{
           //ตัวเลขรันอัตโนมัติ
            $sqlRun="SELECT cid,rec_no FROM flownormal WHERE  yid=$yid  ORDER  BY cid DESC";
            $resRun=  dbQuery($sqlRun);
            $rowRun= dbFetchArray($resRun);
            $rec_no=$rowRun['rec_no'];
            $rec_no++;

        dbQuery('BEGIN');    
        $sqlInsert="INSERT INTO flownormal
                         (rec_no,u_id,obj_id,yid,typeDoc,prefex,title,speed_id,sec_id,sendfrom,sendto,refer,attachment,practice,file_location,dateline,dateout,dep_id)    
                    VALUE($rec_no,$u_id,$obj_id,$yid,'$typeDoc','$prefex','$title',$speed_id,$sec_id,'$sendfrom','$sendto','$refer','$attachment','$practice','$file_location','$dateline','$datelout',$dep_id)";
       
       //echo $sqlInsert;
       
        $result=dbQuery($sqlInsert);
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
                        window.location.href='flow-normal.php';
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
                        window.location.href='flow-normal.php';
                    }
                }); 
            </script>";
        }
        
  } 
}


if(isset($_POST['update'])){
    $cid = $_POST['cid'];
    $obj = $_POST['obj'];
    $dateout = $_POST['dateout'];
    $speed = $_POST['speed'];
    $secret = $_POST['secret'];
    $sendfrom = $_POST['sendfrom'];
    $sendto = $_POST['sendto'];
    $title = $_POST['title'];
    $refer = $_POST['refer'];
    $attachment = $_POST['attachment'];
    $practice = $_POST['practice'];
    $file_location = $_POST['file_location'];

     $sql = "UPDATE flownormal SET
                    obj_id = $obj,
                    title = '$title',
                    speed_id = $speed,
                    sendfrom = '$sendfrom',
                    sendto = '$sendto',
                    refer = '$refer',
                    attachment = '$attachment',
                    practice = '$practice',
                    file_location = '$file_location',
                    dateout = '$dateout'
            WHERE cid = $cid";
    $resUpdate = dbQuery($sql);
    if(!$resUpdate){
        echo "<script>swal(\"Good job!\", \"ไม่สำเร็จ!\", \"error\")</script>";                 
        echo "<meta http-equiv='refresh' content='1;URL=flow-normal.php'>";  
        exit;
    }else{
      echo "<script>swal(\"Good job!\", \"แก้ไขข้อมูลแล้ว!\", \"success\")</script>";                 
      echo "<meta http-equiv='refresh' content='1;URL=flow-normal.php'>";  
    }
}       
?>



<!-- Modal Reserv -->
<div id="modalReserv" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"> <i class="fas fa-plus"></i> จองเลข</h4>
      </div>
      <div class="modal-body">
         <div class="alert alert-danger"><i class="fas fa-comments" fa-2x></i>ระบุจำนวนเอกสารที่ต้องการจอง</div>
         <form name="form" method="post" enctype="multipart/form-data">

         <div class="form-group col-sm-6">
            <div class="input-group">
                <span class="input-group-addon">เลขหน่วยงาน:</span>
                <input type="prefex" class="form-control" name="prefex" max=10  placeholder="เลขหน่วยงาน">
            </div>
          </div>

          <div class="form-group col-sm-6">
            <div class="input-group">
                <span class="input-group-addon">จำนวน:</span>
                <input type="number" class="form-control" name="num" max=100  placeholder="ไม่เกิน 10 ฉบับ">
            </div>
          </div>

             <center> <button class="btn btn-success" type="submit" name="btnReserv" id="btnReserv"><i class="fas fa-save fa-2x"></i> บันทึก</button></center>
         </form>
      </div>
      <div class="modal-footer bg-primary">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--  process  Reserv -->
<?php
if(isset($_POST['btnReserv'])){

       

        $u_id = $_SESSION['ses_u_id'];
        $obj_id = 1;
        $yid = $yid;
        $typeDoc = '0';
        $title = 'จองเลข';
        $speed_id = 4;
        $sec_id= $_SESSION['ses_sec_id'];
        $sendfrom = '-';
        $sendto= '-';
        $refer = '-';
        $attachment = '-';
        $practice = $_SESSION['ses_dep_id'];
        $file_location = '-';
        $dateline = date("Y-m-d");
        $dateout = date("Y-m-d");
        $status = 2;
        $follow = 0;
        $open = 0;
        $file_upload = '-';
        $state_send = '0';
        $dep_id = $_SESSION['ses_dep_id'];

        $prefex = $_POST['prefex'];
        $num = $_POST['num'];
        $a=0;
     
        $sql = "SELECT dep_name FROM depart WHERE dep_id =$dep_id";
        $result = dbQuery($sql);
        $row = dbFetchAssoc($result);
        $dep_name = $row['dep_name'];
      
    

        while ($a < $num) {
            $sql = "SELECT max(rec_no) as rec_no FROM flownormal where yid=$yid";
            $result = dbQuery($sql);
            $row = dbFetchArray($result);
            $rec_no = $row['rec_no'];
            $rec_no = $rec_no + 1;



            $sql="INSERT INTO flownormal
            (rec_no,u_id,obj_id,yid,typeDoc,prefex,title,speed_id,sec_id,sendfrom,sendto,refer,attachment,practice,file_location,dateline,dateout,dep_id)    
            VALUE($rec_no,$u_id,$obj_id,$yid,'$typeDoc','$prefex','$title',$speed_id,$sec_id,'$sendfrom','$sendto','$refer','$attachment','$practice','$file_location','$dateline','$dateout',$dep_id)";
            $result = dbQuery($sql);
            $a++;
        }
        
        if($a == $num){
            echo "<script>
            swal({
                title:'เรียบร้อย',
                text:'!มีเวลา 3 วัน หลังวันจอง  เพื่อแก้ข้อมูลให้ถูกต้อง,
                type:'success',
                showConfirmButton:true
                },
                function(isConfirm){
                    if(isConfirm){
                        window.location.href='flow-normal.php';
                    }
                }); 
            </script>";
        }
} 
?>


<script type="text/javascript">
function loadData(cid,u_id) {
    var sdata = {
        cid : cid,
        u_id : u_id 
    };
$('#divDataview').load('show-flow-normal.php',sdata);
}
</script>
  
