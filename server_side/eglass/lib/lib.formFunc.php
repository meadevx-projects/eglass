<?php

function form_submit_textbox($fieldname,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldname]) && strlen($_GET[$fieldname])>0 )
		{ 
			return htmlentities(trim($_GET[$fieldname])); 
		}
		else
		{
			return "";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldname]) && strlen($_POST[$fieldname])>0 )
		{ 
			return htmlentities(trim($_POST[$fieldname])); 
		}
		else
		{
			return "";
		}		
	}
}

function form_submit_textbox_numeric($fieldname,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldname]) && strlen($_GET[$fieldname])>0 )
		{ 
			return htmlentities(trim($_GET[$fieldname])); 
		}
		else
		{
			return "0";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldname]) && strlen($_POST[$fieldname])>0 )
		{ 
			return htmlentities(trim($_POST[$fieldname])); 
		}
		else
		{
			return "0";
		}
	}		
}

function form_submit_radiobtn($fieldname,$fieldval,$defaultval="",$method="POST")
{
	
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldname]) && ($_GET[$fieldname]==$fieldval))
		{ 
			return "checked='checked'";
		}
		else if(!(isset($_GET[$fieldname])) && $defaultval=="default_true")
		{
			return "checked='checked'";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldname]) && ($_POST[$fieldname]==$fieldval))
		{ 
			return "checked='checked'";
		}
		else if(!(isset($_GET[$fieldname])) && $defaultval=="default_true")
		{
			return "checked='checked'";
		}
	}
}

function form_submit_checkbox($fieldname,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldname]))
		{ 
			return "checked='checked'";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldname]))
		{ 
			return "checked='checked'";
		}
	}
}


function form_submit_select($fieldname,$fieldval,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldname]) && ($_GET[$fieldname]==$fieldval))
		{ 
			return "selected='selected'";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldname]) && ($_POST[$fieldname]==$fieldval))
		{ 
			return "selected='selected'";
		}
	}
}



// -----------------------------------------------------------------------------------


function form_submit_update_textbox($fieldname,$dbcolval,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldname]))
		{ 
			return htmlentities(trim($_GET[$fieldname])); 
		}
		else if(isset($dbcolval) && strlen($dbcolval)>0 && $dbcolval!=false)
		{ 
			return htmlentities(trim($dbcolval)); 
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldname]))
		{ 
			return htmlentities(trim($_POST[$fieldname])); 
		}
		else if(isset($dbcolval) && strlen($dbcolval)>0 && $dbcolval!=false)
		{ 
			return htmlentities(trim($dbcolval)); 
		}
	}	
}

function form_submit_update_radiobtn($fieldname,$dbcolval,$fieldval,$defaultval,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldname]) && ($_GET[$fieldname]==$fieldval))
		{ 
			return "checked='checked'";
		}
		else if(!isset($_GET[$fieldname]) && isset($dbcolval) && strlen($dbcolval)>0 && $dbcolval!=false && ($dbcolval==$fieldval) )
		{ 
			return "checked='checked'";
		}
		else if(!isset($_GET[$fieldname]) && $dbcolval==false && $defaultval=="default_true")
		{
			return "checked='checked'";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldname]) && ($_POST[$fieldname]==$fieldval))
		{ 
			return "checked='checked'";
		}
		else if(!isset($_POST[$fieldname]) && isset($dbcolval) && strlen($dbcolval)>0 && $dbcolval!=false && ($dbcolval==$fieldval) )
		{ 
			return "checked='checked'";
		}
		else if(!isset($_POST[$fieldname]) && $dbcolval==false && $defaultval=="default_true")
		{
			return "checked='checked'";
		}	
	}
}


function form_submit_update_checkbox($fieldname,$dbcolval,$fieldval,$defaultval,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldname]) && ($_GET[$fieldname]==$fieldval))
		{ 
			return "checked='checked'";
		}
		else if(isset($dbcolval) && strlen($dbcolval)>0 && $dbcolval!=false && ($dbcolval==$fieldval) )
		{ 
			return "checked='checked'";
		}
		else if($dbcolval==false && $defaultval=="default_true")
		{
			return "checked='checked'";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldname]) && ($_POST[$fieldname]==$fieldval))
		{ 
			return "checked='checked'";
		}
		else if(isset($dbcolval) && strlen($dbcolval)>0 && $dbcolval!=false && ($dbcolval==$fieldval) )
		{ 
			return "checked='checked'";
		}
		else if($dbcolval==false && $defaultval=="default_true")
		{
			return "checked='checked'";
		}	
	}
}

function form_submit_update_select($fieldname,$dbcolval,$fieldval,$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldname]) && ($_GET[$fieldname]==$fieldval))
		{ 
			return "selected='selected'";
		}
		else if(isset($dbcolval) && strlen($dbcolval)>0 && $dbcolval!=false && ($dbcolval==$fieldval) )
		{ 
			return "selected='selected'";
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldname]) && ($_POST[$fieldname]==$fieldval))
		{ 
			return "selected='selected'";
		}
		else if(isset($dbcolval) && strlen($dbcolval)>0 && $dbcolval!=false && ($dbcolval==$fieldval) )
		{ 
			return "selected='selected'";
		}
	}
}



//----------------------------------------------------------------------------------------------

function get_form_clean_values($fieldval)
{
	if(strlen($fieldval)>0)
	{
		return mysql_real_escape_string(trim($fieldval));
	}
	else
	{
		return "";
	}
}


function get_form_clean_values_textbox($fieldval)
{
	if(strlen($fieldval)>0)
	{
		return mysql_real_escape_string(trim($fieldval));
	}
	else
	{
		return "";
	}
}

function get_form_clean_values_select($fieldval)
{
	if(strlen($fieldval)>0)
	{
		return mysql_real_escape_string(trim($fieldval));
	}
	else
	{
		return "";
	}
}

function get_form_clean_values_textbox_numeric($fieldval)
{
	if(strlen($fieldval)>0)
	{
		return mysql_real_escape_string(trim($fieldval));
	}
	else
	{
		return "0";			
	}
}

function get_form_clean_values_checkbox($fieldval,$falseval="false",$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldval]) && strlen($_GET[$fieldval])>0 )
		{
	
			return mysql_real_escape_string(trim($_GET[$fieldval]));
		}
		else
		{
			return $falseval;
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldval]) && strlen($_POST[$fieldval])>0 )
		{
	
			return mysql_real_escape_string(trim($_POST[$fieldval]));
		}
		else
		{
			return $falseval;
		}
	}

}
		
function get_form_clean_values_radiobtn($fieldval,$falseval="false",$method="POST")
{
	if(strtoupper($method)=="GET")
	{
		if(isset($_GET[$fieldval]) && strlen($_GET[$fieldval])>0 )
		{
	
			return mysql_real_escape_string(trim($_GET[$fieldval]));
		}
		else
		{
			return $falseval;
		}
	}
	else if(strtoupper($method)=="POST")
	{
		if(isset($_POST[$fieldval]) && strlen($_POST[$fieldval])>0 )
		{
	
			return mysql_real_escape_string(trim($_POST[$fieldval]));
		}
		else
		{
			return $falseval;
		}
	}

}


?>
