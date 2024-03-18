<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	var $current_db;
	var $db_selected;
    public function __construct()
    {
		parent::__construct();
		
		$this->load->model('setting_model');
		$this->load->model('transaction_model');
	}

	public function index()
	{  
		if($this->session->userdata('status') != "login"){
			$data_json = file_get_contents('./database.json');
			$decrypt  = $this->secure->decrypt_url($data_json);

			$data = array();

			$data['json_arr'] = json_decode($decrypt, true);
			$data['pg_st'] = 'login';
			$this->load->view("login_new",$data);
		}else{
			redirect('dashboard', 'refresh');
		}
		
	}
	public function dashboard($bb_start = '', $bb_end = '', $mnf_start = '', $mnf_end = '')
	{
		if($bb_start == '' AND $bb_end == ''){
			$bb_start = date('Y-m-01')." 00:00:00";
			$bb_end = date('Y-m-t')." 23:59:59";
		}else{
			$bb_start = $bb_start." 00:00:00";
			$bb_end = $bb_end." 23:59:59";
		}

		if($mnf_start == '' AND $mnf_end == ''){
			$mnf_start = date('Y-m-01')." 00:00:00";
			$mnf_end = date('Y-m-t')." 23:59:59";
		}else{
			$mnf_start = $mnf_start." 00:00:00";
			$mnf_end = $mnf_end." 23:59:59";
		}

		$ebs = explode(" ", $bb_start);
		$ebe = explode(" ", $bb_end);
		$ems = explode(" ", $mnf_start);
		$eme = explode(" ", $mnf_end);

		$data = array();
		$ct1 = array(
			'select' => array('count(tproduct.prod_no) as total'),
	    	'table' => 'tproduct',
	    	'where' => array(
							'tproduct.is_delete' => 0)
	    );
	    $ct2 = array(
			'select' => array('count(tset_bb.bb_no) as total'),
	    	'table' => 'tset_bb',
	    	'where' => array(
							'tset_bb.is_delete' => 0)
	    );

	    $ct3 = array(
			'select' => array('count(tm_produksi.pr_no) as total'),
	    	'table' => 'tm_produksi',
	    	'where' => array(
							'tm_produksi.is_delete' => 0)
	    );

	    $ct4 = array(
			'select' => array('count(tm_produksi_trial.pr_no) as total'),
	    	'table' => 'tm_produksi_trial',
	    	'where' => array(
							'tm_produksi_trial.is_delete' => 0)
	    );

	    $selstokbb = array(
			'select' => array('c.prod_no', 'c.prod_code0', 
								'c.prod_name0 as nama',
								'sum(b.qty_satuan) as qty',
								'concat(c.prod_on_hand, " ",c.prod_uom) as stok',
								'if(prod_last_buy_price <> 0, prod_last_buy_price, prod_buy_price) as prod_buy_price',
								'prod_last_ppn', 'prod_sell_price'
			),
			'table' => 'td_produksi b',
			'join' => array('tm_produksi a' => 'b.pr_no = a.pr_no',
							'tproduct c' => 'b.prod_no = c.prod_no'),
			'where' => array('a.is_delete' => 0, 
							'b.jenis_brg <>' => 2,
							'c.prod_on_hand <' => 10),
			'group' => 'prod_no',
			'order' => array('qty'=> 'DESC'),
			'limit' => 10
		);

		$sbb = array(
			'select' => array('c.prod_no', 'c.prod_code0', 
								'c.prod_name0 as nama',
								'sum(b.qty_satuan) as qty',
								'concat(c.prod_on_hand, " ",c.prod_uom) as stok',
								'if(prod_last_buy_price <> 0, prod_last_buy_price, prod_buy_price) as prod_buy_price',
								'prod_last_ppn', 'prod_sell_price'
			),
			'table' => 'td_produksi b',
			'join' => array('tm_produksi a' => 'b.pr_no = a.pr_no',
							'tproduct c' => 'b.prod_no = c.prod_no'),
			'where' => array('a.is_delete' => 0, 
							'b.jenis_brg <>' => 2,
							'c.prod_on_hand <' => 10,
							'a.pr_date <=' => $bb_end,
							'a.pr_date >=' => $bb_start),
			'group' => 'prod_no',
			'order' => array('qty'=> 'DESC'),
			'limit' => 10
		);

		$selstokmnf = array(
			'select' => array('c.prod_no', 'c.prod_code0', 
								'c.prod_name0 as nama',
								'sum(b.qty_satuan) as qty',
								'concat(c.prod_on_hand, " ",c.prod_uom) as stok',
								'if(prod_last_buy_price <> 0, prod_last_buy_price, prod_buy_price) as prod_buy_price',
								'prod_last_ppn', 'prod_sell_price'
			),
			'table' => 'td_produksi b',
			'join' => array('tm_produksi a' => 'b.pr_no = a.pr_no',
							'tproduct c' => 'b.prod_no = c.prod_no'),
			'where' => array('a.is_delete' => 0, 
							'b.jenis_brg' => 2,
							'c.prod_on_hand <' => 10),
			'group' => 'prod_no',
			'order' => array('qty'=> 'DESC'),
			'limit' => 10
		);

		$smnf = array(
			'select' => array('c.prod_no', 'c.prod_code0', 
								'c.prod_name0 as nama',
								'sum(b.qty_satuan) as qty',
								'concat(c.prod_on_hand, " ",c.prod_uom) as stok',
								'if(prod_last_buy_price <> 0, prod_last_buy_price, prod_buy_price) as prod_buy_price',
								'prod_last_ppn', 'prod_sell_price'
			),
			'table' => 'td_produksi b',
			'join' => array('tm_produksi a' => 'b.pr_no = a.pr_no',
							'tproduct c' => 'b.prod_no = c.prod_no'),
			'where' => array('a.is_delete' => 0, 
							'b.jenis_brg' => 2,
							'c.prod_on_hand <' => 10,
							'a.pr_date <=' => $mnf_end,
							'a.pr_date >=' => $mnf_start),
			'group' => 'prod_no',
			'order' => array('qty'=> 'DESC'),
			'limit' => 10
		);

		$data['barang'] = $this->setting_model->commonGet($ct1);
		$data['bb'] = $this->setting_model->commonGet($ct2);
		$data['mnf'] = $this->setting_model->commonGet($ct3);
		$data['trial'] = $this->setting_model->commonGet($ct4);
		$data['bbs'] = $this->setting_model->commonGet($selstokbb);
		$data['mnfs'] = $this->setting_model->commonGet($selstokmnf);
		$data['sbb'] = $this->setting_model->commonGet($sbb);
		$data['smnf'] = $this->setting_model->commonGet($smnf);
		$data['bb_start'] = $ebs[0];
		$data['bb_end'] = $ebe[0];
		$data['mnf_start'] = $ems[0];
		$data['mnf_end'] = $eme[0];
		$this->load->view("admin/dashboard", $data);
	}
	public function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('pass');
		$cek = 0;
		$where = array(
							'user_name' => $username,
							'user_pass' => $password,
							'is_delete' => 0);
		if($username <> '' AND $password <> ''){
			$cek = $this->setting_model->cek_login("tusers",$where)->num_rows();
			$option = array(
				'select' => array(
								'tusers.User_id',
								'tgroup_users.user_right',
								'tusers.cat_gud_no as gud_no'
							),
		    	'table' => 'tusers',
		    	'join' => array(
	    					'tgroup_users' => 'tgroup_users.group_user_id = tusers.group_user_id'
	    				),
		    	'where' => array(
							'tusers.user_name' => $username,
							'tusers.user_pass' => $password)
			);
			$data['user'] = $this->setting_model->commonGet($option);

			if($cek > 0){

				$person_id ="";
				if( is_array($data['user']) || is_object($data['user'])) {
				    foreach($data['user'] as $dt) {
				      $person_id = $dt->User_id;
				      $user_right = $dt->user_right;
				      $gud_no = $dt->gud_no;
				    }
				  }

				$data_session = array(
					'nama' => $username,
					'status' => "login",
					'person_id' => $person_id,
					'user_right' => $user_right,
					'gud_no' => $gud_no,
					);

				$this->session->set_userdata($data_session);
				redirect('dashboard', 'refresh');
				
			}else{
				error_reporting(0);
				echo "<script>
					alert('Username atau Password anda salah! Silahkan coba kembali!');
					window.location.href='login';
					</script>";
			}
		}else{
			error_reporting(0);
			echo "<script>
					alert('Gagal! Harap lengkapi data!');
					window.location.href='login';
					</script>";
		}
		
	}
 	public function menus()
    {
        $output[] = '
            <li class="sidebar-toggler-wrapper"></li>
			<li class="start tooltips menu-bar" id="1" style="display:none;">
				<a href="'.base_url("dashboard").'">
				<i class="icon-home"></i>
				<span class="title">
				Dashboard </span>
				</a>
			</li>
			<li class="start tooltips menu-bar" id="21" style="display:none;">
				<a href="'.base_url("product/page").'">
					<i class="fa fa-cube"></i>
					<span class="title">
					Barang </span>
				</a>
			</li>
			<li class="start tooltips menu-bar" id="22" style="display:none;">
				<a href="'.base_url("category/page").'">
					<i class="fa fa-gear"></i>
					<span class="title">
					Kategori </span>
				</a>
			</li>
			<li class="start tooltips menu-bar" id="23" style="display:none;">
				<a href="'.base_url("sub_category/page").'">
					<i class="fa fa-gears"></i>
					<span class="title">
					Sub-Kategori </span>
				</a>
			</li>
			<li class="heading">
				<h3 class="uppercase">Produksi</h3>
			</li>
			<li class="start tooltips menu-bar" id="31" style="display:none;">
				<a href="'.base_url("manufacture/bahan").'">
					<i class="fa fa-chain"></i>
					<span class="title">
					Bahan Baku </span>
				</a>
			</li>
			<li class="start tooltips menu-bar" id="32" style="display:none;">
				<a href="'.base_url("manufacture/role").'">
					<i class="fa fa-sliders"></i>
					<span class="title">
					Rote Price </span>
				</a>
			</li>
			<li class="start tooltips menu-bar" id="33" style="display:none;">
				<a href="'.base_url("manufacture/proses").'">
					<i class="fa fa-random"></i>
					<span class="title">
					Proses Manufaktur</span>
				</a>
			</li>
			<li class="heading">
				<h3 class="uppercase">Trial</h3>
			</li>
			<li class="start tooltips menu-bar" id="41 style="display:none;"">
				<a href="'.base_url("manufacture/proses_trial").'">
					<i class="fa fa-history"></i>
					<span class="title">
					Proses Trial</span>
				</a>
			</li>
			<li class="heading">
				<h3 class="uppercase">Setting</h3>
			</li>
			<li class="start tooltips menu-bar" id="51" style="display:none;">
				
				<a href="'.base_url("profile").'">
					<i class="fa fa-building"></i>
					<span class="title">
					Profil Outlet</span>
				</a>
				
			</li>
			<li class="start tooltips menu-bar" id="52" style="display:none;">
				
				<a href="'.base_url("user/setting").'">
					<i class="fa fa-user"></i>
					<span class="title">
					User Setting</span>
				</a>
				
			</li>
			<li class="start tooltips menu-bar" id="53" style="display:none;">
				
				<a href="'.base_url("user/akses").'">
					<i class="fa fa-key"></i>
					<span class="title">
					User Akses</span>
				</a>
				
			</li>';
        $new_output = implode(" ",$output);
        $data = array(
               'menus' => $new_output);

        echo json_encode($data);
    }
	public function logout(){
		if($this->session->userdata('status') != "login"){
			echo "<script>
				alert('Anda harus melakukan login dahulu!');
				window.location.href='../login';
				</script>";
		}else{
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
		
	}

	public function get_fm_bb($start_date = '', $end_date= '')
	{
		$gud_no = '';

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

		$select = array(
			'select' => array('c.prod_no', 
								'c.prod_code0', 
								'c.prod_name0 as nama',
								'sum(b.qty_satuan) as qty',
								'concat(c.prod_on_hand, " ",c.prod_uom) as stok',
								'if(prod_last_buy_price <> 0, prod_last_buy_price, prod_buy_price) as prod_buy_price',
								'prod_last_ppn', 'prod_sell_price'
			),
			'table' => 'td_produksi b',
			'join' => array('tm_produksi a' => 'b.pr_no = a.pr_no',
							'tproduct c' => 'b.prod_no = c.prod_no'),
			'where' => array('a.is_delete' => 0, 
							'b.jenis_brg <>' => 2,
							'c.prod_on_hand <' => 10),
			'group' => 'prod_no',
			'order' => array('qty'=> 'DESC'),
			'limit' => 10
		);

		$sel = $this->setting_model->commonGet($select);
		
		echo json_encode($sel);
		
	}

	public function get_bb_usage($start_date = '', $end_date= '')
	{
		if($start_date == '' AND $end_date == ''){
			$bb_start = date('Y-m-01')." 00:00:00";
			$bb_end = date('Y-m-t')." 23:59:59";
		}else{
			$bb_start = $start_date." 00:00:00";
			$bb_end = $end_date." 23:59:59";
		}

		$gud_no = '';

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

		$select = array(
			'select' => array('c.prod_no', 
								'c.prod_code0', 
								'c.prod_name0 as nama',
								'sum(b.qty_satuan) as qty',
								'concat(c.prod_on_hand, " ",c.prod_uom) as stok',
								'if(prod_last_buy_price <> 0, prod_last_buy_price, prod_buy_price) as prod_buy_price',
								'prod_last_ppn', 'prod_sell_price'
			),
			'table' => 'td_produksi b',
			'join' => array('tm_produksi a' => 'b.pr_no = a.pr_no',
							'tproduct c' => 'b.prod_no = c.prod_no'),
			'where' => array('a.is_delete' => 0, 
							'b.jenis_brg <>' => 2,
							'a.pr_date <=' => $bb_end,
							'a.pr_date >=' => $bb_start),
			'group' => 'prod_no',
			'order' => array('qty'=> 'DESC'),
			'limit' => 10
		);

		$sel = $this->setting_model->commonGet($select);
		
		echo json_encode($sel);
		
	}

	public function get_mnf_usage($start_date = '', $end_date= '')
	{
		
		if($start_date == '' AND $end_date == ''){
			$mnf_start = date('Y-m-01')." 00:00:00";
			$mnf_end = date('Y-m-t')." 23:59:59";
		}else{
			$mnf_start = $start_date." 00:00:00";
			$mnf_end = $end_date." 23:59:59";
		}

		$gud_no = '';

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

		$select = array(
			'select' => array('c.prod_no', 
								'c.prod_code0', 
								'c.prod_name0 as nama',
								'sum(b.qty_satuan) as qty',
								'concat(c.prod_on_hand, " ",c.prod_uom) as stok',
								'if(prod_last_buy_price <> 0, prod_last_buy_price, prod_buy_price) as prod_buy_price',
								'prod_last_ppn', 'prod_sell_price'
			),
			'table' => 'td_produksi b',
			'join' => array('tm_produksi a' => 'b.pr_no = a.pr_no',
							'tproduct c' => 'b.prod_no = c.prod_no'),
			'where' => array('a.is_delete' => 0, 
							'b.jenis_brg' => 2,
							'a.pr_date <=' => $mnf_end,
							'a.pr_date >=' => $mnf_start),
			'group' => 'prod_no',
			'order' => array('qty'=> 'DESC'),
			'limit' => 10
		);

		$sel = $this->setting_model->commonGet($select);
		
		echo json_encode($sel);
		
	}

	public function database()
	{
		$data['pg_st'] = 'db_login';
		$this->load->view("login_new",$data);
	}
	public function db_config()
	{
		// $username = $this->input->post('username');
		// $password = $this->input->post('pass');

		// if($username <> '' AND $password <>''){
		// 	if($username == 'adm_config' AND $password == 'dbconfigmadura'){
				
				$data_json = file_get_contents('./database.json');
		        $decrypt  = $this->secure->decrypt_url($data_json);

		        $data = array();

		        $data['pg_st'] = 'db_config';
		        $data['conn'] = FALSE;
		        $data['json_arr'] = json_decode($decrypt, true);
				$this->load->view("login_new",$data);
		// 	}else{
		// 		echo "<script>
		// 		alert('Username atau Password salah! Harap login kembali');
		// 		</script>";
		// 		redirect('database', 'refresh');
		// 	}
		// }else{
		// 	echo "<script>
		// 		alert('Gagal! Harap isi data dengan benar!');
		// 		</script>";
		// 	redirect('database', 'refresh');
		// }
	}
	public function db_select()
	{
		$db = $this->input->post('dblist');

		if(!empty($db)) {    
	        foreach($db as $value){
	        	$cl = $this->clear_activedb();
	            $js = $this->setactive($value);
	            if($js == TRUE){
	            	$this->db->reconnect();
	            	$data_json = file_get_contents('./database.json');
			        $decrypt  = $this->secure->decrypt_url($data_json);

			        $data = array();

			        $data['pg_st'] = 'db_config';
			        $data['conn'] = TRUE;
			        $data['json_arr'] = json_decode($decrypt, true);
					$this->load->view("login_new",$data);
	            }else{
	            	echo "<script>
						alert('Gagal aktivasi database!');
					</script>";
					redirect('config', 'refresh');
	            }
	        }
    	}else{
    		echo "<script>
				alert('Silahkan pilih database dahulu!');
				</script>";
			redirect('config', 'refresh');
    	}
	}
	public function readjson()
	{
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		// decode json to associative array
		$json_arr = json_decode($decrypt, true);
		$json_body = json_encode($json_arr);
		print_r($json_body);
	}
	public function write_setting()
	{
		// $hostname = '158.140.172.233';
		// $port = '3306';
		// $username = 'web_access';
		// $password = 'fhsoftware2019';
		// $db = 'madura';

		$hostname = '192.168.1.99';
		$port = '3306';
		$username = 'adm_fhs';
		$password = 'fhsoftware2018';
		$db = 'madura_2020';

		$all = array();
		$response = array();
	    $posts = array();

	    $dsn[] = array(
		        	"dsn" => "mysql:host=".$hostname.":".$port."; dbname=".$db."; charset=utf8;",
		        	"host" => $hostname,
		        	"port" => $port,
			        "username" => $username,
			        "password" => $password,
			        "default" => '1'
	        );
	    $posts[] = array(
	    	"db"    =>  $db,
	        "setting"   => $dsn
	    );

	    $all[] = array(
	    	"active_db"    =>  $db
	    );
	    //If the json is correct, you can then write the file and load the view
	    $response['database'] = $posts;
	    $response['select'] = $all;
	    $fp = fopen('./database.json', 'w');
	    $json_body = json_encode($response);
	    $content = $this->secure->encrypt_url($json_body);
	    fwrite($fp, $content);

	    if (! write_file('./database.json', $content)){
		        echo "<script>
							alert('Gagal menambahkan database!');
							window.location.href='login';
				</script>";
		}else{
			$data_json = file_get_contents('./database.json');
			$decrypt  = $this->secure->decrypt_url($data_json);
			// decode json to associative array
			$json_arr = json_decode($decrypt, true);
			$json_body = json_encode($json_arr);
			print_r($json_body);
		}   
	}
	public function newdb($dbsel)
	{
		$hostname = '192.168.1.99';
		$port = '3306';
		$username = 'adm_fhs';
		$password = 'fhsoftware2018';

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./database.json');
	    $decrypt  = $this->secure->decrypt_url($fp);
	    $posts = json_decode($decrypt, true);

	    $dsn[] = array(
		        	"dsn" => "mysql:host=".$hostname.":".$port."; dbname=".$dbsel."; charset=utf8;",
		        	"host" => $hostname,
		        	"port" => $port,
			        "username" => $username,
			        "password" => $password,
			        "default" => '0'
	    );

	    $post = array(
	    	"db"    => $dbsel,
	        "setting"   => $dsn
	    );

	    array_push($posts['database'],$post);
	 
	    $json_body = json_encode($posts);
	    $content = $this->secure->encrypt_url($json_body);

	    file_put_contents('./database.json', $content);

	    if ( ! write_file('./database.json', $content)){
	        echo "<script>
						alert('Gagal menambahkan database!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./database.json');
			$decrypt  = $this->secure->decrypt_url($data_json);
			// decode json to associative array
			$json_arr = json_decode($decrypt, true);
			$json_body = json_encode($json_arr);
			print_r($json_body);
	    }   
	}
	public function db_delete($name)
	{
		// get array index to delete
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		// decode json to associative array
		$json_arr = json_decode($decrypt, true);

		// get array index to delete
		foreach($json_arr['database'] as $subKey => $subArray){
          if($subArray['db'] == $name){
               unset($json_arr['database'][$subKey]);
          }
     	}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		$content = $this->secure->encrypt_url($json_body);
		file_put_contents('./database.json', $content);

		redirect('setting/database', 'refresh');
	}
	public function clear_activedb()
	{
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		// decode json to associative array
		$json_arr = json_decode($decrypt, true);

		// get array index to delete
		foreach($json_arr['select'] as $subKey => $subArray){
            unset($json_arr['select'][$subKey]);
     	}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		$content = $this->secure->encrypt_url($json_body);
		file_put_contents('./database.json', $content);

		// print_r($json_body);
	}
	public function setactive($db)
	{
		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./database.json');
	    $decrypt  = $this->secure->decrypt_url($fp);
	    $posts = json_decode($decrypt, true);

	    $post = array(
	    	"active_db"  => $db
	    );

	    array_push($posts['select'],$post);
	 
	    $json_body = json_encode($posts);
	    $content = $this->secure->encrypt_url($json_body);

	    file_put_contents('./database.json', $content);

	    if ( ! write_file('./database.json', $content)){
	    //     echo "<script>
					// 	alert('Gagal menambahkan database!');
					// </script>";
	    	return false;
	    }else{

	  //       $data_json = file_get_contents('./database.json');
			// $decrypt  = $this->secure->decrypt_url($data_json);
			// // decode json to associative array
			// $json_arr = json_decode($decrypt, true);
			// $json_body = json_encode($json_arr);
			// print_r($json_body);
			return TRUE;
	    }   
	}
	public function default_db()
	{
		$db_selected = '';
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		// decode json to associative array
		$json_arr = json_decode($decrypt, true);

	  	foreach ($json_arr['database'] as $key=>$value) {
	  		$dbs = $value['db'] ;
			foreach ($value['setting'] as $val) {
				if($val['dsn'] == '1'){
					$db_selected = $dbs;
				}
			}
		}
		$this->setactive($db_selected);
		$this->db->reconnect();


	}
	public function configure_database() {
		//read JSON file for active db
		$data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);
        $json_arr = json_decode($decrypt, true);

        foreach($json_arr['select'] as $key=>$value) {
        	$dbact = $value['active_db'];
        }
        foreach ($json_arr['database'] as $key=>$value) {
		    if ($value['db'] == $dbact) {
		        foreach ($value['dsn'] as $val) {
		        	$this->session->set_userdata('hostname',$val['hostname']);
					$this->session->set_userdata('port',$val['port']);
					$this->session->set_userdata('username',$val['username']);
					$this->session->set_userdata('password',$val['password']);
		        }
		    }
		}

		$hostname = $this->session->userdata("hostname");
		$port = $this->session->userdata("port");
		$username = $this->session->userdata("username");
		$password = $this->session->userdata("password");

		$test = $this->transaction_model->testCon($dbact,$hostname,$port,$username,$password);

		if($test == TRUE){
			// write database.php
		    $data_db = file_get_contents('./application/config/database.php');
		    // session_start();
		    $temporary = str_replace("%DBACTIVE%", $dbact, $data_db);
		    // Write the new database.php file
		    $output_path = './application/config/database.php';
		    $handle = fopen($output_path,'w+');
		    // Chmod the file, in case the user forgot
		    @chmod($output_path,0777);
		    // Verify file permissions
		    if(is_writable($output_path)) {
		        // Write the file
		        if(fwrite($handle,$temporary)) {
		        	
		            return true;
		        } else {
		    //     	echo "<script>
						// alert('cannot write');
						// </script>"; 
		            return false;
		        }
		    } else {
		  //   	echo "<script>
				// alert('no permission');
				// </script>"; 
		        return false;
		    }
		}else{
		  //  echo "<script>
				// alert('Koneksi Database Gagal!Harap hubungi administrator!');
				// </script>"; 
			return false;
		}				
	}
}


