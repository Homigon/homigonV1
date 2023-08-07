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

</head>

<body>
    <section class="account">
        <div class="content" id="con">
            <?php include 'header.php'; ?>


        </div>

        <div class="black" id="blur">

        </div>

        <div class="type tpe">
            <div class="typ ty">
                <p>Account Type: Agent Basic</p>
                <div class="span">
                    <p>Account Status: <a href="verifyB"><span style="color:#ffc700 ; margin-left: .5rem;"> Not verified</span></p></a>
                </div>
            </div>
        </div>

        <div class="verify">
            <div class="frst">
                <h3>Account Verification</h3>
                <a href="upgrade">Cancel</a>
            </div>

            <div class="form">
                <form action="basicV" method="get">
                    <div class="top">
                        <p>Personal Information</p>
                    </div>
                    <div class="one">
                        <div class="l">
                            <p>First Name</p>
                            <input type="text" required>
                        </div>
                        <div class="r">
                            <p>Last Name</p>
                            <input type="text" required>
                        </div>
                    </div>

                    <div class="one">
                        <div class="l">
                            <p>Gender</p>

                            <select name="gender" id="gender" required>
                                <option value="">Select gender</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>
                        </div>
                        <div class="r rr">
                            <p>DOB</p>
                            <div class="select">
                                <select name="day" id="day" required>
                                    <option value="">Day</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="21">20</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>

                                </select>
                                <select name="month" id="month" required>
                                    <option value="">Month</option>
                                    <option value="j">January</option>
                                    <option value="f">February</option>
                                    <option value="m">March</option>
                                    <option value="a">April</option>
                                    <option value="m">May</option>
                                    <option value="jn">June</option>
                                    <option value="jl">July</option>
                                    <option value="au">August</option>
                                    <option value="s">September</option>
                                    <option value="o">October</option>
                                    <option value="n">November</option>
                                    <option value="d">December</option>

                                </select>

                                <select name="year" id="year" required>
                                    <option value="">Year</option>
                                    <script>
                                        for (let i = 1960; i <= 2002; i++) {
                                            document.write(`<option value="${i}">${i}</option>`)
                                        }
                                    </script>
                                    <select>
                                        <!-- <input type="date" name="" id=""> -->
                            </div>
                        </div>
                    </div>
                    <div class="top">
                        <p>CONTACT INFORMATION</p>
                    </div>
                    <div class="one">
                        <div class="l">
                            <p>Phone Number</p>
                            <input type="tel" name="" id="" required>
                        </div>
                        <div class="r">
                            <p>Email Address</p>
                            <input type="email" name="" id="" required>
                        </div>
                    </div>


                    <div class="top">
                        <p> RESIDENTIAL INFORMATION</p>
                    </div>
                    <div class="one">
                        <div class="l">
                            <p>Country</p>
                            <input type="text" required>
                        </div>
                        <div class="r">
                            <p>State </p>
                            <input type="text" required>
                        </div>
                    </div>
                    <div class="one">
                        <div class="l">
                            <p>LGA</p>
                            <input type="text" required>
                        </div>
                        <div class="r rr">
                            <p>Residential Area </p>
                            <textarea name="" id="" cols="30" rows="10" required></textarea>
                        </div>

                    </div>
                    <div class="top">
                        <p>MEANS OF IDENTIFICATION</p>
                    </div>
                    <div class="one">
                        <div class="l ll">
                            <p>Type</p>
                            <select name="identity" id="identity" required>
                                <option value="">Select a means of identification</option>
                                <option value="v">Voters Card</option>
                                <option value="p">Nigeria Pilgrim"s Passport Recognized Identity Card </option>
                                <option value="n">National Identification Card</option>
                                <option value="s">Standard Nigeria Password</option>
                                <option value="p">Nigerian Diplomatic Passport</option>
                                <option value="d">Drivers Licence Identity Card</option>
                                <option value="sea">Seaman's Card of Identification</option>
                            </select>
                        </div>
                        <div class="r">
                            <p>Identity Number</p>
                            <input type="text" required>
                        </div>
                    </div>

                    <div class="last">
                        <label for="inpFile" class="selfie">
                            <input type="file" name="inpFile" id="inpFile" style="position: absolute ; visibility: hidden;">
                            <img src="../images/Group 166.png" alt="">
                            <p>Upload selfie</p>
                        </label>
                        <div class="image-preview" id="imagePreview">
                            <img src="" alt="Image Preview" class="image-preview__image" style="width:40% ;">
                            <span class="image-preview__default-text">Image-Preview</span>
                        </div>
                        <div class="save">
                            <button type="submit">Submit</button>
                        </div>
                    </div>
            </div>


        </div>
        </form>
        </div>

        </div>

    </section>

    <script src="../assets/js/account.js"></script>

    <script>
        const inpFile = document.getElementById("inpFile");
        const previewContainer = document.getElementById("imagePreview");
        const previewImage = previewContainer.querySelector(".image-preview__image");
        const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");


        inpFile.addEventListener("change", function() {
            const file = this.files[0];


            if (file) {
                const reader = new FileReader();

                previewDefaultText.style.display = "none";
                previewImage.style.display = "block";

                reader.addEventListener("load", function() {
                    previewImage.setAttribute("src", this.result);
                });

                reader.readAsDataURL(file);
            } else {
                previewDefaultText.style.display = null;
                previewImage.style.display = null;
                previewImage.setAttribute("src", "");

            }
        });
    </script>
</body>

</html>