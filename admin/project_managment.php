<?php   //ชุดคำสั่ง php  จัดการ Project

    //เพิ่ม project
    if(isset($_POST['save'])){
        $yid = $_POST['sel_year'];
        
        $sql =  "SELECT recid FROM project WHERE yid=$yid";
        $result = dbQuery($sql);
        $num = dbNumRows($result);
        $num++;
        $name = $_POST['prj_name'];
        $money = $_POST['money'];
        $uid = $_POST['sel_office'];
        $owner = $_POST['owner'];    //งบจังหวัด
        

        $sql = "INSERT INTO project(recid, name, money, yid, uid, owner) VALUES($num, '$name', $money, $yid, '$uid', '$owner')";
       // print $sql;
        $result =  dbQuery($sql);

        if($result){
            echo "<script>alert('บันทึกโครงการเรียบร้อยแล้ว')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='?menu=project'>";
        }else{
            echo "<script>alert('มีบางอย่างผิดพลาด  กรุณาติดต่อ Admin')</script>";
        }
    
    }

    //แก้ไข project 
    if(isset($_POST["btnEdit"])){
        $pid = $_POST['pid'];
        $uid = $_POST['sel_office'];
        $sel_year = $_POST['sel_year'];
        $prj_name = $_POST['prj_name'];
        $money = $_POST['money'];

        $sql ="UPDATE project  SET   name = '$prj_name', money = $money, yid = $sel_year, uid='$uid'  WHERE pid = $pid";
        $result = dbQuery($sql);
        if($result){
            echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='admin/project.php'>";
        }else{
            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
            echo "<META HTTP-EQUIV='Refresh' Content='0'; URL='project.php'>";
        }
    }
?>
