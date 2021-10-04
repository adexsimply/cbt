
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-classes" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Select Class</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-student">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <div class="col-12">

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
                                    </div>
                                    
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" title="add_student" onclick="filter_by_class()" class="btn btn-info pull-right">Filter Assignments</button>
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