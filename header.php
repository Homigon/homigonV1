    <div class="navbar">
        <div class="logo">
            <a href="./"><img src="assets/img/logo.png" alt="logo-img"></a>
        </div>

        <div class="navlinks" id="navlinks">
            <ul>
                <a href="list-a-house">
                    <li>List a House</li>
                </a>
                <a href="product-listing?category[]=Rent">
                    <li>Rent</li>
                </a>
                <a href="product-listing?category[]=Buy">
                    <li>Buy</li>
                </a>
                <li id="none">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                    ?>
                        <a href="account"><i class="fa-regular fa-user" style="color: #fff;"></i>My Account</a>
                    <?php
                    } else {
                    ?>
                        <a style="cursor:pointer;"><i class="fa-regular fa-user" style="color: #fff;"></i>Account</a>
                        <ul>
                            <a href="sign-in">
                                <li>Sign-In</li>
                            </a>
                            <a href="create-account">
                                <li>Sign-Up</li>
                            </a>
                        </ul>
                    <?php
                    }
                    ?>

                </li>
                <a href="faq">
                    <li><i class="fa-regular fa-circle-question"></i>Help</li>
                </a>

            </ul>
        </div>

        <div class="account-icon"><a href="sign-in"><i class="fa-regular fa-user fa-lg" style="color: #fff;"></i></a></div>
        <div class="hamburgeropen" id="hamburgeropen"><i class="fa-solid fa-bars fa-lg" style="color: #fff;"></i></div>

        <div class="navdropdown" id="navdropdown">
            <div class="hamburgerclose" id="hamburgerclose"><i class="fa-solid fa-xmark fa-xl" style="color: #fff;"></i></div>
            <ul>
                <a href="list-a-house">
                    <li>List a House</li>
                </a>
                <a href="product">
                    <li>Rent</li>
                </a>
                <a href="product">
                    <li>Buy</li>
                </a>
                <a href="faq">
                    <li>Help</li>
                </a>
            </ul>


        </div>


    </div>