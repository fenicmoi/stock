
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- <script src="js/jquery-3.5.1.min.js"></script> -->



<?php  

include("library/database.php");
include("library/function.php");
$pid = $_POST['pid'];

$sql = "SELECT * FROM project WHERE pid = $pid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);

$sqlYear = "SELECT * FROM sys_year ORDER BY  yname DESC";
$resultYear = dbQuery($sqlYear);

?>

            <form method="post" action="project.php">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ปีงบประมาณ</span>
                        </div>
                        <select class="form-control col-4" name="sel_year" id="sel_year">
                        <?php    
                            while($row_y = dbFetchArray($resultYear)){?>
                                <option  id='ylist' value='<?=$row_y['yid'];?>''><?=$row_y['yname']?></option>
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
                    <div class="form-group">            
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">หน่วยรับผิดชอบ</span>
                            </div>
                            <input type="text" name="sel_office" id="sel_office" class="form-control" value="<?=$row['uid'];?>">
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
