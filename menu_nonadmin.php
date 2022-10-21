<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="#">ระบบบริหารพัสดุจังหวัดพัทลุง</a>

    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active"> <a class="nav-link" href="?menu=home"><i class="fas fa-home"></i>หน้าหลัก</a></li>
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