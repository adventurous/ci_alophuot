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
          $data["results"] = $this->get_db->get_All();
          $this->load->view('view_db',$data);
      }
  }
?>
