<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {

	protected $data;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('role_m');
		$this->load->model('user_m');


		// Redirect If Not Authenticated

		$this->session->userdata('active_user') == null ? redirect(base_url().'auth/login') : '';
		//$category == "Nothing" ?  : '';

		// Get Authenticated User
		$this->data['active_user'] = $this->session->userdata('active_user');


		$role_id = $this->session->userdata('active_user')->role_id;
		



		$this->data['active_user_group'] = $this->role_m->get_role($this->data['active_user']->role_id);

	}

    /**
     * Get Active Menu
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

}
