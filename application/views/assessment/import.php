<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Exam</h2>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                      <div class="header">
                          <h2>Create Exam</h2>
                      </div>
                      <div class="body">
                          <!-- Nav tabs -->

                          

                        <form action="<?php echo base_url();?>assessment/try_import" id="add-assessment" class="row" method="post" enctype="multipart/form-data">

                            <div class="row clearfix">
                                <div class="col-xl-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Subjects</label><span class="text-danger">*</span>
                                        <?php if ($this->uri->segment(3)) { ?>
                                            <input type="text" name="question_id" value="<?php echo $this->uri->segment(3); ?>">
                                        <?php } ?>
                                        <select class="form-control select2" id="subject" data-placeholder="Select a Subject" name="subject" style="width: 100%;" required>
                                            <option value="">Select Subject</option>
                                            <?php foreach ($subjects_list as $subject) { ?>
                                            <option <?php if($this->uri->segment(3)) { if ($question_details->id==$subject->id) { echo "selected"; } } ?> value="<?php echo $subject->id; ?>"><?php echo $subject->subject_name; ?></option>
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
                                            <option <?php if($this->uri->segment(3)) { if ($question_details->class_id==$class->id) { echo "selected"; } } ?>  value="<?php echo $class->id; ?>"><?php echo $class->class_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 
                               <!--  <div class=" col-sm-6">
                                    <label for="">Duration (minutes)</label><span class="text-danger">*</span>
                                    <input type="number" id="duration" name="duration" class="form-control" required>
                                </div> -->
                                <div class=" col-sm-6">
                                    <div class="form-group">
                                        <label for="">Title</label><span class="text-danger">*</span>
                                        <input  <?php if($this->uri->segment(3)) {?> value="<?php echo "$question_details->title"; ?>" <?php } ?> type="text" id="title" name="title" class="form-control" required>
                                    </div>
                                </div>
                                <div class=" col-sm-6">
                                    <div class="form-group">
                                        <label for="">Mark Per Question</label><span class="text-danger">*</span>
                                        <input  <?php if($this->uri->segment(3)) {?> value="<?php echo round($question_details->mark_per_question,2); ?>" <?php } ?> type="number" id="mark_per_question" name="mark_per_question" class="form-control" step="any" required>
                                    </div>
                                </div>
                                <div class=" col-sm-6">

                                    <div class="form-group">
                                        <label for="">Pass Mark</label><span class="text-danger">*</span>
                                        <input  <?php if($this->uri->segment(3)) {?> value="<?php echo "$question_details->pass_mark"; ?>" <?php } ?> type="number" id="pass_mark" name="pass_mark" class="form-control" required>
                                    </div>
                                </div>
                                <div class=" col-sm-6">

                                    <div class="form-group">
                                        <label for="">Question Type</label><span class="text-danger">*</span>
                                        <select class="form-control" id="question_type" name="question_type" style="width: 100%;" required>
                                            <option  <?php if($this->uri->segment(3)) { if ($question_details->question_type=='1') { echo "selected"; } }?> value="1">Objective</option>
                                            <option  <?php if($this->uri->segment(3)) { if ($question_details->question_type=='2') { echo "selected"; } }?>  value="2">Subjective</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input class="btn btn-primary px-40"  type="submit" name="importfile" value="Upload" />
                                </div>
                            </div>
                    </form>
                </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('includes/footer'); ?>