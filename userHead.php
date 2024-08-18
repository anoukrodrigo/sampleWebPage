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
    $form_type = isset($_POST['form_type']) ? $_POST['form_type'] : '';

    if ($form_type === 'newsletter') {
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';

        if (empty($email)) {
            $error_mes = 'Email is required.';
        } else {
            try {
                // Prepare and execute the query to check if the email already exists
                $stmt = $conn->prepare("SELECT * FROM newslettersubscriptions WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Email already exists
                    $error_mes = 'Email already exists.';
                } else {
                    // Prepare and execute the insert query
                    $stmt = $conn->prepare("INSERT INTO newslettersubscriptions (email) VALUES (:email)");
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    // Successful insertion
                    $success_mes = 'Thank you for subscribing to our Newsletter.';
                }
            } catch (PDOException $e) {
                // Database connection or query error
                $error_mes = 'Database error: ' . $e->getMessage();
            }
        }
    } elseif ($form_type === 'registration') {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $address = isset($_POST['address']) ? trim($_POST['address']) : '';
        $tele = isset($_POST['tele']) ? trim($_POST['tele']) : '';
        $nic = isset($_POST['nic']) ? trim($_POST['nic']) : '';

        if (empty($name) || empty($email) || empty($address) || empty($tele) || empty($nic)) {
            $error_mes = 'All fields are required.';
        } else {
            try {
                // Prepare and execute the query to check if the name already exists
                $stmt = $conn->prepare("SELECT * FROM newsletter WHERE name = :name");
                $stmt->bindParam(':name', $name);
                $stmt->execute();

                if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Name already exists
                    $error_mes = 'Name already exists.';
                } else {
                    // Prepare and execute the insert query
                    $stmt = $conn->prepare("INSERT INTO newsletter (name, email, address, tele, nic) VALUES (:name, :email, :address, :tele, :nic)");
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':address', $address);
                    $stmt->bindParam(':tele', $tele);
                    $stmt->bindParam(':nic', $nic);
                    $stmt->execute();

                    // Successful insertion
                    $success_mes = 'Thank you for registering with us.';
                }
            } catch (PDOException $e) {
                // Database connection or query error
                $error_mes = 'Database error: ' . $e->getMessage();
            }
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
	<link rel="stylesheet" type="text/css" href="userHead.css">
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
		<nav>
		<a href="imsMainPage.html"> <img src="IMG_9303.JPG"></a>
		<div class="nav-links">
				<ul>
					<li> <a href="#home">HOME</a></li>
					<li> <a href="#features">SOLUTIONS</a></li>
					<li> <a href="#course">EDGE</a></li>
					<li> <a href="#register">REGISTER</a></li>
					<li> <a href="#profiles">Members of the Board</a></li>

					
				</ul>
			</div>
	</nav>
		<div class="topic01" >
			<h1>Enhance Your Business  Success<br> with Our Expertise.</h1>
		<p>At Rodrigo Industries, we are dedicated to driving the success of your business with our unparalleled expertise and innovative solutions. Our team of professionals is committed to understanding your unique needs and delivering tailored strategies that foster growth and excellence. Partner with Rodrigo Industries to unlock new opportunities and achieve your business goals with confidence.</p>

        
        <button class="btn" >Log Out</button>
		<button class="btn" onclick="window.location.href='goods.html'"> Visit Us</button>
	</div>

		
	</section>

	<section class="animated" id="features">
		<h1>Premium Freight Solutions</h1>
		<p>At Rodrigo Industries, we offer premium freight solutions tailored to meet your specific needs. Our commitment to excellence ensures reliable, efficient, and cost-effective transport options that keep your operations running smoothly. Trust us to handle your logistics with the utmost care and professionalism.</p>
		<div class="fe-base animated">
			<div class="fe-box animated">
				<h3>Air Freight</h3>
				<p>At Rodrigo Industries, our air freight services provide a fast and dependable solution for your shipping needs. We specialize in efficient and secure air transport, ensuring that your high-priority and time-sensitive shipments reach their destinations swiftly and safely. With a focus on reliability and excellence, we manage every aspect of your air freight, helping you streamline your logistics and meet your business goals with ease.</p>
			</div>

			<div class="fe-box animated">
				<h3>Sea Freight</h3>
				<p>At Rodrigo Industries, our sea freight services offer a cost-effective and reliable solution for transporting large volumes of goods. We provide comprehensive shipping solutions that ensure your cargo is managed efficiently from port to port. With a focus on safety and timely delivery, our sea freight services are ideal for both international and domestic shipments, helping you streamline your supply chain and achieve your logistical goals with confidence.</p>
			</div>

			<div class="fe-box animated">
				<h3>Land Freight</h3>
				<p>At Rodrigo Industries, our land freight services deliver dependable and flexible transportation solutions for your cargo. Whether you’re shipping locally or across regions, we ensure that your goods are transported efficiently and safely. Our land freight solutions are designed to meet diverse needs, offering reliable scheduling and cost-effective options to keep your supply chain running smoothly and on time.

