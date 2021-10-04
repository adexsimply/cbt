<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    View Questions
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-user"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item active">View Questions</li>
                </ol>
            </section>
            <!-- Main content -->
    <!-- Main content -->
    <section class="content">
		
	  <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-body no-padding">
				<div class="table-responsive">
				  <table id="example5" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
          <thead>
					<tr>
					  <th>S/N</th>
					  <th>Question</th>
					  <th>Option1</th>
					  <th>Option2</th>
					  <th>Option3</th>
					  <th>Option4</th>
					  <th>Answer</th>
					</tr>
          </thead>
            <tbody>
					<?php 
					$i = 1;
					foreach ($assessment_questions as $question) { 
						?>
					<tr>
					  <td><?php echo $i; ?></td>
					  <td><?php echo $question->question; ?></td>
					  <td><?php echo $question->option1; ?></td>
					  <td><?php echo $question->option2; ?></td>
					  <td><?php echo $question->option3; ?></td>
					  <td><?php echo $question->option4; ?></td>
					  <td><?php echo $this->assessment_m->assessment_options($question->answer); ?></td>
					</tr>
				<?php 
				$i++;
			} ?>
        </tbody>
				  </table>
				</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
     
</section>
<?php $this->load->view('includes/footer'); ?> 
<?php $this->load->view('assessment/script'); ?>  
<?php $this->load->view('assessment/modal-question'); ?>  
<script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor_components/datatable/datatables.min.js"></script>
  
<!-- Qixa Admin for Data Table -->
<script src="<?php echo base_url(); ?>assets/js/pages/data-table.js"></script>
<!-- select picker -->

<script type="text/javascript">
  
  $('#example5').DataTable( {
    dom: 'Bfrtip',
    buttons: [
      'excel', 'pdf', 'print'
    ]
  } );
</script>
