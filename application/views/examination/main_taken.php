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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Taken Examinations</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="header">
                        <h2>Taken Exams</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <?php if ($active_user->role_id == 1) { ?>
                        <button class="btn btn-danger"><i class="icon-trash"></i> Delete Selected</button>
                      <?php } ?>
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">
                                <table id="takenAssessmentTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                  <thead class="thead-dark">
                                    <tr>
                                      <th><input type="checkbox" name=""></th>
                                      <th>S/N</th>
                                      <th>Title</th>
                                      <th>class</th>
                                      <th>Subject</th>
                                      <th>Type</th>
                                      <th style="word-wrap: break-word;min-width: 5px;max-width: 50px;white-space:normal;">Duration</th>
                                      <th style="word-wrap: break-word;min-width: 5px;max-width: 30px;white-space:normal;">Ques</th>
                                      <th>Date Scheduled</th>
                                      <th>Options</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                          $i_material = 1;
                                          foreach ($assessments_list as $material) { 
                                          //$term_status = $terms->term_status;
                                           //var_dump($material);
                                     ?>
                                     <tr>
                                            <td><input type="checkbox" name=""></td>
                                            <td><?php echo $i_material; ?></td>
                                            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php if (empty($material->file_name)) { echo $material->title; } else { echo $material->file_name;  } ?></td>
                                            <td><?php echo $material->class_name; ?></td>
                                            <td style="word-wrap: break-word;min-width: 120px;max-width: 120px;white-space:normal;"><?php echo $material->subject_name; ?></td>
                                            <td style="word-wrap: break-word;min-width: 100px;max-width: 160px;white-space:normal;"><?php echo $material->exam_type; ?></td>
                                            <td style="word-wrap: break-word;min-width: 0px;max-width: 10px;white-space:normal;"><?php echo $material->duration; ?></td>
                                            <td style="word-wrap: break-word;min-width: 0px;max-width: 10px;white-space:normal;"><?php echo $this->assessment_m->get_total_questions($material->id);  ?></td>
                                            <td style="word-wrap: break-word;min-width: 0px;max-width: 10px;white-space:normal;"><?php $ini_date = date_create($material->date_scheduled); echo date_format($ini_date,"M d,Y h:i a"); ?></td>
                                          <td>
                                          <?php if ($active_user->role_id == 1) { ?>
                                            <button class="btn btn-dark"  onclick="pending(<?php echo $material->exam_id; ?>)" title="Move to Pending"><i class="fa fa-times-circle"></i></button>
                                          <button class="btn btn-outline-success" title="Schedule" onclick="schedule_dialog(event)" data-type="black" data-size="m" data-title="Edit Schedule Exam - <?php echo $material->title; ?>" href="<?php echo base_url('assessment/schedule_exam/edit/' . $material->exam_id) ?>"><i class="icon-note"></i></button>
                                          <button class="btn btn-success m-b-15 m-t-15" onclick="delete_exam(<?php echo $material->exam_id; ?>)"><i class="fa fa-trash"></i></button>
                                         <!--   <a href="<?php echo base_url('examination/print_result/' . $material->exam_id) ?>">
                                         <button class="btn btn-info m-b-15 m-t-15" onclick="print_result(<?php echo $material->exam_id; ?>)"><i class="fa fa-print"></i></button></a>  -->  
                                          <button class="btn btn-<?php if ($material->show_results=='0') { echo 'outline-danger'; } else { echo 'outline-secondary'; } ?> m-b-15 m-t-15" onclick="toggle_result_view(<?php echo $material->exam_id.",".$material->show_results; ?>)" title="<?php if ($material->show_results=='0') { echo 'Show Results'; } else { echo 'Hide Results'; } ?>"><i class="fa fa-<?php if ($material->show_results=='0') { echo 'eye-slash'; } else { echo 'eye'; } ?>"></i></button>
                                        <?php } 
                                        if ($active_user->role_id == 2 || $active_user->role_id == 1) {
                                         ?>
                                         <button class="btn btn-info m-b-15 m-t-15" onclick="print_dialog(event)" href="<?php echo base_url('examination/print_students_result/' .$material->exam_id.'/'.$material->class_system_id) ?>"><i class="fa fa-print"></i></button></a>
                                          <button class="btn btn-primary m-b-15 m-t-15"  onclick="grade_students_dialog(event)" data-classid="<?php echo $material->class_id; ?>" data-type="black" data-size="xl" data-title="Grade Students || <?php echo $material->subject_name.' || '.$material->title.' || '.$material->class_name; ?>" href="<?php echo base_url('examination/grade_students/' . $material->exam_id) ?>"><i class="fa fa-check"></i></button>
                                        </td>
                                        <?php 
                                          }
                                         ?>
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