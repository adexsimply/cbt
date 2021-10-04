<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<style type="text/css">
    label {
        font-weight: 400;
    }
</style>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-steps/jquery.steps.css">

<div id="main-content">
    <div class="container-fluid">
     <!--    <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> View Examinations</h2>
                </div>
            </div>
        </div> -->

<?php //Select Active Exam
if($this->assessment_m->check_active_exam()) {

    $active_exam_id = $this->assessment_m->check_active_exam()->assessment_id;
    $exam_log_id = $this->assessment_m->check_active_exam()->id;
}

    else {
        redirect('/');
    }


$full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/".$active_exam_id;

$question_details = $this->examination_m->get_question_details($active_exam_id);

 ?>
        <input type="text" id="exam_id" name="" hidden value="<?php echo $active_exam_id; ?>">
        <input type="text" id="exam_log_id" name="" hidden value="<?php echo $exam_log_id; ?>">
        <input type="text" name="duration" hidden="" id="duration" value="<?php echo $this->assessment_m->get_duration_by_id($active_exam_id)->duration; ?>">
        <input type="text" name="full_url" hidden id="full_url" value="<?php echo $full_url.$active_user->id; ?>">
          
           <?php  if  (empty($this->assessment_m->get_assessment_grade_for_student2($active_exam_id))) { ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="p-3 mb-2 bg-primary text-white" style="background-color: #714E95 !important; margin-top: 20px;font-size: 18px;">CBT EXAMINATION | <?php echo strtoupper($question_details->subject_name);  ?> <span class="pull-right" id="display"></span> <span class="pull-right">TIME REMAINING : </span></div>
                        <div class="body" style="padding-top: 1px;">
                            <form action="<?php echo base_url().'assessment/submit'; ?>" id="add-assessment" method="post" class="row">
        <input type="text" id="exam_type" name="exam_type" hidden value="<?php echo $question_details->question_type; ?>">
                                <div id="wizard_vertical"><?php 
                                    $i =0;
                                    $j=1;

                                    $assessment_questions = $this->assessment_m->get_questions_by_id($active_exam_id);
                                   if ($this->assessment_m->check_if_shuffle($active_exam_id)->shuffle==1) {

                                   shuffle($assessment_questions);
                                        }
                                    foreach ($assessment_questions as $question) { 
                                        ?>
                                    <h2></h2>
                                    <section>
                                          <div class="row">
                                            <div class="col-sm-8">
                                                    <?php if (!empty($question->instruction)) { ?>
                                                    <h5>Instruction:</h5>
                                                    <p><?php echo $question->instruction; ?></p>
                                                    <?php } ?>
                                                    <?php if (!empty($question->comprehension)) { ?>
                                                    <h5>Comprehension:</h5>
                                                    <p style="overflow-y: scroll; max-height: 120px; background-color: white !important; "><?php echo $question->comprehension; ?></p>
                                                    <?php  } ?>
                                            </div>
                                            <div class="col-sm-4">
                                                    <?php if (!empty($question->image)) { ?>
                                                    <p style="color: red;font-size: 12px;">*Click on the image to enlarge</p>
                                                        <img onclick="expand_image_dialog(event)"  data-type="black" data-size="m" data-title="Image" href="<?php echo base_url('assessment/expand_image/' . $question->id) ?>" src="<?php echo base_url().'/uploads/'.$question->image; ?>" class="img-fluid" style="cursor:zoom-in;height: 100px;">
                                                    <?php } ?>
                                            </div>
                                          </div>
                                        <h5>Question <?php echo $j; ?>:</h5>
                                        <p><?php echo $question->question; ?></p>
                                        <div class="form-group">


                                            <input type="text" name="question[]" hidden="" value="<?php echo $question->id; ?>">
                                            <input type="text" name="assessment_id[]" hidden="" value="<?php echo $active_exam_id; ?>">
                                            <input type="text" name="assessment_idnum" hidden="" value="<?php echo $active_exam_id; ?>">
                                            
                                           <!--  <label for="" class="font-size-14">Question <?php echo $j; ?>: <?php echo $question->question; ?></label> -->
                                           <?php if ($question_details->question_type=='1') { ?>
                                            <div class="radio">
                                                A: <input name="option[<?php echo $i; ?>]" value="1" type="radio" id="Option_1<?php echo $question->id ?>">
                                                <label for="Option_1"><?php echo $question->option1; ?></label>
                                            </div>
                                            <div class="radio">
                                                B: <input name="option[<?php echo $i; ?>]" value="2" type="radio" id="Option_2<?php echo $question->id ?>">
                                                <label for="Option_2"><?php echo $question->option2; ?></label>
                                            </div>
                                            <div class="radio">
                                                C: <input name="option[<?php echo $i; ?>]" value="3" type="radio" id="Option_3<?php echo $question->id ?>" >
                                                <label for="Option_3"><?php echo $question->option3; ?></label>
                                            </div>
                                            <div class="radio">
                                                D <input name="option[<?php echo $i; ?>]" value="4" type="radio" id="Option_4<?php echo $question->id ?>" >
                                                <label for="Option_4"><?php echo $question->option4; ?></label>
                                            </div>
                                        <?php } 
                                        else {
                                        ?>
                                        <div>
                                            <textarea class="form-control" name="myanswer[]"></textarea>
                                        </div>
                                    <?php } ?>

                                        </div>
                                    </section>
                                    <?php 
                                    $j++;
                                    $i++;
                                    } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php } 
            else {
                echo "You've submitted this Examination";
            }

            ?>
            

    </div>
