<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends Base_Controller {

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
	// 	$this->load->model('students_m');	
	// 	$this->data['title'] = 'Students';
	// 	$this->data['student_lists'] = $this->students_m->get_student_list();
	// 	$this->data['group_lists'] = $this->students_m->get_group_list();
	// 	//$this->data['childview'] = 'dashboard/main';
	// 	$this->load->view('students/main', $this->data);
	// }



	public function __construct() {
		

		parent::__construct();
		
		$this->data['menu_id'] = 'students';
		$this->load->model('students_m');

	}

	public function manage ()
	{			

		$this->data['title'] = 'Manage';
		$this->data['student_lists'] = $this->students_m->get_student_list();
		$this->data['class_arm_lists'] = $this->students_m->get_class_arm_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('students/manage/main', $this->data);
	}
	public function manage_class ()
	{		
		$this->load->model('students_m');	

		$this->data['title'] = 'Manage';
		$this->data['student_lists'] = $this->students_m->get_student_list();
		$this->data['class_arm_lists'] = $this->students_m->get_class_arm_list();
		//$this->data['childview'] = 'dashboard/main';
	  	$class_arm_id =  $this->uri->segment(3);
	  	if ($this->uri->segment(3)){
        $this->data['student_list'] = $this->students_m->get_student_by_class($class_arm_id);
    	}
		$this->load->view('students/manage-class/main', $this->data);
	}
	/////////////////
	public function assign_group_bulk ()
	{		
		$this->load->model('students_m');	

		$this->data['title'] = 'Assign Group(Bulk)';
		$this->data['student_lists'] = $this->students_m->get_student_list();
		$this->data['group_lists'] = $this->students_m->get_group_list();
		//$this->data['childview'] = 'dashboard/main';
	  	$group_id =  $this->uri->segment(3);
	  	if ($this->uri->segment(3)){
        $this->data['student_list'] = $this->students_m->get_student_by_group($group_id);
    	}
		$this->load->view('students/assign-group-bulk/main', $this->data);
	}
	public function student_json ()
	{
		$this->load->model('students_m');
		$student_lists = $this->students_m->get_student_list();
		echo json_encode($student_lists, JSON_PRETTY_PRINT);

	}
	
	public function student_by_class_json ()
	{
		$this->load->model('students_m');	
		$student_lists = $this->students_m->get_student_by_class(7);
		echo json_encode($student_lists, JSON_PRETTY_PRINT);

	}

	public function group_by_student_json ()
	{
		$this->load->model('students_m');	
		$student_lists = $this->students_m->get_group_by_student_id(27);
		echo json_encode($student_lists, JSON_PRETTY_PRINT);

	}



	public function update_student_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
        $data  = array(
            'status' => $status

        );
        $this->db->where('id', $id);
        $this->db->update('students', $data); 
	}

	public function validate_student_name()
	{
		if ($this->input->post('student_id'))
        { 
		$rules = [
			[
				'field' => 'school_id',
				'label' => 'School ID',
				'rules' => 'trim|required'
			],
			[
				'field' => 'student_name',
				'label' => 'Student Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'class_arm',
				'label' => 'Class Name',
				'rules' => 'trim|required'
			]
		];
		} else {
		$rules = [
			[
				'field' => 'school_id',
				'label' => 'School ID',
				'rules' => 'trim|required|is_unique[students.csmt_id]'
			],
			[
				'field' => 'student_name',
				'label' => 'Student Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'class_arm',
				'label' => 'Class Name',
				'rules' => 'trim|required'
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


	public function get_student_details() {

        $this->load->model('students_m');
        $student_details = $this->students_m->get_student_by_id();
		echo "[".json_encode($student_details)."]";		 
	}

	public function add_student_name()
        {                

        	$this->load->model('students_m');
        	$this->students_m->create_student();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_student()
	{
		$id = $this->input->post('id');
		$this->db->delete('students', array('id' => $id));
	}


	public function remove_from_class()
	{
		$student_id = $this->input->post('student_id');
		$class_arm_id = $this->input->post('class_arm_id');
		$current_cast_id = $this->input->post('current_cast_id');
		//////////
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        ///////Get cast_id
        $get_cast_id = $this->db->select('*')->from('class_arm_session_term')->where('class_arm_id', $class_arm_id)->where('session_term_id', $current_sess_term_id)->get();
        /////////
        $row_cast_id = $get_cast_id->row();
        $cast_id = $row_cast_id->id;
		$this->db->delete('student_class', array('student_id' => $student_id,'class_arm_session_term_id' =>$cast_id));
	}



	public function remove_from_group()
	{
		$student_id = $this->input->post('student_id');
		$sgst_id = $this->input->post('sgst_id');
		$current_sgst_id = $this->input->post('current_sgst_id');
		//////////
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        ///////Get cast_id
        $get_sgst_id = $this->db->select('*')->from('student_group_session_term')->where('student_group_id', $sgst_id)->where('session_term_id', $current_sess_term_id)->get();
        /////////
        $row_sgst_id = $get_sgst_id->row();
        $sgst_id = $row_sgst_id->id;
		$this->db->delete('students_sgst', array('student_id' => $student_id,'sgst_id' =>$sgst_id));
	}


	public function remove_from_class2()
	{
		$student_id = $this->input->post('student_id');
		$cast_id = $this->input->post('cast_id');
		//////////
		$this->db->delete('student_class', array('student_id' => $student_id,'class_arm_session_term_id' =>$cast_id));
	}

	public function remove_from_group2()
	{
		$ssgst_id = $this->input->post('ssgst_id');
		//////////
		$this->db->delete('students_sgst', array('id' => $ssgst_id));
	}


	public function add_to_class()
	{
        $this->load->model('students_m');
		$student_id = $this->input->post('student_id');
		$class_arm_id = $this->input->post('class_arm_id');
		$current_cast_id = $this->input->post('current_cast_id');

        $this->students_m->add_to_class($student_id,$class_arm_id,$current_cast_id);

		//$this->db->delete('students', array('id' => $id));
	}
	///////Add to Group
	public function add_to_group()
	{
        $this->load->model('students_m');
		$student_id = $this->input->post('student_id');
		$sgst_id = $this->input->post('sgst_id');
		$current_sgst_id = $this->input->post('current_sgst_id');

        $this->students_m->add_to_group($student_id,$sgst_id,$current_sgst_id);

		//$this->db->delete('students', array('id' => $id));
	}
////////////////Student Group

	public function group ()
	{		
		$this->load->model('students_m');	

		$this->data['title'] = 'Group';
		$this->data['group_lists'] = $this->students_m->get_group_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('students/group/main', $this->data);
	}

	public function validate_group_name()
	{
		$rules = [
			[
				'field' => 'group_name',
				'label' => 'Group Name',
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


	public function get_group_details() {

        $this->load->model('students_m');
        $group_details = $this->students_m->get_group_by_id();
		echo "[".json_encode($group_details)."]";		 
	}

	public function add_group_name()
        {                

        	$this->load->model('students_m');
        	$this->students_m->create_group();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_group()
	{
		$id = $this->input->post('id');
		$this->db->delete('student_group', array('id' => $id));
	}
	/////////////////Fee for students

	public function fee ()
	{		
		$this->load->model('students_m');	
		$this->load->model('setup_m');
		$this->data['fee_type_list'] = $this->setup_m->get_fee_list();


		$this->data['title'] = 'Fee';
		$this->data['fee_lists'] = $this->students_m->get_fee_list();
		$this->data['group_lists'] = $this->students_m->get_group_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('students/fee/main', $this->data);
	}
	public function validate_fee_name()
	{		
		if ($this->input->post('fee_id')){
		$rules = [
			[
				'field' => 'student_group',
				'label' => 'Student Group',
				'rules' => 'trim|required'
			],
			[
				'field' => 'fee_type',
				'label' => 'Fee Type',
				'rules' => 'trim|required'
			],
			[
				'field' => 'amount',
				'label' => 'Amount',
				'rules' => 'trim|required'
			]
		];
		}
		else {
		$rules = [
			[
				'field' => 'student_group',
				'label' => 'Student Group',
				'rules' => 'trim|required|callback_check_fee_name'
			],
			[
				'field' => 'fee_type',
				'label' => 'Fee Type',
				'rules' => 'trim|required|callback_check_fee_name'
			],
			[
				'field' => 'amount',
				'label' => 'Amount',
				'rules' => 'trim|required'
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



	public function check_fee_name() {
    $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;  
    $student_group = $this->input->post('student_group');// get fiest name
    $fee_type = $this->input->post('fee_type');// get last name
    $get_sgst_id = $this->db->select('*')->from('student_group_session_term')->where('student_group_id',$this->input->post('student_group'))->where('session_term_id',$current_sess_term_id)->get();
    $row_sgst_id = $get_sgst_id->row();
    $sgst_id = $row_sgst_id->id;
    $this->db->select('*');
    $this->db->from('student_group_fee_type');
    $this->db->where('sgst_id', $sgst_id);
    $this->db->where('fee_type_id', $fee_type);
    //$this->db->where('session_term_id', $current_sess_term->id);
    $query = $this->db->get();
    $num = $query->num_rows();
    if ($num > 0) {
    	$this->form_validation->set_message('check_fee_name', 'Both Combinations Already Exist');
        return FALSE;
    } else {
        return TRUE;
    }
	}



	public function get_fee_details() {

        $this->load->model('students_m');
        $fee_details = $this->students_m->get_fee_by_id();
		echo "[".json_encode($fee_details)."]";		 
	}

	public function add_fee_name()
        {                

        	$this->load->model('students_m');
        	$this->students_m->create_fee();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


	public function delete_fee()
	{
		$id = $this->input->post('id');
		$this->db->delete('student_group_session_term', array('id' => $id));
	}


	/////////////////Assign Students To Group

	public function assign_group ()
	{		
		$this->load->model('students_m');	


		$this->data['title'] = 'Fee';
		$this->data['fee_lists'] = $this->students_m->get_fee_list();
		$this->data['student_lists'] = $this->students_m->get_student_with_group_list();
		$this->data['group_lists'] = $this->students_m->get_group_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('students/assign-group/main', $this->data);
	}
	public function validate_student_group_name()
	{
		$rules = [
			[
				'field' => 'student_id',
				'label' => 'Student ID',
				'rules' => 'trim|required'
			],
			[
				'field' => 'student_group',
				'label' => 'Group Name',
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

	public function add_student_group_name()
        {                

        	$this->load->model('students_m');
        	$this->students_m->create_student_group();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }

}