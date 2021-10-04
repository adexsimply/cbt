<?php
class Control extends CI_Controller {

	public function __construct() {
		

		parent::__construct();
		$this->data['menu_id'] = 'control';

		$this->load->model('user_m');
		$this->load->model('setup_m');
		$this->load->model('material_m');
		$this->load->model('assessment_m');

	}


	public function index()
	{


		if($this->session->userdata('active_user')) {
			if ($this->session->userdata('active_user')->role_id =='1') {
			redirect('dashboard');
			}
			else {

			redirect('dashboard');
			}
		}
		else {
			
		$data['title'] = 'CBT :: Admin Login';
		$this->load->view('login_admin', $data);

		}
		
	}

}

?>