</div>
<?php $this->load->view('includes/footer'); ?>  
<script type="text/javascript">
    
//    var inFormOrLink;
//$('a').on('click', function() { inFormOrLink = true; });
//$('form').on('submit', function() { inFormOrLink = true; });

//$(window).on("beforeunload", function() { 
  //  return inFormOrLink ? "Do you really want to close?" : null; 
//})

    function submitExam() {
        var assessment_id = document.getElementById('exam_id').value;
 // alert("The paragraph was clicked.");
        var exam_log_id = '<?php echo $exam_log_id; ?>';
        //console.log(exam_log_id);

            $.confirm({
                    title: 'Submit Exam',
                    content: 'Do You want to Submit?',
                    icon: 'fa fa-check-circle',
                    type: 'green',
                    buttons: {
                        yes: function() {
                          ///update exam log
                          window.localStorage.clear()
                          localStorage.removeItem("full_url");
                         // storage.clear();

                            var formData = $('#add-assessment').serialize();

                            $("#submitExam").html("Saving data, please wait...");
                            $.post("<?php echo base_url() . 'assessment/submit'; ?>", formData).done(function(data) {

                             //localStorage.clear();
                            ////////////

                             window.location = "<?php echo base_url().'assessment/clearLocal'; ?>";

                            //  $.ajax({
                            // type  : 'post',
                            // url   : '<?php echo base_url('assessment/update_exam_log2'); ?>',
                            // data: {
                            //     id: exam_log_id,
                            //     assessment_id: assessment_id,
                            //   },
                            // async : false,
                            // success : function(response){

                            //  window.location = "<?php echo base_url().'assessment/clearLocal'; ?>";
                            // } });

                               // console.log(data);

                            });


                        },
                        no: function() {

                        }
                    }
                });

    }

// $(window).keydown(function(event) {
//   if (event.keyCode == 116) { // User presses F5 to refresh
//      refresh = true;
//    }
// });

// const form = document.getElementById('add-assessment');
// if (

// form.addEventListener("submit", (event) => {
// refresh = true;
// })
// );
// if ($('a').on('click', function() { refresh = true; })); 
// var refresh = false;  //Control variable to control refresh access
// $(window).bind('beforeunload', function(){
//     if (refresh == false) { // If F5 is not pressed
//         return "Do you really want to leave?";
//     }
// });
// console.log(refresh);
</script>
<!-- select picker -->
<?php $this->load->view('assessment/script-counter'); ?> 
<script src="<?php echo base_url(); ?>assets/vendor/jquery-steps/jquery.steps.js"></script> <!-- JQuery Steps Plugin Js -->

<script src="<?php echo base_url(); ?>assets/js/pages/forms/form-wizard.js"></script>