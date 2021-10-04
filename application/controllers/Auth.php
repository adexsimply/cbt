<?php
class Auth extends CI_Controller {

	//////

	public function login()
	{
		$data['title'] = 'Login';
		$this->load->view('login2', $data);
	}
	//////

	public function register()
	{
		$this->load->model('setup_m');
		$this->data['title'] = 'Register';
		$this->data['class_list'] = $this->setup_m->get_class_list();
		$this->load->view('register', $this->data);
	}
	//////////////
	public function login_attempt()
	{
		$rules = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			]
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()) {
			$this->load->model('user_m');
			if ($this->input->post('student')) {

			$attempt = $this->user_m->attempt($this->input->post());
			}
			else {

			$attempt = $this->user_m->attempt_admin($this->input->post());
			}

				// header("Content-type:application/json");
				// echo json_encode($attempt);

			if ($attempt === null) {
				header("Content-type:application/json");
				echo json_encode(['password' => 'Wrong username or password']);
			} 
			elseif($attempt == "Invalid Login") {
				header("Content-type:application/json");
				echo json_encode(['password' => 'Invalid Login']);
			}
			else {
				$this->session->set_userdata('active_user', $attempt);
				
				//
				$this->user_m->login_session();
				//
				header("Content-type:application/json");
				echo json_encode(['status' => 'success']);
			}
		} 
		else {
			header("Content-type:application/json");
			echo json_encode($this->form_validation->get_all_errors());
		}
	}

	public function get_students () {
		$this->load->model('user_m');

		$all = $this->user_m->get_students_list23();

		//echo count($all);
        $student_lists = array();

        //$students_list = $this->patient_m->get_patient_names();
        // echo "[";
        $i=1;$j=1;
        foreach ($all as $student_list) {
        	$student_id = $student_list->student_id_system;
        	$uname = $student_list->csmt_id;
        	$lname = $student_list->surname;
        	$fname = $student_list->othernames;
            $aagc_id = $student_list->aagc_id;
            $student_class_id = $student_list->class_group_id;

        	//$query_update_students = mysqli_query($conn2, "UPDATE students SET student_id='$student_id', uname='$uname' WHERE fname='$fname' AND lname='$lname' ");
        	
        	// $query_get = mysqli_query($conn2, "SELECT * FROM students WHERE fname='$fname'");
        	// if (mysqli_num_rows($query_get) >0) {

        	// $row=mysqli_fetch_array($query_get);
        	// //echo $j.") ".$row['uname']."<br/>";

        	// $j++;
        	// }

            $student_lists[] = array("s_n"=>$i, "stud_id" => $student_list->student_id_system, "adm_no" => $student_list->csmt_id, "student_name" => $student_list->surname.' ' .$student_list->othernames, "current_class"=>$student_list->class_name, "arm"=>'Science', "lastname"=>$lname, "othernames"=>$fname, "school_type"=>'boarding', "aagc_id"=>$student_list->aagc_id, "student_class_id"=>$student_class_id, "surname"=>$lname, "othernames"=>$fname);
        $i++;
        }


		echo json_encode($student_lists);
	}

		// Add Material
    public function register_student()
    {
    		$check_if_password_exists = $this->db->select('password')->from('users')->where('username',$this->input->post('uname'))->get();
    		$password = $check_if_password_exists->password;
    		if ($password==null){
	            $data_student = array(
	                    'password' => $this->input->post('pword'),
	            );

	            $this->db->where('username',$this->input->post('uname'));
	            $this->db->update('users', $data_student);
	           redirect('auth/login');
    			
    		}
    		else {
	           redirect('auth/login');

    		}

            }
	///
	/**
     * Logout User
     *
     * @access 	public
     * @param 	
     * @return 	redirect
     */

	public function logout() {
		$this->session->unset_userdata('active_user');
		redirect(base_url().'auth/login');
	}

	public function logout_admin() {
		$this->session->unset_userdata('active_user');
		redirect(base_url().'control');
	}

}

?>