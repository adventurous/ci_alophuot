<?php
  class Hello extends CI_Controller{
      
      public function index(){
          echo "This is my index function<br>";
      }
      
      public function one($name){
          $this->load->view('header');
         
          $this->load->model('hello_model');
          $profile = $this->hello_model->getprofile($name);
//          print_r($profile);
          $data = array("name" => $name);
          $data['profile'] = $profile;
          $this->load->view('one',$data);
      }
      
      public function getValues(){
          $this->load->model('get_db');
          //$data["results"] = $this->get_db->get_AllUser();
		   $datainfo = array("username" => "admin","passwork"=>"devteam");
		  $data["results"] = $this->get_db->getUserId($datainfo);
          $this->load->view('view_db',$data);
      }
      
      public function insertValues(){
          $newRows = array(array("name" => "susan"),array("name" => "susan"));
          $this->load->model('get_db');
          $this->get_db->insert2($newRows);
          echo "Inserted successful";
      }
      
      public function updateValue(){
          $data = array("name" => "Hoang Ron");
          $this->load->model('get_db');
          $this->get_db->update1($data);
          
          echo "Updated successful";
      }
  }
?>
