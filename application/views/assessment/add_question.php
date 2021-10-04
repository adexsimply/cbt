<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Questions</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">


              </div>
                <div class="card patients-list">
                    <div class="header">
                        <h2>Add Question</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">
                                   <form id="add-assessment" class="row">
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Subjects</label><span class="text-danger">*</span>
                                                <select class="form-control select2" id="subject" data-placeholder="Select a Subject" name="subject" style="width: 100%;" required>
                                                    <option value="">Select Subject</option>
                                                    <?php foreach ($subjects_list as $subject) { ?>
                                                    <option value="<?php echo $subject->id; ?>"><?php echo $subject->subject_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Class</label><span class="text-danger">*</span>
                                                <select class="form-control select2" id="class" data-placeholder="Select a Class" name="class" style="width: 100%;" required>
                                                     <option value="">Select Class</option>
                                                    <?php foreach ($class_list as $class) { ?>
                                                    <option value="<?php echo $class->id; ?>"><?php echo $class->class_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div> 

                                       <!--  -->
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <label for="">Title</label><span class="text-danger">*</span>
                                            <input type="text" id="title" name="title" class="form-control" required>
                                        </div>

                                        <div class=" col-sm-6">

                                            <div class="form-group">
                                                <label for="">Mark Per Question</label><span class="text-danger">*</span>
                                                <input type="number" id="mark_per_question" name="mark_per_question" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class=" col-sm-6">

                                            <div class="form-group">
                                                <label for="">Pass Mark</label><span class="text-danger">*</span>
                                                <input type="number" id="pass_mark" name="pass_mark" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class=" col-sm-6">

                                            <div class="form-group">
                                                <label for="">Question Type</label><span class="text-danger">*</span>
                                                <select class="form-control" id="question_type" name="question_type" style="width: 100%;" required>
                                                    <option value="1">Objective</option>
                                                    <option value="2">Subjective</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" col-12 mt-20">
                                            <input type="" value="1" hidden="" name="food_id[]">
                                            <label for="">Question</label><span class="text-danger">*</span>
                                            <input type="text" id="question" name="question[]" class="form-control" required>
                                        </div>
                                        <div class="col-xl-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <label>Instruction</label>
                                                <textarea class="form-control" name="instruction[]"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <label>Comprehension</label>
                                                <textarea class="form-control" name="comprehension[]"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Option1</label><span class="text-danger">*</span>
                                                <input type="text" id="option1" name="option1[]" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Option 2</label><span class="text-danger">*</span>
                                            <input type="text" id="option2" name="option2[]" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Option3</label><span class="text-danger">*</span>
                                                <input type="text" id="option3" name="option3[]" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Option 4</label><span class="text-danger">*</span>
                                            <input type="text" id="option4" name="option4[]" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Correct Answer</label><span class="text-danger">*</span>
                                                <select class="form-control" id="class" data-placeholder="Select a Class" name="answer[]" style="width: 100%;" required>
                                                     <option value="">Select Option</option>
                                                     <option value="1">A</option>
                                                     <option value="2">B</option>
                                                     <option value="3">C</option>
                                                     <option value="4">D</option>
                                                </select>
                                            </div>
                                        </div>                         


                                        <div id="more_question" class="body"></div>

                                        <div class="col-md-12 d-flex justify-content-center my-25">
                                            <button onclick="add_question(1)" class="btn btn-dark">Add More Question</button>&nbsp;&nbsp;
                                                    <button class="btn btn-primary" type="button" title="add_assessment" onclick="form_routes_add('add_assessment')">Confirm</button>
                                        </div>
                                    </form>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?> 
<?php $this->load->view('assessment/script'); ?>  