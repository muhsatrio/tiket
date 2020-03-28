<?php 

class Tiket extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ticket_model');
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->library('form_validation');
    }
    public function index() {
        $this->session;
		if (!$this->session->has_userdata('user')) {
			redirect('login');
        }
        else {
            redirect('tiket');
        }
    }
    public function tiket() {
        $this->session;
        // echo $this->session->userdata('user');
		if (!$this->session->has_userdata('user')) {
			echo "
			<script>
			alert('Anda belum login, silahkan login terlebih dahulu!');
			window.location.href = 'login';
			</script>
			";
        }
        else {
            $this->load->view('tiket');
        }
    }
    public function get_tiket() {
        $this->session;
        if (!$this->input->get('no_tiket')) {
            $data = $this->ticket_model->get();
            $response['status'] = 200;
            $response['message'] = "Success";
            $response['data'] = $data;
        }
        else {
            $no_tiket = $this->input->get('no_tiket');
            $data = $this->ticket_model->get($no_tiket);
            if (count($data)>0) {
                $dataTicketNew = $this->ticket_model->get_ticket_new($no_tiket);
                if (count($dataTicketNew)>0) {
                    $response['status'] = 400;
                    $response['message'] = "Tiket tersebut sudah diinput sebelumnya.";
                }
                else {
                    $userLogged = $this->session->userdata('user');
                    $query = $this->user_model->get($userLogged);
                    $data[0]['agent'] = $query[0]['nama'];
                    $response['status'] = 200;
                    $response['message'] = "Success";
                    $response['data'] = $data;
                }
            }
            else {
                $response['status'] = 400;
                $response['message'] = "Tiket tidak ditemukan, silahkan input kembali.";
                // $response['data'] = [];
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function proccess_tiket() {
        $this->session;
        date_default_timezone_set('Asia/Makassar');
        $date = date('Y-m-d H:i:s');
        $id = (int)$this->input->post('no_tiket');
        $data = array(
            'jenis_ont' => $this->input->post('jenis_ont'),
            'type_ont' => $this->input->post('type_ont'),
            'actual_solution' => $this->input->post('actual_solution'),
            'keterangan' => $this->input->post('keterangan'),
            'status' => $this->input->post('status'),
            'loker_awal' => $this->input->post('loker_awal'),
            'resolved' => $this->input->post('resolved'),
            'agent' => $this->input->post('agent'),
            'created_at' => $date,
            'created_by' => $this->session->userdata('user'),
            'no_ticket' => $id
        );
        $this->form_validation->set_message('required', '{field} wajib diisi.');
        $this->form_validation->set_message('is_unique', '{field} tersebut sudah disii.');
        $this->form_validation->set_rules('no_ticket', 'No Tiket', 'is_unique[ticket_new.no_ticket]');
        $this->form_validation->set_rules('jenis_ont', 'Jenis Ont', 'required');
        $this->form_validation->set_rules('type_ont', 'Type Ont', 'required');
        $this->form_validation->set_rules('actual_solution', 'Actual Solution Unit', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run()) {
            $response = $this->ticket_model->insert_new($data);
        }
        else {
            $response = array(
                "status" => 400,
                "message" => $this->form_validation->error_array());
        }
        header('Content-Type: application/json');
        echo json_encode($response);

    }
    public function profile() {
        $this->session;
		if (!$this->session->has_userdata('user')) {
			echo "
			<script>
			alert('Anda belum login, silahkan login terlebih dahulu!');
			window.location.href = 'login';
			</script>
			";
        }
        else {
            $this->load->view('myprofile');
        }
    }
    public function delete() {
        $no_ticket = $this->input->get('no_ticket');
        $response = $this->ticket_model->delete($no_ticket);
        redirect('profile');
    }
    public function test() {
        $data = $this->ticket_model->get();
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}


?>