
      <div class="container-fluid">
        <div class="mb-4">

        </div>
          <div class="row">
              <div class="col-xl-12 col-lg-12">
                  <div class="card shadow mb-4">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>

                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <form action="<?=base_url('admin/login/savepass')?>" method="post" >
                        <div class="row " >
                            <div class="col-sm-4" style="margin: 0 auto;">
                              <div class="card">
                                <div class=""></div>
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div style="color:#0069d9;margin:0px auto;"><h4>Change Password</h4></div>
                                      <br/>
                                    </div>

                                    <div class="col-sm-12">
                                           <label for="title">Current Password:</label>
                                           <input  class="form-control input-group-lg form-control-sm" type="password" name="pass_current"
                                                  placeholder="Enter your old password"/>
                                                  <?php echo form_error('pass_current', '<div class="">', '</div>'); ?>
                                   </div>
                                 </div>
                                 <div class="row">
                                   <div class="col-sm-12">
                                          <label for="title">New Password:</label>
                                          <input  class="form-control input-group-lg form-control-sm" type="password" name="pass_new"
                                                 placeholder="Enter your new password"/>
                                                 <?php echo form_error('pass_new', '<div class="">', '</div>'); ?>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                         <label for="title">Confirm Password:</label>
                                         <input  class="form-control input-group-lg form-control-sm" type="password" name="pass_conf"
                                                placeholder="Re-enter your password"/>
                                                <?php echo form_error('pass_conf', '<div class="">', '</div>'); ?>
                                 </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <br/>
                                         <button class="btn btn-primary btn-block" type="submit">Change Password</button>
                                 </div>
                                </div>
                                 </div>
                                 </div>
                            </div>
                        </div>

                         </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
