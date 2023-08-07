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
    <title>List a house</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/list-a-house.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- <link rel="stylesheet" href="../assets/css/example-styles.css"> -->

</head>

<body>


    <div class="list-a-house">



        <div class="listing-confirmation" id="listing-confirmation" style="display:block;">
            <div class="listing-confirmation-box">
                <div class="img">
                    <img src="../assets/img/undraw_happy_announcement_re_tsm0 1.png" alt="">
                </div>
                <p>Your Listing has been successfully edited. </p>

                <a href="my-listings">Go to My Listings</a>
            </div>
        </div>


    </div>




    <script defer src="../assets/js/all.min.js"></script>
    <script defer src="../assets/js/fontawesome.min.js"></script>
    <script src="../assets/js/list-a-house.js"></script>
    <script src=”https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js”></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script defer src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/jquery.multi-select.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#people').multiSelect();
        });
    </script>

</body>

</html>