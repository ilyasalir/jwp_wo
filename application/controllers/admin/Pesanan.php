<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('username'))){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Upss </strong>Anda
            tidak memiliki akses, silahkan login!</div>');
            redirect('login');
        }
        $this->load->model('pesanan_model');
        $this->load->model('katalog_model');
    }


	public function index()
	{

        $data = array (
            'title' => 'JWP Wediing Organizer',
            'page' => 'admin/pesanan',
            'getAllPesanan' => $this->pesanan_model->get_all_pesanan()->result()
        );

		$this->load->view('admin/template/main',$data);
	}

    public function sendApprovalEmail($id)
    {
        $this->load->library('email');

        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com', 
            'smtp_port' => 465,                   
            'smtp_user' => 'ilyas14022@gmail.com', 
            'smtp_pass' => 'rosj qjez fpqg vrkf',  
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'wordwrap'  => TRUE
        );
        $this->email->initialize($config);
        $cek_data = $this->pesanan_model->get_pesanan_by_id($id)->row();
        if ($cek_data > 0) {
            $email = $cek_data->email;
            $name = $cek_data->name;
            $katalog_id = $cek_data->catalogue_id;
        }
        $katalog = $this->katalog_model->get_katalog_by_id($katalog_id)->row();
        if($katalog > 0){
            $package = $katalog->package_name;
            $desc = $katalog->description;
            $price = $katalog->price;
        }

        $this->email->set_newline("\r\n");
        $this->email->from('ilyas14022@gmail.com', 'JWP Wedding Organizer');
        $this->email->to($email);
        $this->email->subject('Pesanan Diterima');
        $message = 'Kepada ' . $name . ',<br><br>';
        $message .= 'Pesanan anda telah diterima. Terimakasih!<br><br>';
        $message .= '<pre>' . $package . '<br>';
        $message .= '' . $desc . '<br>';
        $message .= 'Harga: Rp. ' . number_format($price, 0, ',', '.') . '</pre>';
        $this->email->message($message);

        
        if ($this->email->send()) {
            
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function updateStatus()
    {
        if ($this->input->get()) { 

            $get = $this->input->get();

            $cek_data = $this->pesanan_model->get_pesanan_by_id($get['id'])->num_rows();
            
            if ($cek_data > 0) {

                $datetime = date("Y-m-d H:i:s");
                $data = array(
                    'status' => $get['status'],
                    'user_id' => $this->session->userdata('user_id'), 
                    'updated_at' => $datetime,
                );
                
                $update = $this->pesanan_model->update($get['id'], $data);

                if ($update) {
                    if ($get['status'] === 'approved') {
                            $this->sendApprovalEmail($get['id']);
                    }

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"
                    role="alert"><strong>Success </strong>Status Berhasil di Ubah!
                <i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Pesanan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show"
                    role="alert"><strong>Success </strong>Status Gagal di Ubah!
                <i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Pesanan');
                }
            }
        } else {
            redirect('admin/Pesanan');
        }
    }

    public function delete()
    {
        if (!empty($this->input->get('id', true))) {

            $delete = $this->pesanan_model->delete_by_id($this->input->get('id', true));
            
            if ($delete) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" 
                role="alert"><strong>Success </strong>Data Berhasil di Hapus!
            <i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Pesanan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" 
                role="alert"><strong>Uppss </strong>Data Gagal di Hapus!
            <i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Pesanan');
            }
        } else {
            redirect('admin/Pesanan');
            
        }
    }
}
