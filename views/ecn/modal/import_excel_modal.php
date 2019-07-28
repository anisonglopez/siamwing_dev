<!-- UserProfile msgbox Modal-->
    <div class="modal fade" id="import_excel_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">นำเข้าข้อมูล ECN</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="post"  enctype="multipart/form-data" action="ecn_importxlsx.php">
                <div class="modal-body">           
                        <div class="modal-body" >
                                    <p>กรุณาเลือกไฟล์ นามสกุล .xlsx</p>   
                                    <p> 
                                       
                                                <input type="hidden" name="import"/>
                                                <input type="file" name="file"  required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                                        </p>
                            </div>
                </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-success" type="submit" >Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>