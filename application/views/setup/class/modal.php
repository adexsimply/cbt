
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-class" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Class</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-class">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <input type="text"  class="form-control" hidden="" name="class_id" placeholder=" Example 2014 / 2015">
                                <div class="col-12">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Class Name</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="class_name" id="class_name11"required="" placeholder="john Chukwudi">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="class_name"></div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Group</label>
                                      <div class="col-sm-9">
                                        <select class="form-control" id="class" data-placeholder="Select a Class" name="group" style="width: 100%;" required>
                                             <option value="">Select Group</option>
                                             <option value="1">CSMT</option>
                                             <option value="2">Others</option>
                                        </select>
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="group"></div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">School</label>
                                      <div class="col-sm-9">
                                        <select class="form-control" id="class" data-placeholder="Select a Class" name="school" style="width: 100%;" required>
                                             <option value="">Select School</option>
                                             <option value="1">Secondary</option>
                                             <option value="2">Primary</option>
                                        </select>
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="school"></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" title="add_session" type="button" title="add_class" onclick="form_routes_add('add_class')" class="btn btn-info pull-right">Confirm</button>
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