<?php
    if($Admin_auth && $_SESSION["usertype"] == "Admin"){

    }
    else if($Stock_auth && $_SESSION["usertype"] == "Stock Officer"){

    }
    else if($Area_Center_auth && $_SESSION["usertype"] == "Area Center"){

    }
    else {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('You have no privilege to access this page. Returning to dashboard.');
    window.location.href='index.php';
    </script>"); exit;
    }
?>