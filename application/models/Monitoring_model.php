<?php 
class Monitoring_model extends CI_Model {

    

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
 

   function get_data($limit= array(), $table= "parcel", $fields = null, $order_by = array()){
        if(count($limit) > 1)$this->db->limit($limit[0],$limit[1]);
        if(count($order_by) > 0)$this->db->order_by(implode(",", $order_by) , "desc");
        if($fields != null) $this->db->select($fields);
        $result = $this->db->get($table);

        return $result->result_array();
   }

   
}