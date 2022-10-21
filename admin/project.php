<?php   
//session_start();
$UserID =  $_SESSION['UserID'];
$level = $_SESSION["Userlevel"];
if($userID=''){
    echo "<script>window.location.href='index.php'</script>";
}

?>
<script>
//feach user  ใช้ในหน้าจอ  เพิ่ม  project
$(document).ready(function(){
    
    $("#sel_office").select2({ width: "760px", dropdownCssClass: "bigdrop"});
    $.ajax({
        url: 'feachUser.php',
        type: 'json',
        data: '',
        success: function(result){
            $.each(result, function(i,item){
                $('#sel_office').append('<option value='+item['ID']+'>'+item['office']+'</option>');
            });
        }
    });
});

</script>

<div class="container-fluid">
        <div class="card mt-2">
            <div class="card-header">
                <span class="font-weight-bold"><i class="fas fa-th"></i> โครงการทั้งหมด</span>
               
                        <button type="button" class="btn btn-warning  float-right" data-toggle="modal" data-target="#modelId">
                        <i class="fas fa-plus"></i> เพิ่มโครงการ
                        </button>
                
                
    
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped" id="myTable">
                        <thead class="bg-secondary text-white">
                            <th>ID ระบบ</th>
                            <th>ชื่อโครงการ/กิจกรรม</th>
                            <th>งบประมาณ</th>
                            <th>ปีงบประมาณ</th>
                            <th>หน่วยรับผิดชอบ</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </thead>
                        <tbody>
                        <?php   
                            if ($level == "A") {
                                $sql ="SELECT  p.*, y.yname, u.office FROM project  p
                                INNER JOIN  sys_year  y   ON (p.yid = y.yid) 
                                INNER JOIN user u ON (p.uid = u.ID)
                                WHERE del = 1 
                                ORDER BY  pid DESC";
                            }
                             elseif($level == "M"){
                                $sql ="SELECT  p.*, y.yname, u.office FROM project  p
                                INNER JOIN  sys_year  y   ON (p.yid = y.yid) 
                                INNER JOIN user u ON (p.uid = u.ID)
                                WHERE del = 1 AND  uid = ".$_SESSION["UserID"]."
                                ORDER BY  pid DESC";
                            }
                          
                            $result = dbQuery($sql);
                            while ($row = dbFetchArray($result)) {?>
                                <tr>
                                         <td><?php echo $row['pid'];?></td>
                                         <td><a href="?menu=subproject&pid=<?=$row['pid']?>" class="text-secondary"><?php echo $row['name'];?></a></td>
                                         <td>
                                            <?php 
                                                if($row['money']==0){
                                                    echo "ไม่ระบุ";
                                                }else{
                                                  echo  number_format($row['money']);   
                                                }
                                                
                                            ?>
                                        </td>
                                         <td><?php echo $row['yname'];?></td>
                                         <td><?php echo $row['office'];?></td>
                                         <td>
                                            <a class="btn btn-outline-warning btn-sm btn-block" 
                                                onclick = "load_edit('<?=$row['pid']?>')" 
                                                data-toggle="modal" 
                                                data-target="#modelEdit">
                                                <i class="fas fa-pencil-alt"></i> 
                                            </a>  
                                         </td>
                                         <td>
                                            <?php 
                                                if($level == "M"){?>
                                                <i class="fas fa-lock"></i>
                                               <?php }else{ ?>
                                                <span class='delete btn btn-danger btn-sm text-white' data-id='<?php echo $row['pid']; ?>'><i class="fas fa-trash"></i></span>
                                               <?php }
                                            ?>
                                        </td>
                                     </tr>
                           <?php } ?>
                        </tbody>
                   </table>

            </div>
            <div class="card-footer text-muted">
              
            </div>
        </div> <!-- card -->
<?php   
        //ปีงบประมาณ  เพื่อใช้ใน modal  ต่าง ๆ
        $sql_y = "SELECT * FROM sys_year  ORDER BY yname DESC";
        $result_y = dbQuery($sql_y);

        include("modal_project.php")   //รวบรวม modal  เกี่ยวกับการจัดการ project 
?>        
</div> <!-- end container -->

<?php include("project_managment.php");?>    

<script>
function load_edit(pid){
	 var sdata = {
         pid : pid,
     };
	$("#divDataview").load("admin/edit-project.php",sdata);
}
</script>
<script src="js/delete-project.js"></script>
  