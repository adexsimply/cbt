
			  <!-- Modal -->
				<div class="modal center-modal fade" id="modal-center" tabindex="-1">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title">Notice</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  	
                   <?php echo form_open_multipart('notice/add_notice');?>
                              <div class="row">
                                <input type="text"  class="form-control" hidden="" name="student_id">
                                <div class="col-12">

                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Class</label>
                                      <div class="col-sm-9">
		                                <select class="form-control select2" id="class" data-placeholder="Select a Class" name="class" style="width: 100%;" required>
		                                     <option value="">Select Class</option>
                                         <option value="0">General</option>
		                                    <?php foreach ($class_list as $class) { ?>
		                                    <option value="<?php echo $class->id; ?>"><?php echo $class->class_name; ?></option>
		                                    <?php } ?>
		                                </select>
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="username"></div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Priority</label>
                                      <div class="col-sm-9">
		                                <select class="form-control select2" id="class" data-placeholder="Select a Class" name="priority" style="width: 100%;" required>
		                                     <option value="">Select Option</option>
		                                     <option value="1">Low</option>
		                                     <option value="2">Normal</option>
		                                     <option value="3">High</option>
		                                </select>
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="username"></div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Text</label>
                                      <div class="col-sm-9">
                                      	<textarea class="form-control" name="body"></textarea>
                                      </div>
                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="password1"></div>
                                    </div>  

                                    <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-3 col-form-label">Attachment</label>
                                      <div class="col-sm-9">
                                        <input class="form-control" type="file" name="materialfile" id="file">
                                      </div>
                                    </div>                                    
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                          <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Add Notice</button>
                          </div>
                          </form>
					  </div>
					</div>
				  </div>
				</div>
			  <!-- /.modal -->