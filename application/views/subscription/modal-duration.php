
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-duration" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Select End Date</h5>
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
                                      <label for="example-text-input" class="col-sm-3 col-form-label">End Date</label>
                                      <div class="col-sm-9">
                                        <input type="date" id="end_date" required="" class="form-control" name="end_date">
                                        <input type="text" hidden="" id="student_id" name="student_id">
                                      </div>
                                    </div>
                                    
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" onclick="create_subscription()" class="btn btn-info pull-right">Add Subscription</button>
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