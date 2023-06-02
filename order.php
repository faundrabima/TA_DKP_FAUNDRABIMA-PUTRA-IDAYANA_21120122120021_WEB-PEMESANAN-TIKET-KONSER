<?php

    class ConcertTicketOrder
    {
        private $vipSeats = array();
        private $regularSeats = array();
        private $bookedSeats = array();

        public function __construct()
        {
            $this->initializeSeats();
            $this->processOrder();
        }

        private function initializeSeats()
        {
            for ($i = 1; $i <= 10; $i++) {
                $this->vipSeats[$i] = 100;
                $this->regularSeats[$i] = 50;
            }

            // Predefined booked seats
            $this->bookedSeats = array(1, 2, 4);
        }

        private function processOrder()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['seat']) && isset($_POST['ticket_type'])) {
                    $selectedSeat = $_POST['seat'];
                    $ticketType = $_POST['ticket_type'];

                    if ($this->isSeatAvailable($selectedSeat)) {
                        $this->bookSeat($selectedSeat);
                        $this->redirectToPaymentPage($selectedSeat, $ticketType);
                    } else {
                        echo "Sorry, the selected seat is not available. Please choose another seat.";
                    }
                }
            }
        }

        private function isSeatAvailable($seatNumber) {
            return !in_array($seatNumber, $this->bookedSeats);
        }

        private function bookSeat($seatNumber) {
            $this->bookedSeats[] = $seatNumber;
        }

        private function redirectToPaymentPage($selectedSeat, $ticketType) {
            $seatPrice = ($ticketType === 'VIP') ? $this->vipSeats[$selectedSeat] : $this->regularSeats[$selectedSeat];
            $totalPrice = $seatPrice;

            // Store selected seat and total price in session for payment page
            session_start();
            $_SESSION['selected_seat'] = $selectedSeat;
            $_SESSION['ticket_type'] = $ticketType;
            $_SESSION['total_price'] = $totalPrice;

            header("Location: payment.php");
            exit;
        }

        public function displaySeatSelectionForm() {
            echo '<form method="POST" action="">';

            echo '<label for="ticket_type" style="font-weight: bold;">Select ticket type : </label>';
            echo '<input type="radio" name="ticket_type" value="VIP" style="margin-right: 5px;"> VIP ';
            echo '<input type="radio" name="ticket_type" value="Reguler" style="margin-right: 5px;"> Regular';
            
            echo '<br><br>';

            
            echo '<label for="seat" style="font-weight: bold;">Select a seat : </label>';
            echo '<select name="seat" id="seat" style="padding: 5px; border: 1px solid #ccc;">';
                for ($i = 1; $i <= 10; $i++) {

                    if ($this->isSeatAvailable($i)) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    } 
                    
                    else {
                        echo '<option value="' . $i . '" disabled>' . $i . ' (Booked)</option>';
                    }
                    }
            echo '</select>';

            echo '<br><br>';

            echo '<input type="submit" value="Book Tickets" id="tombols">';
            echo '</form>';

        }

        public function displayBookedSeats() {
            echo '<h3>Booked Seats:</h3>';
            echo '<ul>';
            foreach ($this->bookedSeats as $seat) {
                echo '<li>' . $seat . '</li>';
            }
            echo '</ul>';
        }

    }

        // Create an instance of ConcertTicketOrder
        $ticketOrder = new ConcertTicketOrder();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Concert Ticket Order</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

    <nav>
        <ul>
          <li><a href="yeslogin.php">My Account</a></li>
          <li><a href="concertinfo.php">Concert Info</a></li>
          <li><a href="help.html">Help</a></li>
        </ul>
    </nav>

    <div class="corder">
        <img src="./img/shop1.png" alt="" width="50px">
        <h2 id="corder">Concert Ticket Order</h2>

        <h3>Please Choose Your Ticket Type <br> And Seat Number</h3>
        
        <?php $ticketOrder->displaySeatSelectionForm(); ?>

        <br>
    </div>

</body>
</html>
