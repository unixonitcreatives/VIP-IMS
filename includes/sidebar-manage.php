<?php

  if($_SESSION["usertype"] == "Admin"){
    include ('includes/sidebar-admin.php');
  }
  else if($_SESSION["usertype"] == "Stock Officer"){
    include ('includes/sidebar-stock-officer.php');
  }
  else {
    header('location: logout.php');
    exit;
  }

  ?>