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
                             <table id="" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Subject</th>
                                      <th>Exam</th>
                                      <th>Questions</th>
                                      <th>Score</th>
                                      <th>Date</th>
                                      <th>Option</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                          $i_material = 1;
                                          foreach ($exam_list as $material) { 
                                            //$term_status = $terms->term_status;
                                            ?>
                                          <tr>
                                            <td><?php echo $i_material; ?></td>
                                            <td><?php echo $material->subject_name; ?></td>
                                            <td><?php echo $material->title; ?></td>
                                            <td><?php echo count($this->assessment_m->get_questions_by_id($material->exam_id));  ?> </td>
                                            <td> <?php  
                                                   $question_details = $this->examination_m->get_question_details($material->exam_id);
                                                   $mark_per_quest = $question_details->mark_per_question;
                                                   $pass_mark = $question_details->pass_mark;
                                                   $total_score = $mark_per_quest * $this->examination_m->get_score_by_student_id2($material->exam_id);
                                                   echo $total_score.'/';
                                                   echo count($this->assessment_m->get_questions_by_id($material->exam_id))*$mark_per_quest;
                                                   if ($total_score < $pass_mark ) {
                                                    echo " (Fail)";
                                                   }
                                                   else {
                                                    echo " (Pass)";
                                                   }?>
                                            </td>
                                            <td><?php echo $material->date_scheduled; ?></td>
                                            <td><a href="<?php echo base_url(); ?>assessment/correction/<?php echo $material->exam_id.'/'.$active_user->id; ?>"><button class="btn btn-info">Correction</button></td>
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