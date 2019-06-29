<?php

/**
* 
*/
class Hash 
{
	
	function __construct()
	{
		
	}

	public static  function make($string,$salt=''){
     return hash('sha256',$string.$salt);
      
	}
	public static  function salt($length){
		if (function_exists('random_bytes')) {
			return random_bytes($length);
		}else{
			return openssl_random_pseudo_bytes($length);
		}
		
	}
	public static  function unique(){
	 return self::make(uniqid());	
	}

}

?>