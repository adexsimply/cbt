<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<?php echo $this->benchmark->elapsed_time();?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Students</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">
                    <button class="btn btn-primary m-b-15" data-toggle="modal" data-target="#modal-class" onclick="clear_textbox()" type="button"><i class="icon-refresh"></i> Resync Primary</button>&nbsp;
                    <button class="btn btn-secondary m-b-15" onclick="sync_students()" type="button"><i class="icon-refresh"></i> Resync Secondary</button>&nbsp;
                    <button class="btn btn-info m-b-15" data-toggle="modal" onclick="clear_textbox()" data-target="#modal-student"><i class="fa fa-plus"></i> Add Student </button>
              </div>
                <div class="card patients-list">
                    <div class="header">
                        <h2>List of Students</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">

                              <table id="employeeListing" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                              <thead>
                                <tr>
                                  <th>S/N</th>
                                  <th>Name</th>
                                  <th>School</th>
                                  <th>Class</th>
                                  <th>Class-Arm</th>
                                  <th>School</th>
                                  <th>Username</th>
                                  <th>Password</th>
                                  <th>Options</th>
                                </tr>
                              </thead>
                              <tbody id="listRecords">
                              </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('student/modal'); ?>
<?php $this->load->view('student/modal-classes'); ?>
<?php $this->load->view('student/modal-password'); ?>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('student/script'); ?>