<?php
	$IDtype = "OBTX";
    $m = date('m');
    $y = date('y');
    $d = date('d');

    $qry = mysqli_query($link,"SELECT MAX(id) FROM `outboundtb` "); // Get the latest ID
    $resulta = mysqli_fetch_array($qry);
    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
    $custID = str_pad($newID, 8, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
    $obtxid = $IDtype.$custID; //Prepare custom ID

?>