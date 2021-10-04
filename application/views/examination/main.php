<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<style type="text/css">
  .table td, .table th {
    padding: .1rem; 
    font-size: 13px;
}
</style>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Examinations</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="header">
                        <h2>Pending Exams</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">

                                <table id="pendingAssessmentTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                  <thead>
                                    <tr>
                                      <th><input type="checkbox" name=""></th>
                                      <th>S/N</th>
                                      <th>Title</th>
                                      <th>class</th>
                                      <th>Subject</th>
                                      <th>Type</th>
                                      <th>Duration</th>
                                      <th>Status</th>
                                      <th>Auto-Grade</th>
                                      <th>Shuffle</th>
                                      <th>Quest</th>
                                      <th>Date Scheduled</th>
                                      <th>Options</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                          $i_material = 1;
                                          foreach ($assessments_list as $material) { 
                                          //$term_status = $terms->term_status;
                                     ?>
                                     <tr>
                                            <td><input type="checkbox" name=""></td>
                                            <td><?php echo $i_material; ?></td>
                                            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php if (empty($material->file_name)) { echo $material->title; } else { echo $material->file_name;  } ?></td>
                                            <td><?php echo $material->class_name; ?></td>
                                            <td><?php echo $material->subject_name; ?></td>
                                            <td><?php echo $material->exam_type; ?></td>
                                            <td><?php echo $material->duration; ?></td>
                                            <td><div class="custom-control custom-switch"> <input type="checkbox" class="custom-control-input" id="switch1<?php echo $material->exam_id; ?>" <?php if ($material->exam_status =='1') { echo "checked"; } ?> onclick="toggle_status(<?php echo $material->exam_id; ?>)" >  <label class="custom-control-label" for="switch1<?php echo $material->exam_id; ?>"></label></div></td>
                                            <td><div class="custom-control custom-switch"> <input type="checkbox" class="custom-control-input" id="switch2<?php echo $material->exam_id; ?>" <?php if ($material->auto_grade =='1') { echo "checked"; } ?> onclick="toggle_autograde(<?php echo $material->exam_id; ?>)" > <label class="custom-control-label" for="switch2<?php echo $material->exam_id; ?>"></label></div></td>
                                            <td> <div class="custom-control custom-switch"> <input type="checkbox" class="custom-control-input" id="switch3<?php echo $material->exam_id; ?>" <?php if ($material->shuffle =='1') { echo "checked"; } ?> onclick="toggle_shuffle(<?php echo $material->exam_id; ?>)" >  <label class="custom-control-label" for="switch3<?php echo $material->exam_id; ?>"></label></div></td>
                                            <td><?php echo $this->assessment_m->get_total_questions($material->id);  ?></td>
                                            <td><?php $ini_date = date_create($material->date_scheduled); echo date_format($ini_date,"M d,Y h:i a"); ?></td>
                                          <td>
                                            <button class="btn btn-info"  onclick="taken(<?php echo $material->exam_id; ?>)" title="Move to Taken"><i class="fa fa-exchange"></i></button>
                                          <button class="btn btn-primary m-b-15 m-t-15"  onclick="grade_students_dialog(event)" data-type="black" data-size="xl" data-title="Grade Students || <?php echo $material->subject_name.' || '.$material->title.' || '.$material->class_name; ?>" href="<?php echo base_url('examination/grade_students/' . $material->exam_id) ?>"><i class="fa fa-check"></i></button>
                                          <?php if ($active_user->role_id == 2 || $active_user->role_id == 1) { ?>
                                          <button class="btn btn-outline-success" title="Schedule" onclick="schedule_dialog(event)" data-type="black" data-size="m" data-title="Edit Schedule Exam - <?php echo $material->title; ?>" href="<?php echo base_url('assessment/schedule_exam/edit/' . $material->exam_id) ?>"><i class="icon-note"></i></button>
                                          <button class="btn btn-success m-b-15 m-t-15" onclick="delete_exam(<?php echo $material->exam_id; ?>)"><i class="fa fa-trash"></i></button></td>
                                        <?php } ?>
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
<?php $this->load->view('examination/script'); ?>