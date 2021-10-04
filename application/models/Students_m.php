<?php
class Students_m extends CI_Model {

    public function get_student_list() {
            /////////////////////
            //$current_category_id = $this->user_m->get_category()->id;
            //////////////////////

        $get_students = $this->db->select('st.*,u.username')->from('students st')->join('users as u', 'st.added_by=u.id', 'left')->order_by('name', 'ASC')->get();
        $student_list = $get_students->result();
        return $student_list;  
        
    }


    public function get_student_with_group_list() {
        $current_category_id = $this->user_m->get_category()->id;

        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        $get_students = $this->db->select('s.*,cast.*,ca.*,c.class_name,a.arm_name, s.id as stud_id')->from('students s')->join('student_class as sc', 'sc.student_id=s.id AND sc.session_term_id='.$current_sess_term_id, 'left')->join('class_arm_session_term as cast', 'sc.class_arm_session_term_id=cast.id AND cast.session_term_id='.$current_sess_term_id, 'left')->join('class_arm as ca', 'cast.class_arm_id=ca.id', 'left')->join('arm_list as a', 'ca.arm_id=a.id', 'left')->join('class_list as c', 'ca.class_id=c.id', 'left')->where('s.categories_id',$current_category_id)->order_by('s.id', 'DESC')->get();
        $student_list = $get_students->result();
        return $student_list;
        
    }

    public function get_group_by_student_id ($student_id) {
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        $get_group_by_student = $this->db->select('ssgst.*,sgst.*,sg.*,ssgst.id as ssgst_id')->from('students_sgst ssgst')->join('student_group_session_term as sgst','sgst.id=ssgst.sgst_id AND sgst.session_term_id='.$current_sess_term_id, 'LEFT')->join('student_group as sg','sg.id=sgst.student_group_id')->where('student_id',$student_id)->get();
    
        $group_by_student = $get_group_by_student->row();
        return $group_by_student;
    }


    public function get_student_list_json() {

        // $get_students = $this->db->select('st.*,u.username')->from('students st')->join('users as u', 'st.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
        // $student_list = $get_students->result();
        // return $student_list;        
        $get_students = $this->db->select('st.*,sc.*,cast.*,ca.*,c.class_name,a.arm_name,u.username,st.id as student_id,st.date_added as st_date_added')->from('students st')->join('student_class as sc', 'sc.student_id=st.id', 'left')->join('class_arm_session_term as cast', 'sc.class_arm_session_term_id=cast.id', 'left')->join('class_arm as ca', 'cast.class_arm_id=ca.id', 'left')->join('arm_list as a', 'ca.arm_id=a.id', 'left')->join('class_list as c', 'ca.class_id=c.id', 'left')->join('users as u', 'st.added_by=u.id', 'left')->order_by('st.id', 'DESC')->get();
        $student_list = $get_students->result();
        return $student_list;
        
    }

    public function get_class_arm_list() {
        $current_category_id = $this->user_m->get_category()->id;

        $get_class_arm = $this->db->select('ca.*,u.username,a.arm_name,c.class_name')->from('class_arm ca')->join('users as u', 'ca.added_by=u.id', 'left')->join('class_list as c', 'ca.class_id=c.id', 'left')->join('arm_list as a', 'ca.arm_id=a.id', 'left')->where('ca.categories_id', $current_category_id)->order_by('id', 'DESC')->get();
        $class_arm_list = $get_class_arm->result();
        return $class_arm_list;
    }

    function get_student_by_id(){
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        $id = $this->input->post('id');
        $get_student = $this->db->select('st.*,sc.*,cast.*,ca.*,c.class_name,a.arm_name,u.username,st.id as student_id,st.date_added as st_date_added')->from('students st')->join('student_class as sc', 'sc.student_id=st.id AND sc.session_term_id='.$current_sess_term_id, 'left')->join('class_arm_session_term as cast', 'sc.class_arm_session_term_id=cast.id', 'left')->join('class_arm as ca', 'cast.class_arm_id=ca.id', 'left')->join('arm_list as a', 'ca.arm_id=a.id', 'left')->join('class_list as c', 'ca.class_id=c.id', 'left')->join('users as u', 'st.added_by=u.id', 'left')->where('st.id', $id)->get();
        $student_list = $get_student->row();
        return $student_list;
    }

