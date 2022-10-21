

<div class="container-fluid">
<?php 
//count  project province
$sql = "SELECT pid FROM project WHERE owner = 'งบจังหวัด'";
$result = dbQuery($sql);
$sumProvince = dbNumRows($result);

$sql = "SELECT pid FROM project WHERE owner = 'งบกลุ่มจังหวัด'";
$result = dbQuery($sql);
$sumGroup = dbNumRows($result);

?>

<section class='bg-light min-wh-100 mt-2'>
   <div class="container-fluse">
       <div class="row">
           <div class="col-sm-3 col-md-2">
                <div class="list-group">
                        <a href="?menu=home" class="list-group-item list-group-item-action active">
                            <i class="fas fa-home"></i> หน้าหลัก 
                        </a>
                        <a href="?menu=pjProvince" class="list-group-item list-group-item-action"><i class="fas fa-angle-right"></i> โครงการจังหวัด</a>
                        <a href="?menu=userGroup" class="list-group-item list-group-item-action"><i class="fas fa-angle-right"></i> โครงการกลุ่มจังหวัด</a>
                        <a href="?menu=userList" class="list-group-item list-group-item-action"><i class="fas fa-angle-right"></i> รายการครุภัณฑ์</a>
                        <a href="paper/manual.pdf" class="list-group-item list-group-item-action" target="_blink"><i class="fas fa-book"></i> คู่มือการใช้ระบบ</a>
                        <a href="paper/manual.pdf" class="list-group-item list-group-item-action" target="_blink"><i class="fas fa-book"></i> คู่มือหมายเลขครุภัณฑ์</a>
                </div>
            </div>
           <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">deskboard</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="img/blogger.png" class="w-100 rounded-circle">
                                    </div>
                                    <div class="col-sm mt-50">
                                        <h3>ระบบฐานข้อมูลทะเบียนทรัพย์สิน<?php echo province;?></h3>
                                        <br>
                                        <p><kbd>ข้อมูลผู้ใช้</kbd></p>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>หน่วยงาน</td>
                                                <td><?php echo $_SESSION["office"];?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm bg-success text-white">
                                        <div class="text-center p-4">
                                            <h2><?php echo $sumProvince;?></h2>
                                            <p>โครงการจังหวัด</p>
                                        </div>
                                    </div>
                                    <div class="col-sm bg-warning text-white">
                                       <div class="text-center p-4">
                                            <h2><?php echo $sumGroup;?></h2>
                                            <p>กลุ่มจังหวัด</p>
                                        </div>
                                    </div>
                                    <div class="col-sm bg-info text-white">
                                        <div class="text-center p-4">
                                            <h2><?php echo $sumProvince + $sumGroup;?></h2>
                                            <p>โครงการทั้งหมด</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php   
                        $sql = "SELECT * FROM sys_year ORDER BY yname DESC";
                        $result = dbQuery($sql);
                    ?>
                    <div class="col-sm-4">
                        <div class="card h-100">
                            <div class="card-body">
                               
                                    <div class="card">
                                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                                        <div class="card-body">
                                            <h4 class="card-title">ค้นหา</h4>
                                            <p class="card-text">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                  <label for=""></label>
                                                  <div class="form-group">
                                                    <label for=""></label>
                                                    <select class="form-control" name="yid" id="yid">
                                                        <?php   
                                                            while($row = dbFetchArray($result)){?>
                                                              <option value= "<?php echo $row['yid'];?>"><?php echo $row['yname'];?> </option> 
                                                        <?php  } ?>
                                                    </select>
                                                    <small id="helpId" class="text-muted">เลือกปีงบประมาณ</small>
                                                    <div class="form-group">
                                                      <label for=""></label>
                                                    </div>
                                                  </div>
                                                </div>
                                            </form>
                                            </p>
                                        </div>
                                    </div>
                               
                                
                            </div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
   </div>

</section>

</div>