<?php

require_once ('files/functions.php');

$email = trim($_POST['email']);

$password = trim($_POST['password']);


//surround the sql with if condition and run the sql
//when user logins successfully, redirect them to their dashboard

if (login_user($email,$password)){
    alert('success', 'Account logged  in successfully.');
    header('Location:account-orders.php');
    die();
} else{    
    alert('danger', 'You entered a wrong user name or password.');
    header('Location:login.php');
}
 