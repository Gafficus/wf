<?php 
/* ---------------------------------------------------------------------------
 * original filename    : qm_per_update.php
 * original author      : Frank Duvendack (fcduvend), fcduvend@svsu.edu
 * ---------------------------------------------------------------------------
 */

require 'session.php';
include '../database/database.php';
include 'src/header.php'; // html <head> section // html <head> section

$id = $_GET['id'];

if ( !empty($_POST)) { // if $_POST filled then process the form

	// initialize user input validation variables
	$wNameError    = null;
	$wTypeError    = null;
	$wDamageError    = null;
	
	// initialize $_POST variables
	$wName    = $_POST['name'];
	$wType    = $_POST['type'];
	$wDamage    = $_POST['damage'];
  
	$valid = true;
	if (empty($wName)) {
		$wNameError = 'Please enter Secondary Name';
		$valid = false;
	}

	if (empty($wType)) {
		$wTypeError = 'Please enter Secondary Type';
		$valid = false;
	}

	if (empty($wDamage)) {
		$wDamageError = 'Please enter Damage';
		$valid = false;
	}

	if ($valid) { // if valid user input update the database
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE wf_melee  set name = ?, type = ?, damage = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			//$q->execute(array($fname, $lname, $email, $password, $id));
			//nagaffne: changed the following line to send the $password_hash to the database instead of $password
			$q->execute(array($wName, $wType, $wDamage, $id));
			Database::disconnect();
			header("Location: wf_mel_list.php");
  }
} else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM wf_melee where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$wName = $data['name'];
	$wType = $data['type'];
	$wDamage = $data['damage'];
	Database::disconnect();
}

?>

  <body style="background-color: lightblue !important";>
    <div class="container">
      <div class="span10 offset1">
		
			<div class="row">
				<h3>Update Weapon</h3>
			</div>
	
			<form class="form-horizontal" action="wf_mel_update.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
			
				<!-- Form elements (same as file: qm_per_create.php) -->

        <!-- FIRST NAME -->
				<div class="control-group <?php echo !empty($wNameError)?'error':'';?>">
					<label class="control-label">First Name</label>
					<div class="controls">
						<input name="name" type="text"  placeholder="Weapon Name" value="<?php echo !empty($wName)?$wName:'';?>">
						<?php if (!empty($wNameError)): ?>
							<span class="help-inline"><?php echo $wNameError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
        <!-- CHARACTER NAME -->
				<div class="control-group <?php echo !empty($wTypeError)?'error':'';?>">
					<label class="control-label">Character Name</label>
					<div class="controls">
						<input name="type" type="text"  placeholder="Type" value="<?php echo !empty($wType)?$wType:'';?>">
						<?php if (!empty($wTypeError)): ?>
							<span class="help-inline"><?php echo $wTypeError;?></span>
						<?php endif; ?>
					</div>
				</div>
				
        <!-- EMAIL -->
				<div class="control-group <?php echo !empty($wDamageError)?'error':'';?>">
					<label class="control-label">Email</label>
					<div class="controls">
						<input name="damage" type="text" placeholder="Damage" value="<?php echo !empty($wDamage)?$wDamage:'';?>">
						<?php if (!empty($wDamageError)): ?>
							<span class="help-inline"><?php echo $wDamageError;?></span>
						<?php endif;?>
					</div>
				</div>
				
						  
        <!-- BUTTONS -->
        <div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn" href="wf_mel_list.php">Back</a>
				</div>
			</form>

		  </div><!-- end div: class="span10 offset1" -->
		
    </div> <!-- end div: class="container" -->

  </body>
</html>
