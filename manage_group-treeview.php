<?php   
session_start();
$UserID =  $_SESSION['UserID'];

if($userID=''){
    echo "<script>window.location.href='index.php'</script>";
}

include("header.php");
include("navbar.php");
?>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!-- Bootstrap -->
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
body { background-color:#fafafa; font-family:'Open Sans';}

    .treegrid-indent {
        width: 0px;
        height: 16px;
        display: inline-block;
        position: relative;
    }

    .treegrid-expander {
        width: 0px;
        height: 16px;
        display: inline-block;
        position: relative;
        left:-17px;
        cursor: pointer;
    }
</style>
<script>

$(document).ready(function(){
   //check เลขกลุ่มซ้ำ
   $("#gnumber").keyup(function(){
      var gnumber = $(this).val().trim();

      if(gnumber != ''){
         $.ajax({
            url: 'chkGroup.php',
            type: 'post',
            data: {gnumber: gnumber},
            success: function(response){
                $('#gnumber_response').html(response);
             }
         });
      }else{
         $("#gnumber_response").html("");
      }
    });
 });

//Insert DB
$(document).ready(function(){
        $("#save").click(function(){
        
            var gnumber = $('#gnumber').val();
            var gname = $('#gname').val();
            var gstatus = $('#gstatus').val();

            if( gnumber != "" && gname != "" ){
                $.ajax({
                    url:'insertGroup.php',
                    type:'post',
                    data:{gnumber:gnumber, gname:gname, gstatus:gstatus},
                    success:function(response){
                        if(response == 1){
                            Swal.fire(
                            'Good job!',
                            'You clicked the button!',
                            'success'
                            )
                            window.location='manage_group.php';
                        }else if(response == 0) {
                            alert('no');
                        }
                    }
                });   
            }
        });
    });

</script>
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="font-weight-bold"><i class="fas fa-th-large"></i> จัดการกลุ่มครุภัณฑ์</span>
                <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#modelId">
                    <i class="fas fa-plus"></i> เพิ่มกลุ่ม
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="tree-table">
                        <thead>
                            <th>หมายเลขกลุ่ม</th>
                            <th>ชื่อกลุ่ม (GROUP)</th>
                
                        </thead>
                        <tbody>
                        <?php  
                            $sql1 = "SELECT * FROM st_group ORDER BY gid ";
                            $result = dbQuery($sql1);
                            while ($row1 = dbFetchArray($result)) {?>
                                <tr data-id ="1" data-parent="0" data-level="1">
                                    <td data-column="name"><?=$row1['gnumber'];?></td>
                                    <td><?=$row1['gname'];?></td>
                                </tr>
                            <?php  
                                $sql2 = "SELECT * FROM st_class WHERE gid = $row1[gid]";
                                $result2 = dbQuery($sql2);
                                $numrow = dbNumRows($result2);

                                if($numrow != 0){
                                    while ($row2 = dbFetchArray($result2)) {?>
                                    <tr data-id="2" data-parent="1" data-level="2">
                                        <td data-column="name"><?=$row2['cnumber'];?></td>
                                        <td><?=$row2['cname'];?></td>
                                    </tr> 

                                    <?php    
                                
                                    
                                    }  //end while
                                }   //end if
                            }  // end while
                            ?>
                        </tbody>
                   </table>
            </div>
            <div class="card-footer text-muted">
               Group เป็นกลุ่มของประเภทครุภัณฑ์ตามมาตรฐานในระบบ Federal STock Number
            </div>
        </div> <!-- card -->

        <!-- Button trigger modal -->

        
        <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>
        <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        
     
        
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
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
                            <input type="text" name="gname" id="gname" class="form-control" placeholder="ชื่อกลุ่มพัสดุ" aria-label="ชื่อกลุ่มพัสดุ">
                            <div id="gname_response" ></div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="number" name="gnumber" id="gnumber" class="form-control" placeholder="เลขประจำกลุ่ม" aria-label="ชื่อกลุ่มพัสดุ" >
                            <input type="hidden" name="gstatus" id="gstatus" value=1>
                        </div>
                        <div id="gnumber_response"></div>
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
</div> <!-- container -->
<script src="js/javascript.js"></script>

<?php  include("footer.php");  ?>    