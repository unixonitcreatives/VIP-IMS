<?php
	$IDtype = "TRTX";
    $m = date('m');
    $y = date('y');
    $d = date('d');

    $qryID = mysqli_query($link,"SELECT MAX(id) FROM `stocks` "); // Get the latest ID
    $resulta = mysqli_fetch_array($qryID);
    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
    $custID = str_pad($newID, 8, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
    $tranxid = $IDtype.$custID; //Prepare custom ID

?>