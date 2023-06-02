<?php
  session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
  
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Succes</title>
    <link rel="stylesheet" href="style.css"/>
  </head>
    <body>

      <nav>
            <ul>
              <li><a href="login.php">Logout</a></li>
              <li><a href="concertinfo.php">Concert Info</a></li>
              <li><a href="help.html">Help</a></li>
            </ul>
      </nav>

      <div class="sapasukses">
          <img src="./img/logsucces.png" alt="succeslogin" id="logsucces">
          <h2>Welcome, <?php echo $username; ?>!</h2>
          <h3>You have successfully logged in.</h3>
      </div>


      <div class="con_selectbt">
      <form action="order.php">
        <input id="selectseat_bt" type="submit" value="ORDER A TICKET">
      </form>
      </div>    

    </body>
  </html>