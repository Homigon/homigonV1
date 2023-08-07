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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <title>HOMIGON</title>
</head>

<body>

    <section class="account">
        <div class="content" id="con">
            <?php include 'header.php'; ?>


        </div>

        <div class="black" id="blur">

        </div>

        <div class="profile">
            <?php include 'mobile-sidebar.php'; ?>

            <div class="upgrade">
                <div class="dashboards">
                    <img src="../images/Vector (23).png" alt="" id="dashb">
                    <img src="../images/Vector (24).png" alt="" id="dashc">
                </div>
                <h2>Upgrades</h2>
                <p>Switch between packages and do more with just one account</p>

                <div class="agent" data-aos="zoom-in" data-aos-duration="2000">
                    <div class="agentbar">
                        <div class="first" style="background-color:#effaf8 ;">
                            <h3>Free</h3>
                        </div>
                        <hr>
                        <div class="second">
                            <h3>#0</h3>
                            <p>Can only list one house at a time.</p>
                            <p>Pay a verification fee for each listing.</p>
                            <p>Each listing contains a maximum of 3 pictures.</p>
                        </div>

                        <a href="free">
                            <div class="third" style="background-color:#effaf8 ;">
                                <div class="third">
                                    <h4>Upgrade</h4>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="agentbar">
                        <div class="first" style="background-color:#fef9e6 ;">
                            <h3>Agent Basic</h3>
                        </div>
                        <hr>
                        <div class="second">
                            <h3>#0</h3>
                            <p>Can only list 3 houses at a time.</p>
                            <p>List houses for FREE.</p>
                            <p style="padding-top:1rem ;">Each listing contains a maximum of 3 pictures.</p>
                        </div>

                        <a href="basic">
                            <div class="third" style="background-color:#ffc700 ;">
                                <h4>Upgrade</h4>
                            </div>
                        </a>
                    </div>
                    <div class="agentbar">
                        <div class="first" style="background-color:#33cca8 ;">
                            <h3 style="color:#ffffff ;">Agent Pro</h3>
                        </div>
                        <hr>
                        <div class="second">
                            <h3>#0</h3>
                            <p>Can only list 10 houses at a time.</p>
                            <p>List houses for FREE.</p>
                            <p style="padding-top:1rem ;">Each listing contains a maximum of 4 pictures.</p>
                        </div>

                        <a href="pro">
                            <div class="third" style="background-color:#ffc700 ;">
                                <h4>Upgrade</h4>
                            </div>
                        </a>
                    </div>
                    <div class="agentbar">
                        <div class="first" style="background-color:#ffc700 ;">
                            <h3>Agent Ultra</h3>
                        </div>
                        <hr>
                        <div class="second u">
                            <h3>#0</h3>
                            <p>Can only list UNLIMITED houses at a time.</p>
                            <p>List houses for FREE.</p>
                            <p style="padding-top:2rem ;">Each listing contains a maximum of 4 pictures.</p>
                        </div>

                        <a href="ultra">
                            <div class="third" style="background-color:#ffc700 ;">
                                <h4>Upgrade</h4>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

    </section>





    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            delay: 600

        });
    </script>

    <script src="../assets/js/account.js"></script>
</body>

</html>