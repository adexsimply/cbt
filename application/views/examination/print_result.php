    <!DOCTYPE html>
    <html>
    <head>
        <title>Print Result</title>    
        <link href="<?php echo base_url().'assets/css/bootstrap.css' ?>" rel="stylesheet" >
        <style type="text/css">
          html, body {
            margin: 0;
            padding: 0;
          }
          .page {
            width: 1000px;
            margin: auto;
          }
          
          .main-top {
            background-color: #fff;
            padding: 15px 20px;
          }
          .main-top img {
            width: 120px;
            float: left;
            height: 90px;
          }
          .main-top div {
            //width: 70%;
            text-align: center;
            margin: auto;
          }
          .main-top h1 {
            margin: 0;
            font-size: 28px;
            font-family: "Times New Roman", Times, serif;
            text-transform: uppercase;
            font-weight: bold;
            color: blue;
          }
          .main-top h2 {
            margin-bottom: 0;
            margin-left: 25px;
            font-size:17px;
            font-family: 'Sakkal Majalla', bold;
            letter-spacing: 0.5px;
            color: blue;
            font-weight: bold;
            line-height: 10px;
          }
          .main-top p {
            font-family: 'Sakkal Majalla', bold;
            margin: 0;
            font-size: 19px;
            font-weight: bold;
            line-height: 20px;
          }

          .input {
            font-family: 'Courier New', monospace;
            text-transform: uppercase;
          }
          .main td{
            font-family: 'Sakkal Majalla', bold;
            font-size: 13px;
            line-height: 1px;
            letter-spacing: 1px;
          }
          .blue-st {
            color: blue;
          } 
          .blue-com {
            font-family: "Comic Sans MS", cursive, sans-serif;
            text-transform: uppercase;
            font-size: 13px;
            color: blue;
          } 
          .blue-subj {
            color: blue !important;
          } 
      .panel-heading {
         background-color:#6A0691 !important;
         //box-shadow: 5px 5px 5px black;
      }
      .panel-heading h4{
         color:yellow !important;
        font-family: 'Sakkal Majalla', bold !important;
        font-weight: bold;
        font-size: 15px;
        text-align: center;
        line-height: 5px;
      }
      p{
        font-family: 'Sakkal Majalla', bold !important; 
        font-size: 15px;
      }
      .table-bordered > thead > tr > th,
      .table-bordered > tbody > tr > th,
      .table-bordered > tfoot > tr > th,
      .table-bordered > thead > tr > td,
      .table-bordered > tbody > tr > td,
      .table-bordered > tfoot > tr > td {
        border: 1px solid black !important;
        padding: 3px;
      }
          
        </style>
          <style type="text/css" media="print">
          @page 
          {
              size: auto;   /* auto is the initial value */
              margin: 1mm;  /* this affects the margin in the printer settings */
          }
          .main-top img {
            width: 120px;
            float: left;
            height: 90px;
          }
          .main-top div {
            //width: 70%;
            text-align: center;
            margin: auto;
          }
          .main-top h1 {
            margin: 0;
            font-size: 30px;
            font-family: "Times New Roman", Times, serif;
            text-transform: uppercase;
            font-weight: bold;
            color: blue !important;
          }
          .main-top h2 {
            margin-bottom: 0;
            font-size:17px;
            font-family: 'Sakkal Majalla', bold;
            letter-spacing: 0.5px;
            color: blue !important;
            font-weight: bold;
            line-height: 10px;
          }
          .main-top p {
            font-family: 'Sakkal Majalla', bold !important;
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            line-height: 20px;
          }

          .input {
            font-family: 'Courier New', monospace;
            text-transform: uppercase;
          }
          .main td{
            font-family: 'Sakkal Majalla', bold;
            font-size: 15px;
            line-height: 1px;
            letter-spacing: 0.001px;
            border: 1px solid black;
            padding: 2px;
          }
          
          .blue-st {
            color: blue !important;
          } 
          .blue-com {
            font-family: "Comic Sans MS", sans-serif;
            font-size: 13px;
            text-transform: uppercase;
            color: blue !important;
          } 
          .blue-subj {
            color: blue !important;
          } 
      .panel-heading {
         background-color:#6A0691 !important;
         //box-shadow: 10px 10px 5px #888888;
      }
      .panel-heading h4{
         color:yellow !important;
        font-family: 'Sakkal Majalla', bold !important;
        font-weight: bold;
        font-size: 15px;
        text-align: center;
        line-height: 5px;
      }
      .table-bordered > thead > tr > th,
      .table-bordered > tbody > tr > th,
      .table-bordered > tfoot > tr > th,
      .table-bordered > thead > tr > td,
      .table-bordered > tbody > tr > td,
      .table-bordered > tfoot > tr > td {
        border: 1px solid black !important;
        padding: 3px;
      }
       body 
          {
              background-color:#FFFFFF; 
              border: solid 0px black ;
              margin: 1px;  /* this affects the margin on the content before sending to printer */

         }
      </style>
    </head>
    <body>
    
       <div class="page" style="padding:25px;">
          <div class="main-top">
            <div>
            <img src="<?php echo base_url(); ?>assets/img/csmt-logo.jpeg" width="300px">
              <h1>CSMT Staff Secondary School</h1>
              
              <p>Along Watchman Street, P.M.B. 147, Abakaliki, Ebonyi State, Nigeria<br>
              <strong>Email:</strong> csmtschools@gmail.com  <strong>Tel:</strong> 08032124870, 07060725882</p>
              <h2><?php 
              $question_details = $this->examination_m->get_question_details2($this->uri->segment(3));
               echo "Exam Result | ".$question_details->subject_name." | ". $question_details->exam_type." | ". $question_details->date_created; ?></h2>
            </div>
          </div>
                  <div class="main">
                  <div class="panel panel-info" style="line-height:1;">
                    <!-- <div class="panel-heading"><h4 style="margin:0;">ACADEMIC REPORT (COGNITIVE DOMAIN)</h4></div> -->
<?php //var_dump($question_details = $this->examination_m->get_question_details2($this->uri->segment(3))) ?>

                  <!-- Grade head -->
                    <table class="table table-bordered table-striped table-condensed" style="line-height:1px;border: 1px solid black;" width="100%">
                        <thead>
                          <tr style="border-bottom:2px solid black;">
                                <th>#</th>
                                <th style="text-align:center"class="blue-st">Name</th>
                                <th style="text-align:center"class="blue-st">ID</th>
                                <th style="text-align:center"class="blue-st">Class</th>
                                <th style="text-align:center"class="blue-st">Class Name</th>
                                <th style="text-align:center"class="blue-st">Subject</th>
                                <th style="text-align:center"class="blue-st">Questions</th>
                                <th style="text-align:center"class="blue-st">Score</th>
                                <th style="text-align:center"class="blue-st">Total</th>
                            </tr>
                        </thead>
                        <tbody class="input">
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
                                <td><?php echo $this->assessment_m->get_total_questions($student_list->question_id); ?></td>
                                <td><?php echo round($this->examination_m->get_score_by_student_id($this->uri->segment(3),$student_list->student_id) * $student_list->mark_per_question); ?></td>
                                <td><?php echo $this->assessment_m->get_total_questions($student_list->question_id) * $student_list->mark_per_question; ?></td>
                            </tr>
                            <?php 
                            $i++;
                            } ?>
                        </tbody>
                  </table>
            </div>



        </div>
    </div>
    </body>
    </html>