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
                    Students Subscriptions
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
                      
            <button class="btn btn-social btn-bitbucket mb-5 pull-right" data-toggle="modal" data-target="#modal-classes">Filter by class</button>
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">List of Students</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="table-responsive">
                              <!--  <div id="responsecontainer"></div> -->
                              <table  id="studentsListing" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                              <thead>
                                <tr>
                                  <th>S/N</th>
                                  <th>Name</th>
                                  <th>Phone</th>
                                  <th>Subscription</th>
                                  <th>Username</th>
                                  <th>Password</th>
                                  <th>Options</th>
                                </tr>
                              </thead>
                              <tbody id="listStudents">
                              </tbody>
                            </table>
                          </div>
                 <!--    <div class="table-responsive">
                      <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Subscription</th>
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
                                <td><?php if(!empty ($this->fee_m->get_subscription_for_student($student->user_id)->end_date)) { $ini_date = date_create($this->fee_m->get_subscription_for_student($student->user_id)->end_date); echo date_format($ini_date,"D M d,Y h:i a")."&nbsp;<i style='color:red' onclick='delete_sub(".$this->fee_m->get_subscription_for_student($student->user_id)->id.")' class='fa fa-trash'>"; } ?></td>
                                <td><?php echo $student->username; ?></td>
                                <td><?php echo $student->password; ?></td>
                            <td>
                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" onclick="get_student_id('<?php echo $student->user_id; ?>')"  data-target="#modal-duration"><i class="fa fa-edit"></i> Add Plan</button>
                            
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
                    </div>   -->            
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

<?php $this->load->view('subscription/modal-classes'); ?>
<?php $this->load->view('subscription/modal-duration'); ?>
<?php //$this->load->view('users/modal'); ?>
<?php //$this->load->view('users/modal-password'); ?>
<?php $this->load->view('includes/footer'); ?>
  <!-- This is data table -->
  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('subscription/script'); ?>