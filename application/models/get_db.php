<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_db extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_All(){
        $this->load->database();
        $query = $this->db->query("SELECT * FROM test");
        return $query->result();
    }
}