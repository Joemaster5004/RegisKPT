<?php
date_default_timezone_set("Asia/Bangkok");

  class MySqlConn{
    private $db_host = 'localhost';
  	private $db_user = 'root';
  	private $db_pass = '123456';
  	private $db_name = 'nkswdb';
    private $result = array();     // Results that are returned from the query

  	//--- connecter --->
  	//--- return connection
  	public function connect(){
  		try{
  			$myconn =  mysqli_connect($this->db_host,$this->db_user,$this->db_pass);     // or die(mysqli_error());
  			if($myconn){
  				$seldb = mysqli_select_db($myconn,$this->db_name);
                                  $seldb .= mysqli_query($myconn,"SET NAMES UTF8");
  				if($seldb){
  					return $myconn;
  				}else{
  					return false;
  				}
  			}else{
  				return false;
  			}
  		}catch(Exception $e){
  			return $e;
  		}
  	}#

  	//--- disconnect --->
  	public function disconnect(){
  		try{
  			if($this->con){
  				if(mysqli_close()){
  					$this->con = false;
  					return true;
  					//echo connection_status();
  				}else{
  					return false;
  				}
  			}
  		}catch(Exception $e){
  			return $e;
  		}
  	}#

  	//--- check table --->
  	//--- Return True,False
  	private function tableExists($table){
  		try{
  			if (!$this->connect())
  				exit('Error : Connection not found.');

  			$tablesInDb = mysqli_query($this->connect(),"SHOW TABLES FROM ".$this->db_name." LIKE '".$table."'");
  			if($tablesInDb){
  				if(mysqli_num_rows($tablesInDb)==1){
  					return true;
  				}else{
  					return false;
  				}
  			}else{
  				return false;
  			}
  		}catch(Exception $e){
  			return $e;
  		}
  	}#

  	//--- Insert data --->
  	//--- Return True,False
    public function insertData($table,$field,$values){
        if($this->tableExists($table)){
            $insert = 'INSERT INTO '.$table;
            if($field != null){
                $insert .= ' ('.$field.')';
            }
            $insert .= ' VALUES ('.$values.')';
            $ins = mysqli_query($this->connect(),$insert);
            if($ins){
                return true;
            }else{
                return false;
            }
        }
    }#

  	//--- Select All --->
  	//--- Return Array()
  	public function selectAllData($table, $field, $condition){
  		$q = 'SELECT '.$field.' FROM '.$table;
  		if($condition != null)
  			$q .= ' WHERE '.$condition;
  		try{
  			if($this->tableExists($table)){
  				$query = mysqli_query($this->connect(),$q);
  				$num = mysqli_num_rows($query);
  				$resultArray = array();
  				for ($i=1;$i<=$num;$i++){
  					$result = mysqli_fetch_array($query);
  					array_push($resultArray,$result);
  				}
  				mysqli_free_result($query);
  				return $resultArray;
  			}else
  				return false;
  		}catch(Exception $e){
  			return $e;
  		}
  	}#

  	//--- select One -->
  	//--- return data in array
  	public function selectOneData($table, $field, $condition){
  		$q = 'SELECT '.$field.' FROM '.$table;
  		if($condition != null)
  			$q .= ' WHERE '.$condition;
  		try{
  			if($this->tableExists($table)){
  				$db_query = mysqli_query($this->connect(),$q);     // or die("error Qeury [".$."]");
  				$resultOne = mysqli_fetch_array($db_query);
  				if($resultOne){
  					mysqli_free_result($db_query);
  					return $resultOne;
  				}else
  					return false;;
  			}else
  				return false;
  		}catch(Exception $e){
  			return $e;
  		}
  	}#

  	//--- Explode data by , of variable --->
  	private function updateEqual($field,$data){
  		$explodField = explode(',',$field);
  		$explodData = explode(',',$data);
  		//--- check $countField=$countField
  		$countField = count($explodField);
  		$countData = count($explodData);
  		try{
  			$result = $explodField[0].'='.$explodData[0];
  			if($countField == $countData){
  				if($countField > 1){
  					$result = NULL;
  					for($i=1; $i<=$countField; $i++){
  						if($i == $countField)
  							$comin = $explodField[$i-1].'='.$explodData[$i-1];
  						else
  							$comin = $explodField[$i-1].'='.$explodData[$i-1].',';
  						$result .= $comin ;
  					}
  				}
  				return $result;
  			}else
  				return false;
  		}catch(Exception $e){
  			return $e;
  		}
  	}#

  	//--- Updater --->
  	//--- Return T,F
  	 public function updateData($table,$field,$values,$condition){
          if($this->tableExists($table)){
              // Parse the where values
  			$chk = $this->updateEqual($field,$values);
  			if($chk){
  				$update = 'UPDATE '.$table.' SET '.$chk;
  				if($condition != null)
  					$update .= ' WHERE '.$condition;

  				$query = mysqli_query($this->connect(),$update);
  				if($query){
  					return true;
  				}else
  					return false;
  			}else
  				return false;
          }else
              return false;
      }#

  	//--- Delete --->
  	public function deleteData($table,$condition){
  		try{
  			if($this->tableExists($table)){
  				if($condition == null){
  					$delete = 'DELETE '.$table;
  				}else{
  					$delete = 'DELETE FROM '.$table.' WHERE '.$condition;
  				}
  				$select = $this->selectOneData($table,'*',$condition);
  				if($select){
  					$del = mysqli_query($this->connect(),$delete);
  					if($del){
  						return true;
  					}else
  						return false;
  				}else
  					return false;
  			}else
  				return false;
  		}catch(Exception $e){
  			return $e;
  		}
    }#
  }

?>
