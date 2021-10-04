    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Grade Students</h2>
            </div>
            <form id="remark-scores">

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Instruction</th>
                                    <th>Question</th>
                                    <th>Correct Answer</th>
                                    <th>Student's Answer</th>
                                    <th>Mark</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                  $i_material = 1;
                                  foreach ($assessment_grade as $material) { 
                                    //$term_status = $terms->term_status;
                                    ?>
                                  <tr>
                                    <td><?php echo $i_material; ?></td>
                                    <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->instruction; ?></td>
                                    <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->question; ?></td>
                                    <td><?php $correct = $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->answer; 
                                    if ($correct == 1) {
                                        echo "A";
                                    }
                                    elseif ($correct == 2) {
                                        echo "B";
                                    }
                                    elseif ($correct == 3) {
                                        echo "C";
                                    }
                                    elseif ($correct == 4) {
                                        echo "D";
                                    }
                                    else {
                                        echo $correct;
                                    }
                                    ?></td>
                                    <td><?php $mine = $material->answer; 
                                       if ($mine == 1) {
                                        echo "A";
                                    }
                                    elseif ($mine == 2) {
                                        echo "B";
                                    }
                                    elseif ($mine == 3) {
                                        echo "C";
                                    }
                                    elseif ($mine == 4) {
                                        echo "D";
                                    }
                                    else {
                                        echo $mine;
                                    }
                                    ?></td>
                                    <td> <input type="checkbox" id="answer_id<?php echo $material->id; ?>" class="filled-in" name="answer_id[]" <?php if ($material->is_correct=='1'){ echo "checked"; } ?> value="<?php echo $material->id; ?>" /><label for="answer_id<?php echo $material->id; ?>"></label></td>
                              </tr>
                                <?php $i_material++;
                              }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>