// select * from tusers;

// insert into tusers (iUpload,create_date,pass_diskon, user_name, user_pass, is_delete, group_user_id, user_right) values
// (1, '2023-01-04 09:29:56', '1234', 'admin_web', '1234', 0, 24, '1 2 21 21A 21B 21C 21D 21E 21F 22 22A 22B 22C 22D 22E 22F 23 23A 23B 23C 23D 23E 23F 3 31 31A 31B 31C 31D 31E 31F 32 32A 32B 32C 32D 32E 32F 33 33A 33B 33C 33D 33E 33F 4 41 41A 41B 41C 41D 41E 41F 5 51 51A 51B 52 52A 52B 52C 52D 52E 52F 53 53A 53B 53C 53D');

// select * from tgroup_users;

// insert into tgroup_users (iUpload,user_name,user_right, is_Super) values
// (1, 'super admin web', '1 2 21 21A 21B 21C 21D 21E 21F 22 22A 22B 22C 22D 22E 22F 23 23A 23B 23C 23D 23E 23F 3 31 31A 31B 31C 31D 31E 31F 32 32A 32B 32C 32D 32E 32F 33 33A 33B 33C 33D 33E 33F 4 41 41A 41B 41C 41D 41E 41F 5 51 51A 51B 52 52A 52B 52C 52D 52E 52F 53 53A 53B 53C 53D', 1),
// (1, 'admin resep', '1 2 21 21A 21B 21C 21D 21E 21F 22 22A 22B 22C 22D 22E 22F 23 23A 23B 23C 23D 23E 23F', 0),
// (1, 'hr', '1 5 51 51A 51B 52 52A 52B 52C 52D 52E 52F 53 53A 53B 53C 53D', 0);