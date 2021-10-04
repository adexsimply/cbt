<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View <?php echo $assignment_info->subject_name; ?> Assignment Details
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>assignment/view"><i class="fa fa-book"></i>
                            View Assignment</a></li>
                    <li class="breadcrumb-item active">View Assignment Details</li>
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
                                        <strong> <?php echo $assignment_info->assignment_title; ?></strong>
                                        <time class="float-right text-lighter" datetime="2017"><?php echo $this->assignment_m->time_elapsed_string($assignment_info->date_created,true); ?></time>
                                    </h4>
                                    <p><small><?php echo $assignment_info->class_name; ?></small></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="px-15 mt-20 font-size-14">
                                        <p><b>Date Added:</b> <?php echo $assignment_info->date_created; ?></p>
                                        <p><b>Mark Attainable:</b> <?php echo $assignment_info->mark_attainable; ?></p>
                                        <!-- <p><b>Questions:</b> 10</p> -->
                                        <p><b>Instructions: </b> <?php echo $assignment_info->description; ?></p>
                                        <p><b>Assignment : </b> <?php if ((($assignment_info->attachment_admin)!=NULL) AND (($assignment_info->attachment_admin)!='0')) { 
                                            $imgagepath = explode("uploads/", $assignment_info->attachment_admin);
                                            // echo $imgagepath[1];
                                            $path = $assignment_info->attachment_admin;
                                            $path2= base_url()."uploads/".$imgagepath[1];
                                            echo "<a href='$path2' style='color:red;'>View File</a>";
                                        }
                                             ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if(!empty($assignment_solution)) { ?>
                                <h3>Your Answer</h3>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="px-15 mt-20 font-size-14">
                                        <?php foreach ($assignment_solution as $solution) { ?>
                                        <p><b>Date Submitted:</b> <?php echo $solution->date_created; ?></p>
                                        <!-- <p><b>Questions:</b> 10</p> -->
                                        <p><b>Text: </b> <?php echo $solution->answer; ?></p>
                                        <p><b>My Attachment : </b> <?php if ((($solution->attachment)!=NULL) AND (($solution->attachment)!='0')) { 
                                            $imgagepath = explode("uploads/", $solution->attachment);
                                            // echo $imgagepath[1];
                                            $path = $solution->attachment;
                                            $path2= base_url()."uploads/".$imgagepath[1];
                                            echo "<a href='$path2' style='color:red;'>View File</a>";
                                        }
                                             ?></p>
                                         <?php } ?>
                                    </div>
                                </div>
                            </div>

                               <?php echo form_open_multipart('assignment/solution');?>
                                <div class=" col-12 mt-20">
                                    <input type="text" value="<?php echo $assignment_info->id ?>" hidden name="assignment_id">
                                    <!-- <label for="">Solution</label><span class="text-danger">*</span> -->
                                    <textarea id="description" name="solution" class="form-control materia-desc" hidden="" required>More Attachment</textarea>
                                    
                                </div>
                                <div class=" col-12 mt-20">
                                    <label for="">Upload More Attachment</label><span class="text-danger">*</span>
                                    <div class="controls">
                                        <input type="file" id="file" name="materialfile" class="form-control" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12 d-flex justify-content-center my-25">
                                    <button class="btn btn-primary px-40" id="submit">Upload Attachment</button>
                                </div>
                            </form>
                        <?php } 
                            else {
                        ?>



                           <?php echo form_open_multipart('assignment/solution');?>
                                <div class=" col-12 mt-20">
                                    <input type="text" value="<?php echo $assignment_info->id ?>" hidden name="assignment_id">
                                    <!-- <label for="">Solution</label><span class="text-danger">*</span> -->
                                    <textarea id="description" name="solution" hidden="" class="form-control materia-desc" required>Done</textarea>
                                    
                                </div>
                                <div class=" col-12 mt-20">
                                    <label for="">Upload Attachment</label><span class="text-danger">*</span>
                                    <div class="controls">
                                        <input type="file" id="file" name="materialfile" class="form-control" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12 d-flex justify-content-center my-25">
                                    <button class="btn btn-primary px-40" id="submit">Submit Solution</button>
                                </div>
                            </form>
                        <?php } ?>

                            <div class="card-body py-12">
                                <div class="gap-items-4">

                                    <a class="text-lighter hover-light" href="#">
                                        <i class="fa fa-comment mr-1"></i> Chat With Tutor 
                                    </a>
                                </div>
                            </div>
                            <div class="media-list media-list-divided bg-lighter">

                                <?php 
                                if(!empty($assignment_solution1)) { 
                                foreach ($assignment_answer_comments as $comment){ ?>
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

                                             if (!empty($comment->fullname)) { echo $comment->fullname;} else { echo $comment->username; } } ?></strong></a>
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

                   <?php echo form_open_multipart('assignment/add_comment_to_answer', array('class' => 'publisher bg-transparent bt-1 border-fade'));?>
                            <!-- <form class="publisher bg-transparent bt-1 border-fade"> -->
                                <img class="avatar avatar-sm" src="<?php echo base_url(); ?>assets/images/avatar/2.jpg" alt="...">
                                <input class="publisher-input" name="assignment_id" value="<?php echo $assignment_info->id; ?>" hidden type="text" placeholder="Add Comment"> <input class="publisher-input" name="item_id" value="<?php echo $assignment_solution1->id; ?>" hidden type="text" placeholder="Add Comment">
                                <input class="publisher-input" name="text" type="text" placeholder="Add Comment">
                          <button class="btn btn-info" type="submit">Submit</button>
                                <span class="publisher-btn file-group">
                                    <i class="fa fa-file file-browser"></i>
                                    <input type="file" name="materialfile">
                                </span>
                            </form>
                        <?php } ?>

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