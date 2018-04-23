<?php
/* ---------------------------------------------------------------------------
 
 * ---------------------------------------------------------------------------
 */
include 'session.php';
include '../database/database.php';
include 'src/header.php'; // html <head> section
?>

<body style="background-color: lightblue !important";>
    <div class="container">
		<div class="row">
			<h3>Persons</h3>
		</div>
		<div class="row">
			<p>
				<a href="wf_per_create.php" class="btn btn-primary">Add Person</a>
				<a href="w_per_list_archive.php" class="btn btn-secondary">View Archive</a>
			</p>
				
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>Name</th>
						<th>Character</th>
						<th>Contact</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						
						$pdo = Database::connect();
						$sql = 'SELECT * FROM wf_persons WHERE archive_flag = FALSE ORDER BY fname';
                       
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. trim($row['fname']) . '</td>'; 
							echo '<td>'. trim($row['charName']) . '</td>'; 
							echo '<td>'. trim($row['email']) . '</td>'; 
							 
							
							//echo '<td width=250>';
							echo '<td>';
							echo '<a class="btn" href="wf_per_read.php?id='.$row['id'].'">Read</a>';
							echo ' ';
                            echo '<a class="btn btn-success" href="wf_per_update.php?id='.$row['id'].'">Update</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="wf_per_delete.php?id='.$row['id'].'">Delete</a>';
							echo ' ';
							echo '<a class="btn btn-primary" href="wf_loa_list.php?per_id='.$row['id'].'">Loadouts</a>';							
							echo '</td>';
							echo '</tr>';
						}
						Database::disconnect();
					?>
				</tbody>
			</table>
			
    	</div>
    </div> <!-- /container -->
  </body>
</html>