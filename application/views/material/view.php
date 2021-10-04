<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View Materials
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'material/view'; ?>"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item active">View Materials</li>
                </ol>
            </section>
             <?php if ($active_user->role_id == 1){ ?>
            <button class="btn btn-social btn-bitbucket mb-5 pull-right" data-toggle="modal" data-target="#modal-classes">Filter by class</button>
            <?php } ?>
            <!-- Main content -->
            <section class="content">
                        <div class="box-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>title</th>
                          <th>class</th>
                          <th>Subject</th>
                          <th>Date Added</th>
                          <th>Attachment</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody><?php 
                              $i_material = 1;
                              foreach ($materials_list as $material) { 
                                //$term_status = $terms->term_status;
                                if ($active_user->role_id==3) {

                                if (!empty($material->attachment_admin)) {
                                ?>
                              <tr>
                                <td><?php echo $i_material; ?></td>
                                <td><?php echo $material->title; ?></td>
                                <td><?php echo $material->class_name; ?></td>
                                <td><?php echo $material->subject_name; ?></td>
                                <td><?php $ini_date = date_create($material->date_created); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                                <td><?php if (!is_null($material->attachment)) { echo "Yes"; }  ?></td>
                            <td>
                            <a href="<?php echo base_url().'material/view/'.$material->id; ?>"><button class="btn btn-social btn-vk mb-5" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View More </button></a>
                            <?php if ($active_user->role_id == 2) { ?>
                            <a href="<?php echo base_url().'material/submissions/'.$material->id; ?>"><button class="btn btn-social btn-dropbox mb-5" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View Submissions</button></a>
                          <?php } ?>
                           </td>
                          </tr>
                            <?php $i_material++;
                          }
                        }
                        else {

                          ?><tr>
                                <td><?php echo $i_material; ?></td>
                                <td><?php echo $material->title; ?></td>
                                <td><?php echo $material->class_name;   if (!empty($material->attachment_admin)) { echo "&nbsp;&#10004;"; } ?></td>
                                <td><?php echo $material->subject_name; ?></td>
                                <td><?php $ini_date = date_create($material->date_created); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                                <td><?php if (!is_null($material->attachment)) { echo "Yes"; }  ?></td>
                            <td>
                            <a href="<?php echo base_url().'material/view/'.$material->id; ?>"><button class="btn btn-social btn-vk btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-eye"></i>View More </button></a>

                            <?php
                            if ($active_user->role_id ==1) {
                              if ($this->uri->segment(3)!='old') {
                             ?>
                            <a href="<?php echo base_url().'material/upload/'.$material->id; ?>"><button class="btn btn-social btn-dropbox btn-xs" data-toggle="modal" data-target="#modal-class"><i class="fa fa-file"></i>Upload </button></a>
                             <?php
                           }
                            }
                             ?>

                            <?php
                            if ($active_user->role_id !=3) {

                             ?>
                            <button class="btn btn-social btn-danger btn-xs" data-toggle="modal" data-target="#modal-class" onclick="delete_material(<?php echo $material->id; ?>)"><i class="fa fa-trash"></i>Delete </button>
                             <?php
                            }
                             ?>
                           </td>
                          </tr>
                            <?php $i_material++;
                        }
                             } ?>
                      </tbody>          
                      <tfoot>
                        <tr>
                          <th>S/N</th>
                          <th>title</th>
                          <th>class</th>
                          <th>Subject</th>
                          <th>Date Added</th>
                          <th>Attachment</th>
                          <th>Options</th>
                        </tr>
                      </tfoot>
                    </table>
                    </div>              
                        </div>

            </section>

<?php $this->load->view('material/modal-classes'); ?>
<?php $this->load->view('includes/footer'); ?>  
<!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
  <!-- Qixa Admin for Data Table -->
  <script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<?php $this->load->view('material/script'); ?>