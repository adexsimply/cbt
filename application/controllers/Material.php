<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends Base_Controller {

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
		$this->load->model('material_m');

        $this->data['menu_id'] = 'material';


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
		$this->data['title'] = 'Materials';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->session->userdata('active_user')->role_id == 1) {
			$this->data['subjects_list'] = $this->material_m->get_subjects_for_admin1();
		}
		elseif ($this->session->userdata('active_user')->role_id == 2) {
		$this->data['subjects_list'] = $this->material_m->get_subjects_for_teacher();
		}
		//$this->data['childview'] = 'dashboard/main';
		$this->load->view('material/main', $this->data);
	}


	//Users
	public function view ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'View Materials';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		//////
		$this->data['get_materials'] = $this->material_m->get_subjects_for_teacher();
		//$this->data['childview'] = 'dashboard/main';
		if ($this->uri->segment(3)) {
		////
		if ($this->uri->segment(3)=='new') {
			//Filter by class
			if ($this->uri->segment(4)) {
		$this->data['materials_list'] = $this->material_m->get_materials_for_admin_new_class($this->uri->segment(4));
		$this->load->view('material/view', $this->data);
			}
			else {
		$this->data['materials_list'] = $this->material_m->get_materials_for_admin_new();
		$this->load->view('material/view', $this->data);

			}
		}
		elseif($this->uri->segment(3)=='old'){
			//Filter by class
			if ($this->uri->segment(4)) {
		$this->data['materials_list'] = $this->material_m->get_materials_for_admin_old_class($this->uri->segment(4));
		$this->load->view('material/view', $this->data);
			}
			else {
		$this->data['materials_list'] = $this->material_m->get_materials_for_admin_old();
		$this->load->view('material/view', $this->data);

			}
		}
		//Show results by class
		elseif($this->uri->segment(3)=='class'){
			if ($this->uri->segment(4)) {
		$this->data['materials_list'] = $this->material_m->get_materials_by_class($this->uri->segment(4));
		$this->load->view('material/view', $this->data);
			}
			else {
				show_404();
			}
		}
		$this->data['material_info'] = $this->material_m->get_material_info($this->uri->segment(3));
		$this->data['material_comments'] = $this->material_m->get_material_comment($this->uri->segment(3));

		if ($this->uri->segment(3)!='new' && $this->uri->segment(3)!='old' && $this->uri->segment(3)!='class') {
		$this->load->view('material/view_item', $this->data);
		}
		}
		else {

		if ($this->session->userdata('active_user')->role_id == 1) {
		$this->data['materials_list'] = $this->material_m->get_materials_for_admin();
		}
		elseif ($this->session->userdata('active_user')->role_id == 2) {
		$this->data['materials_list'] = $this->material_m->get_materials_for_teacher();
		}
		elseif ($this->session->userdata('active_user')->role_id == 3) {
		$this->data['materials_list'] = $this->material_m->get_materials_for_student();
		}

		$this->load->view('material/view', $this->data);
		}
	}
	//Users
	public function upload ()
	{		
		$this->load->model('user_m');
		$this->data['title'] = 'View Materials';
		$this->data['users_list'] = $this->user_m->get_users();
		$this->data['class_list'] = $this->setup_m->get_class_list();
		if ($this->session->userdata('active_user')->role_id == 1) {
		$this->data['materials_list'] = $this->material_m->get_materials_for_admin();
		}
		//////
		$this->data['get_materials'] = $this->material_m->get_subjects_for_teacher();
		//$this->data['childview'] = 'dashboard/main';
		if ($this->uri->segment(3)) {
		////
		$this->data['material_info'] = $this->material_m->get_material_info($this->uri->segment(3));
		$this->data['material_comments'] = $this->material_m->get_material_comment($this->uri->segment(3));
		$this->load->view('material/upload', $this->data);
		}
		else {
			show_404();
		}
	}

	////Upload files
	function ddoo_upload($filename){
	$config['upload_path']          = './uploads/';
            //$config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx|jpeg|mp4|mp3|ogg|ppt|pptx';
            $config['allowed_types']        = '*';
            $config['max_size']             = 10000000;
            $config['max_width']            = 1024000;
            $config['max_height']           = 768000;

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
    public function add_material()
    {
  		$user_id = $this->session->userdata('active_user')->id;

		if (isset($_FILES['materialfile']) && $_FILES['materialfile']['name'] != ''){
		    $file2 = $this->ddoo_upload('materialfile');
		    $ext = pathinfo($_FILES['materialfile']['name'], PATHINFO_EXTENSION);
		}   
		else {
			$file2 = "";
		}
	            $picture = array(
	                    'attachment' => $file2,
	                    'title' => $this->input->post('title'),
	                    'teacher_id' => $user_id,
	                    // 'author_name' => $this->input->post('author'),
	                    // 'isbn' => $this->input->post('isbn'),
	                    'class_id' => $this->input->post('class'),
	                    'subject_id' => $this->input->post('subject'),
	                    'description' => $this->input->post('description')
	            );

	            $this->db->insert('materials', $picture);
	            $last_id = $this->db->insert_id();
	           redirect('material/view');

            }


	// Add Material
    public function upload_admin()
    {
  		$user_id = $this->session->userdata('active_user')->id;

		if (isset($_FILES['materialfile']) && $_FILES['materialfile']['name'] != ''){
		    $file2 = $this->ddoo_upload('materialfile');
		    $ext = pathinfo($_FILES['materialfile']['name'], PATHINFO_EXTENSION);
		}   
		else {
			$file2 = "";
		}
	            $picture = array(
	                    'attachment_admin' => $file2
	            );


        $this->db->where('id', $this->input->post('item_id'));
        $this->db->update('materials', $picture);  


	            // $this->db->insert('comments', $picture);
	            // $last_id = $this->db->insert_id();
	           redirect('material/view/'.$this->input->post('item_id'));

            }



	// Add Material
    public function add_comment()
    {
  		$user_id = $this->session->userdata('active_user')->id;

		if (isset($_FILES['materialfile']) && $_FILES['materialfile']['name'] != ''){
		    $file2 = $this->ddoo_upload('materialfile');
		    $ext = pathinfo($_FILES['materialfile']['name'], PATHINFO_EXTENSION);
		}   
		else {
			$file2 = "";
		}
	            $picture = array(
	                    'attachment' => $file2,
	                    'comment_body' => $this->input->post('text'),
	                    'user_id' => $user_id,
	                    'item_type' => "Material Comment",
	                    // 'isbn' => $this->input->post('isbn'),
	                    'item_id' => $this->input->post('item_id'),
	            );

	            $this->db->insert('comments', $picture);
	            $last_id = $this->db->insert_id();
	           redirect('material/view/'.$this->input->post('item_id'));

            }



	public function delete_material()
	{
		$id = $this->input->post('id');
		$this->db->delete('materials', array('id' => $id));
	}



}