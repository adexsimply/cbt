<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends Base_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {

		
		parent::__construct();

		$this->load->model('user_m');
		$this->load->model('setup_m');
		$this->load->model('material_m');
		$this->load->model('assessment_m');
		$this->load->model('examination_m');

        $this->data['menu_id'] = 'assessment';

	}

	//Users
	public function index ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'CSMT-CBT :: Examination';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->session->userdata('active_user')->role_id == 1) {
		$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_admin();
		}
		if ($this->session->userdata('active_user')->role_id == 2) {
		$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_teacher();
		}
		$this->data['subjects_list'] = $this->material_m->get_subjects_for_admin1();
		$this->load->view('assessment/main', $this->data);
	}

	//Users
	public function questions ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'CSMT-CBT :: Questions';
		// $this->data['users_list'] = $this->user_m->get_users();
		// $this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->session->userdata('active_user')->role_id != 3) {
		$this->data['assessments_list'] = $this->assessment_m->get_questions_for_admin();
		}
		$this->data['subjects_list'] = $this->material_m->get_subjects_for_admin1();
		$this->load->view('assessment/main', $this->data);
	}
	//Users
	public function class ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Assessment';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->uri->segment(3)) {
		if ($this->session->userdata('active_user')->role_id == 1) {

		$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_admin_class($this->uri->segment(3));
			
		}
		if ($this->session->userdata('active_user')->role_id == 2) {
		$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_teacher();
		}
		$this->data['subjects_list'] = $this->material_m->get_subjects_for_admin1();
		$this->load->view('assessment/main', $this->data);

		}
		else {
			show_404();
		}
	}



    function validate_schedule()
    {
        $rules = [
            [
                'field' => 'class',
                'label' => 'Class',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'exam_type',
                'label' => 'Type',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'duration',
                'label' => 'Duration',
                'rules' => 'trim|required'
            ],

        ];
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {
            header("Content-type:application/json");
            echo json_encode('success');
        } else {
            header("Content-type:application/json");
            echo json_encode($this->form_validation->get_all_errors());
        }
    }

    public function save_schedule()
    {
        $this->assessment_m->create_new_schedule();
        header('Content-Type: application/json');
        echo json_encode('success');
    }



	//Users
	public function archive ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Assessment | Archive';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->session->userdata('active_user')->role_id == 1) {
		$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_admin_archive();
		}
		if ($this->session->userdata('active_user')->role_id == 2) {
		$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_teacher();
		}
		$this->data['subjects_list'] = $this->material_m->get_subjects_for_admin1();
		$this->load->view('assessment/main', $this->data);
	}


	//Users
	public function add_questions ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Assessment';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->session->userdata('active_user')->role_id == 1) {
		//$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_admin();
		$this->data['subjects_list'] = $this->material_m->get_subjects_for_admin1();
		}
		elseif ($this->session->userdata('active_user')->role_id == 2) {
		$this->data['subjects_list'] = $this->material_m->get_subjects_for_teacher();

		}

		if ($this->uri->segment(3)) {
		$this->load->view('assessment/add_question2', $this->data);

		}
		else {
		$this->load->view('assessment/add_question', $this->data);

		}
	}



	//Users
	public function import ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Assessment';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->session->userdata('active_user')->role_id == 1) {
		//$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_admin();
		$this->data['subjects_list'] = $this->material_m->get_subjects_for_admin1();
		}
		elseif ($this->session->userdata('active_user')->role_id == 2) {
		$this->data['subjects_list'] = $this->material_m->get_subjects_for_teacher();

		}

		if ($this->uri->segment(3)) {
		$this->load->view('assessment/import2', $this->data);

		}
		else {
		$this->load->view('assessment/import', $this->data);
			
		}
	}

	public function try_import () {
        $data = array(
            //'duration' =>  $this->input->post('duration'),
            'subject_id' =>  $this->input->post('subject'),
            'title' =>  $this->input->post('title'),
            'class_id' =>  $this->input->post('class'),
            'question_type' =>  $this->input->post('question_type'),
            'pass_mark' =>  $this->input->post('pass_mark'),
            'mark_per_question' =>  $this->input->post('mark_per_question')
        );
        $insert = $this->db->insert('questions', $data);

        $last_id = $this->db->insert_id();

	    redirect('assessment/import/'.$last_id.'/'.$this->input->post('question_type'));

	}


	//Users
	public function view_questions ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'View Assessment';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		///Assssment Questions

		if ($this->uri->segment(3)) {
		$this->data['assessment_questions'] = $this->assessment_m->get_questions_by_id_admin($this->uri->segment(3));
		$this->data['question_details'] = $this->assessment_m->get_questions_details_by_id($this->uri->segment(3));
		//////
		if ($this->session->userdata('active_user')->role_id == 3) {
		$this->data['assessment_questions'] = $this->assessment_m->get_questions_by_id($this->uri->segment(3));

		$this->data['assessment_grade'] = $this->assessment_m->get_assessment_grade_for_student($this->uri->segment(3));
		$this->load->view('assessment/view_questions_students', $this->data);

		}
			else {
		$this->load->view('assessment/view_questions', $this->data);

			}
		}
		else {

		$this->load->view('assessment/view_questions_students', $this->data);

		}

	}


	//Users
	public function download_excel ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Excel';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		///Assssment Questions

		if ($this->uri->segment(3)) {
		$this->data['assessment_questions'] = $this->assessment_m->get_questions_by_id($this->uri->segment(3));
		//////
		if ($this->session->userdata('active_user')->role_id == 1) {
		$this->load->view('assessment/download_excel', $this->data);

		}
		else {
			show_404();
		}

		}

	}

	public function check_if_exam_in_progress() {

        echo json_encode($this->assessment_m->check_if_exam_in_progress($this->input->post('assessment_id')));
	}

	public function update_exam_log() {

		$id = $this->input->post('assessment_id');

      	$student_id = $this->session->userdata('active_user')->id;

        $data = array(
            'status' => 1,
            'assessment_id' => $id,
            'student_id' => $student_id
        );
      $insert = $this->db->insert('exam_logs', $data);

	}
	public function update_exam_log2() {

		$id = $this->input->post('assessment_id');

      	$student_id = $this->session->userdata('active_user')->id;

         $data = array(
            'status' => 0,
            'time_submitted' => date('Y-m-d H:i:s'),
        );

		//$this->db->delete('exam_logs', $data);

       	$this->db->where('assessment_id', $id);
        $this->db->where('student_id', $student_id);
        $this->db->update('exam_logs', $data);

	}



	//Users
	public function view_questions2 ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'View Assessment';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		///Assssment Questions

		if ($this->uri->segment(3)) {
		$this->data['assessment_questions'] = $this->assessment_m->get_questions_by_id($this->uri->segment(3));
		//////
		if ($this->session->userdata('active_user')->role_id == 3) {

		$this->data['assessment_grade'] = $this->assessment_m->get_assessment_grade_for_student2($this->uri->segment(3));
		$this->load->view('assessment/view_grades_students', $this->data);
			}
			else {
		$this->data['assessment_grade'] = $this->assessment_m->get_assessment_grade_for_teacher2($this->uri->segment(3),$this->uri->segment(4));
		$this->load->view('assessment/view_grades_students', $this->data);

			}
		}

	}

	//Users
	public function view ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'View Assessment';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->session->userdata('active_user')->role_id == 1) {
		$this->data['assessments_list'] = $this->assignment_m->get_assignments_for_admin();
		}
		elseif ($this->session->userdata('active_user')->role_id == 2) {
		$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_teacher();
		}
		elseif ($this->session->userdata('active_user')->role_id == 3) {
		$this->data['assessments_list'] = $this->assessment_m->get_assessments_for_student();
		}
		//////
		$this->data['get_materials'] = $this->material_m->get_subjects_for_teacher();
		//$this->data['childview'] = 'dashboard/main';
		if ($this->uri->segment(3)) {
		////
		$this->data['assignment_info'] = $this->assignment_m->get_assignment_info($this->uri->segment(3));
		$this->data['assignment_comments'] = $this->assignment_m->get_assignment_comment($this->uri->segment(3));
		$this->load->view('assessment/view_item', $this->data);
		}
		else {

		if ($this->session->userdata('active_user')->role_id == 3) {

		$this->load->view('assessment/view-students', $this->data);
		}
		else {


		$this->load->view('assessment/view', $this->data);
		}
		}
	}

