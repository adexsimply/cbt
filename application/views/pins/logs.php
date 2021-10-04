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
                          <th>PIN</th>
                          <th>Date Used</th>
                          <th>Time Elapsed</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              $i_student = 1;
                              foreach ($pin_list as $pin) { 
                                //if ($student->role_id=='3') {
                                ?>
                              <tr>
                                <td><?php echo $i_student; ?></td>
                                <td><?php echo $pin->fullname; ?></td>
                                <td><?php echo $pin->pin; ?></td>
                                <td><?php echo $pin->date_used; ?></td>
                                <td><?php echo $this->pin_m->time_elapsed_string($pin->date_used,true); ?></td>
                          </tr>
                            <?php $i_student++;
                          //  }
                             } ?>
                      </tbody>    
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