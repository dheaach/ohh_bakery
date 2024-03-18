<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
    public function __construct()
    {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('login_model');
		$this->load->model('transaction_model');
		$this->load->model('setting_model');
	}

	public function index()
	{  
		$select = array(
			'select' => array( 'pro_Id', 'faktur_pajak_nama', 
								'faktur_pajak_alamat', 'faktur_pajak_alamat2',
								'telp','mail','faktur_pajak_npwp'
						),
			'table' => 'tprofile'
		);

		$data['get_prof'] = $this->setting_model->commonGet($select);
		$this->load->view("admin/profil",$data);
	}

	public function action_profile()
	{
		$nama =$this->input->post('nama');
		$alamat1 =$this->input->post('alamat1');
		$alamat2=$this->input->post('alamat2');
		$telp=$this->input->post('telp');
		$email=$this->input->post('email');
		$npwp=$this->input->post('npwp');

		$update = array(
				'update' => array(
					'faktur_pajak_nama' => $nama,
					'faktur_pajak_alamat' => $alamat1,
					'faktur_pajak_alamat2' => $alamat2,
					'telp' => $telp,
					'mail' => $email,
					'faktur_pajak_npwp' => $npwp
				),
				'table' => 'tprofile'
		);
    	$up = $this->setting_model->commonUpdate($update);
	}
}