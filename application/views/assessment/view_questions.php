<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Questions</h2>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class=" pull-left btn-toolbar">
                                <a style="margin: 5px;" href="<?php echo base_url().'assessment/questions'; ?>"><button class="btn btn-secondary"  >
                                  <i class="fa fa-step-backward"></i> Back to Main List
                                </button></a>
                </div>
                <div class=" pull-right btn-toolbar">
                                <a style="margin: 5px;" href="<?php echo base_url().'assessment/import/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>"><button class="btn btn-primary"  >
                                  <i class="fa fa-plus"></i> Upload More Questions
                                </button></a>
                                <a style="margin: 5px;" href="<?php echo base_url().'assessment/add_questions/'.$this->uri->segment(3); ?>"><button class="btn btn-warning">
                                  <i class="fa fa-plus"></i> Add Question Manually
                                </button></a>
                                <?php if ($active_user->role_id==1) { ?>
                               <!--  <a onclick="accept_assessment('<?php echo $this->uri->segment(3); ?>')" style="margin: 5px;"><button class="btn btn-social btn-twitter mb-5 pull-right">
                                  <i class="fa fa-plus"></i> Accept Quiz
                                </button></a> -->
                               <!--   <a href="<?php echo base_url().'assessment/download_excel/'.$this->uri->segment(3); ?>"><button class="btn btn-social btn-facebook mb-5 pull-right">
                                  <i class="fa fa-file"></i> Download Excel
                                </button></a> -->
                               <?php } ?>
                </div>
                <div class="card patients-list">
                      <div class="header">
                          <h2>Questions List</h2>
                          <h2>Title: <?php echo $question_details->title; ?></h2>
                          <h2>File Name: <?php echo $question_details->file_name; ?></h2>
                      </div>
                      <div class="body">
                          <!-- Nav tabs -->

                          <!-- Tab panes -->
                          <div class="tab-content m-t-10 padding-0">
                              <div class="tab-pane table-responsive active show" id="AllClassArm">
                            				  <table id="questionsListTable" class="table table-bordered">
                                        <thead>
                                					<tr>
                                            <th style="width:1%;">S/N</th>
                                            <th style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">Question</th>
                                            <th style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">Instruction</th>
                                            <th style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">Comp</th>
                                            <th style="width:10%;">Image</th>
                                            <th style="width:10%;">A</th>
                                            <th style="width:10%;">B</th>
                                            <th style="width:10%;">C</th>
                                            <th style="width:10%;">D</th>
                                            <th style="width:1%;">Ans</th>
                                            <th style="width:10%;">Option</th>
                                					</tr>
                                        </thead>
                            					<?php 
                            					$i = 1;
                            					foreach ($assessment_questions as $question) { 
                            						?>
                            					<tr>
                            					  <td><?php echo $i; ?></td>
                            					  <td style="word-wrap: break-word;min-width: 200px;max-width: 160px;white-space:normal;"><?php echo $question->question; ?></td>
                                        <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php echo $question->instruction; ?></td>
                                        <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;"><?php echo substr($question->comprehension, 0,40); if(strlen($question->comprehension) > 40) { echo  '...';} ?></td>
                                        <td><?php if (!empty($question->image)) {  ?><a href="<?php echo base_url().'uploads/'.$question->image; ?>">Image</a><?php } ?><i class="fa fa-edit" onclick="image_dialog(event)" data-type="black" data-size="m" data-title="Edit Image -- <?php echo $question->question; ?>" href="<?php echo base_url('assessment/edit_image/' . $question->id) ?>"></i> </td>
                            					  <td style="word-wrap: break-word;min-width: 100px;max-width: 160px;white-space:normal;"><?php echo $question->option1; ?></td>
                            					  <td style="word-wrap: break-word;min-width: 100px;max-width: 160px;white-space:normal;"><?php echo $question->option2; ?></td>
                            					  <td style="word-wrap: break-word;min-width: 100px;max-width: 160px;white-space:normal;"><?php echo $question->option3; ?></td>
                            					  <td style="word-wrap: break-word;min-width: 100px;max-width: 160px;white-space:normal;"><?php echo $question->option4; ?></td>
                            					  <td style="word-wrap: break-word;min-width: 10px;max-width: 60px;white-space:normal;"><?php echo $this->assessment_m->assessment_options($question->answer); ?></td>
                            					  <td>
                                          <button class="btn btn-dark m-b-15 m-t-15" type="button" title="add_consultation_btn" onclick="question_dialog(event)" data-type="black" data-size="l" data-title="Edit -- <?php echo $question->question; ?>" href="<?php echo base_url('assessment/edit_question/' . $question->id) ?>"><i class="fa fa-edit"></i></button> <button class="btn btn-success m-b-15 m-t-15" onclick="delete_question(<?php echo $question->id; ?>)"><i class="fa fa-trash"></i></button></td>
                            					</tr>
                            				<?php 
                            				$i++;
                            			} ?>
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
<?php $this->load->view('assessment/script'); ?>  
<?php $this->load->view('assessment/modal-question'); ?>  