
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- <script src="js/jquery-3.5.1.min.js"></script> -->



<?php  

include("library/database.php");
$tid = $_POST['tid'];
$sql = "SELECT * FROM st_typetype WHERE tid = $tid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);
$tid = $row['tid'];
$tnumber = $row['tnumber'];
$tname = $row['tname'];
$group_id = $row['gid'];
$class_id = $row['cid'];
?>



<form method="post" action="manage_type.php">
		
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document" style="min-width: 800px">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white"> <i class="fas fa-plus"></i> เพิ่มโครงการ
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
            <form method="post">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ปีงบประมาณ</span>
                        </div>
                        <select class="form-control col-4" name="sel_year" id="sel_year">
                        <?php    
                            while($row_y = dbFetchArray($result_y)){?>
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
                            <input type="text" name="prj_name" id="prj_name" class="form-control"  required="required" title="เพิ่มชื่อโครงการ">
                        </div>
                    </div>

                    <div class="form-group">            
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">งบประมาณ</span>
                            </div>
                            <input type="number" name="money" id="money" class="form-control" value=0 title="เพิ่มชื่อโครงการ">
                            <div class="input-group-prepend">
                                <span class="input-group-text">บาท</span>
                            </div>
                        </div>
                    </div>

                    <?php   
                        //หน่วยรับผิดชอบ
                        $sql_user = "SELECT * FROM user ORDER BY id ASC";
                        $result_user  = dbQuery($sql_user);

                    ?>
                    
                    <div class="form-group">            
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">หน่วยรับผิดชอบ</span>
                            </div>
                            <input type="text" name="sel_office" id="sel_office" class="form-control" value="-" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">เจ้าหน้าที่</span>
                            </div>
                            <input type="text" name="txtUser" id="txtUser" class="form-control" value="<?php echo $_SESSION['User']?>" disabled>
                        </div>
                    </div>
                    <div id="lblWarning"></div>
                    <div id="lblWarning2"></div>  
                    </div>
                    <div class="card-footer">
                            <center>
                            <button class="btn btn-success  float-center" type="submit" name="save" id="save">
                                <i class="fa fa-save"></i> บันทึก
                            </button>
                            </center>
                    </div>
                </form>
            </div> <!-- main body -->
        </div> <!-- modal content -->
            </div>
        </div>
                
</form>

<script>
			
			$(function(){
				
				//เรียกใช้งาน Select2
				$(".select2-single").select2({ width: "450px", dropdownCssClass: "bigdrop"});
				
				//ดึงข้อมูล province จากไฟล์ get_data.php
				$.ajax({
					url:"get_data.php",
					dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
					data:{show_province:'show_province'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
					success:function(data){
						
						//วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
						$.each(data, function( index, value ) {
							//แทรก Elements ใน id province  ด้วยคำสั่ง append
							  $("#editGroup").append("<option value='"+ value.gid +"'> " +value.gnumber + value.gname + "</option>");
						});
					}
				});
				
				
				//แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
				$("#editGroup").change(function(){

					//กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
					var province_id = $(this).val();
					
					$.ajax({
						url:"get_data.php",
						dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
						data:{province_id:province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
						success:function(data){
							
							//กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
							$("#editClass").text("");
							
							//วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
							$.each(data, function( index, value ) {
								
								//แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
								  $("#editClass").append("<option value='"+ value.cid +"'> " + value.cnumber+"."+value.cname + "</option>");
							});
						}
					});

				});
				
				//แสดงข้อมูลตำบล โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #amphur
				$("#amphur").change(function(){
					
					//กำหนดให้ ตัวแปร amphur_id มีค่าเท่ากับ ค่าของ  #amphur ที่กำลังถูกเลือกในขณะนั้น
					var amphur_id = $(this).val();
					
					$.ajax({
						url:"get_data.php",
						dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
						data:{amphur_id:amphur_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
						success:function(data){
							
							  //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
							  $("#district").text("");
							  
							//วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
							$.each(data, function( index, value ) {
								
							  //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
							  $("#district").append("<option value='" + value.id + "'> " + value.name + "</option>");
							  
							});
						}
					});
					
				});
				
				//คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #district 
				$("#district").change(function(){
					
					//นำข้อมูลรายการ จังหวัด ที่เลือก มาใส่ไว้ในตัวแปร province
					var province = $("#province option:selected").text();
					
					//นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
					var amphur = $("#amphur option:selected").text();
					
					//นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
					var district = $("#district option:selected").text();
					
					//ใช้คำสั่ง alert แสดงข้อมูลที่ได้
					alert("คุณได้เลือก :  จังหวัด : " + province + " อำเภอ : "+ amphur + "  ตำบล : " + district );
					
				});
				
				
			});
			
	</script>