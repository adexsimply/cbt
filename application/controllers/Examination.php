<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examination extends Base_Controller {

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
		$this->load->model('examination_m');
		$this->load->model('assessment_m');

        $this->data['menu_id'] = 'Examination';
		//$menu = "Examination";
		///Taken Exams = 3
		///Pending Exams = 0
		///Active Exams = 1

	}

	//Users
	public function index ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'CSMT-CBT :: Examination';
		if ($this->session->userdata('active_user')->role_id != 3) {
		$this->data['assessments_list'] = $this->assessment_m->get_exams_for_admin();
		}
		$this->load->view('examination/main', $this->data);
	}

	//Users
	public function taken_exams ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'CSMT-CBT :: Examination';
		if ($this->session->userdata('active_user')->role_id != 3) {
		$this->data['assessments_list'] = $this->assessment_m->get_taken_exams_for_admin();
		}
		$this->load->view('examination/main_taken', $this->data);
	}


	public function toggle_status () {
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data_status = array(
			'status' => $status
		);
		$this->db->where('id',$id);
		$update = $this->db->update('assessments',$data_status);
        header('Content-Type: application/json');
		echo json_encode($update);
	}


	public function grade_students()
	{
	    if ($this->uri->segment(3)) {
			$this->data['class_list'] = $this->setup_m->get_class_list();
	    	$this->data['student_lists'] = $this->examination_m->get_students_by_exam_id2($this->uri->segment(3));

		$this->load->view('examination/grade_students_modal', $this->data);

	    }

	 }


	public function print_students_result()
	{
	    if ($this->uri->segment(3)) {
			//$this->data['class_list'] = $this->setup_m->get_class_list();
			$this->data['arm_list'] = $this->setup_m->get_alias_list22();
	    	//$this->data['student_lists'] = $this->examination_m->get_students_by_exam_id($this->uri->segment(3));

		$this->load->view('examination/print_result_modal', $this->data);

	    }

	 }



	public function print_result()
	{
	    if ($this->uri->segment(3)) {
	    	$this->data['student_lists'] = $this->examination_m->get_students_by_exam_id($this->uri->segment(3),$this->uri->segment(4));

		$this->load->view('examination/print_result', $this->data);

	    }

	 }




	public function remark_exam()
	{
	    if ($this->uri->segment(3)) {
		//$this->data['assessment_questions'] = $this->examination_m->get_questions_by_id($this->uri->segment(3));
		$this->data['assessment_grade'] = $this->examination_m->get_exam_grade_for_student($this->uri->segment(3),$this->uri->segment(4));

		$this->load->view('examination/remark_exam_modal', $this->data);

	    }

	 }

	public function remark_scores()
	{
		$remark = $this->examination_m->remark_scores();

        header('Content-Type: application/json');
		echo json_encode($remark);

	 }


	public function toggle_result_view () {
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data_status = array(
			'show_results' => $status
		);
		$this->db->where('id',$id);
		$update = $this->db->update('assessments',$data_status);
        header('Content-Type: application/json');
		echo json_encode($status);
	}


	public function taken () {
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data_status = array(
			'status' => $status
		);
		$this->db->where('id',$id);
		$update = $this->db->update('assessments',$data_status);
        header('Content-Type: application/json');
		echo json_encode($update);
	}

	public function toggle_autograde () {
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data_status = array(
			'auto_grade' => $status
		);
		$this->db->where('id',$id);
		$update = $this->db->update('assessments',$data_status);
        header('Content-Type: application/json');
		echo json_encode($update);
	}

	public function toggle_shuffle () {
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data_status = array(
			'shuffle' => $status
		);
		$this->db->where('id',$id);
		$update = $this->db->update('assessments',$data_status);
        header('Content-Type: application/json');
		echo json_encode($update);
	}


	public function delete_exam()
	{
		$id = $this->input->post('id');
		$this->db->delete('assessments', array('id' => $id));
	}

	public function delete_exam_for_student()
	{
		$id = $this->input->post('id');
		$student_id = $this->input->post('student_id');
		$this->db->delete('assessment_answers', array('assessment_id' => $id,'student_id' => $student_id));
		$this->db->delete('exam_logs', array('assessment_id' => $id,'student_id' => $student_id));
	}


}