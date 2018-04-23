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

	$f_nameError = null;
	$f_healthError = null;
	$f_shieldError = null;
	$f_armorError = null;
	$f_energyError = null;
	$f_sprintError = null;
	$f_primeError = null;
	
	$fName = $_POST['fra_name'];
	$fHealth = $_POST['fra_health'];
	$fShield = $_POST['fra_shield'];
	$fArmor = $_POST['fra_armor'];
	$fEnergy = $_POST['fra_energy'];
	$fSprint = $_POST['fra_sprint'];	
	$fPrime = $_POST['fra_prime'];		
	
	// validate user input
	$valid = true;
	//if (empty($id)) {
	//	$idError = 'Please enter ID of the question';
	//	$valid = false;
	//}
		
	if (empty($fName)) {
		$f_nameError = 'Please enter Warframe Name';
		$valid = false;
	}		
	if (empty($fHealth)) {
		$f_healthError = 'Please enter Warframe Health';
		$valid = false;
	}		
	if (empty($fShield)) {
		$f_shieldError = 'Please enter Warframe Shield';
		$valid = false;
	}
	if (empty($fArmor)) {
		$f_armorError = 'Please enter Warframe Armor';
		$valid = false;
	}		
	if (empty($fEnergy)) {
		$f_energyError = 'Please enter Warframe Energy';
		$valid = false;
	}		
	if (empty($fSprint)) {
		$f_sprintError = 'Please enter Warframe Sprint Modifier';
		$valid = false;
	}		
	if (empty($fPrime)) {
		$f_primeError = 'Please enter Warframe Prime Status';
		$valid = false;
	}
	if ($valid) { // if valid user input update the database
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE wf_frames  set name = ?, health = ?, shield = ?, armor = ?, energy = ?, sprint = ?, prime = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			//$q->execute(array($fname, $lname, $email, $password, $id));
			//nagaffne: changed the following line to send the $password_hash to the database instead of $password
			$q->execute(array($fName, $fHealth, $fShield, $fArmor, $fEnergy, $fSprint, $fPrime, $id));
			Database::disconnect();
			header("Location: wf_fra_list.php");
  }
} else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM wf_frames where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$fName = $data['name'];
	$fHealth = $data['health'];
	$fShield = $data['shield'];
	$fArmor = $data['armor'];
	$fEnergy = $data['energy'];
	$fSprint = $data['sprint'];	
	$fPrime = $data['prime'];		
	Database::disconnect();
}

?>
<html>
<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Update Frame</h3>
				<h3><?php //echo $quiz_id . "this"; ?></h3>
				
			</div>
	
			<form class="form-horizontal" action="wf_fra_update.php?id=<?php echo $id?>" method="post">						  
				<div class="control-group <?php echo !empty($f_nameError)?'error':'';?>">
					<label class="control-label">Warframe Name</label>
					<div class="controls">
						<input name="fra_name" type="text" placeholder="Name" value="<?php echo !empty($fName)?$fName:'';?>">
						<?php if (!empty($f_nameError)): ?>
							<span class="help-inline"><?php echo $f_nameError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($f_healthError)?'error':'';?>">
					<label class="control-label">Warframe Health</label>
					<div class="controls">
						<input name="fra_health" type="text" placeholder="Health" value="<?php echo !empty($fHealth)?$fHealth:'';?>">
						<?php if (!empty($f_healthError)): ?>
							<span class="help-inline"><?php echo $f_healthError;?></span>
						<?php endif;?>
					</div>
				</div>
        
				<div class="control-group <?php echo !empty($f_shieldError)?'error':'';?>">
					<label class="control-label">Warframe Shields:</label>
					<div class="controls">
						<input name="fra_shield" type="text" placeholder="Shield" value="<?php echo !empty($fShield)?$fShield:'';?>">
						<?php if (!empty($f_shieldError)): ?>
							<span class="help-inline"><?php echo $f_shieldError;?></span>
						<?php endif;?>
					</div>
				</div>	
        
				<div class="control-group <?php echo !empty($f_armorError)?'error':'';?>">
					<label class="control-label">Warframe Armor:</label>
					<div class="controls">
						<input name="fra_armor" type="text" placeholder="Armor" value="<?php echo !empty($fArmor)?$fArmor:'';?>">
						<?php if (!empty($f_armorError)): ?>
							<span class="help-inline"><?php echo $f_armorError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($f_energyError)?'error':'';?>">
					<label class="control-label">Warframe Energy:</label>
					<div class="controls">
						<input name="fra_energy" type="text" placeholder="Energy" value="<?php echo !empty($fEnergy)?$fEnergy:'';?>">
						<?php if (!empty($f_energyError)): ?>
							<span class="help-inline"><?php echo $f_energyError;?></span>
						<?php endif;?>
					</div>
				</div>
        
				<div class="control-group <?php echo !empty($f_sprintError)?'error':'';?>">
					<label class="control-label">Sprint Modifier:</label>
					<div class="controls">
						<input name="fra_sprint" type="text" placeholder="Sprint Modifier" value="<?php echo !empty($fSprint)?$fSprint:'';?>">
						<?php if (!empty($f_sprintError)): ?>
							<span class="help-inline"><?php echo $f_sprintError;?></span>
						<?php endif;?>
					</div>
				</div>
        
				<div class="control-group <?php echo !empty($f_primeError)?'error':'';?>">
					<label class="control-label">Prime Frame:</label>
					<div class="controls">
						<input name="fra_prime" type="text" placeholder="Prime" value="<?php echo !empty($fPrime)?$fPrime:'';?>">
						<?php if (!empty($f_primeError)): ?>
							<span class="help-inline"><?php echo $f_primeError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn" href="wf_fra_list.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	
</body>
</html>