    function get_student_by_class($class_arm_id){
        /////Current Session Term Id
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        ///////Get cast_id
        $get_cast_id = $this->db->select('*')->from('class_arm_session_term')->where('class_arm_id', $class_arm_id)->where('session_term_id', $current_sess_term_id)->get();
        /////////
        $row_cast_id = $get_cast_id->row();
        $cast_id = $row_cast_id->id;
        $get_student1 = $this->db->select('sc.*,st.name,st.csmt_id, sc.student_id as stud_id, sc.class_arm_session_term_id as cast_id')->from('student_class sc')->join('students as st', 'sc.student_id=st.id', 'left')->where('sc.class_arm_session_term_id', $cast_id)->get();
        $student1_list = $get_student1->result();
        return $student1_list;
    }

    function get_student_by_group($group_id){
        /////Current Session Term Id
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        ///////Get sgst_id
        $get_sgst_id = $this->db->select('*')->from('student_group_session_term')->where('student_group_id', $group_id)->where('session_term_id', $current_sess_term_id)->get();
        /////////
        $row_sgst_id = $get_sgst_id->row();
        $sgst_id = $row_sgst_id->id;
        $get_student1 = $this->db->select('ssgst.*,st.*,sc.*, ssgst.student_id as stud_id,ssgst.id as ssgst_id')->from('students_sgst ssgst')->join('students as st', 'ssgst.student_id=st.id', 'left')->join('student_class as sc', 'sc.student_id=ssgst.student_id AND session_term_id='.$current_sess_term_id, 'left')->where('ssgst.sgst_id', $sgst_id)->get();
        $student1_list = $get_student1->result();
        return $student1_list;
    }


    function add_to_class($student_id,$class_arm_id,$current_cast_id){
        /////Current Session Term Id
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        $user_id = $this->session->userdata('active_user')->id; 
        ///////Get cast_id
        $get_cast_id = $this->db->select('*')->from('class_arm_session_term')->where('class_arm_id', $class_arm_id)->where('session_term_id', $current_sess_term_id)->get();
        /////////
        $row_cast_id = $get_cast_id->row();
        $cast_id = $row_cast_id->id;
        ///Check if student exists in class
        if ($current_cast_id == 0) {
        $data  = array(
            'student_id' => $student_id,
            'class_arm_session_term_id' => $cast_id,
            'session_term_id' => $current_sess_term_id,
            'added_by' => $user_id,
        );
        $insert_to_class = $this->db->insert('student_class', $data);

        }
        else {
        $data  = array(
            'class_arm_session_term_id' => $cast_id
        );
        $this->db->where('student_id', $student_id);
        $this->db->where('class_arm_session_term_id', $current_cast_id);
        $this->db->update('student_class', $data);         
            
        }

    }



    function add_to_group($student_id,$sgst_id,$current_sgst_id){
        /////Current Session Term Id
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        $user_id = $this->session->userdata('active_user')->id; 
        ///////Get cast_id
        // $get_cast_id = $this->db->select('*')->from('class_arm_session_term')->where('class_arm_id', $class_arm_id)->where('session_term_id', $current_sess_term_id)->get();
        // /////////
        // $row_cast_id = $get_cast_id->row();
        // $cast_id = $row_cast_id->id;
        ///Check if student exists in class
        if ($current_sgst_id == 0) {
        $data  = array(
            'student_id' => $student_id,
            'sgst_id' => $sgst_id,
            'added_by' => $user_id
        );
        $insert_to_group = $this->db->insert('students_sgst', $data);

        }
        else {
        $data  = array(
            'sgst_id' => $sgst_id
        );
        $this->db->where('student_id', $student_id);
        $this->db->where('sgst_id', $current_sgst_id);
        $this->db->update('students_sgst', $data);         
            
        }

    }


