<!DOCTYPE html>
<?php
/*-----------------------------------------------
 *filename	: qm_per_create.php
 *author	: George Beeman, gabeeman@svsu.edu
 *description: "Create" page for persons
 * This is exactly the same as per_create EXCEPT navigates to LOGIN after successful insert
 *-----------------------------------------------
 */
 
  /*session_start();
if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
}
$sessionid = $_SESSION['fr_person_id'];
*/
include '../database/database.php'; // html <head> section
include 'src/header.php'; // html <head> section


 
    if ( !empty($_POST)) {
        // keep track validation errors
        $fnameError = null;
		$cnameError = null;
        $emailError = null;
		$passwordError = null;
        // keep track post values
        $fname = $_POST['fname'];
		$cname = $_POST['cname'];
        $email = $_POST['email'];
		$password = $_POST['password'];
		$password_hash = MD5($password);
        // validate input
        $valid = true;
        if (empty($fname)) {
            $fnameError = 'Please enter First Name';
            $valid = false;
        }
		if (empty($cname)) {
            $cnameError = 'Please enter Character Name';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
		if (empty($password)) {
            $passwordError = 'Please enter password';
            $valid = false;
        }
		//not validated
    echo $fname;
	echo "<br>";
	echo $cname;
	echo "<br>";
	echo $email;
	echo "<br>";
        // insert data
        if ($valid) {
			
            $pdo = Database::connect();
	echo "1<br>";
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "2<br>";
            $sql = "INSERT INTO wf_persons (fname, charName, email,  password_hash) values(?, ?, ?, ?)";
	echo "3<br>";
            $q = $pdo->prepare($sql);
	echo "4<br>";
            $q->execute(array($fname, $cname, $email, $password_hash));
	echo "5<br>";
            Database::disconnect();
            header("Location: login.php");
        }
    }
 

?>
	<div class="container">
		<div class="row">
			<h3>Create a Member</h3>
		</div>
			 <form class="form-horizontal" action="wf_per_create.php" method="post">
                      <div class="control-group <?php echo !empty($fnameError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input required name="fname" type="text"  placeholder="First Name" value="<?php echo !empty($fname)?$fname:'';?>">
                            <?php if (!empty($fnameError)): ?>
                                <span class="help-inline"><?php echo $fnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($cnameError)?'error':'';?>">
                        <label class="control-label">Character Name</label>
                        <div class="controls">
                            <input required name="cname" type="text"  placeholder="Character Name" value="<?php echo !empty($cname)?$cname:'';?>">
                            <?php if (!empty($cnameError)): ?>
                                <span class="help-inline"><?php echo $cnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input required name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <br>
                      <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input required name="password" type="password" placeholder="password" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <br>
					  <br>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn btn-danger" href="qm_per_list.php">Back</a>
                        </div>
                    </form>
	</div>
  </body>
</html>
 
