<?php
session_start();

include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/users.class.php';

if (!isset($_SESSION['user_id'])) {
    $admin->goTo("../sign-in", "invalid_user");
}

$session_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/account.css">
    <link rel="stylesheet" href="../assets/css/media.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>HOMIGON</title>



</head>

<body>
    <section class="account">
        <div class="content" id="con">
            <?php include 'header.php'; ?>


        </div>

        <div class="black" id="blur">

        </div>
        <div class="type ">
            <div class="typ">
                <p>Account Type: <?php echo $user->getDetail($session_id, "user_type"); ?></p>
            </div>
        </div>

        <?php
        if ($user->getDetail($session_id, "verification_status") == "Not Verified" and $user->isAgent($session_id)) {
            echo "<div style='width:100%;padding:20px 0px;background:crimson;color:white;font-size:14px;text-align:center;margin-top:-20px;'>Your account is not yet verified. Kindly click <a href='verify' style='color:orange;'><u>here</u></a> to verify your account.</div>";
        }
        if ($user->getDetail($session_id, "verification_status") == "Pending" and $user->isAgent($session_id)) {
            echo "<div style='width:100%;padding:20px 0px;background:#ffc700;color:white;font-size:14px;text-align:center;margin-top:-20px;'>Your verification request is being reviewed.</div>";
        }
        ?>


        <svg width="100" height="100" fill="yellow"></svg>
        <div class="list lit ">
            <a href="profile" class="contnt">
                <h6>My Profile</h6>
                <img src="../images/Vector (2).png" alt="">
                <p>Edit Account details</p>
            </a>
            <!-- <a href="message" class="contnt">
                <h6>My Messages</h6>
                <img src="../images/Vector (3).png" alt="">
                <p>See conversations</p>
            </a> -->
            <a href="saved-items" class="contnt">
                <h6>Saved Houses</h6>
                <img src="../images/Vector (5).png" alt="">
                <p>See all your saved houses</p>
            </a>
            <?php
            if ($user->isAgent($session_id)) {
            ?>
                <a href="my-listings" class="contnt">
                    <h6>My Listings</h6>
                    <img src="../images/bx_building-house (1).png" alt="">
                    <p>Add, edit and delete your listings</p>
                </a>
            <?php
            }
            ?>
            <!-- <a href="upgrade" class="contnt">
                <h6>Upgrades</h6>
                <img src="../images/Vector (7).png" alt="">
                <p>Switch between packages</p>
            </a> -->
        </div>
    </section>

    <script defer src="../assets/js/fontawesome.min.js"></script>
    <script src="../assets/js/account.js"></script>
</body>

</html>