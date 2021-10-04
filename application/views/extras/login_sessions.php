<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Login Sessions</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">
                    <button class="btn btn-info m-b-15" data-toggle="modal" data-target="#modal-classes">Filter by class</button>
              </div>
                <div class="card patients-list">
                    <div class="header">
                        <h2>List of Users</h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">

                                  <table id="loginTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Name</th>
                                      <th>Description</th>
                                      <th>Last Login</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php 
                                          $i_student = 1;
                                          foreach ($login_sessions as $student) { 
                                            ?>
                                          <tr>
                                            <td><?php echo $i_student; ?></td>
                                            <td><?php if($student->role_id=='2'){ echo $student->first_name." ".$student->last_name;} else { echo $student->fullname;} ?></td>
                                            <td><?php if($student->role_id=='2'){ echo "Teacher";} else { echo $student->class_name;} ?></td>
                                            <td><?php $ini_date = date_create($student->last_login); echo date_format($ini_date,"D M d,Y h:i a"); ?></td>
                                      </tr>
                                        <?php $i_student++;
                                         } ?>
                                  </tbody>          
                                  <tfoot>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Name</th>
                                      <th>Description</th>
                                      <th>Last Login</th>
                                    </tr>
                                  </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('extras/modal-classes'); ?>
  <!-- This is data table -->
<script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>

<!-- Qixa Admin for Data Table -->
<script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<script type="text/javascript">
    $(function () {
    $('#loginTable').DataTable({
    "pageLength": 50,
     "lengthMenu": [ [10, 25, 50, 200, -1], [10, 25, 50, 200, "All"] ]
      });

    });

    function filter_by_class () {
    var class_id = document.getElementById('class').value;
    window.location = "<?php echo base_url().'user/login_sessions/'; ?>"+class_id
    console.log(class_id);
    }

</script>