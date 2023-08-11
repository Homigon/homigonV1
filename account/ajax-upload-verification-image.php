<?php
$filetype = array('jpeg', 'jpg', 'png', 'gif', 'PNG', 'JPEG', 'JPG');
foreach ($_FILES as $key) {

    // $name = time() . $key['name'];
    $id = uniqid();
    $name = $key['name'];
    $file_ext =  pathinfo($name, PATHINFO_EXTENSION);

    $path = '../verification-images/' . $id . "." . $file_ext;

    if (in_array(strtolower($file_ext), $filetype)) {
        if ($key['name'] < 1000000) {

            @move_uploaded_file($key['tmp_name'], $path);
            $data = array("status" => "success", "id" => $id, "ext" => $file_ext);
            echo json_encode($data);
        } else {
            // echo "FILE_SIZE_ERROR";
            $data = array("status" => "FILE_SIZE_ERROR");
            echo json_encode($data);
        }
    } else {
        // echo "FILE_TYPE_ERROR";
        $data = array("status" => "FILE_TYPE_ERROR");
        echo json_encode($data);
    }
}
