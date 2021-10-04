<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View Quiz Submissions
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.html"><i class="fa fa-user"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="teachers_dashboard.html"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item active">View Quiz</li>
                </ol>
            </section>
            <?php //var_dump($assignment_solution1); ?>
            <!-- Main content -->
            <section class="content">
                <div class="row fx-element-overlay">
                   <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Fullname</th>
                          <th>Grade</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              $i_material = 1;
                              foreach ($submitted_students as $student) { 
                                //$term_status = $terms->term_status;
                                ?>
                              <tr>
                                <td><?php echo $i_material; ?></td>
                                <td><?php echo $this->user_m->get_student_fullname($student->student_id)->fullname; ?></td>
                                <td><?php echo count($this->assessment_m->get_assessment_grade_for_teacher($this->uri->segment(3),$student->student_id)); ?></td>
                            <td>
                          <?php if ($active_user->role_id != 3) { ?>
                            <a href="<?php echo base_url().'assessment/view_questions2/'.$student->student_id.'/'.$this->uri->segment(3);?>"><button class="btn btn-social btn-dropbox mb-5" data-toggle="modal" data-target="#modal-class"><i class="fa fa-check"></i>Corrections</button></a> 
                            <a href="<?php echo base_url().'assessment/reset/'.$student->student_id.'/'.$this->uri->segment(3);?>"><button class="btn btn-social btn-google mb-5" data-toggle="modal" data-target="#modal-class"><i class="fa fa-check"></i>Reset</button></a>
                          <?php } ?>
                           </td>
                          </tr>
                            <?php $i_material++;
                             } ?>
                      </tbody> 
                    </table>

                </div>

            </section>

<?php $this->load->view('includes/footer'); ?>  <!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>