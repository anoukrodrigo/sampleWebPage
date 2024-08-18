<?php
// Display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error_mes = '';
$success_mes = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $NIC = isset($_POST['NIC']) ? trim($_POST['NIC']) : '';
    $tele = isset($_POST['tele']) ? trim($_POST['tele']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
     $passRe = isset($_POST['re_pass']) ? trim($_POST['re_pass']) : '';

    // Include the connection file
    include('connection.php');

    function checkPasswordStrength($password) {
        // Password must be at least 8 characters long, include at least one uppercase letter, one number, and one special character
        $containsUpperCase = preg_match('/[A-Z]/', $password);
        $containsNumber = preg_match('/[0-9]/', $password);
        $containsSpecialChar = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);

        return strlen($password) >= 8 && $containsUpperCase && $containsNumber && $containsSpecialChar;
    }

    if (empty($username) || empty($password)) {
        $error_mes = 'All fields are required.';
    }

    elseif ($password !== $passRe) {
        // Check if passwords match
        $error_mes = 'Passwords do not match.';
    }

    elseif (!checkPasswordStrength($password)) {
        // Check if the password is strong
        $error_mes = 'Password is too weak. It must be at least 8 characters long, include an uppercase letter, a number, and a special character.';
    }

     else {
        try {
            // Prepare and execute the query to check if the username already exists
            $stmt = $conn->prepare("SELECT * FROM usertb WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                // Username already exists
                $error_mes = 'Username already exists.';
            } else {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Prepare and execute the insert query
                $stmt = $conn->prepare("INSERT INTO usertb (username, nic, tel,  password) VALUES (:username, :NIC, :tele, :password )");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':NIC', $NIC);
                $stmt->bindParam(':tele', $tele);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->execute();

                // Successful insertion
                $success_mes = 'Data successfully inserted!';
                header('Location: user.php');
                     exit(); // Ensure no further code is executed after redirect
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
		<form action="userRegister.php" method="POST">
			<h1>Register</h1>
			<div class="input-box">

				<input type="text" id="username" name="username" placeholder="username" required>
				
			</div>

			<div class="input-box">

				<input type="text" id="NIC" name="NIC" placeholder="National Identification Number(NIC)" required>
				
			</div>

			<div class="input-box">

				<input type="text" id="tele" name="tele" placeholder="Telephone Number" required>
				
			</div>

			<div class="input-box">

				<input type="password" id="password" name="password" placeholder="password" required>
				
			</div>

			<div id="password-strength"></div>

			<div class="input-box">

				<input type="password" id="re_pass"  name="re_pass" placeholder="re-password" required>
				
			</div>

			

			<button type="submit" class="btn">Register</button>

			<div class="register-link">
				<p>have an account? <a href="user.php" target="_blank">Sign in</a> </p>
			</div>


		</form>
	</div>



<script src="imsMainPage.js"></script>
</body>
</html>