<?php
// Display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error_mes = '';
$success_mes = '';

// Include the connection file
include('connection.php');

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['textA']) ? trim($_POST['textA']) : '';

    // Validate inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_mes = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_mes = 'Invalid email format.';
    } else {
        try {
        	  // Prepare and execute the query to check if the name already exists
                $stmt = $conn->prepare("SELECT * FROM contact_form_submissions WHERE name = :name");
                $stmt->bindParam(':name', $name);
                $stmt->execute();

                 if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Name already exists
                    $error_mes = 'Name already exists.';

                     } else {
                     	// Prepare and execute the insert query
            $stmt = $conn->prepare("INSERT INTO contact_form_submissions (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

              $success_mes = 'Thank you for Contacting us.';
              
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
	<title>Rodrigo Industries(Pvt.)Ltd.</title>
	<link rel="stylesheet" type="text/css" href="contact.css">
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
	
    <section id="home" class="animated">
    	<video autoplay muted loop id="background-video">
        <source src="shipSailing.MP4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
		<nav>
		<a href="imsMainPage.html"> <img src="IMG_9303.JPG"></a>
	</nav>
		<div class="topic01" >
			<h1>Get in Touch with Our Experts</h1>
            <p>At Rodrigo Industries, we are committed to understanding your unique business needs. Our team of professionals is ready to provide you with tailored strategies and innovative solutions that drive growth and excellence. Reach out to us today to discover how we can partner with you to achieve your business goals. Contact us with confidence and let’s unlock new opportunities together.</p>
	</div>

		
	</section>


	<section id="con" class="animated">
		<div class="conDetails animated">
			<h2>Connect with Us</h2>
            <p class="why animated">Unsure of your next step? Complete the form, and let’s begin a new chapter together.</p>

            <div class="det animated">
            	<h3>Headquarters</h3>
            	<div class="headQ animated">
            		<p>742, Palm Jumeirah, Dubai, UAE</p>
                </div>

                <h3>Phone</h3>
            	<div class="phone-numbers animated">
            		 <p>+971 4 123 4567</p>
    <p>+971 4 234 5678</p> 
    <p>+976 4 345 6789</p> 
    <p>+94 76 456 7890</p> 
    <p>+971 4 567 8901</p> 
    <p>+978 4 678 9012</p> 
    <p>+971 4 789 0123</p> 
    <p>+94 71 890 1234</p> 
    <p>+971 4 901 2345</p> 
    <p>+977 4 012 3456</p> 
    <p>+971 4 123 4568</p>
    <p>+971 4 234 5679</p>
    <p>+94 70 345 6780</p>
    <p>+971 4 456 7891</p>
    <p>+978 4 567 8902</p>
                </div>

                <h3>Headquarters</h3>
            	<div>
            		 <p>contact@rodrigoindustries.com</p>
    <p>support@rodrigoindustries.com</p>
    <p>info@rodrigoindustries.com</p>
    <p>sales@rodrigoindustries.com</p>
    <p>careers@rodrigoindustries.com</p>
                </div>
            </div>

		</div>

		<div class="catchUp animated">
			 <form action="contact.php" method="POST">
			<h4>Tell Us Your Problem</h4>
            <p>We are here to assist you. Please provide us with details about the issue you're facing, and our team will get back to you as soon as possible to offer support and solutions.</p>
            
            <div class="form-row">
            	<input type="text" name="name" placeholder="Your Name" id="name">
            	<input type="text" name="email" placeholder="Your Email" id="email">
            </div>
            <div class="form-cols">
            	<input type="text" name="subject" placeholder="subject" id="subject">
            </div>
            <div class="form-cols">
            	<textarea name="textA" id="textA" cols="5" rows="10" placeholder="How can We Help You?"></textarea>
            </div>
            <div class="form-cols">
            	<button class="btn"> Submit</button>
            </div>
             </form>
		</div>
	</section>

	<section id="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28899.871293386535!2d55.11114052575346!3d25.119325676683648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f1529c2653b15%3A0x3dcabcae764a3e16!2sPalm%20Jumeirah!5e0!3m2!1sen!2slk!4v1723641132475!5m2!1sen!2slk" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</section>


<footer class="animated">
	<div class="footer-col animated">
		<h3>Our Premier Shipments</h3>
		<li>Nuclear Minerals</li>
		<li>Agricultural Goods</li>
		<li>Platinum, Gold and Silver</li>
		<li>Petrolium</li>
		<li>Motor Vehicles</li>
	</div>
	<div class="footer-col animated">
		<h3>Quick Links</h3>
		<li>Jobs</li>
		<li>Assets</li>
		<li>Investors</li>
		<li>Company Policies</li>
		<li>Terms of Service</li>
	</div>
	<div class="footer-col animated">
		<h3>Our Comapnies</h3>
		<li>Reliance Group</li>
		<li>RI Hospitals</li>
		<li>FastBurgers</li>
		<li>RI Pharmaceuticals</li>
		<li>Lockheed Martin</li>
	</div>
	<div class="footer-col animated">
		<h3>Our Sites</h3>
		<li>RI Healthcare</li>
		<li>About RodrigoIndustries</li>
		<li>Supply Chain Management</li>
		<li>RI Capital</li>
		<li>RI Developer Portal</li>
	</div>

	<div class="newsLetter animated">
		<h3>Newsletter</h3>
		<p>Subscribe for Updates! <br> Stay informed with Rodrigo Industries. <br> Get the latest news and insights<br> directly to your inbox.</p>
		<div class="subs animated">
			 <form action="userHead.php" method="POST">
                <input type="hidden" name="form_type" value="newsletter">
                <input type="email" name="email" placeholder="Your Email Address" required>
                <button type="submit" class="newBytn">SUBSCRIBE</button>
            </form>
		</div>

		
	</div>
	






	
</footer>




<script src="contact.js"></script>
</body>
</html>