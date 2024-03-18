<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once(APPPATH . '../vendor/setasign/fpdf/fpdf.php');

class Product extends CI_Controller {
	var $current_db;
	var $db_selected;
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
		$this->load->view("admin/barang");
	}
	public function test_upload()
	{
		$data = array();

		$this->load->view("admin/test_upload",$data);
	}
	public function page($keyword = '',$is_archive = '', $group_id = '', $kat_id= '',$sts1 = '')
	{  
		if($is_archive <> ''){
			if($is_archive <> 'false'){
				$is_archive = array(1,0);
				$chk = 1;
			}else{
				$is_archive = array(0);
				$chk = 0;
			}
		}else{
			$is_archive = array(0);
			$chk = 0;
		}

		$sts = (int)$sts1;

		$option1 = array(
			'select' => array(
								'tcat.cat_id',
								'tcat.kode',
								'tcat.nama'),
	    	'table' => 'tcat',
	    	'where' => array(
							'tcat.is_delete' => 0),
	    	'order' => array('tcat.nama' => 'ASC')
	    );

		$option2 = array(
			'select' => array(
								'tgroup.group_id',
								'tgroup.kode',
								'tgroup.nama'),
	    	'table' => 'tgroup',
	    	'where' => array(
							'tgroup.is_delete' => 0),
	    	'order' => array('tgroup.nama' => 'ASC')
	    );

		$ct1 = array(
			'select' => array('count(tproduct.prod_no) as tersedia'),
	    	'table' => 'tproduct',
	    	'where' => array(
							'tproduct.is_delete' => 0,
							'tproduct.prod_on_hand >' => 0)
	    );
	    $ct2 = array(
			'select' => array('count(tproduct.prod_no) as segera'),
	    	'table' => 'tproduct',
	    	'where' => array(
							'tproduct.is_delete' => 0,
							'tproduct.prod_on_hand <=' => 5,
							'tproduct.prod_on_hand >' => 0
						)
	    );
	    $ct3 = array(
			'select' => array('count(tproduct.prod_no) as habis'),
	    	'table' => 'tproduct',
	    	'where' => array(
							'tproduct.is_delete' => 0,
							'tproduct.prod_on_hand' => 0)
	    );

	    $selgud = array(
			'select' => array('gud_no', 'gud_code', 'gud_name'),
	    	'table' => 'tgudang',
	    	'where' => array('is_delete' => 0,
	    					'is_default' => '1'),
	    	'order' => array('is_produksi' => 'DESC')
	    );

		if($keyword=='none'){$keyword = '';}else{$keyword = str_replace("_"," ",$keyword);}
		$data = array();

		$data['prt'] =  $this->setting_model->commonGet($ct1);
	    $data['prs'] =  $this->setting_model->commonGet($ct2);
	    $data['prh'] =  $this->setting_model->commonGet($ct3);
	    $data['kat'] =  $this->setting_model->commonGet($option1);
	    $data['sub_kat'] =  $this->setting_model->commonGet($option2);
	    $data['gud'] = $this->setting_model->commonGet($selgud);
		$data['keyw'] = $keyword;
		$data['is_arc'] = $chk;
		$data['kat_id'] = $kat_id;
		$data['group_id'] = $group_id;
		$data['sts'] = $sts;

		$this->load->view("admin/barang",$data);
	}

	//tab produk
	public function list($keyword = '',$is_archive = '', $group_id = '', $kat_id= '',$sts1 = '')
	{

		if($is_archive <> ''){
			if($is_archive <> 'false'){
				$is_archive = array(1,0);
			}else{
				$is_archive = array(0);
			}
		}else{
			$is_archive = array(0);
		}

		$sts = (int)$sts1;

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tproduct.prod_code0' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_code1' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tproduct.prod_name1' => $keyword);
		}

		$where = array();

		if($sts <> 0){
			$where['tproduct.is_stok'] = $sts-1;
		}

		if($kat_id == 0){

		}else{
			$where['tproduct.cat_id'] = $kat_id;
		}

		if($group_id == 0){

		}else{
			$where['tproduct.group_id'] = $group_id;
		}

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

		// 	$where['tdgproduct.gud_no'] = $gud_no;
		// }

		$option1 = array(
			'select' => array(
								'tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.cat_id',
								'tproduct.group_id',
								'tcat.nama as nama_kat',
								'tgroup.nama as nama_group',
								'concat(if(tdgproduct.prod_on_hand <> "",tdgproduct.prod_on_hand, 0), " ",tproduct.prod_uom) as stok',
								'format(if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price),2) as prod_buy_price2',
								'format(((tproduct.prod_sell_price - if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) / if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) * 100, 2) as prod_buy_persen2',
								'format(tproduct.prod_last_ppn,2) as prod_last_ppn2',
								'format((((tproduct.prod_sell_price - tproduct.prod_last_ppn) / tproduct.prod_last_ppn)) * 100,2) as prod_ppn_persen2',
								'tproduct.prod_sell_price',
								'tdgproduct.gud_no',
								'tproduct.is_stok'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no AND tdgproduct.gud_no = "'.$gud_no.'"'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_code0' => 'ASC')
	    );
	    $option2 = array(
			'select' => array('count(tproduct.prod_no) as total'),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no AND tdgproduct.gud_no = "'.$gud_no.'"'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_code0' => 'ASC')
	    );
		
		$data = array();
		$data['grp'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);
		$this->load->view('admin/demo/ecommerce_products',$data);
	}

	public function getCatAcc($KatId='')
	{
		$RekBrg = array();

		$select = array(
			'select' => array('a.rek_no',
							'a.rek_jual',
							'a.rek_retur_jual',
							'a.rek_pot_jual',
							'a.rek_hpp'),
	    	'table' => 'tcat a',
	    	'where'	=> array('a.cat_id' => $KatId)
	    );

	    $get = $this->setting_model->commonGet($select);

	    if (is_array($get) || is_object($get)) {
	    	foreach ($get as $key) {
	    		$RekBrg = array(
	    			"rek_no" => $key->rek_no,
	    			"rek_jual" => $key->rek_jual,
	    			"rek_retur_jual" => $key->rek_retur_jual,
	    			"rek_pot_jual" => $key->rek_pot_jual,
	    			"rek_hpp" => $key->rek_hpp
	    		);
	    	}
	    }

	    return $RekBrg;
	}

	public function action_product()
	{
		$prod_no = $this->GetNoIDField('prod_no','tproduct');
		$id_brg =$this->input->post('id_brg');
		$code0 =$this->input->post('kode0');
		$name0=$this->input->post('nama0');
		$code1=$this->input->post('kode1');
		$name1=$this->input->post('nama1');
		$akses=$this->input->post('status');
		$cat=$this->input->post('kat');
		$grp=$this->input->post('sub_kat');
		$desc=$this->input->post('desk');
		$prod_buy=$this->input->post('prod_buy');
		$prod_ppn=$this->input->post('prod_ppn');
		$prod_kemasan=$this->input->post('kemasan');
		$qty_kemasan=$this->input->post('qty_kemasan');
		$tipe_brg=$this->input->post('tipe_brg');
		$is_ptkp=$this->input->post('is_ptkp');
		$is_inc=$this->input->post('is_inc');
		$tableData=$this->input->post('tableData');

		$chk_code0 = array('tproduct.prod_code0' => $code0);
		$chk_name0 = array('tproduct.prod_name0' => $name0);

		$is_code0 = $this->get_data_prod($chk_code0);
		$is_name0 = $this->get_data_prod($chk_name0);

		$Rek = $this->getCatAcc($cat);

		$is_satuan_ok = $this->cek_unit_satuan($tableData);

		if($is_satuan_ok > 0){
			echo json_encode(array(
				"statusCode"=>5001,
				"satuan" => $is_satuan_ok
			));
			die();
		}

		$date = date('Y-m-d H:i:s');
		$user_right = '';
		if($this->input->post('type')==1){// insert
			if ($is_code0 == 1 || $is_name0 == 1) {
				echo json_encode(array(
					"statusCode"=>405
				));
				die();
			}else{

				$insert = array(
					'insert' => array(
						'iUpload' => 1,
						'create_date' => $date,
						'prod_no' => $prod_no,
						'prod_code0' => $code0,
						'prod_name0' => $name0,
						'prod_code1' => $code1,
						'prod_name1' => $name1,
						'is_delete' => $akses,
						'cat_id' => $cat,
						'group_id' => $grp,
						'prod_desc' => $desc,
						'prod_buy_price' => $prod_buy,
						'prod_last_ppn' => $prod_ppn,
						'prod_kemasan' => $prod_kemasan,
						'qty_kemasan' => $qty_kemasan,
						'is_stok' => (($tipe_brg <> '') ? $tipe_brg : 0),
						'prod_tax_included' => $is_inc,
						'is_NonPkp' => $is_ptkp,
						'acc_brg' => $Rek['rek_no'], 
						'acc_jual' => $Rek['rek_jual'], 
						'acc_retur' => $Rek['rek_retur_jual'], 
						'acc_pot' => $Rek['rek_pot_jual'], 
						'acc_hpp' => $Rek['rek_hpp']
					),
					'table' => 'tproduct'
				);

	        	$this->setting_model->commonInsert($insert);
	        	$this->insert_satuan_barang($prod_no);

	        	echo json_encode(array(
					"statusCode"=>200,
					"prod_no" => $prod_no,
				));
			}
		}elseif($this->input->post('type')==2) {//update
			$update = array(
					'update' => array(
						'prod_code0' => $code0,
						'prod_name0' => $name0,
						'prod_code1' => $code1,
						'prod_name1' => $name1,
						'is_delete' => $akses,
						'cat_id' => $cat,
						'group_id' => $grp,
						'prod_desc' => $desc,
						'prod_buy_price' => $prod_buy,
						'prod_last_ppn' => $prod_ppn,
						'prod_kemasan' => $prod_kemasan,
						'qty_kemasan' => $qty_kemasan,
						'is_stok' => (($tipe_brg <> '') ? $tipe_brg : 0),
						'prod_tax_included' => $is_inc,
						'is_NonPkp' => $is_ptkp,
						'acc_brg' => $Rek['rek_no'], 
						'acc_jual' => $Rek['rek_jual'], 
						'acc_retur' => $Rek['rek_retur_jual'], 
						'acc_pot' => $Rek['rek_pot_jual'], 
						'acc_hpp' => $Rek['rek_hpp']
					),
					'table' => 'tproduct',
					'where' => array(
						'tproduct.prod_no' => $id_brg
					)
			);
        	$up = $this->setting_model->commonUpdate($update);
        	$del = $this->delete_satuan_update($id_brg);
        	$ins = $this->insert_satuan_barang($id_brg);

			echo json_encode(array(
				"statusCode"=>201,
				"prod_no" => $id_brg
			));
		}elseif($this->input->post('type')==3) {//delete

			 foreach($id_brg as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1),
						'table' => 'tproduct',
						'where' => array(
							'tproduct.prod_no' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}elseif($this->input->post('type')==4) {//arsip

			 foreach($id_brg as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1),
						'table' => 'tproduct',
						'where' => array(
							'tproduct.prod_no' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}elseif($this->input->post('type')==12) {
			$arr = $this->input->post();
			$unit_nama = $arr['unit_nama'];
			$unit_kon = $arr['unit_kon'];
			$unit_hj_dua = $arr['unit_hj_dua'];
			$unit_hj_tiga = $arr['unit_hj_tiga'];
			$unit_hj = $arr['unit_hj'];

			for($count = 0; $count<count($unit_nama); $count++){
				$unit_no = $this->GetNoIDField('unit_no','unit');

				$unit_nama_clean = $unit_nama[$count];
				$unit_kon_clean = $unit_kon[$count];
				$unit_hj_dua_clean = $unit_hj_dua[$count];
				$unit_hj_tiga_clean = $unit_hj_tiga[$count];
				$unit_hj_clean = $unit_hj[$count];
				$satuan = $count+1;

				if($unit_nama_clean != '' && $unit_kon_clean != '' && $unit_hj_dua_clean != '' && $unit_hj_tiga_clean != '' && $unit_hj_clean != ''){

					$sql .= '
					INSERT INTO unit(unit_no, prod_no, satuan, konversi,nm_satuan, hj_satu) 
					VALUES("'.$unit_no.'", "'.$prod_no.'", "'.$satuan.'", "'.$this->db->escape($unit_kon_clean).'","'.$this->db->escape($unit_nama_clean).'","'.$this->db->escape($unit_hj_clean).'"); 
					';
					$query = $this->db->query($sql);
				}
			}
			if($sql != ''){
				if(empty($this->db->error())){
					echo 'Data Berhasil disimpan';
					echo json_encode(array(
						"statusCode"=>212
					));
				}else{
					echo json_encode(array(
						"statusCode"=>'error'
					));
				}
			}else{
				echo json_encode(array(
						"statusCode"=>'empty field'
					));
			}
		}
	}
	public function get_edit_data()
	{
		$count = 0;
		$hasil = array();
		$data = array();
		$proses_id = (int)$this->get_id_proses();

		$option = array(
			'select' => array(
								'tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.cat_id',
								'tproduct.group_id',
								'concat(tproduct.prod_on_hand, " ",tproduct.prod_uom) as stok',
								'format(if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price),2) as prod_buy_price2',
								'format(((tproduct.prod_sell_price - if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) / if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) * 100, 2) as prod_buy_persen2',
								'format(tproduct.prod_last_ppn,2) as prod_last_ppn2',
								'format((((tproduct.prod_sell_price - tproduct.prod_last_ppn) / tproduct.prod_last_ppn)) * 100,2) as prod_ppn_persen2',
								'tproduct.prod_sell_price',
								'tproduct.prod_desc',
								'tproduct.is_delete',
								'tproduct.prod_buy_price',
								'tproduct.prod_last_ppn',
								'tproduct.is_stok',
								'tproduct.prod_tax_included',
								'tproduct.is_NonPkp',
								'tproduct.prod_kemasan',
								'tproduct.qty_kemasan'
							),
	    	'table' => 'tproduct',
	    	'where'	=>array('tproduct.prod_no' => $this->input->post('id_brg'))
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);
		if (is_array($data['get_data']) || is_object($data['get_data'])){
		    foreach($data['get_data'] as $right) {
		    	$hasil['parent_prod'] = array(
					"prod_no" => $right->prod_no,
					"prod_code0" => $right->prod_code0,
					"prod_name0" => $right->prod_name0,
					"prod_code1" => $right->prod_code1,
					"prod_name1" => $right->prod_name1,
					"status" => $right->is_delete,
					"cat_id" => $right->cat_id,
					"group_id" => $right->group_id,
					"desc" => $right->prod_desc,
					"proses_id" => $proses_id,
					"prod_buy_price" => $right->prod_buy_price,
					"prod_last_ppn" => $right->prod_last_ppn,
					"tipe_brg" => $right->is_stok,
					"is_ptkp" => $right->is_NonPkp,
					"is_inc" => $right->prod_tax_included,
					"kemasan" => $right->prod_kemasan,
					"qty_kemasan" => $right->qty_kemasan
				);
		    }
		}

		$option2 = array(
			'select' => array(
								'unit.unit_no',
								'unit.prod_no',
								'unit.satuan',
								'unit.nm_satuan',
								'unit.konversi',
								'unit.hj_satu',
								'unit.hj_dua',
								'unit.hj_tiga',
								'unit.hb',
								'unit.hb_ppn'
							),
	    	'table' => 'unit',
	    	'where'	=>array('unit.prod_no' => $this->input->post('id_brg'))
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);

		if(is_array($data['get_unit']) || is_object($data['get_unit'])){
		    foreach($data['get_unit'] as $right) {
				$this->write_edit_satuan($right->nm_satuan,$right->konversi,$right->hj_satu,$right->hj_dua,$right->hj_tiga,$proses_id,$right->prod_no,$right->unit_no);
				$count = $count+1;
		    }
		}

		if($count < 3){
			$posts = array();
		    $post = array();
		    $dsn = array();

		    $fp = file_get_contents('./temp_data.json');
		    $posts = json_decode($fp, true);
		
		    $max = $this->get_id_json();
		    $id = $max + 1;

			$all = array();
			// $response = array();
		    $post = array();

		    $dsn[] = array(
			        	"konversi" => 0,
			        	"nm_satuan" => '',
				        "hj_satu" => 0,
				        "hj_dua" => 0,
				        "hj_tiga" => 0,
				        "prod_no" => '',
				        "unit_no" => ''
		    );
		    //If the json is correct, you can then write the file and load the view
		    for($a = $count; $a < 3; $a++){
			    $post = array(
			    	"id"    => $id++,
					"proses_id" => $proses_id,
					"is_edit" => 0,
			        "unit"   => $dsn
			    );

			    array_push($posts['satuan'],$post);
			}
		 
		    $json_body = json_encode($posts);

		    file_put_contents('./temp_data.json', $json_body);
			
		}

		echo json_encode($hasil);
	}

	public function get_img_edit()
	{
		$hasil = array();
		$data = array();

		$option3 = array(
			'select' => array(
								'timg_product.id',
								'timg_product.prod_no',
								'timg_product.filename',
								'timg_product.url'
							),
	    	'table' => 'timg_product',
	    	'where'	=>array('timg_product.prod_no' => $this->input->post('id_brg'))
	    );

		$data['get_img'] = $this->setting_model->commonGet($option3);

		if (is_array($data['get_img']) || is_object($data['get_img'])){
		    foreach($data['get_img'] as $right) {
		    	$hasil[] = array(
					"id" => (int)$right->id,
					"src" => $right->url
				);
		    }
		}

		echo json_encode($hasil);
	}
	public function write_edit_satuan($nm_satuan='',$konversi='', $hj_satu='', $hj_dua ='',$hj_tiga='', $proses_id='',$prod_no = '', $unit_no = '')
	{
		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./temp_data.json');
	    $posts = json_decode($fp, true);
	
	    $max = $this->get_id_json();
	    $id = $max + 1;

		$all = array();
		// $response = array();
	    $post = array();

	    $dsn[] = array(
		        	"konversi" => (int)$konversi,
		        	"nm_satuan" => $nm_satuan,
			        "hj_satu" => (float)$hj_satu,
			        "hj_dua" => (float)$hj_dua,
			        "hj_tiga" => (float)$hj_tiga,
			        "prod_no" => $prod_no,
			        "unit_no" => $unit_no
	    );
	    //If the json is correct, you can then write the file and load the view

	    $post = array(
	    	"id"    => $id,
			"proses_id" => (int)$proses_id,
			"is_edit" => 1,
	        "unit"   => $dsn
	    );

	    array_push($posts['satuan'],$post);
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./temp_data.json', $json_body);

	    if ( ! write_file('./temp_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan temp_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./temp_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }
	}

	public function test_img()
	{
		$hasil = array();
		$option3 = array(
			'select' => array(
								'timg_product.id',
								'timg_product.prod_no',
								'timg_product.filename',
								'timg_product.url'
							),
	    	'table' => 'timg_product',
	    	'where'	=>array('timg_product.prod_no' => 'ID-230113-114633-0003')
	    );

		$data = $this->setting_model->commonGet($option3);

		if (is_array($data) || is_object($data)){
		    foreach($data as $right) {
		    	$hasil[] = array(
					"id" => $right->id,
					"src" => $right->url
				);
		    }
		}

		echo json_encode($hasil);
	}

	public function test_satuan()
	{
		$data = array();
		$option2 = array(
			'select' => array(
								'unit.unit_no',
								'unit.prod_no',
								'unit.satuan',
								'unit.nm_satuan',
								'unit.konversi',
								'unit.hj_satu',
								'unit.hj_dua',
								'unit.hj_tiga',
								'unit.hb',
								'unit.hb_ppn'
							),
	    	'table' => 'unit',
	    	'where'	=>array('unit.prod_no' => 'ID-230113-112939-0001')
	    );

		$data['get_unit'] = $this->setting_model->commonGet($option2);

		if (is_array($data['get_unit']) || is_object($data['get_unit'])){
		    foreach($data['get_unit'] as $right) {
				$this->write_edit_satuan($right->nm_satuan,$right->konversi,$right->hj_satu,$right->hj_dua,$right->hj_tiga,$proses_id,$right->prod_no,$right->unit_no);
		    }
		}
	}
	//get new id field
	public function GetNoIDField($field='', $table='')
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
        	// print_r($c);

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
			$kata = 'ID-'.$getDate.'-'.$getTime.'-'.sprintf("%04d", $jumlah);
		}
		
		return $kata;

	}
	
	public function get_data_prod($kondisi = array())
	{
		$option = array(
			'select' => array('count(tproduct.prod_no) as hasil'),
	    	'table' => 'tproduct',
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

	// public function fetch_data_satuan()
	// {
	// 	$select1 = array(
	// 		'select' => array('satuan',
	// 						'nm_satuan',
	// 						'unit_no',
	// 						'konversi',
	// 						'hj_satu',
	// 						'hb',
	// 						'hb_ppn',
	// 						'prod_no',
	// 						'proses_id'),
	// 		'table' => 'unit',
	// 		'where'=> array('proses_id' => $this->session->userdata('proses_id_pr'))
	// 	);

	// 	$user = $this->setting_model->commonGet($select1);

	// 	$select2 = array(
	// 		'select' => array('count(unit_no) as tot'),
	// 		'table' => 'unit',
	// 		'where'=> array('proses_id' => $this->session->userdata('proses_id_pr'))
	// 	);

	// 	$qa = $this->setting_model->commonGet($select2);

	// 	$all= 0;
	// 	if(!empty($qa)){
	// 		foreach ($qa as $tt) {
	// 			$all = $tt->tot;
	// 		}
	// 	}

	// 	$data = array();

	// 	if(!empty($user)){
	// 		foreach ($user as $row) {
	// 			$sub_array = array();
	// 			 $sub_array[] = '<div contenteditable class="update" data-id="'.$row->unit_no.'" data-column="nm_satuan">' . $row->nm_satuan . '</div>';
	// 			 $sub_array[] = '<div contenteditable class="update" data-id="'.$row->unit_no.'" data-column="konversi">' . $row->konversi . '</div>';
	// 			 $sub_array[] = '<div contenteditable class="update" data-id="'.$row->unit_no.'" data-column="hb">' . $row->hb . '</div>';
	// 			 $sub_array[] = '<div contenteditable class="update" data-id="'.$row->unit_no.'" data-column="hb_ppn">' . $row->hb_ppn . '</div>';
	// 			 $sub_array[] = '<div contenteditable class="update" data-id="'.$row->unit_no.'" data-column="hj_satu">' . $row->hj_satu . '</div>';
	// 			 $sub_array[] = '<a class="delete" name="delete" id="'.$row->unit_no.'" href="" style="margin-right:15px;"><i class="fa fa-times"></i></a>';
	// 			 $data[] = $sub_array;
	// 		}
	// 	}
		

	// 	$output = array(
	// 	 "recordsTotal"  =>  $all,
	// 	 "recordsFiltered" => $all,
	// 	 "data"    => $data
	// 	);

	// 	echo json_encode($output);
	// }
	public function fetch_data_satuan()
	{
		$data_json = file_get_contents('./temp_data.json');

        $data = array();
        $dtotp = array();
        $proses_id = 0 ;
        $proses_id = $this->session->userdata('proses_id_pr');
        // $data['json_arr'] = json_decode($data_json, true);
        $json_arr = json_decode($data_json, true);

        $all= '';

        foreach ($json_arr['satuan'] as &$key) {
        	if($key['proses_id'] == ((int)$proses_id)){
				foreach ($key['unit'] as &$val) {
					$sub_array = array();
					$sub_array[] = '<div contenteditable class="update" id="data1-'.$key['id'].'" data-id="'.$key['id'].'" data-column="nm_satuan" data-value="' . $val['nm_satuan'] . '">' . $val['nm_satuan'] . '</div>';
					$sub_array[] = '<div contenteditable class="update" id="data2-'.$key['id'].'" data-id="'.$key['id'].'" data-column="konversi" data-value="' . $val['konversi'] . '">' . $val['konversi'] . '</div>';
					$sub_array[] = '<div contenteditable class="update text-right" id="data3-'.$key['id'].'" data-id="'.$key['id'].'" data-column="hj_satu" data-value="' . $val['hj_satu'] . '">' . $val['hj_satu'] . '</div>';
					$sub_array[] = '<div contenteditable class="update text-right" id="data4-'.$key['id'].'" data-id="'.$key['id'].'" data-column="hj_dua" data-value="' . $val['hj_dua'] . '">' . $val['hj_dua'] . '</div>';
					$sub_array[] = '<div contenteditable class="update text-right" id="data5-'.$key['id'].'" data-id="'.$key['id'].'" data-column="hj_tiga" data-value="' . $val['hj_tiga'] . '">' . $val['hj_tiga'] . '</div>';
					$sub_array[] = '<a class="delete" name="delete" id="'.$key['id'].'" href="" style="margin-right:15px;"><i class="fa fa-times"></i></a>';
					$dtotp[] = $sub_array;
				}

				$all = count(array($key['proses_id']));
			}
		}

		$output = array(
		 "recordsTotal"  =>  $all,
		 "recordsFiltered" => $all,
		 "data"    => $dtotp
		);

		echo json_encode($output);
	}
	public function uploadImage()
    {
        $post = $this->input->post();
        
        $this->transaction_model->insertImage($post);
    }
	public function update_satuan_barang($id_brg)
	{
		// $id = $this->input->post('id');
	 //    $value = $this->input->post('value');
	 //    $kolom = $this->input->post('column_name');

	 //    $update = array(
		// 		'update' => array(
		// 			$kolom => $value),
		// 		'table' => 'unit',
		// 		'where' => array('unit_no' => $id)
		// );
  //   	$this->setting_model->commonUpdate($update);


	 //    echo 'Data Updated';
		$sat = '';
		$proses_id = 0;
        $proses_id = (int)$this->session->userdata('proses_id_pr');
        $date = date('Y-m-d H:i:s');
		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		$satuan = 0;
		foreach ($json_arr['satuan'] as &$key) {
		    if (($key['proses_id']) == ((int)$proses_id)) {
		    	foreach ($key['unit'] as &$val) {
		    		if(($val['prod_no'] === '') AND ($val['unit_no']==='')){	
				    	$unit_id = $this->GetNoIDField('unit_no','unit');
			    		$satuan = $satuan+1;
						$insert = array(
							'insert' => array('unit_no' => $unit_id,
											'prod_no' => $id_brg,
											'satuan' => $satuan,
											'nm_satuan' => $val['nm_satuan'],
											'konversi' => $val['konversi'],
											'hj_satu' => $val['hj_satu'],
											'hj_dua' => $val['hj_dua'],
											'hj_tiga' => $val['hj_tiga'],
											'Upload_date' => $date),
							'table' => 'unit'
						);
						
						$this->setting_model->commonInsert($insert);
		    		}else{
		    			$update = array(
							'update' => array('nm_satuan' => $val['nm_satuan'],
											'konversi' => $val['konversi'],
											'hj_satu' => $val['hj_satu'],
											'hj_dua' => $val['hj_dua'],
											'hj_tiga' => $val['hj_tiga'],
											'Upload_date' => $date),
							'table' => 'unit',
							'where' => array('unit.prod_no' => $val['prod_no'], 
		    					'unit.unit_no' => $val['unit_no'])
						);
						$this->setting_model->commonUpdate($update);
		    		}
			    }

		    }
		}
		$this->delete_all_satuan($proses_id);

		$sat = 0;
		$sc1 = array(
			'select' => array('unit.unit_no',
									'unit.prod_no',
									'unit.satuan',
									'unit.konversi',
									'unit.nm_satuan',
									'unit.hj_satu',
									'unit.hj_dua',
									'unit.hj_tiga',
									'unit.hb',
									'unit.hb_ppn'),
	    	'table' => 'unit',
	    	'where' => array('unit.prod_no' => $id_brg)
	    );

		$unit_prod = $this->setting_model->commonGet($sc1);

		if (is_array($unit_prod) || is_object($unit_prod)){
		    foreach($unit_prod as $d_unit) {
		    	$sat = $d_unit->satuan;
		    	$kon = $d_unit->konversi;
		    	$nms = $d_unit->nm_satuan;
		    	$hjs = $d_unit->hj_satu;
		    	$hbb = $d_unit->hb;
		    	$hbp = $d_unit->hb_ppn;
		    	if($sat == 1){
		    		$update = array(
							'update' => array(
								'prod_uom' => $nms,
								'prod_sell_price' => $hjs,
								'konversi1' => $kon,
								'satuan_jual' => $sat,
								'satuan_beli' => $sat),
							'table' => 'tproduct',
							'where' => array(
								'tproduct.prod_no' => $id_brg
							)
					);
		        	$this->setting_model->commonUpdate($update);
				}
				if ($sat == 2) {
					$update = array(
							'update' => array(
								'prod_uom2' => $nms,
								'prod_sell_price2' => $hjs,
								'konversi2' => $kon),
							'table' => 'tproduct',
							'where' => array(
								'tproduct.prod_no' => $id_brg
							)
					);
		        	$this->setting_model->commonUpdate($update);
				}
				if ($sat == 3) {
					$update = array(
							'update' => array(
								'prod_uom3' => $nms,
								'prod_sell_price3' => $hjs,
								'konversi3' => $kon),
							'table' => 'tproduct',
							'where' => array(
								'tproduct.prod_no' => $id_brg
							)
					);
		        	$this->setting_model->commonUpdate($update);
				}
		    }
		}

	}

	public function update_satuan_test($id_brg)
	{
		$sat = '';
		$proses_id = 1;
        
        $date = date('Y-m-d H:i:s');
		$data_json = file_get_contents('./temp_data.json');

		$json_arr = json_decode($data_json, true);
		$satuan = 0;
		foreach ($json_arr['satuan'] as &$key) {
		    if (($key['proses_id']) == ((int)$proses_id)) {
		    	foreach ($key['unit'] as &$val) {
		    		if(($val['prod_no'] === '') AND ($val['unit_no']==='')){	
			    		echo "new";

				    	$unit_id = $this->GetNoIDField('unit_no','unit');
			    		$satuan = $satuan+1;
						$insert = array(
							'insert' => array('unit_no' => $unit_id,
											'prod_no' => $id_brg,
											'satuan' => $satuan,
											'nm_satuan' => $val['nm_satuan'],
											'konversi' => $val['konversi'],
											'hj_satu' => $val['hj_satu'],
											'hj_dua' => $val['hj_dua'],
											'hj_tiga' => $val['hj_tiga'],
											'Upload_date' => $date),
							'table' => 'unit'
						);
						
						$this->setting_model->commonInsert($insert);
		    		}else{
		    			echo "edit";
		    			
		    			$update = array(
							'update' => array('nm_satuan' => $val['nm_satuan'],
											'konversi' => $val['konversi'],
											'hj_satu' => $val['hj_satu'],
											'hj_dua' => $val['hj_dua'],
											'hj_tiga' => $val['hj_tiga'],
											'Upload_date' => $date),
							'table' => 'unit',
							'where' => array('unit.prod_no' => $val['prod_no'], 
		    					'unit.unit_no' => $val['unit_no'])
						);
						$this->setting_model->commonUpdate($update);
		    		}


		   
			    }

		    }
		}

	}

	public function get_qty_stok()
	{
		$id_prod = $this->input->post('id_prod');

		$gud_no = '';
		$qty = 0;

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

		$selstok = array(
			'select' => array('id', 'prod_no', 'gud_no', 'prod_on_hand'),
	    	'table' => 'tdgproduct',
	    	'where' => array('prod_no' => $id_prod, 'gud_no' => $gud_no)
	    );

		$stok = $this->setting_model->commonGet($selstok);

		if (is_array($stok) || is_object($stok)) {
			foreach ($stok as $ks) {
				$qty = $ks->prod_on_hand;
			}
		}

		echo json_encode(array(
			"stok" => $qty
		));
	}

	public function get_qty_uom()
	{
		$select_data = [];

		$id_prod = $this->input->post('id_prod');

		$seluom = array(
			'select' => array('unit_no', 'satuan', 'konversi', 'nm_satuan'),
	    	'table' => 'unit',
	    	'where' => array('prod_no' => $id_prod)
	    );

		$uom = $this->setting_model->commonGet($seluom);

		if (is_array($uom) || is_object($uom)) {
			foreach ($uom as $ku) {
				$select_data[] = array(
                	'value' => $ku->konversi,
                	'text' => $ku->nm_satuan
            	);
			}
		}

		echo json_encode($select_data);
	}

	public function insert_stok_barang()
	{
		$gud_no = '';
		$prod_no = $this->input->post('id_prod');
		$qty = $this->input->post('qty');

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

		$selstok = array(
			'select' => array('id', 'prod_no', 'gud_no', 'prod_on_hand'),
	    	'table' => 'tdgproduct',
	    	'where' => array('prod_no' => $prod_no, 'gud_no' => $gud_no)
	    );

		$stok = $this->setting_model->commonGet($selstok);

		if (is_array($stok) || is_object($stok)) {
			foreach ($stok as $ks) {
				$update = array(
					'update' => array('prod_on_hand' => $qty),
					'table' => 'tdgproduct',
					'where' => array('prod_no' => $ks->prod_no, 
						'gud_no' => $ks->gud_no)
				);
				$this->setting_model->commonUpdate($update);
			}
		}else{
			$prod_id = $this->setting_model->GetNoIDField2("id", "tdgproduct");

			$is_prod = $this->check_id_field("id", "tdgproduct",$prod_id);

			$prod_id = $is_prod;

			$insert = array(
				'insert' => array(
					'id' => $prod_id,
					'prod_no' => $prod_no,
					'gud_no' => $gud_no,
					'prod_on_hand' => $qty
				),
				'table' => 'tdgproduct'
			);

        	$this->setting_model->commonInsert($insert);
		}

		$up_prod = array(
			'update' => array('prod_on_hand' => $qty),
			'table' => 'tproduct',
			'where' => array('prod_no' => $prod_no)
		);
		$this->setting_model->commonUpdate($up_prod);

		echo json_encode(array(
			"statusCode"=>202
		));
	}

	public function cek_unit_satuan($tableData)
	{

		$is_ok = 0;
		$proses_id = 0;
        $proses_id = (int)$this->session->userdata('proses_id_pr');
        $date = date('Y-m-d H:i:s');

		$posts = array();

	    $fp = file_get_contents('./temp_data.json');
	    $posts = json_decode($fp, true);

		if(is_array($tableData)){
			foreach ($tableData as $data) {
				$id = $data['id'];
				$nm_satuan = $data['nm_satuan'];
				$konversi = $data['konversi'];
				$hj_satu = $data['hj_satu'];
				$hj_dua = $data['hj_dua'];
				$hj_tiga = $data['hj_tiga'];

				if($nm_satuan <> '' AND $konversi <> 0){
					foreach ($posts['satuan'] as &$key) {
				    	if (($key['id']) == ((int)$id) && ($key['proses_id'] == (int)$proses_id) ) {
				    		foreach ($key['unit'] as &$val) {
				    			$val['nm_satuan'] = $nm_satuan;
				    			$val['konversi'] = $konversi;
				    			$val['hj_satu'] = $hj_satu;
				    			$val['hj_dua'] = $hj_dua;
				    			$val['hj_tiga'] = $hj_tiga;
				    		}
				    	}
				    }
				}
			}
		}

		$jbody = json_encode($posts);
		file_put_contents('./temp_data.json', $jbody);

		$json = file_get_contents('./temp_data.json');
	    $json_data = json_decode($json, true);

		foreach ($json_data['satuan'] as &$key1) {
	    	if ($key1['proses_id'] == (int)$proses_id) {
	    		foreach ($key1['unit'] as &$val1) {
	    			if($val1['nm_satuan'] <> '' AND $val1['konversi'] == 0){
	    				$is_ok = $is_ok+1;
	    			}elseif ($val1['nm_satuan'] == '' AND $val1['konversi'] <> 0) {
	    				$is_ok = $is_ok+1;
	    			}
	    		}
	    	}
	    }

		return $is_ok;
		
	}

	public function cek_unit_satuan_json()
	{
		$tableData = $this->input->post('tableData');
		$is_ok = 0;
		$proses_id = 0;
        $proses_id = (int)$this->session->userdata('proses_id_pr');
        $date = date('Y-m-d H:i:s');
		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		if(is_array($tableData)){
			foreach ($tableData as $data) {
				$id = $data['id'];
				$nm_satuan = $data['nm_satuan'];
				$konversi = $data['konversi'];
				$hj_satu = $data['hj_satu'];
				$hj_dua = $data['hj_dua'];
				$hj_tiga = $data['hj_tiga'];

				if($nm_satuan == '' || ($konversi == 0 || $konversi == '')){
					
				}elseif ($nm_satuan <> '' && ($konversi == 0 || $konversi == '')) {
					$is_ok = $is_ok+1;
				}elseif ($nm_satuan == '' && ($konversi <> 0 || $konversi <> '')) {
					$is_ok = $is_ok+1;
				}
			}
		}

		// foreach ($json_arr['satuan'] as &$key) {
		//     if (($key['proses_id']) == ((int)$proses_id)) {
		//     	foreach ($key['unit'] as &$val) {
		//     		if($val['nm_satuan'] == '' || $val['konversi'] == 0 || $val['konversi'] == ''){
		//     			$is_ok = $is_ok+1;
		//     		}
		// 	    }

		//     }
		// }

		echo json_encode(array("hasil" => $is_ok));
		
	}

	public function delete_satuan_update($id_brg)
	{
		$delete = array(
			'table' => 'unit',
			'where' => array('prod_no' => $id_brg)
		);

		$del = $this->setting_model->commonDelete($delete);

		if($del['message'] != ''){
			return 0;
		}else{
			return 1;
		}
	}
	public function insert_satuan_barang($id_brg)
	{	
		$sat = '';
		$proses_id = 0;
        $proses_id = (int)$this->session->userdata('proses_id_pr');
        $date = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata('person_id');
		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);
		// encode array to json and save to file
		$satuan = 0;
		foreach ($json_arr['satuan'] as &$key) {
		    if (($key['proses_id']) == ((int)$proses_id)) {
		    	foreach ($key['unit'] as &$val) {
		    		if($val['nm_satuan'] <> '' AND $val['konversi'] <> 0){
		    			$unit_id = $this->GetNoIDField('unit_no','unit');
			    		$satuan = $satuan+1;
						$insert = array(
							'insert' => array('unit_no' => $unit_id,
											'prod_no' => $id_brg,
											'satuan' => $satuan,
											'nm_satuan' => $val['nm_satuan'],
											'konversi' => $val['konversi'],
											'hj_satu' => $val['hj_satu'],
											'hj_dua' => $val['hj_dua'],
											'hj_tiga' => $val['hj_tiga'],
											'Upload_date' => $date),
							'table' => 'unit'
						);
						$this->setting_model->commonInsert($insert);
		    		}
			    }
		    }
		}
		$this->delete_all_satuan($proses_id);

		$sat = 0;
		$sc1 = array(
			'select' => array('unit.unit_no',
									'unit.prod_no',
									'unit.satuan',
									'unit.konversi',
									'unit.nm_satuan',
									'unit.hj_satu',
									'unit.hj_dua',
									'unit.hj_tiga',
									'unit.hb',
									'unit.hb_ppn'),
	    	'table' => 'unit',
	    	'where' => array('unit.prod_no' => $id_brg),
	    	'order' => array('unit.satuan'=> 'ASC')
	    );

		$unit_prod = $this->setting_model->commonGet($sc1);

		$i = 1;
		if (is_array($unit_prod) || is_object($unit_prod)){
			foreach ($unit_prod as $ku) {
				$sat = $ku->satuan;
		    	$kon = $ku->konversi;
		    	$nms = $ku->nm_satuan;
		    	$hj_satu = $ku->hj_satu;
				$hj_dua = $ku->hj_dua;
				$hj_tiga = $ku->hj_tiga;
		    	$hbb = $ku->hb;
		    	$hbp = $ku->hb_ppn;

				switch ($i) {
					case 1:
						$updateData = array(
							'update' => array(
								'prod_uom' => $nms,
								'konversi1' => $kon,
								'satuan_jual' => $sat,
								'satuan_beli' => $sat,
					            'prod_sell_price' => $hj_satu,
					            'prod_sell_price2' => $hj_dua,
					            'prod_sell_price3' => $hj_tiga
							),
							'table' => 'tproduct',
							'where' => array(
								'tproduct.prod_no' => $id_brg
							)
				        );
				        $this->setting_model->commonUpdate($updateData);

						break;
					case 2:
						$updateData = array(
							'update' => array(
								'prod_uom2' => $nms,
								'konversi2' => $kon,
					            'prod_sell_price4' => $hj_satu,
					            'prod_sell_price5' => $hj_dua,
					            'prod_sell_price6' => $hj_tiga
							),
							'table' => 'tproduct',
							'where' => array(
								'tproduct.prod_no' => $id_brg
							)
				        );
				        $this->setting_model->commonUpdate($updateData);

						break;
					case 3:
						$updateData = array(
							'update' => array(
								'prod_uom3' => $nms,
								'konversi3' => $kon,
					            'prod_sell_price7' => $hj_satu,
					            'prod_sell_price8' => $hj_dua,
					            'prod_sell_price9' => $hj_tiga
							),
							'table' => 'tproduct',
							'where' => array(
								'tproduct.prod_no' => $id_brg
							)
				        );
				        $this->setting_model->commonUpdate($updateData);

						break;
				}

				switch ($i) {
				    case 1:
				        $where = array('this_harga.prod_no' => $id_brg,
				    					'harga' => $hj_satu);
				        break;
				    case 2:
				        $where = array('this_harga.prod_no' => $id_brg,
				    					'harga2' => $hj_dua);
				        break;
				    case 3:
				        $where = array('this_harga.prod_no' => $id_brg,
				    					'harga3' => $hj_tiga);
				        break;
				}

				$option2 = array(
					'select' => array('*'),
			    	'table' => 'this_harga ',
			    	'where'	=> $where
			    );

				$selhis = $this->setting_model->commonGet($option2);

				if (!is_array($selhis) || !is_object($selhis)){
					$insert = array(
						'insert' => array(
							'iUpload' => 1,
					        'prod_no' => $id_brg,
					        'harga' => $hj_satu,
					        'tgl' => date('Y-m-d H:i:s'),
					        'user_id' => $user_id,
					        'satuan' => $i,
					        'harga2' => $hj_dua,
					        'harga3' => $hj_tiga
						),
						'table' => 'this_harga'
					);

		        	$this->setting_model->commonInsert($insert);
				}
				
				$i++;
			}
		}	
	}
	public function delete_img()
	{
		$id_brg = $this->input->post('id_brg');

		$select = array(
				'select' => array('count(id)'),
				'table' => 'timg_product',
				'where' => array('prod_no' => $id_brg)
		);

		$sel = $this->setting_model->commonGet($select);

		if(is_array($sel) || is_object($sel)){
			$delete = array(
				'table' => 'timg_product',
				'where' => array('prod_no' => $id_brg)
			);

	  		$this->setting_model->commonDelete($delete);
		}
		
	}
	public function delete_satuan_barang($id = "")
	{
		if($id == ''){
			$id = $this->input->post('id');
		}
		// get array index to delete
		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// get array index to delete
		foreach($json_arr['satuan'] as $subKey => $subArray){
          if($subArray['id'] == $id){
               unset($json_arr['satuan'][$subKey]);
          }
     	}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		file_put_contents('./temp_data.json', $json_body);
	}

	public function update_satuan_brg()
	{
		$id = $this->input->post('id');
		$column = $this->input->post('column');
	    $vl = $this->input->post('value');

	   	$proses_id = 0 ;
        $proses_id = (int)$this->session->userdata('proses_id_pr');
		// read file
		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// $update = array($column => $value);
		// $id_unit = array('id' => $id);

		// encode array to json and save to file
		foreach ($json_arr['satuan'] as &$key) {
		    if (($key['id']) == ((int)$id)) {
		    	foreach ($key['unit'] as &$val) {
		    		$val[$column] = $vl;
			    }
		    }
		}

		$json_body = json_encode($json_arr);
		file_put_contents('./temp_data.json', $json_body);
		
	}
	public function delete_all_satuan($pr_id = '')
	{
		
		// $proses_id = $this->input->post('proses_id');
		// if($proses_id <> 0 OR $prose_id <> ''){
		// 	$delete = array(
		// 		'table' => 'unit',
		// 		'where' => array('proses_id' => $proses_id)
		// 	);
		// 	$this->setting_model->commonDelete($delete);
		// }

		// $pr_id = $this->session->userdata('proses_id_pr');
		if($pr_id == ''){
			$pr_id = $this->session->userdata('proses_id_pr');
		}
		// get array index to delete
		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		// get array index to delete
		foreach($json_arr['satuan'] as $subKey => $subArray){
          if($subArray['proses_id'] == $pr_id){
               unset($json_arr['satuan'][$subKey]);
          }
     	}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		file_put_contents('./temp_data.json', $json_body);

	 	//	$delete = array(
		// 		'table' => 'unit',
		// 		'where' => array('unit_no' => $id)
		// 	);
  		//  $this->setting_model->commonDelete($delete);

	}
	public function ProcessId()
	{


		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$word = 0;

		foreach ($json_arr['satuan'] as $key) {
			$word = max($word, $key['proses_id']);
		}

		$maks = $word+1;
		$this->session->unset_userdata('proses_id_pr');
		$this->session->set_userdata('proses_id_pr',$maks);

		$proses_id = $this->session->userdata('proses_id_pr');

    	echo json_encode(array(
			"proses_id"=>$proses_id
		));
	}
	//tab margin
	public function list_margin($keyword = '',$is_archive = '', $group_id = '', $kat_id= '',$sts1 = '')
	{
		$now = date('Y-m-d H:i:s');
		if($is_archive <> ''){
			if($is_archive <> 'false'){
				$is_archive = array(1,0);
			}else{
				$is_archive = array(0);
			}
		}else{
			$is_archive = array(0);
		}

		$sts = (int)$sts1;

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tproduct.prod_code0' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_code1' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tproduct.prod_name1' => $keyword);
		}

		$where = array();

		if($sts <> 0){
			$where['tproduct.is_stok'] = $sts-1;
		}

		if($kat_id == 0){

		}else{
			$where['tproduct.cat_id'] = $kat_id;
		}

		if($group_id == 0){

		}else{
			$where['tproduct.group_id'] = $group_id;
		}

		$option1 = array(
			'select' => array(
								'tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.cat_id',
								'tproduct.group_id',
								'tcat.nama as nama_kat',
								'tgroup.nama as nama_group',
								'concat(if(tproduct.prod_on_hand <> "",tproduct.prod_on_hand, 0), " ",tproduct.prod_uom) as stok',
								'tproduct.prod_sell_price as harga_baru',
								'xb.harga as harga_lama'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'(select xx.prod_no, xx.tgl, xx.harga from this_harga xx
	    						where xx.tgl < "'.$now.'" AND xx.satuan = 1
	    						order by tgl desc limit 1) xb' => 'tproduct.prod_no = xb.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
	    $option2 = array(
			'select' => array('count(tproduct.prod_no) as total'),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'(select xx.prod_no, xx.tgl, xx.harga from this_harga xx
	    						where xx.tgl < "'.$now.'" AND xx.satuan = 1
	    						order by tgl desc limit 1) xb' => 'tproduct.prod_no = xb.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
		
		$data = array();
		$data['grp'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);
		$this->load->view('admin/demo/products_margin',$data);
	}
	
	//show list product modal with checkbox
	public function show_list()
	{
		$key = $this->input->post();

		$search = $key['searchField'];
		$tipe = $key['prodType'];

		if($tipe == 0){
			$type = array(0,1);
		}else{
			$type = array($tipe-1);
		}

		if($search == 'none' OR $search == ''){
			$like = '';
			$or_like = '';
		}else{
			$like = array('tproduct.prod_code0' => $search);
			$or_like = array('tproduct.prod_name0' => $search,
								'tproduct.prod_code1' => $search,
								'tproduct.prod_name0' => $search,
								'tproduct.prod_name1' => $search,
								'tcat.nama' => $search);
		}

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

			$where = array('tdgproduct.gud_no' => $gud_no);
		}

		$option1 = array(
			'select' => array(
								'tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.cat_id',
								'tproduct.group_id',
								'tcat.nama as nama_kat',
								'tgroup.nama as nama_group',
								'concat(tdgproduct.prod_on_hand, " ",tproduct.prod_uom) as stok',
								'format(if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price),2) as prod_buy_price2',
								'format(((tproduct.prod_sell_price - if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) / if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) * 100, 2) as prod_buy_persen2',
								'format(tproduct.prod_last_ppn,2) as prod_last_ppn2',
								'format((((tproduct.prod_sell_price - tproduct.prod_last_ppn) / tproduct.prod_last_ppn)) * 100,2) as prod_ppn_persen2',
								'tproduct.prod_sell_price',
								'tdgproduct.gud_no'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no'),
	    	'where' => $where,
	    	'where_in' => array(
							'tproduct.is_delete' => 0,
							'tproduct.is_stok' => $type
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
	    $option2 = array(
			'select' => array('count(tproduct.prod_no) as total'),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no'),
	    	'where' => $where,
	    	'where_in' => array(
							'tproduct.is_delete' => 0,
							'tproduct.is_stok' => $type
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
		
		$data = array();
		$data['grp'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);
		$this->load->view('admin/demo/ecommerce_product_list',$data);
	}

	//show list product modal without checkbox
	public function show_list_single()
	{ 
		$key = $this->input->post();

		$search = $key['searchField'];
		$tipe = $key['prodType'];

		if($tipe == 0){
			$type = array(0,1);
		}else{
			$type = array($tipe-1);
		}

		if($search == 'none' OR $search == ''){
			$like = '';
			$or_like = '';
		}else{
			$like = array('tproduct.prod_code0' => $search);
			$or_like = array('tproduct.prod_name0' => $search,
								'tproduct.prod_code1' => $search,
								'tproduct.prod_name0' => $search,
								'tproduct.prod_name1' => $search,
								'tcat.nama' => $search);
		}

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

			$where = array('tdgproduct.gud_no' => $gud_no);
		}

		$option1 = array(
			'select' => array(
								'tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.cat_id',
								'tproduct.group_id',
								'tcat.nama as nama_kat',
								'tgroup.nama as nama_group',
								'concat(tdgproduct.prod_on_hand, " ",tproduct.prod_uom) as stok',
								'format(if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price),2) as prod_buy_price2',
								'format(((tproduct.prod_sell_price - if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) / if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) * 100, 2) as prod_buy_persen2',
								'format(tproduct.prod_last_ppn,2) as prod_last_ppn2',
								'format((((tproduct.prod_sell_price - tproduct.prod_last_ppn) / tproduct.prod_last_ppn)) * 100,2) as prod_ppn_persen2',
								'tproduct.prod_sell_price',
								'tdgproduct.gud_no'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no'),
	    	'where' => $where,
	    	'where_in' => array(
							'tproduct.is_delete' => 0,
							'tproduct.is_stok' => $type
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
	    $option2 = array(
			'select' => array('count(tproduct.prod_no) as total'),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no'),
	    	'where' => $where,
	    	'where_in' => array(
							'tproduct.is_delete' => 0,
							'tproduct.is_stok' => $type
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
		
		$data = array();
		$data['grp'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);
		$this->load->view('admin/demo/ecommerce_product_list_single',$data);
	}

	public function show_list_single_bb()
	{
		$key = $this->input->post('searchField');

		$search = $key;

		if($search == 'none' OR $search == ''){
			$like = '';
			$or_like = '';
		}else{
			$like = array('tset_bb.keterangan' => $search);
			$or_like = array('tproduct.prod_name0' => $search,
								'tproduct.prod_name0' => $search);
		}

		$option1 = array(
			'select' => array(
								'tset_bb.tgl',
								'tset_bb.bb_no',
								'concat(tproduct.prod_code0, " ", tproduct.prod_name0) as prod_name0',
								'tset_bb.keterangan',
								'tset_bb.is_pakai'
							),
	    	'table' => 'tset_bb',
	    	'join' => array('tproduct' => 'tproduct.prod_no = tset_bb.prod_no'),
	    	'where' => array('tset_bb.is_delete' => 0),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tset_bb.bb_no' => 'ASC')
	    );

	    $option2 = array(
			'select' => array('count(tset_bb.bb_no) as total'),
	    	'table' => 'tset_bb',
	    	'join' => array('tproduct' => 'tproduct.prod_no = tset_bb.prod_no'),
	    	'where' => array('tset_bb.is_delete' => 0),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tset_bb.bb_no' => 'ASC')
	    );
		
		$data = array();
		$data['grp'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);
		$this->load->view('admin/demo/ecommerce_product_list_single_bb',$data);
	}

	public function get_id_proses()
	{
		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$maak = 0;

		foreach ($json_arr['satuan'] as $key) {
			$maak = max($maak, $key['proses_id']);
		}

		$maak = $maak+1;

		$this->session->unset_userdata('proses_id_pr');
		$this->session->set_userdata('proses_id_pr',$maak);

		$proses_id = $this->session->userdata('proses_id_pr');

    	return $proses_id;
	}
	public function get_id_json()
	{
		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$maak = 0;

		foreach ($json_arr['satuan'] as $key) {
			$maak = max($maak, $key['id']);
		}

    	return $maak;
	}
	public function add_satuan()
	{
		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./temp_data.json');
	    $posts = json_decode($fp, true);

	    $nm_satuan = $this->input->post('nm_satuan');
	    $konversi = (int)$this->input->post('konversi');
	    $hj_satu = (float)$this->input->post('hj');
	    $hj_dua = (float)$this->input->post('hj_dua');
	    $hj_tiga = (float)$this->input->post('hj_tiga');
	    $proses_id = (int)$this->session->userdata('proses_id_pr');
	
	    $max = $this->get_id_json();
	    $id = $max + 1;

		$all = array();
		// $response = array();
	    $post = array();

	    
    	$dsn[] = array(
	        	"konversi" => $konversi,
	        	"nm_satuan" => $nm_satuan,
		        "hj_satu" => $hj_satu,
		        "hj_dua" => $hj_dua,
		        "hj_tiga" => $hj_tiga,
		        "prod_no" => '',
		        "unit_no" => ''

    	);
	    //If the json is correct, you can then write the file and load the view
		for($a = 0; $a < 3; $a++){
		    $post = array(
		    	"id"    => $id++,
				"proses_id" => $proses_id,
				"is_edit" => 0,
		        "unit"   => $dsn
		    );

		    array_push($posts['satuan'],$post);
		}
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./temp_data.json', $json_body);

	    if ( ! write_file('./temp_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan temp_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./temp_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }
	}

	public function add_satuan_single()
	{
		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./temp_data.json');
	    $posts = json_decode($fp, true);

	    $nm_satuan = $this->input->post('nm_satuan');
	    $konversi = (int)$this->input->post('konversi');
	    $hj_satu = (float)$this->input->post('hj');
	    $hj_dua = (float)$this->input->post('hj_dua');
	    $hj_tiga = (float)$this->input->post('hj_tiga');
	   	
	   	$proses_id = (int)$this->session->userdata('proses_id_pr');

	    $max = $this->get_id_json();
	    $id = $max + 1;

		$all = array();

	    $post = array();

	    
    	$dsn[] = array(
	        	"konversi" => $konversi,
	        	"nm_satuan" => $nm_satuan,
		        "hj_satu" => $hj_satu,
		        "hj_dua" => $hj_dua,
		        "hj_tiga" => $hj_tiga,
		        "prod_no" => '',
		        "unit_no" => ''

    	);
	    //If the json is correct, you can then write the file and load the view
	    $post = array(
	    	"id"    => $id,
			"proses_id" => $proses_id,
			"is_edit" => 0,
	        "unit"   => $dsn
	    );

	    array_push($posts['satuan'],$post);
	 
	    $json_body = json_encode($posts);

	    file_put_contents('./temp_data.json', $json_body);

	    if ( ! write_file('./temp_data.json', $json_body)){
	        echo "<script>
						alert('Gagal menambahkan temp_data!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./temp_data.json');
			// decode json to associative array
			$json_arr = json_decode($data_json, true);
			$json_body = json_encode($json_arr);
			// print_r($json_body);
	    }
	}

	public function add_satuan_ml()
	{
		$proses_id = (int)$this->session->userdata('proses_id_pr');
		$tableData = $this->input->post('tableData');

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./temp_data.json');
	    $posts = json_decode($fp, true);

		if(is_array($tableData)){
			foreach ($tableData as $data) {
				$id = $data['id'];
				$nm_satuan = $data['nm_satuan'];
				$konversi = $data['konversi'];
				$hj_satu = $data['hj_satu'];
				$hj_dua = $data['hj_dua'];
				$hj_tiga = $data['hj_tiga'];

				if($nm_satuan <> '' AND ($konversi <> 0 OR $konversi <> '')){
					foreach ($posts['satuan'] as &$key) {
				    	if (($key['id']) == ((int)$id) && ($key['proses_id'] == (int)$proses_id) ) {
				    		foreach ($key['unit'] as &$val) {
				    			$val['nm_satuan'] = $nm_satuan;
				    			$val['konversi'] = $konversi;
				    			$val['hj_satu'] = $hj_satu;
				    			$val['hj_dua'] = $hj_dua;
				    			$val['hj_tiga'] = $hj_tiga;
				    		}
				    	}
				    }
				}
			}
		}

		$json_body = json_encode($posts);
		file_put_contents('./temp_data.json', $json_body);
		
	}
	public function show_satuan_all()
	{
		$data_json = file_get_contents('./temp_data.json');
		// decode json to associative array
		$json_arr = json_decode($data_json, true);

		$id = 1;
		
		$column = "nm_satuan";
		$vl = "pcs";

		// encode array to json and save to file
		foreach ($json_arr['satuan'] as &$key) {
		    if (($key['id']) == ((int)$id)) {
		    	foreach ($key['unit'] as &$val) {
		    		$val[$column] = $vl;
			    }
		    }
		}
		$json_body = json_encode($json_arr);
		file_put_contents('./temp_data.json', $json_body);

        foreach($json_arr['satuan'] as &$key) { 
        	if (((int)$key['id']) == ((int)1)) {
		    	foreach ($key['unit'] as &$val) {
		    		echo $val['nm_satuan'];
			    }
		    }
        }
	}

	public function test_update_margin()
	{
		$id_brg = array('ID-230329-044108-0001');
		$margin_per = '';
		$margin_rep = '5000';
		$user_id = '148';

		$date = date('Y-m-d H:i:s');

		foreach($id_brg as $id){
			$option = array(
				'select' => array('unit_no', 
									'prod_no', 
									'satuan', 
									'konversi', 
									'catatan', 
									'nm_satuan',  
									'hj_satu', 
									'hj_dua', 
									'hj_tiga'
								),
		    	'table' => 'unit',
		    	'where'	=>array('unit.prod_no' => $id)
		    );

			$unit= $this->setting_model->commonGet($option);

			$i = 1;
			if (is_array($unit) || is_object($unit)){
				foreach ($unit as $ku) {
					$hj_1 = $ku->hj_satu;
					$hj_2 = $ku->hj_dua;
					$hj_3 = $ku->hj_tiga;
					
					if($margin_per <> ''){
						$hj_satu = ($hj_1 <> 0 ? ($hj_1 + (($margin_per / 100) * $hj_1)) :0);
						$hj_dua = ($hj_2 <> 0 ? ($hj_2 + (($margin_per / 100) * $hj_2)) :0);
						$hj_tiga = ($hj_3 <> 0 ? ($hj_3 + (($margin_per / 100) * $hj_3)) :0);
					}else if ($margin_rep <> '') {
			        	$hj_satu = ($hj_1 <> 0 ? ($hj_1 + $margin_rep) :$margin_rep);
						$hj_dua = ($hj_2 <> 0 ? ($hj_2 + $margin_rep) :$margin_rep);
						$hj_tiga = ($hj_3 <> 0 ? ($hj_3 + $margin_rep) :$margin_rep);
					}

					$update = array(
						'update' => array(
							'hj_satu' => $hj_satu,
							'hj_dua' => $hj_dua,
							'hj_tiga' => $hj_tiga),
						'table' => 'unit',
						'where' => array(
							'unit.prod_no' => $id
						)
					);
		        	$this->setting_model->commonUpdate($update);

					switch ($i) {
						case 1:
							$updateData = array(
								'update' => array(
						            'prod_sell_price' => $hj_satu,
						            'prod_sell_price2' => $hj_dua,
						            'prod_sell_price3' => $hj_tiga
								),
								'table' => 'tproduct',
								'where' => array(
									'tproduct.prod_no' => $id
								)
					        );
					        $this->setting_model->commonUpdate($updateData);

							break;
						case 2:
							$updateData = array(
								'update' => array(
						            'prod_sell_price4' => $hj_satu,
						            'prod_sell_price5' => $hj_dua,
						            'prod_sell_price6' => $hj_tiga
								),
								'table' => 'tproduct',
								'where' => array(
									'tproduct.prod_no' => $id
								)
					        );
					        $this->setting_model->commonUpdate($updateData);

							break;
						case 3:
							$updateData = array(
								'update' => array(
						            'prod_sell_price7' => $hj_satu,
						            'prod_sell_price8' => $hj_dua,
						            'prod_sell_price9' => $hj_tiga
								),
								'table' => 'tproduct',
								'where' => array(
									'tproduct.prod_no' => $id
								)
					        );
					        $this->setting_model->commonUpdate($updateData);

							break;
					}

					switch ($i) {
					    case 1:
					        $where = array('this_harga.prod_no' => $id,
					    					'harga' => $hj_satu);
					        break;
					    case 2:
					        $where = array('this_harga.prod_no' => $id,
					    					'harga' => $hj_dua);
					        break;
					    case 3:
					        $where = array('this_harga.prod_no' => $id,
					    					'harga' => $hj_tiga);
					        break;
					}

					$option2 = array(
						'select' => array('*'),
				    	'table' => 'this_harga ',
				    	'where'	=> $where
				    );

					$selhis = $this->setting_model->commonGet($option2);

					if (!is_array($selhis) || !is_object($selhis)){
						$insert = array(
							'insert' => array(
								'iUpload' => 1,
						        'prod_no' => $id,
						        'harga' => $hj_satu,
						        'tgl' => date('Y-m-d H:i:s'),
						        'user_id' => $user_id,
						        'satuan' => $i,
						        'harga2' => $hj_dua,
						        'harga3' => $hj_tiga
							),
							'table' => 'this_harga'
						);

			        	$this->setting_model->commonInsert($insert);
					}
					
					$i++;
				}
			}		
	    }
	}

	public function update_margin()
	{
		$id_brg =$this->input->post('id_brg');
		$margin_per =$this->input->post('margin_per');
		$margin_rep =$this->input->post('margin_rep');
		$user_id = $this->session->userdata('person_id');

		$date = date('Y-m-d H:i:s');

		foreach($id_brg as $id){
			$option = array(
				'select' => array('unit_no', 
									'prod_no', 
									'satuan', 
									'konversi', 
									'catatan', 
									'nm_satuan',  
									'hj_satu', 
									'hj_dua', 
									'hj_tiga'
								),
		    	'table' => 'unit',
		    	'where'	=>array('unit.prod_no' => $id)
		    );

			$unit= $this->setting_model->commonGet($option);

			$i = 1;
			if (is_array($unit) || is_object($unit)){
				foreach ($unit as $ku) {
					$hj_1 = $ku->hj_satu;
					$hj_2 = $ku->hj_dua;
					$hj_3 = $ku->hj_tiga;
					
					if($margin_per <> ''){
						$hj_satu = ($hj_1 <> 0 ? ($hj_1 + (($margin_per / 100) * $hj_1)) :0);
						$hj_dua = ($hj_2 <> 0 ? ($hj_2 + (($margin_per / 100) * $hj_2)) :0);
						$hj_tiga = ($hj_3 <> 0 ? ($hj_3 + (($margin_per / 100) * $hj_3)) :0);
					}else if ($margin_rep <> '') {
			        	$hj_satu = ($hj_1 <> 0 ? ($hj_1 + $margin_rep) :$margin_rep);
						$hj_dua = ($hj_2 <> 0 ? ($hj_2 + $margin_rep) :$margin_rep);
						$hj_tiga = ($hj_3 <> 0 ? ($hj_3 + $margin_rep) :$margin_rep);
					}

					$update = array(
						'update' => array(
							'hj_satu' => $hj_satu*$ku->konversi),
						'table' => 'unit',
						'where' => array(
							'unit.prod_no' => $id
						)
					);
		        	$this->setting_model->commonUpdate($update);

					// echo json_encode(array(
					// 	"hj_satu" => $hj_satu,
					// 	"hj_dua" => $hj_dua,
					// 	"hj_tiga" => $hj_tiga,
					// ));

					switch ($i) {
						case 1:
							$updateData = array(
								'update' => array(
						            'prod_sell_price' => $hj_satu,
						            'prod_sell_price2' => $hj_dua,
						            'prod_sell_price3' => $hj_tiga
								),
								'table' => 'tproduct',
								'where' => array(
									'tproduct.prod_no' => $id
								)
					        );
					        $this->setting_model->commonUpdate($updateData);

							break;
						// case 2:
						// 	$updateData = array(
						// 		'update' => array(
						//             'prod_sell_price4' => $hj_satu,
						//             'prod_sell_price5' => $hj_dua,
						//             'prod_sell_price6' => $hj_tiga
						// 		),
						// 		'table' => 'tproduct',
						// 		'where' => array(
						// 			'tproduct.prod_no' => $id
						// 		)
					 //        );
					 //        $this->setting_model->commonUpdate($updateData);

						// 	break;
						// case 3:
						// 	$updateData = array(
						// 		'update' => array(
						//             'prod_sell_price7' => $hj_satu,
						//             'prod_sell_price8' => $hj_dua,
						//             'prod_sell_price9' => $hj_tiga
						// 		),
						// 		'table' => 'tproduct',
						// 		'where' => array(
						// 			'tproduct.prod_no' => $id
						// 		)
					 //        );
					 //        $this->setting_model->commonUpdate($updateData);

						// 	break;
					}

					switch ($i) {
					    case 1:
					        $where = array('this_harga.prod_no' => $id,
					    					'harga' => $hj_satu);
					        break;
					    // case 2:
					    //     $where = array('this_harga.prod_no' => $id,
					    // 					'harga' => $hj_dua);
					    //     break;
					    // case 3:
					    //     $where = array('this_harga.prod_no' => $id,
					    // 					'harga' => $hj_tiga);
					    //     break;
					}

					$option2 = array(
						'select' => array('*'),
				    	'table' => 'this_harga ',
				    	'where'	=> $where
				    );

					$selhis = $this->setting_model->commonGet($option2);

					if (!is_array($selhis) || !is_object($selhis)){
						$insert = array(
							'insert' => array(
								'iUpload' => 1,
						        'prod_no' => $id,
						        'harga' => $hj_satu,
						        'tgl' => date('Y-m-d H:i:s'),
						        'user_id' => $user_id,
						        'satuan' => $i,
						        'harga2' => $hj_dua,
						        'harga3' => $hj_tiga
							),
							'table' => 'this_harga'
						);

			        	$this->setting_model->commonInsert($insert);
					}
					
					$i++;
				}
			}		
	    }
		echo json_encode(array(
			"statusCode"=>202
		));
	}
	public function getProduct()
	{
		$id_prod = $this->input->post('id_prod');
		$prod_code = '';
		$prod_name = '';
		$select = array(
			'select' => array('tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_code1',
								'tproduct.prod_name0',
								'tproduct.prod_name0'),
	    	'table' => 'tproduct',
	    	'where' => array('tproduct.prod_no' => $id_prod)
	    );

		$prod = $this->setting_model->commonGet($select);

		foreach ($prod as $key) {
			$prod_code = $key->prod_code0;
			$prod_name = $key->prod_name0;
		}

		echo json_encode(array(
			"prod_no" => $id_prod,
			"prod_code" => $prod_code,
			"prod_name" => $prod_name
		));
	}

	public function getBb()
	{
		$id_bb = $this->input->post('id_bb');
		$keterangan = '';
		$select = array(
			'select' => array('tset_bb.keterangan'),
	    	'table' => 'tset_bb',
	    	'where' => array('tset_bb.bb_no' => $id_bb)
	    );

		$bb = $this->setting_model->commonGet($select);

		foreach ($bb as $key) {
			$keterangan = $key->keterangan;
		}

		echo json_encode(array(
			"no_bb" => $id_bb,
			"keterangan" => $keterangan
		));
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

	public function print_pdf($keyword = '',$is_archive = '', $group_id = '', $kat_id= '',$sts1 = '')
	{

		$now = date('d-m-Y');

		if($is_archive <> ''){
			if($is_archive <> 'false'){
				$is_archive = array(1,0);
			}else{
				$is_archive = array(0);
			}
		}else{
			$is_archive = array(0);
		}

		$sts = (int)$sts1;

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tproduct.prod_code0' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_code1' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tproduct.prod_name1' => $keyword);
		}

		$where = array();

		if($sts <> 0){
			$where['tproduct.is_stok'] = $sts-1;
		}

		if($kat_id == 0){

		}else{
			$where['tproduct.cat_id'] = $kat_id;
		}

		if($group_id == 0){

		}else{
			$where['tproduct.group_id'] = $group_id;
		}

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

			$where['tdgproduct.gud_no'] = $gud_no;
		}

		$option1 = array(
			'select' => array(
								'tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.cat_id',
								'tproduct.group_id',
								'tcat.nama as nama_kat',
								'tgroup.nama as nama_group',
								'concat(tdgproduct.prod_on_hand, " ",tproduct.prod_uom) as stok',
								'format(if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price),2) as prod_buy_price2',
								'format(((tproduct.prod_sell_price - if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) / if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) * 100, 2) as prod_buy_persen2',
								'format(tproduct.prod_last_ppn,2) as prod_last_ppn2',
								'format((((tproduct.prod_sell_price - tproduct.prod_last_ppn) / tproduct.prod_last_ppn)) * 100,2) as prod_ppn_persen2',
								'tproduct.prod_sell_price',
								'tdgproduct.gud_no',
								'tproduct.is_stok'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
	    $option2 = array(
			'select' => array('count(tproduct.prod_no) as total'),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
		
		$data = array();
		$data['grp'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);

		$pdf = new FPDF();
		$pdf->AddPage('P', 'A4');
		$pdf->SetFont('Arial','B',12);
		$pageWidth = $pdf->GetPageWidth();

		// Define the desired margins
		$leftMargin = 5;
		$rightMargin = 5;

		// Calculate the table width based on the available space
		$tableWidth = $pageWidth - $leftMargin - $rightMargin;

		$pdf->SetLeftMargin($leftMargin);
		$pdf->SetRightMargin($rightMargin);

		// Calculate the X position to center the table
		$tableX = ($pageWidth - $tableWidth) / 2;

		$pdf->Cell($tableX);
		$pdf->Cell($tableWidth, 10, 'DAFTAR PRODUCT OHH_BAKERY', 0, 1, 'C');
		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell($tableWidth * 0.05, 6, 'No', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.17, 6, 'Kode Barang', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.22, 6, 'Nama Barang', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.20, 6, 'Kategori', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.10, 6, 'Qty', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.13, 6, 'Harga Beli', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.13, 6, 'Harga Jual', 1, 1, 'C');

		$pdf->SetFont('Arial', '', 8);

		$no = 0;
		foreach ($data['grp'] as $br) {
		    $no++;
		    $pdf->Cell($tableWidth * 0.05, 6, $no, 1, 0, 'C');
		    $pdf->Cell($tableWidth * 0.17, 6, $br->prod_code0, 1, 0, 'L');
		    $pdf->Cell($tableWidth * 0.22, 6, $br->prod_name0, 1, 0, 'L');
		    $pdf->Cell($tableWidth * 0.20, 6, $br->nama_kat, 1, 0, 'L');
		    $pdf->Cell($tableWidth * 0.10, 6, $br->stok, 1, 0, 'R');
		    $pdf->Cell($tableWidth * 0.13, 6, $br->prod_buy_price2, 1, 0, 'R');
		    $pdf->Cell($tableWidth * 0.13, 6, number_format((float)$br->prod_sell_price, 2, '.', ','), 1, 1, 'R');
		}

		$filename = 'product_'.$now.'.pdf';
        $pdf->Output($filename, 'I');

		// $html = $this->load->view('print/barang', $data, true);
  		// $this->pdf->createPDF($html, 'product_'.$now, false);
	}
	public function print_csv($keyword = '',$is_archive = '', $group_id = '', $kat_id= '',$sts1 = '')
	{
		// file name 
		$filename = 'barang_'.date('d-m-Y').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

		if($is_archive <> ''){
			if($is_archive <> 'false'){
				$is_archive = array(1,0);
			}else{
				$is_archive = array(0);
			}
		}else{
			$is_archive = array(0);
		}

		$sts = (int)$sts1;

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tproduct.prod_code0' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_code1' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tproduct.prod_name1' => $keyword);
		}

		$where = array();

		if($sts <> 0){
			$where['tproduct.is_stok'] = $sts-1;
		}

		if($kat_id == 0){

		}else{
			$where['tproduct.cat_id'] = $kat_id;
		}

		if($group_id == 0){

		}else{
			$where['tproduct.group_id'] = $group_id;
		}

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

			$where['tdgproduct.gud_no'] = $gud_no;
		}

		$option1 = array(
			'select' => array(
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tcat.nama as nama_kat',
								'concat(tdgproduct.prod_on_hand, " ",tproduct.prod_uom) as stok',
								'format(if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price),2) as prod_buy_price2',
								'tproduct.prod_sell_price',
								'tproduct.is_stok'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
		$data = $this->setting_model->commonGet($option1);
		// file creation 
		$file = fopen('php://output', 'w');

		$header = array("Kode Barang","Nama Barang","Kategori","Stok", "Harga Beli", "Harga Jual", "Status"); 
		fputcsv($file, $header);
		foreach ($data as $key){ 
			fputcsv($file,(array)$key); 
		}
		fclose($file); 
		exit; 
	}

	public function print_exc($keyword = '',$is_archive = '', $group_id = '', $kat_id= '',$sts1 = '')
	{
		$filename = 'barang_'.date('d-m-Y');  
		if($is_archive <> ''){
			if($is_archive <> 'false'){
				$is_archive = array(1,0);
			}else{
				$is_archive = array(0);
			}
		}else{
			$is_archive = array(0);
		}

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tproduct.prod_code0' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_code1' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tproduct.prod_name1' => $keyword);
		}

		$sts = (int)$sts1;

		$where = array();

		if($sts <> 0){
			$where['tproduct.is_stok'] = $sts-1;
		}

		if($kat_id == 0){

		}else{
			$where['tproduct.cat_id'] = $kat_id;
		}

		if($group_id == 0){

		}else{
			$where['tproduct.group_id'] = $group_id;
		}

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

			$where['tdgproduct.gud_no'] = $gud_no;
		}

		$option1 = array(
			'select' => array(
								'tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.cat_id',
								'tproduct.group_id',
								'tcat.nama as nama_kat',
								'tgroup.nama as nama_group',
								'concat(tdgproduct.prod_on_hand, " ",tproduct.prod_uom) as stok',
								'format(if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price),2) as prod_buy_price2',
								'format(((tproduct.prod_sell_price - if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) / if(tproduct.prod_last_buy_price <> 0, tproduct.prod_last_buy_price, tproduct.prod_buy_price)) * 100, 2) as prod_buy_persen2',
								'format(tproduct.prod_last_ppn,2) as prod_last_ppn2',
								'format((((tproduct.prod_sell_price - tproduct.prod_last_ppn) / tproduct.prod_last_ppn)) * 100,2) as prod_ppn_persen2',
								'tproduct.prod_sell_price',
								'tdgproduct.gud_no',
								'tproduct.is_stok'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'tdgproduct' => 'tdgproduct.prod_no = tproduct.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
		$data = $this->setting_model->commonGet($option1);

		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'Kode Barang');
        $sheet->setCellValue('B1', 'Nama Barang');
        $sheet->setCellValue('C1', 'Kategori');   
        $sheet->setCellValue('D1', 'Stok');   
        $sheet->setCellValue('E1', 'Harga Beli');   
        $sheet->setCellValue('F1', 'Harga Jual');
        $sheet->setCellValue('G1', 'Status');
        $rows = 2;
        foreach ($data as $val){
            $sheet->setCellValue('A' . $rows, $val->prod_code0);
            $sheet->setCellValue('B' . $rows, $val->prod_name0);
            $sheet->setCellValue('C' . $rows, $val->nama_kat);
            $sheet->setCellValue('D' . $rows, $val->stok);
            $sheet->setCellValue('E' . $rows, $val->prod_buy_price2);
            $sheet->setCellValue('F' . $rows, $val->prod_sell_price);
            $sheet->setCellValue('G' . $rows, $val->is_stok);
            $rows++;
        } 

        $writer = new Xlsx($spreadsheet);
		
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        $writer->save('php://output');
	}

	public function print_pdf_margin($keyword = '',$is_archive = '', $group_id = '', $kat_id= '',$sts1 = '')
	{
		$now = date('Y-m-d H:i:s');

		if($is_archive <> ''){
			if($is_archive <> 'false'){
				$is_archive = array(1,0);
			}else{
				$is_archive = array(0);
			}
		}else{
			$is_archive = array(0);
		}

		$sts = (int)$sts1;

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tproduct.prod_code0' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_code1' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tproduct.prod_name1' => $keyword);
		}

		$where = array();

		if($sts <> 0){
			$where['tproduct.is_stok'] = $sts-1;
		}

		if($kat_id == 0){

		}else{
			$where['tproduct.cat_id'] = $kat_id;
		}

		if($group_id == 0){

		}else{
			$where['tproduct.group_id'] = $group_id;
		}

		$option1 = array(
			'select' => array(
								'tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.cat_id',
								'tproduct.group_id',
								'tcat.nama as nama_kat',
								'tgroup.nama as nama_group',
								'concat(tproduct.prod_on_hand, " ",tproduct.prod_uom) as stok',
								'tproduct.prod_sell_price as harga_baru',
								'xb.harga as harga_lama'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'(select xx.prod_no, xx.tgl, xx.harga from this_harga xx
	    						where xx.tgl < "'.$now.'"
	    						order by tgl desc limit 1) xb' => 'tproduct.prod_no = xb.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
	    $option2 = array(
			'select' => array('count(tproduct.prod_no) as total'),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'(select xx.prod_no, xx.tgl, xx.harga from this_harga xx
	    						where xx.tgl < "'.$now.'"
	    						order by tgl desc limit 1) xb' => 'tproduct.prod_no = xb.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
		
		$data = array();
		$data['grp'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);

		$pdf = new FPDF();
		$pdf->AddPage('P', 'A4');
		$pdf->SetFont('Arial','B',12);
		$pageWidth = $pdf->GetPageWidth();

		// Define the desired margins
		$leftMargin = 5;
		$rightMargin = 5;

		// Calculate the table width based on the available space
		$tableWidth = $pageWidth - $leftMargin - $rightMargin;

		$pdf->SetLeftMargin($leftMargin);
		$pdf->SetRightMargin($rightMargin);

		// Calculate the X position to center the table
		$tableX = ($pageWidth - $tableWidth) / 2;

		$pdf->Cell($tableX);
		$pdf->Cell($tableWidth, 10, 'DAFTAR PRODUCT OHH_BAKERY', 0, 1, 'C');
		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell($tableWidth * 0.05, 6, 'No', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.17, 6, 'Kode Barang', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.22, 6, 'Nama Barang', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.15, 6, 'Kategori', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.15, 6, 'Qty', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.13, 6, 'Harga Lama', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.13, 6, 'Harga Baru', 1, 1, 'C');

		$pdf->SetFont('Arial', '', 8);

		$no = 0;
		foreach ($data['grp'] as $br) {
		    $no++;
		    $pdf->Cell($tableWidth * 0.05, 6, $no, 1, 0, 'C');
		    $pdf->Cell($tableWidth * 0.17, 6, $br->prod_code0, 1, 0, 'L');
		    $pdf->Cell($tableWidth * 0.22, 6, $br->prod_name0, 1, 0, 'L');
		    $pdf->Cell($tableWidth * 0.15, 6, $br->nama_kat, 1, 0, 'L');
		    $pdf->Cell($tableWidth * 0.15, 6, $br->stok, 1, 0, 'R');
		    $pdf->Cell($tableWidth * 0.13, 6, number_format((float)$br->harga_lama, 2, '.', ','), 1, 0, 'R');
		    $pdf->Cell($tableWidth * 0.13, 6, number_format((float)$br->harga_baru, 2, '.', ','), 1, 1, 'R');
		}

		$filename = 'product_margin_'.$now.'.pdf';
        $pdf->Output($filename, 'I');

		// $html = $this->load->view('print/barang_margin', $data, true);
        // $this->pdf->createPDF($html, 'product-margin_'.date('d-m-Y'), false);
	}
	public function print_csv_margin($keyword = '',$is_archive = '', $group_id = '', $kat_id= '',$sts1 = '')
	{
		$now = date('Y-m-d H:i:s');
		// file name 
		$filename = 'barang-margin_'.date('d-m-Y').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

		if($is_archive <> ''){
			if($is_archive <> 'false'){
				$is_archive = array(1,0);
			}else{
				$is_archive = array(0);
			}
		}else{
			$is_archive = array(0);
		}

		$sts = (int)$sts1;

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tproduct.prod_code0' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_code1' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tproduct.prod_name1' => $keyword);
		}

		$where = array();

		if($sts <> 0){
			$where['tproduct.is_stok'] = $sts-1;
		}

		if($kat_id == 0){

		}else{
			$where['tproduct.cat_id'] = $kat_id;
		}

		if($group_id == 0){

		}else{
			$where['tproduct.group_id'] = $group_id;
		}

		$option1 = array(
			'select' => array(
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tcat.nama as nama_kat',
								'concat(tproduct.prod_on_hand, " ",tproduct.prod_uom) as stok',
								'xb.harga as harga_lama',
								'tproduct.prod_sell_price as harga_baru'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'(select xx.prod_no, xx.tgl, xx.harga from this_harga xx
	    						where xx.tgl < "'.$now.'"
	    						order by tgl desc limit 1) xb' => 'tproduct.prod_no = xb.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
		$data = $this->setting_model->commonGet($option1);
		// file creation 
		$file = fopen('php://output', 'w');

		$header = array("Kode Barang","Nama Barang","Kategori","Stok", "Harga Jual Lama", "Harga Jual Baru"); 
		fputcsv($file, $header);
		foreach ($data as $key){ 
			fputcsv($file,(array)$key); 
		}
		fclose($file); 
		exit; 
	}

	public function print_exc_margin($keyword = '',$is_archive = '', $group_id = '', $kat_id= '',$sts1 = '')
	{
		$now = date('Y-m-d H:i:s');

		$filename = 'barang-margin_'.date('d-m-Y');  
		if($is_archive <> ''){
			if($is_archive <> 'false'){
				$is_archive = array(1,0);
			}else{
				$is_archive = array(0);
			}
		}else{
			$is_archive = array(0);
		}

		$sts = (int)$sts1;

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
			$or_like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tproduct.prod_code0' => $keyword);
			$or_like = array('tproduct.prod_name0' => $keyword,
								'tproduct.prod_code1' => $keyword,
								'tproduct.prod_name0' => $keyword,
								'tproduct.prod_name1' => $keyword);
		}

		$where = array();

		if($sts <> 0){
			$where['tproduct.is_stok'] = $sts-1;
		}

		if($kat_id == 0){

		}else{
			$where['tproduct.cat_id'] = $kat_id;
		}

		if($group_id == 0){

		}else{
			$where['tproduct.group_id'] = $group_id;
		}

		$option1 = array(
			'select' => array(
								'tproduct.prod_no',
								'tproduct.prod_code0',
								'tproduct.prod_name0',
								'tproduct.prod_code1',
								'tproduct.prod_name1',
								'tproduct.cat_id',
								'tproduct.group_id',
								'tcat.nama as nama_kat',
								'tgroup.nama as nama_group',
								'concat(tproduct.prod_on_hand, " ",tproduct.prod_uom) as stok',
								'tproduct.prod_sell_price as harga_baru',
								'xb.harga as harga_lama'
							),
	    	'table' => 'tproduct',
	    	'join' => array(
	    					'tcat' => 'tcat.cat_id = tproduct.cat_id',
	    					'tgroup' => 'tgroup.group_id = tproduct.group_id',
	    					'(select xx.prod_no, xx.tgl, xx.harga from this_harga xx
	    						where xx.tgl < "'.$now.'"
	    						order by tgl desc limit 1) xb' => 'tproduct.prod_no = xb.prod_no'),
	    	'where'	=> $where,
	    	'where_in' => array(
							'tproduct.is_delete' => $is_archive
						),
	    	'like' => $like,
	    	'or_like' => $or_like,
	    	'order' => array('tproduct.prod_name0' => 'ASC')
	    );
		$data = $this->setting_model->commonGet($option1);

		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'Kode Barang');
        $sheet->setCellValue('B1', 'Nama Barang');
        $sheet->setCellValue('C1', 'Kategori');   
        $sheet->setCellValue('D1', 'Stok');   
        $sheet->setCellValue('E1', 'Harga Jual Lama');   
        $sheet->setCellValue('F1', 'Harga Jual Baru');   
        $rows = 2;
        foreach ($data as $val){
            $sheet->setCellValue('A' . $rows, $val->prod_code0);
            $sheet->setCellValue('B' . $rows, $val->prod_name0);
            $sheet->setCellValue('C' . $rows, $val->nama_kat);
            $sheet->setCellValue('D' . $rows, $val->stok);
            $sheet->setCellValue('E' . $rows, $val->harga_lama);
            $sheet->setCellValue('F' . $rows, $val->harga_baru);
            $rows++;
        } 

        $writer = new Xlsx($spreadsheet);
		
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        $writer->save('php://output');
	}
}