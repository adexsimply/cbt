
        <div class="col-12 col-lg-3">   
              <!-- Modal -->
                <div class="modal center-modal fade" id="class-modal" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Class</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add-<?php echo strtolower($title); ?>">
                            <div class="form-group mr-b-10">
                                 <input type="text" class="form-control" hidden="" name="class_id" placeholder=" Example 2014 / 2015">
                                <label for="<?php echo strtolower($title); ?>">Class Name</label>
                                <input class="form-control" type="text" name="<?php echo strtolower($title); ?>_name" id="<?php echo strtolower($title); ?>_name11"required="" placeholder="john@deo.com">
                                <div style="color: #ff0000;" class="form-control-feedback" data-field="<?php echo strtolower($title); ?>_name"></div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-info" type="button" type="button" title="add_<?php echo strtolower($title); ?>" onclick="form_routes_add('add_<?php echo strtolower($title); ?>')">Confirm</button>
                            </div>
                        </form>
                    </div>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- /.modal -->
              
            </div>