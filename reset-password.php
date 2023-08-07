<?php
session_start();

include 'classes/database.class.php';
include 'classes/admin.class.php';
include 'classes/users.class.php';

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($db->conn, $_POST['email']);
    $password = mysqli_real_escape_string($db->conn, $_POST['password']);

    $result = $db->setQuery("SELECT * FROM users WHERE email='$email';");
    $numrows = mysqli_num_rows($result);

    if ($numrows > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $admin->goTo("account", "login_success");
        } else {
            $admin->goTo("sign-in", "invalid_password");
        }
    } else {
        $admin->goTo("sign-in", "invalid_email");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/agent-signup-and-create-account.css">
    <link rel="stylesheet" href="assets/css/sign-in.css">
    <link rel="stylesheet" href="assets/css/agent-account.css">
    <link rel="stylesheet" href="assets/css/list-a-house.css">
    <link rel="stylesheet" href="assets/css/list-a-house2.css">
    <link rel="stylesheet" href="assets/css/faq.css">
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="assets/css/product-listing.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>


    <!-- new password -->
    <div class="new-password" id="new-password" style="display:block;">
        <div class="new-password-box">
            <h2>Reset Password</h2>
            <p>Enter the email address for your account, we will send a verification code to your email address</p>
            <form action="" method="">
                <input type="password" placeholder="Enter New Password">
                <input type="password" placeholder="Confirm Password">
                <div class="button">
                    <h3 id="new-password-close">Cancel</h3>
                    <button type="submit" class="submit" id="new-password">Submit</button>
                    <!-- <a href="./" id="reset-password-open">Submit</a> -->
                </div>
            </form>
        </div>
    </div>


    <script defer src="assets/js/all.min.js"></script>
    <script defer src="assets/js/fontawesome.min.js"></script>
    <script defer src="assets/js/bootstrap.min.js"></script>
    <script defer src="assets/js/sign-in.js"></script>
    <script defer src="assets/js/main.js"></script>
</body>

</html>