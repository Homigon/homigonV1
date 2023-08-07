<?php
session_start();

include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/users.class.php';

if (!isset($_SESSION['user_id'])) {
    $admin->goTo("../sign-in", "invalid_user");
}

$session_id = $_SESSION['user_id'];

if (isset($_POST['change_password'])) {

    $old_password = mysqli_real_escape_string($db->conn, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($db->conn, $_POST['new_password']);
    $confirm_new_password = mysqli_real_escape_string($db->conn, $_POST['confirm_new_password']);

    if (password_verify($old_password, $user->getDetail($session_id, "password"))) {
        if ($new_password == $confirm_new_password) {
            $hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $user->setDetail($session_id, "password", $hashed);
            $admin->goTo("change-password", "password_changed");
        } else {
            $admin->goTo("change-password", "confirm_password_incorrect");
        }
    } else {
        $admin->goTo("change-password", "old_password_incorrect");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> -->
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
            <nav>
                <?php include 'header.php'; ?>
        </div>

        <div class="black" id="blur">

        </div>

        <div class="profile">
            <?php include 'mobile-sidebar.php'; ?>


            <div class="profilec">

                <div class="dashboards">
                    <img src="../images/Vector (23).png" alt="" id="dashb">
                    <img src="../images/Vector (24).png" alt="" id="dashc">
                </div>

                <form action="" method="POST">

                    <div class="text">
                        <h2>Change Password</h2>
                        <!-- <p>Edit account details.</p> -->
                    </div>
                    <?php
                    if (isset($_GET['password_changed'])) {
                        echo "<div style='text-align:center;background:mediumseagreen;color:white;padding:20px 10px;border-radius:5px;margin-bottom:10px;'>Password changed successfully!</div>";
                    }
                    ?>

                    <?php
                    if (isset($_GET['old_password_incorrect'])) {
                        echo "<div style='text-align:center;background:crimson;color:white;padding:20px 10px;border-radius:5px;margin-bottom:10px;'>Old password is incorrect!</div>";
                    }
                    ?>

                    <?php
                    if (isset($_GET['confirm_password_incorrect'])) {
                        echo "<div style='text-align:center;background:crimson;color:white;padding:20px 10px;border-radius:5px;margin-bottom:10px;'>'New password' is not the same as 'Confirm New Password'</div>";
                    }
                    ?>
                    <div class="inputb inputp">

                        <div class="input">
                            <div class="top">
                                <h4>Old Password</h4>
                                <!-- <img src="../images/Vector (16).png" alt=""> -->
                            </div>
                            <input type="password" name="old_password" placeholder="" required>

                        </div>
                        <div class="input">
                            <div class="top">
                                <h4>New Password</h4>
                                <!-- <img src="../images/Vector (16).png" alt=""> -->
                            </div>
                            <input type="password" name="new_password" required>

                        </div>

                        <div class="input">
                            <div class="top">
                                <h4>Confirm New Password</h4>
                                <!-- <img src="../images/Vector (16).png" alt=""> -->
                            </div>
                            <input type="password" name="confirm_new_password" required>

                        </div>


                    </div>

                    <div class="save" style="margin-top:-30px;">
                        <button type="submit" name="change_password">Change Password</button>
                    </div>
                </form>
            </div>



        </div>




    </section>



    <script src="../assets/js/account.js"></script>
</body>

</html>