<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Classes</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">
                    <button class="btn btn-primary m-b-15" data-toggle="modal" data-target="#modal-class" onclick="clear_textbox()" type="button"><i class="icon-refresh"></i> Resync Primary</button>&nbsp;
                    <button class="btn btn-secondary m-b-15" data-toggle="modal" data-target="#modal-class" onclick="clear_textbox()" type="button"><i class="icon-refresh"></i> Resync Secondary</button>&nbsp;
                    <button class="btn btn-info m-b-15" data-toggle="modal" data-target="#class-arm-modal" onclick="clear_textbox()" type="button">Add Class & Arm</button>
              </div>
                <div class="card patients-list">
                    <div class="header">
                        <h2>Class Arms List</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">

                                <table id="classArmsTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Class Name</th>
                                            <th>Arm Name</th>
                                            <th>Alias</th>
                                            <th>Date Added</th>
                                            <th>Added By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $i_term = 1;
                                      foreach ($class_arm_list as $terms) { 
                                        //$term_status = $terms->term_status;
                                        ?>
                                      <tr>
                                        <td><?php echo $i_term; ?></td>
                                        <td><?php echo $terms->class_list_name; ?></td>
                                        <td><?php echo $terms->arm_name; ?></td>
                                        <td><?php echo $terms->alias; ?></td>
                                        <td><?php echo $terms->date_added; ?></td>
                                        <td><?php echo $terms->username; ?></td>
                                            <td>
                                              <button class="btn btn-xs btn-outline-danger ripple" onclick="delete_class_arm_name('<?php echo $terms->id;?>')" title="Delete">Delete<i class="os-icon os-icon-ui-15"></i></button>
                                              <button class="btn btn-xs btn-outline-info ripple" onclick="get_class_arm_data('<?php echo $terms->id;?>')" data-toggle="modal" data-target="#class-arm-modal" title="Edit">Edit<i class="os-icon os-icon-ui-49"></i></button>
                                            </td>
                                      </tr>
                                      <?php $i_term++;
                                       } ?>
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
<?php $this->load->view('setup/class-arm/modal'); ?>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('setup/class-arm/script'); ?>