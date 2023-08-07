<?php
session_start();

include 'classes/database.class.php';
include 'classes/admin.class.php';
include 'classes/users.class.php';

if (!isset($_SESSION['signup_details'])) {
    $admin->goTo("./", "invalid_signup");
}

$details = $_SESSION['signup_details'];


if (isset($_POST['submit'])) {

    $field1 = mysqli_real_escape_string($db->conn, $_POST['field1']);
    $field2 = mysqli_real_escape_string($db->conn, $_POST['field2']);
    $field3 = mysqli_real_escape_string($db->conn, $_POST['field3']);
    $field4 = mysqli_real_escape_string($db->conn, $_POST['field4']);

    $otp = $field1 . $field2 . $field3 . $field4;

    if ($otp == $_SESSION['signup_otp']) {
        if ($_SESSION['signup_details'] != "") {
            $user_id = uniqid();
            $user->createUser($user_id, $details['user_type'], $details['firstname'], $details['lastname'], $details['email'], $details['phone'], $details['password'], $details['is_owner_or_agent']);
            $_SESSION['user_id'] = $user_id;
            $_SESSION['signup_details'] = "";
            $admin->goTo("account", "signup_success");
        } else {
            $admin->goTo("./", "invalid_signup");
        }
    } else {
        $admin->goTo("signup-otp", "invalid_otp");
    }
}




if (isset($_GET['resend'])) {
    $otp = RAND(1000, 9999);
    $_SESSION['signup_otp'] = $otp;

    // Send OTP mail here...

    $admin->goTo("signup-otp", "otp_resent");
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


    <!-- create account page starts -->
    <div class="create-account">


        <!-- email verification -->

        <div class="verify-email" id="verify-email-agent" style="display:block;">
            <div class="verify-email-box">
                <span class='popupClose' id="close-email-verification"></span>
                <h2>Verify Your Email (<?php echo $_SESSION['signup_otp']; ?>)</h2>
                <div class="img">
                    <img src="assets/img/undraw_online_ad_re_ol62 2.png" alt="">
                </div>
                <p>Enter the four digit code that was sent to <b><?php echo $details['email']; ?></b> to verify your email</p>
                <form action="" method="POST">
                    <?php
                    if (isset($_GET['invalid_otp'])) {
                        echo "<div class='alert alert-danger'>OTP is invalid!</div>";
                    }

                    if (isset($_GET['otp_resent'])) {
                        echo "<div class='alert alert-warning'>OTP has been resent!</div>";
                    }
                    ?>
                    <div class="verification-code">
                        <input name="field1" class="field field1" field_number="1" type="number" maxlength="1" required />
                        <input name="field2" class="field field2" field_number="2" type="number" maxlength="1" required />
                        <input name="field3" class="field field3" field_number="3" type="number" maxlength="1" required />
                        <input name="field4" class="field field4" field_number="4" type="number" maxlength="1" required />
                    </div>

                    <div class="button">
                        <button name="submit">Submit</button>
                    </div>
                </form>


                <div class="resend-div">
                    <p class="resend"><a href="./">Resend</a></p>

                </div>
            </div>
        </div>




    </div>

    <script src="assets/js/jquery.min.js"></script>
    <!-- <script defer src="assets/js/all.min.js"></script>
    <script defer src="assets/js/fontawesome.min.js"></script>
    <script defer src="assets/js/bootstrap.min.js"></script>
    <script defer src="assets/js/agent-sign-up.js"></script>
    <script defer src="assets/js/main.js"></script> -->
    <!-- signup/signin page ends -->

    <script>
        var current_field_number = 1;
        var next_field_number;
        var otp_value;
        var otp = document.querySelector(".otp")

        $(".field").keyup(function() {
            current_field_number = parseInt($(this).attr("field_number"));
            if ($(this).val() != "") {
                if (current_field_number < 4) {
                    next_field_number = current_field_number + 1
                } else {
                    next_field_number = 4;
                }
                $(`.field${next_field_number}`).focus();
            }

        })


        var time = 10;
        var interval = setInterval(function() {
            time--;
            if (time > 0) {
                $(".resend").html(`<a style='color:grey;font-weight:normal;'>Resend In ${time}s</a>`);
            } else {
                $(".resend").html(`<a href='signup-otp?resend'>Resend</a>`);
                clearInterval(interval);
            }
        }, 1000)
    </script>
</body>

</html>