<?php   
session_start();
$UserID =  $_SESSION['UserID'];

if($userID=''){
    echo "<script>window.location.href='index.php'</script>";
}

include("header.php");
include("navbar.php");

$pid = $_GET['pid'];
$sql = "SELECT p.*, y.yname FROM project  as p
        INNER JOIN sys_year as y  ON  p.yid = y.yid  
        WHERE p.pid = $pid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);

?>
<link rel="stylesheet" href="css/styleDelrow.css">
<!-- select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?=$row['name'];?></h4>
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">เจ้าของโครงการ</span>
                            </div>
                            <input type="text"  class="form-control" value="<?=$row['uid'];?>" disabled>
                    </div>

                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-weight-bold" id="basic-addon1">ปีงบประมาณ</span>
                            </div>
                            <input type="text"  class="form-control col-1" value="<?=$row['yname'];?>" disabled>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">งบประมาณ</span>
                            </div>
                            <input type="text"  class="form-control col-1" value="<?=number_format($row['money']);?>" disabled>
                    </div>
                </div>
            </div>
        </div><!-- col-md-12 -->
    </div><!-- row  -->
</div>



<div class="container-fluid">
<div class="row  mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class ="card-header bg-secondary text-white">
                    <span class="font-weight-bold"><i class="fas fa-th"></i>  รายการทรัพย์สินโครงการ</span>
                    <a href="project.php" class="btn btn-primary  float-right">
                        <i class="fas fa-home"></i> กลับหน้าโครงการ
                    </a>
                    <button type="button" class="btn btn-warning  float-right" data-toggle="modal" data-target="#modelId">
                        <i class="fas fa-plus"></i> เพิ่มรายการ
                    </button>
                </div>
                
                <div class="card-body">
                   <table class="table table-striped table-bordered" id="myTable">
                       <thead class="thead-inverse">
                           <tr>
                               <th><h6>ที่</h6></th>
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
                               <th><i class="fas fa-edit"></i></th>
                               <th><i class="fas fa-trash"></i></th>
                           </tr>
                           </thead>
                           <tbody>
                                <?php   
                                    //เลือกรายการที่มีรหัสโครงการเดียวกันและสถานะต้องแสดง
                                    $sql = "SELECT * FROM subproject WHERE pid=$pid AND del = 1 ORDER BY sid ASC";
                                    //echo $sql;
                                    $result = dbQuery($sql);
                                    $count = 1;
                                    while ($row = dbFetchArray($result)) {
                                      echo "<tr>
                                                <td>".$count."</td>
                                                <td>".$row['fedID']."</td>
                                                <td>".$row['listname']."</td>
                                                <td>".$row['moneyID']."</td>
                                                <td>".$row['descript']."</td>
                                                <td>".$row['amount']."</td>
                                                <td>".$row['price']."</td>
                                                <td>".$row['howto']."</td>
                                                <td>".thaiDate($row['reciveDate'])."</td>
                                                <td>".$row['lawID']."</td>
                                                <td>".$row['age']."</td>
                                                <td>".$row['reciveOffice']."</td>
                                                <td>".$row['status']."</td>";?>
                                                <td>
                                                    <a  class='btn btn-outline-warning btn-sm btn-block'><i class='fas fa-pencil-alt'></i></a>    
                                                </td>
                                                <td>
                                                    <span class='delete btn btn-danger btn-sm text-white' data-id='<?php echo $row['sid']; ?>'><i class="fas fa-trash"></i></span>
                                                </td>
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
</div> <!-- container 2 -->

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-plus"></i> เพิ่มรายการครุภัณฑ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">ชื่อรายการ</span>
                        </div>
                        <input type="text" id="listname" name="listname"  class="form-control" required>
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">กลุ่มครุภัณฑ์</span>
                        </div>
                        <select class="select2-single"  name="gnumber" id="gnumber" required>
                            <option id="glist">--เลือก--</option>
                        </select> 
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">ประเภทครุภัณฑ์</span>
                        </div>
                        <select class="select2-single"  name="cnumber" id="cnumber" required>
                            <option id="clist" selected>--เลือก--</option>
                        </select> 
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">ชนิดครุภัณฑ์</span>
                        </div>
                        <select class="select2-single"  name="tnumber" id="tnumber" required>
                            <option id="tlist" selected>--เลือก--</option>
                        </select> 
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">รหัสสินทรัพย์</span>
                        </div>
                        <input type="text" id="moneyID" name="moneyID"  class="form-control" value="-">
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">รายละเอียด</span>
                        </div>
                        <input class="form-control" type="text" name="descript" id="descript" value='-' required>
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">จำนวน</span>
                        </div>
                        <input type="text" id="amount" name="amount"  class="form-control col-4" required>
                        
                        <div class="input-group-prepend">
                        <label>&nbsp;</label>
                            <span class="input-group-text" id="basic-addon1">ราคา/หน่วย</span>
                        </div>
                        <input type="text" id="price" name="price"  class="form-control col-4" required>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">บาท</span>
                        </div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">วิธีการได้มา</span>
                        </div>
                        <select name="howto" id="howto" class="form-control col-3" required>
                            <option value="0">-- เลือก --</option>
                            <option value="ประกาศเชิญชวน">ประกาศเชิญชวน</option>
                            <option value="คัดเลือก">คัดเลือก</option>
                            <option value="เฉพาะเจาะจง">เฉพาะเจาะจง</option>
                            <option value="อื่นๆ" selected>อื่นๆ</option>
                        </select>

                        <div class="input-group-prepend">
                        <label>&nbsp;</label>
                            <span class="input-group-text" id="basic-addon1">วันตรวจรับ</span>
                        </div>
                        <input type="date" id="reciveDate" name="reciveDate"  class="form-control col-3" required>
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">เลขที่สัญญา</span>
                        </div>
                        <input type="text" id="lawID" name="lawID"  class="form-control" value="-" required>

                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">อายุการใช้งาน</span>
                        </div>
                        <input type="text" id="age" name="age"  class="form-control" value="-" required>
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">หน่วยงานที่ใช้</span>
                        </div>
                        <input type="text" id="reciveOffice" name="reciveOffice"  class="form-control" value='-' required>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">สภาพ</span>
                        </div>
                        <select name="status" id="status" class="form-control col-3" required>
                            <option value="0">-- เลือก --</option>
                            <option value="ดี">ดี</option>
                            <option value="ชำรุด">ชำรุด</option>
                            <option value="ระบุไม่ได้">ระบุไม่ได้</option>
                        </select>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="acopy" id="acopy" value="0" checked>
                         ไม่ทำซ้ำ
                      </label>
                    </div>

                    <div class="form-check mb-1">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="acopy" id="acopy" value="1">
                         ทำซ้ำ  <kbd>ใช้กรณีจำนวนหลายชิ้น และแจกจ่ายไปหลายหน่วยงาน</kbd>
                      </label>
                    </div>

                    <div id="rep" class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">จำนวนที่ต้องการทำซ้ำ</span>
                        </div>
                        <input type="number" id="txtRep" name="txtRep"  class="form-control col-2" >
                    </div>

                    <input type="hidden" name="pid" id="pid" value=<?=$pid?>>
                    <input type="hidden" name="aCopy" id="aCopy">
            </div>
            <div class="card-footer">
                <center>
                    <button class="btn btn-success  float-center" type="submit" name="save" id="save">
                        <i class="fa fa-save"></i> บันทึก
                    </button>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php   
// Insert subproject   
if(isset($_POST['save'])){
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



    if($acopy == "1"){        //1 =  มีการทำซ้ำ

        for ($i=0; $i < $numRep; $i++) { 

            //ส่วนการดึงลดับพัสดุ โดยใช้วิธีการเลือกทั้งรายการในประเภทไปเลย  ในการทำงาน
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

        }  //end for

        if($result){
            echo "<script> alert('บันทึกรายการเรียบร้อยแล้ว')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='sub_project.php'>";
            
        }else{
            echo "<script> alert('มีบางอย่างผิดพลาด') </script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='sub_project.php'>";
        }
    }else{  //กรณีทำรายการเดียว

        
         //ตรวจสอบว่ามีรายการครุภัณฑ์ที่อยู่ใน group class type 
        $sql_recid = "SELECT recid FROM subproject WHERE  tid = $tid AND cid = $cid AND gid = $gid";
 
        $result_recid = dbQuery($sql_recid);
        $numrow = dbNumRows($result_recid);
        if($numrow == 0 ){
            $numrow = 1;
        }else{
            $numrow = $numrow+1;
        }

        //สร้างหมายเลขครุภัณฑ์
        //ตรวจสอบ


        

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


        
        $sql_insert ="INSERT INTO subproject(
            recid, listname, fedID, moneyID, descript, amount, price, howto, reciveDate, lawID, age, reciveOffice, status, pid, tid, cid, gid
        ) VALUES($numrow, '$listname', '$fedID', '$moneyID', '$descript', '$amount', $price, '$howto', '$reciveDate', '$lawID', '$age',
            '$reciveOffice', '$status', $pid, $tid, $cid, $gid
        ) ";
       $result = dbQuery($sql_insert);
       if($result){
            echo "<script>alert('บันทึกรายการเรียบร้อยแล้ว')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='sub_project.php'>";
        }else{
            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='sub_project.php'>";
         }
         
    }  // einf if
}  //end if 

