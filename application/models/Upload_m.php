<?php
/**
 * Description of Import Model
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_m extends CI_Model {

    private $_batchImport;

    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData() {
        $data = $this->_batchImport;
        $this->db->insert_batch('assessment_questions', $data);
    }
    // get employee list
    public function employeeList() {
        $this->db->select(array('e.id', 'e.question', 'e.option1', 'e.option2','e.option3', 'e.option4', 'e.answer'));
        $this->db->from('assessment_questions as e');
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>