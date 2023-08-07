<?php
session_start();

include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/users.class.php';

if (!isset($_SESSION['user_id'])) {
    $admin->goTo("../sign-in", "invalid_user");
}

$session_id = $_SESSION['user_id'];

if (isset($_POST['save_details'])) {

    $phone = mysqli_real_escape_string($db->conn, $_POST['phone']);

    $user->setDetail($session_id, "phone", $phone);

    $admin->goTo("profile", "details_saved");
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
                        <h2>My profiles</h2>
                        <p>Edit account details.</p>
                    </div>
                    <?php
                    if (isset($_GET['details_saved'])) {
                        echo "<div class='alert alert-success' style='text-align:center;background:mediumseagreen;color:white;padding:20px 10px;border-radius:5px;margin-bottom:10px;'>Details saved successfully!</div>";
                    }
                    ?>
                    <div class="inputb inputp">

                        <div class="input">
                            <div class="top">
                                <h4>First Name</h4>
                                <!-- <img src="../images/Vector (16).png" alt=""> -->
                            </div>
                            <input type="text" readonly name="firstname" value="<?php echo $user->getDetail($session_id, "firstname") ?>" placeholder="" required>

                        </div>
                        <div class="input">
                            <div class="top">
                                <h4>Last Name</h4>
                                <!-- <img src="../images/Vector (16).png" alt=""> -->
                            </div>
                            <input type="text" readonly name="lastname" value="<?php echo $user->getDetail($session_id, "lastname") ?>" required>

                        </div>
                        <div class="input">
                            <div class="top">
                                <h4>E-mail</h4>
                                <!-- <img src="../images/Vector (16).png" alt=""> -->
                            </div>
                            <input type="email" readonly name="email" value="<?php echo $user->getDetail($session_id, "email") ?>" id="" required>

                        </div>
                        <div class="input">
                            <div class="top">
                                <h4>Phone Number</h4>
                                <img src="../images/Vector (16).png" alt="">
                            </div>
                            <input type="tel" name="phone" value="<?php echo $user->getDetail($session_id, "phone") ?>" id="" required>

                        </div>

                    </div>

                    <div class="save" style="margin-top:-30px;">
                        <button type="submit" name="save_details">Save</button>
                    </div>
                </form>
            </div>




        </div>




    </section>



    <script src="../assets/js/account.js"></script>
</body>

</html>