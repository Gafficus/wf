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
	
	$w_nameError = null;
	$w_typeError = null;
	$w_damageError = null;

	
	$wName = $_POST['wep_name'];
	$wType = $_POST['wep_type'];	
	$wDamage = $_POST['wep_damage'];		
	
	// validate user input
	$valid = true;
	//if (empty($id)) {
	//	$idError = 'Please enter ID of the question';
	//	$valid = false;
	//}
		
	if (empty($wName)) {
		$w_nameError = 'Please enter Weapon Name';
		$valid = false;
	}		
	if (empty($wType)) {
		$w_typeError = 'Please enter Weapon Type';
		$valid = false;
	}		
	if (empty($wDamage)) {
		$w_damageError = 'Please enter Weapon Damage';
		$valid = false;
	}
	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO wf_melee (name, type, damage) values(?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($wName,$wType,$wDamage));
		Database::disconnect();
		header("Location: wf_mel_list.php");
	}
}
//include '../../database/header.php'; //html <head> section
 //html <head> section
?>
<html>
<body>
    <div class="container">
		<div class="span10 offset1">
		
			<div class="row">
				<h3>Add New Weapon</h3>
				<h3><?php //echo $quiz_id . "this"; ?></h3>
				
			</div>
	
			<form class="form-horizontal" action="wf_mel_create.php" method="post">						  
				<div class="control-group <?php echo !empty($w_nameError)?'error':'';?>">
					<label class="control-label">Weapon Name</label>
					<div class="controls">
						<input name="wep_name" type="text" placeholder="Weapon Name" value="<?php echo !empty($wName)?$wName:'';?>">
						<?php if (!empty($w_nameError)): ?>
							<span class="help-inline"><?php echo $w_nameError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($w_typeError)?'error':'';?>">
					<label class="control-label">Weapon Type</label>
					<div class="controls">
						<input name="wep_type" type="text" placeholder="Weapon Type" value="<?php echo !empty($wType)?$wType:'';?>">
						<?php if (!empty($w_typeError)): ?>
							<span class="help-inline"><?php echo $w_typeError;?></span>
						<?php endif;?>
					</div>
				</div>
        
				<div class="control-group <?php echo !empty($w_damageError)?'error':'';?>">
					<label class="control-label">Weapon Damage</label>
					<div class="controls">
						<input name="wep_damage" type="text" placeholder="Weapon Damage" value="<?php echo !empty($wDamage)?$wDamage:'';?>">
						<?php if (!empty($w_damageError)): ?>
							<span class="help-inline"><?php echo $w_damageError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="wf_mel_list.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	
</body>
</html>