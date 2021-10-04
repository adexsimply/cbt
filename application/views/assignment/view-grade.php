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
                    <li class="breadcrumb-item active">Select Class & Subject</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container">
                   <form id="create_assignment" class="row">

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
                                <label>Class Arm</label><span class="text-danger">*</span>
                                <select class="form-control select2" id="class" data-placeholder="Select a Class" name="class" style="width: 100%;" required>
                                     <option value="">Select Class</option>
                                    <?php foreach ($class_list1 as $class1) { ?>
                                    <option value="<?php echo $class1->id; ?>"><?php echo $class1->class_list_name."-".$class1->arm_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center my-25">
                            <button class="btn btn-primary px-40" type="button" onclick="view_grades()">View Grades</button>
                        </div>
                    </form>
                </div>



            </section>

            <?php if($this->uri->segment(3)) { 

              // echo count($students_list);
                ?>


            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <table class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>ID</th>
                                <th>Grade</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $i=1;
                            foreach($students_list as $student) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $student->fullname; ?></td>
                                    <td><?php echo $student->csmt_id; ?></td>
                                    <td><?php 
                                    $assignments = $this->assignment_m->get_assignments_by_class_all($student->class);
                                    //var_dump($assignments);

                                    $total_grade = 0;
                                    foreach ($assignments as $ass) {
                                        echo "Title : ".$ass->assignment_title." - "; 
                                        if (!empty($this->assignment_m->get_assignment_answer_id($ass->id,$student->student_id)->id) && !empty($this->assignment_m->get_assignment_grade($this->assignment_m->get_assignment_answer_id($ass->id,$student->student_id)->id)->grade)) {
                                            $grade = $this->assignment_m->get_assignment_grade($this->assignment_m->get_assignment_answer_id($ass->id,$student->student_id)->id)->grade;
                                         echo $this->assignment_m->get_assignment_grade($this->assignment_m->get_assignment_answer_id($ass->id,$student->student_id)->id)->grade;  }
                                        echo "<br/>";
                                        //var_dump($ass);
                                       // $total_grade += $grade;
                                    }
                                   // echo $total_grade;
                                     ?></td>
                                </tr>
                            <?php 
                            $i++;
                        } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php } ?>

    <?php $this->load->view('includes/footer'); ?> 
    <?php $this->load->view('assignment/script'); ?>  
    <!-- select picker -->
    <script src="<?php echo base_url(); ?>assets/vendor_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/advanced-form-element.js"></script>