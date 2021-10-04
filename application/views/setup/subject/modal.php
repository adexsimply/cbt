
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-subject" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Subject</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-subject">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <input type="text"  class="form-control" hidden="" name="subject_id" placeholder=" Example 2014 / 2015">
                                <div class="col-12">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-4 col-form-label">Subject Name</label>
                                      <div class="col-sm-8">
                                        <input class="form-control" type="text" name="subject_name" id="subject_name11"required="" placeholder="john Chukwudi">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="subject_name"></div>
                                      <hr>
                                      <div class="form-group row" style="padding: 3%;">
                                        <input type="checkbox" id="basic_checkbox_0" name="check_all" value="0" />
                                        <label for="basic_checkbox_0">All</label>

                                      <?php $i=1;
                                      foreach ($class_list as $class) {
                                        
                                        ?>
                                        <input type="checkbox" id="basic_checkbox_<?php echo $class->id; ?>" name="class_id[]" class="filled-in" value="<?php echo $class->id; ?>" />
                                        <label for="basic_checkbox_<?php echo $class->id; ?>"><?php echo $class->class_name; ?></label>&nbsp;&nbsp;&nbsp;<p></p>
                                        <?php 
                                        if (($i % 3) == 0) {
                                          ?>
                                          <br>
                                          <?php
                                        }
                                        $i++;


                                      } 
                                      ?>
                                    </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="class_id[]"></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" title="add_session" type="button" title="add_subject" onclick="form_routes_add('add_subject')" class="btn btn-info pull-right">Confirm</button>
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