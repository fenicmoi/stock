

<?php  

include("../library/database.php");
include("../library/function.php");
$pid = $_POST['pid'];

//data from project
$sql = "SELECT * FROM project WHERE pid = $pid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);
$yid = $row['yid']; 


//ดึง พ.ศ.  ขึ้นมา
$sqlYear = "SELECT * FROM sys_year";
$resultYear = dbQuery($sqlYear);


?>

            <form method="post" action="index.php?menu=project">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ปีงบประมาณ</span>
                        </div>
                        <select class="form-control col-4" name="sel_year" id="sel_year">
                            <?php    
                                while($row_y = dbFetchArray($resultYear)){

                                    if($row_y['yid'] == $yid ){ ?>
                                        <option  id='ylist' value='<?=$row_y['yid'];?>' selected><?=$row_y['yname']?></option>
                                    <?php } else { ?>
                                        <option  id='ylist' value='<?=$row_y['yid'];?>'><?=$row_y['yname']?></option>
                                    <?php } ?>
                            <?php }?>
                        </select>

                        <div class="input-group-prepend">
                            <span class="input-group-text">วันที่บันทึก</span>
                        </div>
                        <input type="text" name="txtDate" id="txtDate" class="form-control" value="<?php echo DateThai();?>" disabled>
                    </div>  

                    <div class="form-group">            
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ชื่อโครงการ</span>
                            </div>
                            <input type="text" name="prj_name" id="prj_name" class="form-control" title="เพิ่มชื่อโครงการ" value="<?=$row['name'];?>">
                        </div>
                    </div>

                    <div class="form-group">            
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">งบประมาณ</span>
                            </div>
                            <input type="number" name="money" id="money" class="form-control" value="<?=$row['money'];?>" title="เพิ่มชื่อโครงการ">
                            <div class="input-group-prepend">
                                <span class="input-group-text">บาท</span>
                            </div>
                        </div>
                    </div>
                    <?php   
                        //ดึงชื่อหน่วยงาน
                        $sqlUser =  "SELECT * FROM user";
                        $resultUser = dbQuery($sqlUser);
                    ?>
                    <div class="form-group">            
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">หน่วยรับผิดชอบ</span>
                            </div>
                            <select class="select2-single" name="sel_office" id="sel_office">
                              <?php  
                                while($rowUser = dbFetchArray($resultUser)){

                                    if($row['uid'] == $rowUser['ID']){?>
                                        <option value="<?php echo $rowUser['ID'];?>" selected><?php echo $rowUser['office'];?></option>
                                    <?php }else{ ?>
                                            <option value="<?php echo $rowUser['ID'];?>" ><?php echo $rowUser['office'];?></option>
                                    <?php  
                                    } 
                                } 
                              ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="pid" id="pid" value="<?=$pid;?>">
                    </div>
                    </div>
                    <div class="card-footer">
                            <center>
                            <button class="btn btn-success  float-center" type="submit" name="btnEdit" id="btnEdit">
                                <i class="fa fa-save"></i> บันทึก
                            </button>
                            </center>
                    </div>
                </form>
