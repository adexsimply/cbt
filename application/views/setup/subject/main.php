<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Subjects</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">
                                    <button class="btn btn-primary m-b-15" data-toggle="modal" data-target="#modal-class" onclick="clear_textbox()" type="button"><i class="icon-refresh"></i> Resync Primary</button>&nbsp;
                                    <button class="btn btn-secondary m-b-15" onclick="sync_subject_name()" type="button"><i class="icon-refresh"></i> Resync Secondary</button>&nbsp;
                                    <button class="btn btn-info m-b-15" data-toggle="modal" onclick="clear_textbox()" data-target="#modal-subject" type="button"><i class="fa fa-plus"></i> Add Subjects</button>
              </div>
                <div class="card patients-list">
                    <div class="header">
                        <h2>Subject List</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllSubjects">
                              <table id="subjectsTable" class="table table-hover js-basic-example dataTable table-custom">
                                <thead>
                                  <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Subject Name</th>
                                    <th>Date Created</th>
                                    <th>Options</th>
                                  </tr>
                                </thead>
                                <?php 
                                    $i_class = 1;
                                    foreach ($subject_list as $terms) { 
                                      //$term_status = $terms->term_status;
                                      ?>
                                    <tr>
                                      <td><?php echo $i_class; ?></td>
                                      <td><?php echo $terms->subject_name; ?><?php if ($terms->subject_id_system !=null) { echo " <i class='fa fa-refresh'></i>"; } ?></td>
                                      <td><?php echo $terms->date_created; ?></td>
                                  <td>
                                  <button class="btn btn-danger" onclick="delete_subject_name('<?php echo $terms->id;?>')" title="Delete"><i class="fa fa-trash"></i></button>
                                  <button  class="btn btn-info" disabled onclick="get_class_data('<?php echo $terms->id;?>')" data-toggle="modal" data-target="#modal-subject"><i class="fa fa-edit"></i> </button>
                                 </td>
                                </tr>
                                  <?php $i_class++;
                                   } ?>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->load->view('setup/subject/modal'); ?>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('setup/subject/script'); ?>