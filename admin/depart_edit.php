<?php
/*if(!isset($_SESSION['ses_u_id'])){
    header("location:../index.php");
}*/
include 'header.php';
$u_id = $_SESSION['ses_u_id'];

if (isset($_GET['edit'])) {  //เปลี่ยนปุ่ม
    $sql = 'SELECT * FROM depart WHERE dep_id='.$_GET['edit'];    //กรณี admin แก้ไข
    $result = dbQuery($sql);
    $getROW = dbFetchArray($result);
} elseif (isset($_GET['dep_id'])) {
    $sql = 'SELECT * FROM depart WHERE dep_id='.$_GET['dep_id'];  //กรณี user ระดับ 3 แก้ไข
    $result = dbQuery($sql);
    $getROW = dbFetchArray($result);
}
?>
    <div class="row">
        <div class="col-md-2" >
            <?php
                $menu = checkMenu($level_id);
                include $menu;
            ?>
        </div>
        <div class="col-md-10">
            <div class="panel panel-default" style="margin: 20">
                <div class="panel-heading"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i>  <strong>แก้ไขข้อมูลส่วนราชการ</strong></div>
                <p></p>
                <div class="panel-body">
                    <form class="alert-info" method="post" style="width:800px;margin: auto;">
                        <div class="form-group form-inline">
                            <div class="input-group">
                                <label for="status"><i class="fa fa-cog"></i>สถานะการใช้งาน</label>
                                <?php
                                 $status = $getROW['status'];
                                    if ($status == 1) {
                                        echo "<input class='radio' type=\"radio\" id=\"status\" name=\"status\" value=\"1\" checked>ใช้งาน ";
                                        echo "<input class='radio' type=\"radio\" id=\"status\" name=\"status\" value=\"0\" >ระงับการใช้งาน";
                                    } else {
                                        echo "<input class='radio' type=\"radio\" id=\"status\" name=\"status\" value=\"1\">ใช้งาน ";
                                        echo "<input class='radio' type=\"radio\" id=\"status\" name=\"status\" value=\"0\" checked>ระงับการใช้งาน";
                                    }

                                ?>
                                <br>
                                <label for="local_num"><i class="fa fa-cog"></i>การออกเลขหนังสือภายใน</label>
                                <?php

                                    $local_num = $getROW['local_num'];
                                    if ($local_num == 1) {
                                        echo "<input class='radio' type=\"radio\" id=\"local_num\" name=\"local_num\" value=\"1\" checked>ใช้งาน ";
                                        echo "<input class='radio' type=\"radio\" id=\"local_num\" name=\"local_num\" value=\"0\" >ระงับการใช้งาน";
                                    } else {
                                        echo "<input class='radio' type=\"radio\" id=\"local_num\" name=\"local_num\" value=\"1\" >ใช้งาน ";
                                        echo "<input class='radio' type=\"radio\" id=\"local_num\" name=\"local_num\" value=\"0\" checked>ระงับการใช้งาน";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                            <span class="input-group-addon">ประเภทส่วนราชการ</span>
                                <select class="form-control" id="officeType" name="officeType" required="">
                                    <option value="" disabled selected>จำเป็นต้องระบุ</option>
                                    <?php
                                        $sql = 'SELECT * FROM office_type';
                                        $result = dbQuery($sql);
                                        while ($row = dbFetchAssoc($result)) {
                                            ?>
                                            <option value="<?php echo $row['type_id']; ?>" <?php if ($getROW['type_id'] == $row['type_id']) {
                                                echo 'selected';
                                            } ?>>
                                                <?php echo $row['type_name']; ?>
                                            </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">กระทรวง</span>
                                <select class="form-control" id="ministry" name="ministry" required="">
                                    <option value="" disabled selected>จำเป็นต้องระบุ</option>
                                    <?php
                                        $sql = 'SELECT * FROM ministry ORDER BY m_impo';
                                        $result = dbQuery($sql);
                                        while ($row = dbFetchAssoc($result)) {
                                            ?>
                                            <option value="<?php echo $row['m_id']; ?>" <?php if ($getROW['m_id'] == $row['m_id']) {
                                                echo 'selected';
                                            } ?>>
                                                <?php echo $row['m_name']; ?>
                                            </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon">ชื่อส่วนราชการ</span>
                              <input type="dep_name" class="form-control" id="dep_name" name="dep_name" value="<?php echo $getROW['dep_name']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">เลขหนังสือหน่วยงาน</span>         
                              <input type="text" class="form-control" id="prefex" name="prefex"  placeholder="เลขหนังสือหน่วยงาน" value="<?php echo $getROW['prefex']; ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="address">ที่อยู่สำนักงาน:</label>
                          <textarea class="form-control" id="address" name="address" rows="3" cols="60"><?php echo $getROW['address']; ?>
                          </textarea>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">เบอร์โทรศัพท์</span>
                                <input type="text" class="form-control" id="phone" 
                                       name="phone" onkeyup="autoTabTel(this,2)" value="<?php echo $getROW['phone']; ?>" /> 
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">เบอร์โทรสาร</span>
                                <input type="text" class="form-control" id="fax" 
                                       name="fax" onkeyup="autoTabTel(this,2)" value="<?php echo $getROW['fax']; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="input-group">
                             <span class="input-group-addon">Website</span>
                             <input type="facebook" class="form-control" id="website" 
                                    name="website" value="<?php echo $getROW['social']; ?>">
                          </div>            
                        </div>
                            <center>
                                <button class="btn btn-success" type="submit" name="update">ตกลง</button>
                                <a class="btn btn-danger" href="depart.php"  name="cancle">ยกเลิก</a>
                            </center>    


                      </form>
                </div>
              </div>
            </div>
            <!-- End Model --> 
        </div>
    </div>  
<?php
if (isset($_POST['update'])) {
                                        $type_id = $_POST['officeType'];
                                        $dep_name = $_POST['dep_name'];
                                        $address = $_POST['address'];
                                        $phone = $_POST['phone'];
                                        $fax = $_POST['fax'];
                                        $social = $_POST['website'];
                                        $status = $_POST['status'];
                                        $local_num = $_POST['local_num'];
                                        $prefex = $_POST['prefex'];
                                        $ministry = $_POST['ministry'];

                                        $sql = "UPDATE depart
                         SET type_id = $type_id,
                             dep_name ='$dep_name',
                             address ='$address',
                             phone='$phone',
                             fax='$fax',
                             social='$social',
                             status=$status,
                             local_num=$local_num,
                             prefex='$prefex',
                             m_id=$ministry
                        WHERE dep_id=".$_GET['edit'].'
                            ';
                                        //echo $sql;
                                        $result = dbQuery($sql);
                                        if (!$result) {
                                            echo "<script>
                    swal({
                        title:'มีบางอย่างผิดพลาด! กรุณาตรวจสอบ',
                        type:'error',
                        showConfirmButton:true
                        },
                        function(isConfirm){
                            if(isConfirm){
                                window.location.href='depart.php';
                            }
                        }); ";
                                        } else {
                                            echo "<script>
                swal({
                    title:'เรียบร้อย',
                    type:'success',
                    showConfirmButton:true
                    },
                    function(isConfirm){
                        if(isConfirm){
                            window.location.href='depart.php';
                        }
                    }); 
                </script>";
                                        }
                                    }
?>
    
    
<?php //include "footer.php";?>


