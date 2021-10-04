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
                          <button class="btn btn-social btn-bitbucket mb-5 pull-right" data-toggle="modal" data-target="#modal-fee">
                            <i class="fa fa-plus"></i> Add Fee
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
                          <th>Class</th>
                          <th>Amount</th>
                          <th>Duration</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              $i_student = 1;
                              foreach ($fees_list as $student) { 
                                ?>
                              <tr>
                                <td><?php echo $i_student; ?></td>
                                <td><?php echo $student->class_name; ?></td>
                                <td><?php echo $student->amount; ?></td>
                                <td><?php echo $student->duration; ?> days</td>
                            <td>
                            <button type="button" class="btn btn-google btn-xs" onclick="delete_fee('<?php echo $student->id; ?>')"><i class="fa fa-trash"></i> Delete</button>
                           </td>
                          </tr>
                            <?php $i_student++;
                             } ?>
                      </tbody>          
                      <tfoot>
                        <tr>
                          <th>S/N</th>
                          <th>Class</th>
                          <th>Amount</th>
                          <th>Duration</th>
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

<?php $this->load->view('fee/modal-fee'); ?>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('fee/script'); ?>
  <!-- This is data table -->
  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>