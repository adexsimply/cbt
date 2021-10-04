<?php

class User_m extends CI_Model {   

    function __construct()
    {
        parent::__construct();
       // $this->load->library('datagrid');
    }

    /**
     * Datagrid Data
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function all()
    {
      $users = $this->db->get('users')->result();
    return $users;
    } 

    public function get_roles()
    {
      $roles = $this->db->get('roles')->result();
    return $roles;
    } 

    public function get_users()
    {
      $query_users = $this->db->select('u.*,r.*,s.*,t.*,u.id as user_id')->from('users u')->join('roles as r', 'u.role_id = r.id', 'left')->join('students as s', 'u.id = s.user_id', 'left')->join('teachers as t', 'u.id = t.user_id', 'left')->where('u.role_id !=',3)->order_by('u.id','DESC')->get();
      $users = $query_users->result();
    return $users;
    }   

    public function get_login_sessions()
    {
      $query_users = $this->db->select('l.*,s.*,t.*,c.class_name,u.*,l.id as user_id')->from('login_session l')->join('students as s', 's.user_id = l.user_id', 'left')->join('teachers as t', 'l.user_id = t.user_id', 'left')->join('class as c', 'c.id = s.class', 'left')->join('users as u', 'u.id = l.user_id', 'left')->order_by('l.last_login','DESC')->get();
      $users = $query_users->result();
    return $users;
    } 

    public function exam_logs($assessment_id=false)
    {
      if ($assessment_id==false) {
        $where = '1=1';
      }
      else {
        $where = 'assessment_id ='.$assessment_id;
      }
      $query_logs = $this->db->select('ex.*,s.*,c.class_name,a.exam_type,q.title,sub.subject_name, ex.id as log_id')->from('exam_logs ex')->join('students as s', 's.user_id = ex.student_id', 'left')->join('class as c', 'c.id = s.class', 'left')->join('assessments as a', 'a.id = ex.assessment_id', 'left')->join('questions as q', 'q.id = a.question_id', 'left')->join('subjects as sub', 'sub.id = q.subject_id', 'left')->where($where)->order_by('ex.id','DESC')->get();
      $logs = $query_logs->result();
    return $logs;
    } 


    public function active_exams($assessment_id=false)
    {
      if ($assessment_id==false) {
        $where = '1=1';
      }
      else {
        $where = 'assessment_id ='.$assessment_id;
      }
      $query_logs = $this->db->select('ex.*,s.*,c.class_name,a.exam_type,q.title,sub.subject_name, ex.id as log_id')->from('exam_logs ex')->join('students as s', 's.user_id = ex.student_id', 'left')->join('class as c', 'c.id = s.class', 'left')->join('assessments as a', 'a.id = ex.assessment_id', 'left')->join('questions as q', 'q.id = a.question_id', 'left')->join('subjects as sub', 'sub.id = q.subject_id', 'left')->where($where)->where('time_submitted',NULL)->order_by('ex.id','DESC')->get();
      $logs = $query_logs->result();
    return $logs;
    } 


    public function get_login_sessions_class($class_id)
    {
      $query_users = $this->db->select('l.*,s.*,t.*,c.class_name,u.*,l.id as user_id')->from('login_session l')->join('students as s', 's.user_id = l.user_id', 'left')->join('teachers as t', 'l.user_id = t.user_id', 'left')->join('class as c', 'c.id = s.class', 'left')->join('users as u', 'u.id = l.user_id', 'left')->where('s.class',$class_id)->order_by('l.last_login','DESC')->get();
      $users = $query_users->result();
    return $users;
    } 

    public function attempt($input)
    {
      $query_role = $this->db->select('role_id')->from('users')->where('username',$input['username'])->get();
      if ($query_role->num_rows() < 1) {
        return null;
      }
      else {
      $user_role = $query_role->row();
      $role_id = $user_role->role_id;
      if($role_id !=3) {

        return "Invalid Login";

      } else {
      $query = $this->db->from('users u')
              ->select('u.*, g.role_name,ls.last_login,s.class,s.fullname,c.class_name,a.name')
              ->where('username', $input['username'])
              ->where('password', $input['password'])
              ->join('roles as g', 'g.id = u.id', 'left')
              ->join('login_session as ls', 'ls.user_id = u.id', 'left')
              ->join('students as s', 's.user_id = u.id', 'left')
              ->join('class as c', 'c.id = s.class', 'left')
              ->join('aagc as aagc', 'aagc.id = s.aagc_id', 'left')
              ->join('aliases as a', 'a.id = aagc.alias_id', 'left')
              ->get();

      return $query->row();

      }

      }
    } 

    public function attempt_admin($input)
    {
      $query_role = $this->db->select('role_id')->from('users')->where('username',$input['username'])->get();
      if ($query_role->num_rows() < 1) {
        return null;
      }
      else {
      $user_role = $query_role->row();
      $role_id = $user_role->role_id;
      if($role_id ==3) {

        return "Invalid Login";

      } else {
      $query = $this->db->from('users u')
              ->select('u.*, g.role_name,ls.last_login,s.class')
              ->where('username', $input['username'])
              ->where('password', $input['password'])
              ->join('roles as g', 'g.id = u.id', 'left')
              ->join('login_session as ls', 'ls.user_id = u.id', 'left')
              ->join('students as s', 's.user_id = u.id', 'left')
              ->get();

      return $query->row();

      }

      }
    }
    public function attempt2($input)
    {
      $query = $this->db->from('users u')
              ->select('u.*, g.role_name,ls.last_login,s.class')
              ->where('u.id', $input)
              ->join('roles as g', 'g.id = u.id', 'left')
              ->join('login_session as ls', 'ls.user_id = u.id', 'left')
              ->join('students as s', 's.user_id = u.id', 'left')
              ->get();

      return $query->row();
    }

    public function login_session() {

      $user_id = $this->session->userdata('active_user')->id;
      $get_session = $this->db->select('*')->from('login_session')->where('user_id', $user_id)->get();
      if ($get_session->num_rows() > 0) {
        $data = array(
            'last_login' => date('Y-m-d H:i:s')
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('login_session', $data); 

      }
      else { 
        $data = array(
            'user_id' => $user_id,
            'last_login' => date('Y-m-d H:i:s')
        );
        $insert = $this->db->insert('login_session', $data);
        return $insert;

      }
    }

    //////////Add New User

    public function add_user()
    {
        $this->load->helper('url'); 

      if ($this->input->post('user_id')) {
        $data = array(
            'username' => $this->input->post('username'),
            'role_id' => $this->input->post('role_id'),
            'category_id' => $this->input->post('category_id'),
            'password' => $this->input->post('password'),
        );
        $this->db->where('id', $this->input->post('user_id'));
        $this->db->update('users', $data); 

      }
      else {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password1'),
            'role_id' => $this->input->post('role')
        );
        $insert = $this->db->insert('users', $data);
        return $insert;
      }
    }

    //////////////////////////
    public function getJson()
    {
        ////////////Get Group id
        // $user_id = $this->session->userdata('active_user')->id;
        // $query1 = $this->db->select('*')->from('users')->where('id',$user_id)->get();
        // $row1 = $query1->row();
        // $group_id = $row1->group_id;
       //  //////////////////////////////////
       //  $table  = 'datalicious as a';
       //  $select = 'a.*';
       // // $where = '(user, 1)';

       //  $replace_field  = [
       //      ['old_name' => 'CompanyAgent', 'new_name' => 'a.CompanyAgent']
       //  ];

       //  $param = [
       //      'input'     => $input,
       //      'select'    => $select,
       //      'table'     => $table,
       //      'replace_field' => $replace_field
       //  ];
      $this->db->select('*'); // <-- There is never any reason to write this line!
      $this->db->from('roles');
      $this->db->join('users', 'users.role_id = roles.id');
       $query = $this->db->get(); ; 
       $row = $query->result();
       return $row;

    }

    public function edit_profile()
    {
        $this->load->helper('url');
        $user_id = $this->session->userdata('active_user')->id;
        $data = array(
            'full_name' => $this->input->post('first_name')." ".$this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'about_me' => $this->input->post('about_me')
        );
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        redirect('profile');
    }

    function get_user_by_id(){
        $id = $this->input->post('id');
        $get_user = $this->db->select('u.*,r.*,u.id as user_id')->from('users u')->join('roles as r', 'u.role_id = r.id', 'left')->where('u.id',$id)->get();
        $user_list = $get_user->row();
        return $user_list;
    }


    function get_logged_in_student_details(){
        $user_id = $this->session->userdata('active_user')->id; 
        $get_user = $this->db->select('s.*,c.class_name, c.id as class_id')->from('students s')->join('class as c', 's.class = c.id', 'left')->where('user_id',$user_id)->get();
        $user_list = $get_user->row();
        return $user_list;
    }
    function get_logged_in_teacher_details(){
        $user_id = $this->session->userdata('active_user')->id; 
        $get_user = $this->db->select('*')->from('teachers')->where('user_id',$user_id)->get();
        $user_list = $get_user->row();
        return $user_list;
    }

    public function get_teachers_list() {
      $get_teachers = $this->db->select('t.*,u.*, u.id as t_id')->from('teachers t')->join('users as u', 't.user_id=u.id','left')->get();
      $teachers = $get_teachers->result();

        return $teachers;

    }

    //////////Add New User

    public function add_teacher()
    {
        $this->load->helper('url'); 
        $username = strtolower(substr($this->input->post('first_name'), 0,1).$this->input->post('last_name'));

      if ($this->input->post('teacher_id')) {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
        );
        $this->db->where('user_id', $this->input->post('teacher_id'));
        $this->db->update('teachers', $data); 

      }
      else {
        $data = array(
            'username' => $username,
            'role_id' => 2,
            'password' => "Password1",
        );
        $insert = $this->db->insert('users', $data);
        $teacher_id = $this->db->insert_id();
        //return $insert;
        ///Insert into teachers table
        $data1 = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'user_id' => $teacher_id
        );
        $insert1 = $this->db->insert('teachers', $data1);
        ////Insert into subject_teacher 

        $data2 = array(
            'subject_id' => $this->input->post('subject'),
            'teacher_id' => $teacher_id
        );
        $insert2 = $this->db->insert('teacher_subjects', $data2);
        return $insert2;

      }
    }

  public function get_teachers_subjects($teacher_id) {
      $get_teachers = $this->db->select('ts.*,s.*')->from('teacher_subjects ts')->join('subjects as s', 'ts.subject_id=s.id','left')->where('ts.teacher_id',$teacher_id)->get();
      $teachers = $get_teachers->result();

        return $teachers;

    }



  public function get_teacher_subjects() {
    $teacher_id = $this->input->post('id');
      $get_subjects = $this->db->select('ts.*,s.*, ts.id as ts_id')->from('teacher_subjects ts')->join('subjects as s', 'ts.subject_id=s.id','left')->where('ts.teacher_id',$teacher_id)->get();
      $subjects = $get_subjects->result();

        return $subjects;

    }



    public function get_students_list() {
      $get_students = $this->db->select('s.*,u.*,c.class_name,class_group_id, u.id as s_id')->from('students s')->join('users as u', 's.user_id=u.id','left')->join('class as c', 's.class=c.id','left')->get();
      $students = $get_students->result();

        return $students;

    }

    public function get_students_list23() {
      $get_students = $this->db->select('s.*,u.*,sc.class_arm_id,c.class_name,class_group_id,ca.alias, u.id as s_id')->from('students s')->join('users as u', 's.user_id=u.id','left')->join('student_class as sc', 's.user_id=sc.student_id','left')->join('class as c', 's.class=c.id','left')->join('class_arm as ca', 'sc.class_arm_id=ca.id', 'left')->get();
      $students = $get_students->result();

        return $students;

    }

    public function get_students_list_other23() {
      $get_students = $this->db->select('s.*,u.*,sc.class_arm_id,sc.system_aagc_id,c.class_name,class_group_id,aagc.*,a.name as alias_name, u.id as s_id')->from('students s')->join('users as u', 's.user_id=u.id','left')->join('student_class as sc', 's.user_id=sc.student_id','left')->join('class as c', 's.class=c.id','left')->join('aagc as aagc', 'aagc.id=s.aagc_id', 'left')->join('aliases as a', 'aagc.alias_id=a.id', 'left')->get();
      $students = $get_students->result();

        return $students;

    }

    public function get_students_list_other() {
      $get_students = $this->db->select('s.*,u.*,c.class_name,class_group_id, u.id as s_id')->from('students s')->join('users as u', 's.user_id=u.id','left')->join('class as c', 's.class=c.id','left')->where('s.class IN (SELECT id FROM class WHERE class_group_id=2)')->get();
      $students = $get_students->result();

        return $students;

    }


    public function get_students_list_sec() {
      $get_students = $this->db->select('s.*,u.*,c.class_name, u.id as s_id')->from('students s')->join('users as u', 's.user_id=u.id','left')->join('class as c', 's.class=c.id','left')->where('class >=', '25')->where('class <=', '30')->get();
      $students = $get_students->result();

        return $students;

    }

    public function get_class_arm_list() {
        $get_class_arm = $this->db->select('ca.*,a.arm_name,c.class_list_name')->from('class_arm ca')->join('class_list as c', 'c.id=ca.class_id', 'left')->join('arm_list as a', 'ca.arm_id=a.id', 'left')->order_by('id', 'DESC')->get();
        $class_arm_list = $get_class_arm->result();
        return $class_arm_list;
    }




    public function get_students_list_pri() {
      $get_students = $this->db->select('s.*,u.*,c.class_name, u.id as s_id')->from('students s')->join('users as u', 's.user_id=u.id','left')->join('class as c', 's.class=c.id','left')->where('class >=', '15')->where('class <=', '21')->get();
      $students = $get_students->result();

        return $students;

    }


    //////////Add New User

    public function add_student()
    {
        $this->load->helper('url'); 
        //$username = strtolower(substr($this->input->post('first_name'), 0,1).$this->input->post('last_name'));

      if ($this->input->post('student_id')) {
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'phone' => $this->input->post('phone'),
            'csmt_id' => $this->input->post('csmt_id'),
            'class' => $this->input->post('class1'),
        );
        $this->db->where('user_id', $this->input->post('student_id'));
        $this->db->update('students', $data); 
        ///////
        $data1 = array(
            'username' => $this->input->post('csmt_id')
        );
        ///
        $this->db->where('id', $this->input->post('student_id'));
        $this->db->update('users', $data1); 

      }
      else {
        $data = array(
            'username' => $this->input->post('csmt_id'),
            'role_id' => 3,
            'password' => rand(1000,10000),
        );
        $insert = $this->db->insert('users', $data);
        $student_id = $this->db->insert_id();
        //
        // $get_aagc_id = $this->db->select('*')->from('aagc')->where('group_class_id',$this->input->post('class1'))->where('arm_id',$this->input->post('arm'))->where('alias_id',$this->input->post('alias'))->get();
        // if ($get_aagc_id->num_rows() < 1) {
        //   //Create a new aagc_id

        // }
        $data1 = array(
            'fullname' => $this->input->post('fullname'),
            'phone' => $this->input->post('phone'),
            'csmt_id' => $this->input->post('csmt_id'),
            'class' => $this->input->post('class1'),
            'user_id' => $student_id
        );
        $insert1 = $this->db->insert('students', $data1);

        return $insert1;

      }
    }



    function get_student_by_id(){
        $id = $this->input->post('id');
        $get_student = $this->db->select('s.*,c.class_name')->from('students s')->join('class as c','c.id=s.class')->where('s.user_id', $id)->get();
        $student_list = $get_student->row();
        return $student_list;
    }


    function get_student_by_id2($id){
        $get_student = $this->db->select('fullname')->from('students')->where('user_id', $id)->get();
        $student_list = $get_student->row();
        return $student_list;
    }


    function get_student_fullname($student_id){
        $get_student = $this->db->select('fullname')->from('students')->where('user_id', $student_id)->get();
        $student_list = $get_student->row();
        return $student_list;
    }

    function get_student_class_by_id(){
        $id = $this->input->post('id');
        $get_student = $this->db->select('*')->from('student_class')->where('student_id', $id)->get();
        $student_class = $get_student->row();
        return $student_class;
    }

    function get_students_by_class_arm($class_arm_id){
        $get_students = $this->db->select('sc.*, s.fullname,s.csmt_id,s.class')->from('student_class sc')->join('students as s','s.user_id=sc.student_id')->where('sc.class_arm_id', $class_arm_id)->get();
        $students = $get_students->result();
        return $students;
    }


    function get_student_class($student_id){
        $id = $this->input->post('id');
        $get_student = $this->db->select('sc.*,ca.*,c.class_list_name,a.arm_name')->from('student_class sc')->join('class_arm as ca', 'sc.class_arm_id=ca.id', 'left')->join('arm_list as a', 'ca.arm_id=a.id', 'left')->join('class_list as c', 'ca.class_id=c.id', 'left')->where('student_id', $student_id)->get();
        $student_class = $get_student->row();
        return $student_class;
    }



    function get_teacher_by_id(){
        $id = $this->input->post('id');
        $get_teacher = $this->db->select('*')->from('teachers')->where('user_id', $id)->get();
        $teacher = $get_teacher->row();
        return $teacher;
    }



}