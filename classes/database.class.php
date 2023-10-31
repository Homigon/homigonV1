<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Database
{


    public $dbservername = 'localhost';

    public $dbusername = 'root';

    public $dbpassword = '';

    public $dbname = 'homigon';

    public $conn;

    public $sql;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->dbservername, $this->dbusername, $this->dbpassword, $this->dbname);
    }

    public function setQuery($query)
    {
        $this->sql = $query;
        $result = mysqli_query($this->conn, $this->sql);
        return $result;
    }





    public function format_time($time)
    {

        $time = time() - $time;

        if ($time >= 0 and $time < 60) {
            $t = round($time);
            if ($t == 1) {
                return array("time" => $t, "time_frame" => "second", "suffix" => "s");
            } else {
                return array("time" => $t, "time_frame" => "seconds",  "suffix" => "s");
            }
        } else if ($time >= 60 and $time < 3600) {
            $t = round($time / 60);
            if ($t == 1) {
                return array("time" => $t, "time_frame" => "minute", "suffix" => "min");
            } else {
                return array("time" => $t, "time_frame" => "minutes",  "suffix" => "mins");
            }
        } else if ($time >= 3600 and $time < 86400) {
            $t = round($time / 3600);
            if ($t == 1) {
                return array("time" => $t, "time_frame" => "hour", "suffix" => "hr");
            } else {
                return array("time" => $t, "time_frame" => "hours",  "suffix" => "hrs");
            }
        } else if ($time >= 86400 and $time < 604800) {
            $t = round($time / 86400);
            if ($t == 1) {
                return array("time" => $t, "time_frame" => "day", "suffix" => "day");
            } else {
                return array("time" => $t, "time_frame" => "days",  "suffix" => "days");
            }
        } else if ($time >= 604800 and $time < 2419200) {
            $t = round($time / 604800);
            if ($t == 1) {
                return array("time" => $t, "time_frame" => "week", "suffix" => "wk");
            } else {
                return array("time" => $t, "time_frame" => "weeks",  "suffix" => "wks");
            }
        } else if ($time >= 2419200 and $time < 29030400) {
            $t = round($time / 2419200);
            if ($t == 1) {
                return array("time" => $t, "time_frame" => "month", "suffix" => "mth");
            } else {
                return array("time" => $t, "time_frame" => "months",  "suffix" => "mths");
            }
        } else if ($time >= 29030400 and $time < 1451520000) {
            $t = round($time / 29030400);
            if ($t == 1) {
                return array("time" => $t, "time_frame" => "year", "suffix" => "yr");
            } else {
                return array("time" => $t, "time_frame" => "years",  "suffix" => "yrs");
            }
        } else if ($time < 0) {
            return array("time" => 0, "time_frame" => "0", "suffix" => "0");
        }
    }



    // public function sendInfo($to, $subject, $message)
    // {

    //     $header = "From: Homigon support@homigon.ng \r\n";
    //     $header .= "Cc:support@homigon.ng \r\n";
    //     $header .= "MIME-Version: 1.0\r\n";
    //     $header .= "Content-type: text/html\r\n";

    //     $retval = mail($to, $subject, $message, $header);

    //     if ($retval == true) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }


    public function sendInfo($to, $subject, $message)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        // try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'homigon.ng'; //namecheap server                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'support@homigon.ng';                     //SMTP username
        $mail->Password   = 'Emmanueld45@';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('support@homigon.ng', 'Homigon');
        // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress($to);               //Name is optional
        $mail->addReplyTo('support@homigon.ng', 'support');
        $mail->addCC('support@homigon.ng');
        $mail->addBCC('support@homigon.ng');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        $msg = "<div style='positin:relative;width:100%;text-align:center;'><img src='https://homigon.ng/assets/img/new/logo.PNG' style='width:200px;height:auto;margin-bottom:15px;'/></div><br/>";
        $msg .= $message;
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $msg;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    }

    public function format_countdown_time($time)
    {

        $hours = floor($time / 3600);

        $minutes_remainder = floor($time % 3600);
        $minutes = floor($minutes_remainder / 60);

        $seconds = round($minutes_remainder % 60);

        $time_array = array(
            "hours" => $hours,
            "minutes" => $minutes,
            "seconds" => $seconds
        );

        return $time_array;
    }
}

$db = new Database();
