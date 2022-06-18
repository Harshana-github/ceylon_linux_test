<?php 
	$status = '';
	// checking if the form is submit
	if ( isset($_POST['submit']) ) {
		$fullname	= $_POST['fullname'];
		$email		= $_POST['email'];
		$subject	= $_POST['subject'];
		$message	= $_POST['message'];

		$to	 	= 'harshanalakmal503@gmail.com';
		$mail_subject = 'Message from Website';
		$email_body   = "Message from Contact Us Page of the Website: <br>";
		$email_body   .= "<b>From:</b> {$fullname} <br>";
		$email_body   .= "<b>Subject:</b> {$subject} <br>";
		$email_body   .= "<b>Message:</b><br>" . nl2br(strip_tags($message));

		$header       = "From: {$email}\r\nContent-Type: text/html;";

		$send_mail_result = mail($to, $mail_subject, $email_body, $header);

		if ( $send_mail_result ) {
			$status = '<p class="success">Message Sent Successfully.</p>';
		} else {
			$status = '<p class="error">Error: Message Was Not Sent.</p>';
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Contact Form</title>
	<link rel="stylesheet" href="perfect contact/style.css" />
	
    <link rel="shortcut icon" type="image" href="../image/title.png">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>
<?php echo $status; ?>
<div class="container">
      <span class="big-circle"></span>
      <img src="img/shape.png" class="square" alt="" />
      <div class="form">
        <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>
          <p class="text">
            Contact us to find out anything else you need to know about this website and about it
          </p>

          <div class="info">
            <div class="information">
              <img src="perfect contact/img/location.png" class="icon" alt="" />
              <p>Wellawaya</p>
            </div>
            <div class="information">
              <img src="perfect contact/img/email.png" class="icon" alt="" />
              <p>harshanalakmal503@gmail.com</p>
            </div>
            <div class="information">
              <img src="perfect contact/img/phone.png" class="icon" alt="" />
              <p>071-1434-499</p>
            </div>
          </div>

          <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
        </div>

		<div class="contact-form">
				<span class="circle one"></span>
				<span class="circle two"></span>


			
				
				<form action="contact-us.php" method="post" autocomplete="on">
				<h3 class="title">Contact us</h3>
				<div class="input-container">
						<input type="text" name="fullname" id="fullname" class="input" required>
						<label for="fullname">Full Name</label>
						<span>Full Name</span>
				</div>

				<div class="input-container">
						<input type="email" name="email" id="email" class="input" required>
						<label for="email">Email</label>
						<span>Email</span>
				</div>

				<div class="input-container">
						<input type="text" name="subject" id="subject" class="input">
						<label for="subject">Phone number</label>
						<span>Phone number</span>
				</div>

				<div class="input-container textarea">
						<textarea name="message" id="message" cols="30" rows="10" class="input" required></textarea>
						<label for="message">Message</label>
						<span>Message</span>
				</div>
					<p>
						<button type="submit" name="submit" class="btn">Send Message</button>
					</p>


				</form>


			
		</div>
		</div>
    </div>
<script src="perfect contact/app.js"></script>
</body>
</html>