<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_dbuser extends CI_Model{
    
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
        $query = $this->db->query('SELECT * FROM users where username = "'.$data["username"] .'" and password = "'.$data["password"].'"');
		if($query->num_rows() >= 1)
			return $query->result();
		else 
			return null;
	}
    
    function insertUser($data){
        $this->load->database();
        $this->db->insert("users",$data); 
    }
    
    function updateUser($data){
        $this->load->database();
        $this->db->update("users",$data,'username = "'.$data["username"].'"'); 
    }
}