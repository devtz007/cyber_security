<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
	<title>Contact Support</title>
</head>

<body>
	<h1>Contact Support</h1>
	<form method="POST" action="">
		<label>Your Name:</label><br>
		<input type="text" name="name"><br><br>
		<label>Your Message:</label><br>
		<textarea name="message" rows="6" cols="40"></textarea><br><br>
		<button type="submit">Send</button>
	</form>

	<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$name = $_POST['name'];
		$message = $_POST['message'];

		// Simulate storage into ticketing system
		$entry = "From: $name\nMessage: $message\n\n";
		file_put_contents("data.txt", $entry, FILE_APPEND);
		echo "<p>Message sent!</p>";
	}
	?>
</body>

</html>