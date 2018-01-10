<!-- Copyright 2017 Kenedy Cheruiyot, i17/pu/0165/13. All rights reserved. -->
 <?php 
 session_start();
  if (!isset($_SESSION['ID'])){
 	echo '<script language="javascript">';
	echo 'alert("Please Login first!.")';
	echo '</script>';
  echo"<script>window.open('index.php','_self')</script>";
 }
 $expire_time = 5*60; //expire time
if( $_SESSION['activity'] < time()-$expire_time ) {
    echo "<script> alert('Session expired')</script>";
    echo "<script>window.open ('logout.php','_self')</script>";
    
    die();
}
else {
    $_SESSION['activity'] = time(); // you have to add this line when logged in also;
    
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Property Registration</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	
	
	<!-- CSS Files -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	
</head>

<body>

	<div class="image-container set-full-height" style="background-image: url('download.jpg')">
	    <a href="index.php" class="made-with-mk">
			<div class="brand">Home</div>
			<div class="made-with">Click Here to Home</div>

		</a>
		
				
	    <!-- container   -->
	    <div class="container" >
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container" >
		                <div class="card wizard-card" data-color="blue" id="wizard" >
			                   <form id = "formpost" role="form" action = "membersave.php"  method = "post">
	                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        		Register Property 
		                        	</h3>
									<h5>Please enter the details below corectly*.</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#location" data-toggle="tab">Bio Data Details</a></li>
			                            <li><a href="#type" data-toggle="tab">Property Details</a></li>
			                            <li><a href="#facilities" data-toggle="tab">Next of Kin Details</a></li>
			                            
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="location">
		                            	<div class="row">
		                                	<div class="col-sm-12">
		                                    	<h4 class="info-text"> Owners Bio-data</h4>
		                                	</div>
		                                	<div class="col-sm-4 ">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">First Name</label>
													<input type='text'  name = 'txtfname' class="form-control"" />
               										</div>
		                                	</div>
		                                	<div class="col-sm-4">
		                                    	<div class="form-group label-floating">
		                                           <label class="control-label">Last Name</label>
	                                            	<input type='text'  name = 'txtlname' class="form-control" " />
	                                            	 
	                                        	</div>
		                                	</div>
		                                	<div class="col-sm-4">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">Full Name</label>
	                                            	<input type='text'  name = 'txtfullname' class="form-control"" />
	                                            	
		                                    	</div>
		                                	</div>
		                                	<div class="col-sm-4">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">Address</label>
	                                            	<input type='text'  name = 'txtaddress' class="form-control"" />
	                                            	</div>
		                                	</div>
		                                	<div class="col-sm-4">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">National ID/Passport No.</label>
	                                            	<input type='text'  name = 'txtid' class="form-control"" />
	                                            	</div>
		                                	</div>
		                                	<div class="col-sm-4">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">Email Address</label>
	                                            	<input type='email'  name = 'txtemail' class="form-control"" />
	                                            	</div>
		                                	</div>
		                                	<div class="col-sm-4">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">Mobile Number</label>
	                                            	<input type='text'  name = 'txtmobile' class="form-control"" />
	                                            	</div>
		                                	</div>
		                                	
		                                	<div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Nationality</label>
	                                            	<input type='text'  name = 'txtnation' class="form-control" " />
	                                            	</div>
	  
		                                        </div>
		                                	
		                            	</div>



		                            </div>
		                            <div class="tab-pane" id="type">
		                                <h4 class="info-text">Property Details </h4>
		                                <div class="row">
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        
		                                   <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Property ID </label>
	                                            	<input type='text' class="form-control" name = 'txtpropid' />
	                                            	</div>
	  
		                                        </div>      
		                                   <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Property Title</label>
	                                            	<input type='text' class="form-control" name = 'txttitle' />
	                                            	</div>
	  
		                                        </div>
		                                   
		                                  <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Size</label>
	                                            	<input type='text' class="form-control" name = 'txtsize' />
	                                            	</div>
	  
		                                        </div>
		                                  <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Physical Location</label>
	                                            	<input type='text' class="form-control" name = 'txtlocation' />
	                                            	</div>
	  
		                                        </div>
		                                  <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Dimensions</label>
	                                            	<input type='text' class="form-control" name = 'txtdimen' />
	                                            	</div>
	  
		                                        </div>
		                                        <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Block No.</label>
	                                            	<input type='number' class="form-control" name = 'txtblock' />
	                                            	</div>
	  
		                                        </div>
		                                  
		                                    </div>

		                                </div>
		                            </div>
		                            <div class="tab-pane" id="facilities">
		                                <h4 class="info-text">Personal Representative Details </h4>
		                                <div class="row">
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        
		                                        <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Kin Full Name</label>
	                                            	<input type='text' class="form-control" name = 'txtkinname' />
	                                            	</div>
	  
		                                        </div>
		                                  <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Kin Relation</label>
		                                        	<select name="kinrel" class="form-control"><option>Father</option><option>Mother</option><option>Brother</option><option>Sister</option><option>Cousin</option><option>Son</option><option>Daughter</option><option>Wife</option><option>Husband</option><option>Nephew</option><option>Niece</option><option>Non Relative Representative</option></select>
	                                            	</div>
	  
		                                        </div>
		                                  <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Kin Mobile Number</label>
	                                            	<input type='text' class="form-control" name = 'txtkinnum' />
	                                            	</div>
	  
		                                        </div>
		                                        <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Kin PO Box</label>
	                                            	<input type='number' class="form-control" name = 'txtkinbox' />
	                                            	</div>
	  
		                                        </div>
		                                  <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Kin PO Box Code</label>
	                                            	<input type='number' class="form-control" name = 'txtkincode' />
	                                            	</div>
	  
		                                        </div>
		                                        <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Kin PO Box Town</label>
	                                            	<input type='text' class="form-control" name = 'txtkintown' />
	                                            	</div>
	  
		                                        </div>
		                                        <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Kin National ID</label>
	                                            	<input type='number' class="form-control" name = 'txtkinnation' />
	                                            	</div>
	  
		                                        </div>
		                                        <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Kin Email Address</label>
	                                            	<input type='email' class="form-control" name = 'txtkinemail' />
	                                            	</div>
	  
		                                        </div>
		                                    
		                                    <div class="col-sm-4">
		                                          <div class="form-group label-floating">
		                                        	<label class="control-label">Created By</label>
	                                            	<select name = "creator" class="form-control">
													<!-- PHP function to come up with a dropdown list of available candidates as an option. -->
													<?php	echo "<option >" .($_SESSION['ID']) . "</option>";	?>
 
													
												</select>
	  
		                                        </div>
											</div>
												</div>
		                                </div>
		                            </div>
		                            
		                        <div class="wizard-footer">
		                        

		                        <a href="index.php" class="btn btn-next btn-fill btn-primary btn-wd">Home Here</a>
	                            	<div class="pull-right">
	                                    <input type='button' class='btn btn-next btn-fill btn-primary btn-wd' name='next' value='Next' />
	                                    
	                                   <input type='submit' name = 'submit' value = 'Save Details' class="btn btn-finish btn-fill btn-primary btn-wd"/>
	                                </div>
	                                <div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
	                                </div>
		                            <div class="clearfix"></div>
		                        </div>
			                </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	        </div> <!-- row -->
	    </div> <!--  big container -->

	   
	       <?php
			include 'footer.php';
			?>
	    
	

</body>
	<!--   Core JS Files   -->
	<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="assets/js/material-bootstrap-wizard.js"></script>

	<script src="assets/js/jquery.validate.min.js"></script>

</html>
