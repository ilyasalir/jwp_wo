<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('username'))){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Upss </strong>Anda
            tidak memiliki akses, silahkan login!</div>');
            redirect('login');
        }
        $this->load->model('settings_model');
    }

	public function index()
	{

        $data = array (
            'title' => 'JWP Wediing Organizer',
            'page' => 'admin/settings',
            'settings' => $this->settings_model->getSettings('1')->row()
        );

		$this->load->view('admin/template/main',$data);
	}

    public function updateData()
    {
        $post = $this->input->post();
        // var_dump($post);
        // die;

        if ($post) 
        { $cek_id = $this->settings_model->getSettings($post['id'])->num_rows();

        if ($cek_id > 0) {
            $getSettings = $this->settings_model->getSettings($post['id'])->row();
            $fileName = date('Ymd') . '_' . rand();

            $datetime = date("Y-m-d H:i:s");
            $data = array(
                'website_name' => $post['website_name'], 
                'phone_number1' => $post['phone_number1'], 
                'phone_number2' => $post['phone_number2'], 
                'email1' => $post['email1'],
                'email2' => $post['email2'],
                'address' => $post['address'],
                'maps' => $post['maps'],
                'facebook_url' => $post['facebook_url'],
                'instagram_url' => $post['instagram_url'],
                'youtube_url' => $post['youtube_url'],
                'header_bussines_hour' => $post['header_bussines_hour'], 
                'time_bussines_hour' => $post['time_bussines_hour'], 
                'updated_at' => $datetime,
            );
            
            if (!empty($_FILES['logo']['name'])) {
                //delete file
                if (file_exists('./assets/files/' . $getSettings->logo) && $getSettings->logo) unlink('./assets/files/' . $getSettings->logo);
                    $upload = $this->_do_upload($fileName);
                    $data['logo'] = $upload;
            }
            $update = $this->settings_model->update($post['id'], $data);

            if ($update) {
                 $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"
                 role="alert"><strong>Success </strong>Data Berhasil Di Update!
                <i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Settings');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show"
                role="alert"><strong>UPSS! </strong>Data Gagal Di Update <i class="remove ti-close" data-dismiss="alert"></i></div>'); 
                redirect('admin/Settings');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show"
            role="alert"><strong>UPSS! </strong>Maaf ID Tidak ditemukan. <i class="remove ti-close" data-dismiss="alert"></i></div>'); 
            redirect('admin/Settings');
        }
    } else {
        redirect('admin/Settings');
       
        }
    }

    private function _do_upload($fileName)
    {
        $config['file_name']            = $fileName;
        $config['upload_path']          = './assets/files';
        $config[ 'allowed_types']       = 'gif|jpg|jpeg|png|PNG|JPG|JPEG';
        $config['max_size']             = 5000; //set max size allowed in Kilobyte
        $config['create_thumb']         = FALSE;
        $config['quality']              = '90%';

        $this->load->library( 'upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('logo')) //upload and validate
        {
            $data['inputerror'][] = 'logo';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    } 
}
