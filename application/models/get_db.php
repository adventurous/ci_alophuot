<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_db extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_AllUser(){
        $this->load->database();
        $query = $this->db->query("SELECT * FROM users");
        return $query->result();
    }
	
	function getUserId($data){
		$this->load->database();
        $query = $this->db->query('SELECT * FROM users where username = "'.$data["username"] .'" and passwork = "'.$data["passwork"].'"');
        return $query->result();
	}
    
    function insert1($data){
        $this->load->database();
        $this->db->insert("test",$data); 
    }
    
    function insert2($data){
        $this->load->database();
        $this->db->insert_batch("test",$data); 
    }
    
    function update1($data){
        $this->load->database();
        $this->db->update("test",$data,"id = 2"); 
    }
}