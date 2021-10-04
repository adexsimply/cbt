<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<body>
	        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="container">

<form action="<?php echo base_url().'assignment/view_students2'; ?>" method="post" class="row">
<?php 
//var_dump($students_list);
$i=1;

foreach($assignments_list as $assignment) {
?>
<input type="checkbox" id="assignment_id<?php echo $assignment->id; ?>" class="filled-in" name="assignment_id[]" value="<?php echo $assignment->id; ?>" /><label for="assignment_id<?php echo $assignment->id; ?>"><?php echo $assignment->assignment_title; ?></label><br>

<?php
$i++;
}

?>
<br>
<hr>
<button class="btn btn-success" type="submit">Get Students</button>
</form>

<?php $this->load->view('includes/footer'); ?>
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>