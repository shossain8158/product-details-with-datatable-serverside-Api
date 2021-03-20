<!DOCTYPE html>
<html>
<head>
	<title>Product Details</title>
</head>
<body>
	<h2>Registration Here</h2>
	 <small>
              
            
              <?php
            $succ_update=$this->session->flashdata('message');
            if($succ_update){
              ?>
              <br><span style="color:red">
                <?php echo $succ_update;
               unset($_SESSION['message']);


                 ?>
              </span>
              <?php
              }
              ?>
              </small>

               <small>
              
            
              <?php
            $logout_msg=$this->session->flashdata('message_out');
            if($logout_msg){
              ?>
              <br><span style="color:green">
                <?php echo $logout_msg;
               unset($_SESSION['message_out']);
              

                 ?>
              </span>
              <?php
              }
              ?>
              </small>
	<form method="post" action="<?php echo base_url(); ?>index.php/login/registration_submit" id="login_form">
		<div class="form-group">
		<label>Name</label>
	    <input type="text" name="nam" id="nam" class="form-control">
	  </div>
	<div class="form-group">
		<label>Email</label>
	    <input type="email" name="email" id="email" class="form-control">
	</div>
	<div class="clearfix"></div>
	<div class="form-group">
		<label>Password</label>
		<input type="text" name="password" id="password" class="form-control">
	</div>
	<div class="clearfix"></div>
	<div class="form-group">
		<!-- <label>Password</label> -->
		<!-- <input type="password" name="password" id="password"> -->
		<button type="button" onclick="validate();">Submit</button>
	</div>
	</form>

	<!-- <a href="<?php echo base_url(); ?>index.php/login/registration">Register here</a> -->

	


</body>
</html>

<script src="jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
	function validate()
	{
		// alert('hi');
		var nam=$("#nam").val();

		var email=$("#email").val();
		var password=$("#password").val();


        if(nam=="")
		{
			alert('Please enter your name');
			return false;

		}
		else if(email=="")
		{
			alert('Please enter your email id');
			return false;
		}
		else if(password=="")
		{
			alert('Please enter your Password');
			return false;

		}
		else
		{
			$("#login_form").submit();
		}
	}
	
</script>




<style type="text/css">
	form {
  border: 3px solid #f1f1f1;
}

/* Full-width inputs */


/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 4px 10px;
  margin: 2px 0;
  border: none;
  cursor: pointer;
  width: 5%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}
</style>
