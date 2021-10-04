
        <div class="col-12 col-lg-3">   
              
              <!-- Modal -->
                <div class="modal center-modal fade" id="arm-modal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Session</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-arm">
                            <div class="form-group mr-b-10">
                                 <input type="text" class="form-control" hidden="" name="arm_id" placeholder=" Example 2014 / 2015">
                                <label for="emailaddress1">Arm Name</label>
                                <input class="form-control" type="text" name="arm_name" id="arm_name11"required="" placeholder="A">
                                <div style="color: #ff0000;" class="form-control-feedback" data-field="arm_name"></div>
                            </div>
                            <div class="form-group text-center">
                                <button  class="btn btn-info" type="button" title="add_arm" onclick="form_routes_add('add_arm')">Confirm</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- /.modal -->
              
            </div>