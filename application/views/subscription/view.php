<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>   <!-- Content Wrapper. Contains page content -->
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
                      
<?php 
//var_dump($subscription_list);


//echo $this->uri->segment(3);

?>    
            <button class="btn btn-social btn-bitbucket mb-5 pull-right" data-toggle="modal" data-target="#modal-classes">Filter by class</button> 
            <a class="btn btn-social btn-bitbucket mb-5" href="<?php echo base_url().'subscription/view/class2/'.$this->uri->segment(4); ?>">View others</a>
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
                          <!-- <th>Phone</th> -->
                          <?php if($this->uri->segment(3)!='class2') { ?>
                          <th>Subscription Starts</th>
                          <th>Subscription Ends</th>
                          <?php }?>
                          <th>Phone</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              $i_student = 1;
                              foreach ($subscription_list as $student) { 
                                //var_dump($student)
                                ?>
                              <tr>
                                <td><?php echo $i_student; ?></td>
                                <td><?php $fullname = $this->user_m->get_student_by_id2($student['user_id']); echo $fullname->fullname; ?></td>
                                <!-- <td><?php echo $student['user_id'];  ?></td> -->
                                 <?php if($this->uri->segment(3)!='class2') { ?>
                                <td><?php $ini_date = date_create($student['start_date']); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                                <td><?php $ini_date = date_create($student['end_date']); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                                <?php }?>
                                <td><?php if(isset($student['phone'])) { echo $student['phone'];} ?></td>
                            <td>
                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" onclick="get_student_id('<?php echo $student['user_id']; ?>')"  data-target="#modal-duration"><i class="fa fa-edit"></i> Add Plan</button>
                            
                           </td>
                          </tr>
                            <?php $i_student++;
                             } ?>
                      </tbody>          
                      <tfoot>
                        <tr>
                          <th>S/N</th>
                          <th>Name</th>
                         <!--  <th>Phone</th> -->
                          <th>PIN</th>
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