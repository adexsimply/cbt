<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<?php if ($active_user->role_id ==1) { ?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div> 
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-3"><a href="<?php echo base_url() ?>/user/active_exams">
                                    <div class="body bg-success text-light">
                                        <h4><i class="icon-note"></i> <?php echo count($active_exams); ?></h4>
                                        <span>Students Writing Exam(s)</span>
                                    </div></a>
                                </div>
                                <div class="col-md-3">
                                    <div class="body bg-warning text-light">
                                        <h4><i class="icon-wallet"></i> 0</h4>
                                        <span>Exams</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="body bg-danger text-light">
                                        <h4><i class="icon-wallet"></i> 0</h4>
                                        <span>Students</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="body bg-info text-light">
                                        <h4><i class="icon-wallet"></i> 0</h4>
                                        <span>Questions</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php } ?>
<?php $this->load->view('includes/footer'); ?>