
					  	<?php //var_dump($question_details); ?>
                    <form id="update-question-d">
                        <div class="form-group row">
                            <input type="" value="<?php echo $question_details->id; ?>" hidden name="question_id">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Question</label>
                            <div class="col-sm-9">
                            <input type="text" id="question" name="question" value="<?php echo $question_details->question; ?>" class="form-control" required>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Instruction</label>
                              <div class="col-sm-9">
                                <textarea class="form-control" name="instruction"> <?php echo $question_details->instruction; ?> </textarea>
                              </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Comprehension</label>
                              <div class="col-sm-9">
                                <textarea class="form-control" name="comprehension"> <?php echo $question_details->comprehension; ?></textarea>
                              </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Option1</label>
                              <div class="col-sm-9">
                                <input type="text" id="option1" name="option1" value="<?php echo $question_details->option1; ?>" class="form-control" required>
                              </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Option 2</label>
                            <div class="col-sm-9">
                            <input type="text" id="option2" name="option2" value="<?php echo $question_details->option2; ?>" class="form-control" required>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Option3</label>
                            <div class="col-sm-9">
                                <input type="text" id="option3" name="option3" value="<?php echo $question_details->option3; ?>" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="example-text-input" class="col-sm-3 col-form-label">Option 4</label>
                          <div class="col-sm-9">
                            <input type="text" id="option4" name="option4" value="<?php echo $question_details->option4; ?>" class="form-control" required>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Correct Answer</label>
                              <div class="col-sm-9">
                                <select class="form-control" id="class" data-placeholder="Select a Class" name="answer" style="width: 100%;" required>
                                     <option value="">Select Option</option>
                                     <option <?php if (($question_details->answer)==1) { ?> selected <?php } ?> value="1">A</option>
                                     <option <?php if (($question_details->answer)==2) { ?> selected <?php } ?> value="2">B</option>
                                     <option <?php if (($question_details->answer)==3) { ?> selected <?php } ?> value="3">C</option>
                                     <option <?php if (($question_details->answer)==4) { ?> selected <?php } ?> value="4">D</option>
                                </select>
                              </div>
                        </div> 

                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                          <!-- <div class="box-footer">
                            <button type="button" class="btn btn-success pull-right" title="add_assessment" onclick="form_routes_add_q('update_question')">Update Question</button>
                          </div> -->
                          </form>