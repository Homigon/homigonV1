<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/account.css">
    <link rel="stylesheet" href="../assets/css/media.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>HOMIGON</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand&display=swap');
    </style>
</head>

<body>
    <section class="account">
        <div class="content" id="con">
            <?php include 'header.php'; ?>


        </div>

        <div class="black" id="blur">

        </div>

        <div class="type">
            <div class="typ">
                <p>Account Type: Agent Free</p>
                <div class="span">
                    <p>Account Status: <a href="verifyF"><span> Not verified</span></p></a>
                </div>
            </div>
        </div>

        <div class="list lst">
            <a href="profile" class="contnt">
                <h6>My Profile</h6>
                <img src="../images/Vector (2).png" alt="">
                <p>Edit Account details</p>
            </a>
            <a href="message" class="contnt">
                <h6>My Messages</h6>
                <img src="../images/Vector (3).png" alt="">
                <p>See conversations</p>
            </a>
            <a href="houses" class="contnt">
                <h6>Saved Houses</h6>
                <img src="../images/Vector (5).png" alt="">
                <p>See all your saved houses</p>
            </a>
            <a href="listing" class="contnt">
                <h6>My Listings</h6>
                <img src="../images/bx_building-house (1).png" alt="">
                <p>Add, edit and delete your listings</p>
            </a>
            <a href="upgrade" class="contnt">
                <h6>Upgrades</h6>
                <img src="../images/Vector (7).png" alt="">
                <p>Switch between packages</p>
            </a>
        </div>
    </section>


    <script src="../assets/js/account.js"></script>
</body>

</html>