<?php

include 'includes/header.php';

require 'config.php';


/*
 *  CONFIGURE EVERYTHING HERE
 */

// An email address that will be in the From field of the email.
$from = $_POST["email"];

// The email address that will receive the email with the output of the form. Gets email variable from config-file config.php
$sendTo = $email;

// från namn 
$from_name = ucwords($_POST["name"] . ' ' . $POST["surname"]);

// subject of the email
$subject = 'Fråga från ' . $from_name;

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message'); 

// message that will be displayed when everything is OK :)
$okMessage = 'Tack för ditt mail! Vi kommer svara på det så fort som möjligt.';

// If something goes wrong, we will display this message.
$errorMessage = 'Tyvärr hände det något när du försökte skicka mailet. <hr> Vänligen försök igen!';

/*
 *  LET'S DO THE SENDING
 */

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $emailText = "You have a new message from your contact form\n=============================\n";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    // All the neccessary headers for the email.
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    // Send email
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
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

include 'includes/footer.php'
?>