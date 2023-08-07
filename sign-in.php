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
    <!-- navbar starts -->

    <?php include 'header.php'; ?>



    <!-- navbar ends -->


    <!-- sign-up page starts -->
    <div class="sign-up">
        <!-- <div class="header-img" >
            <img src="assets/img/hero-img-one.png" alt="" style="width: 100%; height: 200px;">
        </div> -->
        <div class="header">
            <div>
                <h3>Login</h3>
            </div>

        </div>

        <div class="body">
            <div class="login">
                <form action="" method="post">
                    <div class="form">

                        <?php
                        if (isset($_GET['invalid_email'])) {
                            echo "<div class='alert alert-danger'>Email does not exists!</div>";
                        }

                        if (isset($_GET['invalid_password'])) {
                            echo "<div class='alert alert-danger'>Password is incorrect!</div>";
                        }
                        ?>
                        <label for="">E-mail</label><br>
                        <input name="email" type="email" class="input" required><br>

                        <label for="" class="password">Password</label><br>
                        <input name="password" type="password" class="input" id="password-input" required><br>
                        <span toggle="#password-field" class="fa fa-eye field-icon toggle-password" id="password-icon" onclick="togglePassword()"></span>
                        <span toggle="#password-field" class="fa fa-eye-slash field-icon toggle-password" id="password-icon-close" onclick="togglePassword()"></span>


                        <div class="login-button">
                            <button class="login-btn" name="submit">Login</button>
                        </div>
                        <h3 id="forgot-password-open"> Forgot Password?</h3>

                    </div>
                </form>


            </div>


            <!-- <div class="line remove"></div> -->


            <div class="create-an-account">
                <div class="logo">
                    <img src="assets/img/logo.png" alt="">
                </div>
                <div class="description remove">
                    <p>Do not have an account?</p>
                    <p>Create your Homigon customer account in just a few clicks and find your dream home.</p>

                </div>


                <p class="hide">Do not have an account?</p>
                <div class="login-button">
                    <a href="create-account" class="login-btn">Create Individual Account</a>
                </div>
                <div class="login-button mt-3">
                    <a href="agent-sign-up" class="login-btn">Create Agent Account</a>
                </div>

            </div>

        </div>


    </div>
    <!-- sign-up page ends -->

    <!-- forgot password -->
    <div class="forgot-password" id="forgot-password">
        <div class="forgot-password-box">
            <h2>Forgot Password</h2>
            <p>Enter the email address for your account, we will send a verification code to your email address</p>
            <form action="" method="POST">
                <input type="email" id="forgot_password_email" placeholder="Enter your Email Address">

                <div class="button">
                    <h3 id="forgot-password-close">Cancel</h3>
                    <input type="submit" class="submit" id="reset-password-open" name="submit-forgot-password">
                    <!-- <span class="submit" id="reset-password-open">Submit</span> -->
                    <!-- <a href="./" id="reset-password-open">Submit</a> -->
                </div>
            </form>
        </div>
    </div>





    <!-- footer-section  starts-->
    <!-- footer-section  starts-->
    <?php include 'footer.php'; ?>


    <script defer src="assets/js/all.min.js"></script>
    <script defer src="assets/js/fontawesome.min.js"></script>
    <script defer src="assets/js/bootstrap.min.js"></script>
    <script defer src="assets/js/sign-in.js"></script>
    <script defer src="assets/js/main.js"></script>
</body>

</html>