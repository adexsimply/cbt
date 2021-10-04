    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Grade Students</h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>ID</th>
                                <th>Class</th>
                                <th>Class Name</th>
                                <th>Subject</th>
                                <th>Started</th>
                                <th>Submitted</th>
                                <th>Questions</th>
                                <th>Score</th>
                                <th>Total</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php 
                        	$i =1;
                        	foreach($student_lists as $student_list) { ?>
                            <tr>
                                <td scope="row"><?php echo $i; ?></td>
                                <td><?php echo $student_list->fullname; ?></td>
                                <td><?php echo $student_list->csmt_id; ?></td>
                                <td><?php echo $student_list->class_name; ?></td>
                                <td><?php echo $student_list->alias_name; ?></td>
                                <td><?php echo $student_list->subject_name; ?></td>
                                <td><?php echo $student_list->time_started; ?></td>
                                <td><?php echo $student_list->time_submitted; ?></td>
                                <td><?php echo $this->assessment_m->get_total_questions($student_list->question_id); ?></td>
                                <td><?php echo round($this->examination_m->get_score_by_student_id($this->uri->segment(3),$student_list->student_id) * $student_list->mark_per_question); ?></td>
                                <td><?php echo $this->assessment_m->get_total_questions($student_list->question_id) * $student_list->mark_per_question; ?></td>
                                <td><button class="btn btn-primary m-b-15 m-t-15"  onclick="remark_exam_dialog(event)" data-type="black" data-size="xl" data-title="Re-mark" href="<?php echo base_url('examination/remark_exam/' . $this->uri->segment(3).'/'.$student_list->student_id); ?>"><i class="fa fa-check-circle"></i> <span>Re-mark</span></button>
                                    <?php if($active_user->role_id==1) { ?>
                                    <button type="button" class="btn btn-danger" onclick="retake_exam(<?php echo $this->uri->segment(3).','.$student_list->student_id; ?>)"><i class="fa fa-trash"></i> <span>Delete/Retake</span></button>
                                <?php } ?>
                                </td>
                            </tr>
                        	<?php 
                        	$i++;
                        	} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    