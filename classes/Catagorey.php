<?php

class Catagorey{
	private $_db,
    $_data,
    $_result;
    function __construct($all=null,$one=null)
 	{
 		$this->_db=DB::getInstance();
      if ($all) {
       	$this->find($event);
       } 
       if ($one) {
           $this->catagorey($one);
       }

     
     }
     

     public function find($eventid=null)
 	{
        if (!$this->_db->query("select * from catagorey")) {
            throw new Exception("you have an error in select all catagorey");
        }else{
            if ($this->_db->count()) {
                $this->_data=$this->_db->result();
            }
        }
 		}

public function catagorey($type=null)
{
 if ($type)
   {
        if (!$this->_db->get('catagorey',array('catagorey_id','=',$type))) {
            throw new Exception("ou have an error in get Catagorey types");
            
        }else{
            
            if ($this->_db->count()) {
                $this->_result=$this->_db->result();
                 }
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