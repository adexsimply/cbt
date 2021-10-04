<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pin extends Base_Controller {

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

        $this->data['menu_id'] = 'pin';


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
		$this->data['class_list'] = $this->setup_m->get_class_list();
		$this->data['students_list'] = $this->user_m->get_students_list();
		$this->data['pin_auth_status'] = $this->pin_m->get_pin_auth_status();
		//$this->data['teachers_list'] = $this->user_m->get_teachers_list();
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('pins/main', $this->data);
	}

	public function generate_all () {

	$this->db->empty_table('student_pins');
	$students_list = $this->user_m->get_students_list();
	foreach ($students_list as $student) {
	$check_student = $this->db->select('*')->from('student_pins')->where('user_id', $student->user_id)->get();
	if ($check_student->num_rows() < 1) {

        $data = array(
            'user_id' => $student->user_id,
            'pin' => rand(10000,100000)
        );
        $insert = $this->db->insert('student_pins', $data);

	//return $insert;
	}
	}

	}
	public function generate_one () {

	$student_id = $this->input->post('student_id');

	$check_student_pin = $this->db->select('*')->from('student_pins')->where('user_id', $student_id)->get();
	if ($check_student_pin->num_rows() < 1) {
        $data = array(
            'user_id' => $student_id,
            'pin' => rand(10000,100000)
        );
        $insert = $this->db->insert('student_pins', $data);

        $data_s = array(
            'status' => 0
        );
         $this->db->where('id', $student_id);
        $this->db->update('users', $data_s);

	}
	else {

        $data = array(
            'pin' => rand(10000,100000)
        );
        $this->db->where('user_id', $student_id);
        $this->db->update('student_pins', $data);

        $data_s = array(
            'status' => 0
        );
         $this->db->where('id', $student_id);
        $this->db->update('users', $data_s);


	}

	}

	public function turn_pin_auth() {

		$status = $this->input->post('id');
        $data = array(
            'status' => $status
        );
        $this->db->where('settings_name', 'pin_auth_status');
        $this->db->update('settings', $data);
	}

    public function logs() {

        $this->load->model('user_m');
        $this->data['title'] = 'Users';
        $this->data['users_list'] = $this->user_m->get_users();
        $this->data['class_list'] = $this->setup_m->get_class_list();
        $this->data['students_list'] = $this->user_m->get_students_list();
        $this->data['pin_list'] = $this->pin_m->get_pin_for_student_logs();
        $this->data['pin_auth_status'] = $this->pin_m->get_pin_auth_status();
        //$this->data['teachers_list'] = $this->user_m->get_teachers_list();
        //$this->data['childview'] = 'dashboard/main';
        $this->load->view('pins/logs', $this->data);

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

	public function send_pin() {

		$recipients = $this->input->post('phone');
		$password = $this->input->post('password');
		$fullname = $this->input->post('fullname');

		$flash = 0;
		$message = $fullname.": PIN: ".$password;
		//$recipients = "08038387930,08121034565";
		$result = $this->useJSON($this->json_url, $this->username, $this->apikey, $flash, $this->sendername, $message, $recipients);

	}
	////

	public function send_pin_to_all() {

		$students = $this->user_m->get_students_list();
		foreach ($students as $student) {
			$recipients = $student->phone;
			$password = $student->password;
			$username = $student->username;
			$flash = 0;
			$message = "Username: ".$username." Password: ".$password;

		$result = $this->useJSON($this->json_url, $this->username, $this->apikey, $flash, $this->sendername, $message, $recipients);
		}

		// $recipients = $this->input->post('phone');
		// $password = $this->input->post('password');
		// $username = $this->input->post('username');

		//$recipients = "08038387930,08121034565";

	}
	////



	public function exempt_class()
        {                

        	$this->pin_m->exempt_class();

			header('Content-Type: application/json');
	    	echo json_encode('success');
        }


}