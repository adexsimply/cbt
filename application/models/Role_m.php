<?php

class Role_m extends CI_Model {   
    /**
     * Get List of Groups
     *
     * @access 	public
     * @param 	
     * @return 	json(array)
     */

    public function all()
    {
    	$roles = $this->db->get('roles')->result();
		return $roles;
    }

    /**
     * Get Group by ID
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function get_role($id)
    {
        $query = $this->db->from('roles g')
                        ->select('g.*')
                        ->where('g.id', $id)
                        ->get();

        return $query->row();
    }

    /**
     * Datagrid Data
     *
     * @access  public
     * @param   
     * @return  json(array)
     */

    public function getJson($input)
    {
      $this->db->select('*'); // <-- There is never any reason to write this line!
      $this->db->from('roles');
       $query = $this->db->get(); ; 
       $row = $query->result();
       return $row;
    }

}