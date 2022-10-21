


<div class="container-fluid">
<div class="row mt-2">
           <div class="col-sm-3 col-md-2">
                <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            <i class="fas fa-home"></i> หน้าหลัก 
                        </a>
                        <a href="?menu=pjProvince" class="list-group-item list-group-item-action"><i class="fas fa-angle-right"></i> โครงการจังหวัด</a>
                        <a href="?menu=userGroup" class="list-group-item list-group-item-action"><i class="fas fa-angle-right"></i> โครงการกลุ่มจังหวัด</a>
                        <a href="?menu=userList" class="list-group-item list-group-item-action"><i class="fas fa-angle-right"></i> รายการครุภัณฑ์</a>
                        <a href="paper/manual.pdf" class="list-group-item list-group-item-action" target="_blink"><i class="fas fa-book"></i> คู่มือการใช้ระบบ</a>
                        <a href="paper/manual.pdf" class="list-group-item list-group-item-action" target="_blink"><i class="fas fa-book"></i> คู่มือหมายเลขครุภัณฑ์</a>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card mt-2">
                    <div class="card-header">
                    <span class="font-weight-bold"><i class="fas fa-th"></i> โครงการงบประมาณจังหวัด</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped" id="myTable">
                                <thead class="bg-secondary text-white">
                                    <th>ID ระบบ</th>
                                    <th>ชื่อโครงการ/กิจกรรม</th>
                                    <th>งบประมาณ</th>
                                    <th>ปีงบประมาณ</th>
                                    <th>หน่วยรับผิดชอบ</th>
                                    <th>รายการครุภัณฑ์</th>
                                </thead>
                                <tbody>
                                <?php   
                                    $sql ="SELECT  p.*, u.office, y.yname FROM project  p
                                           INNER JOIN  sys_year  y   ON (p.yid = y.yid) 
                                           INNER JOIN user u ON (p.uid = u.ID)
                                           ORDER BY  p.pid DESC";
                                   // echo $sql;
                                    $result = dbQuery($sql);
                                    while ($row = dbFetchArray($result)) {?>
                                        <tr>
                                                <td><?php echo $row['pid'];?></td>
                                                <td><a href="?menu=subProject&pid=<?=$row['pid']?>" class="text-secondary"><?php echo $row['name'];?></a></td>
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
                                                <td><a href="sub_project.php?pid=<?=$row['pid']?>" class="btn btn-outline-primary btn-block btn-sm"><i class="fas fa-eye"></i> </a></td>
                                            </tr>
                                <?php } ?>
                                </tbody>
                        </table>

            </div>
            <div class="card-footer text-muted">
              
            </div>
        </div> <!-- card -->
    <?php   
        //ปีงบประมาณ
        $sql_y = "SELECT * FROM sys_year WHERE owner = 'งบจังหวัด'  ORDER BY yname DESC";
        $result_y = dbQuery($sql_y);

    ?>        

    </div>
          
</div> <!-- row -->

</div> <!-- container -->
<?php  include("footer.php");  ?>    