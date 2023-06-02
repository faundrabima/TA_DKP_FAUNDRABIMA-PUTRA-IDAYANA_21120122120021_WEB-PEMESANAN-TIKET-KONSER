<?php

  session_start();

    class User {
      private $username;
      private $password;
      private $loginAttempts;
       

        public function __construct($username, $password) {
          $this->username = $username;
          $this->password = $password;
          $this->loginAttempts = 0;
        }

        public function getUsername() {
          return $this->username;
        }

        public function getPassword() {
          return $this->password;
        }

        public function getLoginAttempts() {
          return $this->loginAttempts;
        }
    
        public function incrementLoginAttempts() {
          $this->loginAttempts++;
        }
  } 

  $users = [
    new User('hildan@gmail.com', '29'),
    new User('faun@gmail.com', '01', )
  ];


  function blockAccount() {
    echo '<script> alert ("Sorry, Your Account is Blocked, Try to call our Customer Service.") ; window.location.href = "help.html" ; </script>';
    exit();
  }

  function login($username, $password) {
    global $users;

    foreach ($users as $user) {
        if ($user->getUsername() === $username && $user->getPassword() === $password) {
            $_SESSION['username'] = $username;
            $_SESSION['loginAttempts'] = 0;
            header("Location: yeslogin.php");
            exit();
        }
    }

    $_SESSION['loginAttempts']++;

    if ($_SESSION['loginAttempts'] === 3) {
        blockAccount();
    }

    echo '<script> alert ("Invalid email or password.") ; </script>';

  }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';

      login($username, $password);
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TIKET KONSER AM</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Arvo?">
  </head>
  <body>

    <div class="hawal">

      <nav>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="help.html">Help</a></li>
          </ul>
      </nav>

        <div class="midform" >
            <br>
            <br>
            <!-- DIBAWAH INI FORM  -->
          <form action="login.php" method="POST" >
            <center>  <img id="ilog" src="./img/user.png" alt="loginimg" width="50px"> </center>
            <center>  <p id="sapa_atas">Login</p></center>
                      <input class="input" type="text" name="username" placeholder="Email address" width="1024 px" required/> <br />
                      <input class="input" type="password" name="password" placeholder="password" required /> <br />
            <br>
                      <input id="submitawal" type="submit" value="Login" name="login" />
          
          </form>
        </div>
    </div>
  </body>
</html>
