<?php
// Start the session
session_start();

// database credentials
$host = 'localhost';
$dbname = 'mini';
$user = 'root';
$password = '';

// establish database connection
$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
  die("<script>alert('Failed to connect to database: " . mysqli_connect_error() . "');</script>");
}

// handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // check if the email and password match a user in the database
  $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE u_email = ? AND u_pwd = ?");
  mysqli_stmt_bind_param($stmt, "ss", $email, $password);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);
  
  if ($user && $user['u_role'] == 'Agent') {
    // set the user's information in the session
    $_SESSION['user'] = array(
      'id' => $user['u_id'],
      'email' => $user['u_email'],
      'role' => $user['u_role']
    );
    
    // redirect to ADcreateListing.html if the user is an agent
    header('Location: ADcreateListing.html');
    exit;
  } else if ($user && $user['u_role'] == 'Buyer') {
    // set the user's information in the session
    $_SESSION['user'] = array(
      'id' => $user['u_id'],
      'email' => $user['u_email'],
      'role' => $user['u_role']
    );
    
    // redirect to home.html if the user is a customer
    header('Location: home.html');
    exit;
  } else {
    // display an error message in an alert box if the email and password are incorrect
    echo "<script>alert('Invalid email or password');</script>";
  }
}