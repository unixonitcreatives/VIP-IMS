<?php

require_once '../config.php';

$sql = "SELECT model_id, model FROM product_model ORDER BY type, model asc";
$result = $link->query($sql);

$data = $result->fetch_all();

$link->close();

echo json_encode($data);

?>