</p>
			</div>
		</div>
	</section>

	<section class="animated" id="course">
		<h1> Distinct Edge</h1>
		<p>At Rodrigo Industries, we have a distinct edge in transporting essential and specialized cargo. Our expertise and advanced logistics systems give us a competitive advantage in handling car oils, petroleum, and fossil fuels with the highest standards of safety and efficiency. We excel in managing the transport of cargo containers, ensuring reliable and timely delivery. Furthermore, our specialized capabilities in moving military equipment set us apart, meeting rigorous security and operational requirements. Trust Rodrigo Industries to leverage our edge in these areas, providing superior transport solutions tailored to your needs.</p>

		<div class="course_box animated">
			<div class="cardCourse animated">
				<img src="airCargo.JPG">
				<div class="details animated">
					<h6>Air Cargo Shipping</h6>
				</div>
			</div>

			<div class="cardCourse animated">
				<img src="cargoShip.JPG">
				<div class="details animated">
					<h6>Sea Cargo Shipping</h6>
				</div>
			</div>

			<div class="cardCourse animated">
				<img src="cargoTruck.JPG">
				<div class="details animated">
					<h6>Land Cargo Shipping</h6>
				</div>
			</div>

			<div class="cardCourse animated">
				<img src="military.JPG">
				<div class="details animated">
					<h6>Military Transportation</h6>
				</div>
			</div>

			<div class="cardCourse animated">
				<img src="oilRig.JPG">
				<div class="details animated">
					<h6>Underwater Oil Mining</h6>
				</div>
			</div>

			<div class="cardCourse animated">
				<img src="oilShip.JPG">
				<div class="details animated">
					<h6>Fossil Fuel Transportation</h6>
				</div>
			</div>

			<div class="cardCourse animated">
				<img src="sub.JPG">
				<div class="details animated">
					<h6>Underwater Military Transportation</h6>
				</div>
			</div>

			<div class="cardCourse animated">
				<img src="portMange.JPG">
				<div class="details animated">
					<h6>Harbour and Port Management</h6>
				</div>
			</div>
		</div>
	</section>

	<section class="register animated" id="register">
		<div class="reminder animated">
			<p class="top">Partner with Us at No Cost</p>
			<h1>Register Now <br> to Begin an Unparalleled Journey of Innovation and Excellence.</h1>
			<p class="butm">Join hands with Rodrigo Industries and experience unparalleled service excellence. By registering now, you can utilize our state-of-the-art logistics solutions to make your deliveries fast and secure. Don't miss this opportunity to enhance your supply chain efficiency and reliability, all without any initial investment.</p>
			
		</div>


		<div class="form animated">
					<form action="userHead.php" method="POST">
						<input type="hidden" name="form_type" value="registration">
			<h1>Register</h1>
			<div class="input-box">

				<input type="text" id="name" name="name" placeholder="Full Name" required>
				
			</div>

			<div class="input-box">

				<input type="text" id="email" name="email" placeholder="Email" required>
				
			</div>

			<div class="input-box">

				<input type="text" id="address" name="address" placeholder="Address" required>
				
			</div>

			<div class="input-box">

				<input type="text" id="tele" name="tele" placeholder="Telephone Number" required>
				
			</div>

			<div class="input-box">

				<input type="text" id="nic"  name="nic" placeholder="National Identification Number (NIC)" required>
				
			</div>

			

			<button type="submit" class="btn">Register</button>

			


		</form>
		</div>
		
	</section>



	<section id="profiles" class="profiles animated">
		<h1>Our Esteemed Board of Directors</h1>
		<p>Rodrigo Industries' Board of Directors consists of distinguished professionals who provide strategic guidance and governance. Their extensive experience and leadership are pivotal in steering the company towards continued growth and success, ensuring we excel in a dynamic market.</p>

		<div class="experts  animated">
			<div class="prof  animated">
				<img src="anouk2.JPG">
				<h6>Mr.Anouk Rodrigo</h6>
				<p>Chair and CEO of RodrigoIndustries(Pvt.)Ltd.</p>
				<div class="socialLink  animated">
					<img src="1298747_instagram_brand_logo_social media_icon.PNG">
					<img src="104501_twitter_bird_icon.PNG">
					<img src="4202085_linkedin_logo_social_social media_icon.PNG">
				</div>
			</div>

			<div class="prof  animated">
				<img src="akindu.JPG">
				<h6>Mr.Akindu De Silva</h6>
				<p>Deputy Chair and COO of RodrigoIndustries(Pvt.)Ltd.</p>
				<div class="socialLink  animated">
					<img src="1298747_instagram_brand_logo_social media_icon.PNG">
					<img src="104501_twitter_bird_icon.PNG">
					<img src="4202085_linkedin_logo_social_social media_icon.PNG">
				</div>
			</div>

			<div class="prof  animated">
				<img src="ekvith.JPG">
				<h6>Mr.Ekvith Abayadeera</h6>
				<p>Finance Director of RodrigoIndustries(Pvt.)Ltd.</p>
				<div class="socialLink  animated">
					<img src="1298747_instagram_brand_logo_social media_icon.PNG">
					<img src="104501_twitter_bird_icon.PNG">
					<img src="4202085_linkedin_logo_social_social media_icon.PNG">
				</div>
			</div>

			<div class="prof  animated">
				<img src="gavin.JPG">
				<h6>Mr.Gavin Kahanda</h6>
				<p>Managing Director of RodrigoIndustries(Pvt.)Ltd.</p>
				<div class="socialLink  animated">
					<img src="1298747_instagram_brand_logo_social media_icon.PNG">
					<img src="104501_twitter_bird_icon.PNG">
					<img src="4202085_linkedin_logo_social_social media_icon.PNG">
				</div>
			</div>

			<div class="prof  animated">
				<img src="kaveesha2.JPG">
				<h6>Ms.Kaveesha Ekanayake</h6>
				<p>Head of Logistics and Transport of RodrigoIndustries(Pvt.)Ltd.</p>
				<div class="socialLink  animated">
					<img src="1298747_instagram_brand_logo_social media_icon.PNG">
					<img src="104501_twitter_bird_icon.PNG">
					<img src="4202085_linkedin_logo_social_social media_icon.PNG">
				</div>
			</div>

			<div class="prof  animated">
				<img src="prabha.JPG">
				<h6>Ms.Prbha Ranathunga</h6>
				<p>Marketing Director of RodrigoIndustries(Pvt.)Ltd.</p>
				<div class="socialLink  animated">
					<img src="1298747_instagram_brand_logo_social media_icon.PNG">
					<img src="104501_twitter_bird_icon.PNG">
					<img src="4202085_linkedin_logo_social_social media_icon.PNG">
				</div>
			</div>

			<div class="prof  animated">
				<img src="pubudu.JPG">
				<h6>Mr.Pubudu Gimhana</h6>
				<p>Deputy Finace Director and CSO of RodrigoIndustries(Pvt.)Ltd.</p>
				<div class="socialLink  animated">
					<img src="1298747_instagram_brand_logo_social media_icon.PNG">
					<img src="104501_twitter_bird_icon.PNG">
					<img src="4202085_linkedin_logo_social_social media_icon.PNG">
				</div>
			</div>
		</div>
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




<script src="userHead.js"></script>
</body>
</html>