?>
<script>

			
$(function(){
    
    //เรียกใช้งาน Select2
    $(".select2-single").select2({ width: "500px", dropdownCssClass: "bigdrop"});
    
    //ดึงข้อมูล province จากไฟล์ get_data.php
    $.ajax({
        url:"get_data_php53.php",
        dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
        data:{show_province:'show_province'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
        success:function(data){
            
            //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
            $.each(data, function( index, value ) {
                //แทรก Elements ใน id province  ด้วยคำสั่ง append
                  $("#gnumber").append("<option value='"+ value.gid +"'> " +value.gnumber + value.gname + "</option>");
            });
        }
    });
    
    
    //แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
    $("#gnumber").change(function(){

        //กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
        var province_id = $(this).val();
        
        $.ajax({
            url:"get_data_php53.php",
            dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
            data:{province_id:province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
            success:function(data){
                
                //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                $("#cnumber").text("");
                
                //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                $.each(data, function( index, value ) {
                    
                    //แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
                      $("#cnumber").append("<option value='"+ value.cid +"'> " + value.cnumber+"."+value.cname + "</option>");
                });
            }
        });

    });
    
    //แสดงข้อมูลตำบล โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #amphur
    $("#cnumber").change(function(){
        
        //กำหนดให้ ตัวแปร amphur_id มีค่าเท่ากับ ค่าของ  #amphur ที่กำลังถูกเลือกในขณะนั้น
        var amphur_id = $(this).val();
        
        $.ajax({
            url:"get_data_php53.php",
            dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
            data:{amphur_id:amphur_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
            success:function(data){
                
                  //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
                  $("#tnumber").text("");
                  
                //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                $.each(data, function( index, value ) {
                    
                  //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
                  $("#tnumber").append("<option value='" + value.tid + "'> " + value.tnumber +"."+ value.tname + "</option>");
                });
            }
        });
        
    });
    
    //คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #district 
    $("#tnumber").change(function(){

        
        // //นำข้อมูลรายการ จังหวัด ที่เลือก มาใส่ไว้ในตัวแปร province
        // var province = $("#gnumber option:selected").text();
        
        // //นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
        // var amphur = $("#cnumber option:selected").text();
        
        // //นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
        // var district = $("#tnumber option:selected").text();
        
        // //ใช้คำสั่ง alert แสดงข้อมูลที่ได้
        // alert("คุณได้เลือก :  กลุ่ม : " + gnumber + " ประเภท : "+ cnumber + "  ชนิด : " + tnumber );
        
    });
    
    
});

</script>

<script>
$(document).ready(function(){

    // Delete 
    $('.delete').click(function(){
        var el = this;

        // Delete id
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'กำลังจะลบข้อมูล?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบมันเลย!',
            cancelButtonText: 'ไม่ลบ'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'remove-subproject.php',
                    type: 'POST',
                    data: { id:id },
                    success: function(response){


                        if(response == 1){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','tomato');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                            });
                            
                        }else{
                        // alert('Invalid ID.'+id);
                        Swal.fire({
                                icon: 'error',
                                title: 'อุ๊บบ...',
                                text: 'มีบางอย่างผิดพลาด!',
                                footer: '<a href>ติดต่อ admin</a>'
                            })
                        }


                    }
                });
            }
        })
        
        if (confirmalert == true) {
            // AJAX Request
            cosole.log('hello')
        }
    });
});
</script>