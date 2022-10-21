    
$(document).ready(function(){
    // Delete 
    $('.delete').click(function(){
        var el = this;

        // Delete id
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'กำลังจะลบข้อมูลโครงการ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ฉันจะลบ!',
            cancelButtonText: 'ไว้ก่อนดีกว่า...'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'remove-project.php',
                    type: 'POST',
                    data: { id:id },
                    success: function(response){

                        console.log('yes');
                        if(response == 1){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','tomato');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                            });
                            
                        }else{
                        // alert('Invalid ID.'+id);
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
        
        if (confirmalert == true) {
            // AJAX Request
            cosole.log('hello')
        }
    });
});