<?php   
include("header.php");
include("define.php");
include("navbar.php");

//menu for admin
@$menu = $_GET['menu'];
if($menu == ''){
    $menu = 'home';
}
if($menu =='home'){
    include("content.php");                 //icon graph  main
}elseif($menu =="project"){                 //project all
    include("admin/project.php");
}elseif($menu=='subproject'){               //click and subproject
    include("admin/sub_project.php");       
}elseif($menu == "list"){                   //list fdsn
    include("list.php");    
}elseif($menu == "group"){                  //project group 
    include("manage_group.php");
}elseif($menu == "class"){                  //manage class
    include("manage_class.php");
}elseif($menu == "type"){                   //manage type
    include("manage_type.php");             
}elseif($menu == "pjProvince"){             //project for  user
    include("user/pjProvince.php");
}elseif($menu == "pjGroup"){                //project group for user
    include("user/pjGroup");
}elseif($menu == 'subProject'){             //subproject for user
    include("user/sub_project.php");
}elseif($menu == "editSub") {
    include("admin/edit-supproject.php");
}

?>