<?php   

$UserID =  $_SESSION['UserID'];

if($userID=''){
    echo "<script>window.location.href='index.php'</script>";
}
?>

<script>

//feach group
$(document).ready(function(){
    
        $("#gnumber").select2({ width: "760px", dropdownCssClass: "bigdrop"});
        $.ajax({
            url: 'feachGroup.php',
            type: 'json',
            data: '',
            success: function(result){
                $.each(result, function(i,item){
                    $('#gnumber').append('<option value='+item['gid']+'>'+item['gnumber']+'.'+item['gname']+'</option>');
                });
            }
        });
 });


    //check Classซ้ำ
$(document).ready(function(){

    $("#cnumber").keyup(function(){
        var cname = $(this).val().trim();
        var cnumber = $(this).val().trim();
        var cstatus = $(this).val();
        if(gnumber != ''){
            $.ajax({
                url: 'chkClass.php',
                type: 'post',
                data: {cnumber: cnumber, cstatus: cstatus, cname: cname},
                success: function(responseName){
                    $('#cnumber_response').html(responseName);
                }
            });
        }else{
            $("#cnumber_response").html("");
        }
    });

});


//Insert DB
$(document).ready(function(){
        $("#save").click(function(){
        
            var cnumber = $('#cnumber').val();
            var cname = $('#cname').val();
            var cstatus = $('#cstatus').val();
            var gnumber = $("#gnumber").val();

            if( cnumber != "" && cname != "" && gnumber != "" ){
                $.ajax({
                    url:'insertClass.php',
                    type:'post',
                    data:{cnumber:cnumber, cname:cname, cstatus:cstatus, gnumber: gnumber},
                    success:function(response){
                        if(response == 1){
                            //alert('');
                            location.reload();
                        }else if(response == 0) {
                            alert('โปรดระบุกลุ่ม (GROUP) ให้ถูกต้อง');
                        }else if(response == ""){
                            alert('error');
                        }
                    }
                });   
            }
        });
    });

</script>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="font-weight-bold"><i class="fas fa-th"></i>  จัดการประเภทครุภัณฑ์ (Clsss)</span>
                <button type="button" class="btn btn-warning  float-right" data-toggle="modal" data-target="#modelId">
                    <i class="fas fa-plus"></i> เพิ่มประเภท
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped" id="myTable">
                        <thead class="bg-secondary text-white">
                            <th>ID</th>
                            <th>รหัสประเภท</th>
                            <th>ชื่อประเภท</th>
                            <th>กลุ่มครุภัณฑ์</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </thead>
                        <tbody>
                        <?php   
                            $sql ="SELECT c.*,g.gname FROM st_class as c
                                   INNER JOIN st_group as g  ON g.gid = c.gid
                                   ORDER BY cid DESC";
                            $result = dbQuery($sql);
                            while ($row = dbFetchArray($result)) {?>
                                <tr>
                                         <td><?php echo $row['cid'];?></td>
                                         <td><?php echo $row['cnumber'];?></td>
                                         <td><?php echo $row['cname'];?></td>
                                         <td><?php echo $row['gname'];?></td>
                                         <?php $cid = $row['cid'];?>
                                         <td>
                                            <a class="btn btn-outline-warning btn-sm" 
                                                onclick = "load_edit('<?=$cid?>')" 
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

        <!-- Button trigger modal -->
     
        
        <!-- Modal Insert -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document" style="min-width: 800px">
            <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="cname" id="cname" class="form-control" placeholder="ป้อนชื่อประเภท" aria-label="ชื่อประเภท" required>
                            
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="number" name="cnumber" id="cnumber" class="form-control" placeholder="ป้อนรหัสประเภท" aria-label="รหัสประเภท" required >
                        </div>

                         <div class="input-group">
                            <div class="form-group">
                              <label for=""></label>
                              <select   name="gnumber" id="gnumber" required>
                                    <option>โปรดเลือกกลุ่มครุภัณฑ์ (GROUP)</option>
                              </select>
                            </div>
                         </div>   
                        <input type="hidden" name="cstatus" id="cstatus" value=1>  
                        <div id="cnumber_response"></div>
                            <center>
                                <button class="btn btn-success" type="submit" name="save" id="save">
                                    <i class="fa fa-save fa-2x"></i> บันทึก
                                </button>
                            </center>                                                         
                      
                  </div>
                  <div class="modal-footer bg-info">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                        <h5 class="modal-title">Edit </h5>
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
    if(isset($_POST["btnEditSave"])){
        $cid = $_POST['cid'];
        $cnumber = $_POST['cnumber'];
        $cname = $_POST['cname'];
        $gid = $_POST['gid'];

        $sql ="UPDATE st_class SET cnumber = $cnumber, cname = '$cname', gid = $gid WHERE cid = $cid";
        echo $sql;
        
        $result = dbQuery($sql);
        
        if($result){
            echo "<script> 
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
            
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='manage_class.php'>";
        }
        
    }
?>
<script>
function load_edit(cid){
	 var sdata = {
         cid : cid,
     };
   // var data = cid;
   // console.log(data);
	$("#divDataview").load("admin/class_edit.php",sdata);
    //$("#divDataview").load("test.html");
}
</script>

<?php  include("footer.php");  ?>    