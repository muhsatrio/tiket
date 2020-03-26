<?php 

class Ticket_model extends CI_Model
{
    public function __construct() {
		$this->load->database();
    }
    
    public function get($id = NULL) {
        if ($id==NULL) {
            $this->db->where("created_at IS NOT NULL");
            $query = $this->db->get('ticket');
        }
        else {
            $query = $this->db->get_where('ticket', array('no_ticket' => $id));
        }
        return $query->result_array();
    }

    public function update($id, $data) {
        $query = $this->db->update('ticket', $data, array('no_ticket' => $id));
        if ($query) {
            $response['status'] = 200;
            $response['message'] = 'Success';
        }
        else {
            $response['status'] = 400;
            $response['message'] = 'Bad Request';
        }
        return $response;
    }
    
}


?>