    public function create_student()
    {
        /////////////////////
        $current_category_id = $this->user_m->get_category()->id;
        //////////////////////

        $this->load->helper('url');

        //$this->load->model('admissions_m');
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        //$current_sess_id = $current_sess->id;
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('student_id'))
        {    
        $data_student = array(
            'csmt_id'  => $this->input->post('school_id'),
            'name'    => $this->input->post('student_name'),
            'added_by'   => $user_id
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('student_id'));
        $this->db->update('students', $data_student); 
        //////////////////Get class_arm_session_term_id
        $query_cast = $this->db->select('*')->from('class_arm_session_term')->where('class_arm_id', $this->input->post('class_arm'))->where('session_term_id', $current_sess_term_id)->get();
        $row_cast = $query_cast->row();
        $cast_id = $row_cast->id;
        ////////////////Update student_class table
        $check_student_class = $this->db->select('*')->from('student_class')->where('student_id', $this->input->post('student_id'))->where('session_term_id', $current_sess_term_id)->get();
        $row_student_class = $check_student_class->row();
        $student_class_id = $row_student_class->id;
        $num_check_student_class = $check_student_class->num_rows();
        if ($num_check_student_class > 0) {
        $data_student_class = array(
            'student_id'  => $this->input->post('student_id'),
            'class_arm_session_term_id'    => $cast_id,
            'session_term_id'    => $current_sess_term_id,
            'added_by'   => $user_id
        );
        $this->db->where('id', $student_class_id);
        $this->db->update('student_class', $data_student_class); 
        }
        else {
        $data_student_class = array(
            'student_id'  => $this->input->post('student_id'),
            'class_arm_session_term_id'    => $cast_id,
            'session_term_id'    => $current_sess_term_id,
            'added_by'   => $user_id
        );
        $insert_student_class = $this->db->insert('student_class', $data_student_class);
        exit();
        }
        
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'csmt_id'  => $this->input->post('school_id'),
            'name'    => $this->input->post('student_name'),
            'categories_id'    => $current_category_id,
            'added_by'   => $user_id
        );
        $insert = $this->db->insert('students', $data);
        $last_id = $this->db->insert_id();
        //////////////////Get class_arm_session_term_id
        $query_cast = $this->db->select('*')->from('class_arm_session_term')->where('class_arm_id', $this->input->post('class_arm'))->where('session_term_id', $current_sess_term_id)->get();
        $row_cast = $query_cast->row();
        $cast_id = $row_cast->id;
        $data_student_class = array(
            'student_id'  => $last_id,
            'class_arm_session_term_id'    => $cast_id,
            'session_term_id'    => $current_sess_term_id,
            'added_by'   => $user_id
        );
        $insert_sess_student = $this->db->insert('student_class', $data_student_class); 
        //return $insert;
        }//End of New Request
    }