public function submit () {
	ob_start();
	$user_id = $this->session->userdata('active_user')->id;
	$question = $this->input->post('question');
	$correct = $this->input->post('answer');
	$answer = $this->input->post('option');
	$assessment_id = $this->input->post('assessment_id');



         $data = array(
            'status' => 0,
            'time_submitted' => date('Y-m-d H:i:s'),
        );

		//$this->db->delete('exam_logs', $data);

       	$this->db->where('assessment_id', $id);
        $this->db->where('student_id', $user_id);
        $this->db->update('exam_logs', $data);


	foreach($question as $option_num => $option_val) {
		///Check for correct answer
		$query_check_answer = $this->db->select('answer')->from('assessment_questions')->where('id', $question[$option_num])->get();
		$check_answer_row = $query_check_answer->row();
		$answerit = $check_answer_row->answer;
		if ($answerit == $answer[$option_num]) {
			$is_correct = 1;
		}
		else {
			$is_correct = 0;
		}
		 $data = array(
            'student_id' => $user_id,
            'assessment_question_id' => $question[$option_num],
            'answer' => $answer[$option_num],
            'correct_answer' => $answerit,
            'is_correct' => $is_correct,
            'assessment_id' => $assessment_id[$option_num],
        );

		 $query_search_answer = $this->db->select('*')->from('assessment_answers')->where('assessment_question_id', $question[$option_num])->where('student_id',$user_id)->get();
		 if ($query_search_answer->num_rows() < 1) {

			$this->db->insert('assessment_answers',$data);
		 }

	}


	    redirect('assessment/view');

}

