<?php 
 
class Transaction_model extends CI_Model{
	var $current_db;

	public function __construct(){
	    parent::__construct();
	    $this->load->library('Db_manager');
	    $db = $this->session->userdata('db_active');
	    
		$hostname = $this->session->userdata('hostname');
		$port = $this->session->userdata('port');
		$username = $this->session->userdata('username');
		$password = $this->session->userdata('password');

		$this->current_db = $this->db_manager->get_connection($db,$hostname,$port,$username,$password);
	}
	
	
	public function insertImage($postData = array())
	{

		$filename = $postData['filename'];
		$url = $postData['url'];
		$prod_no = $postData['prod_no'];

		$name = explode(".",$filename);
		$multype = array(
			strtolower($name[0].'.jpg'),
			strtolower($name[0].'.png'),
			strtolower($name[0].'.jpeg'),
			strtolower($name[0].'.pdf')
		);
		
		if(isset($filename)){
          	$this->db->select('timg.id');
	  		$this->db->from('timg_product as timg');
     		$this->db->where_in('timg.filename',$multype);
     		$query = $this->db->get();

		    if($query->num_rows() > 0 )
		    {
		    	$row = $query->result();
		        foreach ($row as $ab) {
		        	$data = array(
			           'filename' => $filename,
			           'url' => $url,
			           'prod_no' => $prod_no
			        );
				    $this->db->where('id', $ab->id);
				    $this->db->update('timg_product', $data);
		        }
		    }else{
		    	$data = array(
			        'filename' => $filename,
			        'url' => $url,
			        'prod_no' => $prod_no
			     );
			    $this->db->insert('timg_product',$data);

		    }
			    return true;
        }
        return false;
        
	}
	public function deleteImage($postData = array())
	{

		$url = $postData['url'];
		$np = $postData['pur_no'];
		$tp = $postData['tp'];

		if(isset($url)){
			$this->db-> where('url', $url);
    		$this->db-> delete('app_supplier');
        }

        if($tp == 'pj'){
			$data = array(
				'is_fp' => 0,
			    'no_faktur_pajak' => '',
			    'tgl_faktur_pajak' => ''
			 );
	    	$array = array( 'pur_no' => $np);
			$this->db->where($array);
			$this->db->update('tpurchase', $data);
        }
        
	}
	public function get_image($ids, $person,$jns)
	{
		$multype = array(
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($ids))).'_'.str_replace(".","&",strval($person)).'.png'),
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($ids))).'_'.str_replace(".","&",strval($person)).'.jpg'),
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($ids))).'_'.str_replace(".","&",strval($person)).'.jpeg'),
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($ids))).'_'.str_replace(".","&",strval($person)).'.pdf')			
		);
		$this->db->select("timg.id,
							timg.filename,
							timg.url");
		$this->db->from('app_supplier as timg');
	    $this->db->where_in('LOWER(timg.filename)', $multype);

	    $query = $this->db->get();
	    
		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function usercdb()
	{
		$this->db->select("tus.id,
							tus.user_name,
							tus.user_pass");
		$this->db->from('tusers_supplier as tus');
	    $this->db->where('tus.id', 51);

	    $query = $this->db->get();
		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function insertNotif($postData = array())
	{

		$notif_date = date('Y-m-d H:i:s');

		$flnm = explode("_",$postData['filename']);
		$pur_no = $flnm[1];

		$sender_type = $this->session->userdata("role");
		if($sender_type == 1 ){
			$sender_id = $this->session->userdata("person_id");
        }elseif ($sender_type == 2) {
        	$prt = explode(".",$flnm[2]);
        	$sender_id = $prt[0];
        }
		
		if($sender_type == 1 ){
			$prt = explode(".",$flnm[2]);
			$receiver_id = $prt[0];
        	$receiver_type = 2;
        }elseif ($sender_type == 2) {
        	$receiver_id = '';
        	$receiver_type = 1;
        }

        if($flnm[0] == "RF"){
        	$type_notif = 1;
        }elseif ($flnm[0] == "PY") {
        	$type_notif = 2;
        }elseif ($flnm[0] == "NP") {
        	$type_notif = 3;
        }elseif ($flnm[0] == "PJ") {
        	$type_notif = 4;
        }

    	$data = array(
	        'pur_no' 		=> $pur_no,
	        'notif_date'	=> $notif_date,
	        'sender_id' 	=> $sender_id,
	        'sender_type'	=> $sender_type,
	        'receiver_id'	=> $receiver_id,
	        'receiver_type'	=> $receiver_type,
	        'notif_type'	=> $type_notif
	     );
	    $this->db->insert('app_notification',$data);
	}
	public function updatenotif($idg)
	{
    	$data = array(
		    'is_read' => 1
		 );
    	$array = array( 'id' => $idg);
		$this->db->where($array);
		$this->db->update('app_notification', $data);
	}
	public function shownotif($sts = ' ')
	{
		$role = $this->session->userdata("role");
        $person_id = $this->session->userdata("person_id");

		if($role == '2'){
			$this->db->select('tf.*, tp.person_name');
			$this->db->from('app_notification as tf');
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.receiver_id and tf.receiver_type = 2','left');
			$this->db->join('tperson as tp', 'tp.person_no = tu.person_no','left');
			$this->db->where('tu.person_no',$person_id);
			$this->db->where('tf.receiver_id <>','');
		}else{
			$this->db->select('tf.*,tp.person_name');
			$this->db->from('app_notification as tf');
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.sender_id','left');
			$this->db->join('tperson as tp', 'tp.person_no = tu.person_no','left');
			$this->db->where('tf.receiver_type', '1');
		}
		$this->db->order_by('tf.id', 'desc');
		if($sts <> 'all'){
			$this->db->limit(5);
		}

		$query = $this->db->get();

		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }

	   
	}
	public function shownotiflt($sts = ' ')
	{
		$role = $this->session->userdata("role");
        $person_id = $this->session->userdata("person_id");

		if($role == '2'){
			$this->db->select('tf.*, tp.person_name');
			$this->db->from('app_notification as tf');
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.receiver_id and tf.receiver_type = 2','left');
			$this->db->join('tperson as tp', 'tp.person_no = tu.person_no','left');
			$this->db->where('tu.person_no',$person_id);
			$this->db->where('tf.receiver_id <>','');
		}else{
			$this->db->select('tf.*,tp.person_name');
			$this->db->from('app_notification as tf');
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.sender_id','left');
			$this->db->join('tperson as tp', 'tp.person_no = tu.person_no','left');
			$this->db->where('tf.receiver_type', '1');
		}
		if ($sts <> '0') {
			$this->db->where('tf.notif_type', $sts);
		}
			
		$this->db->order_by('tf.id', 'desc');
		

		$query = $this->db->get();

		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }

	   
	}
	public function showunreadnotif()
	{
		$role = $this->session->userdata("role");
        $person_id = $this->session->userdata("person_id");

        $this->db->select('count(tf.id) as jml_notif');
		$this->db->from('app_notification as tf');
		if($role == '2'){
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.receiver_id and tf.receiver_type = 2','left');
			$this->db->where('tu.person_no',$person_id);
		}else{
			$this->db->where('tf.receiver_type', '1');
		}

		$this->db->where('tf.is_read',0);

		$query = $this->db->get();
		
		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	
}	