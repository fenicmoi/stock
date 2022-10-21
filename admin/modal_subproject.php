
<script>
$(function () {


        $("#acopy").click(function(){                       //ถ้า ID  acopy  มีการคลิก
            if($(this).is(":checked")) {
                $("#dvTxtRep").show();                       //ให้แสดงช่องที่ต้องการทำซ้ำ
                $("#dvMoneyId").show();
            }else{
                $("#dvTxtRep").hide();
                $("#dvMoneyId").hide();
            }
        });


        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvStart").show();
                $("#dvMoneyId2").hide();
            } else {
                $("#dvStart").hide();
                $("#dvMoneyId2").show();
            }
        });



    }); 
</script>
<!-- Modal Insert -->
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

                    <!-- เลือกการสร้างชุดรหัสครุภัณฑ์-->
                    <label><kbd>สร้างหมายเลขครุภัณฑ์หลายรายการ</kbd></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="acopy" id="acopy" value="1">
                        <label class="form-check-label" for="acopy">สร้าง</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="acopy" id="acopy" value="0" checked>
                        <label class="form-check-label" for="acopy">ไม่สร้าง</label>
                    </div>

                    <div id='dvTxtRep'  style="display: none">
                        <div id="rep" class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">จำนวนหมายเลขที่ต้องการสร้าง</span>
                            </div>
                            <input type="number" id="txtRep" name="txtRep"  class="form-control col-2" >
                        </div>
                    </div>

                    <div id='dvMoneyId'  style="display: none">
                        <label for="chkPassport">
                            <input type="radio" id="chkPassport" name="chkPassport" value="1" />
                            สร้างชุดรหัสสินทรัพย์อัตโนมัติ

                            <input type="radio" id="chkPassport" name="chkPassport" value="0" checked />
                            ไม่สร้าง
                        </label>
                    </div>

                            <div id="dvStart" style="display: none">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">รหัสสินทรัพย์เริ่มต้น</span>
                                    </div>
                                    <input type="number" id="numStart" name="numStart" min="2"  class="form-control">
                                </div>
                            </div>
      
                    <div id="dvMoneyId2">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">รหัสสินทรัพย์</span>
                            </div>
                            <input type="text" id="moneyID" name="moneyID"  class="form-control" >
                        </div>
                    </div>
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
                            <span class="input-group-text" id="basic-addon1">รายละเอียด</span>
                        </div>
                        <input class="form-control" type="text" name="descript" id="descript" value='-' required>
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">จำนวน</span>
                        </div>
                        <input type="text" id="amount" name="amount"  class="form-control col-4" value="1" required>
                        
                        <div class="input-group-prepend">
                        <label>&nbsp;</label>
                            <span class="input-group-text" id="basic-addon1">ราคา/หน่วย</span>
                        </div>
                        <input type="text" id="price" name="price"  class="form-control col-4" value="0" required>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">บาท</span>
                        </div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">วิธีการได้มา</span>
                        </div>
                        <select name="howto" id="howto" class="form-control col-3" required>
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
                            <option value="ดี" selected>ดี</option>
                            <option value="ชำรุด">ชำรุด</option>
                            <option value="ไม่ปรากฎ">ไม่ปรากฎ</option>
                            <option value="ระบุไม่ได้">ระบุไม่ได้</option>
                        </select>
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



