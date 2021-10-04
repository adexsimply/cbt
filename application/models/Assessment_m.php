<?php

class Assessment_m extends CI_Model {   

    function __construct()
    {
        parent::__construct();
       // $this->load->library('datagrid');
    }

    /**
     * Datagrid Data
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

 
    public function add_assessment() {
      $user_id = $this->session->userdata('active_user')->id; 
      $assessment_id = "";
      if ($this->input->post('question_id')) {

        $question_id = $this->input->post('question_id');
        $assessment_id = $question_id;


      $food_id = $this->input->post('food_id');
      $question = $this->input->post('question');
      $instruction = $this->input->post('instruction');
      $comprehension = $this->input->post('comprehension');
      $option1 = $this->input->post('option1');
      $option2 = $this->input->post('option2');
      $option3 = $this->input->post('option3');
      $option4 = $this->input->post('option4');
      $answer = $this->input->post('answer');

      $i = 0;
      foreach($food_id as $key=>$val)
      {
        if (!empty($question[$key])) {
            $data[$i]['question'] = $question[$key];
            $data[$i]['question_id'] = $question_id;
            $data[$i]['instruction'] = $instruction[$key];
            $data[$i]['comprehension'] = $comprehension[$key];
            $data[$i]['option1'] = $option1[$key];
            $data[$i]['option2'] = $option2[$key];
            $data[$i]['option3'] = $option3[$key];
            $data[$i]['option4'] = $option4[$key];
            $data[$i]['answer'] = $answer[$key];
            $i++;
          
        }
      }
      $this->db->insert_batch('assessment_questions', $data);

      }

/////////
      else {
      $church_attendance = $this->input->post('church_attendance_id');
      $food_id = $this->input->post('food_id');
      $class_id = $this->input->post('class');
      $subject_id = $this->input->post('subject');
      $title = $this->input->post('title');
      $instruction = $this->input->post('instruction');
      $comprehension = $this->input->post('comprehension');
      $mark_per_question = $this->input->post('mark_per_question');
      $pass_mark = $this->input->post('pass_mark');
      $question_type = $this->input->post('question_type');
      $pass_mark = $this->input->post('pass_mark');
      $question = $this->input->post('question');
      $option1 = $this->input->post('option1');
      $option2 = $this->input->post('option2');
      $option3 = $this->input->post('option3');
      $option4 = $this->input->post('option4');
      $answer = $this->input->post('answer');



      $data1 = array(
          'pass_mark' => $pass_mark,
          'mark_per_question' => $mark_per_question,
          'question_type' => $question_type,
          'title' => $title,
          'file_name' => $title,
          'subject_id' => $subject_id,
          'class_id'=> $class_id
      );
      $insert = $this->db->insert('questions', $data1);
      $assessment_id = $this->db->insert_id();

      $i = 0;
      foreach($food_id as $key=>$val)
      {
        if (!empty($question[$key])) {
            $data[$i]['question'] = $question[$key];
            $data[$i]['question_id'] = $assessment_id;
            $data[$i]['instruction'] = $instruction[$key];
            $data[$i]['comprehension'] = $comprehension[$key];
            $data[$i]['option1'] = $option1[$key];
            $data[$i]['option2'] = $option2[$key];
            $data[$i]['option3'] = $option3[$key];
            $data[$i]['option4'] = $option4[$key];
            $data[$i]['answer'] = $answer[$key];
            $i++;
          
        }
      }
      $this->db->insert_batch('assessment_questions', $data);

      }

      return $assessment_id;

    }



    public function get_assessments_for_student() {
      $user_id = $this->session->userdata('active_user')->id;
      //Get Class
      $get_class_id = $this->db->select('class')->from('students')->where('user_id',$user_id)->get();
      $class_id_r = $get_class_id->row();
      $class_id = $class_id_r->class;

      $get_assignments =  $this->db->select('a.*,c.class_name,q.*,s.subject_name, a.id as exam_id, a.status as exam_status, a.date_created as date_scheduled')->from('assessments a')->join('class as c', 'a.class_id=c.id','left')->join('questions as q', 'a.question_id=q.id','left')->join('subjects as s', 'q.subject_id=s.id','left')->where('a.class_id',$class_id)->where('a.status',1)->order_by('a.id', 'DESC')->get();
      $assignments = $get_assignments->result();

        return $assignments;

    }

    public function get_assesments_for_admin() {
       $get_assignments = $this->db->select('a.*,u.username,c.class_name,s.subject_name')->from('assessments a')->join('users as u', 'a.teacher_id=u.id','left')->join('class as c', 'a.class_id=c.id','left')->join('subjects as s', 'a.subject_id=s.id','left')->where('a.status !=',3)->order_by('id', 'DESC')->get();
      $assignments = $get_assignments->result();

        return $assignments;

    }

    public function get_exams_for_admin() {
       $get_assignments = $this->db->select('a.*,c.class_name,q.*,s.subject_name, a.id as exam_id, a.status as exam_status, a.date_created as date_scheduled')->from('assessments a')->join('class as c', 'a.class_id=c.id','left')->join('questions as q', 'a.question_id=q.id','left')->join('subjects as s', 'q.subject_id=s.id','left')->order_by('a.id', 'DESC')->where('a.status !=', 3)->get();
      $assignments = $get_assignments->result();

        return $assignments;

    }


    public function get_taken_exams_for_admin() {
       $get_assignments = $this->db->select('a.*,c.class_name,c.class_system_id,q.*,s.subject_name, a.id as exam_id, a.status as exam_status, a.date_created as date_scheduled')->from('assessments a')->join('class as c', 'a.class_id=c.id','left')->join('questions as q', 'a.question_id=q.id','left')->join('subjects as s', 'q.subject_id=s.id','left')->order_by('a.id', 'DESC')->where('a.status', 3)->get();
      $assignments = $get_assignments->result();

        return $assignments;

    }


    public function get_questions_for_admin() {
       $get_assignments = $this->db->select('q.id,q.title,q.file_name,q.mark_per_question,q.question_type,q.date_created,c.class_name,s.subject_name')->from('questions q')->join('class as c', 'q.class_id=c.id','left')->join('subjects as s', 'q.subject_id=s.id','left')->order_by('id', 'DESC')->get();
      $assignments = $get_assignments->result();

        return $assignments;

    }

    public function get_assesments_for_admin_class($class_id) {
       $get_assignments = $this->db->select('a.*,u.username,c.class_name,s.subject_name')->from('assessments a')->join('users as u', 'a.teacher_id=u.id','left')->join('class as c', 'a.class_id=c.id','left')->join('subjects as s', 'a.subject_id=s.id','left')->where('a.status !=',3)->where('a.class_id',$class_id)->order_by('id', 'DESC')->get();
      $assignments = $get_assignments->result();

        return $assignments;

    }
    public function get_assesments_for_admin_archive() {
       $get_assignments = $this->db->select('a.*,u.username,c.class_name,s.subject_name')->from('assessments a')->join('users as u', 'a.teacher_id=u.id','left')->join('class as c', 'a.class_id=c.id','left')->join('subjects as s', 'a.subject_id=s.id','left')->where('a.status',3)->order_by('id', 'DESC')->get();
      $assignments = $get_assignments->result();

        return $assignments;

    }

    public function get_assesments_for_teacher() {
      $user_id = $this->session->userdata('active_user')->id;
       $get_assignments = $this->db->select('a.*,u.username,c.class_name,s.subject_name')->from('assessments a')->join('users as u', 'a.teacher_id=u.id','left')->join('class as c', 'a.class_id=c.id','left')->join('subjects as s', 'a.subject_id=s.id','left')->where('a.teacher_id',$user_id)->where('a.status !=',3)->order_by('id', 'DESC')->get();
      $assignments = $get_assignments->result();

        return $assignments;

    }

    public function get_duration_by_id ($id) {
        $get_duration = $this->db->select('duration')->from('assessments')->where('id',$id)->get();
        $duration = $get_duration->row();
        return $duration;

    }

    public function get_assessment_grade_for_student ($assessment_id) {
      $user_id = $this->session->userdata('active_user')->id;
        $get_grade = $this->db->select('*')->from('assessment_answers')->where('assessment_id',$assessment_id)->where('student_id',$user_id)->where('answer',1)->get();
        $grade = $get_grade->result();
        return $grade;

    }

    public function get_assessment_grade_for_teacher ($assessment_id,$student_id) {
        $get_grade = $this->db->select('*')->from('assessment_answers')->where('assessment_id',$assessment_id)->where('student_id',$student_id)->where('answer = correct')->get();
        $grade = $get_grade->result();
        return $grade;

    }
    public function get_assessment_grade_for_student2 ($assessment_id) {
      $user_id = $this->session->userdata('active_user')->id;
        $get_grade = $this->db->select('*')->from('assessment_answers')->where('assessment_id',$assessment_id)->where('student_id',$user_id)->get();
        $grade = $get_grade->result();
        return $grade;

    }
    public function get_exams_with_viewable_results(){
      $class_id = $this->session->userdata('active_user')->class;
      $user_id = $this->session->userdata('active_user')->id;
      $get_exams = $this->db->select('a.*,q.*,s.subject_name, a.id as exam_id, a.status as exam_status, a.date_created as date_scheduled')->from('assessments a')->join('questions as q', 'a.question_id=q.id','left')->join('subjects as s', 'q.subject_id=s.id','left')->where('show_results',1)->where('a.class_id',$class_id)->where('a.id IN (SELECT assessment_id FROM assessment_answers WHERE student_id='.$user_id.' )')->get();
       // $get_exams = $this->db->select('*')->from('assessments')->where('show_results',1)->where('class_id',$class_id)->where('id IN (SELECT assessment_id FROM assessment_answers WHERE student_id='.$user_id.' )')->get();
        $exams = $get_exams->result();
        return $exams;

    }
    public function check_if_exam_viewable($assessment_id){
      $get_exams = $this->db->select('show_results')->from('assessments')->where('id',$assessment_id)->get();
        $exams = $get_exams->row();
        return $exams;

    }
    public function check_if_my_result($assessment_id){
      $user_id = $this->session->userdata('active_user')->id;
      $get_exams = $this->db->select('id')->from('assessment_answers')->where('assessment_id',$assessment_id)->where('student_id',$user_id)->get();
        $exams = $get_exams->result();
        return $exams;


    }
    public function check_if_exam_in_progress ($assessment_id) {
      $user_id = $this->session->userdata('active_user')->id;
        $get_exam_progress = $this->db->select('*')->from('exam_logs')->where('assessment_id',$assessment_id)->where('student_id',$user_id)->where('status',1)->get();
        $exam_progress = $get_exam_progress->result();
        return $exam_progress;

    }
    public function check_if_exam_in_progress_for_student () {
      $user_id = $this->session->userdata('active_user')->id;
        $get_exam_progress = $this->db->select('*')->from('exam_logs')->where('student_id',$user_id)->where('status',1)->get();
        $exam_progress = $get_exam_progress->result();
        return $exam_progress;

    }
    public function check_active_exam () {
      $user_id = $this->session->userdata('active_user')->id;
        $get_exam_progress = $this->db->select('*')->from('exam_logs')->where('student_id',$user_id)->where('status',1)->LIMIT(1)->order_by('id','DESC')->get();
        $exam_progress = $get_exam_progress->row();
        return $exam_progress;

    }
    public function get_assessment_grade_for_teacher2 ($student_id,$assessment_id) {
      $user_id = $this->session->userdata('active_user')->id;
        $get_grade = $this->db->select('*')->from('assessment_answers')->where('assessment_id',$assessment_id)->where('student_id',$student_id)->get();
        $grade = $get_grade->result();
        return $grade;

    }
    public function get_assessment_question_by_id ($assessment_question_id) {
      $user_id = $this->session->userdata('active_user')->id;
        $get_grade = $this->db->select('*')->from('assessment_questions')->where('id',$assessment_question_id)->get();
        $grade = $get_grade->row();
        return $grade;

    }
    public function get_assessment_option_by_id ($assessment_option_id) {
      $user_id = $this->session->userdata('active_user')->id;
        $get_grade = $this->db->select('*')->from('assessment_questions')->where('id',$assessment_question_id)->get();
        $grade = $get_grade->row();
        return $grade;

    }

    public function get_assessment_correct_option_by_id ($assessment_correct_id) {
      $user_id = $this->session->userdata('active_user')->id;
        $get_grade = $this->db->select('*')->from('assessment_questions')->where('id',$assessment_question_id)->get();
        $grade = $get_grade->row();
        return $grade;

    }
    public function get_questions_by_id_admin($id) {

        $get_questions = $this->db->select('*')->from('assessment_questions')->where('question_id',$id)->order_by('id','ASC')->get();
        $questions = $get_questions->result();
        return $questions;

    }
    ///Get details of Exam by exam id (question_id)
    public function get_questions_details_by_id($id) {

        $get_questions = $this->db->select('title,file_name')->from('questions')->where('id',$id)->get();
        $questions = $get_questions->row();
        return $questions;

    }
    ///Get details of Exam by exam id (question_id)
    public function get_questions_details_by_id2($id) {

        $get_questions = $this->db->select('*')->from('questions')->where('id',$id)->get();
        $questions = $get_questions->row();
        return $questions;

    }
    public function get_questions_by_id($id) {

        $get_questions = $this->db->select('*')->from('assessment_questions')->where('question_id IN (SELECT question_id FROM assessments WHERE id = '.$id.')')->order_by('id','ASC')->get();
        $questions = $get_questions->result();
        return $questions;

    }
    public function get_total_questions($id) {

        $this->db->select('id');
        $this->db->from('assessment_questions');
        $this->db->where('question_id',$id);
        return $this->db->count_all_results();

    }
public function assessment_options($option) {
  if ($option ==1) {
    return "A";
  }
  elseif ($option == 2) {
    return "B";
  }
  elseif ($option == 3) {
    return "C";
  }
  elseif ($option == 4){
    return "D";
  }
  else {
    return $option;
  }
}



  public function get_question_by_id(){
        $id = $this->input->post('id');
        $get_question = $this->db->select('*')->from('assessment_questions')->where('id', $id)->get();
        $question_list = $get_question->row();
        return $question_list;
    }

  public function get_question_by_id2($question_id){

        $get_question = $this->db->select('*')->from('assessment_questions')->where('id', $question_id)->get();
        $question_list = $get_question->row();
        return $question_list;
    }

  public function get_image_by_question_id($question_id){

        $get_question = $this->db->select('image')->from('assessment_questions')->where('id', $question_id)->get();
        $question_list = $get_question->row();
        return $question_list;
    }
  public function get_exam_by_id($question_id){

        $get_question = $this->db->select('*')->from('assessments')->where('id', $question_id)->get();
        $question_list = $get_question->row();
        return $question_list;
    }
  public function check_if_show_result($assessment_id){

        $get_question = $this->db->select('show_results')->from('assessments')->where('id', $assessment_id)->get();
        $question_list = $get_question->row();
        return $question_list;
    }
  public function check_if_shuffle($assessment_id){

        $get_question = $this->db->select('shuffle')->from('assessments')->where('id', $assessment_id)->get();
        $question_list = $get_question->row();
        return $question_list;
    }
public function get_submitted_students ($assessment_id) {
  $get_students = $this->db->select('DISTINCT (student_id)')->from('assessment_answers')->where('assessment_id', $assessment_id)->get();
  $students = $get_students->result();
  return $students;
}

/////
public function create_new_schedule () {
  if ($this->input->post('autograde')) {
    $autograde = 1;
  }
  else {
    $autograde = 0;
  }
  if ($this->input->post('shuffle')) {
    $shuffle = 1;
  }
  else {
    $shuffle = 0;
  }


      if ($this->input->post('exam_id')) {

        $data2 = array(
            //'duration' =>  $this->input->post('duration'),
            'class_id' =>  $this->input->post('class'),
            'exam_type' =>  $this->input->post('exam_type'),
            'duration' =>  $this->input->post('duration'),
            'auto_grade' =>  $autograde,
            'shuffle' =>  $shuffle
        );
        $this->db->where('id', $this->input->post('exam_id'));
        $this->db->update('assessments', $data2);

      }
      else {

        $data = array(
            //'duration' =>  $this->input->post('duration'),
            'class_id' =>  $this->input->post('class'),
            'exam_type' =>  $this->input->post('exam_type'),
            'duration' =>  $this->input->post('duration'),
            'question_id' =>  $this->input->post('question_id'),
            'auto_grade' =>  $autograde,
            'shuffle' =>  $shuffle
        );
        $insert = $this->db->insert('assessments', $data);

      }

}

}