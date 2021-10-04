<?php

class Fee_m extends CI_Model {   

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

 
 public function get_fee_list() {
  $get_fees = $this->db->select('f.*,c.class_name')->from('fees f')->join('class as c','c.id=f.class_id','left')->get();
  $fees = $get_fees->result();
  return $fees;
 }
 public function get_fee_list_for_class($class_id) {
  $get_fees = $this->db->select('f.*,c.class_name')->from('fees f')->join('class as c','c.id=f.class_id','left')->where('f.class_id',$class_id)->get();
  $fees = $get_fees->result();
  return $fees;
 }


 public function get_subscription_for_student($student_id) {
  $get_pin = $this->db->select('*')->from('subscriptions')->where('user_id',$student_id)->order_by('id','DESC')->limit(1)->get();
  $pin = $get_pin->row();
  return $pin;
 }
   //////////Add New User

    public function add_fee_name()
    {
        $data = array(
            'class_id' => $this->input->post('class'),
            'amount' => $this->input->post('amount'),
            'duration' => $this->input->post('duration')
        );
        $insert = $this->db->insert('fees', $data);
        return $insert;


    }

}