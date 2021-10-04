
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-classes" tabindex="-1">
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
                                <input type="text"  class="form-control" hidden="" name="student_id" id="student_id">
                                <div class="col-12">
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Class</label>
                                      <div class="col-sm-9">
                                        <select class="custom-select form-control required" id="class_arm_id" name="class">
                                          <option value="">Select Class</option>
                                          <?php foreach ($class_list1 as $class) { ?>
                                          <option value="<?php echo $class->id ?>"><?php echo $class->class_list_name.$class->arm_name; ?></option>
                                        <?php } ?>
                                        </select>
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="class"></div>
                                    </div>
                                    
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" title="add_student" onclick="add_class_to_student()" class="btn btn-info pull-right">Confirm</button>
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