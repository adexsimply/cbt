<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<style type="text/css">
  .preloader {
  align-items: center;
  background: rgb(23, 22, 22);opacity:0.8;
  display: flex;
  height: 100vh;
  justify-content: center;
  left: 0;
  position: fixed;
  top: 0;
  transition: opacity 0.9s linear;
  width: 100%;
  z-index: 9999;
}
</style>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Students Pins
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </section>

            <div class="preloader" id="preloader" style="display: none;">
                <img src="<?php echo base_url() ?>assets/images/2.gif" alt="spinner">
            </div>
                <!-- Main content -->
                <section class="content">
                  <div class="row">
                    <div class="col-12">

            <button class="btn btn-social btn-bitbucket mb-5 pull-right" data-toggle="modal" data-target="#modal-classes2">Exempt Class</button>
                      <?php if ($pin_auth_status->status==0){ ?>
                          <button class="btn btn-social btn-google mb-5 pull-left"  type="button" onclick="turn_pin_auth(1)">
                            <i class="fa fa-unlock"></i> PIN Authentication is off - Click to Turn on
                          </button>
                        <?php }
                        else {
                          ?>
                          <button class="btn btn-social btn-dropbox mb-5 pull-left"  type="button" onclick="turn_pin_auth(0)">
                            <i class="fa fa-lock"></i> PIN Authentication on - Click to Turn off
                          </button>
                          <?php
                        }
                         ?>
                          <input type="text" id="count_students" value="<?php echo count($students_list) ?>" hidden name="">
                          <button class="btn btn-social btn-github mb-5 pull-right"  type="button" onclick="send_text_to_all()">
                            <i class="fa fa-envelope"></i> Send PINS as Text
                          </button>&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" id="count_students" value="<?php echo count($students_list) ?>" hidden name="">
                          <button class="btn btn-social btn-github mb-5 pull-right"  type="button" onclick="generate_pins_for_all()">
                            <i class="fa fa-envelope"></i> Generate PINS For All
                          </button>&nbsp;&nbsp;&nbsp;&nbsp;
                          <button class="btn btn-social btn-google mb-5 pull-right"  type="button" onclick="location.href='<?php echo base_url().'pin/logs'; ?>';">
                            <i class="fa fa-history"></i> Pin Log
                          </button>                     
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">List of Students</h3>
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
                          <th>PIN</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              $i_student = 1;
                              foreach ($users_list as $student) { 
                                if ($student->role_id=='3') {
                                ?>
                              <tr>
                                <td><?php echo $i_student; ?></td>
                                <td><?php echo $student->fullname; ?></td>
                                <td><?php if($student->role_id=='3'){  echo $student->student_phone; } else { echo $student->phone; }  ?></td>
                                <td><?php if(!empty ($this->pin_m->get_pin_for_student($student->user_id)->pin)) { echo $this->pin_m->get_pin_for_student($student->user_id)->pin; } ?></td>
                                <td><?php echo $student->username; ?></td>
                                <td><?php echo $student->password; ?></td>
                            <td>
                            <button type="button" class="btn btn-info btn-xs" onclick="generate_pin_for_one('<?php echo $student->user_id; ?>')" data-toggle="modal"  data-target="#modal-student"><i class="fa fa-edit"></i> Change PIN</button>
                            <input type="text" hidden value="<?php if(!empty ($this->pin_m->get_pin_for_student($student->user_id)->pin)) { echo $this->pin_m->get_pin_for_student($student->user_id)->pin; } ?>" id="password2<?php echo $student->user_id; ?>" name="password2">
                            <input type="text" hidden value="<?php echo $student->fullname; ?>" id="fullname<?php echo $student->user_id; ?>" name="fullname">
                            <input type="text" hidden value="<?php echo $student->student_phone; ?>" id="phone2<?php echo $student->user_id; ?>" name="phone2">
                            <button type="button" class="btn btn-bitbucket btn-xs" onclick="send_pin('<?php echo $student->user_id;?>')"><i class="fa fa-inbox"></i> Send PIN</button>
                            
                           </td>
                          </tr>
                            <?php $i_student++;
                            }
                             } ?>
                      </tbody>          
                      <tfoot>
                        <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>PIN</th>
                          <th>Username</th>
                          <th>Password</th>
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

<?php $this->load->view('pins/modal-classes'); ?>
<?php //$this->load->view('users/modal'); ?>
<?php //$this->load->view('users/modal-password'); ?>
<?php $this->load->view('includes/footer'); ?>
  <!-- This is data table -->
  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('pins/script'); ?>