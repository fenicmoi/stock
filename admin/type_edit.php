
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="js/jquery-3.5.1.min.js"></script>



<?php  
include("../library/database.php");
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



<form method="post">
                    <table  class="table  text-white" >
                        <tr>
                            <td>กลุ่มครุภัณฑ์</td>
                            <td>
                                <select class="select2-single"  name="gnumber" id="gnumber" required>
                                        <option id="glist">--เลือก--</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>ประเภทครุภัณฑ์</td>
                            <td>
                                <select class="select2-single"  name="cnumber" id="cnumber" required>
                                    <option id="clist">--เลือก--</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>รหัสชนิด (3หลัก)</td>
                            <td> <input type="number" name="tnumber" id="tnumber" class="form-control col-4" placeholder="ป้อนรหัสชนิด" aria-label="รหัสชนิด" required ></td>
                        </tr>
                        <tr>
                            <td>ชื่อชนิดครุภัณฑ์</td>
                            <td> <input type="text" name="tname" id="tname" class="form-control col-8" placeholder="ป้อนชื่อชนิด" aria-label="ชื่อชนิด" required  onclick="btnHide();"></td>
                        </tr>
                    </table>
               
                    <input type="hidden" name="cstatus" id="cstatus" value=1>  
                    <div id="lblWarning"></div>
                       
                    </div>
                    <div class="card-footer bg-secondary">
                            <center>
                            <button class="btn btn-success  float-center" type="submit" name="save" id="save">
                                <i class="fa fa-save"></i> บันทึก
                            </button>
                            </center>
                    </div>
                </form>

<script>
			
			$(function(){
				
				//เรียกใช้งาน Select2
				$(".select2-single").select2();
				
				//ดึงข้อมูล province จากไฟล์ get_data.php
				$.ajax({
					url:"get_data.php",
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
						url:"get_data.php",
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