<?php
session_start();

include 'classes/database.class.php';
include 'classes/admin.class.php';
include 'classes/users.class.php';

if (!isset($_GET['key_id'])) {
    $admin->goTo("sign-in", "invalid_password_reset");
}

$key_id = mysqli_real_escape_string($db->conn, $_GET['key_id']);

if (!$admin->passwordRecoveryKeyIsValid($key_id)) {
    $admin->goTo("sign-in", "invalid_password_reset");
}

if (isset($_GET['submit'])) {
    $password = mysqli_real_escape_string($db->conn, $_GET['password']);
    $confirm_password = mysqli_real_escape_string($db->conn, $_GET['confirm_password']);

    if ($password == $confirm_password) {

        $result = $db->setQuery("SELECT * FROM password_recovery_keys WHERE key_id='$key_id';");
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $user->setDetail($user_id, "password", $hashed);

        $admin->goTo("sign-in", "password_changed");
    } else {
        $admin->goTo("reset-password", "invalid_passwords&key_id=$key_id");
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
            <!-- <p>Enter the email address for your account, we will send a verification code to your email address</p> -->
            <form action="" method="GET">
                <?php
                if (isset($_GET['invalid_passwords'])) {
                    echo "<div class='alert alert-danger'>Passwords do not match!</div>";
                }
                ?>
                <input type="hidden" name="key_id" value="<?php echo $key_id; ?>">
                <input type="password" name="password" placeholder="Enter New Password">
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <div class="button">
                    <!-- <h3 id="new-password-close">Cancel</h3> -->
                    <button type="submit" class="submit" id="new-password" name="submit" style="padding:15px;"> Submit</button>
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