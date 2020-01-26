<?php

require_once '../config.php';

$sql = "SELECT model_id, model FROM `product_model` WHERE type = 'retail' ORDER BY model_id DESC";
$result = $link->query($sql);

$data = $result->fetch_all();

$link->close();

echo json_encode($data);

?>
