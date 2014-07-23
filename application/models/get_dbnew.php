<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_dbnew extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_AllNew($user){
        $this->load->database();
        $query = $this->db->query("SELECT * FROM news");
        return $query->result();
    }
	
	function getNewId($data){
		$this->load->database();
        $query = $this->db->query('SELECT * FROM news where id = "'.$data["id"] .'"');
		if($query->num_rows() >= 1)
			return $query->result();
		else 
			return null;
	}
    
    function insertNew($data){
        $this->load->database();
        $this->db->insert("news",$data); 
    }
    
    function updateNew($data){
        $this->load->database();
        $this->db->update("news",$data,'id = "'.$data["id"].'"'); 
    }
}