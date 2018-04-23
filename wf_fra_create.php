<?php
/* ---------------------------------------------------------------------------
 * filename    : qm_ques_create.php
 * author      : Tyler Parker, tjparker@svsu.edu
 * description : This php file will create a new question (table: qm_question)
 * id   [auto incremented]
 * quiz_id
 * ques_name
 * ques_text
 * ---------------------------------------------------------------------------
 */
include 'session.php';
include '../database/database.php';
include 'src/header.php'; // html <head> section

if ( !empty($_POST)) { // if not first time through
	// initialize user input validation variables
  //$idError = null;
	
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
	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO wf_frames (name, health, shield, armor, energy, sprint) values(?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($fName,$fHealth,$fShield, $fArmor,$fEnergy,$fSprint));
		Database::disconnect();
		header("Location: wf_fra_list.php");
	}
}
//include '../../database/header.php'; //html <head> section
 //html <head> section
?>
<html>
<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Add New Frame</h3>
				<h3><?php //echo $quiz_id . "this"; ?></h3>
				
			</div>
	
			<form class="form-horizontal" action="wf_fra_create.php" method="post">						  
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
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="wf_fra_list.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	
</body>
</html>