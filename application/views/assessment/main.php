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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Uploaded Exams</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">
                  <?php if ($active_user->role_id == 1){ 
                  if ($this->uri->segment(2) !='archive'){

                    ?>
                <button class="btn btn-warning" data-toggle="modal" data-target="#modal-classes2">Filter by class</button>
              <?php } }?>&nbsp;&nbsp;
                  <a href="<?php echo base_url().'assessment/import'; ?>"><button class="btn btn-info" data-toggle="modal" data-target="#modal-student">
                    <i class="fa fa-plus"></i> Create & Upload Questions
                  </button></a>&nbsp;&nbsp
                  
                  <a href="<?php echo base_url().'assessment/add_questions'; ?>"><button class="btn btn-primary" data-toggle="modal" data-target="#modal-student">
                    <i class="fa fa-plus"></i> Create & Type Questions
                  </button></a>
              </div>
                <div class="card patients-list">
                    <div class="header">
                        <h2>View Questions</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">

                                <table id="assessmentTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Title</th>
                                      <th>File</th>
                                      <th>class</th>
                                      <th>Subject</th>
                                      <th>Type</th>
                                      <th>Quest</th>
                                      <th>mark</th>
                                      <th>Date Added</th>
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
                                            <td><?php echo $i_material; ?></td>
                                            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php echo $material->title; ?></td>
                                            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php echo $material->file_name; ?></td>
                                            <td><?php echo $material->class_name; ?></td>
                                            <td><?php echo $material->subject_name; ?></td>
                                            <td><?php if($material->question_type ==1) { echo "Objective"; } else { echo "Subjective"; } ?></td>
                                            <td><?php echo $this->assessment_m->get_total_questions($material->id);  ?></td>
                                            <td><?php echo round($material->mark_per_question,2); ?></td>
                                            <td><?php $ini_date = date_create($material->date_created); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                                        <td>
                                        <a href="<?php echo base_url().'assessment/view_questions/'.$material->id; ?>"><button class="btn btn-info" data-toggle="modal" data-target="#modal-class" title="View Questions"><i class="fa fa-eye"></i></button></a>
                                        <?php if ($active_user->role_id == 2 || $active_user->role_id == 1) { ?>
                                        <button class="btn btn-outline-info" title="Schedule" onclick="schedule_dialog(event)" data-type="black" data-size="m" data-title="Schedule Exam - <?php echo $material->title; ?>" href="<?php echo base_url('assessment/schedule_exam/' . $material->id) ?>"><i class="icon-clock"></i></button>
                                        <button class="btn btn-success m-b-15 m-t-15" onclick="delete_question_main(<?php echo $material->id; ?>)"><i class="fa fa-trash"></i></button>
                                        <a href="<?php echo base_url().'assessment/edit/'.$material->id; ?>">
                                        <button class="btn btn-secondary m-b-15 m-t-15"><i class="fa fa-edit"></i></button></a>
                                      </td>
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
<?php $this->load->view('assessment/modal-classes'); ?>
<?php $this->load->view('assessment/script'); ?>