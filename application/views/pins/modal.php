
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="modal-user" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-user">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <input type="text"  class="form-control" hidden="" name="student_id">
                                <div class="col-12">

                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Username</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="text" name="username" id="username11" required="" placeholder="Jane Obi">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="username"></div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Password</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="password" name="password1" id="password11" required="" placeholder="12i3j3">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="password1"></div>
                                    </div>
                                    
                                   <!--  <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="email" name="email" id="email11"required="" placeholder="hello@email.com">
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="email"></div>
                                    </div> -->
                                    
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button  type="button" title="add_user" onclick="form_routes_add('add_user')" class="btn btn-info pull-right">Confirm</button>
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