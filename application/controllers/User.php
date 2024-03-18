<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . '../vendor/setasign/fpdf/fpdf.php');

class User extends CI_Controller {
	
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

//FUNCTION MENU USER SETTING
	public function index()
	{

	}
	public function setting($keyword = '',$is_archive = '' , $group_user_id = '')
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
		
	    $option = array(
			'select' => array(
								'tgroup_users.group_user_id',
								'tgroup_users.user_name'),
	    	'table' => 'tgroup_users',
	    	'where' => array(
							'tgroup_users.is_delete' => 0)
	    );
	    $ct1 = array(
			'select' => array('count(tusers.User_id) as aktif'),
	    	'table' => 'tusers',
	    	'where' => array(
							'tusers.is_delete' => 0)
	    );
	    $ct2 = array(
			'select' => array('count(tusers.User_id) as non'),
	    	'table' => 'tusers',
	    	'where' => array('tusers.is_delete' => 1)
	    );

    	$data = array();
    	if($keyword=='none'){$keyword = '';}else{$keyword = str_replace("_"," ",$keyword);}
		$data['keyw'] = $keyword;
		$data['is_arc'] = $chk;
		$data['grp_id'] = $group_user_id;
		$data['akses_user'] =  $this->setting_model->commonGet($option);
		$data['user_aktif'] =  $this->setting_model->commonGet($ct1);
	    $data['user_non'] =  $this->setting_model->commonGet($ct2);
		$this->load->view("admin/user_setting",$data);
	}

	public function list_user($keyword = '',$is_archive = '', $group_user_id = '' )
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

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tusers.user_name' => $keyword);
		}

		if($group_user_id == 0){
			$where_in = array('tusers.is_delete' => $is_archive);
		}else{
			$where_in = array('tusers.is_delete' => $is_archive,
							'tgroup_users.group_user_id' => $group_user_id);
		}
		$option1 = array(
			'select' => array(
								'tusers.User_id',
								'tusers.user_name',
								'tusers.user_pass',
								'tgroup_users.user_name as group_name'),
	    	'table' => 'tusers',
	    	'join' => array(
	    					'tgroup_users' => 'tgroup_users.group_user_id = tusers.group_user_id'
	    				),
	    	'where_in' => $where_in,
	    	'like' => $like
	    );
	    $option2 = array(
			'select' => array('count(tusers.User_id) as total'),
	    	'table' => 'tusers',
	    	'join' => array(
	    					'tgroup_users' => 'tgroup_users.group_user_id = tusers.group_user_id'),
	    	'where_in' => $where_in,
	    	'like' => $like
	    );
	   
		$data = array();
		$data['user'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);
		$this->load->view('admin/demo/user',$data);
	}
	public function action_user()
	{
		$id_user =$this->input->post('id_user');
		$name=$this->input->post('name');
		$pass=$this->input->post('pass');
		$status=$this->input->post('status');
		$akses=$this->input->post('akses');

		$chk_name = array('tusers.user_name' => $name);
		$is_name = $this->get_data_user($chk_name);
		$date = date('Y-m-d H:i:s');
		$user_right = '';
		if($this->input->post('type')==1){// insert
			if ($is_name == 1) {
				echo json_encode(array(
					"statusCode"=>405
				));
			}else{
				$option = array(
					'select' => array('tgroup_users.user_right'),
			    	'table' => 'tgroup_users',
			    	'where' => array('tgroup_users.group_user_id' => $akses)
			    );

				$data['get_data'] = $this->setting_model->commonGet($option);
				if( is_array($data['get_data']) ) {
				    foreach($data['get_data'] as $right) {
				    	$user_right = $right->user_right;
				    }
				}

				$insert = array(
					'insert' => array(
						'iUpload' => 1,
						'create_date' => $date,
						'pass_diskon' => $pass,
						'user_name' => $name,
						'user_pass' => $pass,
						'is_delete' => $status,
						'group_user_id' => $akses,
						'user_right' => $user_right),
					'table' => 'tusers'
				);

	        	$ns = $this->setting_model->commonInsert($insert);
	        	
	        	echo json_encode(array(
					"statusCode"=>200
				));
			}
		}elseif($this->input->post('type')==2) {//update
			$update = array(
					'update' => array(
						'pass_diskon' => $pass,
						'user_name' => $name,
						'user_pass' => $pass,
						'is_delete' => $status,
						'group_user_id' => $akses,
						'user_right' => $user_right),
					'table' => 'tusers',
					'where' => array(
						'tusers.User_id' => $id_user
					)
			);
        	$this->setting_model->commonUpdate($update);

			echo json_encode(array(
				"statusCode"=>201
			));
		}elseif($this->input->post('type')==3) {//delete

			 foreach($id_user as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1),
						'table' => 'tusers',
						'where' => array(
							'tusers.User_id' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}elseif($this->input->post('type')==4) {//arsip

			 foreach($id_akses as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1),
						'table' => 'tusers',
						'where' => array(
							'tusers.User_id' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}
	}
	public function get_edit_data_user()
	{
		$option = array(
			'select' => array(
								'tusers.User_id',
								'tusers.user_name',
								'tusers.user_pass',
								'tusers.is_delete',
								'tusers.group_user_id',
							),
	    	'table' => 'tusers',
	    	'where' => array(
							'tusers.User_id' => $this->input->post('id_user')
						)
	    );
	    
		$data['get_data'] = $this->setting_model->commonGet($option);
		if( is_array($data['get_data']) ) {
		    foreach($data['get_data'] as $right) {
		    	echo json_encode(array(
					"user_id" => $right->User_id,
					"user_name" => $right->user_name,
					"user_pass" => $right->user_pass,
					"status" => $right->is_delete,
					"group_user_id" => $right->group_user_id
				));
		    }
		}
		
		
	}

	public function get_data_user($kondisi = array())
	{
		$option = array(
			'select' => array('count(tusers.User_id) as hasil'),
	    	'table' => 'tusers',
	    	'where' => $kondisi
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);
		if( is_array($data['get_data']) ) {
		    foreach($data['get_data'] as $right) {
		    	$is_name = $right->hasil;
		    }
		}

		return $is_name;
	}

//FUNCTION MENU USER AKSES
	public function akses($keyword = '',$is_archive = '' )
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

		if($keyword=='none'){$keyword = '';}else{$keyword = str_replace("_"," ",$keyword);}
		$data = array();
		$data['keyw'] = $keyword;
		$data['is_arc'] = $chk;
		$this->load->view("admin/user_akses",$data);
	}
	
	public function list_akses($keyword = '',$is_archive = '')
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

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tgroup_users.user_name' => $keyword);
		}
		$option1 = array(
			'select' => array(
								'tgroup_users.group_user_id',
								'tgroup_users.user_name',
								'tgroup_users.is_Super',
								'tgroup_users.user_right',
							),
	    	'table' => 'tgroup_users',
	    	'where_in' => array(
							'tgroup_users.is_delete' => $is_archive,
						),
	    	'like' => $like
	    );
	    $option2 = array(
			'select' => array('count(tgroup_users.group_user_id) as total'),
	    	'table' => 'tgroup_users',
	    	'where_in' => array(
							'tgroup_users.is_delete' => $is_archive,
						),
	    	'like' => $like
	    );
		
		$data = array();
		$data['set'] = $this->setting_model->commonGet($option1);
		$data['tot'] = $this->setting_model->commonGet($option2);
		$this->load->view('admin/demo/akses',$data);
	}
	public function action_akses()
	{
		$id_akses =$this->input->post('id_akses');
		$name=$this->input->post('name');
		$is_super=$this->input->post('is_super');
		if($is_super !== 'true'){$is_super = '0';}else{$is_super = '1';}
		$user_right=$this->input->post('user_right');

		$chk_name = array('tgroup_users.user_name' => $name);
		$is_name = $this->get_data_akses($chk_name);
		
		if($this->input->post('type')==1){// insert
			if ($is_name == 1) {
				echo json_encode(array(
					"statusCode"=>405,
					"is_name"=>$is_name
				));
			}else{
				$insert = array(
						'insert' => array(
						'iUpload' => 1,
						'user_name' => $name,
						'user_right' => $user_right,
						'is_Super' => $is_super),
						'table' => 'tgroup_users'
				);
	        	$this->setting_model->commonInsert($insert);

				echo json_encode(array(
					"statusCode"=>200
				));
				
			}
		}elseif($this->input->post('type')==2) {//update
			$update = array(
					'update' => array(
						'user_name' => $name,
						'user_right' => $user_right,
						'is_Super' => $is_super),
					'table' => 'tgroup_users',
					'where' => array(
						'tgroup_users.is_delete' => 0,
						'tgroup_users.group_user_id' => $id_akses
					)
			);
        	$this->setting_model->commonUpdate($update);

			echo json_encode(array(
				"statusCode"=>201
			));
		}elseif($this->input->post('type')==3) {//delete
			$id_akses =$this->input->post('id_akses');

			 foreach($id_akses as $id){
				$update = array(
						'update' => array(
							'is_delete' => 1),
						'table' => 'tgroup_users',
						'where' => array(
							'tgroup_users.group_user_id' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}elseif($this->input->post('type')==4) {//arsip
			$id_akses = $this->input->post('id_akses');

			 foreach($id_akses as $id){
				$update = array(
						'update' => array(
							'is_archive' => 1),
						'table' => 'tgroup_users',
						'where' => array(
							'tgroup_users.group_user_id' => $id
						)
				);
	        	$this->setting_model->commonUpdate($update);
		     }
			echo json_encode(array(
				"statusCode"=>202
			));
		}
	}
	public function get_edit_data()
	{
		$option = array(
			'select' => array(
								'tgroup_users.group_user_id',
								'tgroup_users.user_name',
								'tgroup_users.is_Super',
								'tgroup_users.user_right',
							),
	    	'table' => 'tgroup_users',
	    	'where' => array(
							'tgroup_users.group_user_id' => $this->input->post('id_akses')
						)
	    );
	    
		$data['get_data'] = $this->setting_model->commonGet($option);
		if( is_array($data['get_data']) ) {
		    foreach($data['get_data'] as $right) {
		    	echo json_encode(array(
					"group_user_id" => $right->group_user_id,
					"user_name" => $right->user_name,
					"is_Super" => $right->is_Super,
					"user_right" => $right->user_right
				));
		    }
		}
		
		
	}
	public function get_user_right()
	{
		$option = array(
			'select' => array('tgroup_users.user_right'),
	    	'table' => 'tgroup_users',
	    	'where' => array('tgroup_users.group_user_id' => $this->input->post('id_akses'))
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);
		if( is_array($data['get_data']) ) {
		    foreach($data['get_data'] as $right) {
		    	echo json_encode(array(
					"user_right" => $right->user_right
				));
		    }
		}
	}
	public function get_data_akses($kondisi = array())
	{
		$option = array(
			'select' => array('count(tgroup_users.group_user_id) as hasil'),
	    	'table' => 'tgroup_users',
	    	'where' => $kondisi
	    );

		$data['get_data'] = $this->setting_model->commonGet($option);
		if( is_array($data['get_data']) ) {
		    foreach($data['get_data'] as $right) {
		    	$is_name = $right->hasil;
		    }
		}

		return $is_name;
	}

	public function print_user_pdf($keyword = '',$is_archive = '', $group_user_id = '' )
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

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tusers.user_name' => $keyword);
		}

		if($group_user_id == 0){
			$where_in = array('tusers.is_delete' => $is_archive);
		}else{
			$where_in = array('tusers.is_delete' => $is_archive,
							'tgroup_users.group_user_id' => $group_user_id);
		}
		$option1 = array(
			'select' => array(
								'tusers.User_id',
								'tusers.user_name',
								'tusers.user_pass',
								'tgroup_users.user_name as group_name'),
	    	'table' => 'tusers',
	    	'join' => array(
	    					'tgroup_users' => 'tgroup_users.group_user_id = tusers.group_user_id'
	    				),
	    	'where_in' => $where_in,
	    	'like' => $like
	    );
	    $option2 = array(
			'select' => array('count(tusers.User_id) as total'),
	    	'table' => 'tusers',
	    	'join' => array(
	    					'tgroup_users' => 'tgroup_users.group_user_id = tusers.group_user_id'),
	    	'where_in' => $where_in,
	    	'like' => $like
	    );
	   
		$data = array();
		$data['user'] = $this->setting_model->commonGet($option1);
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
		$pdf->Cell($tableWidth, 10, 'DAFTAR USER OHH_BAKERY', 0, 1, 'C');
		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell($tableWidth * 0.05, 6, 'No', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.35, 6, 'Username', 1, 0, 'C');
		$pdf->Cell($tableWidth * 0.60, 6, 'Akses', 1, 1, 'C');

		$pdf->SetFont('Arial', '', 8);

		$no = 0;
		foreach ($data['user'] as $br) {
		    $no++;
		    $pdf->Cell($tableWidth * 0.05, 6, $no, 1, 0, 'C');
		    $pdf->Cell($tableWidth * 0.35, 6, $br->user_name, 1, 0, 'L');
		    $pdf->Cell($tableWidth * 0.60, 6, $br->group_name, 1, 1, 'L');
		}

		$filename = 'user_'.$now.'.pdf';
		$pdf->Output($filename, 'I');
	}

	public function print_user_csv($keyword = '',$is_archive = '', $group_user_id = '' )
	{
		// file name 
		$filename = 'user_'.date('d-m-Y').'.csv'; 
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

		if($keyword == 'none' OR $keyword == ''){
			$like = '';
		}else{
			$keyword = str_replace("_"," ",$keyword);
			$like = array('tusers.user_name' => $keyword);
		}

		if($group_user_id == 0){
			$where_in = array('tusers.is_delete' => $is_archive);
		}else{
			$where_in = array('tusers.is_delete' => $is_archive,
							'tgroup_users.group_user_id' => $group_user_id);
		}
		$option1 = array(
			'select' => array('tusers.user_name',
								'tgroup_users.user_name as group_name'),
	    	'table' => 'tusers',
	    	'join' => array(
	    					'tgroup_users' => 'tgroup_users.group_user_id = tusers.group_user_id'
	    				),
	    	'where_in' => $where_in,
	    	'like' => $like
	    );
		
		$data = $this->setting_model->commonGet($option1);
		// file creation 
		$file = fopen('php://output', 'w');

		$header = array("Username", "Akses"); 
		fputcsv($file, $header);
		foreach ($data as $key){ 
			fputcsv($file,(array)$key); 
		}
		fclose($file); 
		exit; 
	}
}