<?php

class Admin
{

    public $admin_id = 1;

    public $website_name = "Homigon";
    public $website_url = "https://homigon.com";
    public $website_url_e = "homigon.com";

    public $wallet_core_private = "";
    public $wallet_core_public = "";
    public $wallet_core_ipn = "";
    public $wallet_core_ipn_url = "";

    public function createAdmin($username, $password)
    {

        global $db;

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $result = $db->setQuery("INSERT INTO admin (username, password) VALUES ('$username', '$password');");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function getDetail($admin_id, $detail)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM admin WHERE id='$admin_id';");
        $row = mysqli_fetch_assoc($result);
        $detail = $row[$detail];

        return $detail;
    }


    public function setDetail($admin_id, $field, $detail)
    {
        global $db;

        $result = $db->setQuery("UPDATE admin SET $field='$detail' WHERE id='$admin_id';");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function updateDetail($admin_id, $detail, $value, $op)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM admin WHERE id='$admin_id';");
        $row = mysqli_fetch_assoc($result);
        $old_value = $row[$detail];

        if ($op == "+") {
            $new_value = $old_value + $value;
        } else if ($op == "-") {
            $new_value = $old_value - $value;
        }

        $result1 = $db->setQuery("UPDATE admin SET $detail='$new_value' WHERE id='$admin_id';");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }



    public function goTo($page, $parameter)
    {
        echo '<script>
          window.location.href="' . $page . '?' . $parameter . '";
         </script>';
    }


    public function createPasswordRecoveryKey($user_id)
    {
        global $db;

        $key_id = uniqid();

        $db->setQuery("INSERT INTO password_recovery_keys (user_id, key_id) VALUES ('$user_id', '$key_id')");

        return $key_id;
    }

    public function passwordRecoveryKeyIsValid($key_id)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM password_recovery_keys WHERE key_id='$key_id';");
        $numrows = mysqli_num_rows($result);

        if ($numrows != 0) {
            return true;
        } else {
            return false;
        }
    }




    public function getRecaptchaCodes()
    {
        $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $rotations = [-43, 14, 3, 18, 7, -23, 5, 90, 2, 6];
        $code = [];
        for ($i = 0; $i < 6; $i++) {
            $rand = RAND(0, count($numbers) - 1);
            $code[count($code)] = array("number" => $numbers[$rand], "rotation" => $rotations[$rand]);
        }

        return $code;
        // $rand = RAND(0, count($numbers));
        // return $rand;
    }


    public function validatePasswordResetKey($key_id, $email)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM password_reset_keys WHERE key_id='$key_id' AND email='$email';");
        $numrows = mysqli_num_rows($result);

        if ($numrows > 0) {
            return true;
        } else {
            return false;
        }
    }




    public function formatWhatsappPhone($phone)
    {

        $number = "";
        $p = str_split($phone);
        foreach ($p as $char) {
            if ($char != "+" and $char != " " and $char != "(" and $char != ")") {
                $number .= $char;
            }
        }

        return $number;
    }

    public function getCategories()
    {
        global $db;

        $array = [];
        $result = $db->setQuery("SELECT * FROM categories;");
        $numrows = mysqli_num_rows($result);

        if ($numrows != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $array[count($array)] = $row['name'];
            }
        }

        return $array;
    }

    public function getTypes()
    {
        global $db;

        $array = [];
        $result = $db->setQuery("SELECT * FROM types;");
        $numrows = mysqli_num_rows($result);

        if ($numrows != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $array[count($array)] = $row['name'];
            }
        }

        return $array;
    }
}


$admin = new Admin();
