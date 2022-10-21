
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- <script src="js/jquery-3.5.1.min.js"></script> -->



<?php  

include("library/database.php");
include("library/function.php");
$sid = $_POST['sid'];

$sql = "SELECT * FROM subproject WHERE sid = $sid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);
?>

<form method="post" action="list.php">

<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">ชื่อรายการ</span>
    </div>
    <input type="text" id="listname" name="listname"  class="form-control" value="<?=$row['listname'];?>">
</div>

<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">รหัสสินทรัพย์</span>
    </div>
    <input type="text" id="moneyID" name="moneyID"  class="form-control" value="<?=$row['moneyID'];?>">
</div>

<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">รายละเอียด</span>
    </div>
    <input class="form-control" type="text" name="descript" id="descript" value='<?=$row['descript'];?>'>
</div>

<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">จำนวน</span>
    </div>
    <input type="text" id="amount" name="amount"  class="form-control col-4" value="<?=$row['amount'];?>">
    
    <div class="input-group-prepend">
    <label>&nbsp;</label>
        <span class="input-group-text" id="basic-addon1">ราคา/หน่วย</span>
    </div>
    <input type="text" id="price" name="price"  class="form-control col-4" value="<?=$row['price'];?>">
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
    <input type="date" id="reciveDate" name="reciveDate"  class="form-control col-3" value="<?=$row['reciveDate'];?>">
</div>

<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">เลขที่สัญญา</span>
    </div>
    <input type="text" id="lawID" name="lawID"  class="form-control" value="<?=$row['lawID']?>">

    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">อายุการใช้งาน</span>
    </div>
    <input type="text" id="age" name="age"  class="form-control" value="<?=$row['age'];?>">
</div>

<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">หน่วยงานที่ใช้</span>
    </div>
    <input type="text" id="reciveOffice" name="reciveOffice"  class="form-control" value='<?=$row['reciveOffice'];?>'>
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">สภาพ</span>
    </div>
    <select name="status" id="status" class="form-control col-3" required>
        <option value="0">-- เลือก --</option>
        <option value="ดี" selected>ดี</option>
        <option value="ชำรุด">ชำรุด</option>
        <option value="ระบุไม่ได้">ระบุไม่ได้</option>
    </select>
</div>

<div class="card-footer">
<center>
<input type="hidden" name="sid" id="sid" value="<?=$row['sid'];?>">
<button class="btn btn-success  float-center" type="submit" name="save" id="save">
    <i class="fa fa-save"></i> บันทึก
</button>
</center>
</div>
</form>












