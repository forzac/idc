<?php
namespace admin\models;
use yii\base\Model;

class Lang{
    private $db;    
    private $controller;
    private $error = false;
    private $response = ["render"=>"lang/lang","error"=>0,"message"=>"","data"=>[]];
    
    public static function Initializ(&$controller){ 
        return new Lang($controller); 
    }    
    public function __construct(&$controller){ 
        $this->db = \Yii::$app->db;
        $this->controller = $controller;
    }	
	public function __destruct(){ $this->db->close(); }
	
	public function exeModel()
    {
		
        
        return $this;		
	}
    
	public function getResult()
    {
		if($this->error) 
			return $this->error;
		else return $this->result;		
	}
    
    public function getResponse(){
        return $this->response;
    }
    
    public function getAjaxResponse(){
        return $this->response;
    }
}