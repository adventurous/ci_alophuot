<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Adam Whitney
 * @link		http://outergalactic.org/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'libraries/REST_Controller.php';

class Register extends REST_Controller
{
	var $REST_CLIENT_ID = "af1a6dad481fac130b474f6c676fcaa5";
	function get()
    {
    	// Example data for testing.
    	$widgets = array(
    			1 => array('id' => 1, 'name' => 'sprocket'),
    			2 => array('id' => 2, 'name' => 'gear')
    	);
    	 
    	$id = $this->_get('id');
    	if(!$id)
    	{
    		//$widgets = $this->widgets_model->getWidgets();    		    		
    		if($widgets)
    			$this->response($widgets, 200); // 200 being the HTTP response code
    		else
    			$this->response(array('error' => 'Couldn\'t find any widgets!'), 404);
    	}

        //$widget = $this->widgets_model->getWidget($id);
    	$widget = @$widgets[$id]; // test code

        if($widget)
            $this->response($widget, 200); // 200 being the HTTP response code
        else
            $this->response(array('error' => 'Widget could not be found'), 404);
    }
    
    function post()
    {
		$data = $this->_post_args;
		try {
			//$id = $this->widgets_model->createWidget($data);
			$UDID = $data['UDID'];
			$LoginName = $data['LoginName'];
			$FullName = $data['FullName'];
			$Phone = $data['Phone'];
			$Email = $data['Email'];
			$Password = $data['Password'];
			$valueAvatar = $data['ValueAvatar'];
			$Avatar_link = "";
			if(!empty($valueAvatar)){
				$Avatar_link = $this->_save_image($valueAvatar);
			}
			$datainfo = array('username'=>$LoginName,'passwork'=>$Password,'typeuser'=>0,'fullname'=>$FullName,'avatar_link'=>$Avatar_link,'phone'=>$Phone,'mail'=>$Email);
			$this->load->model('get_dbuser');
			$this->get_dbuser->insertUser($datainfo);
            $result = array('result'=>array('success'=>true,'info'=>array('Email'=>true,'LoginName'=>true,'Passwork'=>true,'PasswordConfirm'=>true),'user_info'=>array('fullname'=>$FullName,'email'=>$Email,'username'=>$LoginName,'id'=>1),'message'=>"Register"));
            $this->response($result, 200); // 201 being the HTTP response code
		} catch (Exception $e) {
			// Here the model can throw exceptions like the following:
			// * For invalid input data: new Exception('Invalid request data', 400)
			// * For a conflict when attempting to create, like a resubmit: new Exception('Widget already exists', 409)
			$this->response(array('status' => $e->getMessage()), $e->getCode());
		}
		
    }
	
	function _save_image($valueAvatar) {
		$image = base64_decode($valueAvatar);
		$config['upload_path'] = FCPATH . 'path_to_image_folder'.'/avatars';
		$config['file_name'] = 'avatar'.$this->get_namefile().'jpg';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = '2048';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		if($this->upload->do_upload($image)) {
			$arr_image_info = $this->upload->data();
			return ($arr_image_info['full_path']);
		}
		else {
			echo $this->upload->display_errors();
			die();
		}
		return $config['file_name'];
	}
	
	public function get_namefile(){
		return "";
	}
    
    public function put()
    {
		$data = $this->_put_args;
		try {
			//$id = $this->widgets_model->updateWidget($data);
			$id = $data['id']; // test code
			//throw new Exception('Invalid request data', 400); // test code
		} catch (Exception $e) {
			// Here the model can throw exceptions like the following:
			// * For invalid input data: new Exception('Invalid request data', 400)
			// * For a conflict when attempting to create, like a resubmit: new Exception('Widget already exists', 409)
			$this->response(array('error' => $e->getMessage()), $e->getCode());
		}
		if ($id) {
			$widget = array('id' => $data['id'], 'name' => $data['name']); // test code
			//$widget = $this->widgets_model->getWidget($id);
			$this->response($widget, 200); // 200 being the HTTP response code
		} else
			$this->response(array('error' => 'Widget could not be found'), 404);
    }
        
    function delete()
    {
    	
    	// Example data for testing.
    	$widgets = array(
    			1 => array('id' => 1, 'name' => 'sprocket'),
    			2 => array('id' => 2, 'name' => 'gear'),
    			3 => array('id' => 3, 'name' => 'nut')
    	);
    	
    	$id = $this->_get('id');
    	if(!$id)
    	{
    		$this->response(array('error' => 'An ID must be supplied to delete a widget'), 400);
    	}

        //$widget = $this->widgets_model->getWidget($id);
    	$widget = @$widgets[$id]; // test code

    	if($widget) {
    		try {
    			//$this->widgets_model->deleteWidget($id);
    			//throw new Exception('Forbidden', 403); // test code
    		} catch (Exception $e) {
    			// Here the model can throw exceptions like the following:
    			// * Client is not authorized: new Exception('Forbidden', 403)
    			$this->response(array('error' => $e->getMessage()), $e->getCode());
    		}
    		$this->response($widget, 200); // 200 being the HTTP response code
    	} else
    		$this->response(array('error' => 'Widget could not be found'), 404);
    }
}