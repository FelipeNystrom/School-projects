<?php session_start();



include 'includes/header.php';


require 'config.php';


// Mail config vars:

// an email address that will be in the From field of the email.
$from_email = $_SESSION["shipping_details"]["email"];

// Full name of sender 
$from_name = ucwords($_SESSION["shipping_details"]["first_name"] . ' ' . $_SESSION["shipping_details"]["last_name"]);

// The email address that will receive the email with the output of the form. Gets email variable from config-file config.php
$to = $email;

// subject of the email
$subject = 'You have a new order from ' .$from_name;

// form field names and their translations.
// array variable name => Text to appear in the email
$shipping_details = array('first_name' => 'Name', 'last_name' => 'Surname', 'email' => 'Email', 'adress' => 'Adress', 'zip' => 'Zip', 'city_state' => 'City', 'country' => 'Country'); 

$order_details = array('name' => 'Name', 'price' => 'Price', 'quantity' => 'Quantity', 'total_price' => 'Total Price');


// message that will be displayed when everything is OK :)
$okMessage = 'Tack! <br> Vi har nu tagit emot din order';

// If something goes wrong, we will display this message.
$errorMessage = 'Vi är ledsna! <br> Något har hänt medan din order skickades. Vänligen försök igen!';

try
{

    if(count($_SESSION["shipping_details"]) && count($_SESSION["order_list"]) == 0) throw new \Exception('Missing Information!');
            
    $order_info     = $from_name . "have made a new order: \n=============================\n";
    $shipping_info  = "Shipping information to " . $from_name . ": \n=============================\n";

    foreach ($_SESSION["order_list"][0] as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($order_details[$key])) {
            $order_info .= "$order_details[$key]: $value\n";
        }
    }

    foreach ($_SESSION["shipping_details"] as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($shipping_details[$key])) {
            $shipping_info .= "$shipping_details[$key]: $value\n";
        }
    }

    $emailText      = "$order_info . '\n=============================\n' . $shipping_info";

    // All the neccessary headers for the email.
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from_email,
        'Reply-To: ' . $from_email,
        'Return-Path: ' . $from_email,
    );
    
    // Send email
    mail($to, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);

    foreach($_SESSION as $key => $value){
        unset($_SESSION[$key]);
    }
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else { ?>
    <div class="card-wrapper">
    <div class="card card-display card-cart" style="border: none;">
        <div class="card-body" style="padding: auto 2rem;">
            <?php if($responseArray["type"] == "success") {
                    echo '<div class="alert alert-success text-center muted" role="alert" style="min-height: 3rem; padding-top: auto; font-size: 1.5rem;">'
                                . $responseArray["message"] .
                        '</div>';
                    } else {
                        echo '<div class="alert alert-danger text-center muted" role="alert" style="min-height: 3rem; padding-top: auto; font-size: 1.5rem;">'
                                . $responseArray["message"] .
                        '</div>';
                    }
                        ?>
        </div>
    </div>
</div>

<?php }

echo '<script>setTimeout(function(){this.location = "index.php"}, 3000);</script>';
 
include 'includes/footer.php';

?>
