<?php

    class PaymentPage
    {
        private $selectedSeat;
        private $ticketType;
        private $totalPrice;
        
        public function __construct()
        {
            session_start();

            if (isset($_SESSION['selected_seat']) && isset($_SESSION['ticket_type']) && isset($_SESSION['total_price'])) {
                $this->selectedSeat = $_SESSION['selected_seat'];
                $this->ticketType = $_SESSION['ticket_type'];
                $this->totalPrice = $_SESSION['total_price'];
                
                
            } else {
                // Redirect back to seat selection page if session data is not available
                header("Location: order.php");
                exit;
            }
        }

        public function displayPaymentForm()
        {
            $tax = $this->totalPrice * 0.1; // Calculating 10% tax
            $totalPriceWithTax = $this->totalPrice + $tax;
            echo '<h2>Payment Page</h2>';
            echo '<hr id="garishelp">';
            echo '<h3 id="payword">Selected Ticket:</h3>';
            echo '<p id="payword">Ticket Type : ' . ucfirst($this->ticketType) . '</p>';
            echo '<p id="payword">Seat Number : ' . $this->selectedSeat . '</p>';
        
            echo '<hr>';
            echo '<h3 id="payword">Total Price</h3>';
            echo '<p id="payword">$' . $totalPriceWithTax.' (Tax Inlcuded)</p>';
            echo '<hr>';
            echo '<h3>Payment Method:</h3>';

            // echo '<form method="POST" action="">';
            // echo '<input type="radio" name="payment_method" value="paypal"> PayPal';
            // echo '<br>';
            // echo '<input type="radio" name="payment_method" value="debit_card"> Debit Card';
            // echo '<br><br>';
            // echo '<input type="submit" value="Proceed to Payment">';

            echo '<form method="POST" action="paidticket.php" required>';
            echo '<input type="hidden" name="seat" value="' . $this->selectedSeat . '">';
            echo '<input type="hidden" name="ticket_type" value="' . $this->ticketType . '">';
            echo '<input type="hidden" name="payment_method" value="">';
            echo '<input type="radio" name="payment_method" value="PayPal"> PayPal';
            echo '<br>';
            echo '<input type="radio" name="payment_method" value="Debit Card"> Debit Card';
            echo '<br><br>';
            echo '<input id="tombols" type="submit" value="Proceed to Payment">';
            echo '</form>';




            echo '</form>';

            
        
        
            echo '<br>';
        

        
        }

        private function processPayment()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['payment_method'])) {
                    $paymentMethod = $_POST['payment_method'];

                    // Process the payment based on the selected method
                    // Add your payment processing code here

                    // Clear session data after payment is processed
                    $this->clearSessionData();

                    echo '<h2>Payment Successful!</h2>';
                    echo '<p>Thank you for your purchase.</p>';
                }
            }
        }

        private function clearSessionData()
        {
            unset($_SESSION['selected_seat']);
            unset($_SESSION['ticket_type']);
            unset($_SESSION['total_price']);
        }

        public function handlePayment()
        {
            $this->processPayment();
        }
    }

    // Create an instance of PaymentPage
    $paymentPage = new PaymentPage();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <nav>
        <ul>
          <li><a href="yeslogin.php">My Account</a></li>
          <li><a href="concertinfo.php">Concert Info</a></li>
          <li><a href="help.html">Help</a></li>
        </ul>
    </nav>

    <div class="paytext">
        <img src="./img/pay.png" alt="Bayaren" width="50px">
        <?php $paymentPage->displayPaymentForm(); ?>
        <?php $paymentPage->handlePayment(); ?>    
    </div>

</body>
</html>
