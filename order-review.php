<?php session_start();

$order_list                     = $_SESSION['order_list'];
$order_total                    = $_SESSION['order_total'];
// $_SESSION['$order_list']        = $order_list; 
// $_SESSION['order_total']        = $order_total; 
$_SESSION['shipping_details']   = $_POST;

include 'includes/header.php';


?>

<div class="card-wrapper">
  <div class="card card-display card-cart">
    <div class="card-body">
        <h1 class="card-title text-center">Min Order</h1>
            <?php foreach($order_list as $key => $value) { ?>
                <ol class="list-group list-group-flush">
                    <li class="list-group-item"><h5><?php echo $value["name"] ?>:</h5>
                        <ul>
                            <li class="list-group-item">Pris: <?php echo $value["price"] ?> st</li>
                            <li class="list-group-item">Antal: <?php echo $value["quantity"] ?></li>
                            <li class="list-group-item">Summa: <?php echo $value["total_price"] ?></li>
                        </ul>
                    </li>
                </ol>
            <?php } ?>
    </div>
    
    
    <ol  class="text-right">
        <li id="order-total" class="text-muted list-group-item ">
           Summa Order: <?php echo $order_total; ?> kr
        </li>
    </ol>
    <div class="card-body">
        <h4 class="card-title">Leveransadress</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Förnamn: <span class"text-right"><?php echo $_POST["first_name"] ?></span></li>
            <li class="list-group-item">Efternamn: <span class"push-right"><?php echo $_POST["last_name"] ?></span></li>
            <li class="list-group-item">Email: <span class"push-right"><?php echo $_POST["email"] ?></span></li>
            <li class="list-group-item">Adress: <span class"push-right"><?php echo $_POST["adress"] ?></span></li>
            <li class="list-group-item">Postnummer: <span class"push-right"><?php echo $_POST["zip"] ?></span></li>
            <li class="list-group-item">Postort: <span class"push-right"><?php echo $_POST["city_state"] ?></span></li>
            <li class="list-group-item">Land: <span class"push-right"><?php echo $_POST["country"] ?></span></li>
        </ul>
    </div>
    <a href="complete.php" class="btn btn-success btn-lg">SKICKA ORDER</a>
  </div>
</div>