public function edit_question()
{
    if ($this->uri->segment(3)) {
    	$this->data['question_details'] = $this->assessment_m->get_question_by_id2($this->uri->segment(3));

	$this->load->view('assessment/edit_question_modal', $this->data);

    }

  }

public function test_upload()
{
    if ($this->uri->segment(3)) {
    	$this->data['question_details'] = $this->assessment_m->get_question_by_id2($this->uri->segment(3));

	$this->load->view('assessment/test_upload', $this->data);

    }

  }

public function edit_image()
{
    if ($this->uri->segment(3)) {
    	$this->data['question_details'] = $this->assessment_m->get_question_by_id2($this->uri->segment(3));

	$this->load->view('assessment/question_image_modal', $this->data);

    }

 }

public function expand_image()
{
    if ($this->uri->segment(3)) {
    	$this->data['image_details'] = $this->assessment_m->get_image_by_question_id($this->uri->segment(3));

	$this->load->view('assessment/expand_image_modal', $this->data);

    }

 }

public function schedule_exam()
{
    if ($this->uri->segment(3)) {
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->uri->segment(4))
		{

    	$this->data['question_details'] = $this->assessment_m->get_exam_by_id($this->uri->segment(4));
		}

	$this->load->view('assessment/schedule_exam_modal', $this->data);

    }

 }

public function upload_image()
{

            if ($_FILES['image']['error'] != 0) {
                $result['status'] = false;
                $result['message'] = array("image" => "Select image to upload");
            } else {
                $config['upload_path']       = './uploads/';
                $config['allowed_types']     = 'gif|jpg|jpeg|png';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {
                    $data['upload_data'] = $this->upload->data('file_name');
                    $image_name = $data['upload_data'];
                } else {
                    $image_name = '';
                }

                $data = array(
                    'image'         => $image_name,
                );


                $result['status'] = true;

		        $this->db->where('id', $this->input->post('question_id'));
		        $this->db->update('assessment_questions', $data);

                $result['message'] = "Data inserted successfully.";
                  echo json_encode($result);
            }


 }


	public function add_assessment()
        {                

        	$add_assessment = $this->assessment_m->add_assessment();

			header('Content-Type: application/json');
	    	echo json_encode($add_assessment);
        }

	public function delete_assessment()
	{
		$id = $this->input->post('id');
		$this->db->delete('assessments', array('id' => $id));
	}

	public function delete_question_main()
	{
		$id = $this->input->post('id');
		$this->db->delete('questions', array('id' => $id));
		$this->db->delete('assessment_questions', array('question_id' => $id));
	}

	public function delete_question()
	{
		$id = $this->input->post('id');
		$this->db->delete('assessment_questions', array('id' => $id));
	}
	public function delete_answer()
	{
		$id = $this->input->post('id');
		$this->db->delete('assessment_answers', array('id' => $id));
	}

	public function reset()
	{
		//$id = $this->input->post('id');
		$this->db->delete('assessment_answers', array('student_id' => $this->uri->segment(3),'assessment_id'=>$this->uri->segment(4)));
	}

	public function accept_assessment()
	{
		$id = $this->input->post('id');
        $data = array(
            'status' => 1
        );
        $this->db->where('id', $id);
        $this->db->update('assessments', $data);
	}



	public function update_question()
	{
		$id = $this->input->post('question_id');
        $data = array(
            'question' => $this->input->post('question'),
            'comprehension' => $this->input->post('comprehension'),
            'instruction' => $this->input->post('instruction'),
            'option1' => $this->input->post('option1'),
            'option2' => $this->input->post('option2'),
            'option3' => $this->input->post('option3'),
            'option4' => $this->input->post('option4'),
            'answer' => $this->input->post('answer'),
        );
        $this->db->where('id', $id);
        $this->db->update('assessment_questions', $data);
	   echo json_encode("Alright");
	}

	public function get_question_details() {
        $question_details = $this->assessment_m->get_question_by_id();
		echo "[".json_encode($question_details)."]";		 
	}


	public function change_password()
	{
		$teacher_id = $this->input->post('teacher_id');
		$password = $this->input->post('password');
        $data = array(
            'password' => $password
        );
        $this->db->where('id', $teacher_id);
        $this->db->update('users', $data);
	}


	//Users
	public function submissions ()
	{	
		if ($this->session->userdata('active_user')->role_id != 3) {
		if ($this->uri->segment(3)) {
		$this->load->model('user_m');
		$this->data['title'] = 'View Grades';

		////
		$this->data['submitted_students'] = $this->assessment_m->get_submitted_students($this->uri->segment(3));

		// }
		$this->load->view('assessment/submissions', $this->data);
		}
		}
		else {
			show_404();
		}
	}



	public function archive_assessment()
	{
		$id = $this->input->post('id');
        $data = array(
            'status' => 3
        );
        $this->db->where('id', $id);
        $this->db->update('assessments', $data);
	}

	public function delete_bulk() {
		$answer_id = $this->input->post('answer_id');
		foreach ($answer_id as $answer) {
			//echo "";

		$this->db->delete('assessment_answers', array('id' => $answer));
		}
		echo "Selected Entries deleted";
	}



}