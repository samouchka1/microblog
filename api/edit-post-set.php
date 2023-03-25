<?php

require "../config.php";

$input_data = json_decode(file_get_contents('php://input'));
$form_bool = $input_data->form_bool;
$post_id = $input_data->post_id;

if(empty($form_bool) || $form_bool != 'true'){
    echo json_encode(array('success' => false, 'message' => 'value is empty or incorrect'));
} else {
    $stmt = $mysqli->prepare("UPDATE posts SET set_edit = ? WHERE ?");
    $stmt->bind_param("si", $form_bool, $post_id);
    $stmt->execute();
    echo json_encode(array('success' => true));
}

$mysqli->close();

?>