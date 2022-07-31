<?php

$errorMsg = "";

// FOR LOGIN

if(isset($_POST['checkloginpostbk']) && ($_POST['checkloginpostbk']==1) )
{

	$logincheck=false;
	
	// -- VALIDATIONS --
	
	
	if(strlen(trim($_POST['username']))==0 || strlen(trim($_POST['password']))==0)
	{
		$errorMsg .="Please Provide Valid Username And Password";
	}
	// -- VALIDATIONS --	


	
	if(isset($errorMsg) && strlen($errorMsg)<=0) // If No Error - Start
	{
		$username=get_form_clean_values($_POST['username']);
		$password=md5(get_form_clean_values($_POST['password']));
		

		
		
		
		if( isset($username) && isset($password) && strlen($username)>0 && strlen($password)>0 )
		{

		$usersQry="select sysuser_id,sysuser_login,sysuser_password,sysuser_role,sysuser_email from sysuser where sysuser_login='".$username."' AND is_deleted = 'no' AND is_validated='yes' AND sysuser_status='active' ";
		$usersRes=$dbObj->fireQuery($usersQry);
		
		}
		
		
		if(isset($usersRes) && count($usersRes)>0 && $usersRes!=false)
		{
				if( ($usersRes[0]['sysuser_login']==$username)  && ($usersRes[0]['sysuser_password']==$password) )
				{
					
					
					$logincheck=true;
					$_SESSION['username']=$usersRes[0]['sysuser_login'];
					$_SESSION['user_id']=$usersRes[0]['sysuser_id'];
					$_SESSION['user_email']=$usersRes[0]['sysuser_email'];
					$_SESSION['sectiontype']="admin";
				
					switch($usersRes[0]['sysuser_role'])
					{
						case 1:
						$_SESSION['usertype']="admin";
						break;
						
					}
				
				}else{

					$errorMsg .="Please Provide Valid Username And Password";
				}
		}

		
	
		


		if(isset($logincheck) && strlen($logincheck)>0 && ($logincheck=="true"))
		{

			header("Location: ".HOME_PAGE."?pg=dashboard");	
			exit;

		}
	
	}// If No Error - End
}
// FOR LOGIN END


?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
    	<h3 style="font-size:18px;text-align:center;padding-top:30px;"><strong><?php echo $sc_site_title; ?></strong></h3>
        <div class="login-panel panel panel-default" style="margin-top:10% !important">
            <div class="panel-heading">
                <h3 class="panel-title">Please Sign In</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="post">
                    <fieldset>
                   		<div class="form-group">
                            <div align="center" style="color:#FF3333"><?php echo $errorMsg; ?></div>
                        </div>
                        <div class="form-group">
                            <input id="username" name="username" class="form-control" placeholder="Username" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input id="password" name="password" class="form-control" placeholder="Password" type="password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                         <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                    </fieldset>
                    <input name="checkloginpostbk" type="hidden" id="checkloginpostbk" value="1" />
                </form>
            </div>
        </div>
    </div>
</div>