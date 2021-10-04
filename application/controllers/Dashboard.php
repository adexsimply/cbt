<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Base_Controller {

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
		$this->data['menu_id'] = 'dashboard';
		$this->load->model('user_m');

	}
	public function index ()
	{	
		$this->load->model('user_m');
		$this->load->model('students_m');
		$this->load->model('setup_m');
		$this->load->model('assessment_m');
		$this->load->model('material_m');
		$this->data['active_exams'] = $this->user_m->active_exams();
		$this->data['title'] = 'CSMT-CBT :: Dashboard';
		if ($this->session->userdata('active_user')->role_id==3) {

		$this->data['assessments_list'] = $this->assessment_m->get_assessments_for_student();
		$this->data['student_details'] = $this->user_m->get_logged_in_student_details();
		//$this->load->view('dashboard', $this->data); 
		redirect('/assessment/view');
		}
		else {
		$this->data['subject_list'] = $this->setup_m->get_subject_list();
		$this->data['users_list'] = $this->user_m->get_users();
		//$this->data['class_list'] = $this->setup_m->get_class_list();
		//$this->data['students_list'] = $this->user_m->get_students_list();
	//	$this->data['assessments_list'] = $this->assessment_m->get_assesments_for_admin();
		$this->load->view('admin/dashboard', $this->data);
		}

	}

}
