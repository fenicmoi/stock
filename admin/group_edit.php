
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
         $('#sel_group').select2();
    });
</script>

<?php  
include("../library/database.php");
$cid = $_POST['cid'];
$sql = "SELECT * FROM st_class WHERE cid = $cid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);
$group_id = $row['gid'];
$cnumber = $row['cnumber'];
$cname = $row['cname'];
?>

<form  method="POST" action="manage_class.php">

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">ชื่อประเภท</span>
        </div>
        <input type="text" class="form-control col-md-2" id="cnumber" name="cnumber"  aria-label="classnumber" aria-describedby="basic-addon1" value="<?=$cnumber;?>">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">รหัสประเภท</span>
        </div>
        <input type="text" class="form-control" id="cname" name="cname"  aria-label="class name" aria-describedby="basic-addon1" value="<?=$cname;?>">
    </div>

      <div class="input-group">
            <select class="form-control sel_group" name="gid" id="gid" >
                    <option >---กลุ่ม---</option>
                <?php
                    $g_sql="SELECT * FROM  st_group ORDER BY gid  ";
                    $g_result=dbQuery($g_sql);
                    $c = 0;
                    while($g_row = dbFetchArray($g_result)){	
                            $gid = $g_row["gid"];
                            $gnumber = $g_row['gnumber'];
                            $gname = $g_row["gname"];
                            if($gid == $group_id){
                                echo "<option value='$gid' selected>$gnumber | $gname</option> ";
                            }else{
                                echo "<option value='$gid'>$gnumber | $gname</option> ";
                            }
                            ?>
                <?php 
                 } ?> 
            </select>
      </div>
      <br>
      <input type="hidden" id="cid" name="cid" value="<?=$cid;?>">
      <center><button type="submit" class="btn btn-primary" id="btnEditSave" name="btnEditSave">Save</button></center>

</form>

<?php   
    
?>