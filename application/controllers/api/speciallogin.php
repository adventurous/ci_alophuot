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

class Speciallogin extends REST_Controller
{
	var $REST_CLIENT_ID = "af1a6dad481fac130b474f6c676fcaa5";
	var $ACCESS_TOKEN   = "5271be0ab0054f1b920d96ec41224f096c115d38";
	var $REFESH_TOKEN    = "cc6e0c939ca3c8ba100362cc2df78c813c0f83b8";
	var $EXPIRED_IN		= 31536000;
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
			$device_id = $data['device_id'];
			$code = $data['code'];
			$request_client_id = $data['rest_client_id'];
			if(strcmp($request_client_id,$this->REST_CLIENT_ID)!=0 || is_null($device_id) || is_null($code)){
				$this->response(array('result' => array('success'=>false,'message'=>'Wrong post value! code=&device_id=&client_id=')), 200);
				return;
			}
			$datainfo = array('username'=>$code,'passwork'=>$device_id);
			$this->load->model('get_dbuser');
			$dataget["results"] = $this->get_dbuser->getUserId($datainfo);
            if (!is_null($dataget["results"])) {
                //$widget = array('status' => "success", 'Auth' => array('user'=>$code,'passwork'=>$device_id,'token_request_server'=>$this->REST_SERVER_ID,'time_litmit_request'=>3100000)); // test code
                $result = array('result'=>array('success'=>true,'message'=>"Authorized! ",'data'=>array('access_token'=>$this->ACCESS_TOKEN,'refesh_token'=>$this->REFESH_TOKEN,'expired_in'=>$this->EXPIRED_IN),'info'=>array('Email'=>!empty($dataget['username']),'LoginName'=>!empty($dataget['username']),'Passwork'=>!empty($dataget['password']),'FullName'=>!empty($dataget['fullname']),'Phone'=>!empty($dataget['phone']))));
                $this->response($result, 200); // 201 being the HTTP response code
            } else {
                $this->response(array('result'=>array('success'=>false,'message'=>"Account isn't exist!")),200);
            }
		} catch (Exception $e) {
			// Here the model can throw exceptions like the following:
			// * For invalid input data: new Exception('Invalid request data', 400)
			// * For a conflict when attempting to create, like a resubmit: new Exception('Widget already exists', 409)
			$this->response(array('status' => $e->getMessage()), $e->getCode());
		}
		
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