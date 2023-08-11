<?php
session_start();

include 'classes/database.class.php';
include 'classes/admin.class.php';
include 'classes/users.class.php';
include 'classes/items.class.php';


if (isset($_POST['save_item'])) {
    $item_id = mysqli_real_escape_string($db->conn, $_POST['item_id']);
    $session_id = $_SESSION['user_id'];

    if (!$user->haveSavedItem($item_id, $session_id)) {
        $user->saveItem($item_id, $session_id);
        echo "Saved";
    } else {
        $result = $db->setQuery("DELETE FROM saved_items WHERE item_id='$item_id' AND user_id='$session_id';");
        echo "unSaved";
    }
}
