<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends Base_Controller {

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
		$this->load->model('notice_m');

        $this->data['menu_id'] = 'notice';



	}

	//Users
	public function index ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'Users';
		//$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->session->userdata('active_user')->role_id != 3) {
		$this->data['notices'] = $this->notice_m->all();
		}
		else {

		$this->data['notices'] = $this->notice_m->all_students();
		}
		$this->load->view('notice/main', $this->data);

	}


	public function delete_notice()
	{
		$id = $this->input->post('id');
		$this->db->delete('notices', array('id' => $id));
	}




	public function delete_comment()
	{
		$id = $this->input->post('id');
		$this->db->delete('comments', array('id' => $id));
	}



	////Upload files
	function ddoo_upload($filename){
	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx|jpeg|mp4|mp3|ogg|ppt|pptx';
            $config['max_size']             = 1000000000;
            $config['max_width']            = 90240;
            $config['max_height']           = 70680;

	$this->load->library('upload', $config);
	if ( ! $this->upload->do_upload($filename)) {
	    $error = array('error' => $this->upload->display_errors());
	return false;
	 $this->load->view('upload_form', $error);
	} else {
	$data = array('upload_data' => $this->upload->data());
	return $this->upload->data('full_path');
	$this->load->view('upload_success', $data);
	}
	}	

	// Add Material
    public function add_notice()
    {

		if (isset($_FILES['materialfile']) && $_FILES['materialfile']['name'] != ''){
		    $file2 = $this->ddoo_upload('materialfile');
		    $ext = pathinfo($_FILES['materialfile']['name'], PATHINFO_EXTENSION);
		}   
		else {
			$file2 = "";
		}
	            $picture = array(
	                    'attachment' => $file2,
	                    'priority' => $this->input->post('priority'),
	                    'class_id' => $this->input->post('class'),
	                    'body' => $this->input->post('body')
	            );

	            $this->db->insert('notices', $picture);
	           redirect('notice');

            }


	public function get_teacher_details() {
        $teacher_details = $this->user_m->get_teacher_by_id();
		echo "[".json_encode($teacher_details)."]";		 
	}

public function comments (){

		if ($this->session->userdata('active_user')->role_id == 1) {

		$this->data['comments'] = $this->notice_m->get_comments_for_admin2();
		$this->load->view('notice/comments', $this->data);
		}
		else {
			show_404();
		}


}


}