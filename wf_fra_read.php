<?php 
/* ---------------------------------------------------------------------------
 * filename    : qm_quiz_read.php
 * author      : Christine Torres, cmtorre1@svsu.edu
 * description : This program displays the read page for quiz database 
 *               (table: qm_quizes, qm_persons)
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
        header("Location: wf_fra_list.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM wf_frames where id = ?";
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
                <h3>Read a Warframe </h3>
				</div>
			
				<div class="control-group">
					<label class="control-label">ID: </label>
					<div class="controls">
						<?php echo $data['id'] ;?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Name:</label>
					<div class="controls">
						<?php echo $data['name'] ;?>
					</div>
				</div>
				

				<div class="control-group">
					<label class="control-label">Shields:</label>
					<div class="controls">
						<?php echo $data['shield'] ;?>
					</div>
				</div>
				

				<div class="control-group">
					<label class="control-label">Armor:</label>
					<div class="controls">
						<?php echo $data['armor'] ;?>
					</div>
				</div>
				

				<div class="control-group">
					<label class="control-label">Energy:</label>
					<div class="controls">
						<?php echo $data['energy'] ;?>
					</div>
				</div>
				

				<div class="control-group">
					<label class="control-label">Sprint:</label>
					<div class="controls">
						<?php echo $data['sprint'] ;?>
					</div>
				</div>
				

				<div class="control-group">
					<label class="control-label">Prime:</label>
					<div class="controls">
						<?php echo $data['prime'] ;?>
					</div>
          
				</div>
				    <div class="form-actions">
						  <a class="btn" href="wf_fra_list.php">Back</a>
				   </div>
		
    </div> <!-- end div: class="container" -->
	
	<!--<br></br><br></br><br></br>
	Posted by: Christine Torres <br></br>
	Contact information: cmtorre1@svsu.edu-->
</body>
</html>
