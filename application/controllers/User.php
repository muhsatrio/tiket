<?php 

class User extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }
    public function index() {
        $this->session;
		if ($this->session->has_userdata('user')) {
			redirect(base_url('index.php/tiket'));
        }
        else {
            $this->load->view('login');
        }
    }

    public function registrasi() {
        $this->session;
		if ($this->session->has_userdata('user')) {
			redirect(base_url('index.php/tiket'));
        }
        else {
            $this->load->view('registrasi');
        }
    }

    public function logout() {
        $this->session;
        $this->session->unset_userdata('user');
        // $this->session->unset_userdata('nama');
		redirect('login');
    }

    public function proccess_login() {
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

    function checkSimilarityPassword($data) {
        if ($data['password']==$data['password_confirm']) {
            return true;
        }
        else {
            return false;
        }
    }

    public function proccess_register() {
        $data = array(
            "nama" => $this->input->post('nama'),
            "username" => $this->input->post('username'),
            "sub_unit" => $this->input->post('sub_unit'),
            "password" => $this->input->post('password'),
            "password_confirm" => $this->input->post('password_confirm'),
        );

        $this->form_validation->set_message('required', '{field} wajib diisi.');
        $this->form_validation->set_message('matches', 'Password harus sama dengan Konfirmasi Password.');
        $this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
        $this->form_validation->set_message('is_unique', '{field} tersebut sudah terdaftar.');

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('sub_unit', 'Sub Unit', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run()) {
            $response = $this->user_model->set($data);
        }
        else {
            $response = array(
                "status" => 400,
                "message" => $this->form_validation->error_array());
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
    public function test() {
        echo $this->session->userdata('user');
    }
}


?>