<?php 

class User_model extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function set($data) {
        $query = $this->db->insert('user', array(
            "nama" => $data['nama'],
            'username' => $data['username'],
            'password' => md5($data['password']),
            "sub_unit" => $data['sub_unit']
        ));
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

    public function search($data) {
        $query = $this->db->get_where('user', array(
            'username' => $data['username'],
            'password' => $data['password']
        ));
        
        if (count($query->result_array())>0) {
            $response['status'] = 200;
            $response['message'] = 'Success';
        }
        else {
            $response['status'] = 400;
            $response['message'] = 'Login Failed';
        }
        return $response;
    }

    public function get($user) {
        $query = $this->db->get_where('user', array(
            'username' => $user
        ));        
        return $query->result_array();
    }
    
}


?>