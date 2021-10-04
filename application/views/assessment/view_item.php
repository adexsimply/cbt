<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View Biology Assignment Details
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../students_dashboard.html"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="./assessments.html.html"><i class="fa fa-book"></i>
                            View Assessments</a></li>
                    <li class="breadcrumb-item active">View Assessment Details</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row fx-element-overlay">
                    <div class="col-lg-12">
                        <div class="box">

                            <div class="media bb-1 border-fade">
                                <img class="avatar avatar-lg" src="../../../images/avatar/4.jpg" alt="...">

                                <div class="media-body">
                                    <h4>
                                        <strong> Biology Assessment</strong>
                                        <time class="float-right text-lighter" datetime="2017"><p><b>Date Added:</b> 26th Feb, 2020</p></time>
                                    </h4>
                                    <p><small>SS3A</small></p>
                                </div>
                            </div>
                            <form action="" class="row px-20 mt-25 justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="font-size-14">Question 1: Which of the following is a
                                            Living Thing?</label>
                                        <div class="radio">
                                            <input name="group1" type="radio" id="Option_1" checked>
                                            <label for="Option_1">Rock</label>
                                        </div>
                                        <div class="radio">
                                            <input name="group1" type="radio" id="Option_2">
                                            <label for="Option_2">Plants</label>
                                        </div>
                                        <div class="radio">
                                            <input name="group1" type="radio" id="Option_3" >
                                            <label for="Option_3">Animals</label>
                                        </div>
                                        <div class="radio">
                                            <input name="group1" type="radio" id="Option_4" >
                                            <label for="Option_3">Radio<label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="font-size-14">Question 2: Which of the following is a
                                            Living Thing?</label>
                                        <div class="radio">
                                            <input name="group1" type="radio" id="Option_1b" checked>
                                            <label for="Option_1">Rock</label>
                                        </div>
                                        <div class="radio">
                                            <input name="group1" type="radio" id="Option_2b">
                                            <label for="Option_2">Plants</label>
                                        </div>
                                        <div class="radio">
                                            <input name="group1" type="radio" id="Option_3b" >
                                            <label for="Option_3">Animals</label>
                                        </div>
                                        <div class="radio">
                                            <input name="group1" type="radio" id="Option_4b" >
                                            <label for="Option_3">Radio<label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Upload Solution</label>
                                    <input type="file" class="form-control">
                                </div>
                                <div class="col-md-4 mt-20 mb-20">
                                    <button class="btn btn-md btn-block btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </section>
<?php $this->load->view('includes/footer'); ?> 
<?php $this->load->view('assessment/script'); ?>  
<!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>

</html>