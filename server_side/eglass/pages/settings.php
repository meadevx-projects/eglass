<?php
// Access Rights - Start
$_SESSION['pageaccesstype']="superadmin#admin#agent";
// Access Rights - End

log_activity("Settings Viewed");

$errorMsg=""; // Clear Error Msg

$settingsEditQry="select * from settingsconfig where sc_id = 1";
$settingsEditRes=$dbObj->fireQuery($settingsEditQry);
	
if(isset($_POST['settingspostbk']) && ($_POST['settingspostbk']==1) )
{
	
	$sc_site_title=get_form_clean_values($_POST['sc_site_title']); 
	$sc_default_lang=get_form_clean_values($_POST['sc_default_lang']); 

	// VALIDATIONS
	
		$errorMsg.=validate_txtisset("sc_site_title","Please provide the value for Site Title","POST");			

	// VALIDATIONS
	
	
	if(isset($errorMsg) && strlen($errorMsg)<=0) // If No Error - Start
	{		
		// Update - Start
		
			$usersQry="UPDATE settingsconfig SET "; 
		
			$usersQry.=" sc_site_title = '".$sc_site_title."', ";
			$usersQry.=" sc_default_lang = '".$sc_default_lang."' ";
							
			$usersQry.=" WHERE sc_id = 1";
			
			$usersRes=$dbObj->fireQuery($usersQry,'update');
								
			$_SESSION['successMsg']="Settings Updated Successfully";
			log_activity("Settings Updated Successfully");
			header("Location: ".HOME_PAGE."?pg=settings");
			exit;
			
		// Update - End
				
	}// If No Error - End
				
	
} // End for postback


?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Settings</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Site Config
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
                        <form id="settingsForm" name="settingsForm" role="form" method="post" action="">
                            <div class="form-group">
                                <label>Site Title:</label>
                                <input id="sc_site_title" name="sc_site_title" type="text" class="form-control" value="<?php $fieldval=false; if(isset($settingsEditRes)){ $fieldval=get_data($settingsEditRes[0]['sc_site_title']); } echo form_submit_update_textbox("sc_site_title",$fieldval,"POST"); ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Default Language:</label>
                                 <select id="sc_default_lang" name="sc_default_lang" class="form-control">
                                 	<option value="en" <?php if(isset($settingsEditRes) && ($settingsEditRes[0]['sc_default_lang']=="en")){ ?>selected="selected"<?php } ?>>English</option>
                                    <option value="es" <?php if(isset($settingsEditRes) && ($settingsEditRes[0]['sc_default_lang']=="es")){ ?>selected="selected"<?php } ?>>Spanish</option>
                                    <option value="fr" <?php if(isset($settingsEditRes) && ($settingsEditRes[0]['sc_default_lang']=="fr")){ ?>selected="selected"<?php } ?>>French</option>
                                    <option value="ge" <?php if(isset($settingsEditRes) && ($settingsEditRes[0]['sc_default_lang']=="ge")){ ?>selected="selected"<?php } ?>>German</option>
                                 </select>
                            </div>
                            <input name="settingspostbk" type="hidden" id="settingspostbk" value="1" />
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