<?php 

class Login extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function index() {
        $this->session;
		if ($this->session->has_userdata('user')) {
			redirect(base_url());
        }
        else {
            $this->load->view('login');
        }
    }

    public function logout() {
        $this->session;
		$this->session->unset_userdata('user');
		redirect('login');
    }

    public function proccess() {
        $this->session;
        $data['username'] = $this->input->post('username');
        $data['password'] = md5($this->input->post('password'));
        $response = $this->user_model->search($data);
        if ($response['status']==200) {
            $this->session->set_userdata('user',$data['username']);
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function generateAdmin() {
        $data['username'] = $this->input->post('username');
        $data['password'] = md5($this->input->post('password'));
        $response = $this->user_model->set($data);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}


?>