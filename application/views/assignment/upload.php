<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Upload New Document
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.html"><i class="fa fa-user"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="teachers_dashboard.html"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="view_materials.html"><i class="fa fa-dashboard"></i>
                            View Materials</a></li>
                    <li class="breadcrumb-item active">View Material Details</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row fx-element-overlay">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="media bb-1 border-fade">
                                <img class="avatar avatar-lg" src="<?php echo base_url(); ?>assets/images/avatar/4.jpg" alt="...">
                                <div class="media-body">
                                    <h4>
                                        <strong><?php echo $assignment_info->assignment_title; ?></strong>
                                        <time class="float-right text-lighter" datetime="2017"><?php echo $this->assignment_m->time_elapsed_string($assignment_info->date_created,true); ?></time>
                                    </h4>
                                    <p><small><?php echo $assignment_info->username; ?></small></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="px-15 mt-20 font-size-14">
                                        <p><b>Attachment:</b> <?php if ((($assignment_info->attachment)!=NULL) AND (($assignment_info->attachment)!='0')) { 
                                            $imgagepath = explode("uploads/", $assignment_info->attachment);
                                            // echo $imgagepath[1];
                                            $path = $assignment_info->attachment;
                                            $path2= base_url()."uploads/".$imgagepath[1];
                                            echo "<a href='$path2' style='color:red;'>View File</a>";
                                        }
                                             ?></p>
                                        <p><b>Date Added:</b> <?php echo $assignment_info->date_created; ?></p>
                                        <!-- <p><b>Pages:</b> 560</p> -->
                                        <p><b>Description: </b> <?php echo $assignment_info->description; ?></p>
                                        <?php if($active_user->role_id==1) {
                                            if (!empty($assignment_info->attachment_admin)) {
                                                 $imgagepath = explode("uploads/", $assignment_info->attachment_admin);
                                            // echo $imgagepath[1];
                                            $path = $assignment_info->attachment_admin;
                                            $path2= base_url()."uploads/".$imgagepath[1];
                                            echo "<h3>You have uploaded the adjustment</h3><a href='$path2' style='color:red;'>View Your File</a>";
                                        }

                                        else {
                                            echo "<h2>You've not uploaded any file. Kindly upload below</h2>";
                                        }

                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>


                   <?php echo form_open_multipart('assignment/upload_admin', array('class' => 'publisher bg-transparent bt-1 border-fade'));?>
                            <!-- <form class="publisher bg-transparent bt-1 border-fade"> -->
                                <input class="publisher-input" name="item_id" value="<?php echo $assignment_info->id; ?>" hidden type="text" placeholder="Add Comment">
                          
                                    <i class="fa fa-file file-browser"></i>
                                    <input type="file" class="form-control" name="materialfile">
                                
                                <button class="btn btn-info" type="submit">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>

            </section>

<?php $this->load->view('users/modal'); ?>
<?php $this->load->view('users/modal-password'); ?>
<?php $this->load->view('includes/footer'); ?>  <!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('users/script'); ?>