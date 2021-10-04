<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Students
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </section>
            <?php //var_dump($class_list1); ?>

                <!-- Main content -->
                <section class="content">
                  <div class="row">
                    <div class="col-12">
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <button class="btn btn-social btn-bitbucket mb-5 pull-right" data-toggle="modal" onclick="clear_textbox()" data-target="#modal-student">
                            <i class="fa fa-plus"></i> Add Student
                          </button>&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" id="count_students" value="<?php echo count($students_list) ?>" hidden name="">
                          <button class="btn btn-social btn-github mb-5 pull-right"  type="button" onclick="send_text_to_all()">
                            <i class="fa fa-envelope"></i> Send Password as Text
                          </button>&nbsp;&nbsp;&nbsp;&nbsp;
                     
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">List of Students</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="table-responsive">
                              <!--  <div id="responsecontainer"></div> -->
                              <table  id="employeeListing" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                              <thead>
                                <tr>
                                  <th>S/N</th>
                                  <th>Name</th>
                                  <th>Phone</th>
                                  <th>School</th>
                                  <th>Class</th>
                                  <th>Class-Arm</th>
                                  <th>Username</th>
                                  <th>Options</th>
                                </tr>
                              </thead>
                              <tbody id="listRecords">
                              </tbody>
                            </table>
                          </div>
                    <div class="table-responsive">
                      <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Class</th>
                          <th>Username</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              $i_student = 1;
                              foreach ($students_list as $student) { 
                                  //$term_status = $terms->term_status;
                                  if ($student->class_group_id==1) {
                                    $class_group = "CSMT";
                                  }
                                  else {
                                    $class_group = "Others";
                                  }
                                ?>
                              <tr>
                                <td><?php echo $i_student; ?></td>
                                <td><?php echo $student->fullname; ?></td>
                                <td><?php echo $student->phone; ?></td>
                                <td><?php echo $student->class_name; ?></td>
                                <td><?php echo $student->username; ?></td>
                            <td>
                            <button type="button" class="btn btn-info btn-xs" onclick="get_student_data(<?php echo $student->s_id; ?>)" data-toggle="modal"  data-target="#modal-student"><i class="fa fa-edit"></i> Edit</button>
                            <button type="button" class="btn btn-google btn-xs" onclick="delete_user('<?php echo $student->s_id; ?>','<?php echo $student->role_id; ?>')"><i class="fa fa-trash"></i> Delete</button>
                            <button type="button" class="btn btn-dropbox btn-xs" onclick="change_password('<?php echo $student->s_id;?>')" data-toggle="modal" data-target="#modal-password"><i class="fa fa-lock"></i> Change Password</button>
                            <input type="text" value="<?php echo $student->password; ?>" hidden id="password2<?php echo $student->s_id; ?>" name="password2">
                            <input type="text" value="<?php echo $student->phone; ?>" hidden id="phone2<?php echo $student->s_id; ?>" name="phone2">
                            <input type="text" value="<?php echo $student->username; ?>" hidden id="username2<?php echo $student->s_id; ?>" name="username2">
                            <button type="button" class="btn btn-bitbucket btn-xs" onclick="send_password('<?php echo $student->s_id;?>')"><i class="fa fa-inbox"></i> Send Password</button>
                            <button type="button" class="btn btn-vk btn-xs" onclick="add_class('<?php echo $student->s_id;?>')" data-toggle="modal" data-target="#modal-classes"><i class="fa fa-file"></i> Add Class</button>
                           </td>
                          </tr>
                            <?php $i_student++;
                             } ?>
                      </tbody>          
                      <tfoot>
                        <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Class</th>
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

<?php $this->load->view('student/modal'); ?>
<?php $this->load->view('student/modal-classes'); ?>
<?php $this->load->view('student/modal-password'); ?>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('student/script'); ?>
  <!-- This is data table -->
  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>