<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   Welcome, <?php echo $teacher_details->first_name." ".$teacher_details->last_name; ?>
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </section>
            <section class="content">

                 <div class="row">
                    <!-- /.col -->

                    <div class="col-xl-4 col-md-6 col-12" onclick="location.href='<?php echo base_url().'material/view'; ?>'">
                        <div class="flexbox flex-justified text-center bg-info mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-ticket-confirmation font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($materials_list); ?></div>
                                <span>Total Materials</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-4 col-md-6 col-12" onclick="location.href='<?php echo base_url().'assignment/view'; ?>'">
                        <div class="flexbox flex-justified text-center bg-warning mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-message-reply-text font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($assignments_list); ?></div>
                                <span>Assignments </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="flexbox flex-justified text-center bg-success mb-30 pull-up">
                            <div class="no-shrink py-30">
                                <span class="mdi mdi-thumb-up-outline font-size-50"></span>
                            </div>

                            <div class="py-30 bg-white text-dark">
                                <div class="font-size-30 countnm"><?php echo count($assessments_list); ?></div>
                                <span>Quiz</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    
                    <!-- /.col -->
                </div> 

            </section>
<?php $this->load->view('includes/footer'); ?>
