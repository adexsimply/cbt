<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Examination Timetable</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">
              </div>
                <div class="card patients-list">
                    <div class="header">
                        <h2>Examinations</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">

                              <table id="employeeListing" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">

                                <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                  <tr>
                                    <th>S/N</th>
                                    <th>Subject</th>
                                    <th>Exam Type</th>
                                    <th>duration</th>
                                    <th>class</th>
                                    <th>Questions</th>
                                    <?php if($active_user->role_id==3) { ?>
                                      <th>Score</th>
                                    <?php } ?>
                                    <th>Date Added</th>
                                    <th>Options</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                        $i_material = 1;
                                        foreach ($assessments_list as $material) { 
                                          ?>
                                        <tr>
                                          <td><?php echo $i_material.$material->id; ?></td>
                                          <td><?php echo $material->subject_name; ?></td>
                                          <td><?php echo $material->title; ?></td>
                                          <td><?php echo $material->duration; ?></td>
                                          <td><?php echo $material->class_name; ?></td>
                                          <td><?php echo count($this->assessment_m->get_questions_by_id($material->exam_id));  ?></td>
                                        <?php if($active_user->role_id==3) { ?>
                                          <th><?php echo count($this->assessment_m->get_assessment_grade_for_student($material->exam_id)); ?></th>
                                        <?php } ?>
                                          <td><?php $ini_date = date_create($material->date_created); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                                      <td>
                                           <?php if($active_user->role_id!=3) { 

                                           ?>
                                      <a href="<?php echo base_url().'assessment/view_questions/'.$material->id; ?>"><button class="btn btn-social btn-vk mb-5" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View Questions </button></a>
                                  <?php } ?>
                                  <?php if ($active_user->role_id==3) { 
                                      if  (empty($this->assessment_m->get_assessment_grade_for_student2($material->id))) {
                                        ///Check if current Exam is in progress 
                                        if (empty($this->assessment_m->check_if_exam_in_progress($material->id))) {
                                          // check if student has any ongoing exam
                                           if (empty($this->assessment_m->check_if_exam_in_progress_for_student())) {
                                      ?>
                                      <!-- If no ongoing exam button is enabled -->
                                        <button class="btn btn-secondary" onclick="start_exam(<?php echo $material->exam_id; ?>)"><i class="fa fa-eye"></i> Start Exam</button>

                                      <?php 
                                           } 
                                           else {
                                            ?>

                                        <button class="btn btn-warning" disabled=""><i class="fa fa-pause"></i> You have an ongoing exam</button>
                                            <?php
                                           }

                                         } else {
                                        ?>
                                        <!-- <button class="btn btn-info" onclick="continue_exam()" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i> This Exam is in Progress</button> -->
                                        <button class="btn btn-info" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i> This Exam is in Progress. Contact Admin</button>
                                        <?php 

                                       }

                                        } else { echo "<button class='btn btn-success' disabled><i class='fa fa-check-square-o'></i> You have taken this Exam</button>";} ?>
                                      <?php

                                    } ?>
                                      <?php if ($active_user->role_id == 2 || $active_user->role_id == 1) { ?>
                                      <a href="<?php echo base_url().'assessment/submissions/'.$material->id; ?>"><button class="btn btn-social btn-google mb-5" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View Grades</button></a>
                                    <?php } ?>
                                      <?php
                                      if ($active_user->role_id ==1) {

                                       ?>
                                      <a href="<?php echo base_url().'material/upload/'.$material->id; ?>"><button class="btn btn-social btn-dropbox mb-5" data-toggle="modal" data-target="#modal-class"><i class="fa fa-file"></i>Upload </button></a>
                                       <?php
                                      }
                                       ?>
                                     </td>
                                    </tr>
                                      <?php $i_material++;
                                  }
                                    ?>
                                </tbody>    
                              </table>
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