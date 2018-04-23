<?php 
/* ---------------------------------------------------------------------------
 * original filename    : qm_quiz_read.php
 * original author      : Christine Torres, cmtorre1@svsu.edu
 * ---------------------------------------------------------------------------
 */
include 'session.php';
include '../database/database.php';
include 'src/header.php'; // html <head> section
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: wf_loa_list.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT wf_loadouts.id, wf_loadouts.loadout_name, wf_frames.name as 'Frame', wf_primary.name as 'Primary', wf_secondary.name as 'Secondary', wf_melee.name as 'Melee' from wf_loadouts inner join wf_frames ON wf_loadouts.frame_id = wf_frames.id inner join wf_primary on wf_loadouts.primary_id = wf_primary.id inner join wf_secondary on wf_loadouts.secondary_id = wf_secondary.id inner join wf_melee on wf_loadouts.melee_id = wf_melee.id where wf_loadouts.id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }

?>

<!DOCTYPE html>
<html lang="en">
<body style="background-color: lightblue !important";>
    <div class="container">

		    <div class="row">
                <h3>Read a Primary Weapon </h3>
				</div>
			
				<div class="control-group">
					<label class="control-label">ID: </label>
					<div class="controls">
						<?php echo $data['id'] ;?>
					</div>
				</div>
        <br>
				<div class="control-group">
					<label class="control-label">Name:</label>
					<div class="controls">
						<?php echo $data['loadout_name'] ;?>
					</div>
				</div>
				
<br>
				<div class="control-group">
					<label class="control-label">Shields:</label>
					<div class="controls">
						<?php echo $data['Frame'] ;?>
					</div>
				</div>
				
<br>
				<div class="control-group">
					<label class="control-label">Armor:</label>
					<div class="controls">
						<?php echo $data['Primary'] ;?>
					</div>
				</div>
				
<br>
				<div class="control-group">
					<label class="control-label">Energy:</label>
					<div class="controls">
						<?php echo $data['Secondary'] ;?>
					</div>
				</div>
				
<br>
				<div class="control-group">
					<label class="control-label">Name:</label>
					<div class="controls">
						<?php echo $data['Melee'] ;?>
					</div>
				</div>
<br>				
				    <div class="form-actions">
						  <a class="btn" href="wf_loa_list.php?per_id=<?php echo $_SESSION['s_per_id'];?>">Back</a>
				   </div>
		
    </div> <!-- end div: class="container" -->
	
	<br></br><br></br><br></br><!--
	Posted by: Christine Torres <br></br>
	Contact information: cmtorre1@svsu.edu-->
</body>
</html>
