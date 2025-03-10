<?php

    session_start();
    include("functions/connection.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_clear = random_str(5);
        $status = 'Active';

        // Input validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = "Please enter a valid email.";
            header("Location: add_user.php");
            exit();
        }

        if (empty($name) || empty($surname) || empty($email) || empty($password_clear)) {
            $_SESSION['msg'] = "All input fields are required.";
            header("Location: add_user.php");
            exit();
        }

        // Check if email already exists
        $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['msg'] = "This user is already added.";
            header("Location: add_user.php");
            exit();
        }

        // Securely hash the password
        $password_hashed = password_hash($password_clear, PASSWORD_DEFAULT);

        // Insert the user into the database
        $sql = "INSERT INTO user (name, surname, password, email, created, status) 
                VALUES ('$name', '$surname', '$password_hashed', '$email', NOW(), '$status')";
        if (mysqli_query($conn, $sql)) {
            // Send email to the user
            $subject = "Welcome to Majagani Consulting";
            $message = "Dear $name $surname,\n\n"
                    . "Your account has been created successfully.\n\n"
                    . "Here are your login credentials:\n"
                    . "Email: $email\n"
                    . "Password: $password_clear\n\n"
                    . "You can log in using the following link:\n"
                    . "http://majaganiconsulting.co.za//index.php\n\n"
                    . "Best regards,\n"
                    . "Majagani Consulting Team";

            $headers = "From: info@majaganiconsulting.co.za\r\n";
            $headers .= "Reply-To: info@majaganiconsulting.co.za\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            if (mail($email, $subject, $message, $headers)) {
                $_SESSION['msg'] = "Successfully added a new user and sent their credentials via email.";
            } else {
                $_SESSION['msg'] = "User added, but failed to send email. Please contact support.";
            }
        } else {
            $_SESSION['msg'] = "Error adding user. Please try again later.";
        }

        header("Location: add_user.php");
        exit();
    }

    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>MAJAGANI CONSULTING (PTY) LTD</title>
        <meta name="description" content="">
        <meta name="keywords" content="">

        <!-- Favicons -->
        <link href="assets/img/logo.png" rel="icon">
        <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="assets/css/main.css" rel="stylesheet">
    </head>
    <body>
        <h2>Add a New User</h2>
        <?php if (isset($_SESSION['msg'])): ?>
            <p style="color: red;"><?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?></p>
        <?php endif; ?>

        <form action="add_user.php" method="POST">
            <label for="name">First Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="surname">Last Name:</label><br>
            <input type="text" id="surname" name="surname" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <button type="submit">Add User</button>
        </form>
    </body>
    </html>
