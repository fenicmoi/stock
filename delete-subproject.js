    
$(document).ready(function(){
    $('.delete').click(function(){
        var el = this;

        // Delete id
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'กำลังจะลบข้อมูล?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบมันเลย!',
            cancelButtonText: 'ไม่ลบ'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'del-subproject.php',
                    type: 'POST',
                    data: { id:id },
                    success: function(response){


                        if(response == 1){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','tomato');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                            });
                            
                        }else{
                          //  console.log('hellojava'+response);
                        Swal.fire({
                                icon: 'error',
                                title: 'อุ๊บบ...',
                                text: 'มีบางอย่างผิดพลาด!',
                                footer: '<a href>ติดต่อ admin</a>'
                            })
                        }


                    }
                });
            }
        })
    });
});