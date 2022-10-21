

<?php  
//include("library/database.php");
include("header.php");
?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stlesheet"  href="css/style.css">
   <!-- sweetalert 2 -->  
    <script src="js/sweetalert2.js"></script>
    <!-- font Awasome 4.7 -->  
    <script src="https://kit.fontawesome.com/d1483361bb.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/login.css">

<script type="text/javascript" src="js/overhang.min.js"></script>
    <script>
    /*
    $(document).ready(function(){
    
        $("#but_submit").click(function(){
            // var username = $("#username").val().trim();
            // var password = $("#password").val().trim();
            var username = $("#username").val();
            var password = $("#password").val();

            if( username != "" && password != "" ){
                $.ajax({
                    url:'checkuser.php',
                    type:'post',
                    data:{Username:username,Password:password},
                    success:function(response){
                 
                        if(response == 1){

                            // window.location ="frontpage.php"

                            $("body").overhang({
                                type: "confirm",
                                message: "Do you want to continue?",
                                closeConfirm: "true",
                                overlay: true,
                                overlayColor: "#1B1B1B"
                            });
                        }else if(response == 2){
                            alert("user");
                        }else if(response == 0) {
                            $("body").overhang({
                                type: "confirm",
                                message: "Do you want to continue?",
                                closeConfirm: "true",
                                overlay: true,
                                overlayColor: "#1B1B1B"
                            });
                        }

                    }
                });

            }else{
                alert('hello');
            }
        });
        
    });
    */
    </script>



<!--Coded with love by Mutiullah Samim-->

<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="img/logo-2.png" class="brand_logo" alt="Logo">
					</div>
				</div>
                <!-- <div  id="msg" class=" d-flex alert alert-danger border-danger">ไม่พบข้อมูลผู้ใช้</div> -->
				<div class="d-flex justify-content-center form_container">
                    
                    <form action="checkuser.php" method="post"  id="frm-login" name="frm-login">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" id="username" class="form-control input_user" value="" placeholder="username" required="">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" id="password" class="form-control input_pass" value="" placeholder="password" required="">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">จำรหัสผ่าน</label>
							</div>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				            <button type="submit" id="but_submit" name="but_submit"  class="btn btn-danger btn-block" ><span class="ladda-label">Submit</span></button>
				   </div>
					</form>
                    
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						ติดต่อขอรับบัญชีผู้ใช้ได้ที่ สำนักงานจังหวัดพัทลุง? 
					</div>
				</div>
               
			</div>
		</div>
	</div>
<?php include("footer.php");?>