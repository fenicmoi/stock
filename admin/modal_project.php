
     <!-- เพิ่มโครงการ -->
     <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document" style="min-width: 800px">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white"> <i class="fas fa-plus"></i> เพิ่มโครงการ
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form method="post">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">ปีงบประมาณ</span>
                                    </div>
                                    <select class="form-control col-4" name="sel_year" id="sel_year">
                                    <?php    
                                        while($row_y = dbFetchArray($result_y)){?>
                                            <option  id='ylist' value='<?=$row_y['yid'];?>''><?=$row_y['yname']?></option>
                                    <?php }?>
                                    </select>

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">วันที่บันทึก</span>
                                    </div>
                                    <input type="text" name="txtDate" id="txtDate" class="form-control" value="<?php echo DateThai();?>" disabled>
                                </div>  

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">แหล่งงบประมาณ</span>
                                        </div>
                                        <select name="owner" id="owner">
                                            <option value="งบจังหวัด">งบจังหวัด</option>
                                            <option value="งบกลุ่มจังหวัด">งบกลุ่มจังหวัด</option>
                                            <option vlaue="งบเศรษฐกิจฐานราก">งบเศรษฐกิจฐานราก</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">            
                                    <div class="input-group mb3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ชื่อโครงการ</span>
                                        </div>
                                        <input type="text" name="prj_name" id="prj_name" class="form-control"  required="required" title="เพิ่มชื่อโครงการ">
                                    </div>
                                </div>

                                <div class="form-group">            
                                    <div class="input-group mb3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">งบประมาณ</span>
                                        </div>
                                        <input type="number" name="money" id="money" class="form-control" value=0 title="เพิ่มชื่อโครงการ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">บาท</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                            <select class="form-control" name="sel_office" id="sel_office" required> 
                                                <option></option>
                                            </select>
                                            <p class="form-text text-muted">
                                                เพิ่มหน่วยรับงบประมาณ
                                            </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">เจ้าหน้าที่</span>
                                        </div>
                                        <input type="text" name="txtUser" id="txtUser" class="form-control" value="<?php echo $_SESSION['User']?>" disabled>
                                    </div>
                                </div>
                                <div id="lblWarning"></div>
                                <div id="lblWarning2"></div>  
                                <div class="card-footer">
                                        <center>
                                        <button class="btn btn-success  float-center" type="submit" name="save" id="save">
                                            <i class="fa fa-save"></i> บันทึก
                                        </button>
                                        </center>
                                </div>
                        </form>
                    </div> <!-- main body -->
                </div> <!-- modal content -->
            </div>
    </div>



    
        <!-- Modal Display Edit -->
        <div class="modal fade" id="modelEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="fas fa-pen"></i> แก้ไขโครงการ </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                         <div id="divDataview"></div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>