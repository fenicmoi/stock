   
$(function(){
    
    //เรียกใช้งาน Select2
    $(".select2-single").select2({ width: "500px", dropdownCssClass: "bigdrop"});
    
    //ดึงข้อมูล province จากไฟล์ get_data.php
    $.ajax({
        url:"get_data_php53.php",
        dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
        data:{show_province:'show_province'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
        success:function(data){
            
            //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
            $.each(data, function( index, value ) {
                //แทรก Elements ใน id province  ด้วยคำสั่ง append
                  $("#gnumber").append("<option value='"+ value.gid +"'> " +value.gnumber + value.gname + "</option>");
            });
        }
    });
    
    
    //แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
    $("#gnumber").change(function(){

        //กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
        var province_id = $(this).val();
        
        $.ajax({
            url:"get_data_php53.php",
            dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
            data:{province_id:province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
            success:function(data){
                
                //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                $("#cnumber").text("");
                
                //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                $.each(data, function( index, value ) {
                    
                    //แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
                      $("#cnumber").append("<option value='"+ value.cid +"'> " + value.cnumber+"."+value.cname + "</option>");
                });
            }
        });

    });
    
    //แสดงข้อมูลตำบล โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #amphur
    $("#cnumber").change(function(){
        
        //กำหนดให้ ตัวแปร amphur_id มีค่าเท่ากับ ค่าของ  #amphur ที่กำลังถูกเลือกในขณะนั้น
        var amphur_id = $(this).val();
        
        $.ajax({
            url:"get_data_php53.php",
            dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
            data:{amphur_id:amphur_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
            success:function(data){
                
                  //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
                  $("#tnumber").text("");
                  
                //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                $.each(data, function( index, value ) {
                    
                  //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
                  $("#tnumber").append("<option value='" + value.tid + "'> " + value.tnumber +"."+ value.tname + "</option>");
                });
            }
        });
        
    });
    
    //คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #district 
    $("#tnumber").change(function(){

        
        // //นำข้อมูลรายการ จังหวัด ที่เลือก มาใส่ไว้ในตัวแปร province
        // var province = $("#gnumber option:selected").text();
        
        // //นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
        // var amphur = $("#cnumber option:selected").text();
        
        // //นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
        // var district = $("#tnumber option:selected").text();
        
        // //ใช้คำสั่ง alert แสดงข้อมูลที่ได้
        // alert("คุณได้เลือก :  กลุ่ม : " + gnumber + " ประเภท : "+ cnumber + "  ชนิด : " + tnumber );
        
    });
    
    
});
