<html>
<?php
/* ---------------------------------------------------------------------------
 * filename    : wf_sec_list.php
 * author      : Cody Frost, clfrost
 * description : Question list
 * ---------------------------------------------------------------------------
 */
include 'session.php';
include '../database/database.php';
include 'src/header.php'; // html <head> section
 //$_SESSION['quiz_id'] = $_GET['quiz_id'];
?>

<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="row">
			<h3>Secondary Weapon List</h3>
		</div>
		<div class="row">
			<p>
				<a href="wf_sec_create.php" class="btn btn-primary">Add Weapon</a>

			</p>
				
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>Name</th>
						<th>Type</th>
						<th>Damage</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$pdo = Database::connect();
						$sql = 'SELECT * FROM wf_secondary' ;
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							//echo '<td>'. trim($row['id']) . '</td>';
							echo '<td>'. trim($row['name']) . '</td>';
							echo '<td>'. trim($row['type']) . '</td>';
							echo '<td>'. trim($row['damage']) . '</td>';
							echo '<td width=150>';
								
							echo '<a class="btn btn-primary" href="wf_sec_read.php?id='.$row['id'].'">Read</a>';
              echo ' ';
              echo '<a class="btn btn-success" href="wf_sec_update.php?id='.$row['id'].'">Update</a>';
              echo ' ';
							echo '</tr>';
								
						}
						
						Database::disconnect();
					?>
				</tbody>
			</table>
			<!--<br /><p>Cody Frost, clfrost@svsu.edu</p>-->
    	</div>
    </div> <!-- /container -->
	
  </body>
</html>