<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
	public function index(){
		$this->home();
	}
	
	public function home(){
		$data['title'] = "Home!";
		$data['var1'] = "2";
		$data['var2'] = "8";
		
		$this->load->model("math");
		
		$data['addTotal'] = $this->math->add($data['var1'],$data['var2']);
		$data['subTotal'] = $this->math->sub($data['var1'],$data['var2']);
		$this->load->view("view_home",$data);
	}
	
	public function about(){
		$data['title'] = "About!";
		$this->load->view("view_about");
	}
}