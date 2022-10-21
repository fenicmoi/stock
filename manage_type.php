<?php   

$UserID =  $_SESSION['UserID'];

if($userID=''){
    echo "<script>window.location.href='index.php'</script>";
}

?>
<!-- select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>


    //check Classซ้ำ
$(document).ready(function(){

    // $("#tnumber").keyup(function(){
    //     var tnumber = $(this).val().trim();

    //     if(gnumber != ''){
    //         $.ajax({
    //             url: 'chkType.php',
    //             type: 'post',
    //             data: {tnumber: tnumber},
    //             success: function(responseName){
    //                 $('#lblWarning').html(responseName);
    //             }
    //         });
    //     }else{
    //         $("#lblWarning").html("");
    //     }
    // });


    $("#tname").keyup(function(){
        var tname = $(this).val().trim();

        if(tname != ''){
            $.ajax({
                url: 'chkType.php',
                type: 'post',
                data: {tname: tname},
                success: function(responseName){
                    $('#lblWarning2').html(responseName);
                }
            });
        }else{
            $("#lblWarning2").html("");
        }
    });



    
});
  
</script>

<div class="container-fluid">

        
        <div class="card ">
            <div class="card-header">
                <span class="font-weight-bold"><i class="fas fa-th"></i>  รายการชนิดครุภัณฑ์</span>
                <button type="button" class="btn btn-warning  float-right" data-toggle="modal" data-target="#modelId">
                    <i class="fas fa-plus"></i> เพิ่มรายการ
                </button>
    
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped" id="myTable">
                        <thead class="bg-secondary text-white">
                            <th>รหัสชนิด</th>
                            <th>รหัสประเภท</th>
                            <th>ชื่อชนิด</th>
                            <th>ประเภท</th>
                            <th>กลุ่ม</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </thead>
                        <tbody>
                        <?php   
                            $sql ="SELECT t.*,c.cnumber,c.cname, g.gname FROM st_typetype as t INNER JOIN st_group as g ON g.gid = t.gid INNER JOIN st_class as c on c.cid = t.cid ORDER BY t.tnumber DESC";
                           
                            $result = dbQuery($sql);
                            while ($row = dbFetchArray($result)) {?>
                                <tr>
                                         <td><?php echo $row['cnumber'];?></td>
                                         <td><?php echo $row['tnumber'];?></td>
                                         <td><?php echo $row['tname'];?></td>
                                         <td><?php echo $row['cname']; ?></td>
                                         <td><?php echo $row['gname'];?></td>
                                         <?php $tid = $row['tid'];?>
                                         <td>
                                            <a class="btn btn-outline-warning btn-sm" 
                                                onclick = "load_edit('<?=$tid?>')" 
                                                data-toggle="modal" 
                                                data-target="#modelEdit">
                                                <i class="fas fa-pencil-alt"></i> 
                                            </a> 
                                         </td>
                                         <td><a class="btn btn-outline-danger btn-sm" ><i class="fas fa-trash-alt"></i></a></td>
                                     </tr>
                           <?php } ?>
                        </tbody>
                   </table>

            </div>
            <div class="card-footer text-muted">
              
            </div>
        </div> <!-- card -->
              

     <!-- Modal Insert -->
     <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document" style="min-width: 800px">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white"> <i class="fas fa-plus"></i> เพิ่มรายการ
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form method="post">
                    <table  class="table" >
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

        <!-- Modal Display Edit -->
        <div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="fas fa-pen"></i> แก้ไข </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                         <div id="divDataview"></div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</div> <!-- container -->

<?php  
    if(isset($_POST['save'])){
        $gid = $_POST['gnumber'];
        $cid = $_POST['cnumber'];
        $tnumber = $_POST['tnumber'];
        $tname = $_POST['tname'];
        $status = 1;

        $sql = "INSERT INTO st_typetype(tnumber, tname, tstatus, cid, gid) VALUES('$tnumber', '$tname', $status, $cid, $gid)";

       // print $sql;
        $result =  dbQuery($sql);
        if($result){
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='manage_class.php'>";
        }
    }

    if(isset($_POST["editSave"])){
        $tid = $_POST['tid'];
        $tstatus = $_POST['tstatus'];
        $gid = $_POST['editGroup'];
        $cid = $_POST['editClass'];
        $tnumber = $_POST['tnumber'];
        $tname = $_POST['tname'];

        $sql ="UPDATE st_typetype SET  tnumber = '$tnumber', tname = '$tname', tstatus = $tstatus, cid = $cid, gid = $gid WHERE tid = $tid";
        $result = dbQuery($sql);
       // echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='manage_class.php'>";
        
        if($result){
           /* echo "<script> 
            Swal.fire({
                title:'เรียบร้อย',
                type:'success',
                showConfirmButton:true
                },
                function(isConfirm){
                    if(isConfirm){
                        
                    }
                }); 
            </script>";
            */
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='manage_type.php'>";
        }
    }
?>


<script>

function load_edit(tid){
	 var sdata = {
         tid : tid,
     };
	$("#divDataview").load("type_edit.php",sdata);
}

</script>

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
								// console.log(value.cname)
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
						url:"get_data_php53.php",
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

<?php  include("footer.php");  ?>    