<!-- upload file  Modal-->
<div class="modal fade" id="file_upload_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">แนบไฟล์</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form  method="post" enctype="multipart/form-data" id="upload" class="upload">
                <div class="modal-body">           
                             <p> 
                             <input id="file" type="file" name="file"  required/>
                            </p>
                                    <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <input type="text" name="att_desc" id="att_desc" class="form-control"  placeholder="Description">
                                    </div>
                                </div>                      
                                <div id="loading-progress" class="loading-progress" style="display: show;"></div>
                                <div id="upload_response"></div>
                                <!-- <small>**เมื่อทำการแนบไฟล์แล้ว ระบบจะบันทึก ECN No. นี้ อัตโนมัติ</small> -->
                </div>
        <div class="modal-footer">
        <button class="btn btn-secondary"  type="reset" data-dismiss="modal">ยกเลิก</button>
        <button class="btn btn-success" type="submit">ยืนยัน</button>
        </div>
        </form>
      </div>
    </div>
  </div>

