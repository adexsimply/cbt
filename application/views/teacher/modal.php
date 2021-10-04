
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-teacher" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Teacher</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-teacher">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <input type="text"  class="form-control" hidden="" name="teacher_id" placeholder=" Example 2014 / 2015">
                                <div class="col-12">

                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">First Name</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="first_name" id="first_name11"required="" placeholder="john">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="first_name"></div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Last Name</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="last_name" id="last_name11"required="" placeholder="Chukwudi">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="last_name"></div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label"> Phone</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="phone" id="phone11"required="" placeholder="08038387932">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="phone"></div>
                                    </div>
                                    
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="email" name="email" id="email11"required="" placeholder="hello@email.com">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="email"></div>
                                    </div>
                                    
                                    <div class="form-group row" id="subject">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Subject</label>
                                      <div class="col-sm-9">
                                        <select class="custom-select form-control required" id="wlocation2" name="subject">
                                          <option value="">Select Subject</option>
                                          <?php foreach ($subject_list as $subject) { ?>
                                          <option value="<?php echo $subject->id ?>"><?php echo $subject->subject_name; ?></option>
                                        <?php } ?>
                                        </select>
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="subject"></div>
                                    </div>
                                    
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" title="add_session" type="button" title="add_teacher" onclick="form_routes_add('add_teacher')" class="btn btn-info pull-right">Confirm</button>
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