/////////////////////Student Group
    public function get_group_list() {
        /////////////////////
        $current_category_id = $this->user_m->get_category()->id;
        //////////////////////

        $get_group = $this->db->select('sg.*,u.username')->from('student_group sg')->join('users as u', 'sg.added_by=u.id', 'left')->where('categories_id',$current_category_id)->order_by('student_group_name', 'ASC')->get();
        $group_list = $get_group->result();
        return $group_list;       
        
    }

    function get_group_by_id(){
        $id = $this->input->post('id');
        $get_group = $this->db->select('*')->from('student_group')->where('id', $id)->get();
        $group_list = $get_group->row();
        return $group_list;
    }


    public function create_group()
    {
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;  
        /////////////////////
        $current_category_id = $this->user_m->get_category()->id;
        //////////////////////
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('group_id'))
        {    
        $data_student = array(
            'student_group_name'    => $this->input->post('group_name'),
            'added_by'   => $user_id
        );         
        $this->db->where('id', $this->input->post('group_id'));
        $this->db->update('student_group', $data_student); 
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'student_group_name'    => $this->input->post('group_name'),
            'categories_id'    => $current_category_id,
            'added_by'   => $user_id
        );
        $insert = $this->db->insert('student_group', $data);
        ////Create Student groups for current Session_term

        $last_id = $this->db->insert_id();
            $query_check_sgst = $this->db->select('*')->from('student_group_session_term')->where('student_group_id',$last_id)->where('session_term_id',$current_sess_term_id)->get();
            if ($query_check_sgst->num_rows()=='0') {
                $data_sgst = array(
                    'student_group_id' => $last_id,
                    'added_by' => $user_id,
                    'session_term_id' => $current_sess_term_id
                );
                $query_create_sgst = $this->db->insert('student_group_session_term',$data_sgst);
            }
        return $insert;
        }//End of New Request
    }

    ////////////Fee_amount


    public function get_fee_list() { 
    if (!empty($this->setup_m->get_current_sess_term()->id))
    {
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;  
        $get_fee = $this->db->select('sgst.*,sgft.*,f.fee_type_name,sg.student_group_name,u.username')->from('student_group_fee_type sgft')->join('student_group_session_term as sgst', 'sgft.sgst_id=sgst.id', 'left')->join('fee_type as f', 'sgft.fee_type_id=f.id', 'left')->join('student_group as sg', 'sgst.student_group_id=sg.id', 'left')->join('users as u', 'sgst.added_by=u.id', 'left')->where('session_term_id', $current_sess_term_id)->order_by('sgst.id', 'DESC')->get();
        $fee_list = $get_fee->result();
        return $fee_list;
    }
        
    }

    function get_fee_by_id(){
        $id = $this->input->post('id');
        $get_fee = $this->db->select('sgst.*,sgft.*,sg.student_group_name,f.fee_type_name,u.username')->from('student_group_fee_type sgft')->join('student_group_session_term as sgst', 'sgft.sgst_id=sgst.id', 'left')->join('student_group as sg', 'sgst.student_group_id=sg.id', 'left')->join('fee_type as f', 'sgft.fee_type_id=f.id', 'left')->join('users as u', 'sgst.added_by=u.id', 'left')->where('sgft.id', $id)->get();
        $fee_list = $get_fee->row();
        return $fee_list;
    }


    public function create_fee()
    {
        $this->load->helper('url');

        //$this->load->model('admissions_m');
        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        //$current_sess_id = $current_sess->id;
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('fee_id'))
        {    
            $get_sgst_id = $this->db->select('*')->from('student_group_session_term')->where('student_group_id',$this->input->post('student_group'))->where('session_term_id',$current_sess_term_id)->get();
            $row_sgst_id = $get_sgst_id->row();
            $sgst_id = $row_sgst_id->id;
        $data_student = array(
            'sgst_id'  => $sgst_id,
            'fee_type_id'    => $this->input->post('fee_type'),
            'amount'    => $this->input->post('amount'),
            'added_by'   => $user_id
        );         
        $this->db->where('id', $this->input->post('fee_id'));
        $this->db->update('student_group_fee_type', $data_student); 
        }//End of Update
        //If it's a new request
        else {
            $get_sgst_id = $this->db->select('*')->from('student_group_session_term')->where('student_group_id',$this->input->post('student_group'))->where('session_term_id',$current_sess_term_id)->get();
            $row_sgst_id = $get_sgst_id->row();
            $sgst_id = $row_sgst_id->id;
        $data = array(
            'sgst_id'  => $sgst_id,
            'fee_type_id'    => $this->input->post('fee_type'),
            'amount'    => $this->input->post('amount'),
            'added_by'   => $user_id
        );
        $insert = $this->db->insert('student_group_fee_type', $data);
        //return $insert;
        }//End of New Request
    }


    public function create_student_group()
    {
        $this->load->helper('url');

        $current_sess_term_id = $this->setup_m->get_current_sess_term()->id;
        //$current_sess_id = $current_sess->id;
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('ssgst_id'))
        {
            $query_get_sgst = $this->db->select('*')->from('student_group_session_term')->where('session_term_id', $current_sess_term_id)->where('student_group_id',$this->input->post('student_group'))->get();
            $row_get_sgst = $query_get_sgst->row();
            $sgst_id = $row_get_sgst->id;   

        $data_student = array(
            'student_id'  => $this->input->post('student_id'),
            'sgst_id'    => $sgst_id,
            'added_by'   => $user_id
        );         
        $this->db->where('id', $this->input->post('ssgst_id'));
        $this->db->update('students_sgst', $data_student); 
        //////////////////Get class_arm_session_term_id
        }//End of Update
        //If it's a new request
        else {
            $query_get_sgst = $this->db->select('*')->from('student_group_session_term')->where('session_term_id', $current_sess_term_id)->where('student_group_id',$this->input->post('student_group'))->get();
            $row_get_sgst = $query_get_sgst->row();
            $sgst_id = $row_get_sgst->id;
        $data = array(
            'student_id'  => $this->input->post('student_id'),
            'sgst_id'    => $sgst_id,
            'added_by'   => $user_id
        );
        $insert = $this->db->insert('students_sgst', $data);
        return $insert;
        }//End of New Request
    }
















    function get_class_by_group(){
        $id = $this->input->post('id');
        $get_class = $this->db->select('c.*,u.username,a.arm_name,l.level_name')->from('class_list c')->join('users as u', 'c.added_by=u.id', 'left')->join('level_list as l', 'c.level_id=l.id', 'left')->join('arm_list as a', 'c.arm_id=a.id', 'left')->where('c.level_group', $id)->order_by('l.level_name', 'ASC')->get();
        $class_list = $get_class->result();
        return $class_list;
    }


      public function create_session_name()
    {
        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('sess_id'))
        {        	
		$this->db->set('sess_name', $this->input->post('sess_name'));
		$this->db->where('id', $this->input->post('sess_id'));
		$this->db->update('session_list');        	
        }
        else {
        $data = array(
            'sess_name' => $this->input->post('sess_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('session_list', $data);

        return $insert;
        }
    }

	function get_session_by_id(){
		$id = $this->input->post('id');
		$get_session = $this->db->select('*')->from('session_list')->where('id', $id)->get();
		$session_list = $get_session->row();
		return $session_list;
	}

    public function get_term_list() {

        $get_term = $this->db->select('t.*,u.username')->from('term_list t')->join('users as u', 't.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
        $term_list = $get_term->result();
        return $term_list;
    }


    public function create_term_name()
    {
        $this->load->helper('url');

        $user_id = $this->session->userdata('active_user')->id;        
        if ($this->input->post('term_id'))
        {           
        $this->db->set('term_name', $this->input->post('term_name'));
        $this->db->where('id', $this->input->post('term_id'));
        $this->db->update('term_list');         
        }
        else {
        $data = array(
            'term_name' => $this->input->post('term_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('term_list', $data);

        return $insert;
        }
    }

    function get_term_by_id(){
        $id = $this->input->post('id');
        $get_term = $this->db->select('*')->from('term_list')->where('id', $id)->get();
        $term_list = $get_term->row();
        return $term_list;
    }

    ///Levels
    public function get_level_list() {

        $get_level = $this->db->select('l.*,u.username')->from('level_list l')->join('users as u', 'l.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
        $level_list = $get_level->result();
        return $level_list;
    }


    public function create_level_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('level_id'))
        {    
        $data_level = array(
            'level_name' => $this->input->post('level_name'),
            'level_rank' => $this->input->post('level_rank')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('level_id'));
        $this->db->update('level_list', $data_level); 
       // }
            
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'level_name' => $this->input->post('level_name'),
            'level_rank' => $this->input->post('level_rank'),
            'added_by' => $user_id
        );
        $query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        $num_rows = $query_check_rank->num_rows();
        if ($num_rows=='0'){
        $insert = $this->db->insert('level_list', $data);
        }

        return $insert;
        }//End of New Request
    }

    function get_level_by_id(){
        $id = $this->input->post('id');
        $get_level = $this->db->select('*')->from('level_list')->where('id', $id)->get();
        $level_list = $get_level->row();
        return $level_list;
    }

    

    ///Levels
    public function get_category_list() {

        $get_category = $this->db->select('c.*,u.username')->from('category_list c')->join('users as u', 'c.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
        $category_list = $get_category->result();
        return $category_list;
    }


    public function create_category_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('category_id'))
        {    
        $data_category = array(
            'category_name' => $this->input->post('category_name')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('category_id'));
        $this->db->update('category_list', $data_category); 
       // }
            
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'category_name' => $this->input->post('category_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('category_list', $data);
        return $insert;
        }//End of New Request
    }

    function get_category_by_id(){
        $id = $this->input->post('id');
        $get_category = $this->db->select('*')->from('category_list')->where('id', $id)->get();
        $category_list = $get_category->row();
        return $category_list;
    }


    

    ///Levels
    public function get_arm_list() {

        $get_arm = $this->db->select('a.*,u.username,g.group_name')->from('arm_list a')->join('users as u', 'a.added_by=u.id', 'left')->join('level_group_list as g', 'a.level_group=g.id', 'left')->order_by('id', 'DESC')->get();
        $arm_list = $get_arm->result();
        return $arm_list;
    }


    public function create_arm_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('arm_id'))
        {    
        $data_arm = array(
            'arm_name' => $this->input->post('arm_name'),
            'alias' => $this->input->post('alias'),
            'level_group' => $this->input->post('level_group')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('arm_id'));
        $this->db->update('arm_list', $data_arm); 
       // }
            
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'arm_name' => $this->input->post('arm_name'),
            'alias' => $this->input->post('alias'),
            'level_group' => $this->input->post('level_group'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('arm_list', $data);
        return $insert;
        }//End of New Request
    }

    function get_level_group_list(){
        $get_level_group = $this->db->select('*')->from('level_group_list')->get();
        $level_group_list = $get_level_group->result();
        return $level_group_list;
    }


    function get_arm_by_id(){
        $id = $this->input->post('id');
        $get_arm = $this->db->select('a.*,g.group_name')->from('arm_list a')->join('level_group_list as g', 'a.level_group=g.id', 'left')->where('a.id', $id)->get();
        $arm_list = $get_arm->row();
        return $arm_list;
    }

    

    

    ///Levels
    public function get_club_list() {

        $get_club = $this->db->select('c.*,u.username')->from('club_list c')->join('users as u', 'c.added_by=u.id', 'left')->order_by('id', 'DESC')->get();
        $club_list = $get_club->result();
        return $club_list;
    }


    public function create_club_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('club_id'))
        {    
        $data_club = array(
            'club_name' => $this->input->post('club_name')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('club_id'));
        $this->db->update('club_list', $data_club); 
       // }
            
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'club_name' => $this->input->post('club_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('club_list', $data);
        return $insert;
        }//End of New Request
    }


    function get_club_by_id(){
        $id = $this->input->post('id');
        $get_club = $this->db->select('*')->from('club_list')->where('id', $id)->get();
        $club_list = $get_club->row();
        return $club_list;
    }

    

    

    ///Levels
	public function get_class_list() {

        $get_class = $this->db->select('c.*,u.username,a.arm_name,l.level_name')->from('class_list c')->join('users as u', 'c.added_by=u.id', 'left')->join('level_list as l', 'c.level_id=l.id', 'left')->join('arm_list as a', 'c.arm_id=a.id', 'left')->order_by('id', 'DESC')->get();
		$class_list = $get_class->result();
		return $class_list;
	}


    public function create_class_name()
    {
        $this->load->helper('url');
        //Capture User id
        $user_id = $this->session->userdata('active_user')->id; 
        //If it's an update request(id)       
        if ($this->input->post('class_id'))
        {    
        $data_class = array(
            'level_id' => $this->input->post('level_name'),
            'arm_id' => $this->input->post('arm_name')
        );         
        //$query_check_rank = $this->db->select('*')->from('level_list')->where('level_rank', $this->input->post('level_rank'))->get();
        //$num_rows = $query_check_rank->num_rows();
        //if ($num_rows=='0' OR  ){
        $this->db->where('id', $this->input->post('class_id'));
        $this->db->update('class_list', $data_class); 
       // }
   	       	
        }//End of Update
        //If it's a new request
        else {
        $data = array(
            'level_id' => $this->input->post('level_name'),
            'arm_id' => $this->input->post('arm_name'),
            'added_by' => $user_id
        );
        $insert = $this->db->insert('class_list', $data);
        return $insert;
        }//End of New Request
    }


	function get_class_by_id(){
		$id = $this->input->post('id');
        $get_class = $this->db->select('c.*,u.username,a.arm_name,l.level_name')->from('class_list c')->join('users as u', 'c.added_by=u.id', 'left')->join('level_list as l', 'c.level_id=l.id', 'left')->join('arm_list as a', 'c.arm_id=a.id', 'left')->where('c.id', $id)->get();
		$class_list = $get_class->row();
		return $class_list;
	}

		
}

?>