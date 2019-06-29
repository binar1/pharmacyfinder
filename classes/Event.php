<?php
 /** 
 * 
 */
 class Event
 {
 	private $_db,
 	        $_data,
 	        $_result;
 	
 	function __construct($event=null,$type=null,$organization=null)
 	{
 		$this->_db=DB::getInstance();
      if ($event) {
       	$this->find($event);
       } 
       if ($type) {
       	$this->findType($type);
       }

       if ($organization) {
        
         $this->findOrganizationEvents($organization);
       }
 	}

 	public function find($eventid=null)
 	{
 		if ($eventid) {

 		 if (!$this->_db->get('medicine',array('id','=',$eventid ))) {
 		    throw new Exception("you have an errror in selection event");
 		 }else{
          if($this->_db->count())
          { 
            $this->_data=$this->_db->first();
           }
         }
        }
 		}
   

    public function findType($type=null)
    {
     if ($type)
       {
       	   if (!$this->_db->get('medicine',array('catagorey_id','=',$type))) {
       	       throw new Exception("ou have an error in get event types");
       	       
       	   }else{

       	   	       if ($this->_db->count()) {
       	   	       	$this->_result=$this->_db->result();
       	   	       }
                }  

    }
}



public function findOrganizationEvents($id)
    {
     if ($id)
       {
           if (!$this->_db->get('medicine',array('id_user','=',$id))) {
               throw new Exception("ou have an error in get event types");
               
           }else{

                   if ($this->_db->count()) {
                    $this->_result=$this->_db->result();
                   }
                }  

    }
}


public  function addEvent($table,$fields)
{
if (!$this->_db->insert($table,$fields)) {
       throw new Exception  ('there was a problem add event');
    }else
    {
      Redirect::to('../index.php');
    }
}



public function result(){
	return $this->_result;
}

public function data()
{
	return $this->_data;
}
}
?>