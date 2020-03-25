<?php 

class Tiket extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ticket_model');
        $this->load->library('session');
    }
    public function index() {
        $this->session;
		if (!$this->session->has_userdata('user')) {
			echo "
			<script>
			alert('Anda belum login, silahkan login terlebih dahulu!');
			window.location.href = 'index.php/login';
			</script>
			";
        }
        else {
            $this->load->view('tiket');
        }
    }
    public function get_tiket() {
        try {
            $no_tiket = $this->input->get('no_tiket');
            $data = $this->ticket_model->get($no_tiket);
            $response['status'] = 200;
            $response['message'] = "Success";
            $response['data'] = $data;
            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (\Throwable $th) {
            $response['status'] = 500;
            $response['message'] = $th;
        }
    }
}


?>