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

                                  <table id="logsTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                  <thead>
                                    <tr>
                                      <th>S/N</th>
                                      <th>Name</th>
                                      <th>Exam Type (*click to view)</th>
                                      <th>Class</th>
                                      <th>Title</th>
                                      <th>Subject</th>
                                      <th>Time Started</th>
                                      <th>Time Submitted</th>
                                      <th>Option</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php 
                                          $i_student = 1;
                                          foreach ($exam_logs as $student) { 
                                            ?>
                                          <tr>
                                            <td><?php echo $i_student; ?></td>
                                            <td><a href="<?php echo base_url(); ?>user/exam_logs/<?php echo $student->assessment_id; ?>"><?php echo $student->fullname; ?></a></td>
                                            <td><?php echo $student->exam_type; ?></td>
                                            <td><?php echo $student->class_name; ?></td>
                                            <td><?php echo $student->title; ?></td>
                                            <td><?php echo $student->subject_name; ?></td>
                                            <td><?php echo $student->time_started; ?></td>
                                            <td><?php echo $student->time_submitted; ?></td>
                                            <td><button onclick="delete_exam_log(<?php echo $student->log_id; ?>)" class="btn btn-danger"><i class="icon-trash"></i></button></td>
                                      </tr>
                                        <?php $i_student++;
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
<?php $this->load->view('includes/footer'); ?>
<script type="text/javascript">
    $(function () {
    $('#logsTable').DataTable();


  });
  function delete_exam_log(id) {

          $.confirm({
            title: 'Delete Log?',
            content: 'Are you sure you want to perform this action?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Delete',
                    btnClass: 'btn-red',
                    action: function(){
                          $.post("<?php echo base_url() . 'user/delete_log'; ?>", {id : id}).done(function(data) {
                           location.reload();
                      });
                    }
                },
                close: function () {
                }
            }
        });
  }
</script>