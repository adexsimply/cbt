<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Class</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">
                                    <button class="btn btn-primary m-b-15" data-toggle="modal" data-target="#modal-class" onclick="clear_textbox()" type="button"><i class="icon-refresh"></i> Resync Primary</button>&nbsp;
                                    <button class="btn btn-secondary m-b-15" onclick="sync_class_name()" type="button"><i class="icon-refresh"></i> Resync Secondary</button>&nbsp;
                                    <button class="btn btn-info m-b-15" data-toggle="modal" data-target="#modal-class" onclick="clear_textbox()" type="button"><i class="fa fa-plus"></i> Add Class</button>
              </div>
                <div class="card patients-list">
                    <div class="header">
                        <h2>Class List</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="All">
                                <table id="example" class="table table-hover js-basic-example dataTable table-custom">
                                  <thead>
                                  <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Class Name</th>
                                    <th>Group</th>
                                    <th>School</th>
                                    <th>Date Created</th>
                                    <th>Options</th>
                                  </tr>
                                  </thead>
                                  <?php 
                                      $i_class = 1;
                                      foreach ($class_list as $terms) { 
                                        //$term_status = $terms->term_status;
                                        if ($terms->class_group_id==1) {
                                          $class_group = "CSMT";
                                        }
                                        else {
                                          $class_group = "Others";
                                        }
                                        ////
                                        if ($terms->class_school==1) {
                                          $class_school = "Secondary";
                                        }
                                        elseif ($terms->class_school==2) {
                                          $class_school = "Primary";
                                        }
                                        else {
                                          $class_school ="NIL";
                                        }
                                        ?>
                                      <tr>
                                        <td><?php echo $i_class; ?></td>
                                        <td><?php echo $terms->class_name; if (isset($terms->class_system_id)){ echo " <i class='icon-refresh'></i>"; } ?></td>
                                        <td><?php echo $class_group; ?></td>
                                        <td><?php echo $class_school; ?></td>
                                        <td><?php echo $terms->date_created; ?></td>
                                    <td><button class="btn btn-danger m-b-15" onclick="delete_class_name('<?php echo $terms->id;?>')" title="Delete"><i class="fa fa-trash"></i>  Delete</button><?php if (!isset($terms->class_system_id)) { ?> <button  class="btn btn-info m-b-15" onclick="get_class_data('<?php echo $terms->id;?>')" data-toggle="modal" data-target="#modal-class"><i class="fa fa-edit"></i>  Edit</button> <?php } ?></td>
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
<?php $this->load->view('setup/class/modal'); ?>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('setup/class/script'); ?>