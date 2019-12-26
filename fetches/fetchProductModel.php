<?php

require_once '../config.php';

$sql = "SELECT custID, description FROM `product-model` ORDER BY custID asc";
$result = $link->query($sql);

$data = $result->fetch_all();

$link->close();

echo json_encode($data);

?>
