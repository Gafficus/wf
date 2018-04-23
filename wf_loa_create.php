<?php
/* ---------------------------------------------------------------------------
 * original filename    : qm_ques_create.php
 * original author      : Tyler Parker, tjparker@svsu.edu
 * description : This php file will create a new loadout
 * ---------------------------------------------------------------------------
 */
include 'session.php';
include '../database/database.php';
include 'src/header.php'; // html <head> section

if ( !empty($_POST)) { // if not first time through
	// initialize user input validation variables
  //$idError = null;

	$w_nameError = null;
	$w_frameError = null;
	$w_primaryError = null;
	$w_secondaryError = null;
	$w_meleeError = null;

	$wID = $_SESSION['per_id'];
	$wName = $_POST['name'];
	$wFrame = $_POST['frame'];	
	$wPrimary = $_POST['primary'];		
	$wSecondary = $_POST['secondary'];	
	$wMelee = $_POST['melee'];		
	
	// validate user input
	$valid = true;
	//if (empty($id)) {
	//	$idError = 'Please enter ID of the question';
	//	$valid = false;
	//}
		
	if (empty($wName)) {
		$w_nameError = 'Please enter Loadout Name';
		$valid = false;
	}		
	if (empty($wFrame)) {
		$w_frameError = 'Please enter Frame ID';
		$valid = false;
	}		
	if (empty($wPrimary)) {
		$w_primaryError = 'Please enter Primary ID';
		$valid = false;
	}		
	if (empty($wSecondary)) {
		$w_secondaryError = 'Please enter Secondary ID';
		$valid = false;
	}		
	if (empty($wMelee)) {
		$w_meleeError = 'Please enter Melee ID';
		$valid = false;
	}
	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO wf_loadouts (per_id, loadout_name, frame_id, primary_id, secondary_id, melee_id) values(?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($wID, $wName,$wFrame,$wPrimary,$wSecondary,$wMelee));
		Database::disconnect();
		header("Location: wf_loa_list.php?per_id=".$_SESSION['per_id']);
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
				<h3>Add New Loadout</h3>
				<h3><?php //echo $quiz_id . "this"; ?></h3>
				
			</div>
	
			<form class="form-horizontal" action="wf_loa_create.php" method="post">						  
				<div class="control-group <?php echo !empty($w_nameError)?'error':'';?>">
					<label class="control-label">Loadout Name:</label>
					<div class="controls">
						<input name="name" type="text" placeholder="Loadout Name" value="<?php echo !empty($wName)?$wName:'';?>">
						<?php if (!empty($w_nameError)): ?>
							<span class="help-inline"><?php echo $w_nameError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="control-group <?php echo !empty($w_frameError)?'error':'';?>">
					<label class="control-label">Frame ID:</label>
					<div class="controls">
						<input name="frame" type="text" placeholder="Frame ID" value="<?php echo !empty($wFrame)?$wFrame:'';?>">
						<?php if (!empty($w_frameError)): ?>
							<span class="help-inline"><?php echo $w_frameError;?></span>
						<?php endif;?>
					</div>
				</div>
        
				<div class="control-group <?php echo !empty($w_primaryError)?'error':'';?>">
					<label class="control-label">Primary Weapon ID:</label>
					<div class="controls">
						<input name="primary" type="text" placeholder="Primary Weapon ID" value="<?php echo !empty($wPrimary)?$wPrimary:'';?>">
						<?php if (!empty($w_primaryError)): ?>
							<span class="help-inline"><?php echo $w_primaryError;?></span>
						<?php endif;?>
					</div>
				</div>
        
				<div class="control-group <?php echo !empty($w_secondaryError)?'error':'';?>">
					<label class="control-label">Secondary Weapon ID:</label>
					<div class="controls">
						<input name="secondary" type="text" placeholder="Secondary Weapon ID" value="<?php echo !empty($wSecondary)?$wSecondary:'';?>">
						<?php if (!empty($w_secondaryError)): ?>
							<span class="help-inline"><?php echo $w_secondaryError;?></span>
						<?php endif;?>
					</div>
				</div>
        
				<div class="control-group <?php echo !empty($w_meleeError)?'error':'';?>">
					<label class="control-label">Melee Weapon ID:</label>
					<div class="controls">
						<input name="melee" type="text" placeholder="Melee Weapon ID" value="<?php echo !empty($wMelee)?$wMelee:'';?>">
						<?php if (!empty($w_meleeError)): ?>
							<span class="help-inline"><?php echo $w_meleeError;?></span>
						<?php endif;?>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="wf_loa_list.php?per_id=<?php echo $_SESSION['s_per_id'];?>">Back</a>
				</div>
				
			</form>
			
		</div> <!-- div: class="container" -->
				
    </div> <!-- div: class="container" -->
	
</body>
</html>