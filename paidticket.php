<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <nav>
        <ul>
          <li><a href="yeslogin.php">My Account</a></li>
          <li><a href="help.html">Help</a></li>
          <li><a href="concertinfo.php">Concert Info</a></li>
        </ul>
    </nav>

    <div class="sudahbeli">
        <br>
        <img src="./img/tss.png" alt="alhamdulillah rampung" width="70px">
        <h2>Transaction Succes! - Given Below Is Your Ticket</h2>
        <p id="yesword">Please Take A Screenshoot Of This Page, But Don't Worry, We'll Also Send Your Tickets Via E-Mail</p>
        
    </div>

    <div class="sapabeli">
        <?php

        $seat = $_POST['seat'];
        $ticketType = $_POST['ticket_type'];
        $paymentMethod = $_POST['payment_method'];

        // Generate a random 10-character ticket ID
        $ticketID = generateTicketID(10);

        // Display the seat selection, ticket type, payment method, and ticket ID
        echo '<br>';
        echo '<img src="./img/ticket.png" alt="ikitiketmu" width="70px">';
        echo '<h2>ARTIC MONKEYS WORLD TOUR 2023 #JAKARTA</h2>';
        echo '<h2>Ticket ID : #'. $ticketID . '</h2>';
        echo '<p id="tickword">Seat Number : ' . $seat . '</p>';
        echo '<p id="tickword">Ticket Type : ' . ucfirst($ticketType) . '</p>';
        echo '<p id="tickword">Payment Method : ' . $paymentMethod . '</p>';
        echo '<p>Please bring a Hard-Copy of this ticket to enter the concert.</p>';
        

        

        // Function to generate a random ticket ID
        function generateTicketID($length)
        {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $ticketID = '';

            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $ticketID .= $characters[$index];
            }

            return $ticketID;
        }
        ?>

    </div>
    <br><br><br>

    <footer>
      <div class="footer-content">
        <p class="alias">Made by: Faundrabima</p>
        <p class="email">Instagram : <a href="https://www.instagram.com/faundrab_" target="_blank"> @faundrab_ </a></p>
        <p class="message">this web is made with love</p>
        <p class="hide">Nah, i'm lying, my love is only for HILDANN</p>
        <p><a href="credit.php">&#169; credit 2023</a></p>
      </div>
    </footer>
    
</body>
</html>