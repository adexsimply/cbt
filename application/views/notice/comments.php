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
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </section>
                <!-- Main content -->
                <section class="content">
                  <div class="row">
                    <div class="col-12">
                     
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">List of Comments</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Comment</th>
                          <th>Comment Type</th>
                          <th>User</th>
                          <th>Date</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              $i_student = 1;
                              foreach ($comments as $comment) { 
                                ?>
                              <tr>
                                <td><?php echo $i_student; ?></td>
                                <td><?php echo $comment->comment_body; ?></td>
                                <td><?php echo $comment->item_type; ?></td>
                                <td><?php if (!empty($comment->fullname)){ echo $comment->fullname; } else { $comment->username; } ?></td>
                                <td><?php $ini_date = date_create($comment->date_created); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                            <td>
                           <!--  <button type="button" class="btn btn-info btn-xs" disabled><i class="fa fa-edit"></i> Edit</button> -->
                            <button type="button" class="btn btn-google btn-xs" onclick="delete_comment('<?php echo $comment->id; ?>')"><i class="fa fa-trash"></i> Delete</button>
                            
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

<?php $this->load->view('includes/footer'); ?>
  <!-- This is data table -->
  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('notice/script'); ?>