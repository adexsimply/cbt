<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Welcome, Admin
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </section>

                  
            <!-- Main content -->
            <?php 
            $count_info = 0;
            $last_login = $active_user->last_login; 
            //echo "Last Login: ".$last_login."<br>"; 
            // if ($last_login < date('Y-m-d h:i:s')) {

            // //echo "Stop There";
            // }
            // else {
            //     echo "Dont Stop";
            // }

            foreach ($notices as $notice) {
                if ($notice->date_created > $last_login) {
                //echo $notice->date_created."<br/>";
                $count_info +=1;
                }
            }   
           // echo $count_info;
            if ($count_info > 0) {
                ?>      
                        <!-- Start an Alert -->
                        <div id="alerttopright" class="myadmin-alert myadmin-alert-img alert-success myadmin-alert-top-right"> <img src="<?php echo base_url(); ?>assets/images/avatar.png" class="img" alt="img"><a href="#" class="closed">&times;</a>
                            <h4>Kindly Check The Info box!</h4> <b><?php echo $count_info ?> new information was posted</b></div>

                <?php
            } 
             ?>
            <section class="content">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12" onclick="location.href='<?php echo base_url().'notice'; ?>'">
                        <div class="flexbox flex-justified text-center bg-aqua mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-bullhorn font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($notices); ?></div>
                                <span>Info Box</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12" onclick="location.href='<?php echo base_url().'material/view'; ?>'">
                        <div class="flexbox flex-justified text-center bg-pink mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-file-document-box font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($materials_list); ?></div>
                                <span>New Materials</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12" onclick="location.href='<?php echo base_url().'assignment/view'; ?>'" >
                        <div class="flexbox flex-justified text-center bg-warning mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-file-multiple font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($assignments_list); ?></div>
                                <span>New Assignments</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12" onclick="location.href='<?php echo base_url().'setup/subject'; ?>'">
                        <div class="flexbox flex-justified text-center bg-dark mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-file-document font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($subject_list); ?></div>
                                <span>Subjects</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">

                    <div class="col-xl-3 col-md-6 col-12" onclick="location.href='<?php echo base_url().'user'; ?>'">
                        <div class="flexbox flex-justified text-center bg-brown mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-account-circle font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($users_list); ?></div>
                                <span>Users</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12" onclick="location.href='<?php echo base_url().'notice/comments'; ?>'">
                        <div class="flexbox flex-justified text-center bg-success mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-comment font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($comments_list); ?></div>
                                <span>Total Comments</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12" onclick="location.href='<?php echo base_url().'setup/class'; ?>'">
                        <div class="flexbox flex-justified text-center bg-cyan mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-book-multiple font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($class_list); ?></div>
                                <span>Classes</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12" onclick="location.href='<?php echo base_url().'assessment'; ?>'">
                        <div class="flexbox flex-justified text-center bg-blue mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-school font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($assessments_list); ?></div>
                                <span>Quiz</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

            </section>


<?php $this->load->view('includes/footer'); ?>
<script type="text/javascript">
    /* Click to close */
    $(".myadmin-alert").click(function(event) {
        $(this).fadeToggle(350);
        return false;
    });
    
    /** Alert Position Top Right  **/
   // $("#showtopright").click(function() {
        $("#alerttopright").fadeToggle(350);
    //});
</script>