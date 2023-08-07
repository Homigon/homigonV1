<?php
session_start();

include 'classes/database.class.php';
include 'classes/admin.class.php';
include 'classes/users.class.php';

if (isset($_POST['submit'])) {

    $firstname = mysqli_real_escape_string($db->conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db->conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($db->conn, $_POST['email']);
    $phone = mysqli_real_escape_string($db->conn, $_POST['phone']);
    $password = mysqli_real_escape_string($db->conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($db->conn, $_POST['confirm_password']);
    $is_owner_or_agent = "Empty";

    $result = $db->setQuery("SELECT * FROM users WHERE email='$email';");
    $numrows = mysqli_num_rows($result);

    if ($numrows == 0) {
        if ($password == $confirm_password) {
            $otp = RAND(1000, 9999);
            $_SESSION['signup_otp'] = $otp;

            $_SESSION['signup_details'] = array(
                'user_type' => 'Individual',
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'is_owner_or_agent' => $is_owner_or_agent,
            );

            // Send OTP email here...

            $admin->goTo("signup-otp", "");
        } else {
            $admin->goTo("create-account", "passwords_unmatched");
        }
    } else {
        $admin->goTo("create-account", "email_exists");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
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
    <!-- navbar starts -->
    <?php include 'header.php'; ?>



    <!-- navbar ends -->



    <!-- create account page starts -->
    <div class="create-account">
        <div class="header-img">
            <!-- <img src="assets/img/hero-img-one.png" alt="" style="width: 100%; height: 200px;"> -->
        </div>
        <div class="header">
            <h3>Create Account</h3>
            <p class="remove-header-text show" style="color: #fff; text-align: center;">Want to become an Agent? <br>
                <span>
                    <a href="create-account" style="text-decoration: none; color: #ffc700;">Create an Agent account</a>
                </span>
            </p>
        </div>
        <div class="body">
            <div class="left">
                <form action="" method="POST">
                    <div class="form">
                        <?php
                        if (isset($_GET['email_exists'])) {
                            echo "<div class='alert alert-danger'>Email address already in use!</div>";
                        }

                        if (isset($_GET['passwords_unmatched'])) {
                            echo "<div class='alert alert-warning'>Passwords do not match!</div>";
                        }
                        ?>
                        <label for="">First Name</label><br>
                        <input name="firstname" type="text" class="input" required><br>

                        <label for="">Last Name</label><br>
                        <input name="lastname" type="text" class="input" required><br>

                        <label for="">Email Address</label><br>
                        <input name="email" type="email" class="input" required><br>

                        <label for="">Phone Number</label><br>
                        <input name="phone" type="tel" class="input" required><br>

                        <label for="">Password</label><br>
                        <input name="password" type="password" class="input" required><br>

                        <label for="">Confirm Password</label><br>
                        <input name="confirm_password" type="password" class="input" required><br>

                        <div class="checkbox">
                            <p>
                                <input type="checkbox" required>
                                <span>I accept the terms and conditions</span>
                            </p>

                        </div>

                        <div class="button" id="create-account-verify">

                            <input type="submit" value="Create Account" name="submit" class="create">
                        </div>

                        <div class="login">
                            <div class="login-text">
                                <p>Already have an account? <a href="sign-in">LOGIN</a></p>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="right-logo remove">

                <img src="assets/img/logo.png" alt="" class="remove">
                <p class="remove">Got houses for rent, lease or sale? Want to become an agent?
                </p>
                <h3 class="remove"><a href="agent-sign-up"> Create Agent Account Instead</a></h3>

            </div>

        </div>










        <!-- footer-section  starts-->
        <?php include 'footer.php'; ?>

        <script defer src="assets/js/all.min.js"></script>
        <script defer src="assets/js/fontawesome.min.js"></script>
        <script defer src="assets/js/bootstrap.min.js"></script>
        <script defer src="assets/js/create-account.js"></script>
        <script defer src="assets/js/main.js"></script>
        <!-- signup/signin page ends -->
</body>

</html>