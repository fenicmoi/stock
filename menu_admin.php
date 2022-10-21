<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="#">ระบบบริหารพัสดุจังหวัด<?php echo province;?></a>

    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active"> <a href="?menu=home" class="nav-link" href="deskboard.php"><i class="fas fa-home"></i>หน้าหลัก</a></li>
            <li class="nav-item active">
                <a class="nav-link" href="?menu=project"><i class="fas fa-list"></i> โครงการ</a>
            </li>
            <li class="nav-item active"> 
                <a class="nav-link" href="?menu=list"><i class="fas fa-clipboard-list"></i> รายการครุภัณฑ์</a>
            </li>
            <?php 
              $level = $_SESSION["Userlevel"];
              if ($level == "A") { ?>

                 <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle " href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"><i class="fas fa-print"></i> รายงาน </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="?menu=repProvince">รายงานงบจังหวัด</a>
                        <a class="dropdown-item" href="?menu=repGroup">รายงานงบกลุ่มจังหวัด</a>
                    </div>
                </li> 
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle  " href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"><i class="fas fa-book"></i> คู่มือ </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="paper/manual.pdf" target="_blank">คู่มือกำหนดหมายเลขครุภัณฑ์</a>
                        <a class="dropdown-item" href="manage_class.php">คู่มือการใช้งานระบบ</a>
                    </div>
                </li>  
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle " href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"><i class="fas fa-cog"></i> ตั้งค่า</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="?menu=group"><i class="fas fa-cog"></i> จัดการกลุ่มครุภัณฑ์ (FSN Group)</a>
                        <a class="dropdown-item" href="?menu=class"><i class="fas fa-cog"></i> จัดการชนิดครุภัณฑ์ (FSN Class)</a>
                        <a class="dropdown-item" href="?menu=type"><i class="fas fa-cog"></i> จัดการประเภทครุภัณฑ์ (FSN Type</a>
                        <a class="dropdown-item" href="?menu=user"><i class="fas fa-cog"></i> จัดการผู้ใช้งาน (User)</a>
                    </div>
                </li> 
             <?php } ?>
            
        </ul>
        <form class="form-inline my-2 my-lg-0">
                <?php   
                    if (isset($_SESSION['UserID'])) {
                        echo " <a class='btn btn-danger text-white' href=logout.php><i class='fas fa-key'></i> logout</a> ";
                    }else{
                        echo " <a class='btn btn-danger text-white' href=login.php><i class='fas fa-key'></i> login</a> ";
                    }
                ?>
        </form>
    </div>
</nav>