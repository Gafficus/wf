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
        header("Location: wf_sec_list.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM wf_secondary where id = ?";
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
                <h3>Read a Secondary Weapon </h3>
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
					<label class="control-label">Type:</label>
					<div class="controls">
						<?php echo ($data['type']);?>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Damage:</label>
					<div class="controls">
						<?php echo ($data['damage']);?>
					</div>
				</div>
				    <div class="form-actions">
						  <a class="btn" href="wf_sec_list.php">Back</a>
				   </div>
		
    </div> <!-- end div: class="container" -->
	
	<!--<br></br><br></br><br></br>
	Posted by: Christine Torres <br></br>
	Contact information: cmtorre1@svsu.edu-->
</body>
</html>
