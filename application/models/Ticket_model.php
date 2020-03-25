<?php 

class Ticket_model extends CI_Model
{
    public function __construct() {
		$this->load->database();
    }
    
    public function get($id = NULL) {
        if ($id==NULL) {
            $query = $this->db->get('ticket');
        }
        else {
            $query = $this->db->get_where('ticket', array('no_ticket' => $id));
        }
        return $query->result_array();
    }
    
}


?>