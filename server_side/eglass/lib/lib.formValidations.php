<?php
function validate_txtisset($fieldname,$displaytext,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(strlen(trim($_GET[$fieldname]))==0){
			return $displaytext."<br />";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(strlen(trim($_POST[$fieldname]))==0){
			return $displaytext."<br />";
		}
	}
}


function validate_isnumeric($fieldname,$required="no",$displaytext,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if($required=="yes")
		{
			if(strlen($_GET[$fieldname])==0 || (is_numeric($_GET[$fieldname])==false))
			{
				return $displaytext."<br />";
			}
		}
		else
		{
			if(strlen($_GET[$fieldname])>0 && (is_numeric($_GET[$fieldname])==false))
			{
				return $displaytext."<br />";
			}
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if($required=="yes")
		{
			if(strlen($_POST[$fieldname])==0 || (is_numeric($_POST[$fieldname])==false))
			{
				return $displaytext."<br />";
			}
		}
		else
		{
			if(strlen($_POST[$fieldname])>0 && (is_numeric($_POST[$fieldname])==false))
			{
				return $displaytext."<br />";
			}
		}	
	}
}

function validate_email($fieldname,$required="no",$displaytext,$method="POST")
{
	if(strtoupper($method)=="GET")
	{	
		if($required=="yes")
		{
			if(strlen($_GET[$fieldname])==0 || (preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/",$_GET[$fieldname]) == 0)){
				return $displaytext."<br />";
			}	
		}
		else
		{
			if(strlen($_GET[$fieldname])>0 && (preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/",$_GET[$fieldname]) == 0)){
				return $displaytext."<br />";
			}
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if($required=="yes")
		{
			if(strlen($_POST[$fieldname])==0 || (preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/",$_POST[$fieldname]) == 0)){
				return $displaytext."<br />";
			}	
		}
		else
		{
			if(strlen($_POST[$fieldname])>0 && (preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/",$_POST[$fieldname]) == 0)){
				return $displaytext."<br />";
			}
		}	
	}
}

function validate_email_value($fieldname,$displaytext)
{

	if(strlen($fieldname)==0 || (preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/",$fieldname) == 0)){
				return $fieldname." - ".$displaytext."<br />";
	}	

}

function validate_email_value_check($emailaddr)
{
	
	$emailaddrz=strtolower($emailaddr);
	
	if(strlen($emailaddrz)==0 || (preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/",$emailaddrz) == 0))
	{
		return false;
	}	
	else
	{
		return true;
	}

}

function validate_confirmpasswordmatch($fieldname1,$fieldname2,$displaytext,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if($_GET[$fieldname1] != $_GET[$fieldname2])
		{
			return $displaytext."<br />";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if($_POST[$fieldname1] != $_POST[$fieldname2])
		{
			return $displaytext."<br />";
		}	
	}
}


//////////// Function for check valid password //////////

function validate_password($field,$displaytext,$method="POST")
{
	$is_success = 0;
	
	$numberarray = getNumbers();
	$length = count($numberarray);
	
	for($i=0;$i<strlen($_POST[$field]);$i++)
	{
		$char = substr($_POST[$field],$i,1);
		
		if(in_array($char,$numberarray))
		{
			$is_success = 1;
			break;
		}
	}
	
	if($is_success == 0)
	{
		return $displaytext."<br />";
	}
	
	if($is_success == 1)
	{
		$is_success = 0;
									
		$specialcharsarray = array("!",'"',"#",".","@","_","`","~");
		
		$notallowSpecialCharsarray = getnotallowSpecialChars();
		
		$length = count($specialcharsarray);

		for($i=0;$i<strlen($_POST[$field]);$i++)
		{
			$char = trim(substr($_POST[$field],$i,1));
			
			if(in_array($char,$specialcharsarray))
			{
				$is_success = 1;
			}
			if(in_array($char,$notallowSpecialCharsarray))
			{
				$is_success = 0;
				return $displaytext."<br />";
			}
		}

		if($is_success == 0)
		{
			return $displaytext."<br />";
		}
	}
}
function getNumbers()
{
	$array  = array();
	
	for($i=48;$i<=57;$i++)
	{
		$array[] = chr($i);
	}
	
	return $array;
}

function getnotallowSpecialChars()
{
	$array  = array();
	
	$array[] = chr(34);

	for($i=36;$i<=47;$i++)
	{
		if ($i == 46)
		{
			continue;
		}
		$array[] = chr($i);
	}

	for($i=58;$i<=63;$i++)
	{
		$array[] = chr($i);
	}
	
	for($i=91;$i<=94;$i++)
	{
		$array[] = chr($i);
	}
	
	for($i=123;$i<=125;$i++)
	{
		$array[] = chr($i);
	}
	
	return $array;
}
////////// END ///////////////////////

function validate_selectisset($fieldname,$displaytext,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(empty($_GET[$fieldname]) || ($_GET[$fieldname]===0) ){
			return $displaytext."<br />";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(empty($_POST[$fieldname]) || ($_POST[$fieldname]===0) ){
			return $displaytext."<br />";
		}
	}	
}

function validate_csvfile($file,$displaytext)
{
	$fileExtArr=explode(".",$file['name']);
	$fileExt=strtolower($fileExtArr[count($fileExtArr)-1]);
	
	if( (($file['type']=="application/csv") || $fileExt=="csv") == false)
	{
		return $displaytext."<br />";
	}
}


function validate_checkadminexists_insert($fieldname,$displaytext,$method="POST")
{
global $dbObj;



		//CHECK USERS EXISTS OR NOT
		$chkuser="false";
		
		if(strtoupper($method)=="GET")
		{
		$username=htmlentities(trim($_GET[$fieldname]));
		}
		else
		{
		$username=htmlentities(trim($_POST[$fieldname]));
		}
		
		$usersQry="select `adminId`, `adminLogin` from admin where adminLogin='".$username."' and isDeleted='no' ";
		
		$usersRes=$dbObj->fireQuery($usersQry);
			
			$usersResCount=count($usersRes);
			
			if(isset($usersRes) && ($usersResCount>0) && ($usersRes!=false) )
			{
				for($u=0;$u<$usersResCount;$u++)
				{
					if( ($usersRes[$u]['adminLogin']==$username) )
					{
					$chkuser="true";
					break;
					}
				}
			}
		
			if($chkuser=="true")
			{
			return $displaytext."<br />";
			}
		//CHECK USERS EXISTS OR NOT ENDS
}

function validate_checkadminexists_update($fieldname,$displaytext,$uid,$method="POST")
{
global $dbObj;



		//CHECK USERS EXISTS OR NOT
		$chkuser="false";
		
		if(strtoupper($method)=="GET")
		{
		$username=htmlentities(trim($_GET[$fieldname]));
		}
		else
		{
		$username=htmlentities(trim($_POST[$fieldname]));
		}
		
		$usersQry="select `adminId`, `adminLogin` from admin where adminLogin='".$username."' and isDeleted='no' and adminId!=".$uid;
		
		$usersRes=$dbObj->fireQuery($usersQry);
			
			$usersResCount=count($usersRes);
			
			if(isset($usersRes) && ($usersResCount>0) && ($usersRes!=false) )
			{
				for($u=0;$u<$usersResCount;$u++)
				{
					if( ($usersRes[$u]['adminLogin']==$username) )
					{
					$chkuser="true";
					break;
					}
				}
			}
		
			if($chkuser=="true")
			{
			return $displaytext."<br />";
			}
		//CHECK USERS EXISTS OR NOT ENDS
	
	
	
}







function validate_checkcustomerexists_insert($fieldname,$displaytext,$method="POST")
{
global $dbObj;



		//Check Customer exists or not - Start
		$chkuser="false";
		
		if(strtoupper($method)=="GET")
		{
		$username=htmlentities(trim($_GET[$fieldname]));
		}
		else
		{
		$username=htmlentities(trim($_POST[$fieldname]));
		}
		
		
		$usersQry="select `customerId`, `customerName` from customers where customerName='".$username."' and isDeleted='no' ";
		
		$usersRes=$dbObj->fireQuery($usersQry);
			
			$usersResCount=count($usersRes);
			
			if(isset($usersRes) && ($usersResCount>0) && ($usersRes!=false) )
			{
				for($u=0;$u<$usersResCount;$u++)
				{
					if( ($usersRes[$u]['customerName']==$username) )
					{
					$chkuser="true";
					break;
					}
				}
			}
		
			if($chkuser=="true")
			{
			return $displaytext."<br />";
			}
		//Check Customer exists or not - End
		
		
}

function validate_checkcustomerexists_update($fieldname,$displaytext,$uid,$method="POST")
{
global $dbObj;



		//Check Customer exists or not - Start
		$chkuser="false";
		
		if(strtoupper($method)=="GET")
		{
		$username=htmlentities(trim($_GET[$fieldname]));
		}
		else
		{
		$username=htmlentities(trim($_POST[$fieldname]));
		}
		
		$usersQry="select `customerId`, `customerName` from customers where customerName='".$username."' and isDeleted='no' and customerId!=".$uid;
		
		
		$usersRes=$dbObj->fireQuery($usersQry);
			
			$usersResCount=count($usersRes);
			
			if(isset($usersRes) && ($usersResCount>0) && ($usersRes!=false) )
			{
				for($u=0;$u<$usersResCount;$u++)
				{
					if( ($usersRes[$u]['customerName']==$username) )
					{
					$chkuser="true";
					break;
					}
				}
			}
		
			if($chkuser=="true")
			{
			return $displaytext."<br />";
			}
		//Check Customer exists or not - End
	
	
	
}













?>