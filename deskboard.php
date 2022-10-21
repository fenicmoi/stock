<?php   
session_start();
$UserID =  $_SESSION['UserID'];

if($userID=''){
    echo "<script>window.location.href='index.php'</script>";
}

include("header.php");
include("navbar.php");

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
                                    <div class="col-sm">
                                        <h3>ระบบฐานข้อมูลทะเบียนทรัพย์สินจังหวัดพัทลุง</h3>
                                        <p>โครงการจังหวัด/โครงการกลุ่มจังหวัด</p>
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
                                            <h2><?php  echo $sumGroup;?></h2>
                                            <p>กลุ่มจังหวัด</p>
                                        </div>
                                    </div>
                                    <div class="col-sm bg-danger text-white">
                                       <div class="text-center p-4">
                                            <h2><?php  echo $sumProvince + $sumGroup;?></h2>
                                            <p>โครงการทั้งหมด</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3>กราฟแสดงผล</h3>
                                <div id="chart_div"></div>
                        </div>
                    </div>
                </div>
       </div>
   </div>

</section>
