<?php 

include 'config.php';

error_reporting(0);

session_start();
$conn = OpenCon();


if (isset($_SESSION['username'])) {
    header("Location: index.html");
}



if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
    
	if ($password == $cpassword) {
       
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Find A House dz</title>
        
        <link rel="stylesheet" href="style/signup_style.css" />
        <link rel="shortcut icon" href="images/logo.png" />
    </head>
    <body>
        <nav class="main-nav">
            <a class="nav-logo" href="index.html">
                <img src="images/logo_transparent.png" alt="" class="main-nav-image" />
            </a>
            <ul class="main-nav-elements">
                <li class="main-nav-element">
                    <a href="index.html">Accueil</a>
                </li>
     
                <li class="main-nav-element"><a href="#About">à Propos</a></li>
                <li class="main-nav-element"><a href="contacter_nous.html">Contacter nous</a></li>
                <button class="button"><a href = "signup.php">Creer un Compte</a></button>
            </ul>
        </nav>
         <!-- Button to open the modal -->
<!--<button onclick="document.getElementById('id01').style.display='block'">Sign Up</button>-->

    <!-- The Modal (contains the Sign Up form) -->
    <div class="sign-up-container">
        <h1>S'inscrire</h1>
        <p>Please fill in this form to create an account.</p> 
        <form class="modal-content" method="POST" action="">
            <label for="email"><b>Nom et Prénom</b></label>
            <input class='text-field' type="text" placeholder="Nom" name="username" value="<?php echo $username; ?>" required>

            <label for="email"><b>Adresse Email</b></label>
            <input class='text-field' type="email" placeholder="Enter Email" name="email" value="<?php echo $email; ?>" required>

            <label for="password"><b>Mot de Passe</b></label>
            <input class='text-field' type="password" placeholder="Enter Password" name="password" value="<?php echo $_POST['password']; ?>" required>

            <label for="cpassword"><b>Repetter le  Mot de Passe</b></label>
            <input class='text-field' type="password" placeholder="Repeat Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>


            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

            <div class="clearfix">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <button type="submit" name="submit" class="signup">Sign Up</button>
            </div>
        </form>
    </div>
      
</body>
</html>