
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-password" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-<?php echo strtolower($title); ?>">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <input type="text"  class="form-control" hidden="" name="student_id" id="teacher_id" placeholder=" Example 2014 / 2015">
                                <div class="col-12">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-4 col-form-label">New Password</label>
                                      <div class="col-sm-8">
                                        <input class="form-control" type="text" name="password" minlength="6" id="password" required="" placeholder="">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="password"></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button type="button" title="add_<?php echo strtolower($title); ?>" onclick="change_password2()" class="btn btn-info pull-right">Confirm</button>
                          </div>
                          <!-- /.box-footer -->
                            <!-- /.box-body -->
                      </div>
                    </div>
                  </div>
                </div>
              <!-- /.modal -->
              
            </div>
          </div>
        </div>