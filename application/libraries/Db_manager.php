<?php

class Db_manager
{
    var $connections = array();
    var $CI;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    function get_connection($db_name,$host,$port,$username,$password)
    {
        // connection exists? return it
        if (isset($this->connections[$db_name])) 
        {
            return $this->connections[$db_name];
       }
       else
       {
        // create connection. return it.
        // $host = '192.168.100.76';
        // $port = '3306';
        // $db_name = 'madura';
        // $username = 'adm_fhs';
        // $password = 'fhsoftware2018';

        $config_db = array(
            'dsn'  => 'mysql:host='.$host.':'.$port.'; dbname='.$db_name.'; charset=utf8;',
            'username' => $username,
            'password' => $password,
            'dbdriver' => 'pdo',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => FALSE,
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
            $this->connections[$db_name] = $this->CI->load->database($config_db, true);
            $this->$db_name = $this->CI->load->database($config_db, true);
            return $this->connections[$db_name];
        }
    }
    function test_connection($db_name,$host,$port,$username,$password)
    {
        // create connection. return it.
        // $host = '192.168.100.76';
        // $port = '3306';
        // $db_name = 'madura';
        // $username = 'adm_fhs';
        // $password = 'fhsoftware2018';
        if(($db_name OR $host OR $port OR $username OR $password) != ''){
            $config_db = array(
                'dsn'  => 'mysql:host='.$host.':'.$port.'; dbname='.$db_name.'; charset=utf8;',
                'username' => $username,
                'password' => $password,
                'dbdriver' => 'pdo',
                'dbprefix' => '',
                'pconnect' => FALSE,
                'db_debug' => FALSE,
                'cache_on' => FALSE,
                'cachedir' => '',
                'char_set' => 'utf8',
                'dbcollat' => 'utf8_general_ci',
                'swap_pre' => '',
                'encrypt' => FALSE,
                'compress' => FALSE,
                'stricton' => FALSE,
                'failover' => array(),
                'save_queries' => TRUE
            );
        
            $this->connections[$db_name] = $this->CI->load->database($config_db, false,true);
            
            if($this->CI->db->initialize()) 
            {
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
        
    }
}