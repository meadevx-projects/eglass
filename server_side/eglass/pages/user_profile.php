<?php
// Access Rights - Start
$_SESSION['pageaccesstype']="superadmin#admin#agent";
// Access Rights - End

log_activity("User Profile Viewed");

$errorMsg=""; // Clear Error Msg



// Get Old Password, Secret Question, Secret Answer - Start

if(isset($_SESSION['user_id']))
{
	$userNameQry="select sysuser_id, sysuser_login, sysuser_password, sysuser_secretques_id, sysuser_secretans from sysuser where is_deleted = 'no' AND sysuser_id = ".$_SESSION['user_id'];
	$userNameRes=$dbObj->fireQuery($userNameQry);
}
	
// Get Old Password, Secret Question, Secret Answer - End




if(isset($_POST['userprofilepostbk']) && ($_POST['userprofilepostbk']==1) )
{
	
	
		if(isset($errorMsg) && strlen($errorMsg)<=0) // If No Error - Start
		{
			$oldpwd=md5(get_form_clean_values($_POST['oldpwd'])); 
			$newpwd=md5(get_form_clean_values($_POST['newpwd'])); 
			$cnfnewpwd=md5(get_form_clean_values($_POST['cnfnewpwd'])); 			
					
			
			// VALIDATIONS
			
			if(
			isset($oldpwd) && strlen($oldpwd)>0 ||
			isset($newpwd) && strlen($newpwd)>0 ||
			isset($cnfnewpwd) && strlen($cnfnewpwd)>0
			)
			{
				$errorMsg .=validate_txtisset("oldpwd","Please Provide The Old Password","POST");			
				$errorMsg .=validate_txtisset("newpwd","Please Provide The New Password","POST");
				
				$errorMsg .=validate_confirmpasswordmatch("newpwd","cnfnewpwd","Passwords do not match","POST");

				if(isset($oldpwd) && $oldpwd !='' &&  $userNameRes[0]['sysuser_password'] != $oldpwd)
				{
					$errorMsg .= "Old Password doesn't match<br>";
				}
			
			}
			

			
			// VALIDATIONS
			
			
			if(isset($errorMsg) && strlen($errorMsg)<=0) // If No Error - Start
			{	
					
						
				// Update Password Only If Entered
				if(isset($newpwd) && strlen($newpwd)>0)
				{
					$usersQry="UPDATE sysuser SET "; 
				
					$usersQry.=" sysuser_password = '".$newpwd."' ";
														
					$usersQry.=" WHERE sysuser_id = ".$_SESSION['user_id']." AND is_deleted = 'no'";
					
					$usersRes=$dbObj->fireQuery($usersQry,'update');
										
					$_SESSION['successMsg']="User Profile Updated Successfully";
					log_activity("User Profile Updated Successfully : UserId-".$_SESSION['user_id']."");
					header("Location: ".HOME_PAGE."?pg=user_profile");
					exit;
				}	
						
			}// If No Error - End
				
		}// If No Error - End
	
} // End for postback



?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">User Profile</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Change Password
            </div>
            <div class="panel-body">
                <div class="row">
                	<div id="msgdiv">
                    <p>
                    <?php if(isset($errorMsg) && strlen($errorMsg)>0 ) { ?>
                    <div align="center" class="errorMsg"><strong><?php echo $errorMsg; ?></strong></div>
                    <?php } else if(isset($_SESSION['successMsg']) && strlen($_SESSION['successMsg'])>0 ) { ?>
                    <div align="center" class="successMsg"><strong><?php echo $_SESSION['successMsg']; ?></strong></div>
                    <?php } ?>
                    </p>
                    </div>
                    <div class="col-lg-6">
                        <form id="userprofileForm" name="userprofileForm" role="form" method="post" action="">
                            <div class="form-group">
                                <label>User Name :</label>
                                <input class="form-control" value="<?php echo $_SESSION['username']; ?>" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Old Password :</label>
                                <input id="oldpwd" name="oldpwd" class="form-control" type="password">
                            </div>
                            <div class="form-group">
                                <label>New Password :</label>
                                <input id="newpwd" name="newpwd" class="form-control" type="password">
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password :</label>
                                <input id="cnfnewpwd" name="cnfnewpwd" class="form-control" type="password"/>
                            </div>
                            <input name="userprofilepostbk" type="hidden" id="userprofilepostbk" value="1" />
                            <button type="submit" class="btn btn-default">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                    
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
// Clear Success Msg
$_SESSION['successMsg']="";
?>