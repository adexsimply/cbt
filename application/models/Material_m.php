<?php

class Material_m extends CI_Model {   

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

   
  public function get_subjects_for_teacher() {

  $user_id = $this->session->userdata('active_user')->id;
  $get_subjects = $this->db->select('ts.*,s.*')->from('teacher_subjects ts')->join('subjects as s', 'ts.subject_id=s.id','left')->where('ts.teacher_id',$user_id)->get();
      $subjects = $get_subjects->result();

        return $subjects;

    }

   
  public function get_subjects_for_admin() {

  $user_id = $this->session->userdata('active_user')->id;
  $get_subjects = $this->db->select('ts.*,s.*')->from('teacher_subjects ts')->join('subjects as s', 'ts.subject_id=s.id','left')->get();
      $subjects = $get_subjects->result();

        return $subjects;

    } 
  public function get_subjects_for_admin1() {

  $user_id = $this->session->userdata('active_user')->id;
  $get_subjects = $this->db->select('*')->from('subjects')->get();
      $subjects = $get_subjects->result();

        return $subjects;

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
            'role_id' => 1
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

    public function get_teachers_list() {
      $get_teachers = $this->db->select('t.*,u.*, u.id as t_id')->from('teachers t')->join('users as u', 't.user_id=u.id','left')->get();
      $teachers = $get_teachers->result();

        return $teachers;

    }

    public function get_materials_for_teacher() {
      $user_id = $this->session->userdata('active_user')->id;
      $get_materials = $this->db->select('m.*,u.username,c.class_name,s.subject_name')->from('materials m')->join('users as u', 'm.teacher_id=u.id','left')->join('class as c', 'm.class_id=c.id','left')->join('subjects as s', 'm.subject_id=s.id','left')->where('teacher_id', $user_id)->order_by('m.id','DESC')->get();
      $materials = $get_materials->result();

        return $materials;

    }


    public function get_materials_for_student() {
      $user_id = $this->session->userdata('active_user')->id;
      $get_class_id = $this->db->select('class')->from('students')->where('user_id',$user_id)->get();
      $class_id = $get_class_id->row()->class;
      $get_materials = $this->db->select('m.*,u.username,c.class_name,s.subject_name')->from('materials m')->join('users as u', 'm.teacher_id=u.id','left')->join('class as c', 'm.class_id=c.id','left')->join('subjects as s', 'm.subject_id=s.id','left')->where('class_id', $class_id)->where('m.attachment_admin is NOT NULL')->order_by('m.id','DESC')->get();
      $materials = $get_materials->result();

        return $materials;

    }


    public function get_materials_for_admin() {
      $get_materials = $this->db->select('m.*,u.username,c.class_name,s.subject_name')->from('materials m')->join('users as u', 'm.teacher_id=u.id','left')->join('class as c', 'm.class_id=c.id','left')->join('subjects as s', 'm.subject_id=s.id','left')->order_by('m.id','DESC')->get();
      $materials = $get_materials->result();

        return $materials;

    }
    public function get_materials_by_class($class_id) {
      $get_materials = $this->db->select('m.*,u.username,c.class_name,s.subject_name')->from('materials m')->join('users as u', 'm.teacher_id=u.id','left')->join('class as c', 'm.class_id=c.id','left')->join('subjects as s', 'm.subject_id=s.id','left')->where('m.class_id', $class_id)->order_by('m.id','DESC')->get();
      $materials = $get_materials->result();

        return $materials;

    }


    public function get_materials_for_admin_new() {
      $get_materials = $this->db->select('m.*,u.username,c.class_name,s.subject_name')->from('materials m')->join('users as u', 'm.teacher_id=u.id','left')->join('class as c', 'm.class_id=c.id','left')->join('subjects as s', 'm.subject_id=s.id','left')->order_by('m.id','DESC')->where('m.attachment_admin is NULL')->get();
      $materials = $get_materials->result();

        return $materials;

    }

    public function get_materials_for_admin_new_class($class_id) {
      $get_materials = $this->db->select('m.*,u.username,c.class_name,s.subject_name')->from('materials m')->join('users as u', 'm.teacher_id=u.id','left')->join('class as c', 'm.class_id=c.id','left')->join('subjects as s', 'm.subject_id=s.id','left')->order_by('m.id','DESC')->where('m.attachment_admin is NULL')->where('m.class_id', $class_id)->get();
      $materials = $get_materials->result();

        return $materials;

    }


    public function get_materials_for_admin_old() {
      $get_materials = $this->db->select('m.*,u.username,c.class_name,s.subject_name')->from('materials m')->join('users as u', 'm.teacher_id=u.id','left')->join('class as c', 'm.class_id=c.id','left')->join('subjects as s', 'm.subject_id=s.id','left')->order_by('m.id','DESC')->where('m.attachment_admin is NOT NULL')->get();
      $materials = $get_materials->result();

        return $materials;

    }

    public function get_materials_for_admin_old_class($class_id) {
      $get_materials = $this->db->select('m.*,u.username,c.class_name,s.subject_name')->from('materials m')->join('users as u', 'm.teacher_id=u.id','left')->join('class as c', 'm.class_id=c.id','left')->join('subjects as s', 'm.subject_id=s.id','left')->order_by('m.id','DESC')->where('m.attachment_admin is NOT NULL')->where('m.class_id', $class_id)->get();
      $materials = $get_materials->result();

        return $materials;

    }


    public function get_material_info($id) {
      $get_material_info = $this->db->select('m.*,u.username,c.class_name,s.subject_name')->from('materials m')->join('users as u', 'm.teacher_id=u.id','left')->join('class as c', 'm.class_id=c.id','left')->join('subjects as s', 'm.subject_id=s.id','left')->where('m.id',$id)->get();
      $material_info = $get_material_info->row();

        return $material_info;

    }



    public function get_material_comment($id) {
      $get_material_comment = $this->db->select('c.*,u.username,u.role_id,s.fullname')->from('comments c')->join('users as u', 'c.user_id=u.id','left')->join('students as s', 's.user_id=u.id','left')->where('c.item_id',$id)->where('c.item_type','Material Comment')->get();
      $material_comment = $get_material_comment->result();

        return $material_comment;

    }

    //////////Add New User

    public function add_teacher()
    {
        $this->load->helper('url'); 
        $username = strtolower(substr($this->input->post('first_name'), 0,1).$this->input->post('last_name'));

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



    public function get_students_list() {
      $get_students = $this->db->select('s.*,u.*, u.id as s_id')->from('students s')->join('users as u', 's.user_id=u.id','left')->get();
      $students = $get_students->result();

        return $students;

    }

    //////////Add New User

    public function add_student()
    {
        $this->load->helper('url'); 
        //$username = strtolower(substr($this->input->post('first_name'), 0,1).$this->input->post('last_name'));

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
            'username' => $this->input->post('csmt_id'),
            'role_id' => 3,
            'password' => "Password1",
        );
        $insert = $this->db->insert('users', $data);
        $student_id = $this->db->insert_id();
        //return $insert;
        ///Insert into teachers table
        $data1 = array(
            'fullname' => $this->input->post('fullname'),
            'phone' => $this->input->post('phone'),
            'csmt_id' => $this->input->post('csmt_id'),
            'class' => $this->input->post('class'),
            'user_id' => $student_id
        );
        $insert1 = $this->db->insert('students', $data1);
        ////Insert into subject_teacher 

        // $data2 = array(
        //     'subject_id' => $this->input->post('subject'),
        //     'teacher_id' => $teacher_id
        // );
        // $insert2 = $this->db->insert('teacher_subjects', $data2);
        return $insert1;

      }
    }

////
    public function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}



}