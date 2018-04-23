<html>
<?php
/* ---------------------------------------------------------------------------
 * filename    : wf_pri_list.php
 * author      : Cody Frost, clfrost
 * description : Question list
 * ---------------------------------------------------------------------------
 */
include 'session.php';
include '../database/database.php';
include 'src/header.php'; // html <head> section
 //$_SESSION['quiz_id'] = $_GET['quiz_id'];
 $_SESSION['s_per_id'] = $_GET['per_id'];
?>

<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="row">
			<h3>Loadout List</h3>
		</div>
		<div class="row">
			<p>
				<a href="wf_loa_create.php" class="btn btn-primary">Add Loadout</a>

			</p>
				
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>Name</th>
						<th>Frame</th>
						<th>Primary</th>
						<th>Secondary</th>
						<th>Melee</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$pdo = Database::connect();
						$sql = "SELECT wf_loadouts.id, wf_loadouts.loadout_name, wf_frames.name as 'Frame', wf_primary.name as 'Primary', wf_secondary.name as 'Secondary', wf_melee.name as 'Melee' from wf_loadouts inner join wf_frames ON wf_loadouts.frame_id = wf_frames.id inner join wf_primary on wf_loadouts.primary_id = wf_primary.id inner join wf_secondary on wf_loadouts.secondary_id = wf_secondary.id inner join wf_melee on wf_loadouts.melee_id = wf_melee.id where per_id =". $_GET['per_id'];
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							//echo '<td>'. trim($row['id']) . '</td>';
							echo '<td>'. trim($row['loadout_name']) . '</td>';
							echo '<td>'. trim($row['Frame']) . '</td>';
							echo '<td>'. trim($row['Primary']) . '</td>';
							echo '<td>'. trim($row['Secondary']) . '</td>';
							echo '<td>'. trim($row['Melee']) . '</td>';
							echo '<td width=150>';
								
							echo '<a class="btn btn-primary" href="wf_loa_read.php?id='.$row['id'].'">Read</a>';
              echo ' ';
              echo '<a class="btn btn-success" href="wf_loa_update.php?id='.$row['id'].'">Update</a>';
              echo ' ';
              echo '</td>';
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