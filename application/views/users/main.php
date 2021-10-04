<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Users</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">
                          <button class="btn btn-secondary  m-b-15" data-toggle="modal" onclick="clear_textbox()" data-target="#modal-user">
                            <i class="fa fa-plus"></i> Add User
                          </button>
              </div>
                <div class="card patients-list">
                    <div class="header">
                        <h2>List of Users</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">

                                <table id="usersTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                    <thead>
                                      <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Options</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i_student = 1;
                                            foreach ($users_list as $student) { 
                                              ?>
                                            <tr>
                                              <td><?php echo $i_student; ?></td>
                                              <td><?php if($student->role_id=='2'){ echo $student->first_name." ".$student->last_name;} else { echo $student->fullname;} ?></td>
                                              <td><?php if($student->role_id=='3'){  echo $student->student_phone; } else { echo $student->phone; }  ?></td>
                                              <td><?php echo $student->role_name; ?></td>
                                              <td><?php echo $student->username; ?></td>
                                              <td><?php echo $student->password; ?></td>
                                          <td>
                                         <!--  <button type="button" class="btn btn-info btn-xs" disabled><i class="fa fa-edit"></i> Edit</button> -->
                                          <button type="button" class="btn btn-danger btn-xs" onclick="delete_user('<?php echo $student->user_id; ?>','<?php echo $student->role_id; ?>')"><i class="fa fa-trash"></i> Delete</button>
                                          
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('users/modal'); ?>
<?php $this->load->view('users/modal-password'); ?>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('users/script'); ?>