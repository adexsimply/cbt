<?php

class Examination_m extends CI_Model {   

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

    public function get_students_by_exam_id2($assessment_id) {
      if ($this->input->get('school')) {
        $school = $this->input->get('school');
        $school_q = 'user_id IN(SELECT user_id FROM students WHERE user_id=a.student_id AND school_type='.$school.' )';
      }
      else {
          $school_q = '1=1';
      }

      if ($this->input->get('arm')) {
        $arm = $this->input->get('arm');
        $get_aagc_id = $this->db->select('id')->from('aagc')->where('alias_id',$arm)->where('group_class_id',$class_id)->get();
        $aagc_id2 = $get_aagc_id->row();
        $aagc_id = $aagc_id2->id; 
        $arm_q = 'user_id IN(SELECT user_id FROM students WHERE aagc_id='.$aagc_id.' )';
      }
      else {
          $arm_q = '1=1';
      }

      $get_students = $this->db->select('DISTINCT (a.student_id), s.fullname,s.csmt_id,ass.question_id,q.mark_per_question,c.class_name,class_group_id,aagc.*,al.name as alias_name,sub.subject_name,ex.time_started,ex.time_submitted')->from('assessment_answers a')->join('students as s', 's.user_id=a.student_id', 'LEFT')->join('class as c', 's.class=c.id','left')->join('aagc as aagc', 'aagc.id=s.aagc_id', 'left')->join('aliases as al', 'aagc.alias_id=al.id', 'left')->join('assessments as ass', 'ass.id=a.assessment_id', 'LEFT')->join('questions as q', 'ass.question_id=q.id', 'LEFT')->join('subjects as sub', 'q.subject_id=sub.id', 'LEFT')->join('exam_logs as ex', 'a.assessment_id=ex.assessment_id AND ex.student_id=a.student_id', 'LEFT')->where($school_q)->where($arm_q)->where('a.assessment_id', $assessment_id)->get();
      $students = $get_students->result();
      return $students;
    }

    public function get_students_by_exam_id($assessment_id,$class_id) {
      if ($this->input->get('school')) {
        $school = $this->input->get('school');
        $school_q = 'user_id IN(SELECT user_id FROM students WHERE user_id=a.student_id AND school_type='.$school.' )';
      }
      else {
          $school_q = '1=1';
      }

      if ($this->input->get('arm')) {
        $arm = $this->input->get('arm');
        $get_aagc_id = $this->db->select('id')->from('aagc')->where('alias_id',$arm)->where('group_class_id',$class_id)->get();
        if($get_aagc_id->num_rows() >0) {

        $aagc_id2 = $get_aagc_id->row();

        $aagc_id = $aagc_id2->id; 
        $arm_q = 'user_id IN(SELECT user_id FROM students WHERE aagc_id='.$aagc_id.' )';
        }
        else {

        $arm_q = 'user_id IN(SELECT user_id FROM students WHERE aagc_id=0 )';
        }
      }
      else {
          $arm_q = '1=1';
      }

      $get_students = $this->db->select('DISTINCT (a.student_id), s.fullname,s.csmt_id,ass.question_id,q.mark_per_question,c.class_name,class_group_id,aagc.*,al.name as alias_name,sub.subject_name,ex.time_started,ex.time_submitted')->from('assessment_answers a')->join('students as s', 's.user_id=a.student_id', 'LEFT')->join('class as c', 's.class=c.id','left')->join('aagc as aagc', 'aagc.id=s.aagc_id', 'left')->join('aliases as al', 'aagc.alias_id=al.id', 'left')->join('assessments as ass', 'ass.id=a.assessment_id', 'LEFT')->join('questions as q', 'ass.question_id=q.id', 'LEFT')->join('subjects as sub', 'q.subject_id=sub.id', 'LEFT')->join('exam_logs as ex', 'a.assessment_id=ex.assessment_id AND ex.student_id=a.student_id', 'LEFT')->where($school_q)->where($arm_q)->where('a.assessment_id', $assessment_id)->get();
      $students = $get_students->result();
      return $students;
    }


    public function get_score_by_student_id($assessment_id,$student_id) {
      $this->db->select('id');
        $this->db->from('assessment_answers');
        $this->db->where('assessment_id',$assessment_id);
        $this->db->where('student_id',$student_id);
        $this->db->where('is_correct',1);
        return $this->db->count_all_results();


    }  
      public function get_score_by_student_id2($assessment_id) {

      $user_id = $this->session->userdata('active_user')->id;
      $this->db->select('id');
        $this->db->from('assessment_answers');
        $this->db->where('assessment_id',$assessment_id);
        $this->db->where('student_id',$user_id);
        $this->db->where('is_correct',1);
        return $this->db->count_all_results();


    }

    public function get_exam_grade_for_student($assessment_id,$student_id) {
        $get_grade = $this->db->select('*')->from('assessment_answers')->where('assessment_id',$assessment_id)->where('student_id',$student_id)->get();
        $grade = $get_grade->result();
        return $grade;

    }
    // public function get_questions_by_id($id) {

    //     $get_questions = $this->db->select('*')->from('assessment_questions')->where('assessment_id',$id)->get();
    //     $questions = $get_questions->result();
    //     return $questions;

    // }
    public function remark_scores () {


      foreach ($this->input->post('answer_id[]') as $answer_id) {
        $data_scores = array(
          'is_correct' => 1
        );

        $this->db->where('id', $answer_id);
        $this->db->update('assessment_answers',$data_scores);
      }
    }

    public function get_question_details($assessment_id) {

      $get_question_id = $this->db->select('question_id')->from('assessments')->where('id', $assessment_id)->get();
      if($get_question_id->num_rows() > 0) {
        $question_id_row = $get_question_id->row();
        $question_id = $question_id_row->question_id;

        ///////
        $get_question = $this->db->select('q.id as question_id,question_type,q.subject_id,q.mark_per_question,q.pass_mark,s.subject_name')->from('questions q')->join('subjects as s', 'q.subject_id=s.id', 'LEFT')->where('q.id', $question_id)->get();
        $question_list = $get_question->row();
        return $question_list;
      }
    }

    public function get_question_details2($assessment_id) {

      // $get_question_id = $this->db->select('question_id')->from('assessments')->where('id', $assessment_id)->get();
      // if($get_question_id->num_rows() > 0) {
      //   $question_id_row = $get_question_id->row();
      //   $question_id = $question_id_row->question_id;

        ///////
        $get_question = $this->db->select('a.*,q.id as question_id,q.subject_id,q.mark_per_question,q.pass_mark,s.subject_name')->from('assessments a')->join('questions as q', 'a.question_id=q.id', 'LEFT')->join('subjects as s', 'q.subject_id=s.id', 'LEFT')->where('a.id', $assessment_id)->get();
        $question_list = $get_question->row();
        return $question_list;
     // }



    }

}