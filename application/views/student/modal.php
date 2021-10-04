
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-student" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Student</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-student">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <input type="text"  class="form-control" hidden="" name="student_id">
                                <div class="col-12">

                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Full Name</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="fullname" id="fullname11"required="" placeholder="Jane Obi">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="fullname"></div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Student ID</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="csmt_id" id="csmt_id11"required="" placeholder="CSMT/SSS/D/123">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="csmt_id"></div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label"> Phone</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="phone" id="phone11"required="" placeholder="08038387932">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="phone"></div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Class</label>
                                      <div class="col-sm-9">
                                        <select class="custom-select form-control required" id="class" name="class1">
                                          <option value="">Select Class</option>
                                          <?php foreach ($class_list as $class) { ?>
                                          <option value="<?php echo $class->id ?>"><?php echo $class->class_name; ?></option>
                                        <?php } ?>
                                        </select>
                                      </div>
                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="class"></div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Arm</label>
                                      <div class="col-sm-3">
                                        <select class="custom-select form-control required" id="arm" name="arm">
                                          <option value="">Select</option>
                                          <?php foreach ($arm_list as $arm) { ?>
                                          <option value="<?php echo $arm->id ?>"><?php echo $arm->name; ?></option>
                                        <?php } ?>
                                        </select>
                                      </div>
                                      <label for="example-text-input" class="col-sm-1 col-form-label">Alias</label>
                                      <div class="col-sm-5">
                                        <select class="custom-select form-control required" id="alias" name="alias">
                                          <option value="">Select</option>
                                          <?php foreach ($alias_list as $alias) { ?>
                                          <option value="<?php echo $alias->id ?>"><?php echo $alias->name; ?></option>
                                        <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" title="add_student" onclick="form_routes_add('add_student')" class="btn btn-info pull-right">Confirm</button>
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