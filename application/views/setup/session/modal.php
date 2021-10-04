
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-session" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Session</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-session">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <input type="text" class="form-control" hidden="" name="sess_id" placeholder=" Example 2014 / 2015">
                                <div class="col-12">
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Session Title</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="sess_name" id="sess_name11" required="" placeholder="2014/2015">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="sess_name"></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" title="add_session" onclick="form_routes_add('add_session')" class="btn btn-info pull-right">Confirm</button>
                          </div>
                          <!-- /.box-footer -->
                            <!-- /.box-body -->

                          <!--   <input type="text" class="form-control" hidden="" name="sess_id" placeholder=" Example 2014 / 2015">
                            <div class="form-group mr-b-10">
                                <label for="emailaddress1">Session Name</label>
                                <input class="form-control" type="text" name="sess_name" id="sess_name11"required="" placeholder="2014/2015">
                                <code style="color: #ff0000;" class="form-control-feedback" data-field="sess_name"></code>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-color-scheme ripple" type="button" title="add_session" onclick="form_routes_add('add_session')">Confirm</button>
                            </div>
                        </form> -->
                      </div>
                     <!--  <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-bold btn-pure btn-primary float-right">Save changes</button>
                      </div> -->
                    </div>
                  </div>
                </div>
              <!-- /.modal -->
              
            </div>
          </div>
        </div>