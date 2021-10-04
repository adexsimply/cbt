<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Results List</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
              <div class=" pull-right btn-toolbar">
              </div>
                <div class="card patients-list">
                    <div class="body">
                        <!-- Nav tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="AllClassArm">
                             <table id="" class="table table-bordered table-striped">
				                      <thead>
				                        <tr>
				                          <th>S/N</th>
				                          <th>Question</th>
				                          <th>Correct Answer</th>
				                          <th>My Answer</th>
				                          <th>Key</th>
				                        </tr>
				                      </thead>
				                      <tbody>
				                        <?php 
				                              $i_material = 1;
				                              foreach ($corrections as $material) { 
				                                //$term_status = $terms->term_status;
				                                ?>
				                              <tr>
				                                <td style="width: 10px;"><?php echo $i_material; ?></td>
				                                <td style="word-wrap: break-word;min-width: 180px;max-width: 180px;white-space:normal;"><?php echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->question; ?></td>
				                                <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php $correct = $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->answer; 
				                                if ($correct == 1) {
				                                    echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option1;
				                                }
				                                elseif ($correct == 2) {
				                                    echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option2;
				                                }
				                                elseif ($correct == 3) {
				                                    echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option3;
				                                }
				                                elseif ($correct == 4) {
				                                    echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option4;
				                                }
				                                else {
				                                	echo $correct;
				                                }
				                                ?></td>
				                                <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php $mine = $material->answer; 
				                                   if ($mine == 1) {
				                                    echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option1;
				                                }
				                                elseif ($mine == 2) {
				                                    echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option2;
				                                }
				                                elseif ($mine == 3) {
				                                    echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option3;
				                                }
				                                elseif ($mine == 4) {
				                                    echo $this->assessment_m->get_assessment_question_by_id($material->assessment_question_id)->option4;
				                                }
				                                else {
				                                	echo $mine;
				                                }
				                                ?></td>
				                                <td>
				                                    <?php
				                                    if ($mine == $correct) {
				                                        echo "<font color=green>Correct</font>";

				                                    }
				                                    else {

				                                        echo "<font color=red>Wrong</font>";
				                                    }

				                                     ?>
				                                </td>
				                          </tr>
				                            <?php $i_material++;
				                          }
				                          ?>
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
