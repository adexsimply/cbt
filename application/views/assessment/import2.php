<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Import Questions (Excel)</h2>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="header">
                        <h2>Import Questions(Excel)</h2>
                    </div>
                    <div class="body">
                          <!-- Nav tabs -->

                          
    <!-- Main content -->
                        <div class="row clearfix">
                            <div class="container">

                						<form action="<?php echo base_url();?>upload/save" id="add-assessment" class="row" method="post" enctype="multipart/form-data">

                                      
                                        <div class=" col-12 mt-20"> 
                                        	<input type="text" name="assessment_id" hidden="" value="<?php echo $this->uri->segment(3); ?>">
                                            <input type="text" name="question_type" hidden value="<?php echo $this->uri->segment(4); ?>">
                                            <label for="">Upload Excel File</label><span class="text-danger">*</span>
                                             <input class="form-control" type="file" name="userfile" value="" /><br><br>                        
                                        </div>
                						   
                                        <div class="col-md-12 d-flex justify-content-center my-25">
                						    <input class="btn btn-primary px-40"  type="submit" name="importfile" value="Upload" />
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php $this->load->view('users/modal'); ?>
<?php $this->load->view('users/modal-password'); ?>
<?php $this->load->view('includes/footer'); ?>  <!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('users/script'); ?>