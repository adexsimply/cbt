<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Classes
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </section>
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                      <h4 class="box-title">Arm Lists</h4>              
                                <h5>
                                    <button class="btn btn-outline-primary pull-right" data-toggle="modal" data-target="#class-modal" onclick="clear_textbox()" type="button">Add Class</button>
                                </h5>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="table-responsive">
                                <table class="table table-striped table-responsive" data-toggle="datatables">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Term Name</th>
                                            <th>Date Added</th>
                                            <th>Added By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $i_term = 1;
                                      foreach ($class_list as $terms) { 
                                        //$term_status = $terms->term_status;
                                        ?>
                                      <tr>
                                        <td><?php echo $i_term; ?></td>
                                        <td><?php echo $terms->class_list_name; ?></td>
                                        <td><?php echo $terms->date_added; ?></td>
                                        <td><?php echo $terms->username; ?></td>
                                            <td>
                                              <button class="btn btn-xs btn-outline-danger ripple" onclick="delete_class_name('<?php echo $terms->id;?>')" title="Delete">Delete<i class="os-icon os-icon-ui-15"></i></button>
                                              <button class="btn btn-xs btn-outline-info ripple" onclick="get_class_data('<?php echo $terms->id;?>')" data-toggle="modal" data-target="#class-modal" title="Edit">Edit<i class="os-icon os-icon-ui-49"></i></button>
                                            </td>
                                      </tr>
                                      <?php $i_term++;
                                       } ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </section>
                <!-- /.content -->  
        </div>
<?php $this->load->view('setup/class-list/modal'); ?>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('setup/class-list/script'); ?>