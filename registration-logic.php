<?php

require_once ('files/functions.php');

$email = trim($_POST['email']);

// to check if a user of the same email already exists

$password = trim($_POST['password']);
$password_1 = trim($_POST['password_1']);
$phone_number = trim($_POST['phone_number']);
$last_name = trim($_POST['last_name']);
$first_name = trim($_POST['first_name']);


$sql = "SELECT * FROM users WHERE email = '{$email}'";
$res = $conn->query($sql);


if($password != $password_1){
    alert('danger', 'Passwords did not match.');
    header('Location:login.php');
    die();
}


if ($res->num_rows > 1){
    alert('danger', 'user with same email already exists.');
    header('Location:login.php');
    die();
}

//to prevent hackers
$password = password_hash($password, PASSWORD_DEFAULT);



//logic for adding the user into the data base.
$sql = "INSERT INTO users(
    first_name,
    last_name,
    phone_number,
    password,
    email,
    user_type

) VALUES (
    '{$first_name}',
    '{$last_name}',
    '{$phone_number}',
    '{$password}',
    '{$email}',
    'customer'
)";

//surround the sql with if condition and run the sql
//when user logins successfully, redirect them to their dashboard

if($conn->query($sql)){
  login_user($email,$password);
  alert('success', 'Account created successfully.');
  header('Location: account-orders.php');

}else {
    alert('danger', 'Failed to create account.');
    header('Location:login.php');
    die();
}


