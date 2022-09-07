<?php

/**
 * 
 */
class ipSession 
{
	public $error = false;
	public $currentArray = false;
	function __construct($ip)
	{
		$this->ip = $ip;
		if (empty($ip)) {
			$this->error = "noIP";
			return false;			
		}elseif(file_exists("/tmp/ipSession_".md5($this->ip))== true){
			$returnArray = json_decode(file_get_contents("/tmp/ipSession_".md5($this->ip)),true);
			if ($returnArray!== NULL) {
			$this->error = md5($this->ip);
			$this->currentArray = $returnArray;
			return $this->currentArray;
			}else{
				$this->error = "notAnJSON";
				return false;
			}
		}elseif(file_exists("/tmp/ipSession_".md5($this->ip))== false and file_put_contents("/tmp/ipSession_".md5($this->ip), "[]") == true){
			$this->error = "newIP";
			$this->currentArray = array();
			return $sessionArray;
		}else{
			$this->error = "unknown";
			return false;
		}
	}
	function writeSession(){
		if(empty($this->ip) == false){
			if(file_put_contents("/tmp/ipSession_".md5($this->ip), json_encode($this->currentArray))){
				$this->error = false;
				return true;
			}else{
				$this->error = "fileError";
				return false;
			}
		}else{
			$this->error = "noIP";
			return false;
		}
	}
	function close(){
		if(empty($this->ip) == false){
			if(unlink("/tmp/ipSession_".md5($this->ip)) == true){
				$this->error = false;
				return true;
			}else{
				$this->error = "fileError";
				return false; 
			}
		}else{
			$this->error = "noIP";
		}
	}
}
