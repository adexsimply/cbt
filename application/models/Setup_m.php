<?php
class Setup_m extends CI_Model {
	public function get_session_list() {

		$get_session = $this->db->select('*')->from('sessions')->order_by('id', 'DESC')->get();
		$session_list = $get_session->result();
		return $session_list;
		
	}


    public function create_session_name()
    {
        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('sess_id'))
        {        	
		$this->db->set('session_title', $this->input->post('sess_name'));
		$this->db->where('id', $this->input->post('sess_id'));
		$this->db->update('sessions');        	
        }
        else {
        $data = array(
            'session_title' => $this->input->post('sess_name')
        );
        $insert = $this->db->insert('sessions', $data);

        return $insert;
        }
    }


    public function create_arm_name()
    {
        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('arm_id'))
        {           
        $this->db->set('arm_name', $this->input->post('arm_name'));
        $this->db->where('id', $this->input->post('arm_id'));
        $this->db->update('arm_list');         
        }
        else {
        $data = array(
            'arm_name' => $this->input->post('arm_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('arm_list', $data);

        return $insert;
        }
    }
    function get_arm_by_id(){
        $id = $this->input->post('id');
        $get_arm = $this->db->select('*')->from('arm_list')->where('id', $id)->get();
        $arm_list = $get_arm->row();
        return $arm_list;
    }
    

    ///Class
    public function get_class_list1() {

        $get_class = $this->db->select('a.*,u.username')->from('class_list a')->join('users as u', 'a.added_by=u.id', 'left')->order_by('class_list_name', 'ASC')->get();
        $class_list = $get_class->result();
        return $class_list;
    }


    function get_session_by_id(){
        $id = $this->input->post('id');
        $get_session = $this->db->select('*')->from('sessions')->where('id', $id)->get();
        $session_list = $get_session->row();
        return $session_list;
    }

    function get_current_session(){
        $get_c_session = $this->db->select('*')->from('sessionst')->where('session_status', 1)->get();
        $num_c_session = $get_c_session->num_rows();
        if ($num_c_session > 0 ) {
        $c_session = $get_c_session->row();
        return $c_session;
        }
    }
    ///Arms
    public function get_arm_list() {
        $get_arm = $this->db->select('a.*,u.username')->from('arm_list a')->join('users as u', 'a.added_by=u.id', 'left')->order_by('arm_name', 'ASC')->get();
        $arm_list = $get_arm->result();
        return $arm_list;
    }


    ///Arms
    public function get_arm_list22() {
        $get_arm = $this->db->select('*')->from('arms')->order_by('name', 'ASC')->get();
        $arm_list = $get_arm->result();
        return $arm_list;
    }

    ///Arms
    public function get_alias_list22() {
        $get_arm = $this->db->select('*')->from('aliases')->order_by('name', 'ASC')->get();
        $arm_list = $get_arm->result();
        return $arm_list;
    }



    ///Class
    public function get_class_list() {

        $get_class = $this->db->select('*')->from('class')->order_by('class_name', 'ASC')->get();
        $class_list = $get_class->result();
        return $class_list;
    }

    ///Class
    public function get_arms_list() {

        $get_class = $this->db->select('*')->from('arms')->order_by('name', 'ASC')->get();
        $class_list = $get_class->result();
        return $class_list;
    }

    ///Class
    public function get_alias_list() {

        $get_class = $this->db->select('*')->from('aliases')->order_by('name', 'ASC')->get();
        $class_list = $get_class->result();
        return $class_list;
    }


    ///Subjects
    public function get_subject_list() {

        $get_subject = $this->db->select('*')->from('subjects')->order_by('subject_name', 'ASC')->get();
        $subject_list = $get_subject->result();
        return $subject_list;
    }



    public function create_class_name()
    {
        //////////////////////
        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('class_id'))
        {           
        $data = array(
            'class_name' => $this->input->post('class_name'),
            'class_group_id' => $this->input->post('group'),
            'class_school' => $this->input->post('school')
        );
        //$this->db->set('class_name', $this->input->post('class_name'));
        $this->db->where('id', $this->input->post('class_id'));
        $this->db->update('class',$data);         
        }
        else {
        $data = array(
            'class_name' => $this->input->post('class_name'),
            'class_group_id' => $this->input->post('group'),
            'class_school' => $this->input->post('school')
        );
        $insert = $this->db->insert('class', $data);

        return $insert;
        }
    }

    public function create_class_name2()
    {
        //////////////////////
        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('class_id'))
        {           
        $this->db->set('class_list_name', $this->input->post('class_name'));
        $this->db->where('id', $this->input->post('class_id'));
        $this->db->update('class_list');         
        }
        else {
        $data = array(
            'class_list_name' => $this->input->post('class_name'),
            'added_by' =>$user_id
        );
        $insert = $this->db->insert('class_list', $data);

        return $insert;
        }
    }

    function get_class_by_id(){
        $id = $this->input->post('id');
        $get_class = $this->db->select('*')->from('class')->where('id', $id)->get();
        $class_list = $get_class->row();
        return $class_list;
    }


    function get_class_by_id2(){
        $id = $this->input->post('id');
        $get_class = $this->db->select('*')->from('class_list')->where('id', $id)->get();
        $class_list = $get_class->row();
        return $class_list;
    }

    public function create_subject_name()
    {
        $class_id = implode(",", $this->input->post('class_id'));
        //////////////////////
        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('subject_id'))
        {           
        $this->db->set('subject_name', $this->input->post('subject_name'));
        $this->db->where('id', $this->input->post('subject_id'));
        $this->db->update('subjects');         
        }
        else {
        $data = array(
            'subject_name' => $this->input->post('subject_name'),
            'classes_id' => $class_id,
        );
        $insert = $this->db->insert('subjects', $data);

        return $insert;
        }
    }


    

    ///Class arm lsit without group_id
    public function get_class_arm_list() {
        $get_class_arm = $this->db->select('ca.*,u.username,c.class_list_name,a.arm_name')->from('class_arm ca')->join('users as u', 'ca.added_by=u.id', 'left')->join('class_list as c', 'ca.class_id=c.id', 'left')->join('arm_list as a', 'ca.arm_id=a.id', 'left')->order_by('id', 'DESC')->get();
        $class_arm_list = $get_class_arm->result();
        return $class_arm_list;
    }



    public function create_class_arm_name()
    {

        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('class_arm_id'))
        { 
        $data = array(
            'class_id' => $this->input->post('class_name'),
            'arm_id' => $this->input->post('arm_name'),
            'alias' => $this->input->post('alias'),
            'added_by' => $user_id
        );          
        //$this->db->set('class_name', $this->input->post('class_name'));
        $this->db->where('id', $this->input->post('class_arm_id'));
        $this->db->update('class_arm',$data);
    }

        else {
        $data = array(
            'class_id' => $this->input->post('class_name'),
            'arm_id' => $this->input->post('arm_name'),
            'alias' => $this->input->post('alias'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('class_arm', $data);

        return $insert;

        }
    }

    function get_class_arm_by_id(){
        $id = $this->input->post('id');
        $get_class_arm = $this->db->select('ca.*,u.username,c.class_list_name,a.arm_name')->from('class_arm ca')->join('users as u', 'ca.added_by=u.id', 'left')->join('class_list as c', 'ca.class_id=c.id', 'left')->join('arm_list as a', 'ca.arm_id=a.id', 'left')->where('ca.id', $id)->get();
        $class_arm_list = $get_class_arm->row();
        return $class_arm_list;
    }





}

?>