<?php
//include_once("constants.inc.php");

class dbConnection{
	
	private $host=DB_HOST;
	private $user=DB_USER;
	private $pass=DB_PASSWORD;
	private $db=DB_NAME;
	private $lnk;
	private $host_replica=DB_HOST_REPLICA;
	private $user_replica=DB_USER_REPLICA;
	private $pass_replica=DB_PASSWORD_REPLICA;
	
	var		$result;

	function dbConnection(){
		$this->connect();		
		return $this;
	}

	function connect(){
		$this->lnk=mysql_connect($this->host,$this->user,$this->pass);
		if(!$this->lnk){
			$this->lnk=mysql_connect($this->host_replica,$this->user_replica,$this->pass_replica);
		}
		mysql_select_db($this->db,$this->lnk);	
		return $this->lnk;	
	}
	
	function fireQuery($query,$type="select",$result_type=MYSQL_BOTH){
		$this->result=mysql_query($query,$this->lnk);
		if($this->result){
			if($type=="select"){
				$this->result = $this->makeRowSet($this->result,$result_type);	
				if($this->result){
					return $this->result;
				}else{
					return false;
				}
			}elseif($type=="config"){
				return $this->configRow($this->result);
			}elseif($type=="insert"){
				return mysql_insert_id($this->lnk);
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
	
	function configRow($result){
		$configRowSet=array();
		while($row=mysql_fetch_row($result)){
			$configRowSet[$row[0]]=$row[1];
		}
		return $configRowSet;
	}
	
	function makeRowSet($result,$result_type=MYSQL_BOTH){
		$dataRowSet=array();
		if(mysql_num_rows($result)>0){
			while($row=mysql_fetch_array($result,$result_type)){
				array_push($dataRowSet,$row);
			}
		}else{
			$dataRowSet=NULL;
		}
		return $dataRowSet;
	}
}
?>
