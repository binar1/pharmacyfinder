<?php
  /**
  * 
  */
  class ValidationMember 
  {
   private $_passed=false,
           $_error=array(),
           $_db=null;
  	function __construct()
  	{
  		$this->_db=DB::getInstance();
  	}

  	public  function check($source,$items = array()){
      
       foreach ($items as $item => $rules) {
         foreach ($rules as $rule => $rule_value) {
           $value=$source[$item];

           if ($rule==='require' && empty($value)) {
             $this->addError("{$item}, is required");
           }else if(!empty($value)){
            switch ($rule) {
              case 'min':
                if (strlen($value)< $rule_value) {
                 $this->addError("{$item}, must be more than".$rule_value);
                }
                break;
                case 'max':
                if (strlen($value)> $rule_value) {
                 $this->addError("{$item}, must  be less than".$rule_value);
                }
                break;
                case 'matches':
                if ($value != $source[$rule_value]) {
                 $this->addError("{$item},is not equal with Password");
                }
                break;
                case 'type':
                if ($rule_value==='number') {
                 if (!ctype_digit($value)) {
                 $this->addError("{$item},must be just a number");
                }
                }elseif($rule_value==='email'){
                   if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                      $this->addError("{$item},must be Email!!"); 
                      }
                }
                
                break;
                case 'unique':
                 $check=$this->_db->get($rule_value,array('email','=',$value));
                 if ($this->_db->count()) {
                    $this->addError("This Email is used!!");
                 }
                break;

                case 'less':
                        if ($value<$rule_value) {
                          $this->addError(" $item,Can Not be Less Than $rule_value");
                        }
                        break;      
              default:
                # code...
                break;
            }

           }
         }
       }

       if (empty($this->_error)) {
        $this->_passed=true;
       }
        return $this;
  	}

    public function checkImage($source,$items = array())
  {
        
        foreach ($items as $item => $rules) {
             $value=$source[$item];
             $ImageSize=$source[$item]['size'];
             $ImageName=$source[$item]['name'];
             $ImageType=$source[$item]['type'];
             $ImageError=$source[$item]['error'];
             $ImageExt=explode('.',$ImageName);
             $ActualExt=strtolower(end($ImageExt));

            if (!$ImageError===0) {
              $this->addError("your upload filed or has an error");
            }
          foreach ($rules as $rule => $rules_value) {
            switch ($rule) {
              case 'max':
                if ($ImageSize>$rules_value) {
                  $this->addError("{$item} size is more than {$rules_value}");
                }
                break;
              case 'type':
                if (!in_array($ActualExt,$rules_value)) {
                  $types='';
                  foreach ($rules_value as $type) {
                     $types=$types.$type.",";  }
                   $this->addError(" This {$item} Type is Not Allowed just $types allowes");   
                  }
                break;
              
              default:
                # code...
                break;
            }
          }
        }
      if (empty($this->_error)) {
        $this->_passed=true;
       }
        return $this;

  }

    private function addError($error){
    $this->_error[]=$error;
    }
    public  function errors(){
        return  $this->_error;
    }
    public  function passed(){
        return  $this->_passed;
    }
  }


?>