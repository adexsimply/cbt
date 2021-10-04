<?php

class Subscription_m extends CI_Model {   

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


    public function get_active_sub_by_class($class_id) {
      // $get_sub = $this->db->select('s.*,st.*')->from('subscriptions s')->join('students as st', 'st.user_id=s.user_id','left')->where('end_date >=',date('Y-m-d H:m:sa'))->get();
       $get_sub = $this->db->query("
     SELECT * FROM subscriptions 
     WHERE user_id IN ( SELECT user_id FROM students WHERE class='$class_id') ORDER BY end_date DESC
     ")->result_array();
      $active_sub = $get_sub;

        return $active_sub;

    }
 

    public function get_active_sub_by_class2($class_id) {
      // $get_sub = $this->db->select('s.*,st.*')->from('subscriptions s')->join('students as st', 'st.user_id=s.user_id','left')->where('end_date >=',date('Y-m-d H:m:sa'))->get();
       $get_sub = $this->db->query("
     SELECT * FROM students 
     WHERE user_id NOT IN ( SELECT user_id FROM subscriptions) AND class='$class_id' ORDER BY fullname DESC
     ")->result_array();
      $active_sub = $get_sub;

        return $active_sub;

    }
    public function get_students_list_subs() {
      $get_students = $this->db->select('s.*,u.*,sub.start_date,sub.end_date, u.id as s_id')->from('students s')->join('users as u', 's.user_id=u.id','left')->join('subscriptions as sub', 's.user_id=sub.user_id','left')->order_by('s.id', 'DESC')->get();
      $students = $get_students->result();

        return $students;

    }

 
}