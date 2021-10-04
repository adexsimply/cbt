<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<body>
	        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="container">
<table class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
	<th>S/N</th>
	<th>Name</th>
	<th>Class</th>
<?php 
//var_dump($students_list);
$i=1;

foreach($students_list as $student) {
?>
<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $student->fullname; ?></td>
	<td><?php echo $student->class_name; ?></td>
</tr>
<?php
$i++;
}

?>

</table>

</body>
</html>