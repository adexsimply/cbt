<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View <?php //echo $assignment_solution->subject_name; ?> Answer
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>assignment/view"><i class="fa fa-book"></i>
                            View Assignment</a></li>
                    <li class="breadcrumb-item active">View Assignment Details</li>
                </ol>
            </section>
<?php //var_dump($assignment_solution); ?>
            <!-- Main content -->
            <section class="content">
                <div class="row fx-element-overlay">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="media bb-1 border-fade">
                                <img class="avatar avatar-lg" src="<?php echo base_url(); ?>assets/images/avatar/4.jpg" alt="...">
                                
                                <div class="media-body">
                                    <?php
                                    $i=1;
                                     foreach ($assignment_solution as $solution) {
                                        if ($i==1) {
                                      ?>
                                    <h4>
                                        <strong> <?php echo $solution->answer; ?></strong>
                                        <time class="float-right text-lighter" datetime="2017"><?php echo $this->assignment_m->time_elapsed_string($solution->date_created,true); ?></time>
                                    </h4>
                                    <!-- <p><small><?php echo $assignment_info->class_name; ?></small></p> -->
                                <?php $i++; } } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="px-15 mt-20 font-size-14">
                                        <?php foreach ($assignment_solution as $solution2) { ?>
                                           <?php if($solution2->answer != "More Attachment") {?>
                                        <p><b>Date Added:</b> <?php echo $solution2->date_created; ?></p>
                                    <?php } ?>
                                        <p><b><?php if($active_user->role_id==3) { echo "My "; } ?>Attachment:</b> <?php if ((($solution2->attachment)!=NULL) AND (($solution2->attachment)!='0')) { 
                                            $imgagepath = explode("uploads/", $solution2->attachment);
                                            // echo $imgagepath[1];
                                            $path = $solution2->attachment;
                                            $path2= base_url()."uploads/".$imgagepath[1];
                                            echo "<a href='$path2' style='color:red;'>View File</a>";
                                        }
                                    }
                                             ?></p>
                                    </div>
                                </div>
                            </div>


                            <?php if(!empty($assignment_grade)) { ?>
                                <h3>Student's Grade</h3>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="px-15 mt-20 font-size-14">
                                        <p><b>Date Submitted:</b> <?php echo $assignment_grade->date_created; ?></p>
                                        <!-- <p><b>Questions:</b> 10</p> -->
                                        <p><b>Grade: </b> <?php echo $assignment_grade->grade; ?></p>
                                        <p><b>Correction : </b> <?php if ((($assignment_grade->attachment)!=NULL) AND (($assignment_grade->attachment)!='0')) { 
                                            $imgagepath = explode("uploads/", $assignment_grade->attachment);
                                            // echo $imgagepath[1];
                                            $path = $assignment_grade->attachment;
                                            $path2= base_url()."uploads/".$imgagepath[1];
                                            echo "<a href='$path2' style='color:red;'>View File</a>";
                                        }
                                             ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } 
                            else {
                                if ($active_user->role_id==2 ||$active_user->role_id==1) {
                        ?>



                           <?php echo form_open_multipart('assignment/mark_grade');?>
                                <div class=" col-12 mt-20">
                                    <input type="text" name="assignment_id" hidden="" value="<?php echo $this->uri->segment(3); ?>">
                                    <input type="text" name="student_id" hidden="" value="<?php echo $this->uri->segment(4); ?>">
                                    <input type="text" value="<?php echo $assignment_answer_id->id ?>" hidden name="assignment_answer_id">
                                    <label for="">Score</label><span class="text-danger">*</span>
                                    <input type="number" id="grade" name="grade" class="form-control">
                                    
                                </div>
                                <div class=" col-12 mt-20">
                                    <label for="">Upload Attachment</label><span class="text-danger"></span>
                                    <div class="controls">
                                        <input type="file" id="file" name="materialfile" class="form-control">
                                    </div>
                                    
                                </div>
                                <div class="col-md-12 d-flex justify-content-center my-25">
                                    <button class="btn btn-primary px-40" id="submit">Submit Grade</button>
                                </div>
                            </form>
                        <?php }

                        } ?>




                            <div class="card-body py-12">
                                <div class="gap-items-4">

                                    <a class="text-lighter hover-light" href="#">
                                        <i class="fa fa-comment mr-1"></i> <?php echo count($assignment_answer_comments); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="media-list media-list-divided bg-lighter">

                           
                                <?php 
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
                                            echo "<b>Correction : </b> <a href='$path2' style='color:red;'>View File</a>";
                                        }
                                    
                                        ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                   <?php echo form_open_multipart('assignment/add_comment_to_answer2', array('class' => 'publisher bg-transparent bt-1 border-fade'));?>
                            <!-- <form class="publisher bg-transparent bt-1 border-fade"> -->
                                <img class="avatar avatar-sm" src="<?php echo base_url(); ?>assets/images/avatar/2.jpg" alt="...">
                                    <input type="text" name="student_id" hidden="" value="<?php echo $this->uri->segment(4); ?>">
                                <input class="publisher-input" name="assignment_id" value="<?php echo $this->uri->segment(3); ?>" hidden type="text" placeholder="Add Comment"> <input class="publisher-input" name="item_id" value="<?php echo $assignment_answer_id->id; ?>" hidden type="text" placeholder="Add Comment">
                                <input class="publisher-input" name="text" type="text" required="" placeholder="Add Comment">
                          <button class="btn btn-info" type="submit">Submit</button>
                                <span class="publisher-btn file-group">
                                    <i class="fa fa-file file-browser"></i>
                                    <input type="file" name="materialfile">
                                </span>
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