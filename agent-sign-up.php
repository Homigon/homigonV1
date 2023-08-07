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
    $is_owner_or_agent = mysqli_real_escape_string($db->conn, $_POST['is_owner_or_agent']);

    $result = $db->setQuery("SELECT * FROM users WHERE email='$email';");
    $numrows = mysqli_num_rows($result);

    if ($numrows == 0) {
        if ($password == $confirm_password) {
            $otp = RAND(1000, 9999);
            $_SESSION['signup_otp'] = $otp;

            $_SESSION['signup_details'] = array(
                'user_type' => 'Agent',
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
            $admin->goTo("agent-sign-up", "passwords_unmatched");
        }
    } else {
        $admin->goTo("agent-sign-up", "email_exists");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up as an Agent</title>
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
    <link rel="stylesheet" href="assets/css/root.css">
</head>

<body>
    <!-- navbar starts -->
    <?php include 'header.php'; ?>
    <!-- navbar ends -->

    <!-- create account page starts -->
    <div class="create-account">
        <div class="header-img">
            <!-- <img src="assets/img/background.png" alt="" style="width: 100%;"> -->
        </div>
        <div class="header">
            <h3>Create Account</h3>

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
                        <input name="phone" type="tel" class="input" minlength="11" maxlength="11" required><br>

                        <label for="">Password</label><br>
                        <input name="password" type="password" class="input" required><br>

                        <label for="">Confirm Password</label><br>
                        <input name="confirm_password" type="password" class="input" required><br>


                        <div class="checkbox">
                            <p>I am a</p>
                            <div class="form-check">
                                <input name="is_owner_or_agent" class="form-check-input" type="radio" value="Owner" id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Property Owner
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="is_owner_or_agent" class="form-check-input" type="radio" value="Agent" id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Property Agent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    I accept the terms and conditions
                                </label>
                            </div>
                            <!-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I want to recieve Homigon Newsletters with best deals and offers
                                </label>
                            </div> -->


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
                <p class="remove">Not a property owner or agent?</p>
                <h3 class="remove"><a href="create-account"> Create an individual Account instead</a></h3>

            </div>

        </div>



        <!-- footer-section  starts-->
        <?php include 'footer.php'; ?>




        <script defer src="assets/js/all.min.js"></script>
        <script defer src="assets/js/fontawesome.min.js"></script>
        <script defer src="assets/js/bootstrap.min.js"></script>
        <script defer src="assets/js/agent-sign-up.js"></script>
        <script defer src="assets/js/main.js"></script>
        <!-- signup/signin page ends -->
</body>

</html>