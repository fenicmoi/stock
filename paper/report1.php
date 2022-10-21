<?php   
// Require composer autoload
require_once __DIR__ . '../../vendor/autoload.php';

// เพิ่ม Font ให้กับ mPDF
$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp',
    'fontdata' => $fontData + [
            'sarabun' => [ // ส่วนที่ต้องเป็น lower case ครับ
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNewItalic.ttf',
                'B' =>  'THSarabunNewBold.ttf',
                'BI' => "THSarabunNewBoldItalic.ttf",
            ]
        ],
]);

ob_start(); // Start get HTML code
include("../header.php");

$pid = $_GET['pid'];
$sql = "SELECT p.*, y.yname FROM project  as p
        INNER JOIN sys_year as y  ON  p.yid = y.yid  
        WHERE p.pid = $pid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);

?>
<link rel="stylesheet" href="css/styleDelrow.css">
<!-- select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?=$row['name'];?></h4>
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">เจ้าของโครงการ</span>
                            </div>
                            <input type="text"  class="form-control" value="<?=$row['uid'];?>" disabled>
                            <div class="input-group-prepend">
                                <span class="input-group-text">แหล่งงบประมาณ</span>
                            </div>
                            <input type="text" value="<?php echo $row['owner'];?>">
                    </div>

                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-weight-bold" id="basic-addon1">ปีงบประมาณ</span>
                            </div>
                            <input type="text"  class="form-control col-1" value="<?=$row['yname'];?>" disabled>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">งบประมาณ</span>
                            </div>
                            <input type="text"  class="form-control col-1" value="<?=number_format($row['money']);?>" disabled>
                            &nbsp;
                    </div>
                </div>
            </div>
        </div><!-- col-md-12 -->
    </div><!-- row  -->
</div>



<div class="container-fluid">
<div class="row  mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class ="card-header bg-secondary text-white">
                    <span class="font-weight-bold"><i class="fas fa-th"></i>  รายการทรัพย์สินโครงการ</span>
                </div>
                
                <div class="card-body">
                   <table class="table table-striped table-bordered" id="myTable">
                       <thead class="thead-inverse">
                           <tr>
                               <th><h6>ที่</h6></th>
                               <th><h6>รหัสครุภัณฑ์</h6></th>
                               <th><h6>รายการ</h6></th>
                               <th><h6>รหัสสินทรัพย์</h6></th>
                               <th><h6>จำนวน</h6></th>
                               <th><h6>ราคา/หน่วย</h6></th>
                               <th><h6>อายุการใช้งาน</h6></th>
                               <th><h6>หน่วยงานใช้ทรัพย์สิน</h6></th>
                               <th><h6>สถานะ</h6></th>
                           </tr>
                           </thead>
                           <tbody>
                                <?php   
                                    //เลือกรายการที่มีรหัสโครงการเดียวกันและสถานะต้องแสดง
                                    $sql = "SELECT * FROM subproject WHERE pid=$pid AND del = 1 ORDER BY sid ASC";
                                   // echo $sql;
                                    $result = dbQuery($sql);
                                    $count = 1;
                                    while ($row = dbFetchArray($result)) {
                                      echo "<tr>
                                                <td>".$count."</td>
                                                <td>".$row['fedID']."</td>
                                                <td>".$row['listname']."</td>
                                                <td>".$row['moneyID']."</td>
                                                <td>".$row['amount']."</td>
                                                <td>".$row['price']."</td>
                                                <td>".$row['lawID']."</td>
                                                <td>".$row['reciveOffice']."</td>
                                                <td>".$row['status']."</td>";?>
                                            </tr>
                                    <?php         
                                        $count++;
                                    }
                                ?>
                           </tbody>
                   </table>
                </div>
            </div>
        </div><!-- col-md-12 -->
    </div><!-- row  -->
</div> <!-- container 2 -->

<?php
$html = ob_get_contents();
$mpdf->WriteHTML($html);
$mpdf->Output("MyPDF.pdf");
ob_end_flush()
?>

ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF.pdf">คลิกที่นี้</a>