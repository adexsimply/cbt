<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends Base_Controller {

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
		$this->load->model('pin_m');
        $this->load->model('fee_m');
        $this->load->model('subscription_m');


        // Godson API
        $this->json_url = "http://api.ebulksms.com:8080/sendsms.json";
        $this->username="godsonoffor@rocketmail.com";
        $this->apikey = "e1e379c163f9069d68c43b0a695e8174fdd99c1c";
        $this->sendername = "CSMT SEC SC";

	}

	//Users
	public function index ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Users';
		//$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		//$this->data['students_list'] = $this->subscription_m->get_students_list_subs();
		//$this->data['teachers_list'] = $this->user_m->get_teachers_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('subscription/main', $this->data);
	}


	//Users
	public function view ()
	{		
			if ($this->uri->segment(4)) {
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->uri->segment(3) == 'class2') {
		$this->data['subscription_list'] = $this->subscription_m->get_active_sub_by_class2($this->uri->segment(4));
		}
		else {
		$this->data['subscription_list'] = $this->subscription_m->get_active_sub_by_class($this->uri->segment(4));

		}
		$this->load->view('subscription/view', $this->data);
			}
			else {
				show_404();
			}
		//$this->data['teachers_list'] = $this->user_m->get_teachers_list();
		//$this->data['childview'] = 'dashboard/main';
	}

	public function convert_date() {

		$time = $_GET['date_time'];
		$ini_date = date_create($time); 
		echo json_encode(date_format($ini_date,"D M d,Y h:i a"));

	}

	public function get_students_sub() {

		$students_list = $this->subscription_m->get_students_list_subs();
		echo json_encode($students_list);


	}


    public function delete_sub()
    {
        $id = $this->input->post('id');
        $this->db->delete('subscriptions', array('id' => $id));
    }



}