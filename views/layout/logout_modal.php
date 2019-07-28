  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">คุณต้องการออกจากระบบใช่หรือไม่ ..?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">คลิกที่ปุ่ม "Logout" เพื่อออกจากระบบ</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="../login/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

    <!-- UserProfile Modal-->
    <div class="modal fade" id="UserProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="post" id="changepassword" class="changepassword" >
             <div class="modal-body">           
                  <div class="form-group row">
                      <label for="old_password" class="col-sm-4 col-form-label">Current Password : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="password" name="old_password" id="old_password" value="" class="form-control"    required minlength="6" maxlength="10" placeholder="Current Password">
                    </div>
                    </div>

                <div class="form-group row">
                      <label for="user_password" class="col-sm-4 col-form-label">New Password : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="password" name="user_password" id="user_password" value="" class="form-control"    required minlength="6" maxlength="10" placeholder="New Password">
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="user_repassword" class="col-sm-4 col-form-label">Confirm Password : <span class="text-danger">*</span></label>
                      <div class="col-sm-8">
                        <input type="password" name="user_repassword" id="user_repassword" value="" class="form-control"    required  minlength="6" maxlength="10" placeholder="Confirm Password">
                    </div>
                    </div>
                   
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>


    <!-- UserProfile msgbox Modal-->
    <div class="modal fade" id="UserProfileMsgboxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ผลการเปลี่ยนรหัสผ่าน</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="post"  >
             <div class="modal-body">           
          <p id="changePass_txt"></p>                   
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>

