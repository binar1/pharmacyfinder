<?php
/**
* binar
*/
class User 
{
	private $_db,
	        $_data,
	        $_SessionName,
	        $_SessionPharmacy,
					$_CookieName,
					$_isLoggedIn,
					$_conn
					;

	function __construct($user=null,$table=null)
	{
		
	 $this->_db=DB::getInstance();
	 $this->_conn=DB::connect();
	 $this->_SessionName=Config::get('session/session_name');
	 $this->_SessionPharmacy=Config::get('session/session_organization');
     $this->_CookieName=Config::get('remember/cookie_name');
	 if (!$user) {
	 	if (Session::exists($this->_SessionName)) {
			 $user=Session::get($this->_SessionName);
	 		if ($this->find('user',$user)) {
	 			$this->_isLoggedIn=true;
	 		}else
	 		{
	 			//logout
	 		}
	 	}elseif (Session::exists($this->_SessionName)) {
	 		$user=Session::get($this->_SessionName);
           if ($this->find('user',$user)) {
	 			$this->_isLoggedIn=true;
	 		}else
	 		{
	 			//logout
	 		}
	 	}
	 }else
	 	{
	 	   	
	 	 $this->find($table,$user);
	 		
	 		
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
	if ($table==='user') {
	$field=(is_numeric($email)) ? 'id':'email';	
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
   	  return '';  return "please fill all fields";
   }else{
   	$user=$this->find($table,$email);
   if ($user){
	  
    	if ($this->data()->password === Hash::make($password,$this->data()->salt)) {
			Session::put($this->_SessionName,$this->data()->id);

		}else{
		
			return "password is wrong";
	}
		
			$user_id=false;
			if ($table==='user') {
				$user_id=$this->data()->id;
			}
			$hash=Hash::unique();
			$hashCheck=$this->_db->get('user_session',array('id','=',$user_id));
			if (!$this->_db->count()) {
				$this->_db->insert('user_session',array(
					'id' => $this->data()->$user_id,
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
   $this->_db->delete('user_session',array('id','=',$this->data()->id));
   Session::delete($this->_SessionName);
   Session::delete($_SESSION['type']);
   Session::delete($this->_SessionPharmacy);
   Cookie::delete($this->_CookieName);
}
public function updateInfo($table,$fields=array(),$oldPassword,$id=null)
{
  if (!$id && $this->_isLoggedIn) {
  	$id= $this->data()->id;
	}
	
if ($this->data()->password===Hash::make($oldPassword,$this->data()->salt)) {
	
	if (!$this->_db->update($table,'id',$id,$fields))
	{
  	throw new Exception('there was aproblem updating!!');
  	return false;
  }else{

		return 'true';
	}	
	
}else{
	return 'password is  not your current password';
}
  
}

 public function updateImage($table,$fields=array(),$id=null)
 {
 	if (!$id && $this->_isLoggedIn) {
		$id=$this->data()->id;
 	}
 	if ($this->data()->img) {
 		unlink("../images/Profile/".$this->data()->img);
 	}
 	 	
    if (!$this->_db->update($table,'id',$id,$fields)){
 		throw new Exception('there was aproblem updating!!');
 	}
 	 
 	
 } 	

 public function getAllPharmacy() {
	$sql = "SELECT * FROM user";
	$stmt = $this->_conn->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
  public function getOnepharmacy($name=null){
		$sql = "SELECT * FROM user where name like '%$name%'";
		$stmt = $this->_conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getOnepharmacyByID($id=null){
		$sql = "SELECT * FROM user where id=$id";
		$stmt = $this->_conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
 public function imageCertificate($table,$fields=array(),$id=null)
 {
 if (!$id && $this->_isLoggedIn) {

 		$id= $this->data()->id;
 	}	
    if ($this->data()->certificate ){
 		unlink("../images/Certificate/".$this->data()->certificate);
 	}
 	if (!$this->_db->update($table,'id',$id,$fields)){
 		throw new Exception('there was aproblem updating!!');
 	}

 }

 public function ImagesPrepare($file,$location){
   $filename=$file['name'];
    $fileExt=explode('.',$filename);
    $fileActuaExt=strtolower(end($fileExt));
    $newFileName=uniqid('',true).'.'.$fileActuaExt;
    move_uploaded_file($file['tmp_name'],"../images/".$location.$newFileName);
    return $newFileName;
 }


public function exists()
{
	return (!empty($this->_data)) ? true:false;
}


public function getPharmacyBlankLatLng() {
	$sql = "SELECT * FROM user WHERE lat = 0 AND log = 0";
	$stmt = $this->_conn->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



public function updatePharmacyWithLatLng($id,$lat,$long) {
	$sql = "UPDATE user SET lat = :lat, log = :lng WHERE id = :id";
	$stmt = $this->_conn->prepare($sql);
	$stmt->bindParam(':lat', $lat);
	$stmt->bindParam(':lng', $long);
	$stmt->bindParam(':id', $id);

	if($stmt->execute()) {
		return true;
	} else {
		return false;
	}
}
}
?>