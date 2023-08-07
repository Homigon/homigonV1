<?php

class User
{
    public $user_id;




    public function createReferralCode()
    {
        $alph = str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $nums = str_shuffle("12345678901234567890");
        if (strlen($alph) > 3) {
            $cutalph = substr($alph, 0, 3);

            $alph = $cutalph;
        }

        if (strlen($nums) > 3) {
            $cutnums = substr($nums, 0, 3);

            $nums = $cutnums;
        }

        $result = $alph . $nums;
        $final_result = str_shuffle($result);
        return  $final_result;
    }

    public function createUser($user_id, $user_type, $firstname, $lastname, $email, $phone, $password, $is_owner_or_agent)
    {
        global $db;

        $password = password_hash($password, PASSWORD_DEFAULT);
        $image = "default.svg";
        $status = "Active";
        $time = time();
        $time_created = date("M,d,Y h:i A");
        $date = date("d-m-y");

        $result = $db->setQuery("INSERT INTO users (user_id, user_type, firstname, lastname, email, phone, password, image, is_owner_or_agent, status, time, date, time_created) VALUES ('$user_id', '$user_type', '$firstname', '$lastname', '$email', '$phone', '$password', '$image', '$is_owner_or_agent', '$status', '$time', '$date', '$time_created');");
        return $result;
    }


    public function getDetail($user_id, $detail)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM users WHERE user_id='$user_id';");
        $row = mysqli_fetch_assoc($result);
        $detail = $row[$detail];

        return $detail;
    }


    public function setDetail($user_id, $field, $detail)
    {
        global $db;

        $result = $db->setQuery("UPDATE users SET $field='$detail' WHERE user_id='$user_id';");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function updateDetail($user_id, $detail, $value, $op)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM users WHERE user_id='$user_id';");
        $row = mysqli_fetch_assoc($result);
        $old_value = $row[$detail];

        if ($op == "+") {
            $new_value = $old_value + $value;
        } else if ($op == "-") {
            $new_value = $old_value - $value;
        }

        $result1 = $db->setQuery("UPDATE users SET $detail='$new_value' WHERE user_id='$user_id';");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function userIdExists($user_id)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM users WHERE user_id='$user_id';");
        $numrows = mysqli_num_rows($result);

        if ($numrows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isAgent($user_id)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM users WHERE user_id='$user_id' AND user_type='Agent';");
        $numrows = mysqli_num_rows($result);

        if ($numrows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function userEmailExists($email)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM users WHERE email='$email';");
        $numrows = mysqli_num_rows($result);

        if ($numrows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function sendVerificationRequest($user_id, $image1, $image2)
    {
        global $db;
        $status = "Pending";
        $time = time();
        $time_created = date("d-m-y");

        $result = $db->setQuery("INSERT INTO verification_requests (user_id, image1, image2, status, time, time_created) VALUES ('$user_id', '$image1', '$image2', '$status', '$time', '$time_created');");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }





    public function referralCodeIsValid($referral_code)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM users WHERE referral_code='$referral_code';");
        $numrows = mysqli_num_rows($result);

        if ($numrows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hasReferredSomeone($user_id)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM referrals WHERE referrer_id='$user_id';");
        $numrows = mysqli_num_rows($result);

        if ($numrows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function wasReferred($user_id)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM referrals WHERE referred_id='$user_id';");
        $numrows = mysqli_num_rows($result);

        if ($numrows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getReferrerId($referred_id)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM referrals WHERE referred_id='$referred_id';");
        $row = mysqli_fetch_assoc($result);

        return $row['referrer_id'];
    }

    public function getReferredId($referrer_id)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM referrals WHERE referrer_id='$referrer_id';");
        $row = mysqli_fetch_assoc($result);

        return $row['referred_id'];
    }




    public function getReferralIdFromReferralCode($referral_code)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM users WHERE referral_code='$referral_code';");
        $row = mysqli_fetch_assoc($result);

        return $row['user_id'];
    }



    public function addReferral($referrer_id, $referred_id)
    {
        global $db;

        $result = $db->setQuery("INSERT INTO referrals (referrer_id, referred_id) VALUES ('$referrer_id', '$referred_id')");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

$user = new User();
