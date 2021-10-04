<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Teachers
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </section>

                <!-- Main content -->
                <section class="content">
                  <div class="row">
                    <div class="col-12">

                          <button class="btn btn-social btn-bitbucket mb-5 pull-right" data-toggle="modal" onclick="clear_textbox()" data-target="#modal-teacher">
                            <i class="fa fa-plus"></i> Add Teacher
                          </button>
                     
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">List of Teachers</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              $i_teacher = 1;
                              foreach ($teachers_list as $teacher) { 
                                //$term_status = $terms->term_status;
                                ?>
                              <tr>
                                <td><?php echo $i_teacher; ?></td>
                                <td><?php echo $teacher->first_name." ".$teacher->last_name; ?></td>
                                <td><?php echo $teacher->phone; ?></td>
                                <td><?php echo $teacher->email; ?></td>
                                <td><?php $subjects = $this->user_m->get_teachers_subjects($teacher->t_id); 
                                foreach ($subjects as $subject){
                                  echo $subject->subject_name." ";
                                }
                                ?></td>
                                <td><?php echo $teacher->username; ?></td>
                                <td><?php echo $teacher->password; ?></td>
                            <td>
                            <button type="button" class="btn btn-info btn-xs" onclick="get_teacher_data(<?php echo $teacher->t_id; ?>)" data-toggle="modal"  data-target="#modal-teacher"><i class="fa fa-edit"></i> Edit</button>
                            <button type="button" class="btn btn-google btn-xs" onclick="delete_user('<?php echo $teacher->t_id; ?>','2')"><i class="fa fa-trash"></i> Delete</button>
                            <button type="button" class="btn btn-dropbox btn-xs" onclick="change_password('<?php echo $teacher->t_id;?>')" data-toggle="modal" data-target="#modal-password"><i class="fa fa-lock"></i> Change Password</button>
                            <input type="text" value="<?php echo $teacher->password; ?>" hidden id="password2<?php echo $teacher->t_id; ?>" name="password2">
                            <input type="text" value="<?php echo $teacher->phone; ?>" hidden id="phone2<?php echo $teacher->t_id; ?>" name="phone2">
                            <input type="text" value="<?php echo $teacher->username; ?>" hidden id="username2<?php echo $teacher->t_id; ?>" name="username2">
                            <button type="button" class="btn btn-bitbucket btn-xs" onclick="send_password('<?php echo $teacher->t_id;?>')"><i class="fa fa-inbox"></i> Send Password</button>
                            <button type="button" class="btn btn-vk btn-xs" onclick="get_teacher_id('<?php echo $teacher->t_id;?>')" data-toggle="modal" data-target="#modal-subject"><i class="fa fa-file"></i> Add Subject</button>
                            <button type="button" class="btn btn-vk btn-xs" onclick="get_teacher_subjects('<?php echo $teacher->t_id;?>')" data-toggle="modal" data-target="#modal-subject-2"><i class="fa fa-file"></i> Remove Subject</button>
                           </td>
                          </tr>
                            <?php $i_teacher++;
                             } ?>
                      </tbody>          
                      <tfoot>
                        <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Username</th>
                          <th>Options</th>
                        </tr>
                      </tfoot>
                    </table>
                    </div>              
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->  
                          
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </section>
                <!-- /.content -->
        </div>

<?php $this->load->view('teacher/modal'); ?>
<?php $this->load->view('teacher/modal-password'); ?>
<?php $this->load->view('teacher/modal-subjects'); ?>
<?php $this->load->view('teacher/modal-subjects-2'); ?>
<?php $this->load->view('includes/footer'); ?>
  <!-- This is data table -->
  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('teacher/script'); ?>