<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Create Assignment
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.html"><i class="fa fa-user"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="teachers_dashboard.html"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item active">Create Assignment</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container">

                   <?php echo form_open_multipart('assignment/add_assignment', array('id' => 'create_assignment', 'class' => 'row'));?>

                        <div class="col-xl-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Subjects</label><span class="text-danger">*</span>
                                <select class="form-control select2" id="subject" data-placeholder="Select a Subject" name="subject" style="width: 100%;" required>
                                    <option value="">Select Subject</option>
                                    <?php foreach ($subjects_list as $subject) { ?>
                                    <option value="<?php echo $subject->id; ?>"><?php echo $subject->subject_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Class</label><span class="text-danger">*</span>
                                <select class="form-control select2" id="class" data-placeholder="Select a Class" name="class" style="width: 100%;" required>
                                     <option value="">Select Class</option>
                                    <?php foreach ($class_list as $class) { ?>
                                    <option value="<?php echo $class->id; ?>"><?php echo $class->class_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class=" col-12 mt-20">
                            <label for="">Assignment Title</label><span class="text-danger">*</span>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class=" col-12 mt-20">
                            <label for="">Mark Attainable</label><span class="text-danger">*</span>
                            <input type="number" id="mark" name="mark" class="form-control" required>
                        </div>
                        <div class=" col-6 mt-20">
                            <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Deadline</label>
                            <div class="">
                                <input class="form-control" name="deadline" type="datetime-local" value=""
                                    id="example-datetime-local-input">
                            </div>
                        </div>
                        <div class=" col-6 mt-20">
                            <label for="">Upload Attachment</label><span class="text-danger">*</span>
                            <div class="controls">
                                <input type="file" id="file" name="materialfile" class="form-control" required>
                            </div>
                            
                        </div>
                        <div class=" col-12 mt-20">
                            <label for="">Description</label><span class="text-danger">*</span>
                            <textarea id="description" name="description" class="form-control materia-desc" required></textarea>
                            
                        </div>
                        <div class="col-md-12 d-flex justify-content-center my-25">
                            <button class="btn btn-primary px-40" id="submit">Create</button>
                        </div>
                    </form>
                </div>



            </section>

<?php $this->load->view('includes/footer'); ?>  <!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>