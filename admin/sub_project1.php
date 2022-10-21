<?php   

//create pdf
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
// end create pdf




$pid = $_GET['pid'];
$sql = "SELECT p.*, y.yname FROM project  as p
        INNER JOIN sys_year as y  ON  p.yid = y.yid  
        WHERE p.pid = $pid";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);

?>
<link rel="stylesheet" href="css/styleDelrow.css">


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
                    <a href="?menu=project" class="btn btn-primary  float-right">
                        <i class="fas fa-home"></i> กลับหน้าโครงการ
                    </a>
                    <a class="btn btn-info float-right" href="report1.php?pid=<?=$pid?>" target="_blank"><i class="fas fa-print"></i> พิมพ์รายงาน</a>
                    <button type="button" class="btn btn-warning  float-right" data-toggle="modal" data-target="#modelId">
                        <i class="fas fa-plus"></i> เพิ่มรายการ
                    </button>
                </div>
                
                <div class="card-body">
                   <table class="table table-striped table-bordered" id="myTable">
                       <thead class="thead-inverse">
                           <tr>
                               <th><h6>ที่</h6></th>
                               <th><h6>รหัสครุภัณฑ์</h6></th>
                               <th><h6>รายการ</h6></th>
                               <th><h6>รหัสสินทรัพย์</h6></th>
                               <th><h6>รายละเอียด</h6></th>
                               <th><h6>จำนวน</h6></th>
                               <th><h6>ราคา/หน่วย</h6></th>
                               <th><h6>วิธีการได้มา</h6></th>
                               <th><h6>วันตรวจรับ</h6></th>
                               <th><h6>เลขที่สัญญา</h6></th>
                               <th><h6>อายุการใช้งาน</h6></th>
                               <th><h6>หน่วยงานใช้ทรัพย์สิน</h6></th>
                               <th><h6>สถานะ</h6></th>
                               <th><i class="fas fa-edit"></i></th>
                               <th><i class="fas fa-trash"></i></th>
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
                                                <td>".$row['descript']."</td>
                                                <td>".$row['amount']."</td>
                                                <td>".number_format($row['price'])."</td>
                                                <td>".$row['howto']."</td>
                                                <td>".thaiDate($row['reciveDate'])."</td>
                                                <td>".$row['lawID']."</td>
                                                <td>".$row['age']."</td>
                                                <td>".$row['reciveOffice']."</td>
                                                <td>".$row['status']."</td>";?>
                                                <td>
                                                    <a class="btn btn-outline-warning btn-sm btn-block" 
                                                        onclick = "load_edit('<?php print $row['sid']?>')" 
                                                        data-toggle="modal" 
                                                        data-target="#modelEdit">
                                                        <i class="fas fa-pencil-alt"></i> 
                                                    </a> 
                                                </td>
                                                <td>
                                                    <span class='delete btn btn-danger btn-sm text-white' data-id='<?php echo $row['sid']; ?>'><i class="fas fa-trash"></i></span>
                                                </td>
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

<!-- Modal Display Edit -->
<div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="fas fa-pen"></i> แก้ไขรายการครุภัณฑ์ </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                         <div id="divDataview"> </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
      

<?php 
 include("modal_subproject.php");
 include("subproject_managment.php");
 ?>

<script>
function load_edit(sid){
	 var sdata = {
         sid : sid,
     };
	$("#divDataview").load("admin/edit-supproject.php",sdata);
}
</script>



<script src="js/tree-view.js"></script>
<script src="js/delete-subproject.js"></script>

