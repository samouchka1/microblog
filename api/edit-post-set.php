<?php

// session_start();

require "../config.php";

$input_data = json_decode(file_get_contents('php://input'));
$form_bool = $input_data->form_bool;

if(empty($form_bool) || $form_bool != 'true'){
    echo json_encode(array('success' => false, 'message' => 'value is empty or incorrect'));
} else {
    $stmt = $mysqli->prepare("INSERT INTO posts (set_edit) VALUES (?)");
    $stmt->bind_param("s", $form_bool);
    $stmt->execute();
    echo json_encode(array('success' => true));
}

$mysqli->close();

?>