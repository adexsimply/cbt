<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View Assignments
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.html"><i class="fa fa-user"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="teachers_dashboard.html"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item active">View Assignments</li>
                </ol>
            </section>
             <?php if ($active_user->role_id == 1){ ?>
            <button class="btn btn-social btn-bitbucket mb-5 pull-right" data-toggle="modal" data-target="#modal-classes">Filter by class</button>
            <?php } ?>
            <!-- Main content -->
            <section class="content">
                <div class="box-body">
                  <div class="table-responsive">
                   <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>title</th>
                          <th>class</th>
                          <th>Subject</th>
                          <?php if($active_user->role_id ==3) { ?>
                            <td><strong>Score</strong></td>
                          <?php } ?>
                          <td>M/A</td>
                          <th>Date Added</th>
                          <th>Attachment</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              $i_material = 1;
                              foreach ($assignments_list as $assignment) { 
                                //$term_status = $terms->term_status;
                                if ($active_user->role_id==3) {

                                if (!empty($assignment->attachment_admin)) {
                                ?>
                              <tr>
                                <td><?php echo $i_material; ?></td>
                                <td><?php echo $assignment->assignment_title; ?></td>
                                <td><?php echo $assignment->class_name; ?></td>
                                <td><?php echo $assignment->subject_name; ?></td>
                                <?php if($active_user->role_id ==3) { ?>
                                  <td><strong><b style="color:black;font-size: 17px;"><?php if(!empty($this->assignment_m->get_assignment_grade_for_student_single($assignment->id)->grade)) { echo $this->assignment_m->get_assignment_grade_for_student_single($assignment->id)->grade; } ?></b></strong></td>
                                <?php } ?>
                                <td><?php echo $assignment->mark_attainable ?></td>
                                <td><?php $ini_date = date_create($assignment->date_created); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                                <td><?php if (!is_null($assignment->attachment)) { echo "Yes"; }  ?></td>
                            <td>
                            <a href="<?php echo base_url().'assignment/view/'.$assignment->id; ?>"><button class="btn btn-social btn-vk btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View More </button></a>
                            <?php if ($active_user->role_id == 3) { ?>
                            <a href="<?php echo base_url().'assignment/submit/'.$assignment->id; ?>"><button class="btn btn-social btn-dropbox btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-check"></i>Answer</button></a>
                            <?php if(!empty($this->assignment_m->get_assignment_grade_for_student_single($assignment->id)->grade)) {?>
                            <a href="<?php echo base_url().'assignment/grade/'.$assignment->id.'/'.$active_user->id; ?>"><button class="btn btn-social btn-dropbox btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-check"></i>Grade & Attachments</button></a>
                          <?php } 
                        } ?>
                            <?php if ($active_user->role_id == 2) { ?>
                            <a href="<?php echo base_url().'assignment/submissions/'.$assignment->id; ?>"><button class="btn btn-social btn-dropbox btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View Submissions</button></a>
                          <?php } ?>
                           </td>
                          </tr>
                            <?php $i_material++;
                          }
                        }
                        else {
                          ?><tr>
                                <td><?php echo $i_material; ?></td>
                                <td><?php echo $assignment->assignment_title; ?></td>
                                <td><?php echo $assignment->class_name; ?></td>
                                <td><?php echo $assignment->subject_name; ?></td>
                                <td><?php echo $assignment->mark_attainable ?></td>
                                <td><?php $ini_date = date_create($assignment->date_created); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                                <td><?php if (!is_null($assignment->attachment)) { echo "Yes"; }  ?></td>
                            <td>
                            <a href="<?php echo base_url().'assignment/view/'.$assignment->id; ?>"><button class="btn btn-social btn-vk btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View More </button></a>
                            <?php if ($active_user->role_id == 3) { ?>
                            <a href="<?php echo base_url().'assignment/submit/'.$assignment->id; ?>"><button class="btn btn-social btn-dropbox btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-check"></i>Answer</button></a>
                          <?php } ?>
                            <?php if ($active_user->role_id != 3) { ?>
                            <a href="<?php echo base_url().'assignment/submissions/'.$assignment->id; ?>"><button class="btn btn-social btn-dropbox btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View Submissions</button></a>
                          <?php } ?>

                            <?php
                            if ($active_user->role_id !=3) {

                             ?>
                            <button class="btn btn-social btn-danger btn-xs" data-toggle="modal" data-target="#modal-class" onclick="delete_assignment(<?php echo $assignment->id; ?>)"><i class="fa fa-trash"></i>Delete </button>
                             <?php
                            }
                            if ($active_user->role_id ==1) {
                              if ($this->uri->segment(3)!='old') {
                             ?>
                            <a href="<?php echo base_url().'assignment/upload/'.$assignment->id; ?>"><button class="btn btn-social btn-dropbox btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-file"></i>Upload </button></a>
                            <?php
                            }
                            ?><button class="btn btn-social btn-google btn-xs" onclick="archive_assignment(<?php echo $assignment->id; ?>)"><i class="fa fa-archive"></i>Archive </button>
                            <a href="<?php echo base_url().'assignment/view_students/'.$assignment->id; ?>">
                            <button class="btn btn-social btn-info btn-xs"><i class="fa fa-eye"></i>View Students </button>
                            </a>
                            <?php

                          }
                            ?>
                           </td>
                          </tr>
                            <?php $i_material++;
                        }
                             } ?>
                      </tbody>   
                    </table>
                  </div>
            </div>

            </section>

<?php $this->load->view('assignment/modal-classes'); ?>
<?php $this->load->view('includes/footer'); ?>  <!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('assignment/script'); ?>