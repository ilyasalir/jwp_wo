<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
        $this->load->database();
        $this->load->model('katalog_model');
        $this->load->model('pesanan_model');
        $this->load->helper('text'); //helper untuk word limiter
    }

	public function index()
	{

        $data = array (
            'title' => 'JWP Wediing Organizer',
            'page' => 'landing/beranda',
            'getDataWeb' => $this->settings_model->getSettings('1')->row(),
            'getAllKatalog' => $this->katalog_model->get_all_katalog_landing()->result()
        );

		$this->load->view('landing/template/sites',$data);
	}

    public function detail()
    {
        if ($this->input->get('id')) {

            $cek_data = $this->katalog_model->get_katalog_by_id($this->input->get('id'))->num_rows();
            
            if ($cek_data > 0) {
                 $data = array(
                    'title' => 'JWP Wedding Organizer',
                    'page' => 'landing/detail',
                    'getDataWeb' => $this->settings_model->getSettings('1')->row(),
                    'katalog' => $this->katalog_model->get_katalog_by_id($this->input->get('id'))->row()
            );
    
            $this->load->view('landing/template/sites', $data);
        } else {
            redirect('/');
        }
        } else {
            redirect('/');
        }
    
    }

    public function pesan()
    {
        if ($this->input->post()) {
            $post = $this->input->post();
            $cek_data = $this->pesanan_model->cek_data_pesanan ($post['id'], $post['email'], $post['wedding_date'])->num_rows();
            
            if ($cek_data == 0){
                $datetime = date("Y-m-d H:i:s");

                $data = array(
                    'catalogue_id' => $post['id'], 
                    'name' => $post['name'],
                    'email' => $post['email'],
                    'phone_number' => $post['phone_number'], 
                    'wedding_date' => $post['wedding_date'], 
                    'status' => 'requested',
                    'created_at' => $datetime,
                );

                $insert = $this->pesanan_model->insert($data);
                   
                if ($insert) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"
                    role="alert"><strong>Success </strong>Terimakasih, permintaan pesanan anda telah kami terima. Silahkan tunggu konfirmasi 
                    kami melalui email. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); 
                    redirect('Beranda/detail?id='.$post['id']);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show"
                    role="alert"><strong>Success </strong>Maaf, Permintaan pesanan Gagal! <button type="button" class="btn-close"
                    data-bs-dismiss-"alert" aria-label-"Close"></button></div>');
                    redirect('Beranda/detail?id=' . $post['id']);
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show"
                role="alert"><strong>Success </strong>Maaf, Paket dan tanggal pernikahan sudah anda pesan sebelumnya, silahkan tunggu
                konfirmasi dari kami. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); 
                redirect('Beranda/detail?id='.$post['id']);
            }
        } else {
            redirect('Beranda');
        }
    }
    
}
