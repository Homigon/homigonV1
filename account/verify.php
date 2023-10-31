<?php
session_start();

include '../classes/database.class.php';
include '../classes/admin.class.php';
include '../classes/users.class.php';

if (!isset($_SESSION['user_id'])) {
    $admin->goTo("../sign-in", "invalid_user");
}

$session_id = $_SESSION['user_id'];


if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($db->conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db->conn, $_POST['lastname']);
    $gender = mysqli_real_escape_string($db->conn, $_POST['gender']);
    $day = mysqli_real_escape_string($db->conn, $_POST['day']);
    $month = mysqli_real_escape_string($db->conn, $_POST['month']);
    $year = mysqli_real_escape_string($db->conn, $_POST['year']);
    $phone = mysqli_real_escape_string($db->conn, $_POST['phone']);
    $email = mysqli_real_escape_string($db->conn, $_POST['email']);
    $country = mysqli_real_escape_string($db->conn, $_POST['country']);
    $state = mysqli_real_escape_string($db->conn, $_POST['state']);
    $lga = mysqli_real_escape_string($db->conn, $_POST['lga']);
    $residential_area = mysqli_real_escape_string($db->conn, $_POST['residential_area']);
    $means_of_identification = mysqli_real_escape_string($db->conn, $_POST['means_of_identification']);
    $identification_number = mysqli_real_escape_string($db->conn, $_POST['identification_number']);
    $images = mysqli_real_escape_string($db->conn, $_POST['images']);

    $date_of_birth = $day . "_" . $month . "_" . $year;

    $user->addVerification($session_id, $firstname, $lastname, $gender, $date_of_birth, $phone, $email, $country, $state, $lga, $residential_area, $means_of_identification, $identification_number, $images);
    $user->setDetail($session_id, "verification_status", "Pending");

    $admin->goTo("verify", "request_sent");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.0-web/css/all.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="../assets/css/account.css?v=<?php echo uniqid(); ?>">
    <link rel="stylesheet" href="../assets/css/media.css?v=<?php echo uniqid(); ?>">
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
                <p>Account Type: <?php echo $user->getDetail($session_id, "user_type"); ?></p>
                <div class="span">
                    <p>Account Status:
                        <?php
                        if ($user->getDetail($session_id, "verification_status") == "Not Verified") {
                            echo '<a><span style="color:#ffc700 ; margin-left: .5rem;"> Not verified</span></a>';
                        } else if ($user->getDetail($session_id, "verification_status") == "Verified") {
                            echo '<a><span style="color:#fff ; margin-left: .5rem;"> verified</span></a>';
                        } else if ($user->getDetail($session_id, "verification_status") == "Pending") {
                            echo '<a><span style="color:#ffc700 ; margin-left: .5rem;"> Pending Approval</span></a>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="verify">
            <div class="frst">
                <h3>Account Verification</h3>
                <!-- <a href="upgrade">Cancel</a> -->
            </div>
            <?php
            if ($user->getDetail($session_id, "verification_status") == "Not Verified") {
            ?>
                <div class="form">
                    <form action="" method="POST" onsubmit="return validateForm()">
                        <div class="top">
                            <p>Personal Information</p>
                        </div>
                        <div class="one">
                            <div class="l">
                                <p>First Name</p>
                                <input name="firstname" value="<?php echo $user->getDetail($session_id, "firstname"); ?>" type="text" required readonly>
                            </div>
                            <div class="r">
                                <p>Last Name</p>
                                <input name="lastname" value="<?php echo $user->getDetail($session_id, "lastname"); ?>" type="text" required readonly>
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
                                        <?php
                                        for ($i = 1; $i <= 31; $i++) {
                                            echo "<option>$i</option>";
                                        }
                                        ?>

                                    </select>
                                    <select name="month" id="month" required>
                                        <optio>Month</option>
                                            <option>January</option>
                                            <option>February</option>
                                            <option>March</option>
                                            <option>April</option>
                                            <option>May</option>
                                            <option>June</option>
                                            <option>July</option>
                                            <option>August</option>
                                            <option>September</option>
                                            <option>October</option>
                                            <option>November</option>
                                            <option>December</option>

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
                                <input type="tel" value="<?php echo $user->getDetail($session_id, "phone"); ?>" name="phone" id="" required readonly>
                            </div>
                            <div class="r">
                                <p>Email Address</p>
                                <input type="email" value="<?php echo $user->getDetail($session_id, "email"); ?>" name="email" id="" required readonly>
                            </div>
                        </div>


                        <div class="top">
                            <p> RESIDENTIAL INFORMATION</p>
                        </div>
                        <div class="one">
                            <div class="l">
                                <p>Country</p>
                                <select name="country" required>
                                    <option value="">[Please Select]</option>
                                    <option data-mobile_code="93" value="Afghanistan" data-code="AF">Afghanistan</option>
                                    <option data-mobile_code="358" value="Aland Islands" data-code="AX">Aland Islands</option>
                                    <option data-mobile_code="355" value="Albania" data-code="AL">Albania</option>
                                    <option data-mobile_code="213" value="Algeria" data-code="DZ">Algeria</option>
                                    <option data-mobile_code="1684" value="AmericanSamoa" data-code="AS">AmericanSamoa</option>
                                    <option data-mobile_code="376" value="Andorra" data-code="AD">Andorra</option>
                                    <option data-mobile_code="244" value="Angola" data-code="AO">Angola</option>
                                    <option data-mobile_code="1264" value="Anguilla" data-code="AI">Anguilla</option>
                                    <option data-mobile_code="672" value="Antarctica" data-code="AQ">Antarctica</option>
                                    <option data-mobile_code="1268" value="Antigua and Barbuda" data-code="AG">Antigua and Barbuda</option>
                                    <option data-mobile_code="54" value="Argentina" data-code="AR">Argentina</option>
                                    <option data-mobile_code="374" value="Armenia" data-code="AM">Armenia</option>
                                    <option data-mobile_code="297" value="Aruba" data-code="AW">Aruba</option>
                                    <option data-mobile_code="61" value="Australia" data-code="AU">Australia</option>
                                    <option data-mobile_code="43" value="Austria" data-code="AT">Austria</option>
                                    <option data-mobile_code="994" value="Azerbaijan" data-code="AZ">Azerbaijan</option>
                                    <option data-mobile_code="1242" value="Bahamas" data-code="BS">Bahamas</option>
                                    <option data-mobile_code="973" value="Bahrain" data-code="BH">Bahrain</option>
                                    <option data-mobile_code="880" value="Bangladesh" data-code="BD">Bangladesh</option>
                                    <option data-mobile_code="1246" value="Barbados" data-code="BB">Barbados</option>
                                    <option data-mobile_code="375" value="Belarus" data-code="BY">Belarus</option>
                                    <option data-mobile_code="32" value="Belgium" data-code="BE">Belgium</option>
                                    <option data-mobile_code="501" value="Belize" data-code="BZ">Belize</option>
                                    <option data-mobile_code="229" value="Benin" data-code="BJ">Benin</option>
                                    <option data-mobile_code="1441" value="Bermuda" data-code="BM">Bermuda</option>
                                    <option data-mobile_code="975" value="Bhutan" data-code="BT">Bhutan</option>
                                    <option data-mobile_code="591" value="Bolivia, Plurinational State of" data-code="BO">Bolivia, Plurinational State of</option>
                                    <option data-mobile_code="387" value="Bosnia and Herzegovina" data-code="BA">Bosnia and Herzegovina</option>
                                    <option data-mobile_code="267" value="Botswana" data-code="BW">Botswana</option>
                                    <option data-mobile_code="55" value="Brazil" data-code="BR">Brazil</option>
                                    <option data-mobile_code="246" value="British Indian Ocean Territory" data-code="IO">British Indian Ocean Territory</option>
                                    <option data-mobile_code="673" value="Brunei Darussalam" data-code="BN">Brunei Darussalam</option>
                                    <option data-mobile_code="359" value="Bulgaria" data-code="BG">Bulgaria</option>
                                    <option data-mobile_code="226" value="Burkina Faso" data-code="BF">Burkina Faso</option>
                                    <option data-mobile_code="257" value="Burundi" data-code="BI">Burundi</option>
                                    <option data-mobile_code="855" value="Cambodia" data-code="KH">Cambodia</option>
                                    <option data-mobile_code="237" value="Cameroon" data-code="CM">Cameroon</option>
                                    <option data-mobile_code="1" value="Canada" data-code="CA">Canada</option>
                                    <option data-mobile_code="238" value="Cape Verde" data-code="CV">Cape Verde</option>
                                    <option data-mobile_code=" 345" value="Cayman Islands" data-code="KY">Cayman Islands</option>
                                    <option data-mobile_code="236" value="Central African Republic" data-code="CF">Central African Republic</option>
                                    <option data-mobile_code="235" value="Chad" data-code="TD">Chad</option>
                                    <option data-mobile_code="56" value="Chile" data-code="CL">Chile</option>
                                    <option data-mobile_code="86" value="China" data-code="CN">China</option>
                                    <option data-mobile_code="61" value="Christmas Island" data-code="CX">Christmas Island</option>
                                    <option data-mobile_code="61" value="Cocos (Keeling) Islands" data-code="CC">Cocos (Keeling) Islands</option>
                                    <option data-mobile_code="57" value="Colombia" data-code="CO">Colombia</option>
                                    <option data-mobile_code="269" value="Comoros" data-code="KM">Comoros</option>
                                    <option data-mobile_code="242" value="Congo" data-code="CG">Congo</option>
                                    <option data-mobile_code="243" value="Congo, The Democratic Republic of the Congo" data-code="CD">Congo, The Democratic Republic of the Congo</option>
                                    <option data-mobile_code="682" value="Cook Islands" data-code="CK">Cook Islands</option>
                                    <option data-mobile_code="506" value="Costa Rica" data-code="CR">Costa Rica</option>
                                    <option data-mobile_code="225" value="Cote d&#039;Ivoire" data-code="CI">Cote d&#039;Ivoire</option>
                                    <option data-mobile_code="385" value="Croatia" data-code="HR">Croatia</option>
                                    <option data-mobile_code="53" value="Cuba" data-code="CU">Cuba</option>
                                    <option data-mobile_code="357" value="Cyprus" data-code="CY">Cyprus</option>
                                    <option data-mobile_code="420" value="Czech Republic" data-code="CZ">Czech Republic</option>
                                    <option data-mobile_code="45" value="Denmark" data-code="DK">Denmark</option>
                                    <option data-mobile_code="253" value="Djibouti" data-code="DJ">Djibouti</option>
                                    <option data-mobile_code="1767" value="Dominica" data-code="DM">Dominica</option>
                                    <option data-mobile_code="1849" value="Dominican Republic" data-code="DO">Dominican Republic</option>
                                    <option data-mobile_code="593" value="Ecuador" data-code="EC">Ecuador</option>
                                    <option data-mobile_code="20" value="Egypt" data-code="EG">Egypt</option>
                                    <option data-mobile_code="503" value="El Salvador" data-code="SV">El Salvador</option>
                                    <option data-mobile_code="240" value="Equatorial Guinea" data-code="GQ">Equatorial Guinea</option>
                                    <option data-mobile_code="291" value="Eritrea" data-code="ER">Eritrea</option>
                                    <option data-mobile_code="372" value="Estonia" data-code="EE">Estonia</option>
                                    <option data-mobile_code="251" value="Ethiopia" data-code="ET">Ethiopia</option>
                                    <option data-mobile_code="500" value="Falkland Islands (Malvinas)" data-code="FK">Falkland Islands (Malvinas)</option>
                                    <option data-mobile_code="298" value="Faroe Islands" data-code="FO">Faroe Islands</option>
                                    <option data-mobile_code="679" value="Fiji" data-code="FJ">Fiji</option>
                                    <option data-mobile_code="358" value="Finland" data-code="FI">Finland</option>
                                    <option data-mobile_code="33" value="France" data-code="FR">France</option>
                                    <option data-mobile_code="594" value="French Guiana" data-code="GF">French Guiana</option>
                                    <option data-mobile_code="689" value="French Polynesia" data-code="PF">French Polynesia</option>
                                    <option data-mobile_code="241" value="Gabon" data-code="GA">Gabon</option>
                                    <option data-mobile_code="220" value="Gambia" data-code="GM">Gambia</option>
                                    <option data-mobile_code="995" value="Georgia" data-code="GE">Georgia</option>
                                    <option data-mobile_code="49" value="Germany" data-code="DE">Germany</option>
                                    <option data-mobile_code="233" value="Ghana" data-code="GH">Ghana</option>
                                    <option data-mobile_code="350" value="Gibraltar" data-code="GI">Gibraltar</option>
                                    <option data-mobile_code="30" value="Greece" data-code="GR">Greece</option>
                                    <option data-mobile_code="299" value="Greenland" data-code="GL">Greenland</option>
                                    <option data-mobile_code="1473" value="Grenada" data-code="GD">Grenada</option>
                                    <option data-mobile_code="590" value="Guadeloupe" data-code="GP">Guadeloupe</option>
                                    <option data-mobile_code="1671" value="Guam" data-code="GU">Guam</option>
                                    <option data-mobile_code="502" value="Guatemala" data-code="GT">Guatemala</option>
                                    <option data-mobile_code="44" value="Guernsey" data-code="GG">Guernsey</option>
                                    <option data-mobile_code="224" value="Guinea" data-code="GN">Guinea</option>
                                    <option data-mobile_code="245" value="Guinea-Bissau" data-code="GW">Guinea-Bissau</option>
                                    <option data-mobile_code="595" value="Guyana" data-code="GY">Guyana</option>
                                    <option data-mobile_code="509" value="Haiti" data-code="HT">Haiti</option>
                                    <option data-mobile_code="379" value="Holy See (Vatican City State)" data-code="VA">Holy See (Vatican City State)</option>
                                    <option data-mobile_code="504" value="Honduras" data-code="HN">Honduras</option>
                                    <option data-mobile_code="852" value="Hong Kong" data-code="HK">Hong Kong</option>
                                    <option data-mobile_code="36" value="Hungary" data-code="HU">Hungary</option>
                                    <option data-mobile_code="354" value="Iceland" data-code="IS">Iceland</option>
                                    <option data-mobile_code="91" value="India" data-code="IN">India</option>
                                    <option data-mobile_code="62" value="Indonesia" data-code="ID">Indonesia</option>
                                    <option data-mobile_code="98" value="Iran, Islamic Republic of Persian Gulf" data-code="IR">Iran, Islamic Republic of Persian Gulf</option>
                                    <option data-mobile_code="964" value="Iraq" data-code="IQ">Iraq</option>
                                    <option data-mobile_code="353" value="Ireland" data-code="IE">Ireland</option>
                                    <option data-mobile_code="44" value="Isle of Man" data-code="IM">Isle of Man</option>
                                    <option data-mobile_code="972" value="Israel" data-code="IL">Israel</option>
                                    <option data-mobile_code="39" value="Italy" data-code="IT">Italy</option>
                                    <option data-mobile_code="1876" value="Jamaica" data-code="JM">Jamaica</option>
                                    <option data-mobile_code="81" value="Japan" data-code="JP">Japan</option>
                                    <option data-mobile_code="44" value="Jersey" data-code="JE">Jersey</option>
                                    <option data-mobile_code="962" value="Jordan" data-code="JO">Jordan</option>
                                    <option data-mobile_code="77" value="Kazakhstan" data-code="KZ">Kazakhstan</option>
                                    <option data-mobile_code="254" value="Kenya" data-code="KE">Kenya</option>
                                    <option data-mobile_code="686" value="Kiribati" data-code="KI">Kiribati</option>
                                    <option data-mobile_code="850" value="Korea, Democratic People&#039;s Republic of Korea" data-code="KP">Korea, Democratic People&#039;s Republic of Korea</option>
                                    <option data-mobile_code="82" value="Korea, Republic of South Korea" data-code="KR">Korea, Republic of South Korea</option>
                                    <option data-mobile_code="965" value="Kuwait" data-code="KW">Kuwait</option>
                                    <option data-mobile_code="996" value="Kyrgyzstan" data-code="KG">Kyrgyzstan</option>
                                    <option data-mobile_code="856" value="Laos" data-code="LA">Laos</option>
                                    <option data-mobile_code="371" value="Latvia" data-code="LV">Latvia</option>
                                    <option data-mobile_code="961" value="Lebanon" data-code="LB">Lebanon</option>
                                    <option data-mobile_code="266" value="Lesotho" data-code="LS">Lesotho</option>
                                    <option data-mobile_code="231" value="Liberia" data-code="LR">Liberia</option>
                                    <option data-mobile_code="218" value="Libyan Arab Jamahiriya" data-code="LY">Libyan Arab Jamahiriya</option>
                                    <option data-mobile_code="423" value="Liechtenstein" data-code="LI">Liechtenstein</option>
                                    <option data-mobile_code="370" value="Lithuania" data-code="LT">Lithuania</option>
                                    <option data-mobile_code="352" value="Luxembourg" data-code="LU">Luxembourg</option>
                                    <option data-mobile_code="853" value="Macao" data-code="MO">Macao</option>
                                    <option data-mobile_code="389" value="Macedonia" data-code="MK">Macedonia</option>
                                    <option data-mobile_code="261" value="Madagascar" data-code="MG">Madagascar</option>
                                    <option data-mobile_code="265" value="Malawi" data-code="MW">Malawi</option>
                                    <option data-mobile_code="60" value="Malaysia" data-code="MY">Malaysia</option>
                                    <option data-mobile_code="960" value="Maldives" data-code="MV">Maldives</option>
                                    <option data-mobile_code="223" value="Mali" data-code="ML">Mali</option>
                                    <option data-mobile_code="356" value="Malta" data-code="MT">Malta</option>
                                    <option data-mobile_code="692" value="Marshall Islands" data-code="MH">Marshall Islands</option>
                                    <option data-mobile_code="596" value="Martinique" data-code="MQ">Martinique</option>
                                    <option data-mobile_code="222" value="Mauritania" data-code="MR">Mauritania</option>
                                    <option data-mobile_code="230" value="Mauritius" data-code="MU">Mauritius</option>
                                    <option data-mobile_code="262" value="Mayotte" data-code="YT">Mayotte</option>
                                    <option data-mobile_code="52" value="Mexico" data-code="MX">Mexico</option>
                                    <option data-mobile_code="691" value="Micronesia, Federated States of Micronesia" data-code="FM">Micronesia, Federated States of Micronesia</option>
                                    <option data-mobile_code="373" value="Moldova" data-code="MD">Moldova</option>
                                    <option data-mobile_code="377" value="Monaco" data-code="MC">Monaco</option>
                                    <option data-mobile_code="976" value="Mongolia" data-code="MN">Mongolia</option>
                                    <option data-mobile_code="382" value="Montenegro" data-code="ME">Montenegro</option>
                                    <option data-mobile_code="1664" value="Montserrat" data-code="MS">Montserrat</option>
                                    <option data-mobile_code="212" value="Morocco" data-code="MA">Morocco</option>
                                    <option data-mobile_code="258" value="Mozambique" data-code="MZ">Mozambique</option>
                                    <option data-mobile_code="95" value="Myanmar" data-code="MM">Myanmar</option>
                                    <option data-mobile_code="264" value="Namibia" data-code="NA">Namibia</option>
                                    <option data-mobile_code="674" value="Nauru" data-code="NR">Nauru</option>
                                    <option data-mobile_code="977" value="Nepal" data-code="NP">Nepal</option>
                                    <option data-mobile_code="31" value="Netherlands" data-code="NL">Netherlands</option>
                                    <option data-mobile_code="599" value="Netherlands Antilles" data-code="AN">Netherlands Antilles</option>
                                    <option data-mobile_code="687" value="New Caledonia" data-code="NC">New Caledonia</option>
                                    <option data-mobile_code="64" value="New Zealand" data-code="NZ">New Zealand</option>
                                    <option data-mobile_code="505" value="Nicaragua" data-code="NI">Nicaragua</option>
                                    <option data-mobile_code="227" value="Niger" data-code="NE">Niger</option>
                                    <option data-mobile_code="234" value="Nigeria" data-code="NG">Nigeria</option>
                                    <option data-mobile_code="683" value="Niue" data-code="NU">Niue</option>
                                    <option data-mobile_code="672" value="Norfolk Island" data-code="NF">Norfolk Island</option>
                                    <option data-mobile_code="1670" value="Northern Mariana Islands" data-code="MP">Northern Mariana Islands</option>
                                    <option data-mobile_code="47" value="Norway" data-code="NO">Norway</option>
                                    <option data-mobile_code="968" value="Oman" data-code="OM">Oman</option>
                                    <option data-mobile_code="92" value="Pakistan" data-code="PK">Pakistan</option>
                                    <option data-mobile_code="680" value="Palau" data-code="PW">Palau</option>
                                    <option data-mobile_code="970" value="Palestinian Territory, Occupied" data-code="PS">Palestinian Territory, Occupied</option>
                                    <option data-mobile_code="507" value="Panama" data-code="PA">Panama</option>
                                    <option data-mobile_code="675" value="Papua New Guinea" data-code="PG">Papua New Guinea</option>
                                    <option data-mobile_code="595" value="Paraguay" data-code="PY">Paraguay</option>
                                    <option data-mobile_code="51" value="Peru" data-code="PE">Peru</option>
                                    <option data-mobile_code="63" value="Philippines" data-code="PH">Philippines</option>
                                    <option data-mobile_code="872" value="Pitcairn" data-code="PN">Pitcairn</option>
                                    <option data-mobile_code="48" value="Poland" data-code="PL">Poland</option>
                                    <option data-mobile_code="351" value="Portugal" data-code="PT">Portugal</option>
                                    <option data-mobile_code="1939" value="Puerto Rico" data-code="PR">Puerto Rico</option>
                                    <option data-mobile_code="974" value="Qatar" data-code="QA">Qatar</option>
                                    <option data-mobile_code="40" value="Romania" data-code="RO">Romania</option>
                                    <option data-mobile_code="7" value="Russia" data-code="RU">Russia</option>
                                    <option data-mobile_code="250" value="Rwanda" data-code="RW">Rwanda</option>
                                    <option data-mobile_code="262" value="Reunion" data-code="RE">Reunion</option>
                                    <option data-mobile_code="590" value="Saint Barthelemy" data-code="BL">Saint Barthelemy</option>
                                    <option data-mobile_code="290" value="Saint Helena, Ascension and Tristan Da Cunha" data-code="SH">Saint Helena, Ascension and Tristan Da Cunha</option>
                                    <option data-mobile_code="1869" value="Saint Kitts and Nevis" data-code="KN">Saint Kitts and Nevis</option>
                                    <option data-mobile_code="1758" value="Saint Lucia" data-code="LC">Saint Lucia</option>
                                    <option data-mobile_code="590" value="Saint Martin" data-code="MF">Saint Martin</option>
                                    <option data-mobile_code="508" value="Saint Pierre and Miquelon" data-code="PM">Saint Pierre and Miquelon</option>
                                    <option data-mobile_code="1784" value="Saint Vincent and the Grenadines" data-code="VC">Saint Vincent and the Grenadines</option>
                                    <option data-mobile_code="685" value="Samoa" data-code="WS">Samoa</option>
                                    <option data-mobile_code="378" value="San Marino" data-code="SM">San Marino</option>
                                    <option data-mobile_code="239" value="Sao Tome and Principe" data-code="ST">Sao Tome and Principe</option>
                                    <option data-mobile_code="966" value="Saudi Arabia" data-code="SA">Saudi Arabia</option>
                                    <option data-mobile_code="221" value="Senegal" data-code="SN">Senegal</option>
                                    <option data-mobile_code="381" value="Serbia" data-code="RS">Serbia</option>
                                    <option data-mobile_code="248" value="Seychelles" data-code="SC">Seychelles</option>
                                    <option data-mobile_code="232" value="Sierra Leone" data-code="SL">Sierra Leone</option>
                                    <option data-mobile_code="65" value="Singapore" data-code="SG">Singapore</option>
                                    <option data-mobile_code="421" value="Slovakia" data-code="SK">Slovakia</option>
                                    <option data-mobile_code="386" value="Slovenia" data-code="SI">Slovenia</option>
                                    <option data-mobile_code="677" value="Solomon Islands" data-code="SB">Solomon Islands</option>
                                    <option data-mobile_code="252" value="Somalia" data-code="SO">Somalia</option>
                                    <option data-mobile_code="27" value="South Africa" data-code="ZA">South Africa</option>
                                    <option data-mobile_code="211" value="South Sudan" data-code="SS">South Sudan</option>
                                    <option data-mobile_code="500" value="South Georgia and the South Sandwich Islands" data-code="GS">South Georgia and the South Sandwich Islands</option>
                                    <option data-mobile_code="34" value="Spain" data-code="ES">Spain</option>
                                    <option data-mobile_code="94" value="Sri Lanka" data-code="LK">Sri Lanka</option>
                                    <option data-mobile_code="249" value="Sudan" data-code="SD">Sudan</option>
                                    <option data-mobile_code="597" value="Suricountry" data-code="SR">Suricountry</option>
                                    <option data-mobile_code="47" value="Svalbard and Jan Mayen" data-code="SJ">Svalbard and Jan Mayen</option>
                                    <option data-mobile_code="268" value="Swaziland" data-code="SZ">Swaziland</option>
                                    <option data-mobile_code="46" value="Sweden" data-code="SE">Sweden</option>
                                    <option data-mobile_code="41" value="Switzerland" data-code="CH">Switzerland</option>
                                    <option data-mobile_code="963" value="Syrian Arab Republic" data-code="SY">Syrian Arab Republic</option>
                                    <option data-mobile_code="886" value="Taiwan" data-code="TW">Taiwan</option>
                                    <option data-mobile_code="992" value="Tajikistan" data-code="TJ">Tajikistan</option>
                                    <option data-mobile_code="255" value="Tanzania, United Republic of Tanzania" data-code="TZ">Tanzania, United Republic of Tanzania</option>
                                    <option data-mobile_code="66" value="Thailand" data-code="TH">Thailand</option>
                                    <option data-mobile_code="670" value="Timor-Leste" data-code="TL">Timor-Leste</option>
                                    <option data-mobile_code="228" value="Togo" data-code="TG">Togo</option>
                                    <option data-mobile_code="690" value="Tokelau" data-code="TK">Tokelau</option>
                                    <option data-mobile_code="676" value="Tonga" data-code="TO">Tonga</option>
                                    <option data-mobile_code="1868" value="Trinidad and Tobago" data-code="TT">Trinidad and Tobago</option>
                                    <option data-mobile_code="216" value="Tunisia" data-code="TN">Tunisia</option>
                                    <option data-mobile_code="90" value="Turkey" data-code="TR">Turkey</option>
                                    <option data-mobile_code="993" value="Turkmenistan" data-code="TM">Turkmenistan</option>
                                    <option data-mobile_code="1649" value="Turks and Caicos Islands" data-code="TC">Turks and Caicos Islands</option>
                                    <option data-mobile_code="688" value="Tuvalu" data-code="TV">Tuvalu</option>
                                    <option data-mobile_code="256" value="Uganda" data-code="UG">Uganda</option>
                                    <option data-mobile_code="380" value="Ukraine" data-code="UA">Ukraine</option>
                                    <option data-mobile_code="971" value="United Arab Emirates" data-code="AE">United Arab Emirates</option>
                                    <option data-mobile_code="44" value="United Kingdom" data-code="GB">United Kingdom</option>
                                    <option data-mobile_code="1" value="United States" data-code="US">United States</option>
                                    <option data-mobile_code="598" value="Uruguay" data-code="UY">Uruguay</option>
                                    <option data-mobile_code="998" value="Uzbekistan" data-code="UZ">Uzbekistan</option>
                                    <option data-mobile_code="678" value="Vanuatu" data-code="VU">Vanuatu</option>
                                    <option data-mobile_code="58" value="Venezuela, Bolivarian Republic of Venezuela" data-code="VE">Venezuela, Bolivarian Republic of Venezuela</option>
                                    <option data-mobile_code="84" value="Vietnam" data-code="VN">Vietnam</option>
                                    <option data-mobile_code="1284" value="Virgin Islands, British" data-code="VG">Virgin Islands, British</option>
                                    <option data-mobile_code="1340" value="Virgin Islands, U.S." data-code="VI">Virgin Islands, U.S.</option>
                                    <option data-mobile_code="681" value="Wallis and Futuna" data-code="WF">Wallis and Futuna</option>
                                    <option data-mobile_code="967" value="Yemen" data-code="YE">Yemen</option>
                                    <option data-mobile_code="260" value="Zambia" data-code="ZM">Zambia</option>
                                    <option data-mobile_code="263" value="Zimbabwe" data-code="ZW">Zimbabwe</option>
                                </select>
                            </div>
                            <div class="r">
                                <p>State </p>
                                <select name="state" required>
                                    <option value="">[Please Select]</option>
                                    <option>None</option>
                                    <option value="Abia">Abia</option>
                                    <option value="Adamawa">Adamawa</option>
                                    <option value="Akwa Ibom">Akwa Ibom</option>
                                    <option value="Anambra">Anambra</option>
                                    <option value="Bauchi">Bauchi</option>
                                    <option value="Bayelsa">Bayelsa</option>
                                    <option value="Benue">Benue</option>
                                    <option value="Borno">Borno</option>
                                    <option value="Cross River">Cross River</option>
                                    <option value="Delta">Delta</option>
                                    <option value="Ebonyi">Ebonyi</option>
                                    <option value="Edo">Edo</option>
                                    <option value="Ekiti">Ekiti</option>
                                    <option value="Enugu">Enugu</option>
                                    <option value="FCT">Federal Capital Territory</option>
                                    <option value="Gombe">Gombe</option>
                                    <option value="Imo">Imo</option>
                                    <option value="Jigawa">Jigawa</option>
                                    <option value="Kaduna">Kaduna</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Katsina">Katsina</option>
                                    <option value="Kebbi">Kebbi</option>
                                    <option value="Kogi">Kogi</option>
                                    <option value="Kwara">Kwara</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Nasarawa">Nasarawa</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Ogun">Ogun</option>
                                    <option value="Ondo">Ondo</option>
                                    <option value="Osun">Osun</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Rivers">Rivers</option>
                                    <option value="Sokoto">Sokoto</option>
                                    <option value="Taraba">Taraba</option>
                                    <option value="Yobe">Yobe</option>
                                    <option value="Zamfara">Zamfara</option>
                                </select>
                            </div>
                        </div>
                        <div class="one">
                            <div class="l">
                                <p>LGA</p>
                                <input name="lga" type="text" required>
                            </div>
                            <div class="r rr">
                                <p>Residential Area </p>
                                <textarea name="residential_area" id="" cols="30" rows="10" required></textarea>
                            </div>

                        </div>
                        <div class="top">
                            <p>MEANS OF IDENTIFICATION</p>
                        </div>
                        <div class="one">
                            <div class="l ll">
                                <p>Type</p>
                                <select name="means_of_identification" id="identity" required>
                                    <option value="">Select a means of identification</option>
                                    <option>Voters Card</option>
                                    <option>Nigeria Pilgrim"s Passport Recognized Identity Card </option>
                                    <option>National Identification Card</option>
                                    <option>Standard Nigeria Password</option>
                                    <option>Nigerian Diplomatic Passport</option>
                                    <option>Drivers Licence Identity Card</option>
                                    <option>Seaman's Card of Identification</option>
                                </select>
                            </div>
                            <div class="r">
                                <p>Identity Number</p>
                                <input name="identification_number" type="text" required>
                            </div>
                        </div>

                        <div class="last">
                            <label for="inpFile" class="selfie">
                                <input type="file" name="inpFile" id="inpFile" style="position: absolute ; visibility: hidden;">
                                <img src="../images/Group 166.png" alt="">
                                <p>Upload selfie</p>
                            </label>
                            <div class="image-preview-container" id="image-preview-container" style="display:flex;gap:20px;">
                                <!-- <div class="image-preview" id="imagePreview">
                                    <img src="" alt="Image Preview" class="image-preview__image">
                                </div> -->
                            </div>
                            <div class="save">
                                <button type="submit" name="submit">Submit</button>
                            </div>
                        </div>
                        <input type="hidden" name="images" class="images">
                    </form>
                </div>
            <?php
            } else if ($user->getDetail($session_id, "verification_status") == "Verified") {
                echo "<div style='width:80%;padding:50px 20px;margin:auto;background:white;box-shadow:1px 2px 5px rgba(0, 0, 0, 0.1);border-radius:5px;'>
                         <div style='width:100%;text-align:center;margin-bottom:30px;'>
                            <i class='fa fa-check-circle' style='font-size:100px;color:#33cca8;'></i>
                         </div>
                          <p style='width:100%;text-align:center;color:grey;'>
                            Your account has been Verified!
                          </p>
                         <div style='width:100%;text-align:center;margin-top:50px;'>
                           <a href='./' style='padding:10px;background:#33cca8;color:white;border-radius:5px;'>Go to my account</a>
                         </div>
                      </div>";
            } else if ($user->getDetail($session_id, "verification_status") == "Pending") {
                echo "<div style='width:80%;padding:50px 20px;margin:auto;background:white;box-shadow:1px 2px 5px rgba(0, 0, 0, 0.1);border-radius:5px;'>
                         <div style='width:100%;text-align:center;margin-bottom:30px;'>
                            <i class='fa fa-download' style='font-size:100px;color:#ffc700;'></i>
                         </div>
                          <p style='width:100%;text-align:center;color:grey;'>
                            Your request has been submitted and is pending verification from our team!
                          </p>
                        <div style='width:100%;text-align:center;margin-top:50px;'>
                           <a href='./' style='padding:10px;background:#ffc700;color:white;border-radius:5px;'>Go to my account</a>
                         </div>
                      </div>";
            }
            ?>
        </div>

        <!-- </div>

        </div> -->

    </section>

    <script src="../assets/js/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/account.js"></script>

    <script>
        // const inpFile = document.getElementById("inpFile");
        // const previewContainer = document.getElementById("imagePreview");
        // const previewImage = previewContainer.querySelector(".image-preview__image");



        // inpFile.addEventListener("change", function() {
        //     const file = this.files[0];


        //     if (file) {
        //         const reader = new FileReader();


        //         previewImage.style.display = "block";

        //         reader.addEventListener("load", function() {
        //             previewImage.setAttribute("src", this.result);
        //         });

        //         reader.readAsDataURL(file);
        //     } else {

        //         previewImage.style.display = null;
        //         previewImage.setAttribute("src", "");

        //     }
        // });


        var images = [];
        // const uploadBtn = document.getElementById("upload-btn");
        const input = document.getElementById("inpFile");
        const image_preview_container = document.getElementById("image-preview-container");


        // to make the button trigger the input file
        // uploadBtn.addEventListener("click", (e) => {
        //     document.querySelector('#input').click();
        // });


        input.addEventListener("change", () => {
            const files = input.files;
            const file = files[0];



            var data = new FormData();
            data.append('file', file);

            var imgname = input.value;
            var size = input.files[0].size;

            var ext = imgname.substr((imgname.lastIndexOf('.') + 1));
            if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG') {
                if (size <= 1000000) {
                    $.ajax({
                        url: "ajax-upload-verification-image.php",
                        type: "POST",
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false, // tell jQuery not to process the data
                        contentType: false // tell jQuery not to set contentType
                    }).success(function(data) {
                        var data = JSON.parse(data)

                        if (data.status == "FILE_SIZE_ERROR") {
                            alert("File size too big!");
                        } else if (data.status == "FILE_TYPE_ERROR") {
                            alert(`Invalid file type. Kindly upload: 'jpeg', 'jpg', 'png', 'PNG', 'JPEG' OR 'JPG'`);
                        } else if (data.status == "success") {
                            var src = data.id + "." + data.ext;
                            var image_preview = document.createElement("div");
                            image_preview.classList.add("image-preview")
                            image_preview.classList.add(`image-preview${data.id}`)

                            // const src = URL.createObjectURL(file);
                            images.push(src)

                            var img = document.createElement("img");
                            img.classList.add("image-preview__image")
                            img.src = `../verification-images/` + src;

                            var delete_btn = document.createElement("span");
                            delete_btn.classList.add("delete-btn");
                            delete_btn.innerHTML = "x";
                            delete_btn.setAttribute("onclick", "deleteImage(this)")
                            delete_btn.setAttribute("image_id", data.id)
                            delete_btn.setAttribute("image_ext", data.ext)

                            image_preview.appendChild(img)
                            image_preview.appendChild(delete_btn);

                            image_preview_container.appendChild(image_preview);

                            addToImagesField(images)
                        }
                    })
                }
            }




        });


        function deleteImage(e) {
            var image_id = e.getAttribute("image_id");
            var image_ext = e.getAttribute("image_ext");
            var image = image_id + "." + image_ext;

            for (var i = 0; i < images.length; i++) {
                if (images[i] == image) {
                    images.splice(i, 1);
                    $(`.image-preview${image_id}`).css("display", "none");
                }
            }
            addToImagesField(images);

        }

        function addToImagesField(images) {
            let imgs = "";
            if (images.length > 0) {
                imgs = JSON.stringify(images);
            }
            $(".images").val(imgs)
        }


        function validateForm() {
            if ($(".images").val() == "") {
                alert("You must add at least one image!")
                return false;
            } else {
                return true;
            }
        }
    </script>
</body>

</html>