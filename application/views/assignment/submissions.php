<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View Assignment Submissions
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.html"><i class="fa fa-user"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="teachers_dashboard.html"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item active">View Assignments</li>
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
                              foreach ($assignment_solution1 as $assignment) { 
                                //$term_status = $terms->term_status;
                                ?>
                              <tr>
                                <td><?php echo $i_material; ?></td>
                                <td><?php echo $assignment->fullname; ?></td>
                                <td><?php if (!empty($this->assignment_m->get_assignment_grade($this->assignment_m->get_assignment_answer_id($this->uri->segment(3),$assignment->student_id)->id)->grade)){ echo  $this->assignment_m->get_assignment_grade($this->assignment_m->get_assignment_answer_id($this->uri->segment(3),$assignment->student_id)->id)->grade; } else echo "Not Graded Yet"; ?></td>
                            <td>
                            <!-- <a href="<?php echo base_url().'assignment/view/'.$this->uri->segment(3).'/'.$assignment->student_id; ?>"><button class="btn btn-social btn-vk mb-5" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View More </button></a>
 -->                            <?php if ($active_user->role_id != 3) { ?>
                            <a href="<?php echo base_url().'assignment/grade/'.$this->uri->segment(3).'/'.$assignment->student_id; ?>"><button class="btn btn-social btn-dropbox mb-5" data-toggle="modal" data-target="#modal-class"><i class="fa fa-check"></i>Grade</button></a>
                          <?php } ?>
                           </td>
                          </tr>
                            <?php $i_material++;
                             } ?>
                      </tbody> 
                    </table>

                </div>

            </section>

<?php $this->load->view('users/modal'); ?>
<?php $this->load->view('users/modal-password'); ?>
<?php $this->load->view('includes/footer'); ?>  <!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('users/script'); ?>