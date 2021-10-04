<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Sessions
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                      <h4 class="box-title">Session Lists</h4>              
                          <button class="btn btn-social btn-bitbucket mb-5 pull-right" data-toggle="modal" onclick="clear_textbox()" data-target="#modal-session">
                            <i class="fa fa-plus"></i> Add Session
                          </button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Session Name</th>
                              <th>Status</th>
                              <th>Date Created</th>
                              <th>Options</th>
                            </tr>
                            <?php 
                            $i_session =1;
                            foreach($session_list as $session){  
                                $session_status = $session->session_status;
                                ?>
                            <tr>
                              <td>1.</td>
                              <td><?php echo $session->session_title; ?></td>
                              <td><?php if($session_status=='1') { ?>
                                  <button class="btn btn-success"><i class="icon-check mr-1"></i>Current Session</button>
                                  <?php } else { ?>
                                  <button class="btn btn-info text-white" onclick="activate_session_name('<?php echo $session->id;?>')"><i class="icon-check mr-1"></i>Activate Session</button>
                                  <?php } ?>
                            </td>
                              <td><?php echo $session->date_created; ?></td>
                              <td>
                              <button class="btn btn-social btn-google mb-5" onclick="delete_session_name('<?php echo $session->id;?>')" title="Delete"><i class="fa fa-trash"></i>  Delete</button>
                              <button  class="btn btn-social btn-github mb-5" onclick="get_data('<?php echo $session->id;?>')" data-toggle="modal" data-target="#modal-session"><i class="fa fa-edit"></i>  Edit</button>
                             </td>
                            </tr>
                              <?php $i_session++;
                               } ?>
                                </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
              </div>
              <!-- /.box -->

            </section>
                <!-- /.content -->
        </div>

<?php $this->load->view('setup/session/modal'); ?>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('setup/session/script'); ?>