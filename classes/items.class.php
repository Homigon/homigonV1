<?php

class Item
{
    function createItemCode()
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

    public function createItem($item_id, $user_id, $category, $item_type, $title, $location, $item_condition, $nearest_bustop, $number_of_rooms, $amenities, $number_of_toilets, $price, $number_of_bathrooms, $additional_information, $images)
    {
        global $db;

        $status = "Inactive";
        $time = time();
        $time_created = date("M,d,Y h:i A");
        $date = date("d-m-y");

        $result = $db->setQuery("INSERT INTO items (item_id, user_id, category, item_type, title, location, item_condition, nearest_bustop, number_of_rooms, amenities, number_of_toilets, price, number_of_bathrooms, additional_information, images, status, time, date, time_created) VALUES ('$item_id', '$user_id', '$category', '$item_type', '$title', '$location', '$item_condition', '$nearest_bustop', '$number_of_rooms', '$amenities', '$number_of_toilets', '$price', '$number_of_bathrooms', '$additional_information', '$images', '$status', '$time', '$date', '$time_created');");
        return $result;
    }


    public function getDetail($item_id, $detail)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM items WHERE item_id='$item_id';");
        $row = mysqli_fetch_assoc($result);
        $detail = $row[$detail];

        return $detail;
    }


    public function setDetail($item_id, $field, $detail)
    {
        global $db;

        $result = $db->setQuery("UPDATE items SET $field='$detail' WHERE item_id='$item_id';");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function updateDetail($item_id, $detail, $value, $op)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM items WHERE item_id='$item_id';");
        $row = mysqli_fetch_assoc($result);
        $old_value = $row[$detail];

        if ($op == "+") {
            $new_value = $old_value + $value;
        } else if ($op == "-") {
            $new_value = $old_value - $value;
        }

        $result1 = $db->setQuery("UPDATE items SET $detail='$new_value' WHERE item_id='$item_id';");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function itemIdExists($item_id)
    {
        global $db;

        $result = $db->setQuery("SELECT * FROM items WHERE item_id='$item_id';");
        $numrows = mysqli_num_rows($result);

        if ($numrows > 0) {
            return true;
        } else {
            return false;
        }
    }
}

$item = new Item();
