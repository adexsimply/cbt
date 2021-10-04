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
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">
                             <h3> <?php 
                             $question_details = $this->examination_m->get_question_details($this->uri->segment(3));
                             $mark_per_quest = $question_details->mark_per_question;
                             $pass_mark = $question_details->pass_mark;
                             $total_score = $mark_per_quest * $this->examination_m->get_score_by_student_id2($this->uri->segment(3));
                             echo $total_score.'/';
                             echo count($this->assessment_m->get_questions_by_id($this->uri->segment(3)))*$mark_per_quest;
                             if ($total_score < $pass_mark ) {
                              echo " (Fail)";
                             }
                             else {
                              echo " (Pass)";
                             }

                            // echo $this->examination_m->get_score_by_student_id2($this->uri->segment(3)); ?></h3>
                               <!--  <table id="" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th><input type="checkbox" id="basic_checkbox_0" name="check_all" value="0" /><label for="basic_checkbox_0">All</label></th>
                                    <th>S/N</th>
                                    <th>Question</th>
                                    <th>Correct Answer</th>
                                    <th>My Option</th>
                                    <th>Key</th>
                                    <?php if ($active_user->id==1) { ?>
                                    <th>Delete</th>
                                    <?php } ?>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                        $i_material = 1;
                                        foreach ($assessment_grade as $material) { 
                                          ?>
                                        <tr>
                                          <td> <input type="checkbox" id="answer_id<?php echo $material->id; ?>" class="filled-in" name="answer_id[]" value="<?php echo $material->id; ?>" /><label for="answer_id<?php echo $material->id; ?>"></label></td>
                                          <td><?php echo $i_material; ?></td>
                                          <td><?php echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->question; ?></td>
                                          <td><?php $correct = $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->answer; 
                                          if ($correct == 1) {
                                              echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option1;
                                          }
                                          elseif ($correct == 2) {
                                              echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option2;
                                          }
                                          elseif ($correct == 3) {
                                              echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option3;
                                          }
                                          elseif ($correct == 4) {
                                              echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option4;
                                          }
                                          ?></td>
                                          <td><?php $mine = $material->answer; 
                                             if ($mine == 1) {
                                              echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option1;
                                          }
                                          elseif ($mine == 2) {
                                              echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option2;
                                          }
                                          elseif ($mine == 3) {
                                              echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option3;
                                          }
                                          elseif ($mine == 4) {
                                              echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option4;
                                          }
                                          ?></td>
                                          <td>
                                              <?php
                                              if ($mine == $correct) {
                                                  echo "<font color=green>Correct</font>";

                                              }
                                              else {

                                                  echo "<font color=red>Wrong</font>";
                                              }

                                               ?>
                                          </td>
                                          <td><?php if($active_user->role_id==1){ ?>
                                            <button onclick="delete_answer(<?php echo $material->id; ?>)">Delete<?php //echo $material->id; ?></button></td>
                                         <?php } ?>
                                    </tr>
                                      <?php $i_material++;
                                    }
                                    ?>
                                </tbody>       
                              </table>
                              <?php if($active_user->role_id==1) { ?>
                                      <button type="submit" class="btn btn-success pull-right" id="submited" onclick="disablebutton()">Delete Batch</button>
                                    <?php } ?> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('includes/footer'); ?> 
<!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
<!-- Qixa Admin for Data Table -->
<script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<script type="text/javascript">
  
  ///Func
$(document).ready(function(){
  //if ($("#basic_checkbox_0").click()) {
    //$('input:checkbox').prop('checked', this.checked);  
    $('#basic_checkbox_0').on('click',function(){
        if(this.checked){
            $('.filled-in').each(function(){
                this.checked = true;
            });
        }else{
             $('.filled-in').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.filled-in').on('click',function(){
        if($('.checkbox:checked').length == $('.filled-in').length){
            $('#basic_checkbox_0').prop('checked',true);
        }else{
            $('#basic_checkbox_0').prop('checked',false);
        }
    });


 // }

})

        function delete_answer(id) {
          swal({   
            title: "Are you sure want to delete this Answer?",   
            text: "Deleted data can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }).then( function() {
            $.post("<?php echo base_url('assessment/delete_answer'); ?>", {id : id}).done(function(data) {
             location.reload();
            });
          });
        }

</script>