<div class="col-12">
	<div class="card box-margin">
		<div class="card-body">
			<form id="schedule-exam">
                <div class=" col-sm-12">
                    <div class="form-group">
                        <?php if (!$this->uri->segment(4)) { ?>
                    	<input type="text" name="question_id" hidden value="<?php echo $this->uri->segment(3); ?>">
                        <?php } else { ?>
                        <input type="text" name="exam_id" hidden value="<?php echo $this->uri->segment(4); ?>">
                        <?php } ?>
                        <label for="">Class</label><span class="text-danger">*</span>
                        <select class="form-control select2" id="class" data-placeholder="Select a Class" name="class">
                             <option value="">Select Class</option>
                            <?php foreach ($class_list as $class) { ?>
                            <option <?php if ($this->uri->segment(4)) { if($question_details->class_id==$class->id){ echo "selected"; }  } ?> value="<?php echo $class->id; ?>"><?php echo $class->class_name; ?></option>
                            <?php } ?>
                        </select>
                    	<code style="color: #ff0000;font-size: 14px;" class="form-control-feedback" data-field="class"></code>
                    </div>
                </div>
                <div class=" col-sm-12">
                    <div class="form-group">
                        <label for="">Exam Type</label><span class="text-danger">*</span>
                        <input type="text" id="exam_type" <?php if ($this->uri->segment(4)) { echo "value='$question_details->exam_type'"; } ?> name="exam_type" class="form-control">
                    	<code style="color: #ff0000;font-size: 14px;" class="form-control-feedback" data-field="exam_type"></code>
                    </div>
                </div>
                <div class=" col-sm-12">
                    <label for="">Duration (minutes)</label><span class="text-danger">*</span>
                    <input type="number" id="duration" <?php if ($this->uri->segment(4)) { echo "value='$question_details->duration'"; } ?> name="duration" class="form-control">
                    <code style="color: #ff0000;font-size: 14px;" class="form-control-feedback" data-field="duration"></code>
                </div>
                <hr>
                <div class="col-sm-12">

                    <div class="form-group">
	                    <label class="fancy-checkbox">
	                        <input type="checkbox" name="shuffle" value="1" <?php if ($this->uri->segment(4)) { if($question_details->shuffle=='1'){ echo "checked"; }  } ?>>
	                        <span>Shuffle</span>
	                    </label>
	                    <label class="fancy-checkbox">
	                        <input type="checkbox" name="autograde" value="1" <?php if ($this->uri->segment(4)) { if($question_details->auto_grade=='1'){ echo "checked"; }  } ?>>
	                        <span>Auto Grade</span>
	                    </label>
                	</div>
                </div>

			</form>
		</div>
	</div>
</div>
