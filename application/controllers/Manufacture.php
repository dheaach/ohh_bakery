<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . '../vendor/setasign/fpdf/fpdf.php');

class Manufacture extends CI_Controller {
	
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
		
	}

	public function change_date($var = '')
	{
		$hasil = date('Y-m-d', strtotime($var));

		return $hasil;
	}

	public function bahan($keyword = '', $is_date = '', $start_date = '', $end_date = '', $status = '', $is_all = '')
	{

		if($keyword=='none'){
			$keyword = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
		}

		$data['keyw'] = $keyword;
		
		if($is_date == '1'){
			$data['is_date'] = 1;
		}else{
			$data['is_date'] = 0;
		}

		if($start_date == '' and $end_date == ''){
			$start_date = date('Y-m-d');
			$end_date = date('Y-m-d');
		}

		$data['start_date'] = date('Y-m-d', strtotime($start_date));
		$data['end_date'] = date('Y-m-d', strtotime($end_date));
		$data['status'] = $status;

		if($is_all == '1' || $is_all == true){
			$data['is_user'] = 1;
		}else{
			$data['is_user'] = 0;
		}

		$select2 = array(
			'select' => array(
								'tcat.cat_id',
								'tcat.kode',
								'tcat.nama'),
	    	'table' => 'tcat',
	    	'where' => array(
							'tcat.is_delete' => 0),
	    	'order' => array('tcat.nama' => 'ASC')
	    );
	    $ct1 = array(
			'select' => array('count(tset_bb.bb_no) as proses'),
	    	'table' => 'tset_bb',
	    	'where' => array(
							'tset_bb.is_delete' => 0,
							'tset_bb.is_status' => 1)
	    );
	    $ct2 = array(
			'select' => array('count(tset_bb.bb_no) as komplit'),
	    	'table' => 'tset_bb',
	    	'where' => array(
							'tset_bb.is_delete' => 0,
							'tset_bb.is_status' => 2
						)
	    );
		
		$data['kat'] = $this->setting_model->commonGet($select2);
		$data['prs'] =  $this->setting_model->commonGet($ct1);
	    $data['sls'] =  $this->setting_model->commonGet($ct2);

		$this->load->view('admin/bahan_baku',$data);
		
	}
	public function list_bahan($keyword = '', $is_date = '', $start_date = '', $end_date = '', $status = '', $is_all = '')
	{
		$user_id = $this->session->userdata('person_id');

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tproduct.prod_code0' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tset_bb.bb_no' => $keyword,
								'tset_bb.keterangan' => $keyword);
		}
		
		$where = array();
		$wtgl = array();
		$wuser = array();
		$wsts = array();

		if($is_date == 1 || $is_date == true){
			$tgl_mulai = $this->change_date($start_date);
			$tgl_sls = $this->change_date($end_date);

			$wtgl = array('tset_bb.tgl >=' => ($tgl_mulai.' 00:00:00'),
							'tset_bb.tgl <=' => ($tgl_sls.' 23:59:59'));
		}

		if($is_all == 0 || $is_all == false){
			$wuser = array('tset_bb.user_id' => $user_id);
		}

		if($status > 0){
			$wsts = array('tset_bb.is_status' => $status-1);	
		}

		$where = array_merge($wtgl,$wuser,$wsts);
		
		$option1 = array(
			'select' => array('tset_bb.*',
							'tproduct.prod_no',
							'tproduct.prod_code0',
							'tproduct.prod_name0',
							'tproduct.prod_uom',
							'tproduct.prod_uom2',
							'tproduct.prod_uom3'),
	    	'table' => 'tset_bb',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = tset_bb.prod_no'),
	    	'where' => $where,
	    	'where_in' => array(
							'tset_bb.is_delete' => 0
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tset_bb.tgl' => 'DESC')
	    );

	    $option2 = array(
			'select' => array('count(tset_bb.bb_no) as total'),
	    	'table' => 'tset_bb',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = tset_bb.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tset_bb.is_delete' => 0
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tset_bb.tgl' => 'DESC')
	    );
		
		$data = array();
		$data['bb'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);

		$this->load->view('admin/demo/ingridient',$data);
	}

	public function role($keyword = '', $is_date = '', $start_date = '', $end_date = '', $status = '', $is_all = '')
	{
		if($keyword=='none'){
			$keyword = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
		}

		$data['keyw'] = $keyword;
		
		if($is_date == '1'){
			$data['is_date'] = 1;
		}else{
			$data['is_date'] = 0;
		}

		if($start_date == '' and $end_date == ''){
			$start_date = date('Y-m-d');
			$end_date = date('Y-m-d');
		}

		$data['start_date'] = date('Y-m-d', strtotime($start_date));
		$data['end_date'] = date('Y-m-d', strtotime($end_date));

		$data['status'] = $status;

		if($is_all == '1' || $is_all == true){
			$data['is_user'] = 1;

		}else{
			$data['is_user'] = 0;
		}

		$ct1 = array(
			'select' => array('count(tset_hpp.hap_no) as hasil'),
	    	'table' => 'tset_hpp',
	    	'where' => array(
							'tset_hpp.is_delete' => 0)
	    );
	    $ct2 = array(
			'select' => array('count(tset_hpp.hap_no) as hasil'),
	    	'table' => 'tset_hpp',
	    	'where' => array(
							'tset_hpp.is_delete' => 1)
	    );

	    $data['akt'] =  $this->setting_model->commonGet($ct1);
	    $data['non'] =  $this->setting_model->commonGet($ct2);
		
		$this->load->view('admin/role_manufaktur',$data);
		
	}
	public function list_role($keyword = '', $is_date = '', $start_date = '', $end_date = '', $status = '', $is_all = '')
	{
		$user_id = $this->session->userdata('person_id');

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tset_hpp.hap_no' => $keyword);
			$or_like = array('tset_hpp.keterangan' => $keyword);
		}
		
		$where = array();
		$wtgl = array();
		$wuser = array();

		if($is_date == '1' || $is_date == true){
			$tgl_mulai = $this->change_date($start_date);
			$tgl_sls = $this->change_date($end_date);
			$wtgl = array('tset_hpp.tgl >=' => $tgl_mulai.' 00:00:00',
							'tset_hpp.tgl <=' => $tgl_sls.' 00:00:00');
		}

		if($is_all == 0 || $is_all == false){
			$wuser = array('tset_hpp.user_id' => $user_id);
		}

		$where = array_merge($wtgl,$wuser);

		$option1 = array(
			'select' => array('tset_hpp.*'),
	    	'table' => 'tset_hpp',
	    	'where' => $where,
	    	'where_in' => array('tset_hpp.is_delete' => 0),
	    	'like' => $like,
	    	'order' => array('tset_hpp.tgl' => 'DESC')
	    );

	    $option2 = array(
			'select' => array('count(tset_hpp.hap_no) as total'),
	    	'table' => 'tset_hpp',
	    	'where'	=> $where,
	    	'where_in' => array('tset_hpp.is_delete' => 0),
	    	'like' => $like,
	    	'order' => array('tset_hpp.tgl' => 'DESC')
	    );
		
		$data = array();
		$data['hpp'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);

		$this->load->view('admin/demo/role',$data);
	}
	public function proses($keyword = '', $is_date = '', $start_date = '', $end_date = '', $status = '', $is_all = '')
	{
		if($keyword=='none'){
			$keyword = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
		}

		$data['keyw'] = $keyword;
		
		if($is_date == '1'){
			$data['is_date'] = 1;
		}else{
			$data['is_date'] = 0;
		}

		if($start_date == '' and $end_date == ''){
			$start_date = date('Y-m-d');
			$end_date = date('Y-m-d');
		}

		$data['start_date'] = date('Y-m-d', strtotime($start_date));
		$data['end_date'] = date('Y-m-d', strtotime($end_date));
		$data['status'] = $status;

		if($is_all == '1' || $is_all == true){
			$data['is_user'] = 1;
		}else{
			$data['is_user'] = 0;
		}

		$select = array(
			'select' => array('gud_no', 'gud_code', 'gud_name'),
	    	'table' => 'tgudang',
	    	'where' => array('is_delete' => 0,
	    					'is_default' => '1'),
	    	'order' => array('is_produksi' => 'DESC')
	    );

		$data['gud'] = $this->setting_model->commonGet($select);

		$select2 = array(
			'select' => array(
								'tcat.cat_id',
								'tcat.kode',
								'tcat.nama'),
	    	'table' => 'tcat',
	    	'where' => array(
							'tcat.is_delete' => 0),
	    	'order' => array('tcat.nama' => 'ASC')
	    );
		
		$ct1 = array(
			'select' => array('count(tm_produksi.pr_no) as hasil'),
	    	'table' => 'tm_produksi',
	    	'where' => array(
							'tm_produksi.is_delete' => 0)
	    );
	    $ct2 = array(
			'select' => array('count(tm_produksi.pr_no) as hasil'),
	    	'table' => 'tm_produksi',
	    	'where' => array(
							'tm_produksi.is_delete' => 1)
	    );

	    $data['akt'] =  $this->setting_model->commonGet($ct1);
	    $data['non'] =  $this->setting_model->commonGet($ct2);

		$data['kat'] = $this->setting_model->commonGet($select2);
		
		$this->load->view('admin/proses_manufaktur',$data);
		
	}
	public function list_proses($keyword = '', $is_date = '', $start_date = '', $end_date = '', $status = '', $is_all = '')
	{
		$user_id = $this->session->userdata('person_id');

		$where = array();
		$wtgl = array();
		$wuser = array();

		if($is_date == 1 || $is_date == true){
			$tgl_mulai = $this->change_date($start_date);
			$tgl_sls = $this->change_date($end_date);
			$wtgl = array('tm_produksi.pr_date >=' => $tgl_mulai.' 00:00:00',
							'tm_produksi.pr_date <=' => $tgl_sls.' 23:59:59');
		}

		if($is_all == 0 || $is_all == false){
			$wuser = array('tm_produksi.user_id' => $user_id);
		}

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tm_produksi.pr_no' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tm_produksi.pr_ket' => $keyword);
		}

		$is_status = array();

		if($status <> ''){
			if($status == 0){
				$is_status = array(0);
			}elseif($status == 1){
				$is_status = array(0);
			}elseif($status == 2){
				$is_status = array(1);
			}
		}else{
			$status = 0;
			$is_status = array(0);
		}

		$where = array_merge($wtgl,$wuser);

		$option1 = array(
			'select' => array('tm_produksi.*',
								'concat(tproduct.prod_code0, "-", tproduct.prod_name0) as nm_barang',
								'if(tm_produksi.satuan = 1,tproduct.prod_uom, if(tm_produksi.satuan = 2, tproduct.prod_uom2, tproduct.prod_uom3)) as nm_satuan'),
	    	'table' => 'tm_produksi',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = tm_produksi.prod_no'),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'where'	=> $where,
	    	'where_in' => array(
							'tm_produksi.is_delete' => $is_status
						),
	    	'order' => array('tm_produksi.pr_date' => 'DESC')
	    );

	    $option2 = array(
			'select' => array('count(tm_produksi.pr_no) as total'),
	    	'table' => 'tm_produksi',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = tm_produksi.prod_no'),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'where'	=> $where,
	    	'where_in' => array(
							'tm_produksi.is_delete' => $is_status
						),
	    	'order' => array('tm_produksi.pr_date' => 'DESC')
	    );
		
		$data = array();
		$data['pr'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);

		$this->load->view('admin/demo/proses', $data);

	}

	public function proses_trial($keyword = '', $is_date = '', $start_date = '', $end_date = '', $status = '', $is_all = '')
	{
		if($keyword=='none'){
			$keyword = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
		}

		$data['keyw'] = $keyword;
		
		if($is_date == '1'){
			$data['is_date'] = 1;
		}else{
			$data['is_date'] = 0;
		}

		if($start_date == '' and $end_date == ''){
			$start_date = date('Y-m-d');
			$end_date = date('Y-m-d');
		}

		$data['start_date'] = date('Y-m-d', strtotime($start_date));
		$data['end_date'] = date('Y-m-d', strtotime($end_date));
		$data['status'] = $status;

		if($is_all == '1' || $is_all == true){
			$data['is_user'] = 1;
		}else{
			$data['is_user'] = 0;
		}

		$select = array(
			'select' => array('gud_no', 'gud_code', 'gud_name'),
	    	'table' => 'tgudang',
	    	'where' => array('is_delete' => 0,
	    					'is_default' => 'ID2'),
	    	'order' => array('is_produksi' => 'DESC')
	    );

		$data['gud'] = $this->setting_model->commonGet($select);

		$select2 = array(
			'select' => array(
								'tcat.cat_id',
								'tcat.kode',
								'tcat.nama'),
	    	'table' => 'tcat',
	    	'where' => array(
							'tcat.is_delete' => 0),
	    	'order' => array('tcat.nama' => 'ASC')
	    );

	    $ct1 = array(
			'select' => array('count(tm_produksi_trial.pr_no) as hasil'),
	    	'table' => 'tm_produksi_trial',
	    	'where' => array(
							'tm_produksi_trial.is_delete' => 0)
	    );
	    $ct2 = array(
			'select' => array('count(tm_produksi_trial.pr_no) as hasil'),
	    	'table' => 'tm_produksi_trial',
	    	'where' => array(
							'tm_produksi_trial.is_delete' => 1)
	    );

	    $data['akt'] =  $this->setting_model->commonGet($ct1);
	    $data['non'] =  $this->setting_model->commonGet($ct2);
		
		$data['kat'] = $this->setting_model->commonGet($select2);
		
		$this->load->view('admin/proses_trial',$data);
		
	}
	public function list_proses_trial($keyword = '', $is_date = '', $start_date = '', $end_date = '', $status = '', $is_all = '')
	{
		$user_id = $this->session->userdata('person_id');

		$where = array();
		$wtgl = array();
		$wuser = array();

		if($is_date == 1 || $is_date == true){
			$tgl_mulai = $this->change_date($start_date);
			$tgl_sls = $this->change_date($end_date);
			$wtgl = array('tm_produksi_trial.pr_date >=' => $tgl_mulai.' 00:00:00',
							'tm_produksi_trial.pr_date <=' => $tgl_sls.' 23:59:59');
		}

		if($is_all == 0 || $is_all == false){
			$wuser = array('tm_produksi_trial.user_id' => $user_id);
		}

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tm_produksi_trial.pr_no' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tm_produksi_trial.pr_ket' => $keyword);
		}

		$is_status = array();

		if($status <> ''){
			if($status == 0){
				$is_status = array(0);
			}elseif($status == 1){
				$is_status = array(0);
			}elseif($status == 2){
				$is_status = array(1);
			}
		}else{
			$status = 0;
			$is_status = array(0);
		}

		$where = array_merge($wtgl,$wuser);

		$option1 = array(
			'select' => array('tm_produksi_trial.*',
								'concat(tproduct.prod_code0, "-", tproduct.prod_name0) as nm_barang',
								'if(tm_produksi_trial.satuan = 1,tproduct.prod_uom, if(tm_produksi_trial.satuan = 2, tproduct.prod_uom2, tproduct.prod_uom3)) as nm_satuan'),
	    	'table' => 'tm_produksi_trial',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = tm_produksi_trial.prod_no'),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'where'	=> $where,
	    	'where_in' => array(
							'tm_produksi_trial.is_delete' => $is_status
						),
	    	'order' => array('tm_produksi_trial.pr_date' => 'DESC')
	    );

	    $option2 = array(
			'select' => array('count(tm_produksi_trial.pr_no) as total'),
	    	'table' => 'tm_produksi_trial',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = tm_produksi_trial.prod_no'),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'where'	=> $where,
	    	'where_in' => array(
							'tm_produksi_trial.is_delete' => $is_status
						),
	    	'order' => array('tm_produksi_trial.pr_date' => 'DESC')
	    );
		
		$data = array();
		$data['pr'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);

		$this->load->view('admin/demo/proses_trial', $data);
	}

	public function get_id_proses($id_tr,$session)
	{
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$maak = 0;

		foreach ($json_arr['transaksi'] as $key) {
			if (($key['id']) == ((int)$id_tr)) {
				foreach ($key['detail'] as $val) {
					$maak = max($maak, $val['id_trans']);	
				}
		    }
		}

		$maak = $maak+1;

		$this->session->set_userdata($session,$maak);

    	return $maak;
	}

	public function get_id_det_trans($id_tr,$id_pr)
	{
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$maak = 0;

		foreach ($json_arr['transaksi'] as $key) {
			if (($key['id']) == ((int)$id_tr)) {
				foreach ($key['detail'] as $val) {
					if($val['id_trans'] == (int)$id_pr){
						foreach ($val['detail_trans'] as $ab) {
							$maak = max($maak, $ab['id_det']);	
						}
					}
				}
		    }
		}

		$maak = $maak+1;

		// echo $maak;
    	return $maak;

	}

	public function insert_detailbb()
	{
		$id_proses = 0;

		$id_proses = (int)$this->session->userdata('bb_proses_id');

		if($id_proses <> 0 or $id_proses <> '' ){
			$id_proses = (int)$this->session->userdata('bb_proses_id');
		}else{
			$id_proses = $this->get_id_proses(1,'bb_proses_id');
		}
		
		$id_brg = $this->input->post('id_brg');
		$id_bb = $this->input->post('id_bb');

		$is_new = 1;

		if($id_bb <> '' ){
			$is_new = 0;
		}


		$posts = array();
	    $post = array();
	    $dsn = array();

	    $exist = 0;

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

	    $id_det = (int)$this->get_id_det_trans(1,$id_proses);

	    foreach($id_brg as $id){
	    	$option = array(
				'select' => array('tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3',
								'tproduct.konversi1',
								'tproduct.konversi2',
								'tproduct.konversi3',
								'prod_kemasan',
								'qty_kemasan'),
		    	'table' => 'tproduct',
		    	'where'	=>array('tproduct.prod_no' => $id)
		    );

			$get_prod = $this->setting_model->commonGet($option);

			if (is_array($get_prod) || is_object($get_prod)){
				
				foreach ($get_prod as $key) {
				    $dsn[] = array(
					    		"id_det" => $id_det++,
					        	"prod_no" => $key->prod_no,
					        	"prod_code" => $key->prod_code0,
					        	"prod_name" => $key->prod_name0,
						        "satuan" => $key->prod_uom,
						        "qty_satuan" => 0,
						        "konversi" => $key->konversi1,
						        "harga_satuan" => 0,
						        "price_netto" => 0,
						        "keterangan" => "",
						        "qty_pemakaian" => 0,
						        "qty_dibutuhkan" => 0,
						        "qty_kemasan" => $key->qty_kemasan,
						        "satuan_pakai" => "",
						        "satuan_butuh" => "",
						        "prod_kemasan" => $key->prod_kemasan,
						        "is_new" => 1
				    );
				}
			}
	    }

	    $post = array(
	    	"id_trans" => $id_proses,
			"is_edit" => 0,
			"trans_no" => "",
	        "detail_trans"   => $dsn
	    );

	    $is_exist = 0;
	    foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 1) {
		    	foreach ($key['detail'] as $val) {
		    		if($val['id_trans'] == $id_proses){
		    			$is_exist = 1;
		    		}
		    	}
		    }
		}

		if($is_exist == 1){
			foreach ($posts['transaksi'] as &$key) {
			    if (($key['id']) == 1) {
			    	foreach ($key['detail'] as &$val) {
			    		if($val['id_trans'] == $id_proses){
			    			for($i = 0; $i < count($dsn); $i++){
			    				array_push($val['detail_trans'],$dsn[$i]);	
			    			}
			    		}
			    	}
			    }
			}
		}else{
			foreach ($posts['transaksi'] as &$key) {
			    if (($key['id']) == 1) {
			    	array_push($key['detail'],$post);
			    }
			}
		}
	    
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);

	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }
	    
	}
	public function fetch_detail_bb()
	{
		$data_json = file_get_contents('./transaction_data.json');

        $data = array();
        $dtotp = array();
        $proses_id = 0;
        $proses_id = $this->session->userdata('bb_proses_id');
        // $data['json_arr'] = json_decode($data_json, true);
        $json_arr = json_decode($data_json, true);

        $all= '';


        foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 1){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							$select = array(
								'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
								'table' => 'tproduct',
								'where' => array('prod_no' => $brg['prod_no'])
							);

					    	$sc = $this->setting_model->commonGet($select);

					    	foreach ($sc as $abc) {
					    		$uom = $abc->prod_uom;
					    		$uom2 = $abc->prod_uom2;
					    		$uom3 = $abc->prod_uom3;
					    		$kon1 = $abc->konversi1;
					    		$kon2 = $abc->konversi2;
					    		$kon3 = $abc->konversi3;
					    	}

							$sub_array = array();
							$sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="prod_code" data-value="' . $brg['prod_code'] . '">' . $brg['prod_code'] . '</div>';
							$sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="prod_name" data-value="' . $brg['prod_name'] . '">' . $brg['prod_name'] . '</div>';
							$sub_array[] = '<div contenteditable class="update-satuan" data-id="'.$brg['id_det'].'" data-column="satuan" data-value="' . $brg['satuan'] . '" data-uom="'.$uom.'" data-uom2="'.$uom2.'" data-uom3="'.$uom3.'" data-kon1="'.$kon1.'" data-kon2="'.$kon2.'" data-kon3="'.$kon3.'">' . $brg['satuan'] . '</div>';
							$sub_array[] = '<div contenteditable class="update-qty" data-id="'.$brg['id_det'].'" data-column="qty_satuan" data-value="' . $brg['qty_satuan'] . '">' . $brg['qty_satuan'] . '</div>';
							$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="qty_pemakaian" data-value="' . $brg['qty_pemakaian'] . '">' . $brg['qty_pemakaian'] . '</div>';
							$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="qty_dibutuhkan" data-value="' . $brg['qty_dibutuhkan'] . '">' . $brg['qty_dibutuhkan'] . '</div>';
							$sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="keterangan" data-value="' . $brg['keterangan'] . '">' . $brg['keterangan'] . '</div>';
							$sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="qty_kemasan" data-value="' . $brg['qty_kemasan'] . '">' . $brg['qty_kemasan'] . '</div>';
							$sub_array[] = '<a class="delete" name="delete" id="'.$brg['id_det'].'" href="" style="margin-right:15px;"><i class="fa fa-times"></i></a>';
							$dtotp[] = $sub_array;
						}
						$all = count(array($val['detail_trans']));
					}
					
				}
			}
		}

		$output = array(
		 "recordsTotal"  =>  $all,
		 "recordsFiltered" => $all,
		 "data"    => $dtotp
		);

		echo json_encode($output);
	}

	public function add_detail_bb()
	{
		$proses_id = (int)$this->session->userdata('bb_proses_id');
		$tableData = $this->input->post('tableData');

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		if(is_array($tableData)){
			foreach ($tableData as $data) {
				$id_det = $data['id_det'];
				$prod_code = $data['prod_code'];
				$prod_name = $data['prod_name'];
				$satuan = $data['satuan'];
				$qty_satuan = $data['qty_satuan'];
				$qty_pemakaian = $data['qty_pemakaian'];
				$qty_dibutuhkan = $data['qty_dibutuhkan'];
				$keterangan = $data['keterangan'];
				$qty_kemasan = $data['qty_kemasan'];
				
				foreach ($posts['transaksi'] as &$key) {
			    	if (($key['id']) == 1) {
			    		foreach ($key['detail'] as &$val) {
			    			if($val['id_trans'] == ((int)$proses_id)){
								foreach ($val['detail_trans'] as &$brg) {
									if($brg['id_det'] == $id_det){
										$select = array(
											'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
											'table' => 'tproduct',
											'where' => array('prod_no' => $brg['prod_no'])
										);

								    	$sc = $this->setting_model->commonGet($select);

								    	foreach ($sc as $abc) {
								    		$uom = $abc->prod_uom;
								    		$uom2 = $abc->prod_uom2;
								    		$uom3 = $abc->prod_uom3;
								    		$kon1 = $abc->konversi1;
								    		$kon2 = $abc->konversi2;
								    		$kon3 = $abc->konversi3;
								    	}

								    	if($satuan == $uom){
								    		$satuan = $uom;
								    		$kon = $kon1;
								    	}elseif ($satuan == $uom2) {
								    		$satuan = $uom2;
								    		$kon = $kon2;
								    	}elseif ($satuan == $uom3) {
								    		$satuan = $uom3;
								    		$kon = $kon3;
								    	}else{
								    		$satuan = $uom;
								    		$kon = $kon1;
								    	}

				    					$brg['satuan'] = $satuan;
				    					$brg['qty_satuan'] = $qty_satuan;
				    					$brg['konversi'] = $kon;
				    					$brg['harga_satuan'] = 0;
				    					$brg['price_netto'] = 0;
				    					$brg['keterangan'] = $keterangan;
				    					$brg['qty_pemakaian'] = $qty_pemakaian;
				    					$brg['qty_dibutuhkan'] = $qty_dibutuhkan;
				    					$brg['qty_kemasan'] = $qty_kemasan;
									}
								}
							}
			    		}
			    	}
			    }
			}
		}

		$json_body = json_encode($posts);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function get_qty_prod()
	{
		$id = $this->input->post('id');
		$column = $this->input->post('column');
	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('bb_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 1){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['id_det'] == ((int)$id)){
								echo json_encode(array(
									"id_detail" => $brg['id_det'],
									"qty_kemasan" => $brg['qty_kemasan'],
									"prod_kemasan" => $brg['prod_kemasan']
								));
							}
						}
					}
				}
			}
		}
	}

	public function delete_bb_detail($id_det = "")
	{
		if($id_det == ''){
			$id_det = $this->input->post('id_det');
		}
		$proses_id = 0;
        $proses_id = $this->session->userdata('bb_proses_id');
		// get array index to delete
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          	if($subKey['id'] == 1){
          		foreach ($subKey['detail'] as &$subVal) {
					if($subVal['id_trans'] == ((int)$proses_id)){
						foreach ($subVal['detail_trans'] as $brg => $subArray) {
							if($subArray['id_det'] == (int)$id_det){
					           unset($subVal['detail_trans'][$brg]);
					        }
						}
					}
				}
			}
		}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == 1){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							$total_qty += $brg['qty_satuan'];
							$total_pakai += $brg['qty_pemakaian'];
							$total_butuh += $brg['qty_dibutuhkan'];
						}
					}
				}
			}
		}

		echo json_encode(array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh
		));
	}
	public function getProsesBb()
	{
		$this->session->unset_userdata('bb_proses_id');
		$proses_id = $this->get_id_proses(1,'bb_proses_id');

		return $proses_id;
	}

	public function GetNoIDField($field='', $table='',$code)
	{
		$date = date('Y-m-d H:i:s');
		$bulan = date('m');
		$tahun = date('Y');
		$hari = date('d');
		$tgl = $bulan.' : '.$tahun.' : '.$hari;
		$user_id = $this->session->userdata('person_id');
		$no_prefix = '';
		$jumlah = '';
		$kata = '';
		$tots = '';

		$insert = array(
			'insert' => array(
				'tgl' => $date,
				'user_id' => $user_id,
				'ket' => $field.'-'.$table),
			'table' => 'tlog_trx'
		);
    	$this->setting_model->commonInsert($insert);

		$select = array(
			'select' => array('total'),
			'table' => 'ttotal_id',
			'where' => array('nama' => $table.'_'.$no_prefix,
						'bulan' => $bulan,
						'tahun' => $tahun,
						'hari' => $hari)
		);

    	$sc = $this->setting_model->commonGet($select);

    	if (is_array($sc) || is_object($sc)){
    		foreach ($sc as $abc){
				$tots = $abc->total;
			}

    		$update = array(
					'update' => array(
						'total' => $tots+1),
					'table' => 'ttotal_id',
					'where' => array('nama' => $table.'_'.$no_prefix,
						'bulan' => $bulan,
						'tahun' => $tahun,
						'hari' => $hari)
			);
        	$c = $this->setting_model->commonUpdate($update);
        	print_r($c);

    	}else{
    		$insert2 = array(
				'insert' => array(
					'nama' => $table.'_'.$no_prefix,
					'total' => 1,
					'bulan' => $bulan,
					'tahun' => $tahun,
					'hari' => $hari),
				'table' => 'ttotal_id'
			);
			$this->setting_model->commonInsert($insert2);

    	}

    	$select2 = array(
			'select' => array('total'),
			'table' => 'ttotal_id',
			'like' => array('nama' => $table.'_'.$no_prefix),
			'where' => array('bulan' => $bulan,
						'tahun' => $tahun,
						'hari' => $hari)
		);
		$sc2 = $this->setting_model->commonGet($select2);
		foreach ($sc2 as $key){
			$jumlah = $key->total;
		}

		$vd = date("Y-m-d");
		$vh = date("H:i:s");

		$orderdate = explode('-', $vd);
		$year = substr($orderdate[0],-2);
		$month   = $orderdate[1];
		$date  = $orderdate[2];

		$getDate = $year.$month.$date;

		$orderhrs = explode(':', $vh);
		$hrs = $orderhrs[0];
		$mnt   = $orderhrs[1];
		$sc  = $orderhrs[2];

		$getTime = $hrs.$mnt.$sc;


		if($no_prefix <> ''){
			$kata = $no_prefix.'-'.$getDate.'-'.$getTime.'-'.sprintf("%04d", $jumlah);
		}else{
			$kata = $code.'-'.$getDate.'-'.$getTime.'-'.sprintf("%04d", $jumlah);
		}
		
		return $kata;

	}
	
	public function get_data_prod($kondisi = array())
	{
		$option = array(
			'select' => array('count(tset_bb.prod_no) as hasil'),
	    	'table' => 'tset_bb',
	    	'where' => $kondisi
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);
		if (is_array($data['get_data']) || is_object($data['get_data'])){
		    foreach($data['get_data'] as $right) {
		    	$is_name = $right->hasil;
		    }
		}

		return $is_name;
	}

	public function delete_all_detail_bb($pr_id = '')
	{
		if($pr_id == ''){
			$pr_id = $this->input->post('proses_id');
			if($pr_id == ''){
				$pr_id = (int)$this->session->userdata('bb_proses_id');
			}
		}
		
		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          if($subKey['id'] == 1){
          	foreach ($subKey['detail'] as $subVal => $valArray) {
				if($valArray['id_trans'] == ((int)$pr_id)){
					unset($subKey['detail'][$subVal]);
				}
			}
          }
     	}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function delete_trans($pr_id = '')
	{
		if($pr_id == ''){
			$pr_id = $this->input->post('proses_id');
			if($pr_id == ''){
				$pr_id = (int)$this->session->userdata('bb_proses_id');
			}
		}
		
		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          if($subKey['id'] == 1){
          	foreach ($subKey['detail'] as $subVal => $valArray) {
				if($valArray['id_trans'] == ((int)$pr_id)){
					unset($subKey['detail'][$subVal]);
				}
			}
          }
     	}


		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function insert_detail_bb($id_tr, $trans_no)
	{
		$id_bb = $trans_no;

		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);

		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 1){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_tr)){
						foreach ($val['detail_trans'] as &$brg) {
							
							$select = array(
								'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
								'table' => 'tproduct',
								'where' => array('prod_no' => $brg['prod_no'])
							);

					    	$sc = $this->setting_model->commonGet($select);

					    	foreach ($sc as $val) {
					    		$uom = $val->prod_uom;
					    		$uom2 = $val->prod_uom2;
					    		$uom3 = $val->prod_uom3;
					    	}

					    	if($brg['satuan'] == $uom){
					    		$satuan = (int)1;
					    	}else if ($brg['satuan'] == $uom2) {
					    		$satuan = (int)2;
					    	}else if ($brg['satuan'] == $uom3) {
					    		$satuan = (int)3;
					    	}

							$det_no = $this->setting_model->GetNoIDField2('det_no','td_set_bb');
							$insert = array(
								'insert' => array('det_no' => $det_no,
												'bb_no' => $id_bb,
												'prod_no' => $brg['prod_no'],
												'satuan'=> $satuan,
												'qty_satuan' => $brg['qty_satuan'],
												'konversi' => $brg['konversi'],
												'harga_satuan' => $brg['harga_satuan'],
												'price_netto' => $brg['price_netto'],
												'keterangan' => $brg['keterangan'],
												'qty_pemakaian' => $brg['qty_pemakaian'],
												'qty_dibutuhkan' => $brg['qty_dibutuhkan'],
												'satuan_pakai' => $brg['satuan_pakai'],
												'satuan_butuh' => $brg['satuan_butuh']
											),
								'table' => 'td_set_bb'
							);

							$this->setting_model->commonInsert($insert);
						}
					}
				}
			}
		}

		$this->delete_all_detail_bb($id_tr);
	}

	public function update_detail_bb($id_tr, $trans_no)
	{
		$all_id_brg = array();
		
		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 1){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_tr)){
						foreach ($val['detail_trans'] as &$brg) {

							$select = array(
								'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
								'table' => 'tproduct',
								'where' => array('prod_no' => $brg['prod_no'])
							);

					    	$sc = $this->setting_model->commonGet($select);

					    	foreach ($sc as $val) {
					    		$uom = $val->prod_uom;
					    		$uom2 = $val->prod_uom2;
					    		$uom3 = $val->prod_uom3;
					    	}

					    	if($brg['satuan'] == $uom){
					    		$satuan = (int)1;
					    	}else if ($brg['satuan'] == $uom2) {
					    		$satuan = (int)2;
					    	}else if ($brg['satuan'] == $uom3) {
					    		$satuan = (int)3;
					    	}

							if($brg['is_new'] === 1){
								$insert = array(
									'insert' => array('det_no' => $det_no,
													'bb_no' => $trans_no,
													'prod_no' => $brg['prod_no'],
													'satuan'=> $satuan,
													'qty_satuan' => $brg['qty_satuan'],
													'konversi' => $brg['konversi'],
													'harga_satuan' => $brg['harga_satuan'],
													'price_netto' => $brg['price_netto'],
													'keterangan' => $brg['keterangan'],
													'qty_pemakaian' => $brg['qty_pemakaian'],
													'qty_dibutuhkan' => $brg['qty_dibutuhkan'],
													'satuan_pakai' => $brg['satuan_pakai'],
													'satuan_butuh' => $brg['satuan_butuh']
												),
									'table' => 'td_set_bb'
								);
								
								$this->setting_model->commonInsert($insert);
							}else{
								$update = array(
									'update' => array('satuan'=> $satuan,
													'qty_satuan' => $brg['qty_satuan'],
													'konversi' => $brg['konversi'],
													'harga_satuan' => $brg['harga_satuan'],
													'price_netto' => $brg['price_netto'],
													'keterangan' => $brg['keterangan'],
													'qty_pemakaian' => $brg['qty_pemakaian'],
													'qty_dibutuhkan' => $brg['qty_dibutuhkan'],
													'satuan_pakai' => $brg['satuan_pakai'],
													'satuan_butuh' => $brg['satuan_butuh']
												),
									'table' => 'td_set_bb',
									'where' => array('td_set_bb.bb_no' => $trans_no, 
				    					'td_set_bb.prod_no' => $brg['prod_no'])
								);
								$up = $this->setting_model->commonUpdate($update);

							}

							$all_id_brg[] = $brg['prod_no'];
						}
					}
				}
			}
		}

		$delete = array(
			'table' => 'td_set_bb',
			'where_not_in' => array('td_set_bb.prod_no' => $all_id_brg),
			'where' => array('td_set_bb.bb_no' => $trans_no)
		);
		$this->setting_model->commonDelete($delete);

		$this->delete_all_detail_bb($id_tr);
	}

	public function testno()
	{
		$date = date('Y-m-d');
		$no = $this->setting_model->GetNoIDField($date,'ID','det_no','td_set_bb');

		echo $no;
	}
	public function testedit()
	{
		$id_tr = 1;
		$id_bb = 'BB-23321-163130-0001';
		$now = date('Y-m-d H:i:s');
		$update = array(
				'update' => array(
					'edit_date' => $now
				),
				'table' => 'tset_bb',
				'where' => array(
					'tset_bb.bb_no' => $id_bb
				)
		);
		$this->setting_model->commonUpdate($update);

		$this->update_detail_bb($id_tr, $id_bb);
	}
	public function action_bahanbaku()
	{
        $date = $this->input->post('date');
		$stt = strtotime($date);
        $sec = date("s");
        // $rsl = date('Y-m-d',$stt);
		$rsl = (str_replace("T"," ",$date)).":".$sec;

		if($this->input->post('type')==2){
			$rsl = (str_replace("T"," ",$date));
		}

		if($this->input->post('type')==1){
			$trans_no = $this->setting_model->GetNoIDField($rsl,'BB','bb_no','tset_bb');	
		}

		$id_bb =$this->input->post('id_bb');
		$kode_brg =$this->input->post('kode_brg');
		$ket=$this->input->post('ket');
		$id_tr = $this->session->userdata('bb_proses_id');
		$user_id = $this->session->userdata('person_id');
		$user_cab = $this->session->userdata('gud_no');
		$now = date('Y-m-d H:i:s');

		$chk_prod = array('tset_bb.prod_no' => $kode_brg,
							'tset_bb.is_delete' => 0);

		$is_bb = $this->get_data_prod($chk_prod);

		$user_right = '';
		if($this->input->post('type')==1){// insert
			if ($is_bb == 1) {
				echo json_encode(array(
					"statusCode"=>405
				));

				$this->delete_all_detail_bb($id_tr);
			}else{

				$insert = array(
					'insert' => array(
						'create_date' => $now,
						'bb_no' => $trans_no,
						'prod_no' => $kode_brg,
						'tgl' => $date,
						'keterangan' => $ket,
						'user_id'=> $user_id,
						'user_edit' =>$user_id,
						'edit_date' => $now,
						'cab_no' => $user_cab,
						'is_delete' => 0
					),
					'table' => 'tset_bb'
				);

	        	$this->setting_model->commonInsert($insert);
	        	$this->insert_detail_bb($id_tr, $trans_no);

	        	echo json_encode(array(
					"statusCode"=>200,
					"trans_no" => $trans_no,
				));
			}
		}elseif($this->input->post('type')==2) {//update
			$update = array(
					'update' => array(
						'edit_date' => $now,
						'prod_no' => $kode_brg,
						'tgl' => $date,
						'keterangan' => $ket,
						'user_edit'=> $user_id,
						'is_delete' => 0
					),
					'table' => 'tset_bb',
					'where' => array(
						'tset_bb.bb_no' => $id_bb
					)
			);
        	$this->setting_model->commonUpdate($update);
        	$this->update_detail_bb($id_tr, $id_bb);

			echo json_encode(array(
				"statusCode"=>201,
				"trans_no" => $id_bb
			));
		}elseif($this->input->post('type')==3) {//delete

			 foreach($id_bb as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1,
							'delete_date' => $now,
							'user_delete'=> $user_id,
						),
						'table' => 'tset_bb',
						'where' => array(
							'tset_bb.bb_no' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}elseif($this->input->post('type')==4) {//arsip

			 foreach($id_bb as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1,
							'delete_date' => $now,
							'user_delete'=> $user_id,
						),
						'table' => 'tset_bb',
						'where' => array(
							'tset_bb.bb_no' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}
	}
	public function get_edit_data_bb()
	{

		$id_bb = $this->input->post('id_bb');
		$hasil = array();
		$data = array();
		$trans_no = '';

		$proses_id = (int)$this->getProsesBb();
		$pid = $proses_id;

		$option = array(
			'select' => array(
								'tset_bb.bb_no',
								'tset_bb.prod_no',
								'tset_bb.tgl',
								'tset_bb.keterangan',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3',

							),
	    	'table' => 'tset_bb',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = tset_bb.prod_no'),
	    	'where'	=>array('tset_bb.bb_no' => $id_bb)
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);
		if (is_array($data['get_data']) || is_object($data['get_data'])){
		    foreach($data['get_data'] as $right) {
		    	$hasil['parent_prod'] = array(
					"trans_date" => $right->tgl,
					"trans_no" => $right->bb_no,
					"prod_code0" => $right->prod_code0,
					"prod_no" => $right->prod_no,
					"prod_name0" => $right->prod_name0,
					"keterangan" => $right->keterangan,
					"prod_uom" => $right->prod_uom,
					"prod_uom2" => $right->prod_uom2,
					"prod_uom3" => $right->prod_uom3
				);

				$trans_no = $right->bb_no;
		    }
		}

		$get_sum = array(
			'select' => array('SUM(td_set_bb.qty_pemakaian) AS sum_pakai',
								'SUM(td_set_bb.qty_dibutuhkan) AS sum_butuh',
								'SUM(td_set_bb.qty_satuan) AS sum_satuan',),
	    	'table' => 'td_set_bb',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = td_set_bb.prod_no'),
	    	'where'	=>array('td_set_bb.bb_no' => $trans_no)
	    );

		$scol = $this->setting_model->commonGet($get_sum);
		if (is_array($scol) || is_object($scol)){
		    foreach($scol as $kcol) {
		    	$hasil['detail_sum'] = array(
					"qty_pakai" => $kcol->sum_pakai,
					"qty_butuh" => $kcol->sum_butuh,
					"qty_satuan" => $kcol->sum_satuan
				);
		    }
		}

		$option2 = array(
			'select' => array(
								'td_set_bb.det_no',
								'td_set_bb.bb_no',
								'td_set_bb.prod_no',
								'td_set_bb.satuan',
								'td_set_bb.qty_satuan',
								'td_set_bb.konversi',
								'td_set_bb.harga_satuan',
								'td_set_bb.price_netto',
								'td_set_bb.keterangan',
								'td_set_bb.qty_pemakaian',
								'td_set_bb.qty_dibutuhkan',
								'td_set_bb.satuan_pakai',
								'td_set_bb.satuan_butuh',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3'
							),
	    	'table' => 'td_set_bb',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = td_set_bb.prod_no'),
	    	'where'	=>array('td_set_bb.bb_no' => $trans_no)
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);

		$dsntmp = array();

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		$all = array();
		// $response = array();
	    $post = array();

	    $post = array(
	    	"id_trans" => $pid,
			"is_edit" => 1,
			"trans_no" => $trans_no,
	        "detail_trans"   => $dsntmp
	    );

		$dsn = array();

		$id_det = (int)$this->get_id_det_trans(1,$proses_id);

		if (is_array($data['get_unit']) || is_object($data['get_unit'])){
		    foreach($data['get_unit'] as $right) {
				// $this->write_edit_detail_bb($right->prod_no,$right->prod_code0,$right->prod_name0,$right->satuan,$right->qty_satuan,$right->konversi,$right->harga_satuan,$right->price_netto,$right->keterangan,$right->qty_pemakaian,$right->qty_dibutuhkan,$right->satuan_pakai,$right->satuan_butuh,$right->prod_code0,$right->prod_name0,$right->prod_uom,$right->prod_uom2,$right->prod_uom3,$proses_id,$trans_no);
				$select = array(
					'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3','prod_kemasan','qty_kemasan'),
					'table' => 'tproduct',
					'where' => array('prod_no' => $right->prod_no)
				);

		    	$sc = $this->setting_model->commonGet($select);

		    	foreach ($sc as $val) {
		    		$uom = $val->prod_uom;
		    		$uom2 = $val->prod_uom2;
		    		$uom3 = $val->prod_uom3;
		    		$prod_kemasan = $val->prod_kemasan;
		    		$qty_kemasan = $val->qty_kemasan;
		    	}

		    	if($right->satuan == 1){
		    		$satuan = $uom;
		    	}else if ($right->satuan == 2) {
		    		$satuan = $uom2;
		    	}else if ($right->satuan == 3) {
		    		$satuan = $uom3;
		    	}else{
		    		$satuan = $uom;
		    	}

				$dsn[] = array(
			        	"id_det" => $id_det++,
			        	"prod_no" => $right->prod_no,
			        	"prod_code" => $right->prod_code0,
			        	"prod_name" => $right->prod_name0,
				        "satuan" => $satuan,
				        "qty_satuan" => $right->qty_satuan,
				        "konversi" => (int)$right->konversi,
				        "harga_satuan" => (float)$right->harga_satuan,
				        "price_netto" => (float)$right->price_netto,
				        "keterangan" => $right->keterangan,
				        "qty_pemakaian" => $right->qty_pemakaian,
				        "qty_dibutuhkan" => $right->qty_dibutuhkan,
				        "qty_kemasan"=> ($qty_kemasan == 0 ? 1 : $qty_kemasan),
				        "satuan_pakai" => $right->satuan_pakai,
				        "satuan_butuh" => $right->satuan_butuh,
				        "prod_kemasan" => $prod_kemasan,
				        "is_new" => 0
				);
		    }

		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 1) {
		    	array_push($key['detail'],$post);
		    }
		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 1) {
		    	foreach ($key['detail'] as &$val) {
		    		if($val['id_trans'] == $pid){
		    			for($i = 0; $i < count($dsn); $i++){
		    				array_push($val['detail_trans'],$dsn[$i]);
		    			}
		    		}
		    	}
		    }
		}
		
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);

	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }

		echo json_encode($hasil);
	}

	public function write_edit_detail_bb($prod_no='',$satuan='',$qty_satuan='',$konversi='',$harga_satuan='',$price_netto='',$keterangan='',$qty_pemakaian='',$qty_dibutuhkan='',$satuan_pakai='',$satuan_butuh='',$prod_code0='',$prod_name0='',$prod_uom='',$prod_uom2='',$prod_uom3='',$proses_id = '',$trans_no='')
	{
		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);
	
	    $id_det = (int)$this->get_id_det_trans(1,$proses_id);

		$all = array();
		// $response = array();
	    $post = array();

	    $dsn[] = array(
			        	"id_det" => $id_det++,
			        	"prod_no" => $prod_no,
			        	"prod_code" => $prod_code0,
			        	"prod_name" => $prod_name0,
				        "satuan" => $satuan,
				        "qty_satuan" => (int)$qty_satuan,
				        "konversi" => (int)$konversi,
				        "harga_satuan" => (float)$harga_satuan,
				        "price_netto" => (float)$price_netto,
				        "keterangan" => $keterangan,
				        "qty_pemakaian" => (int)$qty_pemakaian,
				        "qty_dibutuhkan" => (int)$qty_dibutuhkan,
				        "satuan_pakai" => $satuan_pakai,
				        "satuan_butuh" => $satuan_butuh,
				        "is_new" => 0
		);

	    //If the json is correct, you can then write the file and load the view
	    $post = array(
	    	"id_trans" => $proses_id,
			"is_edit" => 1,
			"trans_no" => $trans_no,
	        "detail_trans"   => $dsn
	    );

	    foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 1) {
		    	array_push($key['detail'],$post);
		    }
		}
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);

	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }
	}

	public function update_detail_bahan()
	{
		$id = $this->input->post('id');
		$column = $this->input->post('column');
	    $vl = $this->input->post('value');

	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('bb_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 1){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['id_det'] == ((int)$id)){
								$brg[$column] = $vl;			
							}
						}
					}
				}
			}
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
		
	}

	public function update_qty_detail_bb()
	{
	    $id = $this->input->post('id');
		$qty_paksat = $this->input->post('qty_paksat');
		$qty_kemsat = $this->input->post('qty_kemsat');
		$qty_paksat_input = $this->input->post('qty_paksat_input');
		$qty_kemsat_input = $this->input->post('qty_kemsat_input');
		$qty_pakai = $this->input->post('qty_pakai');
		$qty_butuh = $this->input->post('qty_butuh');
		$qty_hasil = $this->input->post('qty_hasil');
		$prod_kemasan = $this->input->post('prod_kemasan');

	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('bb_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 1){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['id_det'] == ((int)$id)){
								$brg['qty_pemakaian'] = $qty_paksat_input;
								$brg['qty_dibutuhkan'] = $qty_butuh;
								$brg['qty_satuan'] = $qty_hasil;
								$brg['qty_kemasan'] = $qty_kemsat_input;
								$brg['satuan_pakai'] = $qty_paksat;
								$brg['satuan_butuh'] = $qty_kemsat;
								$brg['prod_kemasan'] = $prod_kemasan;
							}
						}
					}
				}
			}
		}

		
		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == 1){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							$total_qty += $brg['qty_satuan'];
							$total_pakai += $brg['qty_pemakaian'];
							$total_butuh += $brg['qty_dibutuhkan'];
						}
					}
				}
			}
		}

		echo json_encode(array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh
		));
	}

	public function getProsesRole()
	{
		$this->session->unset_userdata('role_proses_id');
		$hasil = $this->get_id_proses(2,'role_proses_id');

		return $hasil;
	}

	public function insert_detail_role($id_tr, $trans_no)
	{
		$id_role = $trans_no;

		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);

		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 2){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_tr)){
						foreach ($val['detail_trans'] as &$brg) {
							
							$select = array(
								'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
								'table' => 'tproduct',
								'where' => array('prod_no' => $brg['prod_no'])
							);

					    	$sc = $this->setting_model->commonGet($select);

					    	foreach ($sc as $val) {
					    		$uom = $val->prod_uom;
					    		$uom2 = $val->prod_uom2;
					    		$uom3 = $val->prod_uom3;
					    	}

					    	if($brg['satuan'] == $uom){
					    		$satuan = (int)1;
					    	}else if ($brg['satuan'] == $uom2) {
					    		$satuan = (int)2;
					    	}else if ($brg['satuan'] == $uom3) {
					    		$satuan = (int)3;
					    	}

							$det_no = $this->setting_model->GetNoIDField('now','ID','det_no','td_set_hpp');
							$insert = array(
								'insert' => array('det_no' => $det_no,
												'hap_no' => $id_role,
												'prod_no' => $brg['prod_no'],
												'satuan'=> $satuan,
												'konversi' => $brg['konversi'],
												'harga_satuan' => $brg['harga_satuan'],
												'price_netto' => $brg['price_netto'],
												'keterangan' => $brg['keterangan']
											),
								'table' => 'td_set_hpp'
							);

							$this->setting_model->commonInsert($insert);
						}
					}
				}
			}
		}

		$this->delete_all_detail_role($id_tr);
	}

	public function delete_all_detail_role($pr_id = '')
	{
		if($pr_id == ''){
			$pr_id = $this->input->post('proses_id');
			if($pr_id == ''){
				$pr_id = (int)$this->session->userdata('role_proses_id');
			}
		}
		
		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          if($subKey['id'] == 2){
          	foreach ($subKey['detail'] as $subVal => $valArray) {
				if($valArray['id_trans'] == ((int)$pr_id)){
					unset($subKey['detail'][$subVal]);
				}
			}
          }
     	}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function add_detail_role()
	{
		$proses_id = (int)$this->session->userdata('role_proses_id');
		$tableData = $this->input->post('tableData');

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		if(is_array($tableData)){
			foreach ($tableData as $data) {
				$id_det = $data['id_det'];
				$prod_code = $data['prod_code'];
				$prod_name = $data['prod_name'];
				$satuan = $data['satuan'];
				$harga_satuan = $data['harga_satuan'];
				$keterangan = $data['keterangan'];
				
				foreach ($posts['transaksi'] as &$key) {
			    	if (($key['id']) == 2) {
			    		foreach ($key['detail'] as &$val) {
			    			if($val['id_trans'] == ((int)$proses_id)){
								foreach ($val['detail_trans'] as &$brg) {
									if($brg['id_det'] == $id_det){
										$select = array(
											'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
											'table' => 'tproduct',
											'where' => array('prod_no' => $brg['prod_no'])
										);

								    	$sc = $this->setting_model->commonGet($select);

								    	foreach ($sc as $abc) {
								    		$uom = $abc->prod_uom;
								    		$uom2 = $abc->prod_uom2;
								    		$uom3 = $abc->prod_uom3;
								    		$kon1 = $abc->konversi1;
								    		$kon2 = $abc->konversi2;
								    		$kon3 = $abc->konversi3;
								    	}

								    	if($satuan == $uom){
								    		$satuan = $uom;
								    		$kon = $kon1;
								    	}elseif ($satuan == $uom2) {
								    		$satuan = $uom2;
								    		$kon = $kon2;
								    	}elseif ($satuan == $uom3) {
								    		$satuan = $uom3;
								    		$kon = $kon3;
								    	}else{
								    		$satuan = $uom;
								    		$kon = $kon1;
								    	}

				    					$brg['satuan'] = $satuan;
				    					$brg['konversi'] = $kon;
				    					$brg['harga_satuan'] = $harga_satuan;
				    					$brg['price_netto'] = 0;
				    					$brg['keterangan'] = $keterangan;
									}
								}
							}
			    		}
			    	}
			    }
			}
		}

		$json_body = json_encode($posts);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function fetch_detail_role()
	{
		$data_json = file_get_contents('./transaction_data.json');

        $data = array();
        $dtotp = array();
        $proses_id = 0;
        $proses_id = $this->session->userdata('role_proses_id');
        // $data['json_arr'] = json_decode($data_json, true);
        $json_arr = json_decode($data_json, true);

        $all= '';


        foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 2){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							$select = array(
								'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
								'table' => 'tproduct',
								'where' => array('prod_no' => $brg['prod_no'])
							);

					    	$sc = $this->setting_model->commonGet($select);

					    	foreach ($sc as $abc) {
					    		$uom = $abc->prod_uom;
					    		$uom2 = $abc->prod_uom2;
					    		$uom3 = $abc->prod_uom3;
					    		$kon1 = $abc->konversi1;
					    		$kon2 = $abc->konversi2;
					    		$kon3 = $abc->konversi3;
					    	}

							$sub_array = array();
							$sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="prod_code" data-value="' . $brg['prod_code'] . '">' . $brg['prod_code'] . '</div>';
							$sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="prod_name" data-value="' . $brg['prod_name'] . '">' . $brg['prod_name'] . '</div>';
							$sub_array[] = '<div contenteditable class="update-satuan" data-id="'.$brg['id_det'].'" data-column="satuan" data-value="' . $brg['satuan'] . '" data-uom="'.$uom.'" data-uom2="'.$uom2.'" data-uom3="'.$uom3.'" data-kon1="'.$kon1.'" data-kon2="'.$kon2.'" data-kon3="'.$kon3.'">' . $brg['satuan'] . '</div>';
							$sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="harga_satuan" data-value="' . $brg['harga_satuan'] . '">' . $brg['harga_satuan'] . '</div>';
							$sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="keterangan" data-value="' . $brg['keterangan'] . '">' . $brg['keterangan'] . '</div>';
							$sub_array[] = '<a class="delete" name="delete" id="'.$brg['id_det'].'" href="" style="margin-right:15px;"><i class="fa fa-times"></i></a>';
							$dtotp[] = $sub_array;
						}
						$all = count(array($val['detail_trans']));
					}
					
				}
			}
		}

		$output = array(
		 "recordsTotal"  =>  $all,
		 "recordsFiltered" => $all,
		 "data"    => $dtotp
		);

		echo json_encode($output);
	}

	public function update_detail_role()
	{
		$id = $this->input->post('id');
		$column = $this->input->post('column');
	    $vl = $this->input->post('value');

	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('role_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 2){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['id_det'] == ((int)$id)){
								$brg[$column] = $vl;
							}
						}
					}
				}
			}
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
		
	}

	public function update_detail_role_mnf($id_tr, $trans_no)
	{
		$all_id_brg = array();

		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 2){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_tr)){
						foreach ($val['detail_trans'] as &$brg) {

							$select = array(
								'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
								'table' => 'tproduct',
								'where' => array('prod_no' => $brg['prod_no'])
							);

					    	$sc = $this->setting_model->commonGet($select);

					    	foreach ($sc as $val) {
					    		$uom = $val->prod_uom;
					    		$uom2 = $val->prod_uom2;
					    		$uom3 = $val->prod_uom3;
					    	}

					    	if($brg['satuan'] == $uom){
					    		$satuan = (int)1;
					    	}else if ($brg['satuan'] == $uom2) {
					    		$satuan = (int)2;
					    	}else if ($brg['satuan'] == $uom3) {
					    		$satuan = (int)3;
					    	}

							if($brg['is_new'] === 1){
								$insert = array(
									'insert' => array('det_no' => $det_no,
													'hap_no' => $trans_no,
													'prod_no' => $brg['prod_no'],
													'satuan'=> $satuan,
													'konversi' => $brg['konversi'],
													'harga_satuan' => $brg['harga_satuan'],
													'price_netto' => $brg['price_netto'],
													'keterangan' => $brg['keterangan']
												),
									'table' => 'td_set_hpp'
								);
								
								$ins = $this->setting_model->commonInsert($insert);
								
							}else{
								$update = array(
									'update' => array('satuan'=> $satuan,
													'konversi' => $brg['konversi'],
													'harga_satuan' => $brg['harga_satuan'],
													'price_netto' => $brg['price_netto'],
													'keterangan' => $brg['keterangan']
												),
									'table' => 'td_set_hpp',
									'where' => array('td_set_hpp.hap_no' => $trans_no, 
				    					'td_set_hpp.prod_no' => $brg['prod_no'])
								);
								$up = $this->setting_model->commonUpdate($update);
							}

							$all_id_brg[] = $brg['prod_no'];
						}

					}
				}
			}
		}

		$delete = array(
			'table' => 'td_set_hpp',
			'where_not_in' => array('td_set_hpp.prod_no' => $all_id_brg),
			'where' => array('td_set_hpp.hpp_no' => $trans_no)
		);
		$this->setting_model->commonDelete($delete);

		$this->delete_all_detail_role($id_tr);
	}

	public function testup()
	{
		$update = array(
				'update' => array(
					'is_delete' => 0
				),
				'table' => 'tset_hpp',
				'where' => array(
					'tset_hpp.hap_no' => 'HR-23321-173359-0001'
				)
		);
    	$this->setting_model->commonUpdate($update);
    	$this->update_detail_role_mnf('1', 'HR-23321-173359-0001');

    	$select = array(
    		"select" => array('b.*'),
    		"table" => 'tset_hpp a',
    		"join"=> array('td_set_hpp b' => 'a.hap_no = b.hap_no'),
    		"where"=> array('a.hap_no' => 'HR-23321-173359-0001')
    	);

    	$get = $this->setting_model->commonGet($select);

    	foreach ($get as $key) {
    		echo json_encode(array(
    			"hap_no" => $key->hap_no,
    			"prod_no"=> $key->prod_no,
    			"satuan"=> $key->satuan,
    			"konversi"=> $key->konversi,
    			"harga"=> $key->harga_satuan
    		));
    	}
	}

	public function action_rolemnf()
	{
		$date = $this->input->post('date');
		$stt = strtotime($date);
        $sec = date("s");
        // $rsl = date('Y-m-d',$stt);
		$rsl = (str_replace("T"," ",$date)).":".$sec;

		if($this->input->post('type')==2){
			$rsl = (str_replace("T"," ",$date));
		}

		if($this->input->post('type')==1){
			$trans_no = $this->setting_model->GetNoIDField($rsl,'HR','hap_no','tset_hpp');
		}

		$id_role =$this->input->post('id_role');
		$ket=$this->input->post('ket');
		$id_tr = $this->session->userdata('role_proses_id');
		$user_id = $this->session->userdata('person_id');
		$now = date('Y-m-d H:i:s');

		$user_right = '';
		if($this->input->post('type')==1){// insert
			$insert = array(
				'insert' => array(
					'create_date' => $now,
					'hap_no' => $trans_no,
					'tgl' => $date,
					'keterangan' => $ket,
					'user_id'=> $user_id,
					'is_delete' => 0
				),
				'table' => 'tset_hpp'
			);

        	$this->setting_model->commonInsert($insert);
        	$this->insert_detail_role($id_tr, $trans_no);

        	echo json_encode(array(
				"statusCode"=>200,
				"trans_no" => $trans_no,
			));
		}elseif($this->input->post('type')==2) {//update
			$update = array(
					'update' => array(
						'edit_date' => $now,
						'tgl' => $date,
						'keterangan' => $ket,
						'user_edit'=> $user_id,
						'is_delete' => 0
					),
					'table' => 'tset_hpp',
					'where' => array(
						'tset_hpp.hap_no' => $id_role
					)
			);
        	$this->setting_model->commonUpdate($update);
        	$this->update_detail_role_mnf($id_tr, $id_role);

			echo json_encode(array(
				"statusCode"=>201,
				"trans_no" => $id_role
			));
		}elseif($this->input->post('type')==3) {//delete

			 foreach($id_role as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1,
							'delete_date' => $now,
							'user_delete'=> $user_id,
						),
						'table' => 'tset_hpp',
						'where' => array(
							'tset_hpp.hap_no' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}elseif($this->input->post('type')==4) {//arsip

			 foreach($id_role as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1,
							'delete_date' => $now,
							'user_delete'=> $user_id,
						),
						'table' => 'tset_hpp',
						'where' => array(
							'tset_hpp.hap_no' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}
	}

	public function delete_role_detail($id_det = "")
	{
		if($id_det == ''){
			$id_det = $this->input->post('id_det');
		}
		$proses_id = 0;
        $proses_id = $this->session->userdata('role_proses_id');
		// get array index to delete
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          	if($subKey['id'] == 2){
          		foreach ($subKey['detail'] as &$subVal) {
					if($subVal['id_trans'] == ((int)$proses_id)){
						foreach ($subVal['detail_trans'] as $brg => $subArray) {
							if($subArray['id_det'] == (int)$id_det){
					           unset($subVal['detail_trans'][$brg]);
					        }
						}
					}
				}
			}
		}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function get_edit_data_role()
	{
		$id_role = $this->input->post('id_role');
		$hasil = array();
		$data = array();
		$trans_no = '';

		$proses_id = (int)$this->getProsesRole();
		$pid = $proses_id;
		
		$option = array(
			'select' => array(
								'tset_hpp.hap_no',
								'tset_hpp.tgl',
								'tset_hpp.keterangan'
							),
	    	'table' => 'tset_hpp',
	    	'where'	=>array('tset_hpp.hap_no' => $id_role)
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);
		if (is_array($data['get_data']) || is_object($data['get_data'])){
		    foreach($data['get_data'] as $right) {
		    	$hasil['parent_prod'] = array(
					"trans_date" => $right->tgl,
					"trans_no" => $right->hap_no,
					"keterangan" => $right->keterangan
				);
				$trans_no = $right->hap_no;
		    }
		}

		$option2 = array(
			'select' => array(
								'td_set_hpp.det_no',
								'td_set_hpp.hap_no',
								'td_set_hpp.prod_no',
								'td_set_hpp.satuan',
								'td_set_hpp.konversi',
								'td_set_hpp.harga_satuan',
								'td_set_hpp.price_netto',
								'td_set_hpp.keterangan',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3'
							),
	    	'table' => 'td_set_hpp',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = td_set_hpp.prod_no'),
	    	'where'	=>array('td_set_hpp.hap_no' => $trans_no)
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);

		$dsntmp = array();

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		$all = array();
		// $response = array();
	    $post = array();

	    $post = array(
	    	"id_trans" => $pid,
			"is_edit" => 1,
			"trans_no" => $trans_no,
	        "detail_trans"   => $dsntmp
	    );

		$dsn = array();

		$satuan = '';

		$id_det = (int)$this->get_id_det_trans(2,$proses_id);

		if (is_array($data['get_unit']) || is_object($data['get_unit'])){
		    foreach($data['get_unit'] as $right) {
				$select = array(
					'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
					'table' => 'tproduct',
					'where' => array('prod_no' => $right->prod_no)
				);

		    	$sc = $this->setting_model->commonGet($select);

		    	foreach ($sc as $val) {
		    		$uom = $val->prod_uom;
		    		$uom2 = $val->prod_uom2;
		    		$uom3 = $val->prod_uom3;
		    	}

		    	if($right->satuan == 1){
		    		$satuan = $uom;
		    	}else if ($right->satuan == 2) {
		    		$satuan = $uom2;
		    	}else if ($right->satuan == 3) {
		    		$satuan = $uom3;
		    	}

				$dsn[] = array(
			        	"id_det" => $id_det++,
			        	"prod_no" => $right->prod_no,
			        	"prod_code" => $right->prod_code0,
			        	"prod_name" => $right->prod_name0,
				        "satuan" => $satuan,
				        "konversi" => (int)$right->konversi,
				        "harga_satuan" => (float)$right->harga_satuan,
				        "price_netto" => (float)$right->price_netto,
				        "keterangan" => $right->keterangan,
				        "is_new" => 0
				);
		    }

		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 2) {
		    	array_push($key['detail'],$post);
		    }
		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 2) {
		    	foreach ($key['detail'] as &$val) {
		    		if($val['id_trans'] == $pid){
		    			for($i = 0; $i < count($dsn); $i++){
		    				array_push($val['detail_trans'],$dsn[$i]);
		    			}
		    		}
		    	}
		    }
		}
		
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);

	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }

		echo json_encode($hasil);
	}

	public function insert_detailrole()
	{
		$id_proses = 0;

		$id_proses = (int)$this->session->userdata('role_proses_id');

		if($id_proses <> 0 or $id_proses <> '' ){
			$id_proses = (int)$this->session->userdata('role_proses_id');
		}else{
			$id_proses = $this->get_id_proses(2,'role_proses_id');
		}
		
		$id_brg = $this->input->post('id_brg');
		$id_role = $this->input->post('id_role');

		$is_new = 1;

		if($id_role <> '' ){
			$is_new = 0;
		}


		$posts = array();
	    $post = array();
	    $dsn = array();

	    $exist = 0;

	    $uom = '';
	    $kon = 0;

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

	    $id_det = (int)$this->get_id_det_trans(2,$id_proses);

	    foreach($id_brg as $id){
	    	$option = array(
				'select' => array('tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3'),
		    	'table' => 'tproduct',
		    	'where'	=>array('tproduct.prod_no' => $id)
		    );

			$get_prod = $this->setting_model->commonGet($option);

			if (is_array($get_prod) || is_object($get_prod)){
				
				foreach ($get_prod as $key) {
					$select = array(
						'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
						'table' => 'tproduct',
						'where' => array('prod_no' => $id)
					);

			    	$sc = $this->setting_model->commonGet($select);

			    	foreach ($sc as $val) {
			    		$uom = $val->prod_uom;
			    		$kon = $val->prod_uom;
			    	}

				    $dsn[] = array(
					    		"id_det" => $id_det++,
					        	"prod_no" => $key->prod_no,
					        	"prod_code" => $key->prod_code0,
					        	"prod_name" => $key->prod_name0,
						        "satuan" => $uom,
						        "konversi" => $kon,
						        "harga_satuan" => 0,
						        "price_netto" => 0,
						        "keterangan" => "",
						        "is_new" => $is_new
				    );
				}
			}
	    }

	    $post = array(
	    	"id_trans" => $id_proses,
			"is_edit" => 0,
			"trans_no" => "",
	        "detail_trans"   => $dsn
	    );

	    $is_exist = 0;
	    foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 2) {
		    	foreach ($key['detail'] as $val) {
		    		if($val['id_trans'] == $id_proses){
		    			$is_exist = 1;
		    		}
		    	}
		    }
		}

		if($is_exist == 1){
			foreach ($posts['transaksi'] as &$key) {
			    if (($key['id']) == 2) {
			    	foreach ($key['detail'] as &$val) {
			    		if($val['id_trans'] == $id_proses){
			    			for($i = 0; $i < count($dsn); $i++){
			    				array_push($val['detail_trans'],$dsn[$i]);	
			    			}
			    		}
			    	}
			    }
			}
		}else{
			foreach ($posts['transaksi'] as &$key) {
			    if (($key['id']) == 2) {
			    	array_push($key['detail'],$post);
			    }
			}
		}
	    
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);

	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }
	}

	public function getProsesMnf()
	{
		$this->session->unset_userdata('mnf_proses_id');
		$hasil = $this->get_id_proses(3,'mnf_proses_id');

		return $hasil;
	}

	public function get_bb_mnf()
	{
		$id_bb = $this->input->post('id_bb');
		$tgl = $this->input->post('tgl');
		$data = array();

		$proses_id = 0;
        $proses_id = $this->session->userdata('mnf_proses_id');
		
		if($proses_id == '' OR $proses_id == 0){
			$proses_id = (int)$this->getProsesMnf();	
		}else{
			$proses_id = $this->session->userdata('mnf_proses_id');
			$this->delete_detail_mnf($proses_id);
		}

		$pid = $proses_id;	
		
		$option2 = array(
			'select' => array(
								'td_set_bb.*',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3',
								'tproduct.qty_kemasan',
								'tproduct.prod_sell_price'
							),
	    	'table' => 'td_set_bb',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = td_set_bb.prod_no'),
	    	'where'	=>array('td_set_bb.bb_no' => $id_bb)
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);

		$dsntmp = array();

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		$all = array();
		// $response = array();
	    $post = array();

	    $post = array(
	    	"id_trans" => $pid,
			"is_edit" => 0,
			"trans_no" => "",
	        "detail_trans"   => $dsntmp
	    );

		$dsn = array();

		$id_det = (int)$this->get_id_det_trans(3,$proses_id);

		if (is_array($data['get_unit']) || is_object($data['get_unit'])){
		    foreach($data['get_unit'] as $right) {
				$select = array(
					'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
					'table' => 'tproduct',
					'where' => array('prod_no' => $right->prod_no)
				);

		    	$sc = $this->setting_model->commonGet($select);

		    	foreach ($sc as $val) {
		    		$uom = $val->prod_uom;
		    		$uom2 = $val->prod_uom2;
		    		$uom3 = $val->prod_uom3;
		    		$konv = $val->konversi1;
		    		$konv2 = $val->konversi2;
		    		$konv3 = $val->konversi3;
		    	}

		    	if($right->satuan == 1){
		    		$satuan = $uom;
		    		$konversi = $konv;
		    	}else if ($right->satuan == 2) {
		    		$satuan = $uom2;
		    		$konversi = $konv2;
		    	}else if ($right->satuan == 3) {
		    		$satuan = $uom3;
		    		$konversi = $konv3;
		    	}

				$dsn[] = array(
			        	"id_det" => $id_det++,
			        	"jenis_brg" => "",
			        	"prod_no" => $right->prod_no,
			        	"prod_code" => $right->prod_code0,
			        	"prod_name" => $right->prod_name0,
				        "satuan" => $satuan,
				        "qty_satuan" => $right->qty_satuan,
				        "konversi" => (int)$konversi,
				        "harga_satuan" => (float)$right->harga_satuan,
				        "harga_last" => $this->setting_model->GetLastHarga($right->prod_no, $tgl),
				        "harga_jual" => (float)$right->prod_sell_price,
				        "det_total1" => (float)($this->setting_model->GetLastHarga($right->prod_no, $tgl))*$right->qty_satuan,
				        "det_total2" => (float)$right->prod_sell_price * $right->qty_satuan,
				        "keterangan" => $right->keterangan,
				        "qty_default" => $right->qty_satuan,
				        "qty_kemasan" => ($right->qty_kemasan == 0 || is_null($right->qty_kemasan)  ? 1 : $right->qty_kemasan),
				        "qty_pemakaian" => $right->qty_pemakaian,
				        "qty_dibutuhkan" => $right->qty_dibutuhkan,
				        "satuan_pakai" => $right->satuan_pakai,
				        "satuan_butuh" => $right->satuan_butuh,
				        "is_new" => 1,
				        "jenis_tbl" => "bb"
				);
		    }

		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 3) {
		    	array_push($key['detail'],$post);
		    }
		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 3) {
		    	foreach ($key['detail'] as &$val) {
		    		if($val['id_trans'] == $pid){
		    			for($i = 0; $i < count($dsn); $i++){
		    				array_push($val['detail_trans'],$dsn[$i]);
		    			}
		    		}
		    	}
		    }
		}
		
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);

	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }

	}

	public function fetch_bb_mnf()
	{
		$data_json = file_get_contents('./transaction_data.json');

        $data = array();
        $dtotp = array();
        $proses_id = 0;
        $proses_id = $this->session->userdata('mnf_proses_id');
        // $data['json_arr'] = json_decode($data_json, true);
        $json_arr = json_decode($data_json, true);

        $all= '';

        $a = 0;

        foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl']=="bb"){
								$select = array(
									'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
									'table' => 'tproduct',
									'where' => array('prod_no' => $brg['prod_no'])
								);

						    	$sc = $this->setting_model->commonGet($select);

						    	foreach ($sc as $abc) {
						    		$uom = $abc->prod_uom;
						    		$uom2 = $abc->prod_uom2;
						    		$uom3 = $abc->prod_uom3;
						    		$kon1 = $abc->konversi1;
						    		$kon2 = $abc->konversi2;
						    		$kon3 = $abc->konversi3;
						    	}

								$sub_array = array();
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="prod_code" data-value="' . $brg['prod_code'] . '">' . $brg['prod_code'] . '</div>';
								$sub_array[] = '<div  data-id="'.$brg['id_det'].'" data-column="prod_name" data-value="' . $brg['prod_name'] . '">' . $brg['prod_name'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-bb-satuan" data-id="'.$brg['id_det'].'" data-column="satuan" data-value="' . $brg['satuan'] . '" data-uom="'.$uom.'" data-uom2="'.$uom2.'" data-uom3="'.$uom3.'" data-kon1="'.$kon1.'" data-kon2="'.$kon2.'" data-kon3="'.$kon3.'">' . $brg['satuan'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-qty-bb" data-id="'.$brg['id_det'].'" data-column="qty_satuan" data-value="' . $brg['qty_satuan'] . '">' . $brg['qty_satuan'] . '</div>';
								// $sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="keterangan" data-value="' . $brg['keterangan'] . '">' . $brg['keterangan'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-bb-harga" data-id="'.$brg['id_det'].'" data-column="harga_last" data-value="' . $brg['harga_last'] . '">' . round($brg['harga_last'],5) . '</div>';
								$sub_array[] = '<div class="update-bb" data-id="'.$brg['id_det'].'" data-column="det_total1" data-value="' . $brg['det_total1'] . '">' . round($brg['det_total1'],5) . '</div>';
								$sub_array[] = '<a class="delete-bb" name="delete-bb" id="'.$brg['id_det'].'" href="" style="margin-right:15px;"><i class="fa fa-times"></i></a>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="qty_kemasan" data-value="' . $brg['qty_kemasan'] . '">' . $brg['qty_kemasan'] . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="qty_pemakaian" data-value="' . $brg['qty_pemakaian'] . '">' . $brg['qty_pemakaian'] . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="qty_dibutuhkan" data-value="' . $brg['qty_dibutuhkan'] . '">' . $brg['qty_dibutuhkan'] . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="harga_jual" data-value="' . $brg['harga_jual'] . '">' . round($brg['harga_jual'], 5) . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="det_total2" data-value="' . $brg['det_total2'] . '">' . round($brg['det_total2'],5) . '</div>';
								$dtotp[] = $sub_array;

								$a++;
							}
							
						}
						$all = (int)$a;
					}
					
				}
			}
		}

		$output = array(
		 "recordsTotal"  =>  $all,
		 "recordsFiltered" => $all,
		 "data"    => $dtotp
		);

		echo json_encode($output);
	}

	public function fetch_proses_mnf()
	{
		$data_json = file_get_contents('./transaction_data.json');

        $data = array();
        $dtotp = array();
        $proses_id = 0;
        $proses_id = $this->session->userdata('mnf_proses_id');
        // $data['json_arr'] = json_decode($data_json, true);
        $json_arr = json_decode($data_json, true);

        $all= '';

        $a = 0;

        foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl']=="mnf"){
								$select = array(
									'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
									'table' => 'tproduct',
									'where' => array('prod_no' => $brg['prod_no'])
								);

						    	$sc = $this->setting_model->commonGet($select);

						    	foreach ($sc as $abc) {
						    		$uom = $abc->prod_uom;
						    		$uom2 = $abc->prod_uom2;
						    		$uom3 = $abc->prod_uom3;
						    		$kon1 = $abc->konversi1;
						    		$kon2 = $abc->konversi2;
						    		$kon3 = $abc->konversi3;
						    	}

								$sub_array = array();
								$sub_array[] = '<div contenteditable class="update-mnf" data-id="'.$brg['id_det'].'" data-column="prod_code" data-value="' . $brg['prod_code'] . '">' . $brg['prod_code'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-mnf" data-id="'.$brg['id_det'].'" data-column="prod_name" data-value="' . $brg['prod_name'] . '">' . $brg['prod_name'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-mnf-satuan" data-id="'.$brg['id_det'].'" data-column="satuan" data-value="' . $brg['satuan'] . '" data-uom="'.$uom.'" data-uom2="'.$uom2.'" data-uom3="'.$uom3.'" data-kon1="'.$kon1.'" data-kon2="'.$kon2.'" data-kon3="'.$kon3.'">' . $brg['satuan'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-qty-mnf" data-id="'.$brg['id_det'].'" data-column="qty_satuan" data-value="' . $brg['qty_satuan'] . '">' . $brg['qty_satuan'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-mnf-jb" data-id="'.$brg['id_det'].'" data-column="jenis_brg" data-value="' . $brg['jenis_brg'] . '">' . $brg['jenis_brg'] . '</div>';
								$sub_array[] = '<a class="delete-mnf" name="delete-mnf" id="'.$brg['id_det'].'" href="" style="margin-right:15px;"><i class="fa fa-times"></i></a>';
								$sub_array[] = '<div class="update-kemasan-mnf" data-id="'.$brg['id_det'].'" data-column="qty_kemasan" data-value="' . $brg['qty_kemasan'] . '">' . $brg['qty_kemasan'] . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="harga_jual" data-value="' . $brg['harga_jual'] . '">' . round($brg['harga_jual'],5) . '</div>';
								$sub_array[] = '<div class="update-mnf" data-id="'.$brg['id_det'].'" data-column="det_total2" data-value="' . $brg['det_total2'] . '">' . round($brg['det_total2'],5) . '</div>';
								$dtotp[] = $sub_array;

								$a++;
							}
							
						}
						$all = (int)$a;
					}
					
				}
			}
		}

		$output = array(
		 "recordsTotal"  =>  $all,
		 "recordsFiltered" => $all,
		 "data"    => $dtotp
		);

		echo json_encode($output);
	}

	public function add_detail_mnf_bb()
	{
		$proses_id = (int)$this->session->userdata('mnf_proses_id');
		$tableData = $this->input->post('tableData');
		$type = $this->input->post('type');

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		if(is_array($tableData)){
			foreach ($tableData as $data) {
				$id_det = $data['id_det'];
				$prod_code = $data['prod_code'];
				$prod_name = $data['prod_name'];
				$satuan = $data['satuan'];
				$qty_satuan = $data['qty_satuan'];
				$harga_last = $data['harga_last'];
				$det_total1 = $data['det_total1'];
				$qty_kemasan = $data['qty_kemasan'];
				$qty_pemakaian = $data['qty_pemakaian'];
				$qty_dibutuhkan = $data['qty_dibutuhkan'];
				$harga_jual = $data['harga_jual'];
				$det_total2 = $data['det_total2'];
				
				foreach ($posts['transaksi'] as &$key) {
			    	if (($key['id']) == (int)$type) {
			    		foreach ($key['detail'] as &$val) {
			    			if($val['id_trans'] == ((int)$proses_id)){
								foreach ($val['detail_trans'] as &$brg) {
									if($brg['id_det'] == $id_det){
										$select = array(
											'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
											'table' => 'tproduct',
											'where' => array('prod_no' => $brg['prod_no'])
										);

								    	$sc = $this->setting_model->commonGet($select);

								    	foreach ($sc as $abc) {
								    		$uom = $abc->prod_uom;
								    		$uom2 = $abc->prod_uom2;
								    		$uom3 = $abc->prod_uom3;
								    		$kon1 = $abc->konversi1;
								    		$kon2 = $abc->konversi2;
								    		$kon3 = $abc->konversi3;
								    	}

								    	if($satuan == $uom){
								    		$satuan = $uom;
								    		$kon = $kon1;
								    	}elseif ($satuan == $uom2) {
								    		$satuan = $uom2;
								    		$kon = $kon2;
								    	}elseif ($satuan == $uom3) {
								    		$satuan = $uom3;
								    		$kon = $kon3;
								    	}else{
								    		$satuan = $uom;
								    		$kon = $kon1;
								    	}

				    					$brg['satuan'] = $satuan;
				    					$brg['qty_satuan'] = $qty_satuan;
				    					$brg['konversi'] = $kon;
				    					$brg['harga_last'] = $harga_last;
				    					$brg['det_total1'] = $det_total1;
				    					$brg['qty_kemasan'] = $qty_kemasan;
				    					$brg['qty_pemakaian'] = $qty_pemakaian;
				    					$brg['qty_dibutuhkan'] = $qty_dibutuhkan;
				    					$brg['harga_jual'] = $harga_jual;
				    					$brg['det_total2'] = $det_total2;
									}
								}
							}
			    		}
			    	}
			    }
			}
		}

		$json_body = json_encode($posts);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function add_detail_mnf()
	{
		$proses_id = (int)$this->session->userdata('mnf_proses_id');
		$tableData = $this->input->post('tableData');
		$type = $this->input->post('type');

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		if(is_array($tableData)){
			foreach ($tableData as $data) {
				$id_det = $data['id_det'];
				$prod_code = $data['prod_code'];
				$prod_name = $data['prod_name'];
				$satuan = $data['satuan'];
				$qty_satuan = $data['qty_satuan'];
				$jenis_brg = $data['jenis_brg'];
				$qty_kemasan = $data['qty_kemasan'];
				$harga_jual = $data['harga_jual'];
				$det_total2 = $data['det_total2'];
				
				foreach ($posts['transaksi'] as &$key) {
			    	if (($key['id']) == (int)$type) {
			    		foreach ($key['detail'] as &$val) {
			    			if($val['id_trans'] == ((int)$proses_id)){
								foreach ($val['detail_trans'] as &$brg) {
									if($brg['id_det'] == $id_det){
										$select = array(
											'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
											'table' => 'tproduct',
											'where' => array('prod_no' => $brg['prod_no'])
										);

								    	$sc = $this->setting_model->commonGet($select);

								    	foreach ($sc as $abc) {
								    		$uom = $abc->prod_uom;
								    		$uom2 = $abc->prod_uom2;
								    		$uom3 = $abc->prod_uom3;
								    		$kon1 = $abc->konversi1;
								    		$kon2 = $abc->konversi2;
								    		$kon3 = $abc->konversi3;
								    	}

								    	if($satuan == $uom){
								    		$satuan = $uom;
								    		$kon = $kon1;
								    	}elseif ($satuan == $uom2) {
								    		$satuan = $uom2;
								    		$kon = $kon2;
								    	}elseif ($satuan == $uom3) {
								    		$satuan = $uom3;
								    		$kon = $kon3;
								    	}else{
								    		$satuan = $uom;
								    		$kon = $kon1;
								    	}

				    					$brg['satuan'] = $satuan;
				    					$brg['qty_satuan'] = $qty_satuan;
				    					$brg['konversi'] = $kon;
				    					$brg['qty_kemasan'] = $qty_kemasan;
				    					$brg['harga_jual'] = $harga_jual;
				    					$brg['det_total2'] = $det_total2;
									}
								}
							}
			    		}
			    	}
			    }
			}
		}

		$json_body = json_encode($posts);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function delete_bb_mnf($id_det = "")
	{
		if($id_det == ''){
			$id_det = $this->input->post('id_det');
		}
		$tbl = $this->input->post('tbl');
		$proses_id = 0;
        $proses_id = $this->session->userdata('mnf_proses_id');
		// get array index to delete
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          	if($subKey['id'] == 3){
          		foreach ($subKey['detail'] as &$subVal) {
					if($subVal['id_trans'] == ((int)$proses_id)){
						foreach ($subVal['detail_trans'] as $brg => $subArray) {
							if($subArray['id_det'] == (int)$id_det && $subArray['jenis_tbl'] == $tbl){
					           unset($subVal['detail_trans'][$brg]);
					        }
						}
					}
				}
			}
		}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;
		$total_hj = 0;
		$total_sub = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$total_qty += $brg['qty_satuan'];
								$total_pakai += $brg['qty_pemakaian'];
								$total_butuh += $brg['qty_dibutuhkan'];
								$total_hj += $brg['harga_jual'];
								$total_sub += $brg['det_total2'];
							}
						}
					}
				}
			}
		}

		echo json_encode(array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh,
			"harga_jual" =>$total_hj,
			"sub_total" =>$total_sub
		));
	}

	public function update_bb_mnf()
	{
		$id = $this->input->post('id');
		$column = $this->input->post('column');
	    $vl = $this->input->post('value');
	    $tbl = $this->input->post('tbl');
	    $bb_no = $this->input->post('bb_no');

	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('mnf_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$total = (float)0;

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['id_det'] == ((int)$id) && $brg['jenis_tbl'] == $tbl){
								$brg[$column] = $vl;
								if($column == "qty_satuan"){
									if($tbl == "bb"){
										$brg["det_total1"] = ((float)$brg['qty_satuan'] * (float)$brg['harga_last']);
									}
									$brg["det_total2"] = ((float)$brg['qty_satuan'] * (float)$brg['harga_jual']);
								}else if($column == "harga_last"){
									$brg["det_total1"] = ((float)$brg['qty_satuan'] * (float)$brg['harga_last']);
								}
							}
						}
					}
				}
			}
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
		
		// $this->update_qty($id, $column, $vl, $tbl, $bb_no);
	}

	public function update_qty($id='',$column='',$vl='',$tbl='',$bb_no='')
	{
		$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('mnf_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$total = (float)0;

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {

							$total  = array_sum($brg['qty_satuan']);

							if($tbl == 'mnf'){
								if($column == 'qty_satuan'){
									if($brg['jenis_tbl'] == 'bb'){
										$option = array(
											'select' => array(
																'td_set_bb.*',
																'tproduct.prod_code0',
																'tproduct.prod_name0',
																'tproduct.prod_uom',
																'tproduct.prod_uom2',
																'tproduct.prod_uom3',
																'tproduct.qty_kemasan',
																'tproduct.prod_sell_price'
															),
									    	'table' => 'td_set_bb',
									    	'join' => array(
									    					'tproduct' => 'tproduct.prod_no = td_set_bb.prod_no'),
									    	'where'	=>array('td_set_bb.bb_no' => $bb_no)
									    );

										$getbb = $this->setting_model->commonGet($option);
										if(is_array($getbb) || is_object($getbb)){
											foreach ($getbb as $key) {
												$brg['qty_satuan'] = ((float)$total * (float)$key->qty_satuan);
											}
										}

										$brg["det_total1"] = ((float)$brg['qty_satuan'] * (float)$brg['harga_last']);
									}
								}
							}
						}
					}
				}
			}
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function delete_detail_mnf($pr_id = '')
	{
		if($pr_id == ''){
			$pr_id = $this->input->post('proses_id');
			if($pr_id == ''){
				$pr_id = (int)$this->session->userdata('mnf_proses_id');
			}
		}
		
		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          if($subKey['id'] == 3){
          	foreach ($subKey['detail'] as $subVal => $valArray) {
				if($valArray['id_trans'] == ((int)$pr_id)){
					unset($subKey['detail'][$subVal]);
				}
			}
          }
     	}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function delete_detail_mnf_reset($pr_id = '')
	{
		if($pr_id == ''){
			$pr_id = $this->input->post('proses_id');
			if($pr_id == ''){
				$pr_id = (int)$this->session->userdata('mnf_proses_id');
			}
		}
		
		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          if($subKey['id'] == 3){
          	foreach ($subKey['detail'] as &$subVal) {
				if($subVal['id_trans'] == ((int)$pr_id)){
					foreach ($subVal['detail_trans'] as $key => $value) {
						unset($subVal['detail_trans'][$key]);
					}
				}
			}
          }
     	}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function insert_detail_mnf()
	{
		$id_proses = 0;

		$id_proses = (int)$this->session->userdata('mnf_proses_id');

		if($id_proses <> 0 or $id_proses <> '' ){
			$id_proses = (int)$this->session->userdata('mnf_proses_id');
		}else{
			$id_proses = $this->get_id_proses(3,'mnf_proses_id');
		}
		
		$id_brg = $this->input->post('id_brg');
		$id_mnf = $this->input->post('id_mnf');
		$tgl = $this->input->post('tgl');
		$type = $this->input->post('type');

		$is_new = 1;

		if($id_mnf <> '' ){
			$is_new = 0;
		}


		$posts = array();
	    $post = array();
	    $dsn = array();

	    $exist = 0;

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

	    $id_det = (int)$this->get_id_det_trans(3,$id_proses);

	    foreach($id_brg as $id){
	    	$option = array(
				'select' => array('tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3',
								'tproduct.qty_kemasan',
								'tproduct.prod_sell_price',
								'tproduct.konversi1',
								'tproduct.konversi2',
								'tproduct.konversi3'),
		    	'table' => 'tproduct',
		    	'where'	=>array('tproduct.prod_no' => $id)
		    );

			$get_prod = $this->setting_model->commonGet($option);

			if (is_array($get_prod) || is_object($get_prod)){
				
				foreach ($get_prod as $key) {
					if($type == 'bb'){
						$dsn[] = array(
					        	"id_det" => $id_det++,
					        	"jenis_brg" => "",
					        	"prod_no" => $key->prod_no,
					        	"prod_code" => $key->prod_code0,
					        	"prod_name" => $key->prod_name0,
						        "satuan" => $key->prod_uom,
						        "qty_satuan" => 1,
						        "konversi" => $key->konversi1,
						        "harga_satuan" => 0,
						        "harga_last" => $this->setting_model->GetLastHarga($key->prod_no, $tgl),
						        "harga_jual" => (float)$key->prod_sell_price,
						        "det_total1" => 1 * (float)$key->prod_sell_price,
						        "det_total2" => (float)$key->prod_sell_price * 0,
						        "keterangan" => "",
						        "qty_default" => 0,
						        "qty_kemasan" => (is_null($key->qty_kemasan) ? 0 : $key->qty_kemasan),
						        "qty_pemakaian" => 0,
						        "qty_dibutuhkan" => 0,
						        "satuan_pakai" => "",
						        "satuan_butuh" => "",
						        "is_new" => $is_new,
						        "jenis_tbl" => "bb"
						);
					}else if($type == 'mnf'){
						$dsn[] = array(
					        	"id_det" => $id_det++,
					        	"jenis_brg" => "Rote",
					        	"prod_no" => $key->prod_no,
					        	"prod_code" => $key->prod_code0,
					        	"prod_name" => $key->prod_name0,
						        "satuan" => $key->prod_uom,
						        "qty_satuan" => 1,
						        "konversi" => $key->konversi1,
						        "harga_satuan" => 0,
						        "harga_last" => $this->setting_model->GetLastHarga($key->prod_no, $tgl),
						        "harga_jual" => (float)$key->prod_sell_price,
						        "det_total1" => 1 * (float)$key->prod_sell_price,
						        "det_total2" => (float)$key->prod_sell_price * 0,
						        "keterangan" => "",
						        "qty_default" => 0,
						        "qty_kemasan" => (is_null($key->qty_kemasan) ? 0 : $key->qty_kemasan),
						        "qty_pemakaian" => 0,
						        "qty_dibutuhkan" => 0,
						        "satuan_pakai" => "",
						        "satuan_butuh" => "",
						        "is_new" => $is_new,
						        "jenis_tbl" => "mnf"
						);
					}

					
				}
			}
	    }

	    $post = array(
	    	"id_trans" => $id_proses,
			"is_edit" => 0,
			"trans_no" => "",
	        "detail_trans"   => $dsn
	    );

	    $is_exist = 0;
	    foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 3) {
		    	foreach ($key['detail'] as $val) {
		    		if($val['id_trans'] == $id_proses){
		    			$is_exist = 1;
		    		}
		    	}
		    }
		}

		if($is_exist == 1){
			foreach ($posts['transaksi'] as &$key) {
			    if (($key['id']) == 3) {
			    	foreach ($key['detail'] as &$val) {
			    		if($val['id_trans'] == $id_proses){
			    			for($i = 0; $i < count($dsn); $i++){
			    				array_push($val['detail_trans'],$dsn[$i]);	
			    			}
			    		}
			    	}
			    }
			}
		}else{
			foreach ($posts['transaksi'] as &$key) {
			    if (($key['id']) == 3) {
			    	array_push($key['detail'],$post);
			    }
			}
		}
	    
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);

	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }
	    
	}

	public function check_product($id_tr='',$id_pr='',$tbl='',$clm='')
	{
		$data_json = file_get_contents('./transaction_data.json');
        $is_exist = 0;
        $json_arr = json_decode($data_json, true);

		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == ((int)$id_tr)){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_pr)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl'] == $tbl){
								if($brg[$clm] <> '' OR $brg[$clm] <> 0){
									$is_exist = 1;
								}
							}
						}
					}
				}
			}
		}

		return $is_exist;

	}

	public function test_allow($gud_no,$prod_no,$tgl)
	{
		$date = str_replace("T"," ",$tgl);
		$is_allow = $this->setting_model->IsAllow2SellNew($gud_no,$prod_no, 0, $date,'',0,"",0);
		if(is_array($is_allow)){
			echo $is_allow['IsAllow2SellNew']."///".$is_allow['QtyMax']."///".$is_allow['QtyMax2Sell']."///";
		}else{
			echo 'none';
		}
	}

	public function is_allow_sell($id_tr='',$id_pr='',$tbl='',$gud_no='',$qty=0,$tgl='')
	{
		$data_json = file_get_contents('./transaction_data.json');
        $is_exist = 0;
        $json_arr = json_decode($data_json, true);

        $is_boleh = 0;

        $prod = '';

		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == ((int)$id_tr)){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_pr)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl'] == $tbl){
								// echo $gud_no."///".$brg['prod_no']."///".$qty."///".$tgl."//";
								$is_allow = $this->setting_model->IsAllow2SellNew($gud_no,$brg['prod_no'], $qty, $tgl,'',0,"",0);

								$prod = $brg['prod_code']."-".$brg['prod_name'];

								if(is_array($is_allow)){
									$is_boleh = $is_allow['IsAllow2SellNew'];
									$qty_max = $is_allow['QtyMax'];
									$qty_max_sell = $is_allow['QtyMax2Sell'];

									if($is_boleh <> 1){
										$is_boleh = 0;
									}

									return array(
										'is_boleh' => $is_boleh,
										'prod' => $prod
									);
								}
							}
						}
					}
				}
			}
		}

		return array('is_boleh' => $is_boleh,
					'prod' => $prod);

	}

	public function test_arr()
	{
		$data = array();
		$produk = array();

		$ct3 = array(
			'select' => array('prod_no'),
	    	'table' => 'tproduct',
	    	'where' => array('tproduct.is_delete' => 0),
	    	'limit' => 10
	    );

	    $get = $this->setting_model->commonGet($ct3);

	    foreach ($get as $key) {
	    	$produk[] = array(
	    		'prod_no' => $key->prod_no
	    	);

	    }
	    array_push($data,$produk);

	    print_r($data);

	    foreach ($data as $abc) {
	    	foreach ($abc as $bnm) {
	    		echo $bnm['prod_no']."<br/>";
	    	}
	    }


	    echo count($data[0]);

	}

	public function action_prosesmnf()
	{
		$data = array();
		$date = $this->input->post('date');
		$stt = strtotime($date);
        $sec = date("s");
        // $rsl = date('Y-m-d',$stt);
		$rsl = (str_replace("T"," ",$date)).":".$sec;

		if($this->input->post('type')==2){
			$rsl = (str_replace("T"," ",$date));
		}

		$gud_no = $this->input->post('gud');

		if($gud_no == ''){
			$selgud = array(
				'select' => array('gud_no'),
				'table' => 'tgudang',
				'where' => array('is_delete' => 0,
								'is_default' => 1)
			);

			$sgud = $this->setting_model->commonGet($selgud);

			if (is_array($sgud)|| is_object($sgud)) {
				foreach ($sgud as $gudk) {
					$gud_no = $gudk->gud_no;
				}
			}
		}

		$kat_id = $this->input->post('kat_id');
		$gud_name = $this->input->post('gud_name');
		$id_mnf =$this->input->post('id_mnf');
		$no_bb =$this->input->post('no_bb');
		$is_adj =$this->input->post('is_adj');
		$ket = $this->input->post('ket');
		$ket_bb=$this->input->post('ket_bb');
		$id_tr = $this->session->userdata('mnf_proses_id');
		$user_id = $this->session->userdata('person_id');
		$now = date('Y-m-d H:i:s');
		$CatGudNo = '';

		if($this->input->post('type')==1 || $this->input->post('type')==2){
			if ($gud_no <> '' or is_null($gud_no) == FALSE) {
				$selwh = array(
					'select' => array('tcat_gudang.cat_gud_no'),
			    	'table' => 'tgudang',
			    	'join' => array('tcat_gudang' => 'tgudang.cat_gud_no = tcat_gudang.cat_gud_no'),
			    	'where'	=>array('tgudang.is_delete' => 0,
			    					'tgudang.gud_no' => $gud_no),
			    	'limit' => '1'
			    );

				$wh = $this->setting_model->commonGet($selwh);

				if(is_array($wh) || is_object($wh)){
					foreach($wh as $key){
						$CatGudNo = $key->cat_gud_no;	
					}
				}else{
					echo json_encode(array(
						"statusCode"=>106,
						"warehouse" => $gud_name,
					));
					die();
				}
			}else{
				echo var_dump($gud_no);
			}

			$prodbb = $this->check_product(3,$id_tr,'bb','prod_no');
			$prodmnf = $this->check_product(3,$id_tr,'mnf','prod_no');

			$qtybb = $this->check_product(3,$id_tr,'bb','qty_satuan');
			$qtymnf = $this->check_product(3,$id_tr,'mnf','qty_satuan');

			$isAllowed = $this->is_allow_sell(3,$id_tr,'mnf',$gud_no,0,$rsl);

			if($id_mnf <> ''){
				$trans_no = $id_mnf;
			}else{
				$trans_no = $this->setting_model->GetNoIDMaster($rsl,'PRD','jual_no','tsales_produksi_'.$gud_no, $CatGudNo);
			}

			if($prodbb == 0){
				echo json_encode(array(
					"statusCode"=>101,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($prodmnf == 0){
				echo json_encode(array(
					"statusCode"=>102,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($qtybb == 0){
				echo json_encode(array(
					"statusCode"=>103,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($qtymnf == 0){
				echo json_encode(array(
					"statusCode"=>104,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($isAllowed['is_boleh'] == 0){
				echo json_encode(array(
					"statusCode"=>105,
					"dataItem" => $isAllowed['prod'],
				));
				die();
			}
			
			$data = array(
				'date' => $date,
				'stt' => $stt,
		        'rsl' => $rsl,
		        'gud_no' => $gud_no,
		        'gud_name' => $gud_name,
				'trans_no' => $trans_no,
				'id_mnf' => $id_mnf,
				'no_bb' => $no_bb,
				'is_adj' => $is_adj,
				'ket' => $ket,
				'ket_bb' => $ket_bb,
				'CatGudNo' => $CatGudNo,
				'kat_id' => $kat_id,
				'id_reff' => ''
			);
		}

		$user_right = '';
		if($this->input->post('type')==1){// insert
			// print_r($data);
    		$ins = $this->act_insert_detail_mnf($data);

    		if($ins == 1){
    			$this->delete_detail_mnf($id_tr);
    			echo json_encode(array(
					"statusCode"=>200
				));
    		}else{
    			echo json_encode(array(
					"statusCode"=>301,
					"message" => "Gagal tambah data."
				));	
    		}
		}elseif($this->input->post('type')==2) {//update
			$this->setting_model->HapusKoreksi($id_mnf, 0);

        	$ins = $this->act_insert_detail_mnf($data);

        	if($ins == 1){
    			$this->delete_detail_mnf($id_tr);
    			echo json_encode(array(
					"statusCode"=>201,
					"trans_no" => $trans_no
				));
    		}else{
    			echo json_encode(array(
					"statusCode"=>301,
					"message" => "Gagal tambah data."
				));	
    		}
			
		}elseif($this->input->post('type')==3) {//delete
			$hapus = 0;
			$rtn = 0;
			$id_mnfml=$this->input->post('id_mnfml');
			foreach($id_mnfml as $id){

				$selprod = array(
					'select' => array('pr_no'),
			    	'table' => 'tm_produksi',
			    	'where'	=>array('pr_no' => $id,
			    					'is_delete' => 0)
			    );

				$sprod = $this->setting_model->commonGet($selprod);

				if(is_array($sprod) || is_object($sprod)){
					$hapus = $this->setting_model->HapusKoreksi($id, 1);
					$set = $this->SetStok($id);
					$rtn += (int)$hapus;
				}else{
					echo json_encode(array(
						"statusCode"=>301,
						"message" => "No. Manufacture ".$id." tidak ditemukan pada list."
					));
					die();
				}
		    }

		    if($rtn > 0){
		    	echo json_encode(array(
					"statusCode"=>202
				));	
		    }else{
		    	echo json_encode(array(
					"statusCode"=>201
				));	
		    }
			
		}elseif($this->input->post('type')==4) {//arsip
			$id_mnfml=$this->input->post('id_mnfml');
			 foreach($id_mnfml as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1,
							'delete_date' => $now,
							'user_delete'=> $user_id,
						),
						'table' => 'tset_bb',
						'where' => array(
							'tset_bb.bb_no' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}else{
			echo json_encode(array(
				"statusCode"=>301,
				"message" => "Unknows type"
			));
			die();
		}
	}

	public function SetStok($pr_no ='')
	{
		$selprod = array(
			'select' => array('b.prod_no', 'c.prod_on_hand'),
	    	'table' => 'td_produksi b',
	    	'join' => array('tm_produksi a' => 'a.pr_no = b.pr_no',
	    					'tdgproduct c' => 'b.prod_no = c.prod_no'),
	    	'where'	=>array('a.pr_no' => $pr_no)
	    );

		$sprod = $this->setting_model->commonGet($selprod);

		if(is_array($sprod) || is_object($sprod)){
			foreach ($sprod as $kprod) {
				$update = array(
					'update' => array(
						'prod_on_hand' => $kprod->prod_on_hand
					),
					'table' => 'tproduct',
					'where' => array(
						'prod_no' => $kprod->prod_no
					)
				);

	        	$this->setting_model->commonUpdate($update);
			}
		}

		// print_r($pr_no);
	}

	public function test_updatehpp()
	{
		$this->setting_model->UpdateHppNew('ID-140217-102309-0008','2023-04-19 12:04:05');
	}

	public function test_act_insert_detail_mnf()
	{
		// echo var_dump($data);

		$data = array(
		    'date' => '2023-04-19T12:19',
		    'stt' => 1681881540,
		    'rsl' => '2023-04-19 12:19:12',
		    'gud_no' => 'ID2',
		    'gud_name' => 'MADURA',
		    'trans_no' => 'PT-PRD202340007',
		    'id_mnf' => '',
		    'no_bb' => 'BB-2339-132717-0011',
		    'is_adj' => 0,
		    'ket' => '2390000100 ROTI - MARIAM isi 5',
		    'ket_bb' => '2390000100 ROTI - MARIAM isi 5',
		    'CatGudNo' => 'CG_000',
		    'kat_id' => 0,
		    'id_reff' => ''
		);

		$now = date('Y-m-d H:i:s');

		$jurno = '';
		$txtStr = '';
		$TotalHpp = 0;
		$TotalAfalan = 0;
		$id_tr = 3;
		$user_id = 138;
		$gud_act = 'ID2';
		$gud = $data['gud_no'];
		$data_json = file_get_contents('./transaction_data.json');
        $is_exist = 0;
        $json_arr = json_decode($data_json, true);
        $tgl = $data['rsl'];
        $GudNo = $gud;
        $catgud = $data['CatGudNo'];
        $is_adj = $data['is_adj'];
        // $rsl = $data['rsl'];
        $ket = $data['ket'];
        $no_bb = $data['no_bb'];
        $trans_no = $data['trans_no'];
        $id_reff = $data['id_reff'];

        $this->db->trans_start();

		$selid = array(
			'select' => array('count(pr_no) as hasil'),
			'table' => 'tm_produksi',
			'where' =>array('pr_no' => $trans_no)
		);

		$sid = $this->setting_model->commonGet($selid);

		if (is_array($sid)||is_object($sid)) {
			foreach ($sid as $kid) {
				if ($kid->hasil > 0) {
					$trans_no = $this->setting_model->GetNoIDMaster($tgl,'PRD','jual_no','tsales_produksi_'.$gud, $catgud);
				}
			}
		}

		$selbb = array(
			'select' => array('a.*','b.prod_uom','b.konversi1'),
			'table' => 'tset_bb a',
			'join' => array('tproduct b' => 'a.prod_no = b.prod_no'),
			'where' =>array('a.bb_no' => $no_bb)
		);

		// print_r($selbb);
		$sbb = $this->setting_model->commonGet($selbb);

		if (is_array($sbb)||is_object($sbb)) {
			foreach ($sbb as $kbb) {
				$insert = array(
					'insert' => array(
						'is_adjust' => $is_adj, 
						'gud_no' => $gud,
						'prod_no' => $kbb->prod_no, 
						'qty_satuan' => 1, 
						'konversi' => $kbb->konversi1, 
						'satuan' => $kbb->prod_uom, 
						'create_date' => $now, 
						'edit_date' => $now, 
						'user_edit' => $user_id, 
						'pr_no' => $trans_no, 
						'pr_date' => $tgl, 
						'pr_ket' => $ket, 
						'user_id' => $user_id, 
						'bb_no' => $no_bb,
						'no_reff' => $id_reff
					),
					'table' => 'tm_produksi'
				);

				$pr = $this->setting_model->commonInsert($insert);

				if($pr['code'] <> 00000 ){
		    		print_r("pr is error");
		    		die();
		    	}

				// print_r($pr);
			}
		}

		$jurnoku = $this->setting_model->GetNoIDMaster($tgl,'GL','jur_no','tjurnal', $catgud);

		$is_jurid = $this->check_id($tgl,'GL','jur_no','tjurnal',$jurnoku, $catgud);

		$jurnoku = $is_jurid;

		$txtStr = "Manufacture No. ".$trans_no."/".$ket;

		$jurno = $jurnoku;

		$insert2 = array(
			'insert' => array(
				'cab_no' => $catgud, 
				'jur_no' => $jurno,
				'jur_tgl' => $tgl, 
				'jur_ket' => $txtStr, 
				'user_id' => $user_id, 
				'jur_total' => 0, 
				'is_viewed' => 1 
			),
			'table' => 'tjurnal'
		);

		// print_r($insert2);

    	$ij = $this->setting_model->commonInsert($insert2);

    	if($ij['code'] <> 00000 ){echo "ij is error".$ij['message'];die();}

    	// print_r($ij);

    	$insert3 = array(
			'insert' => array(
				'cab_no' => $catgud, 
				'jur_no' => $jurno,
				'create_date' => $now, 
				'edit_date' => $now, 
				'user_edit' => $user_id, 
				'out_no' => $trans_no, 
				'out_date' => $tgl,
				'out_type' => 7, 
				'user_id' => $user_id, 
				'jual_no' => $trans_no
			),
			'table' => 'tout'
		);

    	// print_r($insert3);
    	$it = $this->setting_model->commonInsert($insert3);

    	if($it['code'] <> 00000 ){echo "it is error".$it['message'];die();}
    	// print_r($it);
								
    	foreach ($json_arr['transaksi'] as &$key) {
    		
        	if($key['id'] == 3){
        		
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_tr)){
						
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl'] == 'bb'){
								
								$KodeProd = $brg['prod_no'];
						        $JmlSatuan = $brg['qty_satuan'];
						        $Satuan = $brg['satuan'];
						        $Konversi = $brg['konversi'];
						        $JmlStok = $JmlSatuan * $Konversi;

						        if($brg['jenis_brg'] == "Rote"){
						        	$JenisBrg = 1;
						        }else if ($brg['jenis_brg'] == "Produksi") {
						        	$JenisBrg = 2;
						        }else{
						        	$JenisBrg = 1;
						        }

						        if($JmlStok <> 0){
						        	
						        	if($JmlStok<0){$JenisBrg = 1;}else{$JenisBrg = 0;}	
						        	
						        	$QtyRetur = 0;
						            $JumMax = 0;
						            $ProdHpp = 0;
						            $Max2Sell = 0;

						            $selkon = array(
						            	'select' => array('konversi1','konversi2','konversi3','prod_name0','prod_code0', 
										            		'is_stok','acc_brg'),
						            	'table' => 'tproduct',
						            	'where' => array('prod_no' => $KodeProd)
						            );

						            $sk = $this->setting_model->commonGet($selkon);

						            if(is_array($sk) || is_object($sk)){
						            	foreach ($sk as $skkey) {
						            		$RekProd = $skkey->acc_brg;
						            		if($RekProd == "" || ($this->setting_model->isRekNoExists($RekProd) == 0)){
						            			echo json_encode(array(
													"statusCode"=>301,
													"message" => "Account barang item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
												));
												die();	
						            		}

						            		$RekNoProduksi = $RekProd;
						            		$DetKonversi = $Konversi;
								            $Jml = $JmlStok * $DetKonversi;
								            $Boleh = 0;
								            $TheGudNo = $GudNo;
											$ProdHpp = 0;

											if($skkey->is_stok <= 1){
												$OldHpp = 0;

												if($JenisBrg == 0){
													$OldHpp = $ProdHpp;
                    								$Harga = $ProdHpp;
												}else if($JenisBrg == 1){
													$selhpp = array(
										            	'select' => array('a.price_netto'),
										            	'table' => 'td_set_hpp a',
										            	'join' => array('tset_hpp b' => 'a.hap_no = b.hap_no'),
										            	'where' => array('a.prod_no' => $KodeProd,
										            					'b.tgl <=' => $tgl),
										            	'order' => array('b.tgl' => 'DESC'),
										            	'limit' => '1'

										            );

										            $sh = $this->setting_model->commonGet($selhpp);

										            if(is_array($sh) || is_object($sh)){
										            	foreach ($sh as $shkey) {
										            		$OldHpp = (is_null($shkey['price_netto']) ? 0 : $shkey['price_netto']);
										            	}
										            }else{
										            	echo "sh is error";
										            }
										            $Harga = $OldHpp;
												}
											}else{
												$OldHpp = 0;

												$selhpp2 = array(
									            	'select' => array('a.price_netto'),
									            	'table' => 'td_set_hpp a',
									            	'join' => array('tset_hpp b' => 'a.hap_no = b.hap_no'),
									            	'where' => array('a.prod_no' => $KodeProd,
									            					'b.tgl <=' => $tgl),
									            	'order' => array('b.tgl' => 'DESC'),
									            	'limit' => '1'

									            );

									            $sh2 = $this->setting_model->commonGet($selhpp2);

									            if(is_array($sh2) || is_object($sh2)){
									            	foreach ($sh2 as $shkey2) {
									            		$OldHpp = (is_null($shkey2['price_netto']) ? 0 : $shkey2['price_netto']);
									            	}
									            }else{
										            	echo "sh2 is error";
										            }

									            $Harga = $OldHpp;
											}

											$NewPrice = 0;

											$DetPrNoku = $this->setting_model->GetNoIDField2("det_pr_no", "td_produksi");

											$DetPrNo = $DetPrNoku;

											$ins_prod = array(
												'insert' => array(
													'jenis_brg' => $JenisBrg, 
													'nama_brg' => $brg['prod_name'], 
													'gud_no' => $TheGudNo, 
													'det_pr_no' => $DetPrNo, 
													'pr_no' => $trans_no, 
													'prod_no' => $brg['prod_no'], 
													'satuan' => $brg['satuan'],
													'konversi' => $brg['konversi'], 
													'qty_satuan' => $brg['qty_satuan'], 
													'qty_default' => $brg['qty_default'], 
													'qty_pemakaian' => $brg['qty_pemakaian'], 
													'qty_dibutuhkan' => $brg['qty_dibutuhkan'], 
													'satuan_pakai' => $brg['satuan_pakai'], 
													'satuan_butuh' => $brg['satuan_butuh']
												),
												'table' => 'td_produksi'
											);
											// print_r($ins_prod);
									    	$ip = $this->setting_model->commonInsert($ins_prod);

									    	if($ip['code'] <> 00000 ){echo "ip is error";die();}
									    	// print_r($ip);

									    	$DetNoku = $this->setting_model->GetNoIDField2("out_det_no", "tdetail_out");

											$DetNo = $DetNoku;

									    	$ins_out = array(
												'insert' => array(
													'gud_no' => $TheGudNo, 
													'Out_Det_No' => $DetNo, 
													'Out_no'=>$trans_no, 
													'prod_no'=>$brg['prod_no'],
													'out_det_qty'=>$Jml, 
													'price_netto'=>$Harga, 
													'det_sales_no'=>$DetPrNo, 
													'qty_satuan'=>$brg['qty_satuan'], 
													'konversi'=>$brg['konversi'], 
													'satuan' =>$brg['satuan']
												),
												'table' => 'tdetail_out'
											);

											// print_r($ins_out);

									    	$io = $this->setting_model->commonInsert($ins_out);

									    	if($io['code'] <> 00000 ){echo "io is error";die();}

									    	// print_r($io);

									    	if($JenisBrg = 0){
									    		$TotalHpp = $TotalHpp + ($Jml * $Harga);
									    	}else if($JenisBrg = 1){
									    		$TotalAfalan = $TotalAfalan + (abs($Jml) * $Harga);
									    	}

									    	$HasilProduk = $Jml * $Harga;

									    	$txtStr = "Detail Bahan Baku No. ".$trans_no." ".$brg['prod_code']." - ".$brg['prod_name'];

									    	$JurDetNoku = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
									    	$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNoku);

        									$JurDetNoku = $is_jid;

									    	$JurDetNo = $JurDetNoku;

									    	$ins_tdjur = array(
												'insert' => array(
													'jur_det_no' => $JurDetNo, 
													'jur_no' => $jurno, 
													'rek_no'=>$RekProd, 
													'kredit'=>strval($HasilProduk),
													'debet'=>0, 
													'keterangan'=>$txtStr, 
													'kredit_kurs'=>strval($HasilProduk), 
													'debet_kurs'=>0
												),
												'table' => 'tdjurnal'
											);

											// print_r($ins_tdjur);

									    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

									    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

									    	// print_r($itdj);

									    	$up_trek = array(
												'update' => array(
													'saldo' => 'saldo - '.$HasilProduk
												),
												'table' => 'trek',
												'where' => array(
															'rek_no' => $RekProd)
											);
									    	// print_r($up_trek);

									    	$utr = $this->setting_model->commonUpdate($up_trek);

									    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

									    	// print_r($utr);

									    	$up_tdout = array(
												'update' => array(
													'rek_brg' => $RekProd,
													'jur_det_no1' => $JurDetNo
												),
												'table' => 'tdetail_out',
												'where' => array(
															'out_det_no' => $DetNo)
											);

									    	// print_r($up_tdout);

									    	$utdo = $this->setting_model->commonUpdate($up_tdout);

									    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

									    	// print_r($utdo);

									    	$JurDetNoku = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");

									    	$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNoku);

        									$JurDetNoku = $is_jid;

									    	$JurDetNo = $JurDetNoku;

									    	$ins_tdjur = array(
												'insert' => array(
													'jur_det_no' => $JurDetNo, 
													'jur_no' => $jurno, 
													'rek_no'=>strval($RekNoProduksi), 
													'debet'=>strval($HasilProduk), 
													'kredit'=> 0,
													'keterangan'=>$txtStr, 
													'debet_kurs'=>strval($HasilProduk),
													'kredit_kurs'=> 0
												),
												'table' => 'tdjurnal'
											);

									    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

									    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

									    	// print_r($itdj);

									    	$up_trek = array(
												'update' => array(
													'saldo' => 'saldo + '.strval($HasilProduk)
												),
												'table' => 'trek',
												'where' => array(
															'rek_no' => $RekNoProduksi)
											);

									    	$utr = $this->setting_model->commonUpdate($up_trek);

									    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

									    	// print_r($utr);

									    	$up_tdout = array(
												'update' => array(
													'rek_unbill_gr' => $RekNoProduksi,
													'jur_det_no2' => $JurDetNo
												),
												'table' => 'tdetail_out',
												'where' => array(
															'out_det_no' => $DetNo)
											);

									    	$utdo = $this->setting_model->commonUpdate($up_tdout);

									    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

									    	// print_r($utdo);
									    	// echo $TheGudNo.'???'.$KodeProd.'???'.$tgl.'???'.$DetNo.'???'.$Jml.'???'.$Harga.'???'.$gud_act.'???';
									    	$InsTrans = $this->setting_model->InsertTTrans($TheGudNo, $KodeProd, $tgl,"", $DetNo, 0, $Jml, 7, $Harga, $gud_act);

									  //   	print_r($data);
						            	}	
						            }else{
						            	echo json_encode(array(
											"statusCode"=>301,
											"message" => "bb Bahan baku item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
										));
										die();
						            	
						            }
						        }
							}
							
							$JmlStok = 0;
    						$JmlAfal = 0;

							if($brg['jenis_tbl'] == 'mnf'){
								if($brg['jenis_brg'] == "Produksi"){
									$JmlStok = $JmlStok + ($brg['konversi'] * $brg['qty_satuan']);
								}else{
									$JmlAfal = $JmlAfal + ($brg['konversi'] * $brg['qty_satuan']);
								}
							}

							$HargaAwal = 0;

							if ($JmlStok <> 0) {
								$HargaAwal = ($TotalHpp - $TotalAfalan) / ($JmlStok);
							}else{
								if ($JmlAfal <> 0) {
									$HargaAwal = ($TotalHpp - $TotalAfalan) / ($JmlAfal);
								}
							}

							if($brg['jenis_tbl'] == 'mnf'){
								$Jml = $brg['qty_satuan'];
								$Boleh = 0;
								$TheGudNo = $GudNo;
						        $KodeProd = $brg['prod_no'];
						        $Konversi = $brg['konversi'];
						        $JmlStok = $Jml * $Konversi;

						        if($brg['jenis_brg'] == "Rote"){
						        	$JenisBrg = 1;
						        }else if ($brg['jenis_brg'] == "Produksi") {
						        	$JenisBrg = 2;
						        }else{
						        	$JenisBrg = 1;
						        }

						        $InDetNoku = $this->setting_model->GetNoIDField2("det_pr_no", "td_produksi");
						        $InDetNo = $InDetNoku;

						        $intdpro = array(
									'insert' => array(
										'jenis_brg' => strval($JenisBrg), 
										'nama_brg' => strval($brg['prod_name']),
										'gud_no' => $GudNo, 
										'det_pr_no' => $InDetNo, 
										'pr_no' => $trans_no, 
										'prod_no' => strval($brg['prod_no']), 
										'satuan' => strval($brg['satuan']),
										'konversi' => strval($brg['konversi']), 
										'qty_satuan' => strval($brg['qty_satuan']),
										'qty_default' => $brg['qty_default'], 
										'qty_pemakaian' => $brg['qty_pemakaian'], 
										'qty_dibutuhkan' => $brg['qty_dibutuhkan'], 
										'satuan_pakai' => $brg['satuan_pakai'], 
										'satuan_butuh' => $brg['satuan_butuh'],
										'harga_satuan' => strval($brg['harga_jual']),
										// 'det_total' => strval($brg['det_total2'])
									),
									'table' => 'td_produksi'
								);

						    	$itprod = $this->setting_model->commonInsert($intdpro);

						    	if($itprod['code'] <> 00000 ){echo "itprod is error".$itprod['message'];die();}

						    	// $RekNoProduksi = $RekProd;

						    	$selrd = array(
						    		'select' => array('b.konversi1', 
						    						'b.konversi2', 
						    						'b.konversi3', 
						    						'b.prod_name0', 
						    						'b.prod_code0', 
						    						'is_stok', 
						    						'acc_brg'),
						    		'table' => 'tproduct b',
						    		'where' => array('b.prod_no' => $KodeProd)
						    	);

						    	$srd = $this->setting_model->commonGet($selrd);

						    	// echo var_dump($srd);

						    	// die();

						    	if(is_array($srd)||is_object($srd)){
									foreach ($srd as $rd) {
						    			$RekProd = $rd->acc_brg."";
						    		}	
						    	}else{
						    		echo json_encode(array(
										"statusCode"=>301,
										"message" => "mnf Bahan baku item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
									));
									die();
						    	}

						    	if ($RekProd == '' || ($this->setting_model->isRekNoExists($RekProd) == 0)) {
						    		echo json_encode(array(
										"statusCode"=>301,
										"message" => "Account barang item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
									));
									die();	
						    	}

						    	$RekNoProduksi = $RekProd;

						    	$NewPrice = 0;
                    
        						$DetNo = $this->setting_model->GetNoIDField2("out_det_no", "tdetail_out");

        						$ins_out = array(
									'insert' => array(
										'gud_no' => $TheGudNo, 
										'qty_satuan' => strval($Jml * -1), 
										'satuan'=> strval($brg['satuan']), 
										'konversi'=>strval($Konversi),
										'out_det_buy_price'=>strval($HargaAwal), 
										'out_det_no'=>$DetNo, 
										'out_no'=>$trans_no, 
										'prod_no'=>$KodeProd, 
										'out_det_qty'=>strval($JmlStok * -1), 
										'out_det_sell_price' => strval($HargaAwal),
										'price_netto' => strval($HargaAwal),
										'det_sales_no' => $InDetNo 
									),
									'table' => 'tdetail_out'
								);

						    	$io = $this->setting_model->commonInsert($ins_out);

						    	if($io['code'] <> 00000 ){echo "io is error";die();}

						    	$txtStr = "Detail Produksi No. ".$trans_no." ".$brg['prod_code']." - ".$brg['prod_name'];
        						$HasilProduk = $JmlStok * $HargaAwal;

        						$JurDetNo = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
        						$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNo);

        						$JurDetNo = $is_jid;

        						$ins_tdjur = array(
									'insert' => array(
										'jur_det_no' => $JurDetNo, 
										'jur_no' => $jurno, 
										'rek_no'=>$RekProd, 
										'debet'=>strval($HasilProduk),
										'kredit'=>0, 
										'keterangan'=>$txtStr, 
										'debet_kurs'=>strval($HasilProduk), 
										'kredit_kurs'=>0
									),
									'table' => 'tdjurnal'
								);

						    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

						    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

						    	$up_trek = array(
									'update' => array(
										'saldo' => 'saldo + '.$HasilProduk
									),
									'table' => 'trek',
									'where' => array(
												'rek_no' => $RekProd)
								);

						    	$utr = $this->setting_model->commonUpdate($up_trek);

						    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

						    	$up_tdout = array(
									'update' => array(
										'rek_brg' => $RekProd,
										'jur_det_no1' => $JurDetNo
									),
									'table' => 'tdetail_out',
									'where' => array(
												'out_det_no' => $DetNo)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

						    	$JurDetNo = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
        						$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNo);

        						$JurDetNo = $is_jid;

						    	$ins_tdjur = array(
									'insert' => array(
										'jur_det_no' => $JurDetNo, 
										'jur_no' => $jurno, 
										'rek_no'=>$RekNoProduksi, 
										'kredit'=>strval($HasilProduk), 
										'debet'=>0,
										'keterangan'=>$txtStr, 
										'kredit_kurs'=>strval($HasilProduk),
										'debet_kurs'=>0
									),
									'table' => 'tdjurnal'
								);

						    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

						    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

						    	$up_trek = array(
									'update' => array(
										'saldo' => 'saldo - '.strval($HasilProduk)
									),
									'table' => 'trek',
									'where' => array(
												'rek_no' => $RekNoProduksi)
								);

						    	$utr = $this->setting_model->commonUpdate($up_trek);

						    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

						    	$up_tdout = array(
									'update' => array(
										'rek_unbill_gr' => $RekNoProduksi,
										'jur_det_no2' => $JurDetNo
									),
									'table' => 'tdetail_out',
									'where' => array(
												'out_det_no' => $DetNo)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

						    	$InsTrans = $this->setting_model->InsertTTrans($TheGudNo, $KodeProd, $tgl,"", $DetNo, 0, $JmlStok * -1, 7, $Harga, $gud_act);
							}

							if($no_bb <> ""){
								$up_tdout = array(
									'update' => array(
										'is_pakai' => 'is_pakai + 1'),
									'table' => 'tset_bb',
									'where' => array('bb_no' => $no_bb)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}
							}

							if($brg['jenis_tbl'] == 'mnf'){
								$update = $this->setting_model->UpdateHppNew($brg['prod_no'],$tgl);

								if($update == 0){
									return 1;
								}
							}
						}
					}
				}
			}
		}

		$Add = 0;
	    $OutNo = $trans_no;
	    $SaveData = 1;

		if ($this->db->trans_status() <> 0000) {
	        $this->db->trans_rollback(); // roll back the transaction
	        if($Add == 1){
	        	$OutNo = "PRD".date('ymd')."-00000#";
	        }
	        return 0; // return FALSE if there is an error
	    } else {
	        $this->db->trans_commit(); // commit the transaction 
	        return 1; // return TRUE if the transaction succeeds
	    }
	}
	
	public function test_action_prosesmnf()
	{
		$data = array();
		$date = $this->input->post('date');
		$stt = strtotime($date);
        $sec = date("s");
        // $rsl = date('Y-m-d',$stt);
		$rsl = (str_replace("T"," ",$date)).":".$sec;
		$gud_no = $this->input->post('gud');
		$kat_id = $this->input->post('kat_id');
		$gud_name = $this->input->post('gud_name');
		$id_mnf =$this->input->post('id_mnf');
		$no_bb =$this->input->post('no_bb');
		$is_adj =$this->input->post('is_adj');
		$ket = $this->input->post('ket');
		$ket_bb=$this->input->post('ket_bb');
		$id_tr = $this->session->userdata('mnf_proses_id');
		$user_id = $this->session->userdata('person_id');
		$now = date('Y-m-d H:i:s');
		$CatGudNo = '';

		if ($gud_no <> '' or is_null($gud_no) == FALSE) {
			$selwh = array(
				'select' => array('tcat_gudang.cat_gud_no'),
		    	'table' => 'tgudang',
		    	'join' => array('tcat_gudang' => 'tgudang.cat_gud_no = tcat_gudang.cat_gud_no'),
		    	'where'	=>array('tgudang.is_delete' => 0,
		    					'tgudang.gud_no' => $gud_no),
		    	'limit' => '1'
		    );

			$wh = $this->setting_model->commonGet($selwh);

			if(is_array($wh) || is_object($wh)){
				foreach($wh as $key){
					$CatGudNo = $key->cat_gud_no;	
				}
			}else{
				echo json_encode(array(
					"statusCode"=>106,
					"warehouse" => $gud_name,
				));
				die();
			}
		}else{
			echo var_dump($gud_no);
		}

		$prodbb = $this->check_product(3,$id_tr,'bb','prod_no');
		$prodmnf = $this->check_product(3,$id_tr,'mnf','prod_no');

		$qtybb = $this->check_product(3,$id_tr,'bb','qty_satuan');
		$qtymnf = $this->check_product(3,$id_tr,'mnf','qty_satuan');

		$isAllowed = $this->is_allow_sell(3,$id_tr,'mnf',$gud_no,0,$rsl);

		$trans_no = $this->setting_model->GetNoIDMaster($rsl,'PRD','jual_no','tsales_produksi_'.$gud_no, $CatGudNo);

		if($prodbb == 0){
			echo json_encode(array(
				"statusCode"=>101,
				"trans_no" => $trans_no,
			));
			die();
		}

		if($prodmnf == 0){
			echo json_encode(array(
				"statusCode"=>102,
				"trans_no" => $trans_no,
			));
			die();
		}

		if($qtybb == 0){
			echo json_encode(array(
				"statusCode"=>103,
				"trans_no" => $trans_no,
			));
			die();
		}

		if($qtymnf == 0){
			echo json_encode(array(
				"statusCode"=>104,
				"trans_no" => $trans_no,
			));
			die();
		}

		if($isAllowed['is_boleh'] == 0){
			echo json_encode(array(
				"statusCode"=>105,
				"dataItem" => $isAllowed['prod'],
			));
			die();
		}
		
		$data = array(
			'date' => $date,
			'stt' => $stt,
	        'rsl' => $rsl,
	        'gud_no' => $gud_no,
	        'gud_name' => $gud_name,
			'trans_no' => $trans_no,
			'id_mnf' => $id_mnf,
			'no_bb' => $no_bb,
			'is_adj' => $is_adj,
			'ket' => $ket,
			'ket_bb' => $ket_bb,
			'CatGudNo' => $CatGudNo,
			'kat_id' => $kat_id
		);

		$user_right = '';
		if($this->input->post('type')==1){// insert
    		$this->act_insert_detail_mnf($data);
    		// echo var_dump($data);

    		echo json_encode(array(
				"statusCode"=>200
			));
		}
	}

	public function test_hapus_koreksi($trans_no)
	{
		$hps = $this->setting_model->HapusKoreksi($trans_no,0);
		echo $hps;
	}

	public function testttttt()
	{
		$data_json = file_get_contents('./transaction_data.json');
        $json_arr = json_decode($data_json, true);

        foreach ($json_arr['transaksi'] as &$key) {
    		
        	if($key['id'] == 3){
        		
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)1)){
						
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl'] == 'bb'){

								$KodeProd = $brg['prod_no'];

								$seluom = array(
						        	'select' => array('prod_uom', 'prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
						        	'table' => 'tproduct',
						        	'where' => array('prod_no' => $KodeProd)
						        );

						        $suom = $this->setting_model->commonGet($seluom);

						        if (is_array($suom) || is_object($suom)) {
						        	foreach ($suom as $kuom) {
						        		if($brg['satuan'] == $kuom->prod_uom){
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}else if ($brg['satuan'] == $kuom->prod_uom2) {
								    		$Satuan = 2;
						        			$Konversi = $kuom->konversi2;
								    	}else if ($brg['satuan'] == $kuom->prod_uom3) {
								    		$Satuan = 3;
						        			$Konversi = $kuom->konversi3;
								    	}else{
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}
						        	}
						        }

						  
						        if($brg['jenis_brg'] == "Rote"){
						        	$JenisBrg = 1;
						        }else if ($brg['jenis_brg'] == "Produksi") {
						        	$JenisBrg = 2;
						        }else{
						        	$JenisBrg = 1;
						        }
						    }
						}
					}
				}
			}
		}
	}
	public function act_insert_detail_mnf($data)
	{
		// echo var_dump($data);

		$now = date('Y-m-d H:i:s');

		$jurno = '';
		$txtStr = '';
		$TotalHpp = 0;
		$TotalAfalan = 0;
		$id_tr = $this->session->userdata('mnf_proses_id');
		$user_id = $this->session->userdata('person_id');
		$gud_act = $this->session->userdata('gud_no');
		$gud = $data['gud_no'];
		$data_json = file_get_contents('./transaction_data.json');
        $is_exist = 0;
        $json_arr = json_decode($data_json, true);
        $tgl = $data['rsl'];
        $GudNo = $gud;
        $catgud = $data['CatGudNo'];
        $is_adj = $data['is_adj'];
        // $rsl = $data['rsl'];
        $ket = $data['ket'];
        $no_bb = $data['no_bb'];
        $trans_no = $data['trans_no'];
        $id_reff = $data['id_reff'];


		// foreach ($json_arr['transaksi'] as &$key) {
  //       	if($key['id'] == 3){
		// 		foreach ($key['detail'] as &$val) {
		// 			if($val['id_trans'] == ((int)$id_tr)){
		// 				foreach ($val['detail_trans'] as &$brg) {
		// 					if($brg['jenis_tbl'] == 'mnf'){
								// $trans_no2 = $this->setting_model->GetNoIDMaster($tgl,'PRD','jual_no','tsales_produksi_'.$gud, $catgud);
        $this->db->trans_start();

								$selid = array(
									'select' => array('count(pr_no) as hasil'),
									'table' => 'tm_produksi',
									'where' =>array('pr_no' => $trans_no)
								);

								$sid = $this->setting_model->commonGet($selid);

								if (is_array($sid)||is_object($sid)) {
									foreach ($sid as $kid) {
										if ($kid->hasil > 0) {
											$trans_no = $this->setting_model->GetNoIDMaster($tgl,'PRD','jual_no','tsales_produksi_'.$gud, $catgud);
										}
									}
								}
        						// $is_expur = $this->check_id_pur($trans_no,$tgl,$gud,$catgud);
        						// $purn = $is_expur;
        						// $trans_no = $purn;

        						$selbb = array(
									'select' => array('a.*','b.prod_uom','b.konversi1'),
									'table' => 'tset_bb a',
									'join' => array('tproduct b' => 'a.prod_no = b.prod_no'),
									'where' =>array('a.bb_no' => $no_bb)
								);

								// print_r($selbb);
								$sbb = $this->setting_model->commonGet($selbb);

        						if (is_array($sbb)||is_object($sbb)) {
									foreach ($sbb as $kbb) {
										$insert = array(
											'insert' => array(
												'is_adjust' => $is_adj, 
												'gud_no' => $gud,
												'prod_no' => $kbb->prod_no, 
												'qty_satuan' => 1, 
												'konversi' => $kbb->konversi1, 
												'satuan' => $kbb->prod_uom, 
												'create_date' => $now, 
												'edit_date' => $now, 
												'user_edit' => $user_id, 
												'pr_no' => $trans_no, 
												'pr_date' => $tgl, 
												'pr_ket' => $ket, 
												'user_id' => $user_id, 
												'bb_no' => $no_bb,
												'no_reff' => $id_reff
											),
											'table' => 'tm_produksi'
										);

										$pr = $this->setting_model->commonInsert($insert);

										if($pr['code'] <> 00000 ){
								    		print_r("pr is error");
								    		print_r($pr['message']);
								    		die();
								    	}

										// print_r($pr);
									}
								}

								// die();

								// $insert = array(
								// 	'insert' => array(
								// 		'is_adjust' => $is_adj, 
								// 		'gud_no' => $gud,
								// 		'prod_no' => $brg['prod_no'], 
								// 		'qty_satuan' => 1, 
								// 		'konversi' => $brg['konversi'], 
								// 		'satuan' => $brg['satuan'], 
								// 		'create_date' => $now, 
								// 		'edit_date' => $now, 
								// 		'user_edit' => $user_id, 
								// 		'pr_no' => $trans_no, 
								// 		'pr_date' => $tgl, 
								// 		'pr_ket' => $ket, 
								// 		'user_id' => $user_id, 
								// 		'bb_no' => $no_bb, 
								// 	),
								// 	'table' => 'tm_produksi'
								// );

								// print_r($insert);

					        	// $pr = $this->setting_model->commonInsert($insert);

					        	// print_r($pr);
		// 					}
		// 				}
		// 			}
		// 		}
		// 	}
		// }

		$jurnoku = $this->setting_model->GetNoIDMaster($tgl,'GL','jur_no','tjurnal', $catgud);

		$is_jurid = $this->check_id($tgl,'GL','jur_no','tjurnal',$jurnoku, $catgud);

		$jurnoku = $is_jurid;

		$txtStr = "Manufacture No. ".$trans_no."/".$ket;

		$jurno = $jurnoku;

		$insert2 = array(
			'insert' => array(
				'cab_no' => $catgud, 
				'jur_no' => $jurno,
				'jur_tgl' => $tgl, 
				'jur_ket' => $txtStr, 
				'user_id' => $user_id, 
				'jur_total' => 0, 
				'is_viewed' => 1 
			),
			'table' => 'tjurnal'
		);

		// print_r($insert2);

    	$ij = $this->setting_model->commonInsert($insert2);

    	if($ij['code'] <> 00000 ){echo "ij is error".$ij['message'];die();}

    	// print_r($ij);

    	$insert3 = array(
			'insert' => array(
				'cab_no' => $catgud, 
				'jur_no' => $jurno,
				'create_date' => $now, 
				'edit_date' => $now, 
				'user_edit' => $user_id, 
				'out_no' => $trans_no, 
				'out_date' => $tgl,
				'out_type' => 7, 
				'user_id' => $user_id, 
				'jual_no' => $trans_no
			),
			'table' => 'tout'
		);

    	// print_r($insert3);
    	$it = $this->setting_model->commonInsert($insert3);

    	if($it['code'] <> 00000 ){echo "it is error".$it['message'];die();}
    	// print_r($it);
								
    	foreach ($json_arr['transaksi'] as &$key) {
    		
        	if($key['id'] == 3){
        		
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_tr)){
						
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl'] == 'bb'){
								
								$KodeProd = $brg['prod_no'];
						        $JmlSatuan = $brg['qty_satuan'];

						        $Satuan = 0;
						        $Konversi = 0;

						        $seluom = array(
						        	'select' => array('prod_uom', 'prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
						        	'table' => 'tproduct',
						        	'where' => array('prod_no' => $KodeProd)
						        );

						        $suom = $this->setting_model->commonGet($seluom);

						        if (is_array($suom) || is_object($suom)) {
						        	foreach ($suom as $kuom) {
						        		if($brg['satuan'] == $kuom->prod_uom){
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}else if ($brg['satuan'] == $kuom->prod_uom2) {
								    		$Satuan = 2;
						        			$Konversi = $kuom->konversi2;
								    	}else if ($brg['satuan'] == $kuom->prod_uom3) {
								    		$Satuan = 3;
						        			$Konversi = $kuom->konversi3;
								    	}else{
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}
						        	}
						        }

						        $JmlStok = $JmlSatuan * $Konversi;

						        if($brg['jenis_brg'] == "Rote"){
						        	$JenisBrg = 1;
						        }else if ($brg['jenis_brg'] == "Produksi") {
						        	$JenisBrg = 2;
						        }else{
						        	$JenisBrg = 1;
						        }

						        if($JmlStok <> 0){
						        	
						        	if($JmlStok<0){$JenisBrg = 1;}else{$JenisBrg = 0;}	
						        	
						        	$QtyRetur = 0;
						            $JumMax = 0;
						            $ProdHpp = 0;
						            $Max2Sell = 0;

						            $selkon = array(
						            	'select' => array('konversi1','konversi2','konversi3','prod_name0','prod_code0', 
										            		'is_stok','acc_brg'),
						            	'table' => 'tproduct',
						            	'where' => array('prod_no' => $KodeProd)
						            );

						            $sk = $this->setting_model->commonGet($selkon);

						            if(is_array($sk) || is_object($sk)){
						            	foreach ($sk as $skkey) {
						            		$RekProd = $skkey->acc_brg;
						            		if($RekProd == "" || ($this->setting_model->isRekNoExists($RekProd) == 0)){
						            			echo json_encode(array(
													"statusCode"=>301,
													"message" => "Account barang item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
												));
												die();	
						            		}

						            		$RekNoProduksi = $RekProd;
						            		$DetKonversi = $Konversi;
								            $Jml = $JmlStok * $DetKonversi;
								            $Boleh = 0;
								            $TheGudNo = $GudNo;
											$ProdHpp = 0;

											if($skkey->is_stok <= 1){
												$OldHpp = 0;

												if($JenisBrg == 0){
													$OldHpp = $ProdHpp;
                    								$Harga = $ProdHpp;
												}else if($JenisBrg == 1){
													$selhpp = array(
										            	'select' => array('a.price_netto'),
										            	'table' => 'td_set_hpp a',
										            	'join' => array('tset_hpp b' => 'a.hap_no = b.hap_no'),
										            	'where' => array('a.prod_no' => $KodeProd,
										            					'b.tgl <=' => $tgl),
										            	'order' => array('b.tgl' => 'DESC'),
										            	'limit' => '1'

										            );

										            $sh = $this->setting_model->commonGet($selhpp);

										            if(is_array($sh) || is_object($sh)){
										            	foreach ($sh as $shkey) {
										            		$OldHpp = (is_null($shkey['price_netto']) ? 0 : $shkey['price_netto']);
										            	}
										            }else{
										            	echo "sh is error";
										            }
										            $Harga = $OldHpp;
												}
											}else{
												$OldHpp = 0;

												$selhpp2 = array(
									            	'select' => array('a.price_netto'),
									            	'table' => 'td_set_hpp a',
									            	'join' => array('tset_hpp b' => 'a.hap_no = b.hap_no'),
									            	'where' => array('a.prod_no' => $KodeProd,
									            					'b.tgl <=' => $tgl),
									            	'order' => array('b.tgl' => 'DESC'),
									            	'limit' => '1'

									            );

									            $sh2 = $this->setting_model->commonGet($selhpp2);

									            if(is_array($sh2) || is_object($sh2)){
									            	foreach ($sh2 as $shkey2) {
									            		$OldHpp = (is_null($shkey2['price_netto']) ? 0 : $shkey2['price_netto']);
									            	}
									            }else{
										            	echo "sh2 is error";
										            }

									            $Harga = $OldHpp;
											}

											$NewPrice = 0;

											$DetPrNoku = $this->setting_model->GetNoIDField2("det_pr_no", "td_produksi");

											// $selid = array(
									  //           'select' => array('count(det_pr_no) as hasil'),
									  //           'table' => 'det_pr_no',
									  //           'where' =>array( 'det_pr_no' => $DetPrNoku)
									  //       );

									  //       $sid = $this->setting_model->commonGet($selid);

									  //       if (is_array($sid)||is_object($sid)) {
									  //           foreach ($sid as $kid) {
									  //               if ($kid->hasil > 0) {
									  //                   $DetPrNoku = $this->setting_model->GetNoIDField2("det_pr_no", "det_pr_no");
									  //               }
									  //           }
									  //       }

											$DetPrNo = $DetPrNoku;

											$ins_prod = array(
												'insert' => array(
													'jenis_brg' => $JenisBrg, 
													'nama_brg' => $brg['prod_name'], 
													'gud_no' => $TheGudNo, 
													'det_pr_no' => $DetPrNo, 
													'pr_no' => $trans_no, 
													'prod_no' => $brg['prod_no'], 
													'satuan' => $brg['satuan'],
													'konversi' => $brg['konversi'], 
													'qty_satuan' => $brg['qty_satuan'], 
													'qty_default' => $brg['qty_default'], 
													'qty_pemakaian' => $brg['qty_pemakaian'], 
													'qty_dibutuhkan' => $brg['qty_dibutuhkan'], 
													'satuan_pakai' => $brg['satuan_pakai'], 
													'satuan_butuh' => $brg['satuan_butuh']
												),
												'table' => 'td_produksi'
											);
											// print_r($ins_prod);
									    	$ip = $this->setting_model->commonInsert($ins_prod);

									    	if($ip['code'] <> 00000 ){echo "ip is error";die();}
									    	// print_r($ip);

									    	$DetNoku = $this->setting_model->GetNoIDField2("out_det_no", "tdetail_out");

											$DetNo = $DetNoku;

									    	$ins_out = array(
												'insert' => array(
													'gud_no' => $TheGudNo, 
													'out_det_no' => $DetNo, 
													'out_no'=>$trans_no, 
													'prod_no'=>$brg['prod_no'],
													'out_det_qty'=>$Jml, 
													'price_netto'=>$Harga, 
													'det_sales_no'=>$DetPrNo, 
													'qty_satuan'=>$brg['qty_satuan'], 
													'konversi'=>$brg['konversi'], 
													'satuan' =>$brg['satuan']
												),
												'table' => 'tdetail_out'
											);

											// print_r($ins_out);

									    	$io = $this->setting_model->commonInsert($ins_out);

									    	if($io['code'] <> 00000 ){echo "io is error";die();}

									    	// print_r($io);

									    	if($JenisBrg = 0){
									    		$TotalHpp = $TotalHpp + ($Jml * $Harga);
									    	}else if($JenisBrg = 1){
									    		$TotalAfalan = $TotalAfalan + (abs($Jml) * $Harga);
									    	}

									    	$HasilProduk = $Jml * $Harga;

									    	$txtStr = "Detail Bahan Baku No. ".$trans_no." ".$brg['prod_code']." - ".$brg['prod_name'];

									    	$JurDetNoku = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
									    	$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNoku);

        									$JurDetNoku = $is_jid;

									    	$JurDetNo = $JurDetNoku;

									    	$ins_tdjur = array(
												'insert' => array(
													'jur_det_no' => $JurDetNo, 
													'jur_no' => $jurno, 
													'rek_no'=>$RekProd, 
													'kredit'=>strval($HasilProduk),
													'debet'=>0, 
													'keterangan'=>$txtStr, 
													'kredit_kurs'=>strval($HasilProduk), 
													'debet_kurs'=>0
												),
												'table' => 'tdjurnal'
											);

											// print_r($ins_tdjur);

									    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

									    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

									    	// print_r($itdj);

									    	$up_trek = array(
												'update' => array(
													'saldo' => 'saldo - '.$HasilProduk
												),
												'table' => 'trek',
												'where' => array(
															'rek_no' => $RekProd)
											);
									    	// print_r($up_trek);

									    	$utr = $this->setting_model->commonUpdate($up_trek);

									    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

									    	// print_r($utr);

									    	$up_tdout = array(
												'update' => array(
													'rek_brg' => $RekProd,
													'jur_det_no1' => $JurDetNo
												),
												'table' => 'tdetail_out',
												'where' => array(
															'out_det_no' => $DetNo)
											);

									    	// print_r($up_tdout);

									    	$utdo = $this->setting_model->commonUpdate($up_tdout);

									    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

									    	// print_r($utdo);

									    	$JurDetNoku = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");

									    	$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNoku);

        									$JurDetNoku = $is_jid;

									    	$JurDetNo = $JurDetNoku;

									    	$ins_tdjur = array(
												'insert' => array(
													'jur_det_no' => $JurDetNo, 
													'jur_no' => $jurno, 
													'rek_no'=>strval($RekNoProduksi), 
													'debet'=>strval($HasilProduk), 
													'kredit'=> 0,
													'keterangan'=>$txtStr, 
													'debet_kurs'=>strval($HasilProduk),
													'kredit_kurs'=> 0
												),
												'table' => 'tdjurnal'
											);

									    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

									    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

									    	// print_r($itdj);

									    	$up_trek = array(
												'update' => array(
													'saldo' => 'saldo + '.strval($HasilProduk)
												),
												'table' => 'trek',
												'where' => array(
															'rek_no' => $RekNoProduksi)
											);

									    	$utr = $this->setting_model->commonUpdate($up_trek);

									    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

									    	// print_r($utr);

									    	$up_tdout = array(
												'update' => array(
													'rek_unbill_gr' => $RekNoProduksi,
													'jur_det_no2' => $JurDetNo
												),
												'table' => 'tdetail_out',
												'where' => array(
															'out_det_no' => $DetNo)
											);

									    	$utdo = $this->setting_model->commonUpdate($up_tdout);

									    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

									    	// print_r($utdo);
									    	// echo $TheGudNo.'???'.$KodeProd.'???'.$tgl.'???'.$DetNo.'???'.$Jml.'???'.$Harga.'???'.$gud_act.'???';
									    	$InsTrans = $this->setting_model->InsertTTrans($TheGudNo, $KodeProd, $tgl,"", $DetNo, 0, $Jml, 7, $Harga, $gud_act);

									  //   	print_r($data);
						            	}	
						            }else{
						            	echo json_encode(array(
											"statusCode"=>301,
											"message" => "bb Bahan baku item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
										));
										die();
						            	
						            }
						        }
							}
							
							$JmlStok = 0;
    						$JmlAfal = 0;

							if($brg['jenis_tbl'] == 'mnf'){
								if($brg['jenis_brg'] == "Produksi"){
									$JmlStok = $JmlStok + ($brg['konversi'] * $brg['qty_satuan']);
								}else{
									$JmlAfal = $JmlAfal + ($brg['konversi'] * $brg['qty_satuan']);
								}
							}

							$HargaAwal = 0;

							if ($JmlStok <> 0) {
								$HargaAwal = ($TotalHpp - $TotalAfalan) / ($JmlStok);
							}else{
								if ($JmlAfal <> 0) {
									$HargaAwal = ($TotalHpp - $TotalAfalan) / ($JmlAfal);
								}
							}

							if($brg['jenis_tbl'] == 'mnf'){
								$Jml = $brg['qty_satuan'];
								$Boleh = 0;
								$TheGudNo = $GudNo;
						        $KodeProd = $brg['prod_no'];

						        $Satuan = 0;
						        $Konversi = 0;

						        $seluom = array(
						        	'select' => array('prod_uom', 'prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
						        	'table' => 'tproduct',
						        	'where' => array('prod_no' => $KodeProd)
						        );

						        $suom = $this->setting_model->commonGet($seluom);

						        if (is_array($suom) || is_object($suom)) {
						        	foreach ($suom as $kuom) {
						        		if($brg['satuan'] == $kuom->prod_uom){
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}else if ($brg['satuan'] == $kuom->prod_uom2) {
								    		$Satuan = 2;
						        			$Konversi = $kuom->konversi2;
								    	}else if ($brg['satuan'] == $kuom->prod_uom3) {
								    		$Satuan = 3;
						        			$Konversi = $kuom->konversi3;
								    	}else{
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}
						        	}
						        }

						        $JmlStok = $Jml * $Konversi;

						        if($brg['jenis_brg'] == "Rote"){
						        	$JenisBrg = 1;
						        }else if ($brg['jenis_brg'] == "Produksi") {
						        	$JenisBrg = 2;
						        }else{
						        	$JenisBrg = 1;
						        }

						        $InDetNoku = $this->setting_model->GetNoIDField2("det_pr_no", "td_produksi");
						        $InDetNo = $InDetNoku;

						        $intdpro = array(
									'insert' => array(
										'jenis_brg' => strval($JenisBrg), 
										'nama_brg' => strval($brg['prod_name']),
										'gud_no' => $GudNo, 
										'det_pr_no' => $InDetNo, 
										'pr_no' => $trans_no, 
										'prod_no' => strval($brg['prod_no']), 
										'satuan' => strval($brg['satuan']),
										'konversi' => strval($brg['konversi']), 
										'qty_satuan' => strval($brg['qty_satuan']),
										'qty_default' => $brg['qty_default'], 
										'qty_pemakaian' => $brg['qty_pemakaian'], 
										'qty_dibutuhkan' => $brg['qty_dibutuhkan'], 
										'satuan_pakai' => $brg['satuan_pakai'], 
										'satuan_butuh' => $brg['satuan_butuh'],
										'harga_satuan' => strval($brg['harga_jual']),
										// 'det_total' => strval($brg['det_total2'])
									),
									'table' => 'td_produksi'
								);

						    	$itprod = $this->setting_model->commonInsert($intdpro);

						    	if($itprod['code'] <> 00000 ){echo "itprod is error".$itprod['message'];die();}

						    	// $RekNoProduksi = $RekProd;

						    	$selrd = array(
						    		'select' => array('b.konversi1', 
						    						'b.konversi2', 
						    						'b.konversi3', 
						    						'b.prod_name0', 
						    						'b.prod_code0', 
						    						'is_stok', 
						    						'acc_brg'),
						    		'table' => 'tproduct b',
						    		'where' => array('b.prod_no' => $KodeProd)
						    	);

						    	$srd = $this->setting_model->commonGet($selrd);

						    	// echo var_dump($srd);

						    	// die();

						    	if(is_array($srd)||is_object($srd)){
									foreach ($srd as $rd) {
						    			$RekProd = $rd->acc_brg."";
						    		}	
						    	}else{
						    		echo json_encode(array(
										"statusCode"=>301,
										"message" => "mnf Bahan baku item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
									));
									die();
						    	}

						    	if ($RekProd == '' || ($this->setting_model->isRekNoExists($RekProd) == 0)) {
						    		echo json_encode(array(
										"statusCode"=>301,
										"message" => "Account barang item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
									));
									die();	
						    	}

						    	$RekNoProduksi = $RekProd;

						    	$NewPrice = 0;
                    
        						$DetNo = $this->setting_model->GetNoIDField2("out_det_no", "tdetail_out");

        						$ins_out = array(
									'insert' => array(
										'gud_no' => $TheGudNo, 
										'qty_satuan' => strval($Jml * -1), 
										'satuan'=> strval($brg['satuan']), 
										'konversi'=>strval($Konversi),
										'out_det_buy_price'=>strval($HargaAwal), 
										'out_det_no'=>$DetNo, 
										'out_no'=>$trans_no, 
										'prod_no'=>$KodeProd, 
										'out_det_qty'=>strval($JmlStok * -1), 
										'out_det_sell_price' => strval($HargaAwal),
										'price_netto' => strval($HargaAwal),
										'det_sales_no' => $InDetNo 
									),
									'table' => 'tdetail_out'
								);

						    	$io = $this->setting_model->commonInsert($ins_out);

						    	if($io['code'] <> 00000 ){echo "io is error";die();}

						    	$txtStr = "Detail Produksi No. ".$trans_no." ".$brg['prod_code']." - ".$brg['prod_name'];
        						$HasilProduk = $JmlStok * $HargaAwal;

        						$JurDetNo = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
        						$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNo);

        						$JurDetNo = $is_jid;

        						$ins_tdjur = array(
									'insert' => array(
										'jur_det_no' => $JurDetNo, 
										'jur_no' => $jurno, 
										'rek_no'=>$RekProd, 
										'debet'=>strval($HasilProduk),
										'kredit'=>0, 
										'keterangan'=>$txtStr, 
										'debet_kurs'=>strval($HasilProduk), 
										'kredit_kurs'=>0
									),
									'table' => 'tdjurnal'
								);

						    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

						    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

						    	$up_trek = array(
									'update' => array(
										'saldo' => 'saldo + '.$HasilProduk
									),
									'table' => 'trek',
									'where' => array(
												'rek_no' => $RekProd)
								);

						    	$utr = $this->setting_model->commonUpdate($up_trek);

						    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

						    	$up_tdout = array(
									'update' => array(
										'rek_brg' => $RekProd,
										'jur_det_no1' => $JurDetNo
									),
									'table' => 'tdetail_out',
									'where' => array(
												'out_det_no' => $DetNo)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

						    	$JurDetNo = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
        						$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNo);

        						$JurDetNo = $is_jid;

						    	$ins_tdjur = array(
									'insert' => array(
										'jur_det_no' => $JurDetNo, 
										'jur_no' => $jurno, 
										'rek_no'=>$RekNoProduksi, 
										'kredit'=>strval($HasilProduk), 
										'debet'=>0,
										'keterangan'=>$txtStr, 
										'kredit_kurs'=>strval($HasilProduk),
										'debet_kurs'=>0
									),
									'table' => 'tdjurnal'
								);

						    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

						    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

						    	$up_trek = array(
									'update' => array(
										'saldo' => 'saldo - '.strval($HasilProduk)
									),
									'table' => 'trek',
									'where' => array(
												'rek_no' => $RekNoProduksi)
								);

						    	$utr = $this->setting_model->commonUpdate($up_trek);

						    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

						    	$up_tdout = array(
									'update' => array(
										'rek_unbill_gr' => $RekNoProduksi,
										'jur_det_no2' => $JurDetNo
									),
									'table' => 'tdetail_out',
									'where' => array(
												'out_det_no' => $DetNo)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

						    	$InsTrans = $this->setting_model->InsertTTrans($TheGudNo, $KodeProd, $tgl,"", $DetNo, 0, $JmlStok * -1, 7, $HargaAwal, $gud_act);
							}

							if($no_bb <> ""){
								$up_tdout = array(
									'update' => array(
										'is_pakai' => 'is_pakai + 1'),
									'table' => 'tset_bb',
									'where' => array('bb_no' => $no_bb)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}
							}

							if($brg['jenis_tbl'] == 'mnf'){
								$update = $this->setting_model->UpdateHppNew($brg['prod_no'],$tgl);

								if($update == 0){
									return 1;
								}
							}

							$selpoh = array(
								'select' => array('a.*'),
								'table' => 'tdgproduct a',
								'where' =>array('a.prod_no' => $brg['prod_no'])
							);

							// print_r($selbb);
							$sph = $this->setting_model->commonGet($selpoh);

							if (is_array($sph) or is_object($sph)) {
								foreach ($sph as $kph) {
									$this->db->set('prod_on_hand', $kph->prod_on_hand, FALSE)
						                     ->where('prod_no', $brg['prod_no'])
						                     ->update('tproduct');
						            $upre  = $this->db->error();

						            if ($this->db->affected_rows() === 0) {
						                if($upre['code'] <> 00000){
						                    print_r("upton  is error");
						                    die();
						                }
						            }
								}
							}

						}
					}
				}
			}
		}

		$Add = 0;
	    $OutNo = $trans_no;
	    $SaveData = 1;

		if ($this->db->trans_status() <> TRUE) {
	        $this->db->trans_rollback(); // roll back the transaction
	        if($Add == 1){
	        	$OutNo = "PRD".date('ymd')."-00000#";
	        }
	        return 0;
	        // return 0; // return FALSE if there is an error
	    } else {
	        $this->db->trans_commit(); // commit the transaction 
	        return 1; // return TRUE if the transaction succeeds
	    }
	}

	public function test_commit()
	{
		$this->db->trans_start(); // start the transaction

		$up_tdout = array(
		    'update' => array(
		        'iUpload' => 0),
	        'table' => 'tusers',
	        'where' => array('User_id' => 138)
		);

		$utdo = $this->setting_model->commonUpdate($up_tdout);

		if ($this->db->trans_status() === FALSE) { // check the transaction status after executing the query
		    $this->db->trans_rollback(); // roll back the transaction
		    return FALSE; // return FALSE if the transaction fails
		} else {
			$error = $this->db->error();
			print_r($error);
		    $this->db->trans_commit(); // commit the transaction
		    $gt_tdout = array(
			    'select' => array(
			        'iUpload'),
		        'table' => 'tusers',
		        'where' => array('User_id' => 138)
			);

			$gtdo = $this->setting_model->commonGet($gt_tdout);

			foreach ($gtdo as $key) {
				echo $key->iUpload;
			}

		    return TRUE; // return TRUE if the transaction succeeds
		}

		
		
	}

	public function get_qty_prod_mnf()
	{
		$id = $this->input->post('id');
		$column = $this->input->post('column');
		$tbl = $this->input->post('tbl');
	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('mnf_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == $tbl && $brg['id_det'] == ((int)$id)) {
								echo json_encode(array(
									"id_detail" => $brg['id_det'],
									"qty_kemasan" => $brg['qty_kemasan']
								));
							}
						}
					}
				}
			}
		}
	}

	public function update_qty_detail_mnf()
	{
	    $id = $this->input->post('id');
	    $is_adj = $this->input->post('is_adj');
		$qty_paksat = $this->input->post('qty_paksat');
		$qty_kemsat = $this->input->post('qty_kemsat');
		$qty_paksat_input = $this->input->post('qty_paksat_input');
		$qty_kemsat_input = $this->input->post('qty_kemsat_input');
		$qty_pakai = $this->input->post('qty_pakai');
		$qty_butuh = $this->input->post('qty_butuh');
		$qty_hasil = $this->input->post('qty_hasil');
		$prod_kemasan = $this->input->post('prod_kemasan');
		$tbl = $this->input->post('tbl');

	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('mnf_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == $tbl && $brg['id_det'] == ((int)$id)) {
								$brg['det_total1'] = round(((float)$qty_hasil * (float)$brg['harga_last']),5);	
								$brg['det_total2'] = round(((float)$qty_hasil * (float)$brg['harga_jual']),5);
								$brg['qty_pemakaian'] = $qty_paksat_input;
								$brg['qty_dibutuhkan'] = $qty_butuh;
								$brg['qty_satuan'] = $qty_hasil;
								$brg['qty_default'] = ($brg['jenis_tbl'] == "bb" ? $qty_hasil : $qty_kemsat_input);
								$brg['satuan_pakai'] = $qty_paksat;
								$brg['satuan_butuh'] = $qty_kemsat;
								$brg['qty_kemasan'] = $qty_kemsat_input;
								if ($brg['jenis_tbl'] == "mnf") {
									
								}
							}

							if ($tbl == "mnf") {
								if ($brg['jenis_tbl'] == "bb") {
									$brg['qty_dibutuhkan'] = $qty_butuh;
								}
							}
						}
					}
				}
			}
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);

		$this->hitung_all_mnf($is_adj);

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;
		$total_hj = 0;
		$total_st = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$total_qty += $brg['qty_satuan'];
								$total_pakai += $brg['qty_pemakaian'];
								$total_butuh += $brg['qty_dibutuhkan'];
								$total_hj += $brg['harga_jual'];
								$total_st += $brg['det_total2'];
							}
						}
					}
				}
			}
		}

		echo json_encode(array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh,
			"harga_jual" =>$total_hj,
			"sub_total" =>$total_st
		));
	}

	public function get_qty_cal()
	{
		$kode = $this->input->post('kode');

		$proses_id = 0 ;
		if ($kode == 3) {
			$proses_id = (int)$this->session->userdata('mnf_proses_id');
		}else if ($kode == 4) {
			$proses_id = (int)$this->session->userdata('trial_proses_id');
		}
        

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;
		$total_hj = 0;
		$total_sub = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == $kode){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$total_qty += $brg['qty_satuan'];
								$total_pakai += $brg['qty_pemakaian'];
								$total_butuh += $brg['qty_dibutuhkan'];
								$total_hj += $brg['harga_jual'];
								$total_sub += $brg['det_total2'];
							}
						}
					}
				}
			}
		}

		echo json_encode(array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh,
			"harga_jual" => $total_hj,
			"sub_total" => $total_sub
		));
	}

	public function get_edit_data_mnf($id_mnf = '')
	{
		if ($id_mnf == '') {
			$id_mnf = $this->input->post('id_mnf');
		}
		
		$hasil = array();
		$data = array();
		$trans_no = '';

		$proses_id = (int)$this->getProsesMnf();
		$pid = $proses_id;
		
		$selrs = array(
			'select' => array('a.*', 'b.keterangan as ketbb'),
	    	'table' => 'tm_produksi a',
	    	'join' => array(
	    					'tset_bb b' => 'a.bb_no = b.bb_no'),
	    	'where'	=>array('a.pr_no' => $id_mnf),
	    	'limit' => 1
	    );

		$srs = $this->setting_model->commonGet($selrs);
		if (is_array($srs) || is_object($srs)){
		    foreach($srs as $rs) {

		    	$UserAdd = $rs->user_id;
				
				$CreateDate = $rs->create_date;

		    	$hasil['parent_prod'] = array(
		    		"trans_date" => $rs->pr_date,
		    		"trans_no" => $rs->pr_no,
		    		"no_bb" => $rs->bb_no,
					"is_adj" => $rs->is_adjust,
					"ket_mnf" => (is_null($rs->pr_ket)? " " : $rs->pr_ket),					
					"gud_no" => $rs->gud_no
				);

				$trans_no = $rs->pr_no;
		    }
		}

		$selrs2 = array(
			'select' => array('a.*',' b.prod_code0', 'b.prod_name0', 'c.gud_code','b.prod_uom','b.prod_uom2', 'b.prod_uom3', 'b.acc_brg as rek_no','b.konversi1', 'b.konversi2', 'b.konversi2', 'x.jenis_brg', 'b.qty_kemasan', 'x.harga_satuan'),
	    	'table' => 'td_produksi x',
	    	'join' => array(
	    					'tdetail_out a' => 'x.det_pr_no = a.det_sales_no',
	    					'tproduct b' => 'a.prod_no = b.prod_no',
	    					'tgudang c' => 'a.gud_no = c.gud_no'),
	    	'where'	=> array(
	    					'x.pr_no' => $trans_no, 
	    					'x.jenis_brg <>' => 0),
	    	'order' => array('a.det_sales_no' => 'ASC')
	    );

		$srs2 = $this->setting_model->commonGet($selrs2);

		$dsntmp = array();

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		$all = array();
		// $response = array();
	    $post = array();

	    $post = array(
	    	"id_trans" => $pid,
			"is_edit" => 1,
			"trans_no" => $trans_no,
	        "detail_trans"   => $dsntmp
	    );

		$dsn = array();

		$id_det = (int)$this->get_id_det_trans(3,$proses_id);

		$satuan = '';
		$konversi = 0;

		if (is_array($srs2) || is_object($srs2)){
		    foreach($srs2 as $rs2) {

		    	if($rs2->satuan == 1){
		    		$satuan = $rs2->prod_uom;
		    		$konversi = $rs2->konversi1;
		    	}else if ($rs2->satuan == 2) {
		    		$satuan = $rs2->prod_uom2;
		    		$konversi = $rs2->konversi2;
		    	}else if ($rs2->satuan == 3) {
		    		$satuan = $rs2->prod_uom3;
		    		$konversi = $rs2->konversi3;
		    	}else{
		    		$satuan = $rs2->prod_uom;
		    		$konversi = $rs2->konversi1;
		    	}

		    	if ($rs2->jenis_brg == 1) {
					$jenis_brg = "Rote";
				}else if($rs2->jenis_brg == 2) {
					$jenis_brg = "Produksi";
				}else{
					$jenis_brg = "Rote";
				}

				$dsn[] = array(
				        "id_det" => $id_det++,
						"jenis_brg" => $jenis_brg,
						"prod_code" => $rs2->prod_code0,
						"prod_name" => $rs2->prod_name0,
						"prod_no" => $rs2->prod_no,
						"satuan" => $satuan,
						"qty_satuan" => $rs2->qty_satuan * -1,
						"konversi" => $konversi,
						"harga_satuan" => $rs2->harga_satuan,
						"harga_last" => 0,
						"harga_jual" => $rs2->harga_satuan,
						"det_total1" => 0,
						"det_total2" => ($rs2->qty_satuan * -1) * $rs2->harga_satuan,
						"keterangan" => " ",
						"qty_default" => 0,
						"qty_kemasan" => $rs2->qty_kemasan,
						"qty_pemakaian" => 0,
						"qty_dibutuhkan" => 0,
						"satuan_pakai" => " ",
						"satuan_butuh" => " ",
						"is_new" => 0,
						"jenis_tbl" => "mnf"
				);
		    }

		}

		$selrs3 = array(
			'select' => array('a.*', 'b.prod_code0', 'b.prod_name0', 'c.gud_code','b.prod_uom',' b.prod_uom2', 'b.prod_uom3','b.konversi1', 'b.konversi2', 'b.konversi2', 'b.acc_brg as rek_no', 'b.qty_kemasan', 'x.qty_default','x.qty_pemakaian', 'x.qty_dibutuhkan', 'x.satuan_pakai', 'x.satuan_butuh', 'x.harga_satuan'),
	    	'table' => 'td_produksi x',
	    	'join' => array(
	    					'tdetail_out a' => 'x.det_pr_no = a.det_sales_no',
	    					'tproduct b' => 'a.prod_no = b.prod_no',
	    					'tgudang c' => 'a.gud_no = c.gud_no'),
	    	'where'	=> array(
	    					'x.pr_no' => $trans_no, 
	    					'x.jenis_brg' => 0),
	    	'order' => array('a.det_sales_no' => 'ASC')
	    );

		$srs3 = $this->setting_model->commonGet($selrs3);

		if (is_array($srs3) || is_object($srs3)){
		    foreach($srs3 as $rs3) {
				if($rs3->satuan == 1){
		    		$satuan = $rs3->prod_uom;
		    		$konversi = $rs3->konversi1;
		    	}else if ($rs3->satuan == 2) {
		    		$satuan = $rs3->prod_uom2;
		    		$konversi = $rs3->konversi2;
		    	}else if ($rs3->satuan == 3) {
		    		$satuan = $rs3->prod_uom3;
		    		$konversi = $rs3->konversi3;
		    	}

				$jenis_brg = "Rote";

				$dsn[] = array(
				        "id_det" => $id_det++,
						"jenis_brg" => $jenis_brg,
						"prod_code" => $rs3->prod_code0,
						"prod_name" => $rs3->prod_name0,
						"prod_no" => $rs3->prod_no,
						"satuan" => $satuan,
						"qty_satuan" => $rs3->qty_satuan,
						"konversi" => $konversi,
						"harga_satuan" => $rs3->harga_satuan,
						"harga_last" => $rs3->out_det_buy_price,
						"harga_jual" => $rs3->harga_satuan,
						"det_total1" => ($rs3->qty_satuan * $rs3->out_det_buy_price),
						"det_total2" => ($rs3->qty_satuan * $rs3->harga_satuan),
						"keterangan" => " ",
						"qty_default" => $rs3->qty_default,
						"qty_kemasan" => $rs3->qty_kemasan,
						"qty_pemakaian" => $rs3->qty_pemakaian,
						"qty_dibutuhkan" => $rs3->qty_dibutuhkan,
						"satuan_pakai" => $rs3->satuan_pakai,
						"satuan_butuh" => $rs3->satuan_butuh,
						"is_new" => 0,
						"jenis_tbl" => "bb"
				);
		    }

		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 3) {
		    	array_push($key['detail'],$post);
		    }
		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 3) {
		    	foreach ($key['detail'] as &$val) {
		    		if($val['id_trans'] == $pid){
		    			for($i = 0; $i < count($dsn); $i++){
		    				array_push($val['detail_trans'],$dsn[$i]);
		    			}
		    		}
		    	}
		    }
		}
		
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);



	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;
		$total_hj = 0;
		$total_sub = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$total_qty += $brg['qty_satuan'];
								$total_pakai += $brg['qty_pemakaian'];
								$total_butuh += $brg['qty_dibutuhkan'];
								$total_hj += $brg['harga_jual'];
								$total_sub += $brg['det_total2'];
							}
						}
					}
				}
			}
		}

		$hasil['child_prod'] = array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh,
			"harga_jual" => $total_hj,
			"sub_total" => $total_sub
		);

		echo json_encode($hasil);
	}

	public function hitung_all_mnf($is_adj='',$id= '', $value = '')
	{
		$is_post = 0;
		$proses_id = 0 ;
	    $proses_id = (int)$this->session->userdata('mnf_proses_id');

		if ($is_adj == '') {
			$is_adj = $this->input->post('is_adj');
			$id = $this->input->post('id');
			$value = $this->input->post('value');
			$is_post = 1;
		}

		if($is_post <> 0){
			if($id <> 0){
			// read file
				$data_json2 = file_get_contents('./transaction_data.json');
				// decode json to associative array
				$json_arr2 = json_decode($data_json2, true);
				// encode array to json and save to file

				$uk = array(
					array("satuan" => "KG", "value" => 1),
					array("satuan" => "HG", "value" => 10),
					array("satuan" => "DAG", "value" => 100),
					array("satuan" => "G", "value" => 1000),
					array("satuan" => "DG", "value" => 10000),
					array("satuan" => "CG", "value" => 100000),
					array("satuan" => "MG", "value" => 1000000)
				);

				$QtyBagi = 0;
				$QtyHsl = 0;
				$QtyHit = 0;
				$QtyHp = 0;
				$QtyPakai = 0;

				foreach ($json_arr2['transaksi'] as &$key) {
		        	if($key['id'] == 3){
						foreach ($key['detail'] as &$val) {
							if($val['id_trans'] == ((int)$proses_id)){
								foreach ($val['detail_trans'] as &$brg) {
									if ($brg['jenis_tbl'] == "mnf" && $brg['id_det'] == ((int)$id)) {
										$brg['qty_kemasan'] = $value;

										$QtyPemakaian = $brg['qty_pemakaian'];
										$QtyKemasan = $value;
										$SatPakai = $brg['satuan_pakai'];
										$SatKemas = $brg['satuan_butuh'];
										$QtyButuh = $brg['qty_dibutuhkan'];

										foreach($uk as $row=>$kuk){
											if($SatPakai == $kuk['satuan']){
												$SatPakai = $row;
											}
											
											if($SatKemas == $kuk['satuan']){
												$SatKemas = $row;
											}
										}

										if(($SatPakai) > ($SatKemas)){
											$QtyBagi = (($SatPakai) - ($SatKemas));
											foreach($uk as $row=>$kuk){
												if($row == $QtyBagi){
													$QtyHit = $kuk['value'];
												}
											}

											$QtyHsl = ($QtyPemakaian) / ($QtyHit);
										}else if (($SatPakai) < ($SatKemas)) {
											$QtyBagi = (($SatKemas) - ($SatPakai));
											foreach($uk as $row=>$kuk){
												if($row == $QtyBagi){
													$QtyHit = $kuk['value'];
												}
											}
											$QtyHsl = ($QtyPemakaian) * ($QtyHit);
										}else{
											$QtyBagi = (($SatPakai) - ($SatKemas));
											foreach($uk as $row=>$kuk){
												if($row == $QtyBagi){
													$QtyHit = $kuk['value'];
												}
											}
											$QtyHsl = ($QtyPemakaian) / ($QtyHit);
										}

										// console.log(QtyBagi, QtyHit, QtyHsl);

										if (($QtyKemasan) != 0) {
											$QtyHsl = $QtyHsl / ($QtyKemasan);
										}else{
											$QtyHsl = 0;
										}

										$QtyHp = ($QtyHsl) * ($QtyButuh);

										$brg['qty_satuan'] = $QtyHp;
										
									}
								}
							}
						}
					}
				}

				$json_body2 = json_encode($json_arr2);
				file_put_contents('./transaction_data.json', $json_body2);

			}
		}
		

		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$Total = 0;
    	$TotQty = 0;
    	$TotQtyKemasan = 0;
    	$HgJual = 0;

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == (int)$proses_id){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$Total += $brg['det_total1'];
        						$TotQty += $brg['qty_satuan'];
        						$HgJual += $brg['harga_jual'];
							}

							if($brg['jenis_tbl'] == "mnf"){
								$TotQtyKemasan += ($brg['qty_satuan'] * ($brg['qty_default'] == 0 ? 1 : $brg['qty_default']));
							}
						}
					}
				}
			}
		}

		$TotQty = 0;
		$TotPakai = 0;
		$HgJual = 0;
		$TotButuh = 0;
    	$TotHgjual = 0;

    	foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == (int)$proses_id){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								if ($is_adj <> 0) {
									$brg['qty_satuan'] = $brg['qty_default'];
								}else{
									if ($TotQtyKemasan <> 0) {
										$qty_kem = $brg['qty_default'];
										$brg['qty_satuan'] = (($qty_kem == 0 ? 1 : $qty_kem) * $TotQtyKemasan);
									}
								}
								
        						$brg['det_total1'] = round(($brg['qty_satuan'] * $brg['harga_last']),5);
        						// $brg['det_total2'] = $brg['qty_satuan'] * $brg['harga_satuan'];
        						$brg['det_total2'] = round(($brg['qty_satuan'] * $brg['harga_jual']),5);

        						$TotQty += $brg['qty_satuan'];
						        $TotPakai += $brg['qty_pemakaian'];
						        $TotButuh += $brg['qty_dibutuhkan'];
						        $HgJual += $brg['harga_jual'];
						        $TotHgjual += $brg['det_total2'];
							}

							if($brg['jenis_tbl'] == "mnf"){
								$brg['harga_jual'] = round(((((($brg['qty_satuan'] * $brg['qty_default']) / $TotQtyKemasan) * ($TotHgjual == 0 ? 1 : $TotHgjual))) / ($brg['qty_satuan'])),5);
        						$brg['det_total2'] = round(($brg['harga_jual'] * ($brg['qty_satuan'])),5);
							}
						}
					}
				}
			}
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);

		if($is_post == 1){
			$total_qty = 0;
			$total_pakai = 0;
			$total_butuh = 0;
			$total_hj = 0;
			$total_st = 0;

			$data_json2 = file_get_contents('./transaction_data.json');

			$json_arr2 = json_decode($data_json2, true);

			foreach ($json_arr2['transaksi'] as &$key) {
	        	if($key['id'] == 3){
					foreach ($key['detail'] as &$val) {
						if($val['id_trans'] == ((int)$proses_id)){
							foreach ($val['detail_trans'] as &$brg) {
								if ($brg['jenis_tbl'] == "bb") {
									$total_qty += $brg['qty_satuan'];
									$total_pakai += $brg['qty_pemakaian'];
									$total_butuh += $brg['qty_dibutuhkan'];
									$total_hj += $brg['harga_jual'];
									$total_st += $brg['det_total2'];
								}
							}
						}
					}
				}
			}

			echo json_encode(array(
				"qty_satuan" => $total_qty,
				"qty_pakai" => $total_pakai,
				"qty_butuh" =>$total_butuh,
				"harga_jual" =>$total_hj,
				"sub_total" =>$total_st
			));
		}

	}

	public function check_id_pur($trans_no,$tgl,$gud,$catgud)
	{
		$is_existpur;
        						
		do{
			$selid = array(
				'select' => array('count(pr_no) as hasil'),
				'table' => 'tm_produksi',
				'where' =>array('pr_no' => $trans_no)
			);

			$sid = $this->setting_model->commonGet($selid);

			if (is_array($sid)||is_object($sid)) {
				foreach ($sid as $spur) {
					if ($spur->hasil > 0) {
						$id = $this->setting_model->GetNoIDMaster($tgl,'PRD','jual_no','tsales_produksi_'.$gud, $catgud);
						$is_existpur = 1;
					}else{
						$is_existpur = 0;
						return $id;
					}
				}
			}
		}while($is_existpur == 1);
	}

	public function check_id($tgl = '',$kode = '',$kolom = '', $tabel = '', $id_tbl = '', $catgud = '')
	{
		$id = $id_tbl;
		$is_exist;


		do{
			$seljid = array(
				'select' => array('count('.$kolom.') as hasil'),
				'table' => $tabel,
				'where' =>array($kolom => $id)
			);

			$sjid = $this->setting_model->commonGet($seljid);

			if (is_array($sjid)||is_object($sjid)) {
				foreach ($sjid as $kjid) {
					if ($kjid->hasil > 0) {
						$id = $this->setting_model->GetNoIDMaster($tgl,$kode,$kolom,$tabel,$catgud);
						$is_exist = 1;
					}else{
						$is_exist = 0;
						return $id;
					}
				}
			}
		}while($is_exist == 1);
	}

	public function check_id_tm($tgl = '',$kode = '',$kolom = '', $tabel = '', $id_tbl = '', $catgud = '')
	{
		$id = $id_tbl;
		$is_exist;

		do{
			$seljid = array(
				'select' => array('count(pr_no) as hasil'),
				'table' => 'tm_produksi',
				'where' =>array('pr_no' => $id)
			);

			$sjid = $this->setting_model->commonGet($seljid);

			if (is_array($sjid)||is_object($sjid)) {
				foreach ($sjid as $kjid) {
					if ($kjid->hasil > 0) {
						$id = $this->setting_model->GetNoIDMaster($tgl,$kode,$kolom,$tabel,$catgud);
						$is_exist = 1;
					}else{
						$is_exist = 0;
						return $id;
					}
				}
			}
		}while($is_exist == 1);
	}

	public function check_id_field($kolom = '', $tabel = '', $id_tbl = '')
	{
		$id = $id_tbl;
		$is_exist;

		do{
			$seljid = array(
				'select' => array('count('.$kolom.') as hasil'),
				'table' => $tabel,
				'where' =>array($kolom => $id)
			);

			$sjid = $this->setting_model->commonGet($seljid);

			if (is_array($sjid)||is_object($sjid)) {
				foreach ($sjid as $kjid) {
					if ($kjid->hasil > 0) {
						$id = $this->setting_model->GetNoIDField2($kolom,$tabel);
						$is_exist = 1;
					}else{
						$is_exist = 0;
						return $id;
					}
				}
			}
		}while($is_exist == 1);
	}

	public function act_insert_detail_trial($data)
	{
		$now = date('Y-m-d H:i:s');

		$jurno = '';
		$txtStr = '';
		$TotalHpp = 0;
		$TotalAfalan = 0;
		$id_tr = $this->session->userdata('trial_proses_id');
		$user_id = $this->session->userdata('person_id');
		$gud_act = $this->session->userdata('gud_no');
		$gud = $data['gud_no'];
		$data_json = file_get_contents('./transaction_data.json');
        $is_exist = 0;
        $json_arr = json_decode($data_json, true);
        $tgl = $data['rsl'];
        $GudNo = $gud;
        $catgud = $data['CatGudNo'];
        $is_adj = $data['is_adj'];
        $ket = $data['ket'];
        $no_bb = $data['no_bb'];
        $trans_no = $data['trans_no'];

        $this->db->trans_start();

		$selid = array(
			'select' => array('count(pr_no) as hasil'),
			'table' => 'tm_produksi_trial',
			'where' =>array('pr_no' => $trans_no)
		);

		$sid = $this->setting_model->commonGet($selid);

		if (is_array($sid)||is_object($sid)) {
			foreach ($sid as $kid) {
				if ($kid->hasil > 0) {
					$trans_no = $this->setting_model->GetNoIDMaster($tgl,'TRL','pr_no','tm_produksi_trial', $catgud);
				}
			}
		}

		$selbb = array(
			'select' => array('a.*','b.prod_uom','b.konversi1'),
			'table' => 'tset_bb a',
			'join' => array('tproduct b' => 'a.prod_no = b.prod_no'),
			'where' =>array('a.bb_no' => $no_bb)
		);

		// print_r($selbb);
		$sbb = $this->setting_model->commonGet($selbb);

		if (is_array($sbb)||is_object($sbb)) {
			foreach ($sbb as $kbb) {
				$insert = array(
					'insert' => array(
						'is_adjust' => $is_adj, 
						'gud_no' => $gud,
						'prod_no' => $kbb->prod_no, 
						'qty_satuan' => 1, 
						'konversi' => $kbb->konversi1, 
						'satuan' => $kbb->prod_uom, 
						'create_date' => $now, 
						'edit_date' => $now, 
						'user_edit' => $user_id, 
						'pr_no' => $trans_no, 
						'pr_date' => $tgl, 
						'pr_ket' => $ket, 
						'user_id' => $user_id, 
						'bb_no' => $no_bb, 
					),
					'table' => 'tm_produksi_trial'
				);

				$pr = $this->setting_model->commonInsert($insert);

				if($pr['code'] <> 00000 ){
		    		print_r("pr is error");
		    		die();
		    	}

				// print_r($pr);
			}
		}

		$jurnoku = $this->setting_model->GetNoIDMaster($tgl,'GL','jur_no','tjurnal', $catgud);

		$is_jurid = $this->check_id($tgl,'GL','jur_no','tjurnal',$jurnoku, $catgud);

		$jurnoku = $is_jurid;

		$txtStr = "Trial No. ".$trans_no."/".$ket;

		$jurno = $jurnoku;

		$insert2 = array(
			'insert' => array(
				'cab_no' => $catgud, 
				'jur_no' => $jurno,
				'jur_tgl' => $tgl, 
				'jur_ket' => $txtStr, 
				'user_id' => $user_id, 
				'jur_total' => 0, 
				'is_viewed' => 1 
			),
			'table' => 'tjurnal'
		);

		// print_r($insert2);

    	$ij = $this->setting_model->commonInsert($insert2);

    	if($ij['code'] <> 00000 ){echo "ij is error".$ij['message'];die();}

    	// print_r($ij);

    	$insert3 = array(
			'insert' => array(
				'cab_no' => $catgud, 
				'jur_no' => $jurno,
				'create_date' => $now, 
				'edit_date' => $now, 
				'user_edit' => $user_id, 
				'out_no' => $trans_no, 
				'out_date' => $tgl,
				'out_type' => 7, 
				'user_id' => $user_id, 
				'jual_no' => $trans_no
			),
			'table' => 'tout'
		);

    	// print_r($insert3);
    	$it = $this->setting_model->commonInsert($insert3);

    	if($it['code'] <> 00000 ){echo "it is error".$it['message'];die();}
    	// print_r($it);
								
    	foreach ($json_arr['transaksi'] as &$key) {
    		
        	if($key['id'] == 4){
        		
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_tr)){
						
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl'] == 'bb'){
								
								$KodeProd = $brg['prod_no'];
						        $JmlSatuan = $brg['qty_satuan'];
						        
						        $Satuan = 0;
						        $Konversi = 0;

						        $seluom = array(
						        	'select' => array('prod_uom', 'prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
						        	'table' => 'tproduct',
						        	'where' => array('prod_no' => $KodeProd)
						        );

						        $suom = $this->setting_model->commonGet($seluom);

						        if (is_array($suom) || is_object($suom)) {
						        	foreach ($suom as $kuom) {
						        		if($brg['satuan'] == $kuom->prod_uom){
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}else if ($brg['satuan'] == $kuom->prod_uom2) {
								    		$Satuan = 2;
						        			$Konversi = $kuom->konversi2;
								    	}else if ($brg['satuan'] == $kuom->prod_uom3) {
								    		$Satuan = 3;
						        			$Konversi = $kuom->konversi3;
								    	}else{
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}
						        	}
						        }

						        $JmlStok = $JmlSatuan * $Konversi;

						        if($brg['jenis_brg'] == "Rote"){
						        	$JenisBrg = 1;
						        }else if ($brg['jenis_brg'] == "Produksi") {
						        	$JenisBrg = 2;
						        }else{
						        	$JenisBrg = 1;
						        }

						        if($JmlStok <> 0){
						        	
						        	if($JmlStok<0){$JenisBrg = 1;}else{$JenisBrg = 0;}	
						        	
						        	$QtyRetur = 0;
						            $JumMax = 0;
						            $ProdHpp = 0;
						            $Max2Sell = 0;

						            $selkon = array(
						            	'select' => array('konversi1','konversi2','konversi3','prod_name0','prod_code0', 
										            		'is_stok','acc_brg'),
						            	'table' => 'tproduct',
						            	'where' => array('prod_no' => $KodeProd)
						            );

						            $sk = $this->setting_model->commonGet($selkon);

						            if(is_array($sk) || is_object($sk)){
						            	foreach ($sk as $skkey) {
						            		$RekProd = $skkey->acc_brg;
						            		if($RekProd == "" || ($this->setting_model->isRekNoExists($RekProd) == 0)){
						            			echo json_encode(array(
													"statusCode"=>301,
													"message" => "Account barang item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
												));
												die();	
						            		}

						            		$RekNoProduksi = $RekProd;
						            		$DetKonversi = $Konversi;
								            $Jml = $JmlStok * $DetKonversi;
								            $Boleh = 0;
								            $TheGudNo = $GudNo;
											$ProdHpp = 0;

											if($skkey->is_stok <= 1){
												$OldHpp = 0;

												if($JenisBrg == 0){
													$OldHpp = $ProdHpp;
                    								$Harga = $ProdHpp;
												}else if($JenisBrg == 1){
													$selhpp = array(
										            	'select' => array('a.price_netto'),
										            	'table' => 'td_set_hpp a',
										            	'join' => array('tset_hpp b' => 'a.hap_no = b.hap_no'),
										            	'where' => array('a.prod_no' => $KodeProd,
										            					'b.tgl <=' => $tgl),
										            	'order' => array('b.tgl' => 'DESC'),
										            	'limit' => '1'

										            );

										            $sh = $this->setting_model->commonGet($selhpp);

										            if(is_array($sh) || is_object($sh)){
										            	foreach ($sh as $shkey) {
										            		$OldHpp = (is_null($shkey['price_netto']) ? 0 : $shkey['price_netto']);
										            	}
										            }else{
										            	echo "sh is error";
										            }
										            $Harga = $OldHpp;
												}
											}else{
												$OldHpp = 0;

												$selhpp2 = array(
									            	'select' => array('a.price_netto'),
									            	'table' => 'td_set_hpp a',
									            	'join' => array('tset_hpp b' => 'a.hap_no = b.hap_no'),
									            	'where' => array('a.prod_no' => $KodeProd,
									            					'b.tgl <=' => $tgl),
									            	'order' => array('b.tgl' => 'DESC'),
									            	'limit' => '1'

									            );

									            $sh2 = $this->setting_model->commonGet($selhpp2);

									            if(is_array($sh2) || is_object($sh2)){
									            	foreach ($sh2 as $shkey2) {
									            		$OldHpp = (is_null($shkey2['price_netto']) ? 0 : $shkey2['price_netto']);
									            	}
									            }

									            $Harga = $OldHpp;
											}

											$NewPrice = 0;

											$DetPrNoku = $this->setting_model->GetNoIDField2("det_pr_no", "td_produksi_trial");

											$DetPrNo = $DetPrNoku;

											$ins_prod = array(
												'insert' => array(
													'jenis_brg' => $JenisBrg, 
													'nama_brg' => $brg['prod_name'], 
													'gud_no' => $TheGudNo, 
													'det_pr_no' => $DetPrNo, 
													'pr_no' => $trans_no, 
													'prod_no' => $brg['prod_no'], 
													'satuan' => $brg['satuan'],
													'konversi' => $brg['konversi'], 
													'qty_satuan' => $brg['qty_satuan'], 
													'qty_default' => $brg['qty_default'], 
													'qty_pemakaian' => $brg['qty_pemakaian'], 
													'qty_dibutuhkan' => $brg['qty_dibutuhkan'], 
													'satuan_pakai' => $brg['satuan_pakai'], 
													'satuan_butuh' => $brg['satuan_butuh']
												),
												'table' => 'td_produksi_trial'
											);
											// print_r($ins_prod);
									    	$ip = $this->setting_model->commonInsert($ins_prod);

									    	if($ip['code'] <> 00000 ){echo "ip is error";die();}
									    	// print_r($ip);

									    	$DetNoku = $this->setting_model->GetNoIDField2("out_det_no", "tdetail_out");

											$DetNo = $DetNoku;

									    	$ins_out = array(
												'insert' => array(
													'gud_no' => $TheGudNo, 
													'Out_Det_No' => $DetNo, 
													'Out_no'=>$trans_no, 
													'prod_no'=>$brg['prod_no'],
													'out_det_qty'=>$Jml, 
													'price_netto'=>$Harga, 
													'det_sales_no'=>$DetPrNo, 
													'qty_satuan'=>$brg['qty_satuan'], 
													'konversi'=>$brg['konversi'], 
													'satuan' =>$brg['satuan']
												),
												'table' => 'tdetail_out'
											);

											// print_r($ins_out);

									    	$io = $this->setting_model->commonInsert($ins_out);

									    	if($io['code'] <> 00000 ){echo "io is error";die();}

									    	// print_r($io);

									    	if($JenisBrg = 0){
									    		$TotalHpp = $TotalHpp + ($Jml * $Harga);
									    	}else if($JenisBrg = 1){
									    		$TotalAfalan = $TotalAfalan + (abs($Jml) * $Harga);
									    	}

									    	$HasilProduk = $Jml * $Harga;

									    	$txtStr = "Detail Bahan Baku No. ".$trans_no." ".$brg['prod_code']." - ".$brg['prod_name'];

									    	$JurDetNoku = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
									    	$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNoku);

        									$JurDetNoku = $is_jid;

									    	$JurDetNo = $JurDetNoku;

									    	$ins_tdjur = array(
												'insert' => array(
													'jur_det_no' => $JurDetNo, 
													'jur_no' => $jurno, 
													'rek_no'=>$RekProd, 
													'kredit'=>strval($HasilProduk),
													'debet'=>0, 
													'keterangan'=>$txtStr, 
													'kredit_kurs'=>strval($HasilProduk), 
													'debet_kurs'=>0
												),
												'table' => 'tdjurnal'
											);

											// print_r($ins_tdjur);

									    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

									    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

									    	// print_r($itdj);

									    	$up_trek = array(
												'update' => array(
													'saldo' => 'saldo - '.$HasilProduk
												),
												'table' => 'trek',
												'where' => array(
															'rek_no' => $RekProd)
											);
									    	// print_r($up_trek);

									    	$utr = $this->setting_model->commonUpdate($up_trek);

									    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

									    	// print_r($utr);

									    	$up_tdout = array(
												'update' => array(
													'rek_brg' => $RekProd,
													'jur_det_no1' => $JurDetNo
												),
												'table' => 'tdetail_out',
												'where' => array(
															'out_det_no' => $DetNo)
											);

									    	// print_r($up_tdout);

									    	$utdo = $this->setting_model->commonUpdate($up_tdout);

									    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

									    	// print_r($utdo);

									    	$JurDetNoku = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");

									    	$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNoku);

        									$JurDetNoku = $is_jid;

									    	$JurDetNo = $JurDetNoku;

									    	$ins_tdjur = array(
												'insert' => array(
													'jur_det_no' => $JurDetNo, 
													'jur_no' => $jurno, 
													'rek_no'=>strval($RekNoProduksi), 
													'debet'=>strval($HasilProduk), 
													'kredit'=> 0,
													'keterangan'=>$txtStr, 
													'debet_kurs'=>strval($HasilProduk),
													'kredit_kurs'=> 0
												),
												'table' => 'tdjurnal'
											);

									    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

									    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

									    	// print_r($itdj);

									    	$up_trek = array(
												'update' => array(
													'saldo' => 'saldo + '.strval($HasilProduk)
												),
												'table' => 'trek',
												'where' => array(
															'rek_no' => $RekNoProduksi)
											);

									    	$utr = $this->setting_model->commonUpdate($up_trek);

									    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

									    	// print_r($utr);

									    	$up_tdout = array(
												'update' => array(
													'rek_unbill_gr' => $RekNoProduksi,
													'jur_det_no2' => $JurDetNo
												),
												'table' => 'tdetail_out',
												'where' => array(
															'out_det_no' => $DetNo)
											);

									    	$utdo = $this->setting_model->commonUpdate($up_tdout);

									    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}
						            	}	
						            }else{
						            	echo json_encode(array(
											"statusCode"=>301,
											"message" => "bb Bahan baku item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
										));
										die();
						            	
						            }
						        }
							}
							
							$JmlStok = 0;
    						$JmlAfal = 0;

							if($brg['jenis_tbl'] == 'mnf'){
								if($brg['jenis_brg'] == "Produksi"){
									$JmlStok = $JmlStok + ($brg['konversi'] * $brg['qty_satuan']);
								}else{
									$JmlAfal = $JmlAfal + ($brg['konversi'] * $brg['qty_satuan']);
								}
							}

							$HargaAwal = 0;

							if ($JmlStok <> 0) {
								$HargaAwal = ($TotalHpp - $TotalAfalan) / ($JmlStok);
							}else{
								if ($JmlAfal <> 0) {
									$HargaAwal = ($TotalHpp - $TotalAfalan) / ($JmlAfal);
								}
							}

							if($brg['jenis_tbl'] == 'mnf'){
								$Jml = $brg['qty_satuan'];
								$Boleh = 0;
								$TheGudNo = $GudNo;
						        $KodeProd = $brg['prod_no'];

						        $Satuan = 0;
						        $Konversi = 0;

						        $seluom = array(
						        	'select' => array('prod_uom', 'prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
						        	'table' => 'tproduct',
						        	'where' => array('prod_no' => $KodeProd)
						        );

						        $suom = $this->setting_model->commonGet($seluom);

						        if (is_array($suom) || is_object($suom)) {
						        	foreach ($suom as $kuom) {
						        		if($brg['satuan'] == $kuom->prod_uom){
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}else if ($brg['satuan'] == $kuom->prod_uom2) {
								    		$Satuan = 2;
						        			$Konversi = $kuom->konversi2;
								    	}else if ($brg['satuan'] == $kuom->prod_uom3) {
								    		$Satuan = 3;
						        			$Konversi = $kuom->konversi3;
								    	}else{
								    		$Satuan = 1;
						        			$Konversi = $kuom->konversi1;
								    	}
						        	}
						        }
						        $JmlStok = $Jml * $Konversi;

						        if($brg['jenis_brg'] == "Rote"){
						        	$JenisBrg = 1;
						        }else if ($brg['jenis_brg'] == "Produksi") {
						        	$JenisBrg = 2;
						        }else{
						        	$JenisBrg = 1;
						        }

						        $InDetNoku = $this->setting_model->GetNoIDField2("det_pr_no", "td_produksi_trial");
						        $InDetNo = $InDetNoku;

						        $intdpro = array(
									'insert' => array(
										'jenis_brg' => strval($JenisBrg), 
										'nama_brg' => strval($brg['prod_name']),
										'gud_no' => $GudNo, 
										'det_pr_no' => $InDetNo, 
										'pr_no' => $trans_no, 
										'prod_no' => strval($brg['prod_no']), 
										'satuan' => strval($brg['satuan']),
										'konversi' => strval($brg['konversi']), 
										'qty_satuan' => strval($brg['qty_satuan']),
										'qty_default' => $brg['qty_default'], 
										'qty_pemakaian' => $brg['qty_pemakaian'], 
										'qty_dibutuhkan' => $brg['qty_dibutuhkan'], 
										'satuan_pakai' => $brg['satuan_pakai'], 
										'satuan_butuh' => $brg['satuan_butuh'],
										'harga_satuan' => strval($brg['harga_jual']),
										// 'det_total' => strval($brg['det_total2'])
									),
									'table' => 'td_produksi_trial'
								);

						    	$itprod = $this->setting_model->commonInsert($intdpro);

						    	if($itprod['code'] <> 00000 ){echo "itprod is error".$itprod['message'];die();}

						    	$selrd = array(
						    		'select' => array('b.konversi1', 
						    						'b.konversi2', 
						    						'b.konversi3', 
						    						'b.prod_name0', 
						    						'b.prod_code0', 
						    						'is_stok', 
						    						'acc_brg'),
						    		'table' => 'tproduct b',
						    		'where' => array('b.prod_no' => $KodeProd)
						    	);

						    	$srd = $this->setting_model->commonGet($selrd);
						    	// die();

						    	if(is_array($srd)||is_object($srd)){
									foreach ($srd as $rd) {
						    			$RekProd = $rd->acc_brg."";
						    		}	
						    	}else{
						    		echo json_encode(array(
										"statusCode"=>301,
										"message" => "mnf Bahan baku item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
									));
									die();
						    	}

						    	if ($RekProd == '' || ($this->setting_model->isRekNoExists($RekProd) == 0)) {
						    		echo json_encode(array(
										"statusCode"=>301,
										"message" => "Account barang item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
									));
									die();	
						    	}

						    	$RekNoProduksi = $RekProd;

						    	$NewPrice = 0;
                    
        						$DetNo = $this->setting_model->GetNoIDField2("out_det_no", "tdetail_out");

        						$ins_out = array(
									'insert' => array(
										'gud_no' => $TheGudNo, 
										'qty_satuan' => strval($Jml * -1), 
										'satuan'=> strval($brg['satuan']), 
										'konversi'=>strval($Konversi),
										'out_det_buy_price'=>strval($HargaAwal), 
										'out_det_no'=>$DetNo, 
										'out_no'=>$trans_no, 
										'prod_no'=>$KodeProd, 
										'out_det_qty'=>strval($JmlStok * -1), 
										'out_det_sell_price' => strval($HargaAwal),
										'price_netto' => strval($HargaAwal),
										'det_sales_no' => $InDetNo 
									),
									'table' => 'tdetail_out'
								);

						    	$io = $this->setting_model->commonInsert($ins_out);

						    	if($io['code'] <> 00000 ){echo "io is error";die();}

						    	$txtStr = "Detail Produksi No. ".$trans_no." ".$brg['prod_code']." - ".$brg['prod_name'];
        						$HasilProduk = $JmlStok * $HargaAwal;

        						$JurDetNo = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
        						$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNo);

        						$JurDetNo = $is_jid;

        						$ins_tdjur = array(
									'insert' => array(
										'jur_det_no' => $JurDetNo, 
										'jur_no' => $jurno, 
										'rek_no'=>$RekProd, 
										'debet'=>strval($HasilProduk),
										'kredit'=>0, 
										'keterangan'=>$txtStr, 
										'debet_kurs'=>strval($HasilProduk), 
										'kredit_kurs'=>0
									),
									'table' => 'tdjurnal'
								);

						    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

						    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

						    	$up_trek = array(
									'update' => array(
										'saldo' => 'saldo + '.$HasilProduk
									),
									'table' => 'trek',
									'where' => array(
												'rek_no' => $RekProd)
								);

						    	$utr = $this->setting_model->commonUpdate($up_trek);

						    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

						    	$up_tdout = array(
									'update' => array(
										'rek_brg' => $RekProd,
										'jur_det_no1' => $JurDetNo
									),
									'table' => 'tdetail_out',
									'where' => array(
												'out_det_no' => $DetNo)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

						    	$JurDetNo = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
        						$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNo);

        						$JurDetNo = $is_jid;

						    	$ins_tdjur = array(
									'insert' => array(
										'jur_det_no' => $JurDetNo, 
										'jur_no' => $jurno, 
										'rek_no'=>$RekNoProduksi, 
										'kredit'=>strval($HasilProduk), 
										'debet'=>0,
										'keterangan'=>$txtStr, 
										'kredit_kurs'=>strval($HasilProduk),
										'debet_kurs'=>0
									),
									'table' => 'tdjurnal'
								);

						    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

						    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

						    	$up_trek = array(
									'update' => array(
										'saldo' => 'saldo - '.strval($HasilProduk)
									),
									'table' => 'trek',
									'where' => array(
												'rek_no' => $RekNoProduksi)
								);

						    	$utr = $this->setting_model->commonUpdate($up_trek);

						    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

						    	$up_tdout = array(
									'update' => array(
										'rek_unbill_gr' => $RekNoProduksi,
										'jur_det_no2' => $JurDetNo
									),
									'table' => 'tdetail_out',
									'where' => array(
												'out_det_no' => $DetNo)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}
							}

							if($no_bb <> ""){
								$up_tdout = array(
									'update' => array(
										'is_pakai' => 'is_pakai + 1'),
									'table' => 'tset_bb',
									'where' => array('bb_no' => $no_bb)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}
							}
						}
					}
				}
			}
		}

		$Add = 0;
		$OutNo = $trans_no;
		$SaveData = 1;

		if ($this->db->trans_status() <> TRUE) {
	        $this->db->trans_rollback(); // roll back the transaction
	        if($Add == 1){
	        	$OutNo = "TRL".date('ymd')."-00000#";
	        }
	        return 0;
	        // return 0; // return FALSE if there is an error
	    } else {
	        $this->db->trans_commit(); // commit the transaction 
	        return 1; // return TRUE if the transaction succeeds
	    }
	}

	public function get_edit_data_trial($id_trial = '')
	{
		if ($id_trial == '') {
			$id_trial = $this->input->post('id_trial');
		}
		
		$hasil = array();
		$data = array();
		$trans_no = '';

		$proses_id = (int)$this->getProsesTrial();
		$pid = $proses_id;
		
		$selrs = array(
			'select' => array('a.*', 'b.keterangan as ketbb'),
	    	'table' => 'tm_produksi_trial a',
	    	'join' => array(
	    					'tset_bb b' => 'a.bb_no = b.bb_no'),
	    	'where'	=>array('a.pr_no' => $id_trial),
	    	'limit' => 1
	    );

		$srs = $this->setting_model->commonGet($selrs);
		if (is_array($srs) || is_object($srs)){
		    foreach($srs as $rs) {

		    	$UserAdd = $rs->user_id;
				
				$CreateDate = $rs->create_date;

		    	$hasil['parent_prod'] = array(
		    		"trans_date" => $rs->pr_date,
		    		"trans_no" => $rs->pr_no,
		    		"no_bb" => $rs->bb_no,
					"is_adj" => $rs->is_adjust,
					"ket_mnf" => (is_null($rs->pr_ket)? " " : $rs->pr_ket),					
					"gud_no" => $rs->gud_no
				);

				$trans_no = $rs->pr_no;
		    }
		}

		$selrs2 = array(
			'select' => array('a.*',' b.prod_code0', 'b.prod_name0', 'c.gud_code','b.prod_uom','b.prod_uom2', 'b.prod_uom3', 'b.acc_brg as rek_no','b.konversi1', 'b.konversi2', 'b.konversi2', 'x.jenis_brg', 'b.qty_kemasan', 'x.harga_satuan'),
	    	'table' => 'td_produksi_trial x',
	    	'join' => array(
	    					'tdetail_out a' => 'x.det_pr_no = a.det_sales_no',
	    					'tproduct b' => 'a.prod_no = b.prod_no',
	    					'tgudang c' => 'a.gud_no = c.gud_no'),
	    	'where'	=> array(
	    					'x.pr_no' => $trans_no, 
	    					'x.jenis_brg <>' => 0),
	    	'order' => array('a.det_sales_no' => 'ASC')
	    );

		$srs2 = $this->setting_model->commonGet($selrs2);

		$dsntmp = array();

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		$all = array();
		// $response = array();
	    $post = array();

	    $post = array(
	    	"id_trans" => $pid,
			"is_edit" => 1,
			"trans_no" => $trans_no,
	        "detail_trans"   => $dsntmp
	    );

		$dsn = array();

		$id_det = (int)$this->get_id_det_trans(4,$proses_id);

		$satuan = '';
		$konversi = 0;

		if (is_array($srs2) || is_object($srs2)){
		    foreach($srs2 as $rs2) {

		    	if($rs2->satuan == 1){
		    		$satuan = $rs2->prod_uom;
		    		$konversi = $rs2->konversi1;
		    	}else if ($rs2->satuan == 2) {
		    		$satuan = $rs2->prod_uom2;
		    		$konversi = $rs2->konversi2;
		    	}else if ($rs2->satuan == 3) {
		    		$satuan = $rs2->prod_uom3;
		    		$konversi = $rs2->konversi3;
		    	}else{
		    		$satuan = $rs2->prod_uom;
		    		$konversi = $rs2->konversi1;
		    	}

		    	if ($rs2->jenis_brg == 1) {
					$jenis_brg = "Rote";
				}else if($rs2->jenis_brg == 2) {
					$jenis_brg = "Produksi";
				}else{
					$jenis_brg = "Rote";
				}

				$dsn[] = array(
				        "id_det" => $id_det++,
						"jenis_brg" => $jenis_brg,
						"prod_code" => $rs2->prod_code0,
						"prod_name" => $rs2->prod_name0,
						"prod_no" => $rs2->prod_no,
						"satuan" => $satuan,
						"qty_satuan" => $rs2->qty_satuan * -1,
						"konversi" => $konversi,
						"harga_satuan" => $rs2->harga_satuan,
						"harga_last" => 0,
						"harga_jual" => $rs2->harga_satuan,
						"det_total1" => 0,
						"det_total2" => ($rs2->qty_satuan * -1) * $rs2->harga_satuan,
						"keterangan" => " ",
						"qty_default" => 0,
						"qty_kemasan" => $rs2->qty_kemasan,
						"qty_pemakaian" => 0,
						"qty_dibutuhkan" => 0,
						"satuan_pakai" => " ",
						"satuan_butuh" => " ",
						"is_new" => 0,
						"jenis_tbl" => "mnf"
				);
		    }

		}

		$selrs3 = array(
			'select' => array('a.*', 'b.prod_code0', 'b.prod_name0', 'c.gud_code','b.prod_uom',' b.prod_uom2', 'b.prod_uom3','b.konversi1', 'b.konversi2', 'b.konversi2', 'b.acc_brg as rek_no', 'b.qty_kemasan', 'x.qty_default','x.qty_pemakaian', 'x.qty_dibutuhkan', 'x.satuan_pakai', 'x.satuan_butuh', 'x.harga_satuan'),
	    	'table' => 'td_produksi_trial x',
	    	'join' => array(
	    					'tdetail_out a' => 'x.det_pr_no = a.det_sales_no',
	    					'tproduct b' => 'a.prod_no = b.prod_no',
	    					'tgudang c' => 'a.gud_no = c.gud_no'),
	    	'where'	=> array(
	    					'x.pr_no' => $trans_no, 
	    					'x.jenis_brg' => 0),
	    	'order' => array('a.det_sales_no' => 'ASC')
	    );

		$srs3 = $this->setting_model->commonGet($selrs3);

		if (is_array($srs3) || is_object($srs3)){
		    foreach($srs3 as $rs3) {
				if($rs3->satuan == 1){
		    		$satuan = $rs3->prod_uom;
		    		$konversi = $rs3->konversi1;
		    	}else if ($rs3->satuan == 2) {
		    		$satuan = $rs3->prod_uom2;
		    		$konversi = $rs3->konversi2;
		    	}else if ($rs3->satuan == 3) {
		    		$satuan = $rs3->prod_uom3;
		    		$konversi = $rs3->konversi3;
		    	}

				$jenis_brg = "Rote";

				$dsn[] = array(
				        "id_det" => $id_det++,
						"jenis_brg" => $jenis_brg,
						"prod_code" => $rs3->prod_code0,
						"prod_name" => $rs3->prod_name0,
						"prod_no" => $rs3->prod_no,
						"satuan" => $satuan,
						"qty_satuan" => $rs3->qty_satuan,
						"konversi" => $konversi,
						"harga_satuan" => $rs3->harga_satuan,
						"harga_last" => $rs3->out_det_buy_price,
						"harga_jual" => $rs3->harga_satuan,
						"det_total1" => ($rs3->qty_satuan * $rs3->out_det_buy_price),
						"det_total2" => ($rs3->qty_satuan * $rs3->harga_satuan),
						"keterangan" => " ",
						"qty_default" => $rs3->qty_default,
						"qty_kemasan" => $rs3->qty_kemasan,
						"qty_pemakaian" => $rs3->qty_pemakaian,
						"qty_dibutuhkan" => $rs3->qty_dibutuhkan,
						"satuan_pakai" => $rs3->satuan_pakai,
						"satuan_butuh" => $rs3->satuan_butuh,
						"is_new" => 0,
						"jenis_tbl" => "bb"
				);
		    }

		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 4) {
		    	array_push($key['detail'],$post);
		    }
		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 4) {
		    	foreach ($key['detail'] as &$val) {
		    		if($val['id_trans'] == $pid){
		    			for($i = 0; $i < count($dsn); $i++){
		    				array_push($val['detail_trans'],$dsn[$i]);
		    			}
		    		}
		    	}
		    }
		}
		
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);



	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;
		$total_hj = 0;
		$total_sub = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == 4){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$total_qty += $brg['qty_satuan'];
								$total_pakai += $brg['qty_pemakaian'];
								$total_butuh += $brg['qty_dibutuhkan'];
								$total_hj += $brg['harga_jual'];
								$total_sub += $brg['det_total2'];
							}
						}
					}
				}
			}
		}

		$hasil['child_prod'] = array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh,
			"harga_jual" => $total_hj,
			"sub_total" => $total_sub
		);

		echo json_encode($hasil);
	}

	public function fetch_bb_trial()
	{
		$type =$this->input->post('type');

        $data = array();
        $dtotp = array();
        $proses_id = 0;
		$idtr = 4;
		$proses_id = $this->session->userdata('trial_proses_id');

		if($type == 1){
			$idtr = 3;
			$proses_id = $this->session->userdata('mnf_proses_id');
		}

        
        $data_json = file_get_contents('./transaction_data.json');
        // $data['json_arr'] = json_decode($data_json, true);
        $json_arr = json_decode($data_json, true);

        $all= '';

        $a = 0;

        foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == $idtr){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl']=="bb"){
								$select = array(
									'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
									'table' => 'tproduct',
									'where' => array('prod_no' => $brg['prod_no'])
								);

						    	$sc = $this->setting_model->commonGet($select);

						    	foreach ($sc as $abc) {
						    		$uom = $abc->prod_uom;
						    		$uom2 = $abc->prod_uom2;
						    		$uom3 = $abc->prod_uom3;
						    		$kon1 = $abc->konversi1;
						    		$kon2 = $abc->konversi2;
						    		$kon3 = $abc->konversi3;
						    	}

								$sub_array = array();
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="prod_code" data-value="' . $brg['prod_code'] . '">' . $brg['prod_code'] . '</div>';
								$sub_array[] = '<div  data-id="'.$brg['id_det'].'" data-column="prod_name" data-value="' . $brg['prod_name'] . '">' . $brg['prod_name'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-bb-satuan" data-id="'.$brg['id_det'].'" data-column="satuan" data-value="' . $brg['satuan'] . '" data-uom="'.$uom.'" data-uom2="'.$uom2.'" data-uom3="'.$uom3.'" data-kon1="'.$kon1.'" data-kon2="'.$kon2.'" data-kon3="'.$kon3.'">' . $brg['satuan'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-qty-bb" data-id="'.$brg['id_det'].'" data-column="qty_satuan" data-value="' . $brg['qty_satuan'] . '">' . $brg['qty_satuan'] . '</div>';
								// $sub_array[] = '<div contenteditable class="update" data-id="'.$brg['id_det'].'" data-column="keterangan" data-value="' . $brg['keterangan'] . '">' . $brg['keterangan'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-bb-harga" data-id="'.$brg['id_det'].'" data-column="harga_last" data-value="' . $brg['harga_last'] . '">' . round($brg['harga_last'],5) . '</div>';
								$sub_array[] = '<div class="update-bb" data-id="'.$brg['id_det'].'" data-column="det_total1" data-value="' . $brg['det_total1'] . '">' . round($brg['det_total1'],5) . '</div>';
								$sub_array[] = '<a class="delete-bb" name="delete-bb" id="'.$brg['id_det'].'" href="" style="margin-right:15px;"><i class="fa fa-times"></i></a>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="qty_kemasan" data-value="' . $brg['qty_kemasan'] . '">' . $brg['qty_kemasan'] . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="qty_pemakaian" data-value="' . $brg['qty_pemakaian'] . '">' . $brg['qty_pemakaian'] . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="qty_dibutuhkan" data-value="' . $brg['qty_dibutuhkan'] . '">' . $brg['qty_dibutuhkan'] . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="harga_jual" data-value="' . $brg['harga_jual'] . '">' . round($brg['harga_jual'], 5) . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="det_total2" data-value="' . $brg['det_total2'] . '">' . round($brg['det_total2'],5) . '</div>';
								$dtotp[] = $sub_array;

								$a++;
							}
							
						}
						$all = (int)$a;
					}
					
				}
			}
		}

		$output = array(
		 "recordsTotal"  =>  $all,
		 "recordsFiltered" => $all,
		 "data"    => $dtotp
		);

		echo json_encode($output);
	}

	public function fetch_proses_trial()
	{
		$type =$this->input->post('type');

        $data = array();
        $dtotp = array();
        $proses_id = 0;
		$idtr = 4;
		$proses_id = $this->session->userdata('trial_proses_id');

		if($type == 1){
			$idtr = 3;
			$proses_id = $this->session->userdata('mnf_proses_id');
		}

        
        $data_json = file_get_contents('./transaction_data.json');
        // $data['json_arr'] = json_decode($data_json, true);
        $json_arr = json_decode($data_json, true);

        $all= '';

        $a = 0;

        foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == $idtr){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl']=="mnf"){
								$select = array(
									'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
									'table' => 'tproduct',
									'where' => array('prod_no' => $brg['prod_no'])
								);

						    	$sc = $this->setting_model->commonGet($select);

						    	foreach ($sc as $abc) {
						    		$uom = $abc->prod_uom;
						    		$uom2 = $abc->prod_uom2;
						    		$uom3 = $abc->prod_uom3;
						    		$kon1 = $abc->konversi1;
						    		$kon2 = $abc->konversi2;
						    		$kon3 = $abc->konversi3;
						    	}

								$sub_array = array();
								$sub_array[] = '<div contenteditable class="update-mnf" data-id="'.$brg['id_det'].'" data-column="prod_code" data-value="' . $brg['prod_code'] . '">' . $brg['prod_code'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-mnf" data-id="'.$brg['id_det'].'" data-column="prod_name" data-value="' . $brg['prod_name'] . '">' . $brg['prod_name'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-mnf-satuan" data-id="'.$brg['id_det'].'" data-column="satuan" data-value="' . $brg['satuan'] . '" data-uom="'.$uom.'" data-uom2="'.$uom2.'" data-uom3="'.$uom3.'" data-kon1="'.$kon1.'" data-kon2="'.$kon2.'" data-kon3="'.$kon3.'">' . $brg['satuan'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-qty-mnf" data-id="'.$brg['id_det'].'" data-column="qty_satuan" data-value="' . $brg['qty_satuan'] . '">' . $brg['qty_satuan'] . '</div>';
								$sub_array[] = '<div contenteditable class="update-mnf" data-id="'.$brg['id_det'].'" data-column="jenis_brg" data-value="' . $brg['jenis_brg'] . '">' . $brg['jenis_brg'] . '</div>';
								$sub_array[] = '<a class="delete-mnf" name="delete-mnf" id="'.$brg['id_det'].'" href="" style="margin-right:15px;"><i class="fa fa-times"></i></a>';
								$sub_array[] = '<div class="update-kemasan-mnf" data-id="'.$brg['id_det'].'" data-column="qty_kemasan" data-value="' . $brg['qty_kemasan'] . '">' . $brg['qty_kemasan'] . '</div>';
								$sub_array[] = '<div data-id="'.$brg['id_det'].'" data-column="harga_jual" data-value="' . $brg['harga_jual'] . '">' . round($brg['harga_jual'],5) . '</div>';
								$sub_array[] = '<div class="update-mnf" data-id="'.$brg['id_det'].'" data-column="det_total2" data-value="' . $brg['det_total2'] . '">' . round($brg['det_total2'],5) . '</div>';
								$dtotp[] = $sub_array;

								$a++;
							}
							
						}
						$all = (int)$a;
					}
					
				}
			}
		}

		$output = array(
		 "recordsTotal"  =>  $all,
		 "recordsFiltered" => $all,
		 "data"    => $dtotp
		);

		echo json_encode($output);
	}

	public function getProsesTrial()
	{
		$this->session->unset_userdata('trial_proses_id');
		$hasil = $this->get_id_proses(4,'trial_proses_id');

		return $hasil;
	}

	public function getGud()
	{
		$selgud = array(
			'select' => array('gud_no'),
			'table' => 'tgudang',
			'where' => array('is_delete' => 0,
							'is_default' => 1)
		);

		$sgud = $this->setting_model->commonGet($selgud);

		if (is_array($sgud)|| is_object($sgud)) {
			foreach ($sgud as $gudk) {
				$gud_no = $gudk->gud_no;
			}
		}

		echo json_encode(array(
			"gud_no" => $gud_no
		));
	}

	public function delete_detail_trial($pr_id = '')
	{
		if($pr_id == ''){
			$pr_id = $this->input->post('proses_id');
			if($pr_id == ''){
				$pr_id = (int)$this->session->userdata('trial_proses_id');
			}
		}
		
		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          if($subKey['id'] == 4){
          	foreach ($subKey['detail'] as $subVal => $valArray) {
				if($valArray['id_trans'] == ((int)$pr_id)){
					unset($subKey['detail'][$subVal]);
				}
			}
          }
     	}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function get_bb_trial()
	{
		$id_bb = $this->input->post('id_bb');
		$tgl = $this->input->post('tgl');
		$data = array();

		$proses_id = 0;
        $proses_id = $this->session->userdata('trial_proses_id');
		
		if($proses_id == '' OR $proses_id == 0){
			$proses_id = (int)$this->getProsesTrial();	
		}else{
			$proses_id = $this->session->userdata('trial_proses_id');
			$this->delete_detail_trial($proses_id);
		}

		$pid = $proses_id;	
		
		$option2 = array(
			'select' => array(
								'td_set_bb.*',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3',
								'tproduct.qty_kemasan',
								'tproduct.prod_sell_price'
							),
	    	'table' => 'td_set_bb',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = td_set_bb.prod_no'),
	    	'where'	=>array('td_set_bb.bb_no' => $id_bb)
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);

		$dsntmp = array();

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		$all = array();
		// $response = array();
	    $post = array();

	    $post = array(
	    	"id_trans" => $pid,
			"is_edit" => 0,
			"trans_no" => "",
	        "detail_trans"   => $dsntmp
	    );

		$dsn = array();

		$id_det = (int)$this->get_id_det_trans(4,$proses_id);

		if (is_array($data['get_unit']) || is_object($data['get_unit'])){
		    foreach($data['get_unit'] as $right) {
				$select = array(
					'select' => array('prod_uom','prod_uom2', 'prod_uom3', 'konversi1', 'konversi2', 'konversi3'),
					'table' => 'tproduct',
					'where' => array('prod_no' => $right->prod_no)
				);

		    	$sc = $this->setting_model->commonGet($select);

		    	foreach ($sc as $val) {
		    		$uom = $val->prod_uom;
		    		$uom2 = $val->prod_uom2;
		    		$uom3 = $val->prod_uom3;
		    		$konv = $val->konversi1;
		    		$konv2 = $val->konversi2;
		    		$konv3 = $val->konversi3;
		    	}

		    	if($right->satuan == 1){
		    		$satuan = $uom;
		    		$konversi = $konv;
		    	}else if ($right->satuan == 2) {
		    		$satuan = $uom2;
		    		$konversi = $konv2;
		    	}else if ($right->satuan == 3) {
		    		$satuan = $uom3;
		    		$konversi = $konv3;
		    	}

				$dsn[] = array(
			        	"id_det" => $id_det++,
			        	"jenis_brg" => "",
			        	"prod_no" => $right->prod_no,
			        	"prod_code" => $right->prod_code0,
			        	"prod_name" => $right->prod_name0,
				        "satuan" => $satuan,
				        "qty_satuan" => $right->qty_satuan,
				        "konversi" => (int)$konversi,
				        "harga_satuan" => (float)$right->harga_satuan,
				        "harga_last" => $this->setting_model->GetLastHarga($right->prod_no, $tgl),
				        "harga_jual" => (float)$right->prod_sell_price,
				        "det_total1" => (float)($this->setting_model->GetLastHarga($right->prod_no, $tgl))*$right->qty_satuan,
				        "det_total2" => (float)$right->prod_sell_price * $right->qty_satuan,
				        "keterangan" => $right->keterangan,
				        "qty_default" => $right->qty_satuan,
				        "qty_kemasan" => ($right->qty_kemasan == 0 || is_null($right->qty_kemasan)  ? 1 : $right->qty_kemasan),
				        "qty_pemakaian" => $right->qty_pemakaian,
				        "qty_dibutuhkan" => $right->qty_dibutuhkan,
				        "satuan_pakai" => $right->satuan_pakai,
				        "satuan_butuh" => $right->satuan_butuh,
				        "is_new" => 1,
				        "jenis_tbl" => "bb"
				);
		    }

		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 4) {
		    	array_push($key['detail'],$post);
		    }
		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 4) {
		    	foreach ($key['detail'] as &$val) {
		    		if($val['id_trans'] == $pid){
		    			for($i = 0; $i < count($dsn); $i++){
		    				array_push($val['detail_trans'],$dsn[$i]);
		    			}
		    		}
		    	}
		    }
		}
		
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);

	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }

	}

	public function delete_bb_trial($id_det = "")
	{
		if($id_det == ''){
			$id_det = $this->input->post('id_det');
		}
		$tbl = $this->input->post('tbl');
		$proses_id = 0;
        $proses_id = $this->session->userdata('trial_proses_id');
		// get array index to delete
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          	if($subKey['id'] == 4){
          		foreach ($subKey['detail'] as &$subVal) {
					if($subVal['id_trans'] == ((int)$proses_id)){
						foreach ($subVal['detail_trans'] as $brg => $subArray) {
							if($subArray['id_det'] == (int)$id_det && $subArray['jenis_tbl'] == $tbl){
					           unset($subVal['detail_trans'][$brg]);
					        }
						}
					}
				}
			}
		}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;
		$total_hj = 0;
		$total_sub = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == 4){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$total_qty += $brg['qty_satuan'];
								$total_pakai += $brg['qty_pemakaian'];
								$total_butuh += $brg['qty_dibutuhkan'];
								$total_hj += $brg['harga_jual'];
								$total_sub += $brg['det_total2'];
							}
						}
					}
				}
			}
		}

		echo json_encode(array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh,
			"harga_jual" =>$total_hj,
			"sub_total" =>$total_sub
		));
	}

	public function update_bb_trial()
	{
		$id = $this->input->post('id');
		$column = $this->input->post('column');
	    $vl = $this->input->post('value');
	    $tbl = $this->input->post('tbl');
	    $bb_no = $this->input->post('bb_no');

	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('trial_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$total = (float)0;

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 4){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['id_det'] == ((int)$id) && $brg['jenis_tbl'] == $tbl){
								$brg[$column] = $vl;
								if($column == "qty_satuan"){
									if($tbl == "bb"){
										$brg["det_total1"] = ((float)$brg['qty_satuan'] * (float)$brg['harga_last']);
									}
									$brg["det_total2"] = ((float)$brg['qty_satuan'] * (float)$brg['harga_jual']);
								}else if($column == "harga_last"){
									$brg["det_total1"] = ((float)$brg['qty_satuan'] * (float)$brg['harga_last']);
								}
							}
						}
					}
				}
			}
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
		
		// $this->update_qty($id, $column, $vl, $tbl, $bb_no);
	}

	public function action_prosestrial()
	{
		$data = array();
		$date = $this->input->post('date');
		$stt = strtotime($date);
        $sec = date("s");
        // $rsl = date('Y-m-d',$stt);
		$rsl = (str_replace("T"," ",$date)).":".$sec;

		if($this->input->post('type')==2){
			$rsl = (str_replace("T"," ",$date));
		}

		$gud_no = $this->input->post('gud_trial');

		if($gud_no == ''){
			$selgud = array(
				'select' => array('gud_no'),
				'table' => 'tgudang',
				'where' => array('is_delete' => 0,
								'is_default' => 1)
			);

			$sgud = $this->setting_model->commonGet($selgud);

			if (is_array($sgud)|| is_object($sgud)) {
				foreach ($sgud as $gudk) {
					$gud_no = $gudk->gud_no;
				}
			}
		}

		$kat_id = $this->input->post('kat_id');
		$gud_name = $this->input->post('gud_trial_name');
		$id_trial =$this->input->post('id_trial');
		$no_bb =$this->input->post('no_bb');
		$is_adj =$this->input->post('is_adj');
		$ket = $this->input->post('ket');
		$ket_bb=$this->input->post('ket_bb');
		$id_reff=$this->input->post('id_reff');
		$id_tr = $this->session->userdata('trial_proses_id');
		$user_id = $this->session->userdata('person_id');
		$now = date('Y-m-d H:i:s');
		$CatGudNo = '';

		if($this->input->post('type')==1 || $this->input->post('type')==2){
			if ($gud_no <> '' or is_null($gud_no) == FALSE) {
				$selwh = array(
					'select' => array('tcat_gudang.cat_gud_no'),
			    	'table' => 'tgudang',
			    	'join' => array('tcat_gudang' => 'tgudang.cat_gud_no = tcat_gudang.cat_gud_no'),
			    	'where'	=>array('tgudang.is_delete' => 0,
			    					'tgudang.gud_no' => $gud_no),
			    	'limit' => '1'
			    );

				$wh = $this->setting_model->commonGet($selwh);

				if(is_array($wh) || is_object($wh)){
					foreach($wh as $key){
						$CatGudNo = $key->cat_gud_no;	
					}
				}else{
					echo json_encode(array(
						"statusCode"=>106,
						"warehouse" => $gud_name,
					));
					die();
				}
			}else{
				echo var_dump($gud_no);
			}

			$prodbb = $this->check_product(4,$id_tr,'bb','prod_no');
			$prodmnf = $this->check_product(4,$id_tr,'mnf','prod_no');

			$qtybb = $this->check_product(4,$id_tr,'bb','qty_satuan');
			$qtymnf = $this->check_product(4,$id_tr,'mnf','qty_satuan');

			$isAllowed = $this->is_allow_sell(4,$id_tr,'mnf',$gud_no,0,$rsl);

			if($id_trial <> ''){
				$trans_no = $id_trial;
			}else{
				$trans_no = $this->setting_model->GetNoIDMaster($rsl,'TRL','pr_no','tm_produksi_trial', $CatGudNo);
			}

			if($prodbb == 0){
				echo json_encode(array(
					"statusCode"=>101,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($prodmnf == 0){
				echo json_encode(array(
					"statusCode"=>102,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($qtybb == 0){
				echo json_encode(array(
					"statusCode"=>103,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($qtymnf == 0){
				echo json_encode(array(
					"statusCode"=>104,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($isAllowed['is_boleh'] == 0){
				echo json_encode(array(
					"statusCode"=>105,
					"dataItem" => $isAllowed['prod'],
				));
				die();
			}
			
			$data = array(
				'date' => $date,
				'stt' => $stt,
		        'rsl' => $rsl,
		        'gud_no' => $gud_no,
		        'gud_name' => $gud_name,
				'trans_no' => $trans_no,
				'id_trial' => $id_trial,
				'no_bb' => $no_bb,
				'is_adj' => $is_adj,
				'ket' => $ket,
				'ket_bb' => $ket_bb,
				'CatGudNo' => $CatGudNo,
				'kat_id' => $kat_id
			);
		}

		if($this->input->post('type')==12){
			if ($gud_no <> '' or is_null($gud_no) == FALSE) {
				$selwh = array(
					'select' => array('tcat_gudang.cat_gud_no'),
			    	'table' => 'tgudang',
			    	'join' => array('tcat_gudang' => 'tgudang.cat_gud_no = tcat_gudang.cat_gud_no'),
			    	'where'	=>array('tgudang.is_delete' => 0,
			    					'tgudang.gud_no' => $gud_no),
			    	'limit' => '1'
			    );

				$wh = $this->setting_model->commonGet($selwh);

				if(is_array($wh) || is_object($wh)){
					foreach($wh as $key){
						$CatGudNo = $key->cat_gud_no;	
					}
				}else{
					echo json_encode(array(
						"statusCode"=>106,
						"warehouse" => $gud_name,
					));
					die();
				}
			}else{
				echo var_dump($gud_no);
			}

			$prodbb = $this->check_product(3,$id_tr,'bb','prod_no');
			$prodmnf = $this->check_product(3,$id_tr,'mnf','prod_no');

			$qtybb = $this->check_product(3,$id_tr,'bb','qty_satuan');
			$qtymnf = $this->check_product(3,$id_tr,'mnf','qty_satuan');

			$isAllowed = $this->is_allow_sell(3,$id_tr,'mnf',$gud_no,0,$rsl);

			if($id_mnf <> ''){
				$trans_no = $id_mnf;
			}else{
				$trans_no = $this->setting_model->GetNoIDMaster($rsl,'PRD','jual_no','tsales_produksi_'.$gud_no, $CatGudNo);
			}

			if($prodbb == 0){
				echo json_encode(array(
					"statusCode"=>101,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($prodmnf == 0){
				echo json_encode(array(
					"statusCode"=>102,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($qtybb == 0){
				echo json_encode(array(
					"statusCode"=>103,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($qtymnf == 0){
				echo json_encode(array(
					"statusCode"=>104,
					"trans_no" => $trans_no,
				));
				die();
			}

			if($isAllowed['is_boleh'] == 0){
				echo json_encode(array(
					"statusCode"=>105,
					"dataItem" => $isAllowed['prod'],
				));
				die();
			}
			
			$data = array(
				'date' => $date,
				'stt' => $stt,
		        'rsl' => $rsl,
		        'gud_no' => $gud_no,
		        'gud_name' => $gud_name,
				'trans_no' => $trans_no,
				'id_mnf' => $id_mnf,
				'no_bb' => $no_bb,
				'is_adj' => $is_adj,
				'ket' => $ket,
				'ket_bb' => $ket_bb,
				'CatGudNo' => $CatGudNo,
				'kat_id' => $kat_id,
				'id_reff' => $id_reff
			);
		}

		$user_right = '';
		if($this->input->post('type')==1){// insert
    		$ins = $this->act_insert_detail_trial($data);

    		if($ins == 1){
				// echo var_dump($data);
	    		$this->delete_detail_trial($id_tr);

	    		echo json_encode(array(
					"statusCode"=>200
				));
    		}else{
    			echo json_encode(array(
					"statusCode"=>301,
					"message" => "Gagal."
				));
    		}
    		
		}elseif($this->input->post('type')==2) {//update
			$this->setting_model->HapusKoreksiTrial($id_trial, 0);

        	$ins = $this->act_insert_detail_trial($data);

    		if($ins == 1){
				// echo var_dump($data);
	    		$this->delete_detail_trial($id_tr);

	    		echo json_encode(array(
					"statusCode"=>201,
					"trans_no" => $trans_no
				));
    		}else{
    			echo json_encode(array(
					"statusCode"=>301,
					"message" => "Gagal edit data."
				));
    		}

			
		}elseif($this->input->post('type')==3) {//delete
			$hapus = 0;
			$rtn = 0;
			foreach($id_trial as $id){

				$selprod = array(
					'select' => array('pr_no'),
			    	'table' => 'tm_produksi_trial',
			    	'where'	=>array('pr_no' => $id,
			    					'is_delete' => 0)
			    );

				$sprod = $this->setting_model->commonGet($selprod);

				if(is_array($sprod) || is_object($sprod)){
					$hapus = $this->setting_model->HapusKoreksiTrial($id, 1);
					$rtn += (int)$hapus;
				}else{
					echo json_encode(array(
						"statusCode"=>301,
						"message" => "No. Trial ".$id." tidak ditemukan pada list."
					));
					die();
				}
		    }

		    if($rtn > 0){
		    	echo json_encode(array(
					"statusCode"=>202
				));	
		    }else{
		    	echo json_encode(array(
					"statusCode"=>201
				));	
		    }
			
		}elseif($this->input->post('type')==4) {//arsip

			 foreach($id_trial as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1,
							'delete_date' => $now,
							'user_delete'=> $user_id,
						),
						'table' => 'tset_bb',
						'where' => array(
							'tset_bb.bb_no' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}elseif($this->input->post('type') == 12){
			$ins = $this->act_insert_detail_mnf($data);

    		if($ins == 1){
    			$this->delete_detail_mnf($id_tr);
    			echo json_encode(array(
					"statusCode"=>200
				));
    		}else{
    			echo json_encode(array(
					"statusCode"=>301,
					"message" => "Gagal tambah data."
				));	
    		}
		}elseif ($this->input->post('type' == 31)) {
			$hapus = 0;
			$rtn = 0;
			foreach($id_trial as $id){

				$selprod = array(
					'select' => array('pr_no'),
			    	'table' => 'tm_produksi',
			    	'where'	=>array('pr_no' => $id,
			    					'is_delete' => 0)
			    );

				$sprod = $this->setting_model->commonGet($selprod);

				if(is_array($sprod) || is_object($sprod)){
					$hapus = $this->setting_model->HapusKoreksi($id, 1);
					$rtn += (int)$hapus;
				}else{
					echo json_encode(array(
						"statusCode"=>301,
						"message" => "No. Manufacture ".$id." tidak ditemukan pada list."
					));
					die();
				}
		    }

		    if($rtn > 0){
		    	echo json_encode(array(
					"statusCode"=>202
				));	
		    }else{
		    	echo json_encode(array(
					"statusCode"=>201
				));	
		    }
		}
	}

	public function delete_detail_trial_reset($pr_id = '')
	{
		if($pr_id == ''){
			$pr_id = $this->input->post('proses_id');
			if($pr_id == ''){
				$pr_id = (int)$this->session->userdata('trial_proses_id');
			}
		}
		
		$data_json = file_get_contents('./transaction_data.json');
		
		$json_arr = json_decode($data_json, true);

		foreach($json_arr['transaksi'] as &$subKey){
          if($subKey['id'] == 4){
          	foreach ($subKey['detail'] as &$subVal) {
				if($subVal['id_trans'] == ((int)$pr_id)){
					foreach ($subVal['detail_trans'] as $key => $value) {
						unset($subVal['detail_trans'][$key]);
					}
				}
			}
          }
     	}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);
	}

	public function insert_detail_trial()
	{
		$id_proses = 0;

		$id_proses = (int)$this->session->userdata('trial_proses_id');

		if($id_proses <> 0 or $id_proses <> '' ){
			$id_proses = (int)$this->session->userdata('trial_proses_id');
		}else{
			$id_proses = $this->get_id_proses(4,'trial_proses_id');
		}
		
		$id_brg = $this->input->post('id_brg');
		$id_trial = $this->input->post('id_trial');
		$tgl = $this->input->post('tgl');
		$type = $this->input->post('type');

		$is_new = 1;

		if($id_trial <> '' ){
			$is_new = 0;
		}


		$posts = array();
	    $post = array();
	    $dsn = array();

	    $exist = 0;

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

	    $id_det = (int)$this->get_id_det_trans(4,$id_proses);

	    foreach($id_brg as $id){
	    	$option = array(
				'select' => array('tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3',
								'tproduct.qty_kemasan',
								'tproduct.prod_sell_price',
								'tproduct.konversi1',
								'tproduct.konversi2',
								'tproduct.konversi3'),
		    	'table' => 'tproduct',
		    	'where'	=>array('tproduct.prod_no' => $id)
		    );

			$get_prod = $this->setting_model->commonGet($option);

			if (is_array($get_prod) || is_object($get_prod)){
				
				foreach ($get_prod as $key) {
					if($type == 'bb'){
						$dsn[] = array(
					        	"id_det" => $id_det++,
					        	"jenis_brg" => "",
					        	"prod_no" => $key->prod_no,
					        	"prod_code" => $key->prod_code0,
					        	"prod_name" => $key->prod_name0,
						        "satuan" => $key->prod_uom,
						        "qty_satuan" => 1,
						        "konversi" => $key->konversi1,
						        "harga_satuan" => 0,
						        "harga_last" => $this->setting_model->GetLastHarga($key->prod_no, $tgl),
						        "harga_jual" => (float)$key->prod_sell_price,
						        "det_total1" => 1 * (float)$key->prod_sell_price,
						        "det_total2" => (float)$key->prod_sell_price * 0,
						        "keterangan" => "",
						        "qty_default" => 0,
						        "qty_kemasan" => (is_null($key->qty_kemasan) ? 0 : $key->qty_kemasan),
						        "qty_pemakaian" => 0,
						        "qty_dibutuhkan" => 0,
						        "satuan_pakai" => "",
						        "satuan_butuh" => "",
						        "is_new" => $is_new,
						        "jenis_tbl" => "bb"
						);
					}else if($type == 'mnf'){
						$dsn[] = array(
					        	"id_det" => $id_det++,
					        	"jenis_brg" => "Rote",
					        	"prod_no" => $key->prod_no,
					        	"prod_code" => $key->prod_code0,
					        	"prod_name" => $key->prod_name0,
						        "satuan" => $key->prod_uom,
						        "qty_satuan" => 1,
						        "konversi" => $key->konversi1,
						        "harga_satuan" => 0,
						        "harga_last" => $this->setting_model->GetLastHarga($key->prod_no, $tgl),
						        "harga_jual" => (float)$key->prod_sell_price,
						        "det_total1" => 1 * (float)$key->prod_sell_price,
						        "det_total2" => (float)$key->prod_sell_price * 0,
						        "keterangan" => "",
						        "qty_default" => 0,
						        "qty_kemasan" => (is_null($key->qty_kemasan) ? 0 : $key->qty_kemasan),
						        "qty_pemakaian" => 0,
						        "qty_dibutuhkan" => 0,
						        "satuan_pakai" => "",
						        "satuan_butuh" => "",
						        "is_new" => $is_new,
						        "jenis_tbl" => "mnf"
						);
					}

					
				}
			}
	    }

	    $post = array(
	    	"id_trans" => $id_proses,
			"is_edit" => 0,
			"trans_no" => "",
	        "detail_trans"   => $dsn
	    );

	    $is_exist = 0;
	    foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 4) {
		    	foreach ($key['detail'] as $val) {
		    		if($val['id_trans'] == $id_proses){
		    			$is_exist = 1;
		    		}
		    	}
		    }
		}

		if($is_exist == 1){
			foreach ($posts['transaksi'] as &$key) {
			    if (($key['id']) == 4) {
			    	foreach ($key['detail'] as &$val) {
			    		if($val['id_trans'] == $id_proses){
			    			for($i = 0; $i < count($dsn); $i++){
			    				array_push($val['detail_trans'],$dsn[$i]);	
			    			}
			    		}
			    	}
			    }
			}
		}else{
			foreach ($posts['transaksi'] as &$key) {
			    if (($key['id']) == 4) {
			    	array_push($key['detail'],$post);
			    }
			}
		}
	    
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);

	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }
	    
	}

	public function get_qty_prod_trial()
	{
		$id = $this->input->post('id');
		$column = $this->input->post('column');
		$tbl = $this->input->post('tbl');
		$type = $this->input->post('type');
	   	$proses_id = 0 ;
	   	if ($type == 3) {
	   		$proses_id = (int)$this->session->userdata('mnf_proses_id');
	   	}else{
	   		$proses_id = (int)$this->session->userdata('trial_proses_id');
	   	}
        
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == $type){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == $tbl && $brg['id_det'] == ((int)$id)) {
								echo json_encode(array(
									"id_detail" => $brg['id_det'],
									"qty_kemasan" => $brg['qty_kemasan']
								));
							}
						}
					}
				}
			}
		}
	}

	public function update_qty_detail_trial()
	{

	    $id = $this->input->post('id');
	    $is_adj = $this->input->post('is_adj');
		$qty_paksat = $this->input->post('qty_paksat');
		$qty_kemsat = $this->input->post('qty_kemsat');
		$qty_paksat_input = $this->input->post('qty_paksat_input');
		$qty_kemsat_input = $this->input->post('qty_kemsat_input');
		$qty_pakai = $this->input->post('qty_pakai');
		$qty_butuh = $this->input->post('qty_butuh');
		$qty_hasil = $this->input->post('qty_hasil');
		$prod_kemasan = $this->input->post('prod_kemasan');
		$tbl = $this->input->post('tbl');
		$type = $this->input->post('type');

	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('trial_proses_id');
		// read file
		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == $type){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == $tbl && $brg['id_det'] == ((int)$id)) {
								$brg['det_total1'] = round(((float)$qty_hasil * (float)$brg['harga_last']),5);	
								$brg['det_total2'] = round(((float)$qty_hasil * (float)$brg['harga_jual']),5);
								$brg['qty_pemakaian'] = $qty_paksat_input;
								$brg['qty_dibutuhkan'] = $qty_butuh;
								$brg['qty_satuan'] = $qty_hasil;
								$brg['qty_default'] = ($brg['jenis_tbl'] == "bb" ? $qty_hasil : $qty_kemsat_input);
								$brg['satuan_pakai'] = $qty_paksat;
								$brg['satuan_butuh'] = $qty_kemsat;
								$brg['qty_kemasan'] = $qty_kemsat_input;
								if ($brg['jenis_tbl'] == "mnf") {
									
								}
							}

							if ($tbl == "mnf") {
								if ($brg['jenis_tbl'] == "bb") {
									$brg['qty_dibutuhkan'] = $qty_butuh;
								}
							}
						}
					}
				}
			}
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);

		$this->hitung_all_trial($type,$is_adj);

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;
		$total_hj = 0;
		$total_st = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == 4){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$total_qty += $brg['qty_satuan'];
								$total_pakai += $brg['qty_pemakaian'];
								$total_butuh += $brg['qty_dibutuhkan'];
								$total_hj += $brg['harga_jual'];
								$total_st += $brg['det_total2'];
							}
						}
					}
				}
			}
		}

		echo json_encode(array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh,
			"harga_jual" =>$total_hj,
			"sub_total" =>$total_st
		));
	}

	public function hitung_all_trial($type = '',$is_adj='',$id= '', $value = '')
	{
		$is_post = 0;
		$proses_id = 0 ;
	    $proses_id = (int)$this->session->userdata('trial_proses_id');

		if ($is_adj == '') {
			$type = $this->input->post('type');
			$is_adj = $this->input->post('is_adj');
			$id = $this->input->post('id');
			$value = $this->input->post('value');
			$is_post = 1;
		}

		if($is_post <> 0){
			if($id <> 0){
			// read file
				$data_json2 = file_get_contents('./transaction_data.json');
				// decode json to associative array
				$json_arr2 = json_decode($data_json2, true);
				// encode array to json and save to file

				$uk = array(
					array("satuan" => "KG", "value" => 1),
					array("satuan" => "HG", "value" => 10),
					array("satuan" => "DAG", "value" => 100),
					array("satuan" => "G", "value" => 1000),
					array("satuan" => "DG", "value" => 10000),
					array("satuan" => "CG", "value" => 100000),
					array("satuan" => "MG", "value" => 1000000)
				);

				$QtyBagi = 0;
				$QtyHsl = 0;
				$QtyHit = 0;
				$QtyHp = 0;
				$QtyPakai = 0;

				foreach ($json_arr2['transaksi'] as &$key) {
		        	if($key['id'] == $type){
						foreach ($key['detail'] as &$val) {
							if($val['id_trans'] == ((int)$proses_id)){
								foreach ($val['detail_trans'] as &$brg) {
									if ($brg['jenis_tbl'] == "mnf" && $brg['id_det'] == ((int)$id)) {
										$brg['qty_kemasan'] = $value;

										$QtyPemakaian = $brg['qty_pemakaian'];
										$QtyKemasan = $value;
										$SatPakai = $brg['satuan_pakai'];
										$SatKemas = $brg['satuan_butuh'];
										$QtyButuh = $brg['qty_dibutuhkan'];

										foreach($uk as $row=>$kuk){
											if($SatPakai == $kuk['satuan']){
												$SatPakai = $row;
											}
											
											if($SatKemas == $kuk['satuan']){
												$SatKemas = $row;
											}
										}

										if(($SatPakai) > ($SatKemas)){
											$QtyBagi = (($SatPakai) - ($SatKemas));
											foreach($uk as $row=>$kuk){
												if($row == $QtyBagi){
													$QtyHit = $kuk['value'];
												}
											}

											$QtyHsl = ($QtyPemakaian) / ($QtyHit);
										}else if (($SatPakai) < ($SatKemas)) {
											$QtyBagi = (($SatKemas) - ($SatPakai));
											foreach($uk as $row=>$kuk){
												if($row == $QtyBagi){
													$QtyHit = $kuk['value'];
												}
											}
											$QtyHsl = ($QtyPemakaian) * ($QtyHit);
										}else{
											$QtyBagi = (($SatPakai) - ($SatKemas));
											foreach($uk as $row=>$kuk){
												if($row == $QtyBagi){
													$QtyHit = $kuk['value'];
												}
											}
											$QtyHsl = ($QtyPemakaian) / ($QtyHit);
										}

										// console.log(QtyBagi, QtyHit, QtyHsl);

										if (($QtyKemasan) != 0) {
											$QtyHsl = $QtyHsl / ($QtyKemasan);
										}else{
											$QtyHsl = 0;
										}

										$QtyHp = ($QtyHsl) * ($QtyButuh);

										$brg['qty_satuan'] = $QtyHp;
										
									}
								}
							}
						}
					}
				}

				$json_body2 = json_encode($json_arr2);
				file_put_contents('./transaction_data.json', $json_body2);

			}
		}
		

		$data_json = file_get_contents('./transaction_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$Total = 0;
    	$TotQty = 0;
    	$TotQtyKemasan = 0;
    	$HgJual = 0;

		// encode array to json and save to file
		foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == $type){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == (int)$proses_id){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$Total += $brg['det_total1'];
        						$TotQty += $brg['qty_satuan'];
        						$HgJual += $brg['harga_jual'];
							}

							if($brg['jenis_tbl'] == "mnf"){
								$TotQtyKemasan += ($brg['qty_satuan'] * ($brg['qty_default'] == 0 ? 1 : $brg['qty_default']));
							}
						}
					}
				}
			}
		}

		$TotQty = 0;
		$TotPakai = 0;
		$HgJual = 0;
		$TotButuh = 0;
    	$TotHgjual = 0;

    	foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 4){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == (int)$proses_id){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								if ($is_adj <> 0) {
									$brg['qty_satuan'] = $brg['qty_default'];
								}else{
									if ($TotQtyKemasan <> 0) {
										$qty_kem = $brg['qty_default'];
										$brg['qty_satuan'] = (($qty_kem == 0 ? 1 : $qty_kem) * $TotQtyKemasan);
									}
								}
								
        						$brg['det_total1'] = round(($brg['qty_satuan'] * $brg['harga_last']),5);
        						// $brg['det_total2'] = $brg['qty_satuan'] * $brg['harga_satuan'];
        						$brg['det_total2'] = round(($brg['qty_satuan'] * $brg['harga_jual']),5);

        						$TotQty += $brg['qty_satuan'];
						        $TotPakai += $brg['qty_pemakaian'];
						        $TotButuh += $brg['qty_dibutuhkan'];
						        $HgJual += $brg['harga_jual'];
						        $TotHgjual += $brg['det_total2'];
							}

							if($brg['jenis_tbl'] == "mnf"){
								$brg['harga_jual'] = round(((((($brg['qty_satuan'] * $brg['qty_default']) / $TotQtyKemasan) * ($TotHgjual == 0 ? 1 : $TotHgjual))) / ($brg['qty_satuan'])),5);
        						$brg['det_total2'] = round(($brg['harga_jual'] * ($brg['qty_satuan'])),5);
							}
						}
					}
				}
			}
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./transaction_data.json', $json_body);

		if($is_post == 1){
			$total_qty = 0;
			$total_pakai = 0;
			$total_butuh = 0;
			$total_hj = 0;
			$total_st = 0;

			$data_json2 = file_get_contents('./transaction_data.json');

			$json_arr2 = json_decode($data_json2, true);

			foreach ($json_arr2['transaksi'] as &$key) {
	        	if($key['id'] == 4){
					foreach ($key['detail'] as &$val) {
						if($val['id_trans'] == ((int)$proses_id)){
							foreach ($val['detail_trans'] as &$brg) {
								if ($brg['jenis_tbl'] == "bb") {
									$total_qty += $brg['qty_satuan'];
									$total_pakai += $brg['qty_pemakaian'];
									$total_butuh += $brg['qty_dibutuhkan'];
									$total_hj += $brg['harga_jual'];
									$total_st += $brg['det_total2'];
								}
							}
						}
					}
				}
			}

			echo json_encode(array(
				"qty_satuan" => $total_qty,
				"qty_pakai" => $total_pakai,
				"qty_butuh" =>$total_butuh,
				"harga_jual" =>$total_hj,
				"sub_total" =>$total_st
			));
		}

	}

	public function test_read_json()
	{
		$data_json = file_get_contents('./transaction_data.json');
        $json_arr = json_decode($data_json, true);
        $id_tr = 1;

        foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 5){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_tr)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl'] == 'bb'){
								print_r($brg['prod_no']);
							}
						}
					}
				}
			}
		}


	}

	public function test_insert_ttran()
	{
		$now = date('Y-m-d H:i:s');

		$jurno = '';
		$txtStr = '';
		$TotalHpp = 0;
		$TotalAfalan = 0;
		$id_tr = 1;
		$user_id = '138';
		$gud_act = 'ID2';
		$gud = 'ID-190121-105451-0003';
		$data_json = file_get_contents('./transaction_data.json');
        $is_exist = 0;
        $json_arr = json_decode($data_json, true);
        $tgl = $now;
        $GudNo = $gud;
        $catgud = 'ID-190121-105254-0001';
        $is_adj = 0;
        $ket = '2390000100 ROTI - MARIAM isi 5';
        $no_bb = 'BB-2339-132717-0011';
        $trans_no = $this->setting_model->GetNoIDMaster($tgl,'PRD','jual_no','tsales_produksi_'.$gud, $catgud);

		$is_transid = $this->check_id_tm($tgl,'PRD','jual_no','tsales_produksi_'.$gud, $trans_no, $catgud);

		$trans_no = $is_transid;

		$selbb = array(
			'select' => array('a.*','b.prod_uom','b.konversi1'),
			'table' => 'tset_bb a',
			'join' => array('tproduct b' => 'a.prod_no = b.prod_no'),
			'where' =>array('a.bb_no' => $no_bb)
		);

		// print_r($selbb);
		$sbb = $this->setting_model->commonGet($selbb);

		if (is_array($sbb)||is_object($sbb)) {
			foreach ($sbb as $kbb) {
				$insert = array(
					'insert' => array(
						'is_adjust' => $is_adj, 
						'gud_no' => $gud,
						'prod_no' => $kbb->prod_no, 
						'qty_satuan' => 1, 
						'konversi' => $kbb->konversi1, 
						'satuan' => $kbb->prod_uom, 
						'create_date' => $now, 
						'edit_date' => $now, 
						'user_edit' => $user_id, 
						'pr_no' => $trans_no, 
						'pr_date' => $tgl, 
						'pr_ket' => $ket, 
						'user_id' => $user_id, 
						'bb_no' => $no_bb, 
					),
					'table' => 'tm_produksi'
				);

				$pr = $this->setting_model->commonInsert($insert);

				if($pr['code'] <> 00000 ){
		    		echo "pr is error".$pr['message'];
		    		die();
		    	}

				// print_r($pr);
			}
		}

		$jurnoku = $this->setting_model->GetNoIDMaster($tgl,'GL','jur_no','tjurnal', $catgud);

		$is_jurid = $this->check_id($tgl,'GL','jur_no','tjurnal',$jurnoku, $catgud);

		$jurnoku = $is_jurid;

		$txtStr = "Manufacture No. ".$trans_no."/".$ket;

		$jurno = $jurnoku;

		$insert2 = array(
			'insert' => array(
				'cab_no' => $catgud, 
				'jur_no' => $jurno,
				'jur_tgl' => $tgl, 
				'jur_ket' => $txtStr, 
				'user_id' => $user_id, 
				'jur_total' => 0, 
				'is_viewed' => 1 
			),
			'table' => 'tjurnal'
		);

		// print_r($insert2);

    	$ij = $this->setting_model->commonInsert($insert2);

    	if($ij['code'] <> 00000 ){echo "ij is error".$ij['message'];die();}

    	// print_r($ij);

    	$insert3 = array(
			'insert' => array(
				'cab_no' => $catgud, 
				'jur_no' => $jurno,
				'create_date' => $now, 
				'edit_date' => $now, 
				'user_edit' => $user_id, 
				'out_no' => $trans_no, 
				'out_date' => $tgl,
				'out_type' => 7, 
				'user_id' => $user_id, 
				'jual_no' => $trans_no
			),
			'table' => 'tout'
		);

    	// print_r($insert3);
    	$it = $this->setting_model->commonInsert($insert3);

    	if($it['code'] <> 00000 ){echo "it is error".$it['message'];die();}
    	// print_r($it);
								
    	foreach ($json_arr['transaksi'] as &$key) {
        	if($key['id'] == 5){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$id_tr)){
						foreach ($val['detail_trans'] as &$brg) {
							if($brg['jenis_tbl'] == 'bb'){
								$KodeProd = $brg['prod_no'];
						        $JmlSatuan = $brg['qty_satuan'];
						        $Satuan = $brg['satuan'];
						        $Konversi = $brg['konversi'];
						        $JmlStok = $JmlSatuan * $Konversi;

						        if($brg['jenis_brg'] == "Rote"){
						        	$JenisBrg = 1;
						        }else if ($brg['jenis_brg'] == "Produksi") {
						        	$JenisBrg = 2;
						        }else{
						        	$JenisBrg = 1;
						        }

						        if($JmlStok <> 0){
						        	
						        	if($JmlStok<0){$JenisBrg = 1;}else{$JenisBrg = 0;}	
						        	
						        	$QtyRetur = 0;
						            $JumMax = 0;
						            $ProdHpp = 0;
						            $Max2Sell = 0;

						            $selkon = array(
						            	'select' => array('konversi1','konversi2','konversi3','prod_name0','prod_code0','is_stok','acc_brg'),
						            	'table' => 'tproduct',
						            	'where' => array('prod_no' => $KodeProd)
						            );

						            $sk = $this->setting_model->commonGet($selkon);

						            if(is_array($sk) || is_object($sk)){
						            	foreach ($sk as $skkey) {
						            		$RekProd = $skkey->acc_brg;
						            		if($RekProd == "" || ($this->setting_model->isRekNoExists($RekProd) == 0)){
						            			echo json_encode(array(
													"statusCode"=>301,
													"message" => "Account barang item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
												));
												die();	
						            		}

						            		$RekNoProduksi = $RekProd;
						            		$DetKonversi = $Konversi;
								            $Jml = $JmlStok * $DetKonversi;
								            $Boleh = 0;
								            $TheGudNo = $GudNo;
											$ProdHpp = 0;

											if($skkey->is_stok <= 1){
												$OldHpp = 0;

												if($JenisBrg == 0){
													$OldHpp = $ProdHpp;
                    								$Harga = $ProdHpp;
												}else if($JenisBrg == 1){
													$selhpp = array(
										            	'select' => array('a.price_netto'),
										            	'table' => 'td_set_hpp a',
										            	'join' => array('tset_hpp b' => 'a.hap_no = b.hap_no'),
										            	'where' => array('a.prod_no' => $KodeProd,
										            					'b.tgl <=' => $tgl),
										            	'order' => array('b.tgl' => 'DESC'),
										            	'limit' => '1'

										            );

										            $sh = $this->setting_model->commonGet($selhpp);

										            if(is_array($sh) || is_object($sh)){
										            	foreach ($sh as $shkey) {
										            		$OldHpp = (is_null($shkey['price_netto']) ? 0 : $shkey['price_netto']);
										            	}
										            }else{
										            	echo "sh is error";
										            }
										            $Harga = $OldHpp;
												}
											}else{
												$OldHpp = 0;

												$selhpp2 = array(
									            	'select' => array('a.price_netto'),
									            	'table' => 'td_set_hpp a',
									            	'join' => array('tset_hpp b' => 'a.hap_no = b.hap_no'),
									            	'where' => array('a.prod_no' => $KodeProd,
									            					'b.tgl <=' => $tgl),
									            	'order' => array('b.tgl' => 'DESC'),
									            	'limit' => '1'

									            );

									            $sh2 = $this->setting_model->commonGet($selhpp2);

									            if(is_array($sh2) || is_object($sh2)){
									            	foreach ($sh2 as $shkey2) {
									            		$OldHpp = (is_null($shkey2['price_netto']) ? 0 : $shkey2['price_netto']);
									            	}
									            }else{
									            	echo "sh2 is error";
									            }

									            $Harga = $OldHpp;
											}

											$NewPrice = 0;

											$DetPrNoku = $this->setting_model->GetNoIDField2("det_pr_no", "td_produksi");

											$DetPrNo = $DetPrNoku;

											$ins_prod = array(
												'insert' => array(
													'jenis_brg' => $JenisBrg, 
													'nama_brg' => $brg['prod_name'], 
													'gud_no' => $TheGudNo, 
													'det_pr_no' => $DetPrNo, 
													'pr_no' => $trans_no, 
													'prod_no' => $brg['prod_no'], 
													'satuan' => $brg['satuan'],
													'konversi' => $brg['konversi'], 
													'qty_satuan' => $brg['qty_satuan'], 
													'qty_default' => $brg['qty_default'], 
													'qty_pemakaian' => $brg['qty_pemakaian'], 
													'qty_dibutuhkan' => $brg['qty_dibutuhkan'], 
													'satuan_pakai' => $brg['satuan_pakai'], 
													'satuan_butuh' => $brg['satuan_butuh']
												),
												'table' => 'td_produksi'
											);
											// print_r($ins_prod);
									    	$ip = $this->setting_model->commonInsert($ins_prod);

									    	if($ip['code'] <> 00000 ){echo "ip is error";die();}
									    	// print_r($ip);
									    	$DetNoku = $this->setting_model->GetNoIDField2("out_det_no", "tdetail_out");

											$DetNo = $DetNoku;
											$ins_out = array(
												'insert' => array(
													'gud_no' => $TheGudNo, 
													'Out_Det_No' => $DetNo, 
													'Out_no'=>$trans_no, 
													'prod_no'=>$brg['prod_no'],
													'out_det_qty'=>$Jml, 
													'price_netto'=>$Harga, 
													'det_sales_no'=>$DetPrNo, 
													'qty_satuan'=>$brg['qty_satuan'], 
													'konversi'=>$brg['konversi'], 
													'satuan' =>$brg['satuan']
												),
												'table' => 'tdetail_out'
											);

											// print_r($ins_out);

									    	$io = $this->setting_model->commonInsert($ins_out);

									    	if($io['code'] <> 00000 ){echo "io is error";die();}

									    	// print_r($io);

									    	if($JenisBrg = 0){
									    		$TotalHpp = $TotalHpp + ($Jml * $Harga);
									    	}else if($JenisBrg = 1){
									    		$TotalAfalan = $TotalAfalan + (abs($Jml) * $Harga);
									    	}

									    	$HasilProduk = $Jml * $Harga;

									    	$txtStr = "Detail Bahan Baku No. ".$trans_no." ".$brg['prod_code']." - ".$brg['prod_name'];

									    	$JurDetNoku = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
									    	$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNoku);

        									$JurDetNoku = $is_jid;

									    	$JurDetNo = $JurDetNoku;

									    	$ins_tdjur = array(
												'insert' => array(
													'jur_det_no' => $JurDetNo, 
													'jur_no' => $jurno, 
													'rek_no'=>$RekProd, 
													'kredit'=>strval($HasilProduk),
													'debet'=>0, 
													'keterangan'=>$txtStr, 
													'kredit_kurs'=>strval($HasilProduk), 
													'debet_kurs'=>0
												),
												'table' => 'tdjurnal'
											);

											// print_r($ins_tdjur);

									    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

									    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

									    	// print_r($itdj);

									    	$up_trek = array(
												'update' => array(
													'saldo' => 'saldo - '.$HasilProduk
												),
												'table' => 'trek',
												'where' => array(
															'rek_no' => $RekProd)
											);
									    	// print_r($up_trek);

									    	$utr = $this->setting_model->commonUpdate($up_trek);

									    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

									    	// print_r($utr);

									    	$up_tdout = array(
												'update' => array(
													'rek_brg' => $RekProd,
													'jur_det_no1' => $JurDetNo
												),
												'table' => 'tdetail_out',
												'where' => array(
															'out_det_no' => $DetNo)
											);

									    	// print_r($up_tdout);

									    	$utdo = $this->setting_model->commonUpdate($up_tdout);

									    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

									    	// print_r($utdo);

									    	$JurDetNoku = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");

									    	$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNoku);

        									$JurDetNoku = $is_jid;

									    	$JurDetNo = $JurDetNoku;

									    	$ins_tdjur = array(
												'insert' => array(
													'jur_det_no' => $JurDetNo, 
													'jur_no' => $jurno, 
													'rek_no'=>strval($RekNoProduksi), 
													'debet'=>strval($HasilProduk), 
													'kredit'=> 0,
													'keterangan'=>$txtStr, 
													'debet_kurs'=>strval($HasilProduk),
													'kredit_kurs'=> 0
												),
												'table' => 'tdjurnal'
											);

									    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

									    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

									    	// print_r($itdj);

									    	$up_trek = array(
												'update' => array(
													'saldo' => 'saldo + '.strval($HasilProduk)
												),
												'table' => 'trek',
												'where' => array(
															'rek_no' => $RekNoProduksi)
											);

									    	$utr = $this->setting_model->commonUpdate($up_trek);

									    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

									    	// print_r($utr);

									    	$up_tdout = array(
												'update' => array(
													'rek_unbill_gr' => $RekNoProduksi,
													'jur_det_no2' => $JurDetNo
												),
												'table' => 'tdetail_out',
												'where' => array(
															'out_det_no' => $DetNo)
											);

									    	$utdo = $this->setting_model->commonUpdate($up_tdout);

									    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}
									    	
									    	$this->setting_model->InsertTTrans($TheGudNo, $KodeProd, $tgl,"", $DetNo, 0, $Jml, 7, $Harga, $gud_act);
						            	}	
						            }else{
						            	echo json_encode(array(
											"statusCode"=>301,
											"message" => "bb Bahan baku item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
										));
										die();
						            	
						            }
						            
						        }

							}
							$JmlStok = 0;
    						$JmlAfal = 0;

							if($brg['jenis_tbl'] == 'mnf'){
								if($brg['jenis_brg'] == "Produksi"){
									$JmlStok = $JmlStok + ($brg['konversi'] * $brg['qty_satuan']);
								}else{
									$JmlAfal = $JmlAfal + ($brg['konversi'] * $brg['qty_satuan']);
								}
							}

							$HargaAwal = 0;

							if ($JmlStok <> 0) {
								$HargaAwal = ($TotalHpp - $TotalAfalan) / ($JmlStok);
							}else{
								if ($JmlAfal <> 0) {
									$HargaAwal = ($TotalHpp - $TotalAfalan) / ($JmlAfal);
								}
							}

							if($brg['jenis_tbl'] == 'mnf'){

								$Jml = $brg['qty_satuan'];
								$Boleh = 0;
								$TheGudNo = $GudNo;
						        $KodeProd = $brg['prod_no'];
						        $Konversi = $brg['konversi'];
						        $JmlStok = $Jml * $Konversi;

						        if($brg['jenis_brg'] == "Rote"){
						        	$JenisBrg = 1;
						        }else if ($brg['jenis_brg'] == "Produksi") {
						        	$JenisBrg = 2;
						        }else{
						        	$JenisBrg = 1;
						        }

						        $InDetNoku = $this->setting_model->GetNoIDField2("det_pr_no", "td_produksi");
						        $InDetNo = $InDetNoku;

						        $intdpro = array(
									'insert' => array(
										'jenis_brg' => strval($JenisBrg), 
										'nama_brg' => strval($brg['prod_name']),
										'gud_no' => $GudNo, 
										'det_pr_no' => $InDetNo, 
										'pr_no' => $trans_no, 
										'prod_no' => strval($brg['prod_no']), 
										'satuan' => strval($brg['satuan']),
										'konversi' => strval($brg['konversi']), 
										'qty_satuan' => strval($brg['qty_satuan']),
										'qty_default' => $brg['qty_default'], 
										'qty_pemakaian' => $brg['qty_pemakaian'], 
										'qty_dibutuhkan' => $brg['qty_dibutuhkan'], 
										'satuan_pakai' => $brg['satuan_pakai'], 
										'satuan_butuh' => $brg['satuan_butuh'],
										'harga_satuan' => strval($brg['harga_jual']),
										// 'det_total' => strval($brg['det_total2'])
									),
									'table' => 'td_produksi'
								);

						    	$itprod = $this->setting_model->commonInsert($intdpro);

						    	if($itprod['code'] <> 00000 ){echo "itprod is error".$itprod['message'];die();}

						    	// $RekNoProduksi = $RekProd;

						    	$selrd = array(
						    		'select' => array('b.konversi1', 
						    						'b.konversi2', 
						    						'b.konversi3', 
						    						'b.prod_name0', 
						    						'b.prod_code0', 
						    						'is_stok', 
						    						'acc_brg'),
						    		'table' => 'tproduct b',
						    		'where' => array('b.prod_no' => $KodeProd)
						    	);

						    	$srd = $this->setting_model->commonGet($selrd);

						    	// echo var_dump($srd);

						    	// die();

						    	if(is_array($srd)||is_object($srd)){
									foreach ($srd as $rd) {
						    			$RekProd = $rd->acc_brg."";
						    		}	
						    	}else{
						    		echo json_encode(array(
										"statusCode"=>301,
										"message" => "mnf Bahan baku item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
									));
									die();
						    	}

						    	if ($RekProd == '' || ($this->setting_model->isRekNoExists($RekProd) == 0)) {
						    		echo json_encode(array(
										"statusCode"=>301,
										"message" => "Account barang item ".$brg['prod_code']." - ".$brg['prod_name']." tidak ditemukan pada master."
									));
									die();	
						    	}

						    	$RekNoProduksi = $RekProd;

						    	$NewPrice = 0;
                    
        						$DetNo = $this->setting_model->GetNoIDField2("out_det_no", "tdetail_out");

        						$ins_out = array(
									'insert' => array(
										'gud_no' => $TheGudNo, 
										'qty_satuan' => strval($Jml * -1), 
										'satuan'=> strval($brg['satuan']), 
										'konversi'=>strval($Konversi),
										'out_det_buy_price'=>strval($HargaAwal), 
										'out_det_no'=>$DetNo, 
										'out_no'=>$trans_no, 
										'prod_no'=>$KodeProd, 
										'out_det_qty'=>strval($JmlStok * -1), 
										'out_det_sell_price' => strval($HargaAwal),
										'price_netto' => strval($HargaAwal),
										'det_sales_no' => $InDetNo 
									),
									'table' => 'tdetail_out'
								);

						    	$io = $this->setting_model->commonInsert($ins_out);

						    	if($io['code'] <> 00000 ){echo "io is error";die();}

						    	$txtStr = "Detail Produksi No. ".$trans_no." ".$brg['prod_code']." - ".$brg['prod_name'];
        						$HasilProduk = $JmlStok * $HargaAwal;

        						$JurDetNo = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
        						$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNo);

        						$JurDetNo = $is_jid;

        						$ins_tdjur = array(
									'insert' => array(
										'jur_det_no' => $JurDetNo, 
										'jur_no' => $jurno, 
										'rek_no'=>$RekProd, 
										'debet'=>strval($HasilProduk),
										'kredit'=>0, 
										'keterangan'=>$txtStr, 
										'debet_kurs'=>strval($HasilProduk), 
										'kredit_kurs'=>0
									),
									'table' => 'tdjurnal'
								);

						    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

						    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

						    	$up_trek = array(
									'update' => array(
										'saldo' => 'saldo + '.$HasilProduk
									),
									'table' => 'trek',
									'where' => array(
												'rek_no' => $RekProd)
								);

						    	$utr = $this->setting_model->commonUpdate($up_trek);

						    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

						    	$up_tdout = array(
									'update' => array(
										'rek_brg' => $RekProd,
										'jur_det_no1' => $JurDetNo
									),
									'table' => 'tdetail_out',
									'where' => array(
												'out_det_no' => $DetNo)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

						    	$JurDetNo = $this->setting_model->GetNoIDField2("jur_det_no", "tdjurnal");
        						$is_jid = $this->check_id_field("jur_det_no", "tdjurnal",$JurDetNo);

        						$JurDetNo = $is_jid;

						    	$ins_tdjur = array(
									'insert' => array(
										'jur_det_no' => $JurDetNo, 
										'jur_no' => $jurno, 
										'rek_no'=>$RekNoProduksi, 
										'kredit'=>strval($HasilProduk), 
										'debet'=>0,
										'keterangan'=>$txtStr, 
										'kredit_kurs'=>strval($HasilProduk),
										'debet_kurs'=>0
									),
									'table' => 'tdjurnal'
								);

						    	$itdj = $this->setting_model->commonInsert($ins_tdjur);

						    	if($itdj['code'] <> 00000 ){echo "itdj is error".$itdj['message'];die();}

						    	$up_trek = array(
									'update' => array(
										'saldo' => 'saldo - '.strval($HasilProduk)
									),
									'table' => 'trek',
									'where' => array(
												'rek_no' => $RekNoProduksi)
								);

						    	$utr = $this->setting_model->commonUpdate($up_trek);

						    	if($utr['code'] <> 00000 ){echo "utr is error";die();}

						    	$up_tdout = array(
									'update' => array(
										'rek_unbill_gr' => $RekNoProduksi,
										'jur_det_no2' => $JurDetNo
									),
									'table' => 'tdetail_out',
									'where' => array(
												'out_det_no' => $DetNo)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}

						    	$InsTrans = $this->setting_model->InsertTTrans($TheGudNo, $KodeProd, $tgl,"", $DetNo, 0, $JmlStok * -1, 7, $Harga, $gud_act);
							}

							if($no_bb <> ""){
								$up_tdout = array(
									'update' => array(
										'is_pakai' => 'is_pakai + 1'),
									'table' => 'tset_bb',
									'where' => array('bb_no' => $no_bb)
								);

						    	$utdo = $this->setting_model->commonUpdate($up_tdout);

						    	if($utdo['code'] <> 00000 ){echo "utdo is error";die();}
							}

							if($brg['jenis_tbl'] == 'mnf'){
								$update = $this->setting_model->UpdateHppNew($brg['prod_no'],$tgl);

								if($update == 0){
									return 1;
								}
							}
						}
					}
				}
			}
		}	

		$Add = 0;
    	$OutNo = $trans_no;
    	$SaveData = 1;

    	echo json_encode(array(
    		"trans_no" => $trans_no,
    		"jur_no" => $jurno));
	}

	public function tf_data_trial($id_trial = '')
	{
		if ($id_trial == '') {
			$id_trial = $this->input->post('id_trial');
		}
		
		$hasil = array();
		$data = array();
		$trans_no = '';

		$proses_id = (int)$this->getProsesMnf();
		$pid = $proses_id;
		
		$selrs = array(
			'select' => array('a.*', 'b.keterangan as ketbb'),
	    	'table' => 'tm_produksi_trial a',
	    	'join' => array(
	    					'tset_bb b' => 'a.bb_no = b.bb_no'),
	    	'where'	=>array('a.pr_no' => $id_trial),
	    	'limit' => 1
	    );

		$srs = $this->setting_model->commonGet($selrs);
		if (is_array($srs) || is_object($srs)){
		    foreach($srs as $rs) {

		    	$UserAdd = $rs->user_id;
				
				$CreateDate = $rs->create_date;

		    	$hasil['parent_prod'] = array(
		    		"trans_date" => $rs->pr_date,
		    		"trans_no" => $rs->pr_no,
		    		"no_bb" => $rs->bb_no,
					"is_adj" => $rs->is_adjust,
					"ket_mnf" => (is_null($rs->pr_ket)? " " : $rs->pr_ket),					
					"gud_no" => $rs->gud_no
				);

				$trans_no = $rs->pr_no;
		    }
		}

		$selrs2 = array(
			'select' => array('a.*',' b.prod_code0', 'b.prod_name0', 'c.gud_code','b.prod_uom','b.prod_uom2', 'b.prod_uom3', 'b.acc_brg as rek_no','b.konversi1', 'b.konversi2', 'b.konversi2', 'x.jenis_brg', 'b.qty_kemasan', 'x.harga_satuan'),
	    	'table' => 'td_produksi_trial x',
	    	'join' => array(
	    					'tdetail_out a' => 'x.det_pr_no = a.det_sales_no',
	    					'tproduct b' => 'a.prod_no = b.prod_no',
	    					'tgudang c' => 'a.gud_no = c.gud_no'),
	    	'where'	=> array(
	    					'x.pr_no' => $trans_no, 
	    					'x.jenis_brg <>' => 0),
	    	'order' => array('a.det_sales_no' => 'ASC')
	    );

		$srs2 = $this->setting_model->commonGet($selrs2);

		$dsntmp = array();

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./transaction_data.json');
	    $posts = json_decode($fp, true);

		$all = array();
		// $response = array();
	    $post = array();

	    $post = array(
	    	"id_trans" => $pid,
			"is_edit" => 0,
			"trans_no" => $trans_no,
	        "detail_trans"   => $dsntmp
	    );

		$dsn = array();

		$id_det = (int)$this->get_id_det_trans(3,$proses_id);

		$satuan = '';
		$konversi = 0;

		if (is_array($srs2) || is_object($srs2)){
		    foreach($srs2 as $rs2) {

		    	if($rs2->satuan == 1){
		    		$satuan = $rs2->prod_uom;
		    		$konversi = $rs2->konversi1;
		    	}else if ($rs2->satuan == 2) {
		    		$satuan = $rs2->prod_uom2;
		    		$konversi = $rs2->konversi2;
		    	}else if ($rs2->satuan == 3) {
		    		$satuan = $rs2->prod_uom3;
		    		$konversi = $rs2->konversi3;
		    	}else{
		    		$satuan = $rs2->prod_uom;
		    		$konversi = $rs2->konversi1;
		    	}

		    	if ($rs2->jenis_brg == 1) {
					$jenis_brg = "Rote";
				}else if($rs2->jenis_brg == 2) {
					$jenis_brg = "Produksi";
				}else{
					$jenis_brg = "Rote";
				}

				$dsn[] = array(
				        "id_det" => $id_det++,
						"jenis_brg" => $jenis_brg,
						"prod_code" => $rs2->prod_code0,
						"prod_name" => $rs2->prod_name0,
						"prod_no" => $rs2->prod_no,
						"satuan" => $satuan,
						"qty_satuan" => $rs2->qty_satuan * -1,
						"konversi" => $konversi,
						"harga_satuan" => $rs2->harga_satuan,
						"harga_last" => 0,
						"harga_jual" => $rs2->harga_satuan,
						"det_total1" => 0,
						"det_total2" => ($rs2->qty_satuan * -1) * $rs2->harga_satuan,
						"keterangan" => " ",
						"qty_default" => 0,
						"qty_kemasan" => $rs2->qty_kemasan,
						"qty_pemakaian" => 0,
						"qty_dibutuhkan" => 0,
						"satuan_pakai" => " ",
						"satuan_butuh" => " ",
						"is_new" => 1,
						"jenis_tbl" => "mnf"
				);
		    }

		}

		$selrs3 = array(
			'select' => array('a.*', 'b.prod_code0', 'b.prod_name0', 'c.gud_code','b.prod_uom',' b.prod_uom2', 'b.prod_uom3','b.konversi1', 'b.konversi2', 'b.konversi2', 'b.acc_brg as rek_no', 'b.qty_kemasan', 'x.qty_default','x.qty_pemakaian', 'x.qty_dibutuhkan', 'x.satuan_pakai', 'x.satuan_butuh', 'x.harga_satuan'),
	    	'table' => 'td_produksi_trial x',
	    	'join' => array(
	    					'tdetail_out a' => 'x.det_pr_no = a.det_sales_no',
	    					'tproduct b' => 'a.prod_no = b.prod_no',
	    					'tgudang c' => 'a.gud_no = c.gud_no'),
	    	'where'	=> array(
	    					'x.pr_no' => $trans_no, 
	    					'x.jenis_brg' => 0),
	    	'order' => array('a.det_sales_no' => 'ASC')
	    );

		$srs3 = $this->setting_model->commonGet($selrs3);

		if (is_array($srs3) || is_object($srs3)){
		    foreach($srs3 as $rs3) {
				if($rs3->satuan == 1){
		    		$satuan = $rs3->prod_uom;
		    		$konversi = $rs3->konversi1;
		    	}else if ($rs3->satuan == 2) {
		    		$satuan = $rs3->prod_uom2;
		    		$konversi = $rs3->konversi2;
		    	}else if ($rs3->satuan == 3) {
		    		$satuan = $rs3->prod_uom3;
		    		$konversi = $rs3->konversi3;
		    	}

				$jenis_brg = "Rote";

				$dsn[] = array(
				        "id_det" => $id_det++,
						"jenis_brg" => $jenis_brg,
						"prod_code" => $rs3->prod_code0,
						"prod_name" => $rs3->prod_name0,
						"prod_no" => $rs3->prod_no,
						"satuan" => $satuan,
						"qty_satuan" => $rs3->qty_satuan,
						"konversi" => $konversi,
						"harga_satuan" => $rs3->harga_satuan,
						"harga_last" => $rs3->out_det_buy_price,
						"harga_jual" => $rs3->harga_satuan,
						"det_total1" => ($rs3->qty_satuan * $rs3->out_det_buy_price),
						"det_total2" => ($rs3->qty_satuan * $rs3->harga_satuan),
						"keterangan" => " ",
						"qty_default" => $rs3->qty_default,
						"qty_kemasan" => $rs3->qty_kemasan,
						"qty_pemakaian" => $rs3->qty_pemakaian,
						"qty_dibutuhkan" => $rs3->qty_dibutuhkan,
						"satuan_pakai" => $rs3->satuan_pakai,
						"satuan_butuh" => $rs3->satuan_butuh,
						"is_new" => 1,
						"jenis_tbl" => "bb"
				);
		    }

		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 3) {
		    	array_push($key['detail'],$post);
		    }
		}

		foreach ($posts['transaksi'] as &$key) {
		    if (($key['id']) == 3) {
		    	foreach ($key['detail'] as &$val) {
		    		if($val['id_trans'] == $pid){
		    			for($i = 0; $i < count($dsn); $i++){
		    				array_push($val['detail_trans'],$dsn[$i]);
		    			}
		    		}
		    	}
		    }
		}
		
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./transaction_data.json', $json_body);



	    if ( ! write_file('./transaction_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan transaction_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./transaction_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }

		$total_qty = 0;
		$total_pakai = 0;
		$total_butuh = 0;
		$total_hj = 0;
		$total_sub = 0;

		$data_json2 = file_get_contents('./transaction_data.json');

		$json_arr2 = json_decode($data_json2, true);

		foreach ($json_arr2['transaksi'] as &$key) {
        	if($key['id'] == 3){
				foreach ($key['detail'] as &$val) {
					if($val['id_trans'] == ((int)$proses_id)){
						foreach ($val['detail_trans'] as &$brg) {
							if ($brg['jenis_tbl'] == "bb") {
								$total_qty += $brg['qty_satuan'];
								$total_pakai += $brg['qty_pemakaian'];
								$total_butuh += $brg['qty_dibutuhkan'];
								$total_hj += $brg['harga_jual'];
								$total_sub += $brg['det_total2'];
							}
						}
					}
				}
			}
		}

		$hasil['child_prod'] = array(
			"qty_satuan" => $total_qty,
			"qty_pakai" => $total_pakai,
			"qty_butuh" =>$total_butuh,
			"harga_jual" => $total_hj,
			"sub_total" => $total_sub
		);

		echo json_encode($hasil);
	}

	public function print_mnf_pdf($id_mnf='')
	{
		$data = array();

		$option = array(
			'select' => array(
								'a.pr_no',
								'a.pr_date',
								'a.pr_ket',
								'b.prod_code0',
								'b.prod_name0',
								'a.pr_ket as keterangan'
							),
	    	'table' => 'tm_produksi a',
	    	'join' => array(
	    					'tproduct b' => 'a.prod_no = b.prod_no'),
	    	'where'	=>array('a.pr_no' => $id_mnf)
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);

		$option2 = array(
			'select' => array('c.pr_no', 'c.pr_date', 'c.pr_ket', 
								'd.user_name as unama', 
								'b.prod_code0', 'b.prod_name0',
								'(a.qty_satuan * -1) as qty_sat',
								'if(a.satuan=1,b.prod_uom, if(a.satuan=2,b.prod_uom2, if(a.satuan=3,b.prod_uom3,b.prod_uom))) as uom','c.pr_ket'),
	    	'table' => 'tdetail_out a',
	    	'join' => array(
	    					'tproduct b' => 'a.prod_no = b.prod_no',
	    					'tm_produksi c' => 'a.out_no = c.pr_no',
	    					'tusers d' => 'c.user_id = d.user_id'),
	    	'where'	=>array('a.out_no' => $id_mnf),
	    	'order' => array('a.out_no' => 'ASC', 
	    					'a.out_det_qty' => 'ASC', 
	    					'a.out_det_no' => 'ASC')
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);


		$pdf = new FPDF();
		$pdf->AddPage('P', 'A4');
		$pdf->SetFont('Arial', 'B', 12);
		$pageWidth = $pdf->GetPageWidth();

		// Define the desired margins
		$leftMargin = 5;
		$rightMargin = 5;

		// Calculate the table width based on the available space
		$tableWidth = $pageWidth - ($leftMargin + $rightMargin);

		$pdf->SetLeftMargin($leftMargin);
		$pdf->SetRightMargin($rightMargin);

		// Calculate the X position to center the table
		// $tableX = ($pageWidth - $tableWidth) / 2;

		$pdf->SetFont('Arial', '', 12);

		foreach ($data['get_data'] as $master) {
		    $nobuk = $master->pr_no;
		    $tgl = explode(" ", $master->pr_date);
		    $kode = $master->prod_code0;
		    $nama = $master->prod_name0;
		    $ket = $master->keterangan;

		    $pdf->Cell($tableWidth, 5, '', 0, 1, '', false); // Empty cell for spacing

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'No. Produksi', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $nobuk, 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'Tanggal', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $tgl[0], 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'Kode', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $kode, 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'Nama', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $nama, 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'Keterangan', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $ket, 0, 1, '', false);
		}

		$pdf->Ln();

		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell($tableWidth, 10, 'PRODUKSI', 0, 1, 'L');

		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell($tableWidth * 0.05, 8, 'No', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.25, 8, 'Kode', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.50, 8, 'Nama Barang', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.10, 8, 'Qty', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.10, 8, 'Satuan', 'TB', 1, 'C');

		$no = 0;
		$dket = '';
		foreach ($data['get_unit'] as $det) {
		    $no++;
		    $pdf->Cell($tableWidth * 0.05, 8, $no, 0, 0, 'C', false);
		    $pdf->Cell($tableWidth * 0.25, 8, $det->prod_code0, 0, 0, 'L', false);
		    $pdf->Cell($tableWidth * 0.50, 8, $det->prod_name0, 0, 0, 'L', false, false);
		    $pdf->Cell($tableWidth * 0.10, 8, $det->qty_sat, 0, 0, 'R', false);
		    $pdf->Cell($tableWidth * 0.10, 8, $det->uom, 0, 1, 'L', false);

		    $dket = $det->pr_ket;
		}	

		$pdf->Ln();

		// Output the footer information without borders
		$pdf->Cell($tableWidth * 0.20, 8, 'Total Item: ' . $no, 0, 0, 'L', false);
		$pdf->Cell($tableWidth * 0.60, 8, 'Dibuat: ' . $dket, 0, 0, 'L', false);
		$pdf->Cell($tableWidth * 0.20, 8, 'Tanggal: ' . date('Y-m-d H:i:s'), 0, 1, 'R', false);

		$filename =$id_mnf.'_'.date('Ymd').'.pdf';
		$pdf->Output($filename, 'I');

		// $html = $this->load->view('print/manufaktur', $data, true);
        // $this->pdf->createPDF($html, $id_mnf.'_'.date('Ymd'), false);
	}

	public function print_bb_pdf($id_bb='')
	{
		$data = array();

		$option = array(
			'select' => array(
								'tset_bb.bb_no',
								'tset_bb.prod_no',
								'tset_bb.tgl',
								'tset_bb.keterangan',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3',

							),
	    	'table' => 'tset_bb',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = tset_bb.prod_no'),
	    	'where'	=>array('tset_bb.bb_no' => $id_bb)
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);

		$option2 = array(
			'select' => array(
								'td_set_bb.det_no',
								'td_set_bb.bb_no',
								'td_set_bb.prod_no',
								'td_set_bb.satuan',
								'td_set_bb.qty_satuan',
								'td_set_bb.konversi',
								'td_set_bb.harga_satuan',
								'td_set_bb.price_netto',
								'td_set_bb.keterangan',
								'td_set_bb.qty_pemakaian',
								'td_set_bb.qty_dibutuhkan',
								'td_set_bb.satuan_pakai',
								'td_set_bb.satuan_butuh',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3'
							),
	    	'table' => 'td_set_bb',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = td_set_bb.prod_no'),
	    	'where'	=>array('td_set_bb.bb_no' => $id_bb)
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);

		$pdf = new FPDF();
		$pdf->AddPage('P', 'A4');
		$pageWidth = $pdf->GetPageWidth();

		// Define the desired margins
		$leftMargin = 5;
		$rightMargin = 5;

		// Calculate the table width based on the available space
		$tableWidth = $pageWidth - ($leftMargin + $rightMargin);

		$pdf->SetLeftMargin($leftMargin);
		$pdf->SetRightMargin($rightMargin);

		// Calculate the X position to center the table
		// $tableX = ($pageWidth - $tableWidth) / 2;

		$pdf->SetFont('Arial', 'B', 20);

		$pdf->Cell($tableWidth, 5, '', 0, 1, '', false);

		$pdf->Cell($tableWidth, 10, 'FORMULA BAHAN BAKU', 'B', 1, 'L', false);

		$pdf->SetFont('Arial', '', 12);

		foreach ($data['get_data'] as $master) {
		    $nobuk = $master->bb_no;
		    $tgl = explode(" ", $master->tgl);
		    $kode = $master->prod_code0;
		    $nama = $master->prod_name0;
		    $ket = $master->keterangan;

		    $pdf->Cell($tableWidth, 5, '', 0, 1, '', false); // Empty cell for spacing

		    $pdf->Cell($tableWidth * 0.15, 5, 'No. Produksi', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.51, 5, $nobuk, 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.10, 5, 'Tanggal', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.20, 5, $tgl[0], 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.15, 5, 'Kode', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $kode, 0, 0,'', false);
		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.15, 5, 'Nama', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $nama, 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.15, 5, 'Keterangan', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $ket, 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 1, '', false);
		}

		$pdf->Ln();

		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell($tableWidth * 0.05, 8, 'No', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.25, 8, 'Kode', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.50, 8, 'Nama Barang', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.10, 8, 'Qty', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.10, 8, 'Satuan', 'TB', 1, 'C');

		$no = 0;
		$qty = 0;
		foreach ($data['get_unit'] as $det) {
		    $no++;
		    $pdf->Cell($tableWidth * 0.05, 8, $no, 0, 0, 'C', false);
		    $pdf->Cell($tableWidth * 0.25, 8, $det->prod_code0, 0, 0, 'L', false);
		    $pdf->Cell($tableWidth * 0.50, 8, $det->prod_name0, 0, 0, 'L', false, false);
		    $pdf->Cell($tableWidth * 0.10, 8, $det->qty_satuan, 0, 0, 'R', false);
		    $pdf->Cell($tableWidth * 0.10, 8, $det->prod_uom, 0, 1, 'L', false);

		    $qty = $qty + $det->qty_satuan;

		}	
		// Output the footer information without borders
		$pdf->Cell($tableWidth * 0.80, 8, 'Total', 0, 0, 'R', false);
		$pdf->Cell($tableWidth * 0.10, 8, $qty , 0, 0, 'R', false);
		$pdf->Cell($tableWidth * 0.10, 8, '' , 0, 1, '', false);

		$filename = $id_bb.'_'.date('Ymd').'.pdf';
		$pdf->Output($filename, 'I');

		// $html = $this->load->view('print/bahan_baku', $data, true);
  //       $this->pdf->createPDF($html, $id_bb.'_'.date('Ymd'), false);
	}

	public function print_trial_pdf($id_trial='')
	{
		$data = array();

		$option = array(
			'select' => array(
								'a.pr_no',
								'a.pr_date',
								'a.pr_ket',
								'b.prod_code0',
								'b.prod_name0',
								'a.pr_ket as keterangan'
							),
	    	'table' => 'tm_produksi_trial a',
	    	'join' => array(
	    					'tproduct b' => 'a.prod_no = b.prod_no'),
	    	'where'	=>array('a.pr_no' => $id_trial)
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);

		$option2 = array(
			'select' => array('c.pr_no', 'c.pr_date', 'c.pr_ket', 
								'd.user_name as unama', 
								'b.prod_code0', 'b.prod_name0',
								'a.qty_satuan',
								'if(a.satuan = 1,b.prod_uom, if(a.satuan = 2,b.prod_uom2, if(a.satuan = 3,b.prod_uom3,b.prod_uom))) as uom','c.pr_ket'),
	    	'table' => 'td_produksi_trial a',
	    	'join' => array(
	    					'tproduct b' => 'a.prod_no = b.prod_no',
	    					'tm_produksi_trial c' => 'a.pr_no = c.pr_no',
	    					'tusers d' => 'c.user_id = d.user_id'),
	    	'where'	=>array('a.pr_no' => $id_trial),
	    	'order' => array('a.pr_no' => 'ASC')
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);

		$pdf = new FPDF();
		$pdf->AddPage('P', 'A4');
		$pdf->SetFont('Arial', 'B', 12);
		$pageWidth = $pdf->GetPageWidth();

		// Define the desired margins
		$leftMargin = 5;
		$rightMargin = 5;

		// Calculate the table width based on the available space
		$tableWidth = $pageWidth - ($leftMargin + $rightMargin);

		$pdf->SetLeftMargin($leftMargin);
		$pdf->SetRightMargin($rightMargin);

		// Calculate the X position to center the table
		// $tableX = ($pageWidth - $tableWidth) / 2;

		$pdf->SetFont('Arial', '', 12);

		foreach ($data['get_data'] as $master) {
		    $nobuk = $master->pr_no;
		    $tgl = explode(" ", $master->pr_date);
		    $kode = $master->prod_code0;
		    $nama = $master->prod_name0;
		    $ket = $master->keterangan;

		    $pdf->Cell($tableWidth, 5, '', 0, 1, '', false); // Empty cell for spacing

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'No. Produksi', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $nobuk, 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'Tanggal', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $tgl[0], 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'Kode', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $kode, 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'Nama', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $nama, 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.15, 5, 'Keterangan', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $ket, 0, 1, '', false);
		}

		$pdf->Ln();

		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell($tableWidth, 10, 'TRIAL PRODUKSI', 0, 1, 'L');

		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell($tableWidth * 0.05, 8, 'No', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.25, 8, 'Kode', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.50, 8, 'Nama Barang', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.10, 8, 'Qty', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.10, 8, 'Satuan', 'TB', 1, 'C');

		$no = 0;
		$dket = '';
		foreach ($data['get_unit'] as $det) {
		    $no++;
		    $pdf->Cell($tableWidth * 0.05, 8, $no, 0, 0, 'C', false);
		    $pdf->Cell($tableWidth * 0.25, 8, $det->prod_code0, 0, 0, 'L', false);
		    $pdf->Cell($tableWidth * 0.50, 8, $det->prod_name0, 0, 0, 'L', false, false);
		    $pdf->Cell($tableWidth * 0.10, 8, $det->qty_satuan, 0, 0, 'R', false);
		    $pdf->Cell($tableWidth * 0.10, 8, $det->uom, 0, 1, 'L', false);

		    $dket = $det->pr_ket;
		}	

		$pdf->Ln();

		// Output the footer information without borders
		$pdf->Cell($tableWidth * 0.20, 8, 'Total Item: ' . $no, 0, 0, 'L', false);
		$pdf->Cell($tableWidth * 0.60, 8, 'Dibuat: ' . $dket, 0, 0, 'L', false);
		$pdf->Cell($tableWidth * 0.20, 8, 'Tanggal: ' . date('Y-m-d H:i:s'), 0, 1, 'R', false);

		$filename =$id_trial.'_'.date('Ymd').'.pdf';
		$pdf->Output($filename, 'I');

		// $html = $this->load->view('print/trial', $data, true);
        // $this->pdf->createPDF($html, $id_trial.'_'.date('Ymd'), false);
	}

	public function print_role_pdf($id_role='')
	{
		$data = array();

		$option = array(
			'select' => array(
								'tset_hpp.hap_no',
								'tset_hpp.tgl',
								'tset_hpp.keterangan'
							),
	    	'table' => 'tset_hpp',
	    	'where'	=>array('tset_hpp.hap_no' => $id_role)
	    );

	    $data['get_data'] = $this->setting_model->commonGet($option);

	    $option2 = array(
			'select' => array(
								'td_set_hpp.det_no',
								'td_set_hpp.hap_no',
								'td_set_hpp.prod_no',
								'td_set_hpp.satuan',
								'td_set_hpp.konversi',
								'td_set_hpp.harga_satuan',
								'td_set_hpp.price_netto',
								'td_set_hpp.keterangan',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_uom',
								'tproduct.prod_uom2',
								'tproduct.prod_uom3'
							),
	    	'table' => 'td_set_hpp',
	    	'join' => array(
	    					'tproduct' => 'tproduct.prod_no = td_set_hpp.prod_no'),
	    	'where'	=>array('td_set_hpp.hap_no' => $id_role)
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);

		$pdf = new FPDF();
		$pdf->AddPage('P', 'A4');
		$pageWidth = $pdf->GetPageWidth();

		// Define the desired margins
		$leftMargin = 5;
		$rightMargin = 5;

		// Calculate the table width based on the available space
		$tableWidth = $pageWidth - ($leftMargin + $rightMargin);

		$pdf->SetLeftMargin($leftMargin);
		$pdf->SetRightMargin($rightMargin);

		// Calculate the X position to center the table
		// $tableX = ($pageWidth - $tableWidth) / 2;

		$pdf->SetFont('Arial', 'B', 20);

		$pdf->Cell($tableWidth, 5, '', 0, 1, '', false);

		$pdf->Cell($tableWidth, 10, 'ROTE PRICE', 'B', 1, 'L', false);

		$pdf->SetFont('Arial', '', 12);

		foreach ($data['get_data'] as $master) {
		    $nobuk = $master->hap_no;
		    $tgl = explode(" ", $master->tgl);
		    $ket = $master->keterangan;

		    $pdf->Cell($tableWidth, 5, '', 0, 1, '', false); // Empty cell for spacing

		    $pdf->Cell($tableWidth * 0.15, 5, 'No. Proses', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.51, 5, $nobuk, 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.10, 5, 'Tanggal', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.20, 5, $tgl[0], 0, 1, '', false);

		    $pdf->Cell($tableWidth * 0.15, 5, 'Keterangan', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.02, 5, ':', 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.25, 5, $ket, 0, 0, '', false);
		    $pdf->Cell($tableWidth * 0.58, 5, '', 0, 1, '', false);
		}

		$pdf->Ln();

		$pdf->SetFont('Arial', '', 12);

		$pdf->Cell($tableWidth * 0.05, 8, 'No', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.25, 8, 'Kode', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.50, 8, 'Nama Barang', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.10, 8, 'Satuan', 'TB', 0, 'C');
		$pdf->Cell($tableWidth * 0.10, 8, 'Harga', 'TB', 0, 'C');

		$no = 0;
		$qty = 0;
		foreach ($data['get_unit'] as $det) {
		    $no++;
		    $pdf->Cell($tableWidth * 0.05, 8, $no, 0, 0, 'C', false);
		    $pdf->Cell($tableWidth * 0.25, 8, $det->prod_code0, 0, 0, 'L', false);
		    $pdf->Cell($tableWidth * 0.50, 8, $det->prod_name0, 0, 0, 'L', false, false);
		    $pdf->Cell($tableWidth * 0.10, 8, $det->prod_uom, 0, 0, 'L', false);
		    $pdf->Cell($tableWidth * 0.10, 8, number_format((float)$det->harga_satuan, 2, '.', ','), 0, 1, 'R', false);

		}	

		$filename = $id_role.'_'.date('Ymd').'.pdf';
		$pdf->Output($filename, 'I');

		// $html = $this->load->view('print/role_mnf', $data, true);
        // $this->pdf->createPDF($html, $id_role.'_'.date('Ymd'), false);

	}

}