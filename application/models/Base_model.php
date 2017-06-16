<?php 
class Base_model extends CI_Model {

    

    function __construct()
    {
        parent::__construct();
    }
    
    public function select_table($table,$conn = "default",$select = array(), $where=array(), $join=array(), $order_by=array(), $group_by=array()){
         $this->db = $this->load->database($conn, TRUE);
         if( count($where) > 0 )
            foreach($where as $key => $value) $this->db->where($key, $value);
         if(count($select) > 0) $this->db->select(implode(",", $select));
         $result = $this->db->get($table);
         $data = $result->result_array();
         return $data;
    }

    public function select_single_table($table,$conn = "default",$select = array(), $where=array(), $join=array(), $order_by=array(), $group_by=array()){
         $this->db = $this->load->database($conn, TRUE);
         if( count($where) > 0 )
            foreach($where as $key => $value) $this->db->where($key, $value);
         if(count($select) > 0) $this->db->select(implode(",", $select));
         $result = $this->db->get($table);
         $data = $result->result_array();
         if($data) return $data[0];
    }

    public function dynamic_connection($branch_code, $remote="remote", $db_driver = "mssql", $dbase = null, $conn = null)
    {
        $this->db = $this->load->database("datacenter", true);
        $this->db->where("branchcode", $branch_code);
        $this->db->limit(1);
        $result = $this->db->get("branches");
        $row = $result->result_array();
        if(!empty($row)) {
            $data = $row[0];
            $db  = array();
            $db['hostname'] = ($conn == null) ? $data[$remote."servername"] : $conn;
            $db['username'] = ($dbase == null) ? $data[$remote."serverusername"] : "root";
            $db['password'] = ($dbase == null) ? $data[$remote."serverpassword"] : "";
            $db['database'] =  ($dbase == null) ? $data[$remote."serverdatabasename"] : $dbase;
            $db['dbdriver'] = $db_driver;
            return $db;
        } else return array();
    }

    public function dynamic_select_table($table,$branch,$remote="remote",$select = array(), $where=array(), $join=array(), $order_by=array(), $group_by=array(), $db_driver = "mssql", $database = null, $conn = null){
        $config = $this->dynamic_connection($branch, $remote, $db_driver, $database, $conn);
        if($remote == "branch"){
            $ping = $this->ping($config["hostname"]);
            if(!$ping) return false;
        }
        $dsn = $config["dbdriver"].'://'.$config["username"].':'.$config["password"].'@'.$config['hostname'].'/'.$config['database'];
        $this->db = $this->load->database($dsn, true);
         if( count($where) > 0 )
            foreach($where as $key => $value) $this->db->where($key, $value);
         if(count($select) > 0) $this->db->select(implode(",", $select));
         if(count($join) > 0) foreach($join as $index => $j) $this->db->join($index, $j);
         $result = $this->db->get($table);
         $data = $result->result_array();
         if(count($data) == 1) return $data[0];
         return $data;
    }

     public function dynamic_all_select_table($table,$branch,$remote="remote",$select = array(), $where=array(), $join=array(), $order_by=array(), $group_by=array()){
        $config = $this->dynamic_connection($branch, $remote);
        if($remote == "branch"){
            $ping = $this->ping($config["hostname"]);
            if(!$ping) return false;
        }
        $dsn = $config["dbdriver"].'://'.$config["username"].':'.$config["password"].'@'.$config['hostname'].'/'.$config['database'];
        $this->db = $this->load->database($dsn, true);
         if( count($where) > 0 )
            foreach($where as $key => $value) $this->db->where($key, $value);
         if( count($group_by) > 0 )
            $this->db->group_by(implode(",", $group_by));
         if(count($select) > 0) $this->db->select(implode(",", $select));
         $result = $this->db->get($table);
         $data = $result->result_array();
         return $data;
    }

    public function ping($host,$port=1433,$timeout=3)
    {
            $fsock = fsockopen($host, $port, $errno, $errstr, $timeout);
            if ( ! $fsock )
            {
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }
    }
}
