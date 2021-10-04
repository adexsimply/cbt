<?php

class Notice_m extends CI_Model {   

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
      $get_all = $this->db->select('n.*,,c.class_name')->from('notices n')->join('class as c', 'n.class_id=c.id','left')->order_by('n.id','DESC')->get();
      $all = $get_all->result();
      return $all;
    } 

    public function all_students()
    {

      $user_id = $this->session->userdata('active_user')->id;
      //Get Class
      $get_class_id = $this->db->select('class')->from('students')->where('user_id',$user_id)->get();
      $class_id_r = $get_class_id->row();
      $class_id = $class_id_r->class;

      $get_all = $this->db->select('n.*,,c.class_name')->from('notices n')->join('class as c', 'n.class_id=c.id','left')->order_by('n.id','DESC')->where('n.class_id',$class_id)->or_where('n.class_id','0')->get();
      $all = $get_all->result();
      return $all;
    } 

    public function get_comments_for_admin () {
      $get_comments = $this->db->select('*')->from('comments')->get();
      $comments = $get_comments->result();
      return $comments;
    }

    public function get_comments_for_admin2 () {
      $get_comments = $this->db->select('c.*,u.username,s.fullname')->from('comments c')->join('users as u', 'c.user_id=u.id','left')->join('students as s', 's.user_id=u.id','left')->order_by('id','DESC')->get();
      $comments = $get_comments->result();
      return $comments;
    }


}