<?php 
 
class Setting_model extends CI_Model{	
	var $current_db;

	public function __construct(){
	    parent::__construct();
	    $this->load->library('Db_manager');
	    $db = $this->session->userdata('db_active');
	    if($this->session->userdata('status') == "login"){
			$hostname = $this->session->userdata('hostname');
			$port = $this->session->userdata('port');
			$username = $this->session->userdata('username');
			$password = $this->session->userdata('password');

		    $this->current_db = $this->db_manager->get_connection($db,$hostname,$port,$username,$password);
		}
	    
	}

	public function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	

	public function commonGet($options) {

        $select = false;
        $table = false;
        $join = false;
        $order = false;
        $limit = false;
        $offset = false;
        $where = false;
        $or_where = false;
        $single = false;
        $where_not_in = false;
        $where_in = false;
        $like = false;
        $group = false;
        $or_like = false;

        extract($options);

        if ($select != false)
            $this->db->select($select);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

        if ($or_where != false)
            $this->db->or_where($or_where);

        if ($where_not_in != false) {
            foreach ($where_not_in as $key => $value) {
                if (count($value) > 0)
                    $this->db->where_not_in($key, $value);
            }
        }

        if ($where_in != false) {
            foreach ($where_in as $key => $value) {
                if (count(array($value)) > 0)
                    $this->db->where_in($key, $value);
            }
        }

        if ($like != false && $or_like != false)
        $this->db->group_start();

        if ($like != false)
            $this->db->like($like,'both');
        if ($or_like != false)
            $this->db->or_like($or_like,'both');

        if ($like != false && $or_like != false)
        $this->db->group_end();

        if ($limit != false) {

            if (!is_array($limit)) {
                $this->db->limit($limit);
            } else {
                foreach ($limit as $limitval => $offset) {
                    $this->db->limit($limitval, $offset);
                }
            }
        }


        if ($order != false) {

            foreach ($order as $key => $value) {

                if (is_array($value)) {
                    foreach ($order as $orderby => $orderval) {
                        $this->db->order_by($orderby, $orderval);
                    }
                } else {
                    $this->db->order_by($key, $value);
                }
            }
        }

        if ($group != false)
            $this->db->group_by($group);

        if ($join != false) {

            foreach ($join as $key => $value) {

                if (is_array($value)) {

                    if (count($value) == 3) {
                        $this->db->join($value[0], $value[1], $value[2]);
                    } else {
                        foreach ($value as $key1 => $value1) {
                            $this->db->join($key1, $value1, 'left');
                        }
                    }
                } else {
                    $this->db->join($key, $value, 'left');
                }
            }
        }


        $query = $this->db->get();
        // print_r($query);
        // print_r($this->db->error());

        if ($single) {
            return $query->num_rows();
        }


        if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }else{
            return 'empty';
        }
    } 

    public function commonInsert($options){
        $insert = false;
        $table = false;

        extract($options);

        if ($insert != false && $table != false)
            $this->db->insert($table, $insert);
        
        $test = $this->db->error();
        // print_r($this->db->error());
        return $test;
    }

    public function commonUpdate($options){
        $update = false;
        $table = false;
        $where = false;

        extract($options);

        if ($where != false)
            $this->db->where($where);

        if ($update != false && $table != false)
            $this->db->update($table, $update);

        $test = $this->db->error();
        // print_r($this->db->error());

        return $test;

    }

    public function commonDelete($options){
        $table = false;
        $where = false;
        $where_not_in = false;

        extract($options);
        
        if ($where != false)
            $this->db->where($where);

        if ($where_not_in != false) {
            foreach ($where_not_in as $key => $value) {
                if (count($value) > 0)
                    $this->db->where_not_in($key, $value);
            }
        }

        if ($table != false)
            $this->db->delete($table);

        $test = $this->db->error();
        // print_r($this->db->error());

        return $test;
    }

	public function getData($select,$table,$where)
	{
		
		$this->db->select($select);
	  	$this->db->from($table);
	  	$this->db->where($where);

	  	$query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}

    public function GetNoIDMaster($Tgl='',$dpn='',$nm_field='',$Nm_table='',$CabNo='')
    {
        $date = '';
        
        $datetime = explode(" ",$Tgl);
        $date = strtotime($datetime[0]);

        $bulan = (int)date('m',$date);
        $tahun = (int)date('Y',$date);
        $hari = (int)date('d',$date);
        $tgl = $bulan.' : '.$tahun.' : '.$hari;
        $user_id = $this->session->userdata('person_id');
        $no_prefix = '';
        $jumlah = '';
        $kata = '';
        $tots = '';

        $select = array(
            'select' => array('total'),
            'table' => 'ttotal_id',
            'where' => array('nama' => $Nm_table.'_'.$CabNo,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'hari' => $hari)
        );

        $sc = $this->commonGet($select);

        if (is_array($sc) || is_object($sc)){
            foreach ($sc as $abc){
                $tots = $abc->total;
            }

            $update = array(
                    'update' => array(
                        'total' => $tots+1),
                    'table' => 'ttotal_id',
                    'where' => array('nama' => $Nm_table.'_'.$CabNo,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'hari' => $hari)
            );
            $this->commonUpdate($update);

            $jumlah = $tots+1;
        }else{
            $insert2 = array(
                'insert' => array(
                    'nama' => $Nm_table.'_'.$CabNo,
                    'total' => 1,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'hari' => $hari),
                'table' => 'ttotal_id'
            );
            $this->commonInsert($insert2);
            // print_r($insert2);

            $jumlah = 1;

        }

        $select2 = array(
            'select' => array('no_prefix'),
            'table' => 'tcat_gudang',
            'where' => array('cat_gud_no' => $CabNo,
                        'is_delete' => 0)
        );
        
        $sc2 = $this->commonGet($select2);
        if (is_array($sc2) || is_object($sc2)){
            foreach ($sc2 as $key2){
                if($key2->no_prefix <> ""){
                    $kata = $key2->no_prefix."-".$dpn.$tahun.$bulan.$hari.sprintf("%04d", $jumlah);
                }else{
                    $kata = $dpn.$tahun.$bulan.$hari.sprintf("%04d", $jumlah);
                }
            }
        }else{
            $kata = $dpn.$tahun.$bulan.sprintf("%04d", $jumlah);
        }
        
        return $kata;
    }

    public function getNoTgl($tgl) {
        $year = date('Y', strtotime($tgl));
        $month = date('m', strtotime($tgl));
        $day = date('d', strtotime($tgl));
        return substr($year, 2) . str_pad($month, 2, '0', STR_PAD_LEFT) . str_pad($day, 2, '0', STR_PAD_LEFT);
    }


    public function getNoJam($tgl) {
        $hour = date('H', strtotime($tgl));
        $minute = date('i', strtotime($tgl));
        $second = date('s', strtotime($tgl));

        return str_pad($hour, 2, '0', STR_PAD_LEFT) . str_pad($minute, 2, '0', STR_PAD_LEFT) . str_pad($second, 2, '0', STR_PAD_LEFT);
    }

    // public function GetNoIDField2($nm_field, $nm_table) {
    //     $noPrefix = '';
    //     $cabNo = $this->session->userdata('gud_no');

    //     $selpre = array(
    //         'select' => array('no_prefix'),
    //         'table' => 'tcat_gudang',
    //         'where' => array('cat_gud_no' => $cabNo,
    //                     'is_delete' => 0)
    //     );

    //     $sn = $this->commonGet($selpre);

    //     if(is_array($sn)|| is_object($sn)){
    //         foreach ($sn as $snkey) {
    //             $noPrefix = $snkey->no_prefix;
    //         }

    //     }

    //     $bulan = date('m');
    //     $tahun = date('Y');
    //     $hari = date('d');
    //     $jumlah = 0;

    //     $select = array(
    //         'select' => array('total'),
    //         'table' => 'ttotal_id',
    //         'where' => array('nama' => $nm_table.'_'.$noPrefix,
    //                     'bulan' => $bulan,
    //                     'tahun' => $tahun,
    //                     'hari' => $hari)
    //     );

    //     $sc= $this->commonGet($select);

    //     if (is_array($sc) || is_object($sc)){
    //         foreach ($sc as $abc){
    //             $tots = $abc->total;
    //         }

    //         $update = array(
    //                 'update' => array(
    //                     'total' => $tots+1),
    //                 'table' => 'ttotal_id',
    //                 'where' => array('nama' =>$nm_table.'_'.$noPrefix,
    //                     'bulan' => $bulan,
    //                     'tahun' => $tahun,
    //                     'hari' => $hari)
    //         );
    //         $this->commonUpdate($update);
    //     }else{
    //         $insert2 = array(
    //             'insert' => array(
    //                 'nama' => $nm_table.'_'.$noPrefix,
    //                 'total' => 1,
    //                 'bulan' => $bulan,
    //                 'tahun' => $tahun,
    //                 'hari' => $hari),
    //             'table' => 'ttotal_id'
    //         );
    //         $this->commonInsert($insert2);
    //         $jumlah = 1;
    //     }

    //     if ($noPrefix != '') {
    //         $kata = $noPrefix.'-'.getNoTgl(date('Y-m-d')).'-'.getNoJam(date('H:i:s')).'-'.sprintf('%04d', $jumlah);
    //     } else {
    //         $kata = 'ID-'.getNoTgl(date('Y-m-d')).'-'.getNoJam(date('H:i:s')).'-'.sprintf('%04d', $jumlah);
    //     }

    //     $selid = array(
    //         'select' => array('count('.$nm_field.') as hasil'),
    //         'table' => $nm_table,
    //         'where' =>array( $nm_field => $kata)
    //     );

    //     $sid = $this->setting_model->commonGet($selid);

    //     if (is_array($sid)||is_object($sid)) {
    //         foreach ($sid as $kid) {
    //             if ($kid->hasil > 0) {
    //                 $kata = $this->GetNoIDField2($nm_field, $nm_table);;
    //             }
    //         }
    //     }


    //     return $kata;
    // }
    public function GetNoIDField2($nm_field = '', $Nm_table = '')
    {
        $date = strtotime(date('Y-m-d'));
        $bulan = (int)date('m',$date);
        $tahun = (int)date('Y',$date);
        $hari = (int)date('d',$date);
        $tgl = $bulan.' : '.$tahun.' : '.$hari;

        $user_cab = $this->session->userdata('gud_no');

        $NoPrefix = "";
        $selpre = array(
            'select' => array('no_prefix'),
            'table' => 'tcat_gudang',
            'where' => array('cat_gud_no' => $user_cab,
                        'is_delete' => 0)
        );

        $sn = $this->commonGet($selpre);

        if(is_array($sn)|| is_object($sn)){
            foreach ($sn as $snkey) {
                $NoPrefix = $snkey->no_prefix;
            }

        }

        $select = array(
            'select' => array('total'),
            'table' => 'ttotal_id',
            'where' => array('nama' => $Nm_table.'_'.$NoPrefix,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'hari' => $hari)
        );

        $sc= $this->commonGet($select);

        if (is_array($sc) || is_object($sc)){
            foreach ($sc as $abc){
                $tots = $abc->total;
            }

            $update = array(
                    'update' => array(
                        'total' => $tots+1),
                    'table' => 'ttotal_id',
                    'where' => array('nama' => $Nm_table.'_'.$NoPrefix,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'hari' => $hari)
            );
            $this->commonUpdate($update);

            $jumlah= $tots +1;
        }else{
            $insert2 = array(
                'insert' => array(
                    'nama' => $Nm_table.'_'.$NoPrefix,
                    'total' => 1,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'hari' => $hari),
                'table' => 'ttotal_id'
            );
            $this->commonInsert($insert2);
            // print_r($insert2);
            $jumlah= 1;

        }

        // $select3 = array(
        //     'select' => array('total'),
        //     'table' => 'ttotal_id',
        //     'where' => array('nama' => $Nm_table.'_'.$NoPrefix,
        //                 'bulan' => $bulan,
        //                 'tahun' => $tahun,
        //                 'hari' => $hari)
        // );
        
        // $sc3 = $this->commonGet($select3);
        // if (is_array($sc3) || is_object($sc3)){
        //     foreach ($sc3 as $key3){
        //         $jumlah = $key3->total;
        //     }
        // }

        $vd = '';
        $orderdate = '';

        $vd = date("Y-m-d");
        $orderdate = explode('-', $vd);

        $year = substr($orderdate[0],-2);
        $month   = $orderdate[1];
        $date2  = $orderdate[2];

        $getDate = $year.$month.$date2;

        $vh = date("H:i:s");

        $orderhrs = explode(':', $vh);
        $hrs = $orderhrs[0];
        $mnt   = $orderhrs[1];
        $sc  = $orderhrs[2];

        $getTime = $hrs.$mnt.$sc;


        if($NoPrefix <> ''){
            $kata = $NoPrefix.'-'.$getDate.'-'.$getTime.'-'.sprintf("%04d", $jumlah);
        }else{
            $kata = 'ID-'.$getDate.'-'.$getTime.'-'.sprintf("%04d", $jumlah);
        }

        return $kata;

    }

    public function GetNoIDField($intgl='',$code='', $field='',$table='')
    {

        $date = '';

        if($intgl <> 'now'){
            $datetime = explode(" ",$intgl);
            $date = strtotime($datetime[0]);
            $hour = strtotime($datetime[1]);
        }else{
            $date = strtotime(date('Y-m-d'));
            $hour = strtotime(date('H:i:s')); 
        }

        $bulan = (int)date('m',$date);
        $tahun = (int)date('Y',$date);
        $hari = (int)date('d',$date);

        $jam = (int)date('H',$hour);
        $menit = (int)date('i',$hour);
        $detik = (int)date('s',$hour);

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
        $this->commonInsert($insert);

        $select = array(
            'select' => array('total'),
            'table' => 'ttotal_id',
            'where' => array('nama' => $table.'_'.$no_prefix,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'hari' => $hari)
        );

        $sc = $this->commonGet($select);

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
            $c = $this->commonUpdate($update);
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
            $this->commonInsert($insert2);

        }

        $select2 = array(
            'select' => array('total'),
            'table' => 'ttotal_id',
            'like' => array('nama' => $table.'_'.$no_prefix),
            'where' => array('bulan' => $bulan,
                        'tahun' => $tahun,
                        'hari' => $hari)
        );
        $sc2 = $this->commonGet($select2);
        foreach ($sc2 as $key){
            $jumlah = $key->total;
        }

        $vd = '';
        $orderdate = '';

        if($intgl <> 'now'){
            // $time = strtotime($intgl);
            $vd = $tahun.'-'.$bulan.'-'.$hari;
            
        }else{
            $vd = date("Y-m-d");
        }

        $orderdate = explode('-', $vd);    

        $year = substr($orderdate[0],-2);
        $month   = $orderdate[1];
        $date2  = $orderdate[2];

        $getDate = $year.$month.$date2;

        if($intgl <> 'now'){
            $vh = $jam.":".$menit.":".$detik;
        }else{
            $vh = date("H:i:s");
        }

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

    public function GetLastHarga($prod_no ='', $tgl = '')
    {
        $last = '';
        $select = array(
            'select' => array('saldo',
                            'prod_netto_price',
                            'last_prod_rata_price'),
            'table' => 'ttrans_hpp',
            'where' => array('prod_no' => $prod_no,
                            'tgl <' => $tgl.' 00:00:00')
        );

        $sc = $this->commonGet($select);

        if (is_array($sc) || is_object($sc)){
            foreach($sc as $right) {
                $last = $right->last_prod_rata_price;
            }
        }
        if($last <> ''){
            return $last;    
        }else{
            return 0;
        }
        
    }

    public function IsAllow2SellNew($GudNo='', $ProdNo='', $Qty2Sell= 0, $Tgl2Sell='', $IsBoleh2Sell='', $QtyMax=0, $posID = "", $QtyMax2Sell = 0)
    {
        // echo $GudNo."uuu".$ProdNo."uuu".$Qty2Sell."uuu".$Tgl2Sell."uuu";
        $IsAllow2SellNew = 0;
        $IsBoleh2Sell = 0;

        $MaxiQty = 0;
        $Max2Sell = 0;

        $select = array(
            'select' => array('id',
                            '(round(debet,5)-round(kredit,5)) as total'),
            'table' => 'ttrans',
            'where' => array('prod_no' => $ProdNo,
                            'gud_no' => $GudNo,
                            'tgl >' => $Tgl2Sell),
            'limit' => 1
        );

        $sc = $this->commonGet($select);

        if((!is_array($sc)) || (!is_object($sc))){
            
            $select2 = array(
                'select' => array('round(b.prod_on_hand,5) as onHand'),
                'table' => 'tdgproduct as b',
                'join' => array(
                        'tproduct as a' => 'a.prod_no = b.prod_no'),
                'where' => array('a.prod_no' => $ProdNo,
                                'b.gud_no' => $GudNo)
            );

            $sc2 = $this->commonGet($select2);

            if (is_array($sc2) || is_object($sc2)){
                foreach ($sc2 as $ph) {
                    $MaxiQty = $ph->onHand;
                }
            }

            $Max2Sell = $MaxiQty;

            if(($MaxiQty - $Qty2Sell) < 0){
                return array(
                    'QtyMax' => $MaxiQty,
                    'QtyMax2Sell' => $Max2Sell,
                    'IsAllow2SellNew' => 0,
                );
            }else{
                return array(
                    'QtyMax' => $MaxiQty,
                    'QtyMax2Sell' => $Max2Sell,
                    'IsAllow2SellNew' => 1,
                );
            }
        }else{
            foreach ($sc as $key) {
                $select3 = array(
                    'select' => array('id',
                                    '(round(debet,5)-round(kredit,5)) as total'),
                    'table' => 'ttrans',
                    'where' => array('prod_no' => $ProdNo,
                                    'gud_no' => $GudNo,
                                    'tgl >' => $tgl),
                    'order' => array('tgl' => 'ASC')
                );

                $sc3 = $this->commonGet($select3);

                $MaxiQty = 0;
                $Max2Sell = 0;

                $select4 = array(
                    'select' => array('round(a.prod_on_hand,5) as prod_on_hand'),
                    'table' => 'tdgproduct as a',
                    'join' => array(
                        'tproduct as b' => 'a.prod_no = b.prod_no'),
                    'where' => array('prod_no' => $ProdNo,
                                    'gud_no' => $GudNo)
                );

                $sc4 = $this->commonGet($select4);
                if (is_array($sc4) || is_object($sc4)){
                    return array(
                        'QtyMax' => $MaxiQty,
                        'QtyMax2Sell' => $Max2Sell,
                        'IsAllow2SellNew' => 1,
                    );
                }

                 $select5 = array(
                    'select' => array('prod_no',
                                    'sum(round(debet,5)-round(kredit,5)) as total'),
                    'table' => 'ttrans',
                    'where' => array('prod_no' => $ProdNo,
                                    'gud_no' => $GudNo,
                                    'concat(date_format(tgl,%Y-%m-%d %H:%i:%s"),".",lpad(id,6,"0"))>"' => $tgl.".".$posID),
                    'group' => 'prod_no'
                );

                $sc5 = $this->commonGet($select5);
                if (is_array($sc5) || is_object($sc5)){
                    foreach ($sc5 as $key5) {
                        $TotalCek = $TotalCek - (is_null($key5->total) ? 0 : $key5->total);
                        $MaxiQty = $MaxiQty - (is_null($key5->total) ? 0 : $key5->total);
                    }
                }

                $Max2Sell = $MaxiQty;
                $TotalCek = round(round($TotalCek, 5) - $Qty2Sell, 5);
                if($TotalCek < 0){
                    return array(
                        'QtyMax' => $MaxiQty,
                        'QtyMax2Sell' => $Max2Sell,
                        'IsAllow2SellNew' => 1,
                    );
                }

                $sc3 = $this->commonGet($select3);
                if (is_array($sc3) || is_object($sc3)){
                    foreach ($sc3 as $key3) {
                        $TotalCek = round($TotalCek + $key3->Total, 5);
                        if($TotalCek < 0 ){
                            return array(
                                'QtyMax' => $MaxiQty,
                                'QtyMax2Sell' => $Max2Sell,
                                'IsAllow2SellNew' => 1,
                            );
                        }
                        
                        $Max2Sell = round($Max2Sell + $key3->Total, 5);
                    }
                }
            }

        }

        $IsBoleh2Sell = 1;

    }

    public function check_stok($gud_no='', $prod_no ='', $tgl ='')
    {
            
        $query = $this->db->query("select xx.prod_no, 
                xx.prod_code0, 
                xx.prod_name0, 
                round(ifnull(Qty1,0) - ifnull(Qty2,0),5) as QtyData, 
                xx.prod_uom
            from tproduct xx
            left join (
                  select xa.prod_no, sum(xa.prod_on_hand) as Qty1
                  from tdgproduct xa left join tproduct xb on xa.prod_no = xb.prod_no
                    where xa.gud_no = '$gud_no'
                      and xa.prod_no = '$prod_no'
                      group by xa.prod_no
            ) xx1 on xx.prod_no = xx1.prod_no
            left join (
                  select xa.prod_no, sum(xa.debet - xa.kredit) as Qty2
                  from ttrans xa left join tproduct xb on xa.prod_no = xb.prod_no
                    where
                      xa.tgl > '$tgl'
                      and xa.gud_no = '' and xa.prod_no = '$prod_no'
                      group by xa.prod_no
            ) xx2 on xx.prod_no = xx2.prod_no
            where xx.prod_No = '$prod_no'
            ");
        
        if ( $query->num_rows() > 0 )
        {
            $row = $query->result();
            
            if (is_array($row) || is_object($row)) {
                foreach ($row as $key) {
                    if($key->QtyData > 0){
                        return array(
                            'QtyMax' => $key->QtyData,
                            'QtyMax2Sell' => $key->QtyData,
                            'IsAllow2SellNew' => 1,
                        );
                    }else{
                        return array(
                            'QtyMax' => 0,
                            'QtyMax2Sell' => 0,
                            'IsAllow2SellNew' => 0,
                        );
                    }
                }
            }
        }

        return array(
            'QtyMax' => 0,
            'QtyMax2Sell' => 0,
            'IsAllow2SellNew' => 0,
        );
    }

    public function HapusKoreksi($Prod_ID='', $TujuanDel = '')
    {
        $OutNo2Del = '';
        $JurNo = '';
        $now = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata('person_id');

        $sel = array(
            'select' => array('a.*', 
                            'f.gud_no',
                            'c.pr_date', 
                            'concat(d.prod_code0," - ",d.prod_name0) as nm_brg',
                            'e.gud_name', 
                            'f.prod_netto_price', 
                            'g.jur_no', 
                            'f.tgl', 
                            'f.id as id_trx', 
                            'lpad(f.id,6,"0") as posID'),
            'table' => 'tdetail_out a',
            'join' => array('td_produksi b' => 'a.det_sales_no = b.det_pr_no',
                            'tm_produksi c' => 'b.pr_no = c.pr_no',
                            'tproduct d' => 'a.prod_no = d.prod_no',
                            'tgudang e' => 'a.gud_no = e.gud_no',
                            'ttrans f' => 'a.out_det_no = f.out_det_no',
                            'tout g' => 'a.out_no = g.out_no'
                        ),
            'where' => array('c.pr_no' => $Prod_ID)
        );

        $sc = $this->commonGet($sel);

        if(is_array($sc) || is_object($sc)){
            foreach ($sc as $key) {
                $OutNo2Del = $key->out_no;
                $JurNo = $key->jur_no."";
                $HppTotal = 0;


                $JmlOld = 0;
                $PriceOld = 0;
                $NewPrice = 0;

                if($TujuanDel == 1){
                    if($key->out_det_qty < 0){
                        $is_allow = $this->IsAllow2SellNew($key->gud_no,$key->prod_no,($key->out_det_qty * -1), $key->tgl,'',$JmlOld,"",$key->posID);
                        if(is_array($is_allow)){
                            $is_boleh = $is_allow['IsAllow2SellNew'];

                            if($is_boleh <> 1){
                               $selrm = array(
                                    'select' => array('a.prod_name0', 'a.prod_code0'),
                                    'table' => 'tproduct a',
                                    'where' => array('a.prod_no' => $key->prod_no)
                                );

                                $srm = $this->commonGet($selrm);

                                if (is_array($srm) || is_object($srm)) {
                                    foreach ($srm as $rm) {
                                        $pCode = $rm->prod_code0;
                                        $pNAme = $rm->prod_name0;

                                        return array(
                                            "statusCode"=>301,
                                            "message" => "Stok persediaan kurang pada item ".$pCode." - ".$pName."."
                                        );
                                    }
                                }
                            }
                        }


                    }

                }

                $hapusttrans = $this->HapusTTrans($key->id_trx);

                if ($hapusttrans == 0) {
                    return 0;
                }

                if ($TujuanDel == 1) {
                     $updatehpp = $this->UpdateHppNew($key->prod_no, $key->tgl);

                    if ($updatehpp == 0) {
                        return 0;
                    }
                }
            }

        }

        $del1 = array(
            'table' => 'tdetail_out',
            'where' => array('out_no' => $OutNo2Del)
        );

        $d1 = $this->commonDelete($del1);

        $del2 = array(
            'table' => 'tout',
            'where' => array('out_no' => $OutNo2Del)
        );

        $d2 = $this->commonDelete($del2);

        $selrm = array(
            'select' => array('*'),
            'table' => 'tdjurnal',
            'where' => array('jur_no' => $JurNo)
        );

        $srm = $this->commonGet($selrm);

        if (is_array($srm) || is_object($srm)) {
            foreach ($srm as $rm) {
                $selrek = array(
                    'select' => array('saldo'),
                    'table' => 'trek',
                    'where' => array('rek_no' => $rm->rek_no)
                );

                $srek = $this->commonGet($selrek);

                if (is_array($srek)||is_object($srek)) {
                    foreach ($srek as $krek) {
                        if ($rm->kredit <> 0) {
                            $update = array(
                                'update' => array('saldo' => $krek->saldo + strval($rm->kredit)),
                                'table' => 'trek',
                                'where' => array('rek_no' => $rm->rek_no)
                            );

                            $up = $this->commonUpdate($update);
                        }else if ($rm->debet <> 0) {
                            $update = array(
                                'update' => array(
                                    'saldo' => $krek->saldo - strval($rm->debet)
                                ),
                                'table' => 'trek',
                                'where' => array('rek_no' => $rm->rek_no)
                            );

                            $up = $this->commonUpdate($update);
                        }
                    }
                }
                
            }
        }

        $del3 = array(
            'table' => 'tdjurnal',
            'where' => array('jur_no' => $JurNo)
        );

        $d3 = $this->commonDelete($del3);

        $del4 = array(
            'table' => 'tjurnal',
            'where' => array('jur_no' => $JurNo)
        );

        $d4 = $this->commonDelete($del4);

        if ($TujuanDel == 0) {
            $del5 = array(
                'table' => 'td_produksi',
                'where' => array('pr_no' => $Prod_ID)
            );

            $d5 = $this->commonDelete($del5);

            $del6 = array(
                'table' => 'tm_produksi',
                'where' => array('pr_no' => $Prod_ID)
            );

            $d6 = $this->commonDelete($del6);
        }else{
            $update = array(
                'update' => array(
                    'is_delete' => 1,
                    'user_delete' => $user_id,
                    'delete_Date' => $now

                ),
                'table' => 'tm_produksi',
                'where' => array('pr_no' => $Prod_ID)
            );

            $up = $this->commonUpdate($update);
        }

        return 1;

    }

    public function HapusKoreksiTrial($Prod_ID='', $TujuanDel = '')
    {
        $OutNo2Del = '';
        $JurNo = '';
        $now = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata('person_id');

        $del1 = array(
            'table' => 'tdetail_out',
            'where' => array('out_no' => $OutNo2Del)
        );

        $d1 = $this->commonDelete($del1);

        $del2 = array(
            'table' => 'tout',
            'where' => array('out_no' => $OutNo2Del)
        );

        $d2 = $this->commonDelete($del2);

        $selrm = array(
            'select' => array('*'),
            'table' => 'tdjurnal',
            'where' => array('jur_no' => $JurNo)
        );

        $srm = $this->commonGet($selrm);

        if (is_array($srm) || is_object($srm)) {
            foreach ($srm as $rm) {
                $selrek = array(
                    'select' => array('saldo'),
                    'table' => 'trek',
                    'where' => array('rek_no' => $rm->rek_no)
                );

                $srek = $this->commonGet($selrek);

                if (is_array($srek)||is_object($srek)) {
                    foreach ($srek as $krek) {
                        if ($rm->kredit <> 0) {
                            $update = array(
                                'update' => array('saldo' => $krek->saldo + strval($rm->kredit)),
                                'table' => 'trek',
                                'where' => array('rek_no' => $rm->rek_no)
                            );

                            $up = $this->commonUpdate($update);
                        }else if ($rm->debet <> 0) {
                            $update = array(
                                'update' => array(
                                    'saldo' => $krek->saldo - strval($rm->debet)
                                ),
                                'table' => 'trek',
                                'where' => array('rek_no' => $rm->rek_no)
                            );

                            $up = $this->commonUpdate($update);
                        }
                    }
                }
                
            }
        }

        $del3 = array(
            'table' => 'tdjurnal',
            'where' => array('jur_no' => $JurNo)
        );

        $d3 = $this->commonDelete($del3);

        $del4 = array(
            'table' => 'tjurnal',
            'where' => array('jur_no' => $JurNo)
        );

        $d4 = $this->commonDelete($del4);

        if ($TujuanDel == 0) {
            $del5 = array(
                'table' => 'td_produksi_trial',
                'where' => array('pr_no' => $Prod_ID)
            );

            $d5 = $this->commonDelete($del5);

            $del6 = array(
                'table' => 'tm_produksi_trial',
                'where' => array('pr_no' => $Prod_ID)
            );

            $d6 = $this->commonDelete($del6);
        }else{
            $update = array(
                'update' => array(
                    'is_delete' => 1,
                    'user_delete' => $user_id,
                    'delete_Date' => $now

                ),
                'table' => 'tm_produksi_trial',
                'where' => array('pr_no' => $Prod_ID)
            );

            $up = $this->commonUpdate($update);
        }

        return 1;

    }

    public function HapusTTrans($ID='')
    {
        $select = array(
            'select' => array('*'),
            'table' => 'ttrans',
            'where' => array('id' => $ID)
        );

        $sel = $this->commonGet($select);

        if (is_array($sel)||is_object($sel)) {
            foreach ($sel as $key) {

                $this->db->set('prod_on_hand', "prod_on_hand - ".strval($key->debet - $key->kredit), FALSE)
                         ->where('prod_no', $key->prod_no)
                         ->where('gud_no', $key->gud_no)
                         ->update('tdgproduct');
                if ($this->db->affected_rows() === 0) {
                    print_r("up 1 is error");
                    print_r($this->db->error());
                    die();
                }

                // $seltd = array(
                //     'select' => array('prod_on_hand'),
                //     'table' => 'tdgproduct',
                //     'where' => array(
                //         'prod_no' => $key->prod_no,
                //         'gud_no' => $key->gud_no
                //     )
                // );

                // $std = $this->commonGet($seltd);

                // if (is_array($std)||is_object($std)) {
                //     foreach ($std as $td) {
                //         $update = array(
                //             'update' => array(
                //                 'prod_on_hand' => $td->prod_on_hand - strval($key->debet-$key->kredit)
                //             ),
                //             'table' => 'tdgproduct',
                //             'where' => array(
                //                 'prod_no' => $key->prod_no,
                //                 'gud_no' => $key->gud_no
                //             )
                //         );

                //         $up = $this->commonUpdate($update);
                //     }
                // }

                $selrx = array(
                    'select' => array('*'),
                    'table' => 'ttrans_hpp',
                    'where' => array('id_hpp' => $key->id_hpp)
                );

                $srx = $this->commonGet($selrx);

                if (is_array($srx)||is_object($srx)) {
                    foreach ($srx as $rx) {

                        $this->db->set('prod_on_proses', "prod_on_proses - ".strval($key->debet - $key->kredit), FALSE)
                                 ->set('prod_on_hand', "prod_on_hand - ".strval($key->debet - $key->kredit), FALSE)
                                 ->set('prod_nilai_total', "prod_nilai_total - ".strval($key->debet - $key->kredit), FALSE)
                                 ->where('prod_no', $rx->prod_no)
                                 ->update('tproduct');
                        if ($this->db->affected_rows() === 0) {
                            print_r("up 2 is error");
                            print_r($this->db->error());
                            die();
                        }

                        // $seltd = array(
                        //     'select' => array('prod_on_proses','prod_on_hand','prod_nilai_total'),
                        //     'table' => 'tproduct',
                        //     'where' => array('prod_no' => $rx->prod_no)
                        // );

                        // $std = $this->commonGet($seltd);

                        // if (is_array($std)||is_object($std)) {
                        //     foreach ($std as $td) {
                        //         $update = array(
                        //             'update' => array(
                        //                 'prod_on_proses' => $td->prod_on_proses - strval($key->debet-$key->kredit),
                        //                 'prod_on_hand' => $td->prod_on_hand - strval($key->debet-$key->kredit),
                        //                 'prod_nilai_total' => $td->prod_nilai_total - strval($key->debet-$key->kredit)
                        //             ),
                        //             'table' => 'tdgproduct',
                        //             'where' => array(
                        //                 'prod_no' => $key->prod_no,
                        //                 'gud_no' => $key->gud_no
                        //             )
                        //         );

                        //         $up = $this->commonUpdate($update);
                        //     }
                        // }
                    }
                }

                $delete = array(
                    'table' => 'ttrans_hpp',
                    'where' => array('id' => $key->id)
                );

                $del = $this->commonDelete($delete);

            }
        }

        return 1;
    }

    public function isRekNoExists($RekNo='')
    {
        $is_exist = 0;
        $sel = array(
            'select' => array('rek_no'),
            'table' => 'trek',
            'where' => array('rek_no' => $RekNo,
                                'is_delete' => 0)
        );

        $sc = $this->commonGet($sel);

        if(is_array($sc) || is_object($sc)){
            foreach ($sc as $key) {
                $is_exist = 1;
            }
        }

        return $is_exist;
    }

    public function searchForId($id, $klm, $array)
    {
        foreach ($array as $abc) {
            foreach ($abc as $bnm) {
               if ($bnm[$klm] === $id) {
                   return 1;
               }
           }
        }
        return 0;
    }

    public function InsertTTrans($GudNo='',$ProdNo='',$Tgl='', $InDetNo='', $OutDetNo='',$Tambah =0, $Kurang=0,$TrType=0, $PriceNetto=0, $CabNo='')
    {
        $TglTrx = $Tgl;
        $TglSdhAda = 1;

        do{
           $sel = array(
                'select' => array('count(id) as jml'),
                'table' => 'ttrans',
                'where' => array('prod_no' => $ProdNo,
                                    'tgl' => $TglTrx),
                'group' => 'prod_no'
            );

            $sc = $this->commonGet($sel);

            if(is_array($sc) || is_object($sc)){
                foreach ($sc as $key) {
                    if($key->jml > 0){
                        $TglTrx = date('Y-m-d H:i:s',strtotime('+1 seconds', strtotime($TglTrx)));
                    }else{
                        $TglSdhAda = 1;
                    }
                }
            }else{
                $TglSdhAda = 0;
            } 
        }while($TglSdhAda == 1);

        $Id2Connectku = $this->GetNoIDField2("id_hpp", "ttrans");
        $Id2Connect = $Id2Connectku; 

        $intr = array(
            'insert' => array(
                'tgl' => $TglTrx, 
                'prod_no' => $ProdNo, 
                'in_det_no'=>$InDetNo, 
                'out_det_no'=>$OutDetNo,
                'debet'=>strval($Tambah), 
                'kredit'=>strval($Kurang), 
                'tran_type'=>strval($TrType), 
                'gud_no'=>$GudNo,
                'prod_netto_price'=>strval($PriceNetto), 
                'id_hpp'=>$Id2Connect, 
                'cab_no'=>$CabNo
            ),
            'table' => 'ttrans'
        );

        $itr = $this->setting_model->commonInsert($intr);

        if($itr['code'] <> 00000 ){print_r("itr is error");die();}

        $seltdg = array(
            'select' => array('id'),
            'table' => 'tdgproduct',
            'where' => array('prod_no' => $ProdNo,
                                'gud_no' => $GudNo),
            'group' => 'prod_no'
        );

        $stdg = $this->commonGet($seltdg);

        if(is_array($stdg) || is_object($stdg)){
            foreach ($stdg as $tgkey) {
                $TheID = $tgkey->id;
            }
        }else{
            $TheIDku = $this->GetNoIDField2("id", "tdgproduct");

            $TheID = $TheIDku;

            $instdg = array(
                'insert' => array(
                    'id' => $TheID, 
                    'prod_no' => $ProdNo, 
                    'gud_no'=>$GudNo, 
                    'prod_on_hand'=>0
                ),
                'table' => 'tdgproduct'
            );

            $itdg = $this->setting_model->commonInsert($instdg);

            if($itdg['code'] <> 00000 ){print_r("itdg  is error");die();}
        }

        $this->db->set('prod_on_hand', "prod_on_hand + ".strval(round($Tambah - $Kurang,5)), FALSE)
                 ->where('id', $TheID)
                 ->update('tdgproduct');
        if ($this->db->affected_rows() === 0) {
            print_r("tdg  is error");die();
        }

        // $selpoh = array(
        //     'select' => array('prod_on_hand'),
        //     'table' => 'tdgproduct',
        //     'where' => array(
        //                 'id' => $TheID)
        // );

        // $spoh = $this->commonGet($selpoh);

        // if(is_array($spoh) || is_object($spoh)){
        //     foreach ($spoh as $key) {
        //        $uptdg = array(
        //             'update' => array(
        //                 'prod_on_hand' => ($key->prod_on_hand) + strval(round($Tambah - $Kurang,5))
        //             ),
        //             'table' => 'tdgproduct',
        //             'where' => array(
        //                         'id' => $TheID)
        //         );

        //         $utdg = $this->setting_model->commonUpdate($uptdg);
        //     }
        // }

        // if ($utdg['code'] <> 00000 ) {
            
        //     die();
        // }

        if($TrType <> 13){
            $TglTrx = $Tgl;
            $TglSdhAda = 1;

            do{
                $sel = array(
                    'select' => array('count(id) as jml'),
                    'table' => 'ttrans_hpp',
                    'where' => array('prod_no' => $ProdNo,
                                        'tgl' => $TglTrx),
                    'group' => 'prod_no'
                );

                $sc = $this->commonGet($sel);

                if(is_array($sc) || is_object($sc)){
                    foreach ($sc as $key) {
                        if($key->jml > 0){
                            $TglTrx = date('Y-m-d H:i:s',strtotime('+1 seconds', strtotime($TglTrx)));
                        }else{
                            $TglSdhAda = 1;
                        }
                    }
                }else{
                    $TglSdhAda = 0;
                }
            }while($TglSdhAda == 1);
            
            $inth = array(
                'insert' => array(
                    'tgl' => $TglTrx, 
                    'prod_no' => $ProdNo, 
                    'in_det_no'=>$InDetNo, 
                    'out_det_no'=>$OutDetNo,
                    'debet'=>strval($Tambah), 
                    'kredit'=>strval($Kurang), 
                    'tran_type'=>strval($TrType), 
                    'gud_no'=>$GudNo,
                    'prod_netto_price'=>strval($PriceNetto), 
                    'id_hpp'=>$Id2Connect,
                    'entry_date' => date('Y-m-d H:i:s'),
                    'cab_no'=>$CabNo
                ),
                'table' => 'ttrans_hpp'
            );

            $ith = $this->setting_model->commonInsert($inth);

            if($ith['code'] <> 00000 ){print_r("ith  is error");die();}

            // if ($ith['code'] <> 00000 ) {
            //     print_r($inth);
            //     print_r($ith);
            //     die();
            // }

            $selpop = array(
                'select' => array('prod_on_proses'),
                'table' => 'tproduct',
                'where' => array('prod_no' => $ProdNo)
            );

            $spop = $this->commonGet($selpop);

            if(is_array($spop) || is_object($spop)){
                foreach ($spop as $kpop) {
                    $uptp = array(
                        'update' => array(
                            'prod_on_proses' => ($kpop->prod_on_proses) + strval(round($Tambah - $Kurang,5))
                        ),
                        'table' => 'tproduct',
                        'where' => array(
                                    'prod_no' => $ProdNo)
                    );

                    $utp = $this->setting_model->commonUpdate($uptp);

                    if($utp['code'] <> 00000 ){print_r("utp  is error");die();}
                }
            }
            

            // print_r($uptp);
            // print_r($utp);

            // if ($utp['code'] <> 00000 ) {
               
            //     die();
            // }

            $updatehpp = $this->UpdateHppNew($ProdNo, $TglTrx);

            if($updatehpp == 0){
                return 0;
            }

            return 1;
        }
    }

    public function UpdateHppNew($ProdNo='', $TglUpdate='', $IsProsesNext=1, $CabNo='')
    {
        $Pos2Proses = 0;

        $xProdUpdate = array();
        $TotalQtyPindah = 0;
        $TotalHppPindah = 0;

        $Diawal = 1;


        TeruskanKodeLain:
            $PriceOld = 0;
            $JmlOld = 0;

            $select = array(
                'select' => array('saldo', 'prod_netto_price', 'last_prod_rata_price'),
                'table' => 'ttrans_hpp',
                'where' => array('tgl <' => $TglUpdate),
                'order' => array('tgl' => 'DESC'),
                'limit' => 1
            );

            $sl = $this->commonGet($select);

            if(is_array($sl) || is_object($sl)){
                foreach ($sl as $slkey) {
                    $PriceOld = $slkey->last_prod_rata_price;
                    $JmlOld = $slkey->saldo;
                }
                
            }

            $TotalNilai = $PriceOld * $JmlOld;
            $LastHpp = $PriceOld;

            $select2 = array(
                'select' => array('a.*',
                                'b.out_det_buy_price',
                                'b.out_no',
                                'c.in_no',
                                'c.out_det_buy_price as harga_stok_opname', 
                                'd.is_stok', 
                                'e.in_tr_type'),
                'table' => 'ttrans_hpp a',
                'join' => array('tdetail_out b' => 'a.out_det_no = b.out_det_no',
                                'tdetail_in c' => 'a.in_det_no = c.in_det_no',
                                'tproduct d' => 'a.prod_no = d.prod_no',
                                'tin e' => 'c.in_no = e.in_no'),
                'where' => array('a.prod_no' => $ProdNo,
                                'a.tgl >=' => $TglUpdate),
                'order' => array('tgl'=> 'ASC')
            );

            $sl2 = $this->commonGet($select2);

            $PriceNew = 0;
            $JumNew = 0;
            
            $PAwal = 1;
            
            if(is_array($sl2) || is_object($sl2)){
                foreach ($sl2 as $sl2key) {
                    if($sl2key->tran_type == 1 || $sl2key->tran_type == 11){
                        $JumNew = $sl2key->debet;

                        $seltin = array(
                            'select' => array('price_netto'),
                            'table' => 'tdetail_in',
                            'where' => array('in_det_no' => $sl2key->in_det_no)
                        );

                        $stin = $this->commonGet($seltin);

                        if(is_array($stin) || is_object($stin)){
                            foreach ($stin as $stinkey) {
                                $PriceNew = $stinkey->price_netto;

                                if($PriceNew == 0){
                                    $seldin = array(
                                        'select' => array('tdetail_in.price_netto'),
                                        'table' => 'tdetail_in',
                                        'join' => array('tin' => 'tdetail_in.in_no = tin.in_no'),
                                        'where' => array('tin.is_delete' => 0,
                                                        'tin.in_type' => 1,
                                                        'tdetail_in.prod_no' => $ProdNo),
                                        'order' => array('in_date'=> 'desc'),
                                        'limit' => 1
                                    );

                                    $sld = $this->commonGet($seldin);
                                    if(is_array($sld) || is_object($sld)){
                                        foreach ($sld as $sldkey) {
                                            $PriceNew = $sldkey->price_netto;
                                        }
                                    }
                                }
                            }
                        }

                        $uphpp = array(
                            'update' => array('prod_netto_price' => strval(round($PriceNew, 5))),
                            'table' => 'ttrans_hpp',
                            'where' => array('in_det_no' => $sl2key->in_det_no)
                        );

                        $uhpp = $this->commonUpdate($uphpp);

                        if($uhpp['code'] <> 00000 ){print_r("uhpp  is error");die();}

                    }else if ($sl2key->tran_type == 4) {
                        $TotNew = 0;
                        $TotChange = 0;

                        $TheOutNo = $sl2key->in_no."";
                        $ThePrice = $sl2key->prod_netto_price;

                        $TotChange = $ThePrice * $sl2key->debet;
                        $JumNew = $sl2key->debet;
                        $PriceNew = $LastHpp;

                        $uptdin = array(
                            'update' => array('price_netto' => strval($PriceNew)),
                            'table' => 'tdetail_in',
                            'where' => array('in_det_no' => $sl2key->in_det_no)
                        );

                        $utdin = $this->commonUpdate($uptdin);

                        if($utdin['code'] <> 00000 ){print_r("utdin is error");die();}

                        $uptrh = array(
                            'update' => array('prod_netto_price' => strval(round($PriceNew, 5))),
                            'table' => 'ttrans_hpp',
                            'where' => array('in_det_no' => $sl2key->in_det_no)
                        );

                        $utrh = $this->commonUpdate($uptrh);

                        if($utrh['code'] <> 00000 ){print_r('utrh is error');die();}

                        $TotNew = $PriceNew * $sl2key->debet;
                        $JurNo = "";

                        $JurDetNo1 = "";
                        $JurDetNo2 = "";
                        $RekBrg = "";

                        $seldin = array(
                            'select' => array('jur_det_no1', 'jur_det_no2', 'rek_brg'),
                            'table' => 'tdetail_in',
                            'where' => array('in_det_no' => $sl2key->in_det_no)
                        );

                        $sld = $this->commonGet($seldin);
                        if(is_array($sld) || is_object($sld)){
                            foreach ($sld as $sldkey) {
                                $JurDetNo1 = $sldkeyjur_det_no1."";
                                $JurDetNo2 = $sldkeyjur_det_no2."";
                                $RekBrg = $sldkeyrek_brg."";
                            }
                        }

                        $JDebet = 0;
                        $JKredit = 0;

                        $seltj = array(
                            'select' => array('*'),
                            'table' => 'tdjurnal',
                            'where_in' => array('jur_det_no' => array($JurDetNo1,$JurDetNo2))
                        );

                        $sltj = $this->commonGet($seltj);

                        if(is_array($sltj) || is_object($sltj)){
                            foreach ($sltj as $sltjk) {
                                if ($sltjk->jur_det_no == $JurDetNo2) {

                                    $this->db->set('kredit', "kredit - ".strval($TotChange)." + ".strval($TotNew), FALSE)
                                             ->where('jur_det_no', $sltjk->jur_det_no)
                                             ->update('tdjurnal');
                                    if ($this->db->affected_rows() === 0) {
                                        print_r("1  is error");die();
                                    }

                                    // $seljur = array(
                                    //     'select' => array('kredit'),
                                    //     'table' => 'tdjurnal',
                                    //     'where' => array('jur_det_no' => $sltjk->jur_det_no)
                                    // );

                                    // $sjur = $this->commonGet($seljur);

                                    // if (is_array($sjur)||is_object($sjur)) {
                                    //     foreach ($sjur as $kjur) {
                                    //         $upkr = array(
                                    //             'update' => array('kredit' => $kjur->kredit - strval($TotChange) + strval($TotNew)),
                                    //             'table' => 'tdjurnal',
                                    //             'where' => array('jur_det_no' => $sltjk->jur_det_no)
                                    //         );

                                    //         $ukr = $this->commonUpdate($upkr);

                                    //         if($ukr['code'] <> 00000 ){print_r("ukr is error");die();}
                                    //     }
                                    // }

                                    $this->db->set('saldo', "saldo + ".strval($TotChange)." - ".strval($TotNew), FALSE)
                                             ->where('rek_no', $sltjk->rek_no)
                                             ->update('trek');
                                    if ($this->db->affected_rows() === 0) {
                                        print_r("2  is error");die();
                                    }
                                    
                                    // $selrek = array(
                                    //     'select' => array('saldo'),
                                    //     'table' => 'trek',
                                    //     'where' => array('rek_no' => $sltjk->rek_no)
                                    // );

                                    // $srek = $this->commonGet($selrek);

                                    // if (is_array($srek)||is_object($srek)) {
                                    //     foreach ($srek as $krek) {
                                    //         $uptr = array(
                                    //             'update' => array('saldo' => $krek->saldo + strval($TotChange) - strval($TotNew)),
                                    //             'table' => 'trek',
                                    //             'where' => array('rek_no' => $sltjk->rek_no)
                                    //         );

                                    //         $utr = $this->commonUpdate($uptr);

                                    //         if($utr['code'] <> 00000 ){print_r("utr is error");die();}
                                    //     }
                                    // }

                                    // $JKredit = $JKredit + $sltjk->kredit;

                                    $JKredit += $sltjk->kredit;
                                }

                                if ($sltjk->jur_det_no == $JurDetNo1) {

                                    // $seljur = array(
                                    //     'select' => array('debet'),
                                    //     'table' => 'tdjurnal',
                                    //     'where' => array('jur_det_no' => $sltjk->jur_det_no)
                                    // );

                                    // $sjur = $this->commonGet($seljur);

                                    // if (is_array($sjur)||is_object($sjur)) {
                                    //     foreach ($sjur as $kjur) {
                                    //         $upkr = array(
                                    //             'update' => array('debet' => $kjur->debet - strval($TotChange) + strval($TotNew)),
                                    //             'table' => 'tdjurnal',
                                    //             'where' => array('jur_det_no' => $sltjk->jur_det_no)
                                    //         );

                                    //         $ukr = $this->commonUpdate($upkr);

                                    //         if($ukr['code'] <> 00000 ){print_r("ukr is error");die();}
                                    //     }
                                    // }

                                    $this->db->set('debet', "debet - ".strval($TotChange)." + ".strval($TotNew), FALSE)
                                             ->where('jur_det_no', $sltjk->jur_det_no)
                                             ->update('tdjurnal');
                                    if ($this->db->affected_rows() === 0) {
                                        print_r("3  is error");die();
                                    }

                                    $this->db->set('saldo', "saldo - ".strval($TotChange)." + ".strval($TotNew), FALSE)
                                             ->where('rek_no', $sltjk->rek_no)
                                             ->update('trek');
                                    if ($this->db->affected_rows() === 0) {
                                        print_r("4  is error");die();
                                    }
                                    
                                    // $selrek = array(
                                    //     'select' => array('saldo'),
                                    //     'table' => 'trek',
                                    //     'where' => array('rek_no' => $sltjk->rek_no)
                                    // );

                                    // $srek = $this->commonGet($selrek);

                                    // if (is_array($srek)||is_object($srek)) {
                                    //     foreach ($srek as $krek) {
                                    //         $uptr = array(
                                    //             'update' => array('saldo' => $krek->saldo - strval($TotChange) + strval($TotNew)),
                                    //             'table' => 'trek',
                                    //             'where' => array('rek_no' => $sltjk->rek_no)
                                    //         );

                                    //         $utr = $this->commonUpdate($uptr);

                                    //         if($utr['code'] <> 00000 ){print_r("utr is error");die();}
                                    //     }
                                    // }

                                    $JDebet += $sltjk->debet;
                                }
                            }
                        }

                        if ($JDebet == 0 OR $JKredit == 0 OR (round($JDebet, 2) <> round($JKredit, 2)) OR abs(round($JDebet, 2)) <> abs(round($TotNew, 2))) {
                            
                            $NewValue = 0;

                            $selval = array(
                                'select' => array('sum((b.kredit-b.debet) * b.prod_netto_price) as value'),
                                'table' => 'tdetail_in a',
                                'join' => array('ttrans_hpp b', 'a.in_det_no = b.in_det_no'),
                                'where' => array('a.in_det_no' => $sl2key->in_det_no)
                            );

                            $slv = $this->commonGet($selval);
                            if(is_array($slv) || is_object($slv)){
                                foreach ($slv as $slvkey) {
                                    $NewValue = (is_null($slvkey->value) ? 0 : $slvkey->value);
                                }
                            }

                            $seltdjur = array(
                                'select' => array('*'),
                                'table' => 'tdjurnal',
                                'where_in' => array('jur_det_no' => array($JurDetNo1,$JurDetNo2))
                            );

                            $sltdj = $this->commonGet($seltdjur);
                            if(is_array($sltdj) || is_object($sltdj)){
                                foreach ($sltdj as $tdjkey) {

                                    $this->db->set('saldo', "saldo + ".$tdjkey->kredit." - ".$tdjkey->debet, FALSE)
                                             ->where('rek_no', $sltjk->rek_no)
                                             ->update('trek');
                                    if ($this->db->affected_rows() === 0) {
                                        print_r("5  is error");die();
                                    }

                                    // $selrek = array(
                                    //     'select' => array('saldo'),
                                    //     'table' => 'trek',
                                    //     'where' => array('rek_no' => $tdjkey->rek_no)
                                    // );

                                    // $srek = $this->commonGet($selrek);

                                    // if (is_array($srek)||is_object($srek)) {
                                    //     foreach ($srek as $krek) {
                                    //         $update = array(
                                    //                 'update' => array(
                                    //                     'saldo' => $krek->saldo + $tdjkey->kredit - $tdjkey->debet),
                                    //                 'table' => 'trek',
                                    //                 'where' => array('rek_no' => $tdjkey->rek_no)
                                    //         );

                                    //         $upsal = $this->setting_model->commonUpdate($update);

                                    //         if($upsal['code'] <> 00000 ){print_r("upsal is error");die();}
                                    //     }
                                    // }
                                }
                            }

                            $update = array(
                                    'update' => array(
                                        'debet' => 0,
                                        'kredit' => 0),
                                    'table' => 'tdjurnal',
                                    'where_in' => array('jur_det_no' => array($JurDetNo1, $JurDetNo2))
                            );
                           
                            $upsal = $this->setting_model->commonUpdate($update);

                            if($upsal['code'] <> 00000 ){print_r("upsal is error");die();}

                            $seltdjur = array(
                                'select' => array('*'),
                                'table' => 'tdjurnal',
                                'where_in' => array('jur_det_no' => array($JurDetNo1,$JurDetNo2))
                            );

                            $sltdj = $this->commonGet($seltdjur);
                            if(is_array($sltdj) || is_object($sltdj)){
                                foreach ($sltdj as $tdjkey) {
                                    if($tdjkey->rek_no == $RekBrg && $tdjkey->jur_det_no == $JurDetNo1){

                                        $uptdj = array(
                                                'update' => array('debet' => ($NewValue*-1)),
                                                'table' => 'tdjurnal',
                                                'where' => array('jur_det_no' => $tdjkey->jur_det_no)
                                        );
                                       
                                        $utdj = $this->setting_model->commonUpdate($uptdj);

                                        if($utdj['code'] <> 00000 ){print_r("utdj is error");die();}

                                        $this->db->set('saldo', "saldo - ".$NewValue, FALSE)
                                                 ->where('rek_no', $RekBrg)
                                                 ->update('trek');
                                        if ($this->db->affected_rows() === 0) {
                                            print_r("6  is error");die();
                                        }

                                        // $selrek = array(
                                        //     'select' => array('saldo'),
                                        //     'table' => 'trek',
                                        //     'where' => array('rek_no' => $RekBrg)
                                        // );

                                        // $srek = $this->commonGet($selrek);

                                        // if (is_array($srek)||is_object($srek)) {
                                        //     foreach ($srek as $krek) {
                                        //         $uptrek = array(
                                        //                 'update' => array('saldo' => $krek->saldo - $NewValue),
                                        //                 'table' => 'trek',
                                        //                 'where' => array('rek_no' => $RekBrg)
                                        //         );
                                               
                                        //         $utr = $this->setting_model->commonUpdate($uptrek);

                                        //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                        //     }
                                        // }

                                    }else{
                                        $uptdj = array(
                                                'update' => array('kredit' => ($NewValue*-1)),
                                                'table' => 'tdjurnal',
                                                'where' => array('jur_det_no' => $tdjkey->jur_det_no)
                                        );
                                       
                                        $utdj = $this->setting_model->commonUpdate($uptdj);

                                        if($utdj['code'] <> 00000 ){echo $utdj;die();}

                                        $this->db->set('saldo', "saldo + ".$NewValue, FALSE)
                                                 ->where('rek_no', $RekBrg)
                                                 ->update('trek');
                                        if ($this->db->affected_rows() === 0) {
                                            print_r("7  is error");die();
                                        }

                                        // $selrek = array(
                                        //     'select' => array('saldo'),
                                        //     'table' => 'trek',
                                        //     'where' => array('rek_no' => $RekBrg)
                                        // );

                                        // $srek = $this->commonGet($selrek);

                                        // if (is_array($srek)||is_object($srek)) {
                                        //     foreach ($srek as $krek) {
                                        //         $uptrek = array(
                                        //                 'update' => array('saldo' => $krek->saldo + $NewValue),
                                        //                 'table' => 'trek',
                                        //                 'where' => array('rek_no' => $RekBrg)
                                        //         );
                                               
                                        //         $utr = $this->setting_model->commonUpdate($uptrek);

                                        //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                        //     }
                                        // }
                                    }
                                }
                            }
                        }
                    }else if($sl2key->tran_type == 2 OR $sl2key->tran_type == 3 OR $sl2key->tran_type == 7 OR $sl2key->tran_type == 9 OR $sl2key->tran_type == 17 OR $sl2key->tran_type == 71 OR $sl2key->tran_type == 10){

                        $DiProses = 0;
                        if($sl2key->kredit < 0 AND $sl2key->tran_type == 7 ){
                            $DiProses = 0;
                        }else{
                            $DiProses = 1;
                        }

                        if($DiProses == 1){
                            $TotNew = 0;
                            $TotChange = 0;

                            $TheOutNo = $sl2key->out_no.'';
                            $ThePrice = $sl2key->prod_netto_price;
            
                            $TotChange = $ThePrice * $sl2key->kredit;
                            
                            $JumNew = $sl2key->kredit * -1;
                            $PriceNew = $LastHpp;

                            if ($sl2key->tran_type == 17) {
                                $PriceNew = $LastHpp;
                            }

                            $uptdout = array(
                                'update' => array('out_det_buy_price' => strval(round($PriceNew, 5))),
                                'table' => 'tdetail_out',
                                'where' => array('out_det_no' => $sl2key->out_det_no)
                            );

                            $utdo = $this->commonUpdate($uptdout);

                            if($utdo['code'] <> 00000 ){echo $utdo;die();}

                            $uptrans = array(
                                'update' => array('prod_netto_price' => strval(round($PriceNew, 5))),
                                'table' => 'ttrans_hpp',
                                'where' => array('out_det_no' => $sl2key->out_det_no)
                            );

                            $utr = $this->commonUpdate($uptrans);

                            if($utr['code'] <> 00000 ){echo $utr;die();}

                            $TotNew = $PriceNew * $sl2key->kredit;
                            $JurNo = "";

                            $seltdout = array(
                                'select' => array('jur_det_no1', 'jur_det_no2', 'rek_brg'),
                                'table' => 'tdetail_out',
                                'where' => array('out_det_no' => $sl2key->out_det_no)
                            );

                            $stdo = $this->commonGet($seltdout);

                            if (is_array($stdo)||is_subject($stdo)) {
                                foreach ($stdo as $tdokey) {
                                    $JurDetNo1 = $tdokey->jur_det_no1.'';
                                    $JurDetNo2 = $tdokey->jur_det_no2.'';
                                    $RekBrg = $tdokey->rek_brg.'';
                                }
                            }else{
                                $JurDetNo1 = "";
                                $JurDetNo2 = "";
                                $RekBrg = "";
                            }

                            $seljur = array(
                                'select' => array('*'),
                                'table' => 'tdjurnal',
                                'where_in' => array('jur_det_no' => array($JurDetNo1,$JurDetNo2))
                            );

                            $slj = $this->commonGet($seljur);

                            $JDebet = 0;
                            $JKredit = 0;

                            if (is_array($slj)||is_object($slj)) {
                                foreach ($slj as $sljkey) {
                                    if ($sljkey->jur_det_no == $JurDetNo1) {

                                        $this->db->set('kredit', "kredit - ".strval($TotChange)." + ".strval($TotNew), FALSE)
                                                 ->where('jur_det_no', $sljkey->jur_det_no)
                                                 ->update('tdjurnal');
                                        if ($this->db->affected_rows() === 0) {
                                            $error = $this->db->error();
                                            if($error['code'] <> 00000){
                                                print_r("8  is error");
                                                die();
                                            }
                                            
                                        }

                                        $this->db->set('saldo', "saldo + ".strval($TotChange)." - ".strval($TotNew), FALSE)
                                                 ->where('rek_no', $sljkey->jur_det_no)
                                                 ->update('trek');
                                        if ($this->db->affected_rows() === 0) {
                                            $error = $this->db->error();
                                            if($error['code'] <> 00000){
                                                print_r("9  is error");
                                                die();
                                            }

                                        }

                                        $JKredit += $sljkey->kredit;
                                        
                                        // $seljur = array(
                                        //     'select' => array('kredit'),
                                        //     'table' => 'tdjurnal',
                                        //     'where' => array('jur_det_no' => $sljkey->jur_det_no)
                                        // );

                                        // $sjur = $this->commonGet($seljur);

                                        // if (is_array($sjur)||is_object($sjur)) {
                                        //     foreach ($sjur as $kjur) {
                                        //         $upkr = array(
                                        //             'update' => array('kredit' =>  $kjur->kredit - strval($TotChange) + strval($TotNew)),
                                        //             'table' => 'tdjurnal',
                                        //             'where' => array('jur_det_no' => $sljkey->jur_det_no)
                                        //         );

                                        //         $ukr = $this->commonUpdate($upkr);

                                        //         if($ukr['code'] <> 00000 ){echo $ukr;die();}
                                        //     }
                                        // }
                                        
                                        // $selrek = array(
                                        //     'select' => array('saldo'),
                                        //     'table' => 'trek',
                                        //     'where' => array('rek_no' => $sljkey->rek_no)
                                        // );

                                        // $srek = $this->commonGet($selrek);

                                        // if (is_array($srek)||is_object($srek)) {
                                        //     foreach ($srek as $krek) {
                                        //         $uptr = array(
                                        //             'update' => array('saldo' => $krek->saldo + strval($TotChange) - strval($TotNew)),
                                        //             'table' => 'trek',
                                        //             'where' => array('rek_no' => $sljkey->rek_no)
                                        //         );

                                        //         $utr = $this->commonUpdate($uptr);

                                        //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                        //     }
                                        // }

                                        // $JKredit = $JKredit + $sljkey->kredit;
                                    }

                                    if ($sljkey->jur_det_no == $JurDetNo2) {

                                        $this->db->set('debet', "debet - ".strval($TotChange)." + ".strval($TotNew), FALSE)
                                                 ->where('jur_det_no', $sljkey->jur_det_no)
                                                 ->update('tdjurnal');
                                        if ($this->db->affected_rows() === 0) {
                                            $error = $this->db->error();
                                            if($error['code'] <> 00000){
                                                print_r("10  is error");
                                                die();
                                            }
                                            
                                        }

                                        $this->db->set('saldo', "saldo - ".strval($TotChange)." + ".strval($TotNew), FALSE)
                                                 ->where('rek_no', $sljkey->jur_det_no)
                                                 ->update('trek');
                                        if ($this->db->affected_rows() === 0) {
                                            $error = $this->db->error();
                                            if($error['code'] <> 00000){
                                                print_r("11  is error");
                                                die();
                                            }
                                        }

                                        $JDebet +=  $sljkey->debet;

                                        // $seljur = array(
                                        //     'select' => array('debet'),
                                        //     'table' => 'tdjurnal',
                                        //     'where' => array('jur_det_no' => $sljkey->jur_det_no)
                                        // );

                                        // $sjur = $this->commonGet($seljur);

                                        // if (is_array($sjur)||is_object($sjur)) {
                                        //     foreach ($sjur as $kjur) {
                                        //         $upkr = array(
                                        //             'update' => array('debet' => $kjur->debet - strval($TotChange) + strval($TotNew)),
                                        //             'table' => 'tdjurnal',
                                        //             'where' => array('jur_det_no' => $sljkey->jur_det_no)
                                        //         );

                                        //         $ukr = $this->commonUpdate($upkr);

                                        //         if($ukr['code'] <> 00000 ){echo $ukr;die();}
                                        //     }
                                        // }
                                        
                                        // $selrek = array(
                                        //     'select' => array('saldo'),
                                        //     'table' => 'trek',
                                        //     'where' => array('rek_no' => $sljkey->rek_no)
                                        // );

                                        // $srek = $this->commonGet($selrek);

                                        // if (is_array($srek)||is_object($srek)) {
                                        //     foreach ($srek as $krek) {
                                        //         $uptr = array(
                                        //             'update' => array('saldo' => $krek->saldo - strval($TotChange) + strval($TotNew)),
                                        //             'table' => 'trek',
                                        //             'where' => array('rek_no' => $sljkey->rek_no)
                                        //         );

                                        //         $utr = $this->commonUpdate($uptr);

                                        //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                        //     }
                                        // }

                                        // $JDebet = $JDebet + $sljkey->debet;
                                    }
                                }
                            }

                            if($JDebet = 0 Or $JKredit = 0 Or (round($JDebet, 2) <> round($JKredit, 2)) Or abs(round($JDebet, 2)) <> abs(round($TotNew, 2))){
                                $NewValue = 0;

                                $seltdout = array(
                                    'select' => array('sum((b.kredit-b.debet) * b.prod_netto_price) as value'),
                                    'table' => 'tdetail_out a',
                                    'join' => array('ttrans_hpp b' => 'a.out_det_no = b.out_det_no'),
                                    'where' => array('a.out_det_no' => $sl2key->out_det_no)
                                );

                                $stdo = $this->commonGet($seltdout);

                                if (is_array($stdo)||is_object($stdo)) {
                                    foreach ($stdo as $tdokey) {
                                        $NewValue = (is_null($tdokey->value) ? 0 : $tdokey->value);
                                    }
                                }

                                $seltdj = array(
                                    'select' => array('*'),
                                    'table' => 'tdjurnal',
                                    'where_in' => array('jur_det_no' => array($JurDetNo1,$JurDetNo2))
                                );

                                $stj = $this->commonGet($seltdj);

                                if (is_array($stj)||is_object($stj)) {
                                    foreach ($stj as $stjkey) {

                                        $this->db->set('saldo', "saldo + ".strval($TotChange)." - ".strval($TotNew), FALSE)
                                                 ->where('rek_no', $stjkey->rek_no)
                                                 ->update('trek');
                                        if ($this->db->affected_rows() === 0) {
                                            $error = $this->db->error();
                                            if($error['code'] <> 00000){
                                                print_r("12  is error");
                                                die();
                                            }
                                        }

                                        // $selrek = array(
                                        //     'select' => array('saldo'),
                                        //     'table' => 'trek',
                                        //     'where' => array('rek_no' => $stjkey->rek_no)
                                        // );

                                        // $srek = $this->commonGet($selrek);

                                        // if (is_array($srek)||is_object($srek)) {
                                        //     foreach ($srek as $krek) {
                                        //         $uptr = array(
                                        //             'update' => array('saldo' => $krek->saldo + strval($stjkey->kredit) - strval($stjkey->debet)),
                                        //             'table' => 'trek',
                                        //             'where' => array('rek_no' => $stjkey->rek_no)
                                        //         );

                                        //         $utr = $this->commonUpdate($uptr);

                                        //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                        //     }
                                        // }
                                        
                                    }
                                }

                                $uptj = array(
                                    'update' => array('debet' => 0,
                                                        'kredit' => 0),
                                    'table' => 'tdjurnal',
                                    'where_in' => array('jur_det_no' => array($JurDetNo1, $JurDetNo2))
                                );

                                $utj = $this->commonUpdate($uptj);

                                if($utj['code'] <> 00000 ){echo $utj;die();}

                                $seltdj = array(
                                    'select' => array('*'),
                                    'table' => 'tdjurnal',
                                    'where_in' => array('jur_det_no' => array($JurDetNo1,$JurDetNo2))
                                );

                                $stj = $this->commonGet($seltdj);

                                if (is_array($stj)||is_object($stj)) {
                                    foreach ($stj as $stjkey) {
                                        if ($stjkey->rek_no == $RekBrg AND $stjkey->jur_det_no == $JurDetNo1) {
                                            $upkr = array(
                                                'update' => array('kredit' => strval($NewValue)),
                                                'table' => 'tdjurnal',
                                                'where' => array('jur_det_no' => $stjkey->jur_det_no)
                                            );

                                            $ukr = $this->commonUpdate($upkr);

                                            if($ukr['code'] <> 00000 ){echo $ukr;die();}

                                            $this->db->set('saldo', "saldo - ".strval($NewValue), FALSE)
                                                     ->where('rek_no', $stjkey->rek_no)
                                                     ->update('trek');
                                            if ($this->db->affected_rows() === 0) {
                                                $error = $this->db->error();
                                                if($error['code'] <> 00000){
                                                    print_r("13  is error");
                                                    die();
                                                }
                                            }

                                            // $selrek = array(
                                            //     'select' => array('saldo'),
                                            //     'table' => 'trek',
                                            //     'where' => array('rek_no' => $stjkey->rek_no)
                                            // );

                                            // $srek = $this->commonGet($selrek);

                                            // if (is_array($srek)||is_object($srek)) {
                                            //     foreach ($srek as $krek) {
                                            //         $uptr = array(
                                            //             'update' => array('saldo' => $krek->saldo - strval($NewValue)),
                                            //             'table' => 'trek',
                                            //             'where' => array('rek_no' => $stjkey->rek_no)
                                            //         );

                                            //         $utr = $this->commonUpdate($uptr);

                                            //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                            //     }
                                            // }
                                            
                                        }else{
                                            $upkr = array(
                                                'update' => array('debet' => strval($NewValue)),
                                                'table' => 'tdjurnal',
                                                'where' => array('jur_det_no' => $stjkey->jur_det_no)
                                            );

                                            $ukr = $this->commonUpdate($upkr);

                                            if($ukr['code'] <> 00000 ){echo $ukr;die();}

                                            $this->db->set('saldo', "saldo + ".strval($NewValue), FALSE)
                                                     ->where('rek_no', $stjkey->rek_no)
                                                     ->update('trek');
                                            if ($this->db->affected_rows() === 0) {
                                                $error = $this->db->error();
                                                if($error['code'] <> 00000){
                                                    print_r("14  is error");
                                                    die();
                                                }
                                            }

                                            // $selrek = array(
                                            //     'select' => array('saldo'),
                                            //     'table' => 'trek',
                                            //     'where' => array('rek_no' => $stjkey->rek_no)
                                            // );

                                            // $srek = $this->commonGet($selrek);

                                            // if (is_array($srek)||is_object($srek)) {
                                            //     foreach ($srek as $krek) {
                                            //         $uptr = array(
                                            //             'update' => array('saldo' => $krek->saldo + strval($NewValue)),
                                            //             'table' => 'trek',
                                            //             'where' => array('rek_no' => $stjkey->rek_no)
                                            //         );

                                            //         $utr = $this->commonUpdate($uptr);

                                            //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                            //     }
                                            // }
                                            
                                        }
                                    }
                                }

                            }

                            if ($sl2key->tran_type == 7) {
                                $selthpp = array(
                                    'select' => array('x.out_det_no', 
                                        'prod_netto_price', 
                                        'kredit'),
                                    'table'=> 'ttrans_hpp x',
                                    'join'=> array('tdetail_out b' => 'x.out_det_no = b.out_det_no',
                                                    'td_produksi a' => 'a.det_pr_no = b.det_sales_no'),
                                    'where'=> array('b.out_no' => $TheOutNo,
                                                    'a.jenis_brg<>' => 2)
                                );

                                $sthpp = $this->commonGet($selthpp);
                                $JumTrx = 0;

                                if (is_array($sthpp)||is_object($sthpp)) {
                                    foreach ($sthpp as $hppkey) {
                                        if ($hppkey->out_det_no == $sl2key->out_det_no) {
                                            $JumTrx = $JumTrx + (is_null($hppkey->kredit) ? 0 : $hppkey->kredit) * $PriceNew;
                                        }else{
                                            $JumTrx = $JumTrx + ((is_null($hppkey->kredit) ? 0 : $hppkey->kredit) * (is_null($hppkey->prod_netto_price) ? 0 : $hppkey->prod_netto_price));
                                        }
                                    }
                                }

                                $QtyTrxnya = 0;

                                $selrxd = array(
                                    'select' => array('sum(x.kredit * -1) as value'),
                                    'table'=> 'ttrans_hpp x',
                                    'join'=> array('tdetail_out b' => 'x.out_det_no = b.out_det_no',
                                                    'td_produksi a' => 'a.det_pr_no = b.det_sales_no'),
                                    'where'=> array('b.out_no' => $TheOutNo,
                                                    'a.jenis_brg' => 2)
                                );

                                $srxd = $this->commonGet($selrxd);

                                if (is_array($srxd)||is_object($srxd)) {
                                    foreach ($srxd as $rxd) {
                                        $QtyTrxnya = (is_null($rxd->value) ? 0 : $rxd->value);
                                    }
                                }

                                if ($QtyTrxnya == 0) {
                                    $selrxd = array(
                                        'select' => array('sum(x.kredit * -1) as value'),
                                        'table'=> 'ttrans_hpp x',
                                        'join'=> array('tdetail_out b' => 'x.out_det_no = b.out_det_no',
                                                        'td_produksi a' => 'a.det_pr_no = b.det_sales_no'),
                                        'where'=> array('b.out_no' => $TheOutNo,
                                                        'a.jenis_brg' => 1)
                                    );

                                    $srxd = $this->commonGet($selrxd);

                                    if(is_array($srxd)||is_object($srxd)) {
                                        foreach ($srxd as $rxd) {
                                            $QtyTrxnya = (is_null($rxd->value) ? 0 : $rxd->value);
                                        }
                                    }
                                }

                                if ($QtyTrxnya <> 0) {
                                    $HargaperTrx = $JumTrx / $QtyTrxnya;
                                }

                                $selrdd = array(
                                    'select' => array('a.prod_no', 
                                                    'c.prod_code0', 
                                                    'c.prod_nilai_total', 
                                                    'b.out_det_no',
                                                    '(b.out_det_qty * -1) as tot_qty', 
                                                    'b.jur_det_no1', 
                                                    'b.jur_det_no2'),
                                    'table'=> 'td_produksi a',
                                    'join'=> array('tdetail_out b' => 'a.det_pr_no = b.det_sales_no',
                                                    'tproduct c' => 'a.prod_no = c.prod_no'),
                                    'where'=> array('b.out_no' => $TheOutNo,
                                                    'a.jenis_brg' => 2)
                                );

                                $srdd = $this->commonGet($selrdd);

                                if (!is_array($srdd)||!is_object($srdd)) {
                                    $selrdd = array(
                                        'select' => array('a.prod_no', 
                                                        'c.prod_code0', 
                                                        'c.prod_nilai_total', 
                                                        'b.out_det_no',
                                                        '(b.out_det_qty * -1) as tot_qty', 
                                                        'b.jur_det_no1', 
                                                        'b.jur_det_no2'),
                                        'table'=> 'td_produksi a',
                                        'join'=> array('tdetail_out b' => 'a.det_pr_no = b.det_sales_no',
                                                        'tproduct c' => 'a.prod_no = c.prod_no'),
                                        'where'=> array('b.out_no' => $TheOutNo,
                                                        'a.jenis_brg' => 1)
                                    );

                                    $srdd = $this->commonGet($selrdd);
                                }


                                if (is_array($srdd)||is_object($srdd)){
                                    foreach ($srdd as $rdd) {
                                        $selrxd = array(
                                            'select' => array('sum(a.prod_netto_price * a.kredit * -1) as value'),
                                            'table'=> 'ttrans_hpp a',
                                            'join'=> array('tdetail_out b' => 'a.out_det_no = b.out_det_no'),
                                            'where'=> array('b.out_no' => $TheOutNo,
                                                            'a.prod_no' => $rdd->prod_no)
                                        );

                                        $JumTrx = 0;

                                        $srxd = $this->commonGet($selrxd);

                                        if(is_array($srxd)||is_object($srxd)){
                                            foreach ($srxd as $rxd) {
                                                $JumTrx = (is_null($rxd->value) ? 0 : $rxd->value);
                                            }
                                        }

                                        $this->db->set('prod_nilai_total', "prod_nilai_total - ".strval($JumTrx), FALSE)
                                                 ->where('prod_no', $rdd->prod_no)
                                                 ->update('tproduct');
                                        if ($this->db->affected_rows() === 0) {
                                            $error = $this->db->error();
                                            if($error['code'] <> 00000){
                                                print_r("15  is error");
                                                die();
                                            }
                                        }

                                        // $selproduk = array(
                                        //     'select' => array('prod_nilai_total'),
                                        //     'table' => 'tproduct',
                                        //     'where' => array('prod_no' => $rdd->prod_no)
                                        // );

                                        // $sproduk = $this->commonGet($selproduk);

                                        // if (is_array($sproduk) || is_object($sproduk)) {
                                        //     foreach ($sproduk as $kprod) {
                                        //         $uptprod = array(
                                        //                 'update' => array(
                                        //                     'prod_nilai_total' => $kprod->prod_nilai_total - strval($JumTrx)),
                                        //                 'table' => 'tproduct',
                                        //                 'where' => array('prod_no' => $rdd->prod_no)
                                        //         );

                                        //         $utp = $this->setting_model->commonUpdate($uptprod);

                                        //         if($utp['code'] <> 00000 ){echo $utp;die();}
                                        //     }
                                        // }

                                        $this->db->set('prod_nilai_total', "prod_nilai_total + ".strval($rdd->tot_qty * $HargaperTrx), FALSE)
                                                 ->where('prod_no', $rdd->prod_no)
                                                 ->update('tproduct');
                                        if ($this->db->affected_rows() === 0) {
                                            $error = $this->db->error();
                                            if($error['code'] <> 00000){
                                                print_r("16  is error");
                                                die();
                                            }
                                        }

                                        // $selproduk = array(
                                        //     'select' => array('prod_nilai_total'),
                                        //     'table' => 'tproduct',
                                        //     'where' => array('prod_no' => $rdd->prod_no)
                                        // );

                                        // $sproduk = $this->commonGet($selproduk);

                                        // if (is_array($sproduk) || is_object($sproduk)) {
                                        //     foreach ($sproduk as $kprod) {
                                        //         $uptprod2 = array(
                                        //                 'update' => array(
                                        //                     'prod_nilai_total' => $kprod->prod_nilai_total + strval($JumTrx)),
                                        //                 'table' => 'tproduct',
                                        //                 'where' => array('prod_no' => $rdd->prod_no)
                                        //         );

                                        //         $utp = $this->setting_model->commonUpdate($uptprod2);

                                        //         if($utp['code'] <> 00000 ){echo $utp;die();}
                                        //     }
                                        // }

                                        $this->db->set('prod_netto_price', strval(round($HargaperTrx,5)), FALSE)
                                                 ->where('out_det_no', $rdd->out_det_no)
                                                 ->update('ttrans_hpp');
                                        if ($this->db->affected_rows() === 0) {
                                            $error = $this->db->error();
                                            if($error['code'] <> 00000){
                                                print_r("17  is error");
                                                die();
                                            }
                                        }

                                        // $selproduk = array(
                                        //     'select' => array('prod_nilai_total'),
                                        //     'table' => 'tproduct',
                                        //     'where' => array('prod_no' => $rdd->prod_no)
                                        // );

                                        // $sproduk = $this->commonGet($selproduk);

                                        // if (is_array($sproduk) || is_object($sproduk)) {
                                        //     foreach ($sproduk as $kprod) {
                                        //         $uptrhpp = array(
                                        //                 'update' => array(
                                        //                     'prod_nilai_total' => $kprod->prod_nilai_total - strval($JumTrx)),
                                        //                 'table' => 'tproduct',
                                        //                 'where' => array('prod_no' => $rdd->prod_no)
                                        //         );

                                        //         $uth = $this->setting_model->commonUpdate($uptrhpp);

                                        //         if($uth['code'] <> 00000 ){echo $uth;die();}
                                        //     }
                                        // }

                                        $selrxd = array(
                                            'select' => array('*'),
                                            'table'=> 'tdjurnal',
                                            'where_in'=> array('jur_det_no' => array($rdd->jur_det_no1, $rdd->jur_det_no2))
                                        );

                                        $JumTrx = 0;

                                        $srxd = $this->commonGet($selrxd);

                                        if (is_array($srxd) || is_object($srxd)) {
                                            foreach ($srxd as $rxd) {
                                                if($rxd->jur_det_no == $JurDetNo2){

                                                    $this->db->set('saldo', "saldo - ".strval($rxd->debet)." + ".strval($JumTrx), FALSE)
                                                             ->where('rek_no', $rxd->rek_no)
                                                             ->update('trek');
                                                    if ($this->db->affected_rows() === 0) {
                                                        $error = $this->db->error();
                                                        if($error['code'] <> 00000){
                                                            print_r("18  is error");
                                                            die();
                                                        }
                                                    }

                                                    // $selrek = array(
                                                    //     'select' => array('saldo'),
                                                    //     'table' => 'trek',
                                                    //     'where' => array('rek_no' => $rxd->rek_no)
                                                    // );

                                                    // $srek = $this->commonGet($selrek);

                                                    // if (is_array($srek)||is_object($srek)) {
                                                    //     foreach ($srek as $krek) {
                                                    //         $uptrek = array(
                                                    //                 'update' => array(
                                                    //                     'saldo' => $krek->saldo - strval($rxd->debet) + strval($JumTrx)),
                                                    //                 'table' => 'trek',
                                                    //                 'where' => array('rek_no' => $rxd->rek_no)
                                                    //         );

                                                    //         $utr = $this->setting_model->commonUpdate($uptrek);

                                                    //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                                    //     }
                                                    // }

                                                    $upjur = array(
                                                            'update' => array(
                                                                'debet' => strval($JumTrx)),
                                                            'table' => 'tdjurnal',
                                                            'where' => array('jur_det_no' => $rxd->jur_det_no)
                                                    );

                                                    $ujr = $this->setting_model->commonUpdate($upjur);

                                                    if($ujr['code'] <> 00000 ){echo $ujr;die();}

                                                }else if ($rxd->jur_det_no == $JurDetNo1) {

                                                    $this->db->set('saldo', "saldo + ".strval($rxd->debet)." - ".strval($JumTrx), FALSE)
                                                             ->where('rek_no', $rxd->rek_no)
                                                             ->update('trek');
                                                    if ($this->db->affected_rows() === 0) {
                                                        $error = $this->db->error();
                                                        if($error['code'] <> 00000){
                                                            print_r("19  is error");
                                                            die();
                                                        }
                                                    }

                                                    // $selrek = array(
                                                    //     'select' => array('saldo'),
                                                    //     'table' => 'trek',
                                                    //     'where' => array('rek_no' => $rxd->rek_no)
                                                    // );

                                                    // $srek = $this->commonGet($selrek);

                                                    // if (is_array($srek)||is_object($srek)) {
                                                    //     foreach ($srek as $krek) {
                                                    //         $uptrek = array(
                                                    //                 'update' => array(
                                                    //                     'saldo' => $krek->saldo + strval($rxd->kredit) - strval($JumTrx)),
                                                    //                 'table' => 'trek',
                                                    //                 'where' => array('rek_no' => $rxd->rek_no)
                                                    //         );

                                                    //         $utr = $this->setting_model->commonUpdate($uptrek);

                                                    //         if($utr['code'] <> 00000 ){echo $utr;die();}

                                                    //     }
                                                    // }
                                                    
                                                    $upjur = array(
                                                            'update' => array(
                                                                'kredit' => strval($JumTrx)),
                                                            'table' => 'tdjurnal',
                                                            'where' => array('jur_det_no' => $rxd->jur_det_no)
                                                    );

                                                    $ujr = $this->setting_model->commonUpdate($upjur);

                                                    if($ujr['code'] <> 00000 ){echo $ujr;die();}
                                                }
                                            }
                                        }

                                        if (empty($xProdUpdate)) {
                                            $produk[] = array(
                                              'prod_no' => $rdd->prod_no,
                                              'date' => $sl2key->tgl,
                                              'sts' => 0
                                            );
                                        }else{
                                            $strKode = $rdd->prod_no;

                                            if(($this->searchForId($strKode, 'prod_no', $xProdUpdate)) == 0){
                                                $produk[] = array(
                                                  'prod_no' => $rdd->prod_no,
                                                  'date' => $sl2key->tgl,
                                                  'sts' => 0
                                                );
                                            }
                                        }

                                        array_push($xProdUpdate,$produk);

                                    }
                                }
                            }
                        }else if ($sl2key->kredit < 0) {
                            $JurDetNo1 = "";
                            $JurDetNo1 = "";

                            $selrdd = array(
                                'select' => array('a.jenis_brg', 'b.jur_det_no1', 'b.jur_det_no2'),
                                'table' => 'td_produksi a',
                                'join' => array('tdetail_out b' => 'a.det_pr_no = b.det_sales_no'),
                                'where' => array('b.out_det_no' => $sl2key->out_det_no)
                            );

                            $srdd = $this->commonGet($selrdd);

                            if (is_array($srdd)||is_object($srdd)) {
                                foreach ($srdd as $rdd) {
                                    $JurDetNo1 = $rdd->jur_det_no1."";
                                    $JurDetNo2 = $rdd->jur_det_no2."";

                                    $JenisBrg = $rdd->jenis_brg;
                                    $QtyProduksi = $sl2key->kredit * -1;
                                    $JumNew = $QtyProduksi;
                                    $TotalNilaiProd = 0;

                                    if ($JenisBrg == 1) {
                                        $TotChange = $sl2key->prod_netto_price * $sl2key->kredit;
                                        $PriceNew = 0;

                                        $selrdd = array(
                                            'select' => array('a.price_netto'),
                                            'table' => 'td_set_hpp a',
                                            'join' => array('tset_hpp b' => 'a.hap_no = b.hap_no'),
                                            'where' => array('a.prod_no' => $sl2key->prod_no,
                                                            'b.tgl<=' =>  $sl2key->tgl),
                                            'order' => array('b.tgl' => 'DESC'),
                                            'limit' => 1
                                        );

                                        $srdd = $this->commonGet($selrdd);

                                        if (is_array($srdd)||is_object($srdd)) {
                                            foreach ($srdd as $rdd) {
                                                $PriceNew = (is_null($rdd->price_netto) ? 0 : $rdd->price_netto);
                                            }
                                        }

                                        if ($PriceNew == 0) {
                                            $TotalNilaiProd = 0;

                                            $selrdd = array(
                                                'select' => array('a.prod_no'),
                                                'table' => 'td_produksi a',
                                                'join' => array('tdetail_out b' => 'a.det_pr_no = b.det_sales_no'),
                                                'where' => array('b.out_no' => $sl2key->out_no,
                                                                'a.jenis_brg' => 2)
                                            );

                                            $srdd = $this->commonGet($selrdd);

                                            if (!is_array($srdd)||!is_object($srdd)) {
                                                $TotalNilaiProd = 0;

                                                $selrdd = array(
                                                    'select' => array('sum(a.kredit * a.prod_netto_price) as value'),
                                                    'table' => 'ttrans_hpp a',
                                                    'join' => array('tdetail_out b' => 'a.out_det_no = b.out_det_no',
                                                                    'td_produksi c' => 'b.det_sales_no = c.det_pr_no'),
                                                    'where' => array('b.out_no' => $sl2key->out_no,
                                                                    'c.jenis_brg' => 0)
                                                );

                                                $srdd = $this->commonGet($selrdd);

                                                if (is_array($srdd)||is_object($srdd)) {
                                                    foreach ($srdd as $rdd) {
                                                        $TotalNilaiProd = $TotalNilaiProd + (is_null($rdd->value) ? 0 : $rdd->value);
                                                    }
                                                }

                                                $QtyProduksi = 0;

                                                $selrdd = array(
                                                    'select' => array('sum(a.kredit * -1) as value'),
                                                    'table' => 'ttrans_hpp a',
                                                    'join' => array('tdetail_out b' => 'a.out_det_no = b.out_det_no',
                                                                    'td_produksi c' => 'b.det_sales_no = c.det_pr_no'),
                                                    'where' => array('b.out_no' => $sl2key->out_no,
                                                                    'c.jenis_brg' => 1)
                                                );

                                                $srdd = $this->commonGet($selrdd);

                                                if (is_array($srdd)||is_object($srdd)) {
                                                    foreach ($srdd as $rdd) {
                                                        $QtyProduksi = (is_null($rdd->value) ? 0 : $rdd->value);
                                                    }
                                                }

                                                $PriceNew = $TotalNilaiProd / $QtyProduksi;
                                            }
                                        }else{
                                            $TotalNilaiProd = $PriceNew * $sl2key->kredit;
                                        }

                                        $selrdd = array(
                                            'select' => array('*'),
                                            'table' => 'tdjurnal',
                                            'where_in' => array('jur_det_no' => array($JurDetNo1, $JurDetNo2))
                                        );

                                        $JDebet = 0;
                                        $JKredit = 0;

                                        $srdd = $this->commonGet($selrdd);

                                        if (is_array($srdd)||is_object($srdd)) {
                                            foreach ($srdd as $rdd) {
                                                if ($rdd->jur_det_no == $JurDetNo2) {

                                                    $this->db->set('kredit', "kredit - ".strval($TotChange)." + ".strval($TotalNilaiProd), FALSE)
                                                             ->where('jur_det_no', $rdd->jur_det_no)
                                                             ->update('tdjurnal');
                                                    if ($this->db->affected_rows() === 0) {
                                                        $error = $this->db->error();
                                                        if($error['code'] <> 00000){
                                                            print_r("20  is error");
                                                            die();
                                                        }
                                                    }

                                                    // $seljur = array(
                                                    //     'select' => array('kredit'),
                                                    //     'table' => 'tdjurnal',
                                                    //     'where' => array('jur_det_no' => $rdd->jur_det_no)
                                                    // );

                                                    // $sjur = $this->commonGet($seljur);

                                                    // if (is_array($sjur)||is_object($sjur)) {
                                                    //     foreach ($sjur as $kjur) {
                                                    //         $upkre = array(
                                                    //             'update' => array(
                                                    //                 'kredit' => $kjur->kredit - strval($TotChange) + strval($TotalNilaiProd)),
                                                    //             'table' => 'tdjurnal',
                                                    //             'where' => array('jur_det_no' => $rdd->jur_det_no)
                                                    //         );
                                                    //         $ukr = $this->setting_model->commonUpdate($upkre);

                                                    //         if($ukr['code'] <> 00000 ){echo $ukr;die();}
                                                    //     }
                                                    // }

                                                    $this->db->set('saldo', "saldo + ".strval($TotChange)." - ".strval($TotalNilaiProd), FALSE)
                                                             ->where('rek_no', $rdd->rek_no)
                                                             ->update('trek');
                                                    if ($this->db->affected_rows() === 0) {
                                                        $error = $this->db->error();
                                                        if($error['code'] <> 00000){
                                                            print_r("21  is error");
                                                            die();
                                                        }
                                                    }
                                                    
                                                    // $selrek = array(
                                                    //     'select' => array('saldo'),
                                                    //     'table' => 'trek',
                                                    //     'where' => array('rek_no' => $rdd->rek_no)
                                                    // );

                                                    // $srek = $this->commonGet($selrek);

                                                    // if (is_array($srek)||is_object($srek)) {
                                                    //     foreach ($srek as $krek) {
                                                    //         $upsal = array(
                                                    //             'update' => array(
                                                    //                 'saldo' => $krek->saldo + strval($TotChange) -  strval($TotalNilaiProd)),
                                                    //             'table' => 'trek',
                                                    //             'where' => array('rek_no' => $rdd->rek_no)
                                                    //         );
                                                    //         $usal = $this->setting_model->commonUpdate($upsal);

                                                    //         if($usal['code'] <> 00000 ){echo $usal;die();}
                                                    //     }
                                                    // }

                                                    $JKredit += $rdd->kredit;
                                                }

                                                if ($rdd->jur_det_no == $JurDetNo1) {

                                                    $this->db->set('debet', "debet - ".strval($TotChange)." + ".strval($TotalNilaiProd), FALSE)
                                                             ->where('jur_det_no', $rdd->jur_det_no)
                                                             ->update('tdjurnal');
                                                    if ($this->db->affected_rows() === 0) {
                                                        $error = $this->db->error();
                                                        if($error['code'] <> 00000){
                                                            print_r("22  is error");
                                                            die();
                                                        }
                                                    }

                                                    // $seljur = array(
                                                    //     'select' => array('debet'),
                                                    //     'table' => 'tdjurnal',
                                                    //     'where' => array('jur_det_no' => $rdd->jur_det_no)
                                                    // );

                                                    // $sjur = $this->commonGet($seljur);

                                                    // if (is_array($sjur)||is_object($sjur)) {
                                                    //     foreach ($sjur as $kjur) {
                                                    //         $upkre = array(
                                                    //             'update' => array(
                                                    //                 'debet' => $kjur->debet - strval($TotChange) + strval($TotalNilaiProd)),
                                                    //             'table' => 'tdjurnal',
                                                    //             'where' => array('jur_det_no' => $rdd->jur_det_no)
                                                    //         );
                                                    //         $ukr = $this->setting_model->commonUpdate($upkre);

                                                    //         if($ukr['code'] <> 00000 ){echo $ukr;die();}
                                                    //     }
                                                    // }

                                                    $this->db->set('saldo', "saldo - ".strval($TotChange)." + ".strval($TotalNilaiProd), FALSE)
                                                             ->where('rek_no', $rdd->rek_no)
                                                             ->update('trek');
                                                    if ($this->db->affected_rows() === 0) {
                                                        $error = $this->db->error();
                                                        if($error['code'] <> 00000){
                                                            print_r("23  is error");
                                                            die();
                                                        }
                                                    }
                                                    
                                                    // $selrek = array(
                                                    //     'select' => array('saldo'),
                                                    //     'table' => 'trek',
                                                    //     'where' => array('rek_no' => $rdd->rek_no)
                                                    // );

                                                    // $srek = $this->commonGet($selrek);

                                                    // if (is_array($srek)||is_object($srek)) {
                                                    //     foreach ($srek as $krek) {
                                                    //         $upsal = array(
                                                    //             'update' => array(
                                                    //                 'saldo' => $krek->saldo - strval($TotChange) +  strval($TotalNilaiProd)),
                                                    //             'table' => 'trek',
                                                    //             'where' => array('rek_no' => $rdd->rek_no)
                                                    //         );
                                                    //         $usal = $this->setting_model->commonUpdate($upsal);

                                                    //         if($usal['code'] <> 00000 ){echo $usal;die();}
                                                    //     }
                                                    // }

                                                    $JDebet += $rdd->debet;
                                                }
                                                
                                            }
                                        }

                                        $uptrans = array(
                                            'update' => array('prod_netto_price' => strval(round($PriceNew, 5))),
                                            'table' => 'ttrans_hpp',
                                            'where' => array('out_det_no' => $sl2key->out_det_no)
                                        );
                                        $utr = $this->setting_model->commonUpdate($uptrans);

                                        if($utr['code'] <> 00000 ){echo $utr;die();}

                                        if ($sl2key->tran_type == 7) {
                                            $selrdd = array(
                                                'select' => array('a.prod_no'),
                                                'table' => 'td_produksi a',
                                                'join' => array('tdetail_out b' => 'a.det_pr_no = b.det_sales_no'),
                                                'where' => array('b.out_no' => $sl2key->out_no,
                                                                'a.jenis_brg' => 2)
                                            );

                                            $srdd = $this->commonGet($selrdd);

                                            $produk = array();

                                            if (is_array($srdd)||is_object($srdd)) {
                                                foreach ($srdd as $rdd) {
                                                    if (empty($xProdUpdate)) {
                                                        $produk[] = array(
                                                          'prod_no' => $rdd->prod_no,
                                                          'date' => $sl2key->tgl,
                                                          'sts' => 0
                                                        );
                                                    }else{
                                                        $strKode = $rdd->prod_no;

                                                        if(($this->searchForId($strKode, 'prod_no', $xProdUpdate)) == 0){
                                                            $produk[] = array(
                                                              'prod_no' => $rdd->prod_no,
                                                              'date' => $sl2key->tgl,
                                                              'sts' => 0
                                                            );
                                                        }
                                                    }

                                                    array_push($xProdUpdate,$produk);
                                                }
                                            }
                                        }
                                    }else if ($JenisBrg == 2) {
                                        $TotalNilaiProd = 0;

                                        $selrdd = array(
                                            'select' => array('sum(a.kredit * a.prod_netto_price) as value'),
                                            'table' => 'ttrans_hpp a',
                                            'join' => array('tdetail_out b' => 'a.out_det_no = b.out_det_no',
                                                            'td_produksi c' => 'b.det_sales_no = c.det_pr_no'),
                                            'where' => array('b.out_no' => $sl2key->out_no,
                                                            'c.jenis_brg' => 0)
                                        );

                                        $srdd = $this->commonGet($selrdd);

                                        if (is_array($srdd)||is_object($srdd)) {
                                            foreach ($srdd as $rdd) {
                                                $TotalNilaiProd = $TotalNilaiProd + (is_null($rdd->value) ? 0 : $rdd->value);
                                            }
                                        }

                                        $selrdd = array(
                                            'select' => array('sum(a.kredit * a.prod_netto_price * -1) as value'),
                                            'table' => 'ttrans_hpp a',
                                            'join' => array('tdetail_out b' => 'a.out_det_no = b.out_det_no',
                                                            'td_produksi c' => 'b.det_sales_no = c.det_pr_no'),
                                            'where' => array('b.out_no' => $sl2key->out_no,
                                                            'c.jenis_brg' => 1)
                                        );

                                        $srdd = $this->commonGet($selrdd);

                                        if (is_array($srdd)||is_object($srdd)) {
                                            foreach ($srdd as $rdd) {
                                                $TotalNilaiProd = $TotalNilaiProd + (is_null($rdd->value) ? 0 : $rdd->value);
                                            }
                                        }

                                        $selrdd = array(
                                            'select' => array('sum(a.kredit * -1) as value'),
                                            'table' => 'ttrans_hpp a',
                                            'join' => array('tdetail_out b' => 'a.out_det_no = b.out_det_no',
                                                            'td_produksi c' => 'b.det_sales_no = c.det_pr_no'),
                                            'where' => array('b.out_no' => $sl2key->out_no,
                                                            'c.jenis_brg' => 2)
                                        );

                                        $srdd = $this->commonGet($selrdd);

                                        if (is_array($srdd)||is_object($srdd)) {
                                            foreach ($srdd as $rdd) {
                                                $QtyProduksi = (is_null($rdd->value) ? 0 : $rdd->value);
                                            }
                                        }

                                        $PriceNew = $TotalNilaiProd / $QtyProduksi;

                                        $selrdd = array(
                                            'select' => array('a.id', 
                                                            'b.rek_brg', 
                                                            'b.jur_det_no1', 
                                                            'b.rek_unbill_gr', 
                                                            'b.jur_det_no2', 
                                                            'a.kredit * -1 as qty', 
                                                            'b.prod_no'),
                                            'table' => 'ttrans_hpp a',
                                            'join' => array('tdetail_out b' => 'a.out_det_no = b.out_det_no',
                                                            'td_produksi c' => 'b.det_sales_no = c.det_pr_no'),
                                            'where' => array('b.out_no' => $sl2key->out_no,
                                                            'c.jenis_brg' => 2)
                                        );

                                        $srdd = $this->commonGet($selrdd);

                                        if (is_array($srdd)||is_object($srdd)) {
                                            foreach ($srdd as $rdd) {
                                                $uptrans = array(
                                                    'update' => array('prod_netto_price' => strval(round($PriceNew, 5))),
                                                    'table' => 'ttrans_hpp',
                                                    'where' => array('id' => strval($rdd->id))
                                                );
                                                $utr = $this->setting_model->commonUpdate($uptrans);

                                                if($utr['code'] <> 00000 ){echo $utr;die();}

                                                $uprod = array(
                                                    'update' => array('prod_last_buy_price' => strval(round($PriceNew, 5))),
                                                    'table' => 'tproduct',
                                                    'where' => array('prod_no' => strval($rdd->prod_no))
                                                );
                                                $upr = $this->setting_model->commonUpdate($uprod);

                                                if($upr['code'] <> 00000 ){echo $upr;die();}

                                                $selrc = array(
                                                    'select' => array('*'),
                                                    'table' => 'tdjurnal',
                                                    'where_in' => array('jur_det_no' => array($rdd->jur_det_no1, $rdd->jur_det_no2))
                                                );

                                                $src = $this->commonGet($selrc);

                                                if (is_array($src)||is_object($src)) {
                                                    foreach ($src as $rc) {
                                                        if($rc->jur_det_no == $rdd->jur_det_no1){

                                                            $this->db->set('debet', "debet - ".strval($rc->debet) ." + ". strval($PriceNew ." * ". $rdd->qty), FALSE)
                                                                     ->where('jur_det_no', $rc->jur_det_no)
                                                                     ->update('tdjurnal');
                                                            if ($this->db->affected_rows() === 0) {
                                                                $error = $this->db->error();
                                                                if($error['code'] <> 00000){
                                                                    print_r("24  is error");
                                                                    die();
                                                                }
                                                            }

                                                            // $seljur = array(
                                                            //     'select' => array('debet'),
                                                            //     'table' => 'tdjurnal',
                                                            //     'where' => array('jur_det_no' => $rc->jur_det_no)
                                                            // );

                                                            // $sjur = $this->commonGet($seljur);

                                                            // if (is_array($sjur)||is_object($sjur)) {
                                                            //     foreach ($sjur as $kjur) {
                                                            //         $upkre = array(
                                                            //             'update' => array(
                                                            //                 'debet' => $kjur->debet - strval($rc->debet) + strval($PriceNew * $rdd->qty)),
                                                            //             'table' => 'tdjurnal',
                                                            //             'where' => array('jur_det_no' => $rc->jur_det_no)
                                                            //         );
                                                            //         $ukr = $this->setting_model->commonUpdate($upkre);

                                                            //         if($ukr['code'] <> 00000 ){echo $ukr;die();}
                                                            //     }
                                                            // }
                                                            
                                                            $this->db->set('saldo', "saldo - ".strval($rc->debet) ." + ". strval($PriceNew ." * ". $rdd->qty), FALSE)
                                                                     ->where('rek_no', $rc->rek_no)
                                                                     ->update('trek');
                                                            if ($this->db->affected_rows() === 0) {
                                                                $error = $this->db->error();
                                                                if($error['code'] <> 00000){
                                                                    print_r("25  is error");
                                                                    die();
                                                                }
                                                            }

                                                            // $selrek = array(
                                                            //     'select' => array('saldo'),
                                                            //     'table' => 'trek',
                                                            //     'where' => array('rek_no' => $rc->rek_no)
                                                            // );

                                                            // $srek = $this->commonGet($selrek);

                                                            // if (is_array($srek)||is_object($srek)) {
                                                            //     foreach ($srek as $krek) {
                                                            //         $upsal = array(
                                                            //             'update' => array(
                                                            //                 'saldo' => $krek->saldo - strval($rc->debet) + strval($PriceNew * $rdd->qty)),
                                                            //             'table' => 'trek',
                                                            //             'where' => array('rek_no' => $rc->rek_no)
                                                            //         );
                                                            //         $usal = $this->setting_model->commonUpdate($upsal);

                                                            //         if($usal['code'] <> 00000 ){echo $usal;die();}
                                                            //     }
                                                            // }
                                                        }

                                                        if($rc->jur_det_no == $rdd->jur_det_no2){

                                                            $this->db->set('kredit', "kredit - ".strval($rc->debet) ." + ". strval($PriceNew ." * ". $rdd->qty), FALSE)
                                                                     ->where('jur_det_no', $rc->jur_det_no)
                                                                     ->update('tdjurnal');
                                                            if ($this->db->affected_rows() === 0) {
                                                                $error = $this->db->error();
                                                                if($error['code'] <> 00000){
                                                                    print_r("26  is error");
                                                                    die();
                                                                }
                                                            }

                                                            // $seljur = array(
                                                            //     'select' => array('kredit'),
                                                            //     'table' => 'tdjurnal',
                                                            //     'where' => array('jur_det_no' => $rc->jur_det_no)
                                                            // );

                                                            // $sjur = $this->commonGet($seljur);

                                                            // if (is_array($sjur)||is_object($sjur)) {
                                                            //     foreach ($sjur as $kjur) {
                                                            //         $upkre = array(
                                                            //             'update' => array(
                                                            //                 'kredit' => $kjur->kredit - strval($rc->kredit) + strval($PriceNew * $rdd->qty)),
                                                            //             'table' => 'tdjurnal',
                                                            //             'where' => array('jur_det_no' => $rc->jur_det_no)
                                                            //         );
                                                            //         $ukr = $this->setting_model->commonUpdate($upkre);

                                                            //         if($ukr['code'] <> 00000 ){echo $ukr;die();}

                                                            //     }
                                                            // }

                                                            $this->db->set('saldo', "saldo + ".strval($rc->debet) ." - ". strval($PriceNew ." * ". $rdd->qty), FALSE)
                                                                     ->where('rek_no', $rc->rek_no)
                                                                     ->update('trek');
                                                            if ($this->db->affected_rows() === 0) {
                                                                $error = $this->db->error();
                                                                if($error['code'] <> 00000){
                                                                    print_r("27  is error");
                                                                    die();
                                                                }
                                                            }
                                                            
                                                            // $selrek = array(
                                                            //     'select' => array('saldo'),
                                                            //     'table' => 'trek',
                                                            //     'where' => array('rek_no' => $rc->rek_no)
                                                            // );

                                                            // $srek = $this->commonGet($selrek);

                                                            // if (is_array($srek)||is_object($srek)) {
                                                            //     foreach ($srek as $krek) {
                                                            //         $upsal = array(
                                                            //             'update' => array(
                                                            //                 'saldo' => $krek->saldo + strval($rc->debet) - strval($PriceNew * $rdd->qty)),
                                                            //             'table' => 'trek',
                                                            //             'where' => array('rek_no' => $rc->rek_no)
                                                            //         );
                                                            //         $usal = $this->setting_model->commonUpdate($upsal);

                                                            //         if($usal['code'] <> 00000 ){echo $usal;die();}
                                                            //     }
                                                            // }
                                                        }
                                                    }
                                                }

                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }else if ($sl2key->tran_type == 13) {
                        if ($sl2key->out_det_no <> "" AND $sl2key->out_det_no <> "-") {
                            $uptr = array(
                                'update' => array('prod_netto_price' => strval(round($LastHpp, 5))),
                                'table' => 'ttrans_hpp',
                                'where' => array('out_det_no' => $tdjkey->out_det_no)
                            );
                           
                            $utr = $this->setting_model->commonUpdate($uptr);

                            if($utr['code'] <> 00000 ){echo $utr;die();}

                        }else if($sl2key->in_det_no <> "" AND $sl2key->in_det_no <> "-"){
                            $uptr = array(
                                'update' => array('prod_netto_price' => strval(round($LastHpp, 5))),
                                'table' => 'ttrans_hpp',
                                'where' => array('in_det_no' => $tdjkey->in_det_no)
                            );
                           
                            $utr = $this->setting_model->commonUpdate($uptr);

                            if($utr['code'] <> 00000 ){echo $utr;die();}
                        }

                        $PriceNew = $LastHpp;
                        $JumNew = (($sl2key->kredit - $sl2key->debet) * -1);

                    }else if ($sl2key->tran_type == 10) {
                        $TotNew = 0;
                        $TotChange = 0;

                        $TheOutNo = $sl2key->out_no;
                        $ThePrice = (is_null($sl2key->harga_stok_opname) ? 0 : $sl2key->harga_stok_opname);

                        $TotChange = $ThePrice * $sl2key->kredit;

                        $JumNew = $sl2key->kredit * -1;
                        $PriceNew = $LastHpp;

                        $uptdout = array(
                            'update' => array('out_det_buy_price' => strval($PriceNew)),
                            'table' => 'tdetail_out',
                            'where' => array('out_det_no' => $sl2key->out_det_no)
                        );
                       
                        $utout = $this->setting_model->commonUpdate($uptdout);

                        if($utout['code'] <> 00000 ){echo $utout;die();}

                        $uptrans = array(
                            'update' => array('prod_netto_price' => strval(round($PriceNew, 5))),
                            'table' => 'ttrans_hpp',
                            'where_in' => array('out_det_no' => $sl2key->out_det_no)
                        );
                       
                        $utr = $this->setting_model->commonUpdate($uptrans);

                        if($utr['code'] <> 00000 ){echo $utr;die();}

                        $TotNew = $PriceNew * $sl2key->redit;
                        $JurNo = "";

                        $selrdd = array(
                            'select' => array('jur_no'),
                            'table' => 'tout',
                            'where_in' => array('out_no' => $TheOutNo)
                        );

                        $srdd = $this->commonGet($selrdd);

                        if (is_array($srdd)||is_object($srdd)) {
                            foreach ($srdd as $rdd) {
                                $JurNo = (is_null($rdd->jur_no) ? "" : $rdd->jur_no);
                            }
                        }

                        $selrdd = array(
                            'select' => array('*'),
                            'table' => 'tdjurnal',
                            'where_in' => array('jur_no' => $JurNo)
                        );

                        $srdd = $this->commonGet($selrdd);

                        if (is_array($srdd)||is_object($srdd)) {
                            foreach ($srdd as $rdd) {
                                if ($rdd->kredit <> 0) {

                                    $this->db->set('kredit', "kredit - ".strval($TotChange)." + ".strval($TotNew), FALSE)
                                             ->where('jur_det_no', $rdd->jur_det_no)
                                             ->update('tdjurnal');
                                    if ($this->db->affected_rows() === 0) {
                                        $error = $this->db->error();
                                        if($error['code'] <> 00000){
                                            print_r("28  is error");
                                            die();
                                        }
                                    }

                                    // $seltdj = array(
                                    //     'select' => array('kredit'),
                                    //     'table' => 'tdjurnal',
                                    //     'where' => array('jur_det_no' => $rdd->jur_det_no)
                                    // );

                                    // $stdj = $this->commonGet($seltdj);
                                    // if (is_array($stdj)||is_object($stdj)) {
                                    //     foreach ($stdj as $ktdj) {
                                    //         $uptdj = array(
                                    //             'update' => array('kredit' => $ktdj->kredit - strval($TotChange) + strval($TotNew)),
                                    //             'table' => 'tdjurnal',
                                    //             'where' => array('jur_det_no' => $rdd->jur_det_no)
                                    //         );
                                           
                                    //         $utdj = $this->setting_model->commonUpdate($uptdj);

                                    //         if($utdj['code'] <> 00000 ){echo $utdj;die();}
                                    //     }
                                    // }
                                    
                                    $this->db->set('saldo', "saldo + ".strval($TotChange)." - ".strval($TotNew), FALSE)
                                             ->where('rek_no', $rdd->rek_no)
                                             ->update('trek');
                                    if ($this->db->affected_rows() === 0) {
                                        $error = $this->db->error();
                                        if($error['code'] <> 00000){
                                            print_r("29  is error");
                                            die();
                                        }
                                    }

                                    // $seltrek = array(
                                    //     'select' => array('saldo'),
                                    //     'table' => 'trek',
                                    //     'where' => array('rek_no' => $rdd->rek_no)
                                    // );
                                    // $strek = $this->commonGet($seltrek);
                                    // if (is_array($strek)||is_object($strek)) {
                                    //     foreach ($strek as $ktrek) {
                                    //         $uptrek = array(
                                    //             'update' => array('saldo' => $ktrek->saldo + strval($TotChange) - strval($TotNew)),
                                    //             'table' => 'trek',
                                    //             'where' => array('rek_no' => $rdd->rek_no)
                                    //         );
                                           
                                    //         $utr = $this->setting_model->commonUpdate($uptrek);

                                    //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                    //     }
                                    // }
                                }


                                if ($rdd->debet <> 0) {
                                    // $seltdj = array(
                                    //     'select' => array('debet'),
                                    //     'table' => 'tdjurnal',
                                    //     'where' => array('jur_det_no' => $rdd->jur_det_no)
                                    // );

                                    // $stdj = $this->commonGet($seltdj);
                                    // if (is_array($stdj)||is_object($stdj)) {
                                    //     foreach ($stdj as $ktdj) {
                                    //         $uptdj = array(
                                    //             'update' => array('debet' => $ktdj->debet - strval($TotChange) + strval($TotNew)),
                                    //             'table' => 'tdjurnal',
                                    //             'where' => array('jur_det_no' => $rdd->jur_det_no)
                                    //         );
                                           
                                    //         $utdj = $this->setting_model->commonUpdate($uptdj);

                                    //         if($utdj['code'] <> 00000 ){echo $utdj;die();}
                                    //     }
                                    // }

                                    $this->db->set('debet', "debet - ".strval($TotChange)." + ".strval($TotNew), FALSE)
                                             ->where('jur_det_no', $rdd->jur_det_no)
                                             ->update('tdjurnal');
                                    if ($this->db->affected_rows() === 0) {
                                        $error = $this->db->error();
                                        if($error['code'] <> 00000){
                                            print_r("30  is error");
                                            die();
                                        }
                                    }

                                    $this->db->set('saldo', "saldo - ".strval($TotChange)." + ".strval($TotNew), FALSE)
                                             ->where('rek_no', $rdd->rek_no)
                                             ->update('trek');
                                    if ($this->db->affected_rows() === 0) {
                                        $error = $this->db->error();
                                        if($error['code'] <> 00000){
                                            print_r("31  is error");
                                            die();
                                        }
                                    }
                                    
                                    // $seltrek = array(
                                    //     'select' => array('saldo'),
                                    //     'table' => 'trek',
                                    //     'where' => array('rek_no' => $rdd->rek_no)
                                    // );
                                    // $strek = $this->commonGet($seltrek);
                                    // if (is_array($strek)||is_object($strek)) {
                                    //     foreach ($strek as $ktrek) {
                                    //         $uptrek = array(
                                    //             'update' => array('saldo' => $ktrek->saldo - strval($TotChange) + strval($TotNew)),
                                    //             'table' => 'trek',
                                    //             'where' => array('rek_no' => $rdd->rek_no)
                                    //         );
                                           
                                    //         $utr = $this->setting_model->commonUpdate($uptrek);

                                    //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                    //     }
                                    // }

                                }
                            }
                        }

                        if ($sl2key->tran_type == 2) {
                            $RekNoSelisih = "";
                            $JurKet = "";

                            $selrdd = array(
                                'select' => array('rek_no', 
                                                '(debet-kredit) as value', 
                                                'jur_det_no', 
                                                'keterangan'),
                                'table' => 'tdjurnal',
                                'where' => array('is_biaya' => 1,
                                            'jur_no' => $JurNo)
                            );

                            $srdd = $this->commonGet($selrdd);

                            if (is_array($srdd)||is_object($srdd)) {
                                foreach ($srdd as $rdd) {
                                    $RekNoSelisih = $rdd->rek_no;
                                    $JurKet = $rdd->keterangan."";

                                    // $seltrek = array(
                                    //     'select' => array('saldo'),
                                    //     'table' => 'trek',
                                    //     'where' => array('rek_no' => $rdd->rek_no)
                                    // );
                                    // $strek = $this->commonGet($seltrek);
                                    // if (is_array($strek)||is_object($strek)) {
                                    //     foreach ($strek as $ktrek) {
                                    //         $uptrek = array(
                                    //             'update' => array('saldo' => $ktrek->saldo - strval($rdd->value)),
                                    //             'table' => 'trek',
                                    //             'where_in' => array('rek_no' => $rdd->rek_no)
                                    //         );
                                           
                                    //         $utr = $this->setting_model->commonUpdate($uptrek);

                                    //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                    //     }
                                    // }

                                    $this->db->set('saldo', "saldo - ".strval($rdd->value), FALSE)
                                             ->where('rek_no', $rdd->rek_no)
                                             ->update('trek');
                                    if ($this->db->affected_rows() === 0) {
                                        $error = $this->db->error();
                                        if($error['code'] <> 00000){
                                            print_r("32  is error");
                                            die();
                                        }
                                    }

                                    $deljur = array(
                                        'table' => 'tdjurnal',
                                        'where' => array('jur_det_no' => $rdd->jur_det_no)
                                    );

                                    $djur = $this->setting_model->commonDelete($deljur);

                                }
                            }

                            $selrdd2 = array(
                                'select' => array('sum(debet-kredit) as value'),
                                'table' => 'tdjurnal',
                                'where' => array('is_biaya' => 0,
                                            'jur_no' => $JurNo)
                            );

                            $srdd2 = $this->commonGet($selrdd2);

                            if (is_array($srdd2)||is_object($srdd2)) {
                                foreach ($srdd2 as $rdd2) {
                                    if ($rdd2 <> 0 ) {
                                        if ($RekNoSelisih == "") {
                                            $RekNoSelisih = '';
                                        }

                                        $Selisih = (is_null($rdd2->value) ? 0 : $rdd2->value);

                                        if ($Selisih <> 0) {
                                            $JurDetNo = $this->GetNoIDField2("jur_det_no", "tdjurnal");
                                            $insert = array(
                                                'insert' => array(
                                                    'jur_det_no' => $JurDetNo,
                                                    'jur_no' => $JurNo,
                                                    'rek_no' => $RekNoSelisih,
                                                    'debet' => strval($Selisih),
                                                    'kredit' => 0,
                                                    'keterangan'=> ($JurKet <> "" ? "Selisih perhitungan HPP" : ""),
                                                    'is_biaya' => 1,
                                                    'debet_kurs' => strval($Selisih),
                                                    'kredit_kurs' => 0
                                                ),
                                                'table' => 'tdjurnal'
                                            );

                                            $ins = $this->setting_model->commonInsert($insert);

                                            if($ins['code'] <> 00000 ){print_r("ins  is error");die();}

                                            // $seltrek = array(
                                            //     'select' => array('saldo'),
                                            //     'table' => 'trek',
                                            //     'where' => array('rek_no' => $RekNoSelisih)
                                            // );
                                            // $strek = $this->commonGet($seltrek);
                                            // if (is_array($strek)||is_object($strek)) {
                                            //     foreach ($strek as $ktrek) {
                                            //         $uptrek = array(
                                            //             'update' => array('saldo' => $ktrek->saldo + strval($Selisih)),
                                            //             'table' => 'trek',
                                            //             'where' => array('rek_no' => $RekNoSelisih)
                                            //         );
                                                   
                                            //         $utr = $this->setting_model->commonUpdate($uptrek);

                                            //         if($utr['code'] <> 00000 ){echo $utr;die();}
                                            //     }
                                            // }

                                            $this->db->set('saldo', "saldo + ".strval($Selisih), FALSE)
                                                     ->where('rek_no', $RekNoSelisih)
                                                     ->update('trek');
                                            if ($this->db->affected_rows() === 0) {
                                                $error = $this->db->error();
                                                if($error['code'] <> 00000){
                                                    print_r("33  is error");
                                                    die();
                                                }
                                            }
                                            
                                        }
                                    }
                                }
                            }

                        }
                    }

                    if ($JumNew <> 0) {
                        $TotalNilai = round($TotalNilai, 5) + round($PriceNew, 5) * round($JumNew, 5);

                        if (round($JmlOld, 5) + round($JumNew, 5) <> 0) {
                            $PriceOld = ($TotalNilai) / (round($JmlOld, 5) + round($JumNew, 5));
                            $LastHpp = $PriceOld;
                        }else{
                            $LastHpp = $PriceOld;
                            $PriceOld = 0;
                        }
                    }

                    $JmlOld = round($JmlOld, 5) + round($JumNew, 5);

                    $PAwal = 0;

                    $uptr = array(
                        'update' => array('saldo' => strval(round($JmlOld, 5)),
                                        'last_prod_rata_price' => strval($LastHpp)),
                        'table' => 'ttrans_hpp',
                        'where' => array('id' => strval($sl2key->id))
                    );
                   
                    $utr = $this->setting_model->commonUpdate($uptr);

                    if($utr['code'] <> 00000 ){echo $utr;die();}

                }
            }

            // $uprod = array(
            //     'update' => array('prod_on_hand' => strval(round($JmlOld, 5)),
            //                     'prod_buy_price' => strval(round($PriceOld, 5)),
            //                     'prod_nilai_total' => strval(round($TotalNilai, 5))),
            //     'table' => 'tproduct',
            //     'where' => array('prod_no' => $ProdNo)
            // );
           
            // $upr = $this->setting_model->commonUpdate($uprod);

            // if($upr['code'] <> 00000 ){echo $upr;die();}

            // $this->db->set('prod_on_hand', "prod_on_hand + ".strval(round($JmlOld, 5)), FALSE)
            $this->db->set('prod_on_hand', strval(round($JmlOld, 5)), FALSE)
                     ->set('prod_buy_price', strval(round($PriceOld, 5)), FALSE)
                     ->set('prod_nilai_total', strval(round($TotalNilai, 5)), FALSE)
                     ->where('prod_no', $ProdNo)
                     ->update('tproduct');
            $upre  = $this->db->error();
            
            if ($this->db->affected_rows() === 0) {
                if($upre['code'] <> 00000){
                    print_r("upr  is error");
                    die();
                }
            }

            if ($IsProsesNext == 1) {
                if (count($xProdUpdate)> 0){
                    $jmlRec = count($xProdUpdate[0]);
                    foreach ($xProdUpdate as $prod) {
                        foreach ($prod as $key) {
                            if ($Pos2Proses <= $jmlRec) {
                                $Diawal = 0;
                                $ProdNo = $key['prod_no'];
                                $TglUpdate = $key['date'];
                                $PriceNew = $key['sts'];
                                $Pos2Proses = $Pos2Proses + 1;

                                goto TeruskanKodeLain;
                            }
                        }
                    }
                }
            }

            $JmlOld = 0;

            $selrs = array(
                'select' => array('prod_on_proses'),
                'table' => 'tproduct',
                'where' => array('prod_no' => $ProdNo)
            );

            $srs = $this->commonGet($selrs);

            if (is_array($srs)||is_object($srs)) {
                foreach ($srs as $rs) {
                    $JmlOld = round((is_null($rs->prod_on_proses) ? 0 : $rs->prod_on_proses), 5);
                }
            }

            $LastJml = 0;

            $selsald = array(
                'select' => array('saldo'),
                'table' => 'ttrans_hpp',
                'where' => array('prod_no' => $ProdNo),
                'order' => array('tgl' => 'DESC'),
                'limit' => 1
            );

            $sls = $this->commonGet($selsald);

            if (is_array($sls)||is_object($sls)) {
                foreach ($sls as $ls) {
                    $LastJml = round((is_null($ls->saldo) ? 0 : $ls->saldo), 5);
                }
            }

            $Selisih = abs(round(round($JmlOld, 3) - round($LastJml, 3), 3));

            if ($Selisih > 0.001) {
                $sudah = 0;
            }

        return 1;
    }

    public function ControlRek($RekDasar='')
    {
        $rek_no = '';
        $select = array(
            'select' => array('rek_no', 'rek_type', 'rek_kode', 'rek_nama'),
            'table' => 'trek',
            'where' => array(
                            'rek_no' => $RekDasar,
                            'is_delete' => 0,
                            'rek_type' => 3
                        )
        );

        $sel = $this->commonGet($select);

        if (is_array($sel)||is_object($sel)) {
            foreach ($sel as $key) {
                $rek_no = $key->rek_no;
            }
        }

        return $rek_no;
    }

    public function GetRekDasar()
    {
        $REK_DASAR = array();

        $select = array(
            'select' => array('pro_disc', 'pro_service', 'pro_tax', 'pro_head_1', 'pro_head_2', 'pro_head_3', 
                                'pro_foot_1', 'pro_batas_kiri', 'pro_batas_bawah', 
                                'pro_foot_2', 'auto_update_sell_price', 'pro_head_4', 
                                'pro_foot_3', 'pro_foot_4', 
                                'rek_kas_no', 'rek_brg_no', 'rek_hpp_no', 'rek_jual_no', 
                                'rek_hutang_no', 'rek_piutang_no', 
                                'pos_jual', 'pos_beli', 'pos_hutang', 
                                'pos_piutang', 'rek_pot_beli', 'rek_pot_jual', 
                                'rek_koreksi_brg', 'pos_kasir', 
                                'edit_harga_jual', 'rek_modal_no', 'pos_modal', 
                                'rek_brg_rusak', 'rek_lr_bulan', 'rek_lr_tahun', 
                                'rek_retur_jual', 'rek_pot_piutang', 'is_kode_auto', 
                                'is_print_pot', 'max_auto_price','pakai_no', 'is_ppn', 'is_default_type', 
                                'min_disc_item', 'is_can_change_tgl', 'min_cetak_nota', 'is_lsg_cetak', 'kas_no_so', 
                                'rek_piutang_disc', 'rek_beli_no', 'rek_terima_brg', 
                                'rek_retur_beli', 'rek_cn_beli', 'rek_biaya_retur_jual', 'rek_pot_hutang', 
                                'rek_uang_muka_beli', 'rek_cair_giro1', 'rek_cair_giro2', 'no_portcom', 'is_using_display', 
                                'Kd_DT', 'nKd_DT', 'nAngka_DT', 'nDesimal_DT', 'bank_no', 'jenis_printer', 
                                'rek_unbill_gr', 'rek_ppn_masukan', 'gud_in_transit', 'rek_unbill_gi', 'rek_hutang_ppn', 
                                'rek_hutang_giro', 'rek_piutang_giro', 'rek_uang_muka_jual', 
                                'rek_koreksi_hutang', 'rek_koreksi_piutang', 'prefix_no_ob', 'prefix_no_tb', 
                                'prefix_no_oj', 'prefix_no_jual', 'nm_dir_purchasing', 'data_bank_no', 'data_bank_nama', 'data_bank_acc', 
                                'data_bank_no2', 'data_bank_nama2', 'data_bank_acc2', 'rek_auto_koreksi', 'rek_modal', 'rek_prive', 
                                'faktur_pajak_npwp', 'faktur_pajak_nama', 'faktur_pajak_nama2', 'faktur_pajak_alamat', 
                                'faktur_pajak_alamat2', 'faktur_pajak_tgl_pkp', 'faktur_pajak_jabatan', 'jenis_cetak', 
                                'rek_selisih_desimal', 'Is_Tax', 'use_Tax', 'rek_ongkos_kirim', 'telp', 'fax', 'mail', 'cab_no', 
                                'rek_tunai'),
            'table' => 'tprofile'
        );

        $sel = $this->commonGet($select);

        if (is_array($sel)||is_object($sel)) {
            foreach ($sel as $key) {
                $REK_DASAR = array(
                    'CABANG' => $key->cab_no,
                    'REK_SELISIH_DESIMAL' => $key->rek_selisih_desimal,
                    'REK_AUTO_KOREKSI' => $key->rek_auto_koreksi,
                    'REK_MODAL' => $key->rek_modal,
                    'REK_PRIVE' => $key->rek_prive,
                    'NM_DIR_PURCHASING' => $key->nm_dir_purchasing,
                    'PREFIX_NO_FAKTUR_JUAL' => $key->prefix_no_jual,
                    'PREFIX_NO_ORDER_JUAL' => $key->prefix_no_oj,
                    'PREFIX_NO_TERIMA_BRG' => $key->prefix_no_tb,
                    'PREFIX_NO_ORDER_BELI' => $key->prefix_no_ob,

                    'TUNAI' => $key->rek_tunai,
                    'REK_HUTANG_GIRO' => $key->rek_hutang_giro,
                    'REK_PIUTANG_GIRO' => $key->rek_piutang_giro,
                    'REK_UNBILL_GI' => $key->rek_unbill_gi,
                    'REK_HUTANG_PPN' => $key->rek_hutang_ppn,
                    'GudInTransit' => $key->gud_in_transit,
                    'REK_UNBILL_GR' => $key->rek_unbill_gr,
                    'REK_PPN_MASUKAN' => $key->rek_ppn_masukan,
                    'jenis_printer' => $key->jenis_printer,
                    'bank_no' => $key->bank_no,
                    'Kode_DT' => $key->Kd_DT,
                    'nKdBrg_DT' => $key->nKd_DT,
                    'nAngka_DT' => $key->nAngka_DT,
                    'nDesimal_DT' => $key->nDesimal_DT,
                    'IsUsingDisplay' => $key->is_using_display,
                    'No_PortCom' => $key->no_portcom,
                    'PERSEN_SERVICE' => $key->pro_service,
                    'PERSEN_DISC' => $key->pro_disc,
                    'PERSEN_TAX' => $key->pro_tax,
                    'brg_no' => $key->rek_brg_no,
                    'hpp_no' => $key->rek_hpp_no,
                    'hutang_no' => $key->rek_hutang_no,
                    'kas_no' => $key->rek_kas_no,
                    'piutang_no' => $key->rek_piutang_no,
                    'jual_no' => $key->rek_jual_no,
                    'pot_beli_no' => $key->rek_pot_beli,
                    'pot_jual_no' => $key->rek_pot_jual,
                    'koreksi_no' => $key->rek_koreksi_brg,
                    'modal_no' => $key->rek_modal_no,
                    'pos_beli' => $key->pos_beli,
                    'pos_jual' => $key->pos_jual,
                    'pos_hutang' => $key->pos_hutang,
                    'pos_piutang' => $key->pos_piutang,
                    'pos_kasir' => $key->pos_kasir,
                    'pos_modal' => $key->pos_modal,
                    'laba_bulan_no' => $key->rek_lr_bulan,
                    'laba_tahun_no' => $key->rek_lr_tahun,
                    'retur_jual_no' => $key->rek_retur_jual,
                    'REK_POT_PIUTANG' => $key->rek_pot_piutang,
                    'pakai_no' => $key->pakai_no,
                    'is_ppn' => $key->is_ppn,
                    'is_type' => $key->is_default_type,
                    'min_disc_item' => $key->min_disc_item,
                    'is_can_change_tgl' => $key->is_can_change_tgl,
                    'min_cetak_nota' => $key->min_cetak_nota,
                    'is_lsg_cetak' => $key->is_lsg_cetak,
                    'KAS_SALDO_AWAL' => $key->kas_no_so,
                    'REK_PIUTANG_DISC' => $key->rek_piutang_disc,
                    'beli_no' => $key->rek_beli_no,
                    'REK_TERIMA_BRG' => $key->rek_terima_brg,
                    'REK_RETUR_BELI' => $key->rek_retur_beli,
                    'REK_CN_BELI' => $key->rek_cn_beli,
                    'REK_BIAYA_RETUR_JUAL' => $key->rek_biaya_retur_jual,
                    'REK_POT_HUTANG' => $key->rek_pot_hutang,
                    'REK_UANG_MUKA_JUAL' => $key->rek_uang_muka_jual,
                    'REK_KOREKSI_HUTANG' => $key->rek_koreksi_hutang,
                    'REK_KOREKSI_PIUTANG' => $key->rek_koreksi_piutang,
                    'REK_ONGKIR' => $key->rek_ongkos_kirim,

                    'faktur_pajak_npwp' => $key->faktur_pajak_npwp,
                    'faktur_pajak_nama' => $key->faktur_pajak_nama,
                    'faktur_pajak_nama2' => $key->faktur_pajak_nama2,
                    'faktur_pajak_alamat' => $key->faktur_pajak_alamat,
                    'faktur_pajak_alamat2' => $key->faktur_pajak_alamat2,
                    'faktur_pajak_tgl_pkp' => (is_null($key->faktur_pajak_tgl_pkp)? "" :$key->faktur_pajak_tgl_pkp),
                    'faktur_pajak_jabatan' => $key->faktur_pajak_jabatan,
                    'faktur_pajak_telp' => $key->telp,
                    'faktur_pajak_mail' => $key->mail,

                    'data_bank_no' => $key->data_bank_no,
                    'data_bank_nama' => $key->data_bank_nama,
                    'data_bank_acc' => $key->data_bank_acc,

                    'data_bank_no2' => $key->data_bank_no2,
                    'data_bank_nama2' => $key->data_bank_nama2,
                    'data_bank_acc2' => $key->data_bank_acc2,

                    'REK_UANG_MUKA_BELI' => $key->rek_uang_muka_beli,

                    'REK_BANK_CAIR_GIRO1' => $key->rek_cair_giro1,
                    'REK_BANK_CAIR_GIRO2' => $key->rek_cair_giro2,

                    'jenis_cetak' => $key->jenis_cetak,
                    'IsTax' => ($key->Is_Tax),
                    'useTax' => ($key->use_Tax),
                );
            }
        }

        return $REK_DASAR;
    }
}
