<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_per_update.php
 * author      : Frank Duvendack (fcduvend), fcduvend@svsu.edu
 * description : This program updates one person in Quiz Manager
 * ---------------------------------------------------------------------------
 */

require 'session.php';
include '../database/database.php';
include 'src/header.php'; // html <head> section // html <head> section

$id = $_GET['id'];

if ( !empty($_POST)) { // if $_POST filled then process the form

	// initialize user input validation variables
	$fnameError    = null;
	$charNameError    = null;
	$emailError    = null;
	$passwordError = null;
	
	// initialize $_POST variables
	$fname    = $_POST['fname'];
	$charName    = $_POST['charName'];
	$email    = $_POST['email'];
	$password = $_POST['password'];
	/* nagaffne:
	 * added the following line of code as the previous version caused a bug
	 * the password was being stored as plain text into database but being checked as if hash
	 */
    $password_hash = MD5($password);

	// validate user input
	$valid = true;
	if (empty($fname)) {
		$fnameError = 'Please enter First Name';
		$valid = false;
	}

	if (empty($charName)) {
		$charNameError = 'Please enter Character Name';
		$valid = false;
	}

	if (empty($email)) {
		$emailError = 'Please enter valid Email Address (REQUIRED)';
		$valid = false;
	} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
		$emailError = 'Please enter a valid Email Address';
		$valid = false;
	}

	// email must contain only lower case letters
	if (strcmp(strtolower($email),$email)!=0) {
		$emailError = 'email address can contain only lower case letters';
		$valid = false;
	}

	if (empty($password)) {
		$passwordError = 'Please enter valid Password';
		$valid = false;
	}

	if ($valid) { // if valid user input update the database
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE wf_persons  set fname = ?, charName = ?, email = ?, password_hash = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			//$q->execute(array($fname, $lname, $email, $password, $id));
			//nagaffne: changed the following line to send the $password_hash to the database instead of $password
			$q->execute(array($fname, $charName, $email, $password_hash, $id));
			Database::disconnect();
			header("Location: wf_per_list.php");
  }
} else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM wf_persons where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$fname = $data['fname'];
	$charName = $data['charName'];
	$email = $data['email'];
	$password = $data['password_hash'];
	Database::disconnect();
}

?>

  <body style="background-color: lightblue !important";>
    <div class="container">
      <div class="span10 offset1">
			
			<?php
				//require 'functions.php';
				//Functions::logoDisplay2();
			?>

			<div class="row">
				<h3>Update Person</h3>
			</div>
	
			<form class="form-horizontal" action="wf_per_update.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
			
				<!-- Form elements (same as file: qm_per_create.php) -->

        <!-- FIRST NAME -->
				<div class="control-group <?php echo !empty($fnameError)?'error':'';?>">
					<label class="control-label">First Name</label>
					<div class="controls">
						<input name="fname" type="text"  placeholder="First Name" value="<?php echo !empty($fname)?$fname:'';?>">
						<?php if (!empty($fnameError)): ?>
							<span class="help-inline"><?php echo $fnameError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
        <!-- CHARACTER NAME -->
				<div class="control-group <?php echo !empty($charNameError)?'error':'';?>">
					<label class="control-label">Character Name</label>
					<div class="controls">
						<input name="charName" type="text"  placeholder="Character Name" value="<?php echo !empty($charName)?$charName:'';?>">
						<?php if (!empty($charNameError)): ?>
							<span class="help-inline"><?php echo $charNameError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
        <!-- EMAIL -->
				<div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					<label class="control-label">Email</label>
					<div class="controls">
						<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
						<?php if (!empty($emailError)): ?>
							<span class="help-inline"><?php echo $emailError;?></span>
						<?php endif;?>
					</div>
				</div>
				
        <!-- PASSWORD -->
        <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
					<label class="control-label">Password</label>
					<div class="controls">
						<input id="password" name="password" type="password"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
						<?php if (!empty($passwordError)): ?>
							<span class="help-inline"><?php echo $passwordError;?></span>
						<?php endif;?>
            <button type="button" onclick="togglePassword()" class="btn btn-secondary" style="height: 40px">Toggle Password</p>
					</div>
				</div>
						  
        <!-- BUTTONS -->
        <div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn" href="wf_per_list.php">Back</a>
				</div>
			</form>

		  </div><!-- end div: class="span10 offset1" -->
		
    </div> <!-- end div: class="container" -->
    <p>fcduvend</p>

<script>

function togglePassword() {
  var password = document.getElementById("password");
  password.type = (password.type == "text" ? "password" : "text");
}

</script>

  </body>
</html>
