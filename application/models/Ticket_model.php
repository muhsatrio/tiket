<?php 

class Ticket_model extends CI_Model
{
    public function __construct() {
		$this->load->database();
    }
    
    public function get($id = NULL) {
        if ($id==NULL) {
            $newArray = [];
            $queryTicketNew = $this->db->get('ticket_new')->result_array();
            foreach ($queryTicketNew as $ticket) {
                $temp = $this->db->get_where('ticket', array(
                    'no_ticket' => $ticket['no_ticket']
                ))->result_array();
                $data = $temp[0];
                $arrTemp = array(
                    'no_internet' => $data['no_internet'],
                    'service' => $data['service'],
                );
                array_push($newArray, array_merge($ticket, $arrTemp));
            }
            $query = $newArray;
        }
        else {
            $query = $this->db->get_where('ticket', array('no_ticket' => $id))->result_array();
        }
        return $query;
    }

    public function get_ticket_new($no_ticket) {
        $query = $this->db->get_where('ticket_new', array('no_ticket' => $no_ticket))->result_array();
        return $query;
    }

    public function insert_new($data) {
        $query = $this->db->insert('ticket_new', $data);
        if ($query) {
            $response['status'] = 200;
            $response['message'] = 'Success';
        }
        else {
            $response['status'] = 400;
            $response['message'] = $this->db->error();
        }
        return $response;
    }

    public function delete($no_ticket) {
        $this->db->delete('ticket_new', array(
            'no_ticket' => $no_ticket
        ));
    }
    
}


?>