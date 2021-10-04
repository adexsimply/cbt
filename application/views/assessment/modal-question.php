
			  <!-- Modal -->
				<div class="modal center-modal fade" id="modal-question" tabindex="-1">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title">Question</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  	
                    <form id="update-question">
                              <div class="row">
                                <input type="text"  class="form-control" hidden="" name="student_id">
                                <div class="col-12">

                        
                        <div class="form-group row">
                            <input type="" value="1" hidden="" name="question_id">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Question</label>
                            <div class="col-sm-9">
                            <input type="text" id="question" name="question" class="form-control" required>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Option1</label>
                              <div class="col-sm-9">
                                <input type="text" id="option1" name="option1" class="form-control" required>
                              </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Option 2</label>
                            <div class="col-sm-9">
                            <input type="text" id="option2" name="option2" class="form-control" required>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Option3</label>
                            <div class="col-sm-9">
                                <input type="text" id="option3" name="option3" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="example-text-input" class="col-sm-3 col-form-label">Option 4</label>
                          <div class="col-sm-9">
                            <input type="text" id="option4" name="option4" class="form-control" required>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Correct Answer</label>
                              <div class="col-sm-9">
                                <select class="form-control" id="class" data-placeholder="Select a Class" name="answer" style="width: 100%;" required>
                                     <option value="">Select Option</option>
                                     <option value="1">A</option>
                                     <option value="2">B</option>
                                     <option value="3">C</option>
                                     <option value="4">D</option>
                                </select>
                              </div>
                        </div> 

                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                          <div class="box-footer">
                            <button type="button" class="btn btn-success pull-right" title="add_assessment" onclick="form_routes_add_q('update_question')">Update Question</button>
                          </div>
                          </form>
					  </div>
					</div>
				  </div>
				</div>
			  <!-- /.modal -->