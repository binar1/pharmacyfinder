<?php
/**
* 
*/
class Posts
{
	private $_db,
	        $_result,
	        $_data;
	
	function __construct($id=null,$type=null)
	{
	    $this->_db=DB::getInstance();

	   if($id){
			$this->finduserPro($id);
		 }else{
			$this->find($type);
		 }
	}
	public function finduserPro($type=null)
	{
		if ($type) {
			if ($this->_db->get('medicine',array('id_user','=',$type))) {
				if ($this->_db->count()) {
					$this->_result=$this->_db->result();
				}
	}
}
	}
   public function find($type=null)
   {
     if ($type) {
			if (!$this->_db->query("select * from medicine where name like '%$type%'")) {
				throw new Exception("you have an error in select all catagorey");
			}else{
				if ($this->_db->count()) {
					$this->_result=$this->_db->result();
				}
			}
     }else{
     	if (!$this->_db->query("select * from medicine where status=1")) {
     		throw new Exception("you have an error in select all catagorey");
     	}else{
     		if ($this->_db->count()) {
     			$this->_result=$this->_db->result();
     		}
     	}
     }

	 }
	 public function findMYPOSt($con=null)
   {
     
     	if ($this->_db->get('medicine',array('id_user','=',$con))) {
     		if ($this->_db->count()) {
     		 return $this->_data=$this->_db->result();	
				 }
           
     		
     	}

   }

   public function result()
   {
   	return $this->_result;
   }
   public function count()
   {
   	return $this->_result.length;
   }


  public function data()
  {
  	return $this->_data;
  }  

  

}



?>