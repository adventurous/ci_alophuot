<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hello_model extends CI_Model{
    
    public function getprofile($name){
        return array("fullname" => "Hoang Ron","age" => 29);
    }
}
