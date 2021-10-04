<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_Controller {

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
		
        if($this->session->userdata('active_user')->role_id ==3){
            redirect("dashboard");

        }

		$this->load->model('user_m');
		$this->load->model('setup_m');
		
		$this->data['menu_id'] = 'students';


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
		$this->data['users_list'] = $this->user_m->get_users();
		//$this->data['teachers_list'] = $this->user_m->get_teachers_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('users/main', $this->data);
	}


	public function delete_user()
	{
		$id = $this->input->post('id');
		$this->db->delete('users', array('id' => $id));
	}
	public function delete_log()
	{
		$id = $this->input->post('id');
		$this->db->delete('exam_logs', array('id' => $id));
	}

	public function delete_admin()
	{
		$id = $this->input->post('id');
		$this->db->delete('users', array('id' => $id));
	}


	public function delete_teacher()
	{
		$id = $this->input->post('id');
		$this->db->delete('users', array('id' => $id));
		$this->db->delete('teachers', array('user_id' => $id));
	}


	public function delete_subject_for_teacher()
	{
		$id = $this->input->post('id');
		$this->db->delete('teacher_subjects', array('id' => $id));
	}



	public function delete_student()
	{
		$id = $this->input->post('id');
		$this->db->delete('users', array('id' => $id));
		$this->db->delete('students', array('user_id' => $id));
	}

	public function validate_user_name()
	{
		if ($this->input->post('user_id')){

		$rules = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required'
			],
			[
				'field' => 'category_id',
				'label' => 'Category',
				'rules' => 'trim|required'
			],
			[
				'field' => 'role_id',
				'label' => 'Role',
				'rules' => 'trim|required'
			]
		];
		}
		else {
		$rules = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required|min_length[6]|is_unique[users.username]'
			],
			[
				'field' => 'password1',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[6]'
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

	public function add_user_name()
        {                

        	$this->load->model('user_m');
        	$this->user_m->add_user();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }

	public function get_user_details() {

        $this->load->model('user_m');
        $user_details = $this->user_m->get_user_by_id();
		echo "[".json_encode($user_details)."]";		 
	}

	public function get_privilege_by_user() {

        $this->load->model('user_m');
        $user_privileges = $this->user_m->get_privilege_by_user_id();
		echo json_encode($user_privileges);		 
	}


	public function remove_privilege()
	{
		$menu_id = $this->input->post('menu_id');
		$user_id = $this->input->post('user_id');
		//////////
		$this->db->delete('privileges', array('menu_id' => $menu_id,'user_id' =>$user_id));
	}


	public function add_privilege()
	{
        $this->load->model('user_m');
		$menu_id = $this->input->post('menu_id');
		$user_id = $this->input->post('user_id');

        $this->user_m->add_privilege($menu_id,$user_id);
	}
	////////


	//Isolating term view
	public function teacher ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Teachers';
		$this->data['subject_list'] = $this->setup_m->get_subject_list();
		$this->data['teachers_list'] = $this->user_m->get_teachers_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('teacher/main', $this->data);
	}

	public function validate_teacher_name()
	{
		if ($this->input->post('teacher_id')){

		$rules = [
			[
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'phone',
				'label' => 'Phone Numnber',
				'rules' => 'trim|required'
			]
		];
		}
		else {
		$rules = [
			[
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'phone',
				'label' => 'Phone Numnber',
				'rules' => 'trim|required'
			],
			[
				'field' => 'subject',
				'label' => 'Subject',
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


	public function add_teacher_name()
        {                

        	$this->load->model('user_m');
        	$this->user_m->add_teacher();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }



	public function add_subject_to_teacher()
	{
		$subject_id = $this->input->post('subject_id');
		$teacher_id = $this->input->post('teacher_id');

        $data2 = array(
            'subject_id' => $subject_id,
            'teacher_id' => $teacher_id
        );
        $insert2 = $this->db->insert('teacher_subjects', $data2);
        return $insert2;

		//$this->db->delete('students', array('id' => $id));
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

//Function to connect to SMS sending server using HTTP POST
function doPostRequest($url, $arr_params, $headers = array('Content-Type: application/x-www-form-urlencoded')) {
    $response = array();
    $final_url_data = $arr_params;
    if (is_array($arr_params)) {
        $final_url_data = http_build_query($arr_params, '', '&');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $final_url_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $response['body'] = curl_exec($ch);
    $response['code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $response['body'];
}
 
	public function useJSON($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients) {
    $gsm = array();
    $country_code = '234';
    $arr_recipient = explode(',', $recipients);
    foreach ($arr_recipient as $recipient) {
        $mobilenumber = trim($recipient);
        if (substr($mobilenumber, 0, 1) == '0'){
            $mobilenumber = $country_code . substr($mobilenumber, 1);
        }
        elseif (substr($mobilenumber, 0, 1) == '+'){
            $mobilenumber = substr($mobilenumber, 1);
        }
        $generated_id = uniqid('int_', false);
        $generated_id = substr($generated_id, 0, 30);
        $gsm['gsm'][] = array('msidn' => $mobilenumber, 'msgid' => $generated_id);
    }
    $message = array(
        'sender' => $sendername,
        'messagetext' => $messagetext,
        'flash' => "{$flash}",
    );
 
    $request = array('SMS' => array(
            'auth' => array(
                'username' => $username,
                'apikey' => $apikey
            ),
            'message' => $message,
            'recipients' => $gsm
    ));
    $json_data = json_encode($request);
    if ($json_data) {
        $response = $this->doPostRequest($url, $json_data, array('Content-Type: application/json'));
        $result = json_decode($response);
        return $result->response->status;
    } else {
        return false;
    }
}

	public function send_password() {

		$recipients = $this->input->post('phone');
		$password = $this->input->post('password');
		$username = $this->input->post('username');

		$flash = 0;
		$message = "Greetings student. 
E-learning activities resume on Wednesday 6th, January 2021. Check your Info box to be guided. 
Use the detail below to access your e-learning page:
Website  https://csmtschools.com Username: ".$username." Password: ".$password." Thank you.";
		//$recipients = "08038387930,08121034565";
		$result = $this->useJSON($this->json_url, $this->username, $this->apikey, $flash, $this->sendername, $message, $recipients);

	}
	////

	public function send_password_to_all() {

		//$this->data['students'] = $this->user_m->get_students_list();
		$students = $this->user_m->get_students_list();
		foreach ($students as $student) {
			 if (($student->class == 25) || ($student->class == 26) || ($student->class == 27) || ($student->class == 28) || ($student->class == 29) || ($student->class == 30)) {
			$recipients = $student->phone;
			$password = $student->password;
			$username = $student->username;
			$flash = 0;
			$message = "Greetings student. 
						E-learning activities resume on Wednesday 6th, January 2021. Check your Info box to be guided. 
						Use the detail below to access your e-learning page:
						Website  https://csmtschools.com Username: ".$username." Password: ".$password." Thank you.";

			$result = $this->useJSON($this->json_url, $this->username, $this->apikey, $flash, $this->sendername, $message, $recipients);
		
//$this->load->view('student/sec2', $this->data);
		
		}
		}

		// $recipients = $this->input->post('phone');
		// $password = $this->input->post('password');
		// $username = $this->input->post('username');

		//$recipients = "08038387930,08121034565";

	}
	////

	//Isolating term view
	public function student ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Students';
		$this->data['class_list'] = $this->setup_m->get_class_list();
		$this->data['arm_list'] = $this->setup_m->get_arms_list();
		$this->data['alias_list'] = $this->setup_m->get_alias_list();
		$this->data['class_list1'] = $this->user_m->get_class_arm_list();
		//$this->data['subject_list'] = $this->setup_m->get_subject_list();
		//$this->data['students_list'] = $this->user_m->get_students_list();
		if ($this->uri->segment(3)) {
		if ($this->uri->segment(3)=='Sec') {

		$this->data['students_list'] = $this->user_m->get_students_list_sec();
		$this->load->view('student/sec', $this->data);
		}
		elseif($this->uri->segment(3)=='Pri') {

		$this->data['students_list'] = $this->user_m->get_students_list_pri();
		$this->load->view('student/pri', $this->data);
		}
		else {
			show_404();
		}
		}
		else {
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('student/main', $this->data);

		}
	}
	//Isolating term view
	public function other_student ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Students';
		$this->data['class_list'] = $this->setup_m->get_class_list();
		$this->data['class_list1'] = $this->user_m->get_class_arm_list();
		//$this->data['subject_list'] = $this->setup_m->get_subject_list();
		$this->data['students_list'] = $this->user_m->get_students_list_other();
		$this->load->view('student/main-other', $this->data);
	}

	public function validate_student_name()
	{
		if ($this->input->post('student_id')){

		$rules = [
			[
				'field' => 'fullname',
				'label' => 'Full Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'csmt_id',
				'label' => 'Student ID',
				'rules' => 'trim|required'
			],
			[
				'field' => 'phone',
				'label' => 'Phone Numnber',
				'rules' => 'trim|required'
			],
			[
				'field' => 'class',
				'label' => 'Class',
				'rules' => 'trim|required'
			]
		];
		}
		else {
		$rules = [
			[
				'field' => 'fullname',
				'label' => 'Full Name',
				'rules' => 'trim|required'
			],
			[
				'field' => 'csmt_id',
				'label' => 'Student ID',
				'rules' => 'trim|required|is_unique[students.csmt_id]'
			],
			[
				'field' => 'phone',
				'label' => 'Phone Numnber',
				'rules' => 'trim|required'
			],
			[
				'field' => 'class1',
				'label' => 'Class',
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


	public function add_student_name()
        {                

        	$this->load->model('user_m');
        	$this->user_m->add_student();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }



	public function add_student_name_system()
        {                


		$students = file_get_contents('http://localhost/csmt-cbt-api/get_students_list.php');
		//////////
	    	$student_lists = json_decode($students);
	    	foreach ($student_lists as $student_list) 
	    	{
	    		$check_if_student_id_exists = $this->db->select('*')->from('students')->where('student_id_system',$student_list->stud_id)->get();
	    		if ($check_if_student_id_exists->num_rows() > 0) {
	    			///Update
	    			////get class_id using system's student class_id
	    			$get_class_id = $this->db->select('id')->from('class')->where('class_system_id',$student_list->student_class_id)->get();
	    			$class_id_get = $get_class_id->row();
	    			$class_id = $class_id_get->id;
	    			///Update
	    			$data_student = array(
	    				'fullname' => $student_list->student_name,
	    				'surname' => $student_list->surname,
	    				'othernames' => $student_list->othernames,
	    				'csmt_id' => $student_list->adm_no,
	    				'class' => $class_id,
	    				'school_type' => $student_list->school_type,
	    				'aagc_id' => $student_list->aagc_id,

	    			);
	    			$this->db->where('student_id_system',$student_list->stud_id);
	    			$this->db->update('students',$data_student);
	    		}
	    		else {
	    			///Insert

	    		$check_if_user_exists = $this->db->select('*')->from('users')->where('username',$student_list->adm_no)->get();

	    		if ($check_if_user_exists->num_rows() < 1) {
	    			////get class_id using system's student class_id
	    			$get_class_id = $this->db->select('id')->from('class')->where('class_system_id',$student_list->student_class_id)->get();
	    			$class_id_get = $get_class_id->row();
	    			$class_id = $class_id_get->id;
	    			///Update
	    			$data_user = array(
	    				'username' => $student_list->adm_no,
	    				'role_id' => 3

	    			);
	    			$insert = $this->db->insert('users', $data_user);
        			$user_id = $this->db->insert_id();
        			////////
        			$data_student = array(
	    				'fullname' => $student_list->student_name,
	    				'surname' => $student_list->surname,
	    				'othernames' => $student_list->othernames,
	    				'csmt_id' => $student_list->adm_no,
	    				'school_type' => $student_list->school_type,
	    				'class' => $class_id,
	    				'user_id' => $user_id,
	    				'student_id_system' => $student_list->stud_id,
	    				'aagc_id' => $student_list->aagc_id,

	    			);
	    			$insert2 =  $this->db->insert('students', $data_student);
	    		}
	    		else {
	    			$user_exists = $check_if_user_exists->row();
	    			$user_id = $user_exists->id;
	    			////get class_id using system's student class_id
	    			$get_class_id = $this->db->select('id')->from('class')->where('class_system_id',$student_list->student_class_id)->get();
	    			$class_id_get = $get_class_id->row();
	    			$class_id = $class_id_get->id;
	    			/////////////////////
	    			$data_student = array(
	    				'fullname' => $student_list->student_name,
	    				'surname' => $student_list->surname,
	    				'othernames' => $student_list->othernames,
	    				'csmt_id' => $student_list->adm_no,
	    				'school_type' => $student_list->school_type,
	    				'class' => $class_id,
	    				'user_id' => $user_id,
	    				'student_id_system' => $student_list->stud_id,
	    				'aagc_id' => $student_list->aagc_id,

	    			);
	    			$insert2 =  $this->db->insert('students', $data_student);

	    		}
	    		}
	    	}
        }


	public function add_class_to_student()
        {                

		$student_id = $this->input->post('student_id');
		$class_arm_id = $this->input->post('class_arm_id');
		$check_student_class = $this->db->select('*')->from('student_class')->where('student_id',$student_id)->get();
		if ($check_student_class->num_rows() > 0) {
        $data = array(
            'class_arm_id' => $class_arm_id
        );
        $this->db->where('student_id', $student_id);
        $this->db->update('student_class', $data);

		}
		else { 
			$data = array(
            'class_arm_id' => $class_arm_id,
            'student_id' => $student_id

        );
        $insert = $this->db->insert('student_class', $data);
        return $insert;

		}
        }




	public function get_student_details() {
        $student_details = $this->user_m->get_student_by_id();
		echo "[".json_encode($student_details)."]";		 
	}


	public function get_student_details2() {
		$student_details =$this->user_m->get_students_list23();
		echo json_encode($student_details);		 
	}

	public function get_student_details4() {
		$student_details =$this->user_m->get_students_list_other23();
		echo json_encode($student_details);		 
	}


	public function get_student_details3() {
		$student_id = $_GET['student_id'];
		$student_details = $this->user_m->get_student_class($student_id);
		echo json_encode($student_details);		 
	}



	//Isolating term view
	public function login_sessions ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Login Sessions';
		$this->data['class_list'] = $this->setup_m->get_class_list();
		$this->data['login_sessions'] = $this->user_m->get_login_sessions();

			if ($this->uri->segment(3)) {
				$this->data['login_sessions'] = $this->user_m->get_login_sessions_class($this->uri->segment(3));

			}
		$this->load->view('extras/login_sessions', $this->data);
	}


	//Isolating term view
	public function exam_logs ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Login Sessions';
		$this->data['class_list'] = $this->setup_m->get_class_list();
		$this->data['exam_logs'] = $this->user_m->exam_logs();

			if ($this->uri->segment(3)) {
				$this->data['exam_logs'] = $this->user_m->exam_logs($this->uri->segment(3));

			}
		$this->load->view('extras/exam_logs', $this->data);
	}


	//Isolating term view
	public function active_exams ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Login Sessions';
		$this->data['class_list'] = $this->setup_m->get_class_list();
		$this->data['exam_logs'] = $this->user_m->active_exams();

			if ($this->uri->segment(3)) {
				$this->data['exam_logs'] = $this->user_m->active_exams($this->uri->segment(3));

			}
		$this->load->view('extras/active_exams', $this->data);
	}


	public function get_student_class_by_id() {
        $student_class = $this->user_m->get_student_class_by_id();
		echo "[".json_encode($student_class)."]";		 
	}


	public function get_teacher_details() {
        $teacher_details = $this->user_m->get_teacher_by_id();
		echo "[".json_encode($teacher_details)."]";		 
	}


	public function get_teacher_subjects() {
        $teacher_subjects = $this->user_m->get_teacher_subjects();
		echo json_encode($teacher_subjects);		 
	}


}