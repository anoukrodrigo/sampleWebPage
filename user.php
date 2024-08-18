<?php
// Display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);





$error_mes = '';
$success_mes = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Include the connection file
    include('connection.php');

    if (empty($username) || empty($password)) {
        $error_mes = 'Username and password are required.';
    } else {
        try {
            // Prepare and execute the query
            $stmt = $conn->prepare("SELECT * FROM usertb WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Check if user exists
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Successful login
                    $success_mes = 'Login successful!';
                    header('Location: userHead.php');
                     exit(); // Ensure no further code is executed after redirect
                } else {
                    // Incorrect password
                    $error_mes = 'Username or password incorrect.';
                }
            } else {
                // No user found
                $error_mes = 'No user found with this username.';
            }
        } catch (PDOException $e) {
            // Database connection or query error
            $error_mes = 'Database error: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RodrigoIndustries(Pvt.)Ltd.</title>
	<link rel="stylesheet" href="userCSS.css">
	
</head>

<?php
    if (!empty($error_mes)) { ?>
        <div class="errMes">
            <p>Error: <?= htmlspecialchars($error_mes) ?></p>
        </div>
    <?php } ?>

 <?php
    if (!empty($success_mes)) { ?>
        <div class="successMes">
            <p>Success: <?= htmlspecialchars($success_mes) ?></p>
        </div>
    <?php } ?>    




<body>
	<a href="imsMainPage.html"> <img src="IMG_9303.JPG"></a>
	<div class="wrapper">

		<form action="user.php" method="POST">
			<h1>Login</h1>
			<div class="input-box">

				<input type="text" id="username" name="username" placeholder="username" required>
				
			</div>

			<div class="input-box">

				<input type="password" id="password" name="password" placeholder="password" required>
				
			</div>

			<div class="remember-forgot">
				<label> <input type="checkbox" name="">Remember me </label>
				<a href="#">Forgot Password?</a>
			</div>

			<button type="submit" class="btn">Login</button>

			<div class="register-link">
				<p>Don't have an account? <a href="userRegister.php" target="_blank" >Register</a> </p>
			</div>




		</form>
	</div>



<script src="ims.js"></script>
</body>
</html>