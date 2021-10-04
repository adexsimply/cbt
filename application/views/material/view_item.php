<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <!--   <h1>
                    View Modern Biology Details
                </h1> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-user"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>material/view"><i class="fa fa-dashboard"></i>
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
                                        <strong><?php echo $material_info->title; ?></strong>
                                        <time class="float-right text-lighter" datetime="2017"><?php echo $this->material_m->time_elapsed_string($material_info->date_created,true); ?></time>
                                    </h4>
                                    <p><small><?php echo $material_info->username; ?></small></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="px-15 mt-20 font-size-14">
                                        <p><b>Attachment:</b> <?php 
                                        if ($active_user->role_id==3){

                                        if ((($material_info->attachment_admin)!=NULL) AND (($material_info->attachment_admin)!='0')) { 
                                            $imgagepath = explode("uploads/", $material_info->attachment_admin);
                                            // echo $imgagepath[1];
                                            $ext = pathinfo($material_info->attachment_admin, PATHINFO_EXTENSION);
                                            $path = $material_info->attachment_admin;
                                            $path2= base_url()."uploads/".$imgagepath[1];

                                            if ($ext=='pdf') {
                                            echo "<a href='".base_url()."pdfjs/web/viewer.html?file=$path2' style='color:red;'>View File</a>";
                                                
                                            }
                                            else {

                                            echo "<a href='$path2' style='color:red;'>View File</a>";
                                            }
                                        }
                                        //If Admin hasn't uploaded yet
                                        else {
                                            "No Attachment Yet, Kindly check later";
                                        }

                                        }
                                        else {
                                        if ((($material_info->attachment)!=NULL) AND (($material_info->attachment)!='0')) { 
                                            $imgagepath = explode("uploads/", $material_info->attachment);
                                            // echo $imgagepath[1];
                                            $path = $material_info->attachment;
                                            $path2= base_url()."uploads/".$imgagepath[1];
                                            echo "<a href='$path2' style='color:red;'>View File</a>";
                                        }
                                        if ((($material_info->attachment_admin)!=NULL) AND (($material_info->attachment_admin)!='0')) { 
                                            $imgagepath = explode("uploads/", $material_info->attachment_admin);
                                            // echo $imgagepath[1];
                                            $path = $material_info->attachment_admin;
                                            $path2= base_url()."uploads/".$imgagepath[1];
                                            echo "<p>Admin's Attachment: <a href='$path2' style='color:red;'>View File</a> </p>";
                                        }

                                        }
                                             ?></p>
                                        <p><b>Date Added:</b> <?php $ini_date = date_create($material_info->date_created); echo date_format($ini_date,"D M d,Y h:i a");  ?></p>
                                        <!-- <p><b>Pages:</b> 560</p> -->
                                        <p><b>Description: </b> <?php echo $material_info->description; ?></p>
                                    </div>
                                </div>
                            </div>




                            <div class="card-body py-12">
                                <div class="gap-items-4">

                                    <a class="text-lighter hover-light" href="#">
                                        <i class="fa fa-comment mr-1"></i> 
                                    </a>
                                </div>
                            </div>
                            <div class="media-list media-list-divided bg-lighter">
                                <?php foreach ($material_comments as $comment){ 
                                   //var_dump($comment);
                                    ?>
                                <div class="media">
                                    <a class="avatar" href="#">
                                        <img src="<?php echo base_url(); ?>assets/images/avatar/9.png" alt="...">
                                    </a>
                                    <div class="media-body">
                                        <p>
                                            <a href="#"><strong><?php 
                                            if ($comment->role_id==2) {
                                                echo "Teacher";
                                            }else {

                                            if (!empty($comment->fullname)) { echo $comment->fullname;} else { echo $comment->username; }

                                            } ?></strong></a>
                                            <time class="float-right text-fade" datetime="<?php echo $comment->date_created; ?>"><?php echo $this->material_m->time_elapsed_string($comment->date_created,true); ?></time>
                                        </p>
                                        <p><?php echo $comment->comment_body; ?></p>
                                        <p><?php if ((($comment->attachment)!=NULL) AND (($comment->attachment)!='0')) { 
                                            $imgagepath = explode("uploads/", $comment->attachment);
                                            // echo $imgagepath[1];
                                            $path = $comment->attachment;
                                            $path2= base_url()."uploads/".$imgagepath[1];
                                            echo "<b>Attachment:</b> <a href='$path2' style='color:red;'>View File</a>";
                                        }
                                        ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                   <?php echo form_open_multipart('material/add_comment', array('class' => 'publisher bg-transparent bt-1 border-fade'));?>
                            <!-- <form class="publisher bg-transparent bt-1 border-fade"> -->
                                <img class="avatar avatar-sm" src="<?php echo base_url(); ?>assets/images/avatar/2.jpg" alt="...">
                                <input class="publisher-input" name="item_id" value="<?php echo $material_info->id; ?>" hidden type="text" placeholder="Add Comment">
                                <input class="publisher-input" name="text" type="text" required="" placeholder="Add Comment">
                                <span class="publisher-btn file-group">
                                    <i class="fa fa-file file-browser"></i>
                                    <input type="file" name="materialfile">
                                </span>
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