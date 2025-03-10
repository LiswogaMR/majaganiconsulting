<?php

	// Email parameters
	$to = "enquiries@majaganiconsulting.co.za"; // Primary recipient
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$from = $_POST['email']; // Sender's email

	// Construct headers
	$headers = "From: " . $from . "\r\n"; // Properly set the From header
	$headers .= "Reply-To: " . $from . "\r\n"; // Add Reply-To for replies
	$headers .= "CC: Rodgers.Vukeya@majaganiconsulting.co.za, Ntsako.Mtsetweni@majaganiconsulting.co.za, info@majaganiconsulting.co.za\r\n"; 
	

	$headers .= "BCC: Rofhiwa.Liswoga@majaganiconsulting.co.za\r\n"; // BCC addresses
	$headers .= "X-Mailer: PHP/" . phpversion(); // Optional header

	// Send the email
	if (mail($to, $subject, $message, $headers)) {
		echo '<p style="color: green; font-weight: bold;">Email sent successfully!</p>';
	} else {
		echo '<p style="color: red; font-weight: bold;">Failed to send email.</p>';
	}

?>
