
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-fee" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Fee</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-fee">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <input type="text"  class="form-control" hidden="" name="student_id" id="student_id">
                                <div class="col-12">
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Class</label>
                                      <div class="col-sm-9">
                                        <select class="custom-select form-control required" id="class" name="class">
                                          <option value="">Select Class</option>
                                          <?php foreach ($class_list as $class) { ?>
                                          <option value="<?php echo $class->id ?>"><?php echo  $class->class_name; ?></option>
                                        <?php } ?>
                                        </select>
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="class"></div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label"> Duration (days)</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="number" name="duration" id="duration"required="" placeholder="30">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="duration"></div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label"> Amount</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="amount" id="amount"required="" placeholder="23000">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="amount"></div>
                                    </div>
                                    
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" title="add_fee" onclick="form_routes_add('add_fee')" class="btn btn-info pull-right">Add Fee</button>
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