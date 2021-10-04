<?php

class Pin_m extends CI_Model {   

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

 
 public function get_pin_for_student($student_id) {
  $get_pin = $this->db->select('pin')->from('student_pins')->where('user_id',$student_id)->get();
  $pin = $get_pin->row();
  return $pin;
 }

 public function get_pin_for_student_logs() {
  $get_pin = $this->db->select('sp.*,s.*')->from('student_pins sp')->join('students as s', 's.user_id=sp.user_id','left')->order_by('date_used', 'DESC')->get();
  $pin = $get_pin->result();
  return $pin;
 }

public function get_pin_auth_status() {

  $get_pin_auth_status = $this->db->select('status')->from('settings')->where('settings_name','pin_auth_status')->get();
  $pin_auth_status = $get_pin_auth_status->row();
  return $pin_auth_status;

}



    public function exempt_class() {
      $class = $this->input->post('id');
      $get_students = $this->db->select('s.*,u.*,c.class_name, u.id as s_id')->from('students s')->join('users as u', 's.user_id=u.id','left')->join('class as c', 's.class=c.id','left')->where('s.class', $class)->get();
      $students = $get_students->result();
      foreach ($students as $student){

        $data = array(
            'status' => 0
        );
        $this->db->where('id', $student->user_id);
        $this->db->update('users', $data);

      }
      return "success";

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