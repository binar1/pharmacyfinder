<?php
/**
* binar
*/
class Admin 
{
	private $_db,
	        $_data,
	        $_SessionNameAdmin,
	        $_SessionPharmacy,
					$_CookieName,
					$_isLoggedIn,
					$_conn
					;

	function __construct($Admin=null,$table=null)
	{
		
	 $this->_db=DB::getInstance();
	 $this->_conn=DB::connect();
	 $this->_SessionNameAdmin=Config::get('session/session_name');
	 $this->_SessionPharmacy=Config::get('session/session_organization');
     $this->_CookieName=Config::get('remember/cookie_name');
	 if (!$Admin) {
	 	if (Session::exists($this->_SessionNameAdmin)) {
			 $Admin=Session::get($this->_SessionNameAdmin);
	 		if ($this->find('admin',$Admin)) {
	 			$this->_isLoggedIn=true;
	 		}else
	 		{
	 			//logout
	 		}
	 	}elseif (Session::exists($this->_SessionNameAdmin)) {
	 		$Admin=Session::get($this->_SessionNameAdmin);
           if ($this->find('admin',$Admin)) {
	 			$this->_isLoggedIn=true;
	 		}else
	 		{
	 			//logout
	 		}
	 	}
	 }else
	 	{
	 	   	
	 	 $this->find($table,$Admin);
	 		
	 		
	 	}
	}

	public function create ($table,$fields=array()){
    if (!$this->_db->insert($table,$fields)) {
       throw new Exception	('there was a problem creating an account');
    }
}

public function find($table=null,$email=null){
	if ($email) {
	$field=false;	
	if ($table==='admin') {
	$field=(is_numeric($email)) ? 'admin_id':'email';	
	}
	$data=$this->_db->get($table,array($field,'=',$email));
    if ($this->_db->count()) {
		$this->_data=$this->_db->first();
		return true;
	}
	}
	return false;
}


public function login($table,$email=null,$password=null,$remember =false){
	
   if (!$email && !$password && $this->exists()) {
   	  return "please fill all fields";
   }else{
   	$Admin=$this->find($table,$email);
   if ($Admin){
	  	//  echo $this->data()->password."<br>".Hash::make($password,$this->data()->salt);
    	if ($this->data()->password === Hash::make($password,$this->data()->salt)) {
			Session::put($this->_SessionNameAdmin,$this->data()->admin_id);

		}else{
            // echo " ".$password."<br>";
            // echo $this->data()->password." <br>  ". Hash::make($password,$this->data()->salt);
            return "password is wrong";
        }
	
			$Admin_id=false;
			if ($table==='admin') {
				$Admin_id=$this->data()->admin_id;
			}
			$hash=Hash::unique();
            $hashCheck=$this->_db->get('admin_session',array('admin_id','=',$Admin_id));
           
			if (!$this->_db->count()) {
				$this->_db->insert('admin_session',array(
					'admin_id' => $this->data()->admin_id,
					 'hash'=>$hash
                 ));
            	}else{
                    $hash=$this->_db->first()->hash;
                    
			}
			Cookie::put($this->_CookieName,$hash,Config::get('remember/cookie_expiry'));
			return 'true';
		
	}else{
		return "email does not exist";

	}
}

	return false;
}
public function data(){
	return $this->_data;
}

public function isLoggedIn(){
	return $this->_isLoggedIn;
}
public function logout()
{
   $this->_db->delete('Admin_session',array('id','=',$this->data()->id));
   Session::delete($this->_SessionNameAdmin);
   Session::delete($_SESSION['type']);
   Session::delete($this->_SessionPharmacy);
   Cookie::delete($this->_CookieName);
}
public function updateInfo($table,$fields=array(),$id=null)
{
  if (!$id && $this->_isLoggedIn) {
  	$id= $this->data()->admin_id;
  }

	
	if (!$this->_db->update($table,'id',$id,$fields))
	{
  	throw new Exception('there was aproblem updating!!');
  	return false;
  }	
	

  
}
public function exists()
{
	return (!empty($this->_data)) ? true:false;
}

public function getAllAdmins() {
	$sql = "SELECT * FROM admin ";
	$stmt = $this->_conn->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getAllPosts() {
	$sql = "SELECT medicine.id,medicine.created_at,medicine.name,medicine.advantage,medicine.status,medicine.cost,user.name as 'pharmacy' FROM medicine INNER JOIN user
	ON user.id=medicine.id_user order by medicine.status";
	$stmt = $this->_conn->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getAllPostscount() {
	$sql = "SELECT count(*) FROM medicine where status=0"; 
	$stmt = $this->_conn->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function deleteadmin($admin_id){
    echo $this->_isLoggedIn.'hh';
    if ($this->_isLoggedIn) {
   
	if (!$this->_db->delete('admin',array('admin_id','=',$admin_id)))
	{
  	throw new Exception('there was aproblem updating!!');
  	return false;
  }	
	
	return true;
    }else{
        return false;
    }
   
}

public function deleteuser($user_id){

	if ($this->_isLoggedIn) {
 
if (!$this->_db->delete('user',array('id','=',$user_id)))
{
	throw new Exception('there was aproblem updating!!');
	return false;
}	

return true;
	}else{
			return false;
	}
 
}
public function deleteuserposts($user_id){
   echo $this->_isLoggedIn;
	if ($this->_isLoggedIn) {
 
if (!$this->_db->delete('medicine',array('id_user','=',$user_id)))
{
	throw new Exception('there was aproblem updating!!');
	return false;
}	

return true;
	}else{
			return false;
	}
 
}


public function deleteOnePost($id){
	echo $this->_isLoggedIn;
 if ($this->_isLoggedIn) {

if (!$this->_db->delete('medicine',array('id','=',$id)))
{
 throw new Exception('there was aproblem updating!!');
 return false;
}	

return true;
 }else{
		 return false;
 }

}
 } 	

?>