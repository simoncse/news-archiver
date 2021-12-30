<?php
    // just testing
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $to = "simonkmc10@gmail.com";
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality.";
    mail($to,$subject,$message);
    echo "Test email sent\n.";
?>