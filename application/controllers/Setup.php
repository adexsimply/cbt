<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends Base_Controller {

	 public function __construct(){
        parent::__construct();

        if($this->session->userdata('active_user')->role_id ==3){
            redirect("dashboard");

        }


        $this->data['menu_id'] = 'setup';

    }

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
	// public function index ()
	// {		
	// 	$this->load->model('setup_m');
	// 	$this->data['title'] = 'Admissions';
	// 	$this->data['session_list'] = $this->setup_m->get_session_list();
	// 	$this->data['term_list'] = $this->setup_m->get_term_list();
	// 	$this->data['level_list'] = $this->setup_m->get_level_list();
	// 	$this->data['club_lists'] = $this->setup_m->get_club_list();
	// 	$this->data['category_list'] = $this->setup_m->get_category_list();
	// 	$this->data['arm_list'] = $this->setup_m->get_arm_list();
	// 	$this->data['class_lists'] = $this->setup_m->get_class_list();
	// 	$this->data['level_group_lists'] = $this->setup_m->get_level_group_list();
	// 	//$this->data['childview'] = 'dashboard/main';
	// 	$this->load->view('admissions/main', $this->data);
	// }
	//Isolating term view
	public function classed ()
	{		
		$this->load->model('setup_m');
		$this->data['title'] = 'CSMT-CBT :: Class';
		$this->data['class_list'] = $this->setup_m->get_class_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('setup/class/main', $this->data);
	}
	//Isolating subject view
	public function subject ()
	{		
		$this->load->model('setup_m');
		$this->data['title'] = 'CSMT-CBT :: Subject';
		$this->data['class_list'] = $this->setup_m->get_class_list();
		$this->data['subject_list'] = $this->setup_m->get_subject_list();
		$this->load->view('setup/subject/main', $this->data);
	}

	//Isolating term view
	public function arm ()
	{		
		$this->load->model('setup_m');
		$this->data['title'] = 'CSMT-CBT :: Arm';
		$this->data['arm_list'] = $this->setup_m->get_arm_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('setup/arm/main', $this->data);
	}

	//////////////Arms
	public function validate_arm_name()
	{
		$rules = [
			[
				'field' => 'arm_name',
				'label' => 'Arm Name',
				'rules' => 'trim|required|is_unique[arm_list.arm_name]'
			]
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


	public function delete_arm()
	{
		$id = $this->input->post('id');
		$this->db->delete('arm_list', array('id' => $id));
	}

	public function get_arm_details() {

        $this->load->model('setup_m');
        $arm_list = $this->setup_m->get_arm_by_id();
		echo "[".json_encode($arm_list)."]";		 
	}



	//Isolating term view
	public function class_list ()
	{		
		$this->load->model('setup_m');
		$this->data['title'] = 'CSMT-CBT :: Class';
		$this->data['class_list'] = $this->setup_m->get_class_list1();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('setup/class-list/main', $this->data);
	}


/////////////////Class
public function validate_class_list_name()
	{
		if ($this->input->post('class_id')){
		$rules = [
			[
				'field' => 'class_name',
				'label' => 'Class Name',
				'rules' => 'trim|required'
			]
		];
		}
		else {
		$rules = [
			[
				'field' => 'class_name',
				'label' => 'Class Name',
				'rules' => 'trim|required|is_unique[class_list.class_list_name]'
			]
		];
	}
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}

	}

	public function add_class_list_name()
        {                

        	$this->load->model('setup_m');
        	$this->setup_m->create_class_name2();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function add_class_name_system()
        {      


		$classes = file_get_contents('http://localhost/csmt-cbt-api/all_classes_system.php');
   //      	$this->load->model('setup_m');
   //      	$this->setup_m->create_class_name2();

			//header('Content-Type: application/json');
	    	$class_lists = json_decode($classes);
	    	foreach ($class_lists as $class_list) 
	    	{
	    		$check_if_class_id_exists = $this->db->select('*')->from('class')->where('class_system_id',$class_list->id)->get();
	    		if ($check_if_class_id_exists->num_rows() > 0) {
	    			///Update
	    			$data_class = array(
	    				'class_name' => $class_list->name,
	    				'class_group_id' => 1,
	    				'class_school' => 1

	    			);
	    			$this->db->where('class_system_id',$class_list->id);
	    			$this->db->update('class',$data_class);
	    		}
	    		else {
	    			///Insert

	    			$data_class = array(
	    				'class_name' => $class_list->name,
	    				'class_group_id' => 1,
	    				'class_school' => 1,
	    				'class_system_id' => $class_list->id

	    			);
	    			$insert = $this->db->insert('class',$data_class);

	    		}
	    	}
        }

        


	public function delete_class_list()
	{
		$id = $this->input->post('id');
		$this->db->delete('class_list', array('id' => $id));
	}

	public function get_class_list_details() {

        $this->load->model('setup_m');
        $class_list = $this->setup_m->get_class_by_id2();
		echo "[".json_encode($class_list)."]";		 
	}



	//Isolating term view
	public function class_arm ()
	{		
		$this->load->model('setup_m');
		$this->data['title'] = 'CSMT-CBT :: Class-Arm';
		$this->data['arm_list'] = $this->setup_m->get_arm_list();
		$this->data['class_list'] = $this->setup_m->get_class_list1();
		////
		$this->data['class_arm_list'] = $this->setup_m->get_class_arm_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('setup/class-arm/main', $this->data);
	}

/////////////////Class-arm
public function validate_class_arm_name()
	{
		if (!empty($this->input->post('class_arm_id')))
		{
		$rules = [
			[
				'field' => 'class_name',
				'label' => 'Class Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'arm_name',
				'label' => 'Arm Name',
				'rules' => 'trim|required'
			]
		];

		}
		else {
		$rules = [
			[
				'field' => 'class_name',
				'label' => 'Class Name',
				'rules' => 'trim|required|callback_check_class_arm'
			],
			[
				'field' => 'arm_name',
				'label' => 'Arm Name',
				'rules' => 'trim|required|callback_check_class_arm'
			]
		];
		}

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			header("Content-type:application/json");
			echo json_encode('success');
		} else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}

	}

	public function check_class_arm() {

    $class_name = $this->input->post('class_name');// get fiest name
    $arm_name = $this->input->post('arm_name');// get last name
    $this->db->select('*');
    $this->db->from('class_arm');
    $this->db->where('class_id', $class_name);
    $this->db->where('arm_id', $arm_name);
    $query = $this->db->get();
    $num = $query->num_rows();
    if ($num > 0) {
    	$this->form_validation->set_message('check_class_arm', 'Both Combinations Already Exist');
        return FALSE;
    } else {
        return TRUE;
    }
	}


	public function add_class_arm_name()
        {                

        	$this->load->model('setup_m');
        	$this->setup_m->create_class_arm_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_class_arm()
	{
		$id = $this->input->post('id');
		$this->db->delete('class_arm', array('id' => $id));
	}

	public function get_class_arm_details() {

        $this->load->model('setup_m');
        $class_arm_list = $this->setup_m->get_class_arm_by_id();
		echo "[".json_encode($class_arm_list)."]";		 
	}


	public function add_arm_name()
        {                

        	$this->load->model('setup_m');
        	$this->setup_m->create_arm_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }



	public function validate_session_name()
	{
		$rules = [
			[
				'field' => 'sess_name',
				'label' => 'Session Name',
				'rules' => 'trim|required|is_unique[sessions.session_title]'
			]
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


	public function add_session_name()
        {                

        	$this->load->model('setup_m');
        	$this->setup_m->create_session_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_sess()
	{
		$id = $this->input->post('id');
		$this->db->delete('sessions', array('id' => $id));
	}
	public function activate_sess()
	{
		$id = $this->input->post('id');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
		///////////////////////////////////
		$this->db->set('session_status', '0');
		$this->db->update('sessions');
		$this->db->set('session_status', '1');
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('sessions');
	}
///////////////

	public function get_session_details() {

        $this->load->model('setup_m');
        $session_list = $this->setup_m->get_session_by_id();
		echo "[".json_encode($session_list)."]";		 
	}
/////////////////Class
public function validate_class_name()
	{
		$rules = [
			[
				'field' => 'class_name',
				'label' => 'Class Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'school',
				'label' => 'School',
				'rules' => 'trim|required'
			],
			[
				'field' => 'group',
				'label' => 'Group',
				'rules' => 'trim|required'
			]
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


	public function add_class_name()
        {                

        	$this->load->model('setup_m');
        	$this->setup_m->create_class_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_class()
	{
		$id = $this->input->post('id');
		$this->db->delete('class', array('id' => $id));
	}

	public function get_class_details() {

        $this->load->model('setup_m');
        $class_list = $this->setup_m->get_class_by_id();
		echo "[".json_encode($class_list)."]";		 
	}

	/////////////////Subject
public function validate_subject_name()
	{
		$rules = [
			[
				'field' => 'subject_name',
				'label' => 'Subject Name',
				'rules' => 'trim|required|is_unique[subjects.subject_name]'
			],
			[
				'field' => 'class_id[]',
				'label' => 'Class',
				'rules' => 'trim|required'
			]
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


	public function add_subject_name()
        {                

        	$this->load->model('setup_m');
        	$this->setup_m->create_subject_name();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }

	public function add_subject_name_system()
        {      


		$subjects = file_get_contents('http://localhost/csmt-cbt-api/get_subjects_list.php');

	    	$subject_lists = json_decode($subjects);
	    	foreach ($subject_lists as $subject_list) 
	    	{
	    		$check_if_subject_id_exists = $this->db->select('*')->from('subjects')->where('subject_id_system',$subject_list->subject_id)->get();
	    		if ($check_if_subject_id_exists->num_rows() > 0) {
	    			///Update
	    			$data_subject = array(
	    				'subject_name' => $subject_list->subject_name,	    				
	    				'classes_id' => 1,

	    			);
	    			$this->db->where('subject_id_system',$subject_list->subject_id);
	    			$this->db->update('subjects',$data_subject);
	    		}
	    		else {
	    			///Insert

	    			$data_subject = array(
	    				'subject_name' => $subject_list->subject_name,
	    				'subject_id_system' => $subject_list->subject_id,
	    				'classes_id' => 1,

	    			);
	    			$insert = $this->db->insert('subjects',$data_subject);

	    		}
	    	}
        }


	public function delete_subject()
	{
		$id = $this->input->post('id');
		$this->db->delete('subjects', array('id' => $id));
	}

	public function get_subject_details() {

        $this->load->model('setup_m');
        $class_list = $this->setup_m->get_subject_by_id();
		echo "[".json_encode($class_list)."]";		 
	}


}
