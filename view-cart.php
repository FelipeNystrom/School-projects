<?php
session_start();
include "includes/header.php";

if(isset($_GET["action"])){
  if($_GET["action"] == "delete") {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($value["item_id"] == $_GET["id"]) {
        unset($_SESSION["shopping_cart"][$key]);
        echo "<script>alert('Item Removed!')</script>";
        if($_SESSION["shopping_cart"] == null){
          unset($_SESSION["shopping_cart"]);
          echo '<script>window.location="index.php"</script>';
        } else {
          echo '<script>window.location="cart.php"</script>';
        }
      }
    }
  }
}



?>
<div class="card-wrapper">
<div class="card card-display card-cart">
  <div class="card-body">
    <h3 class="card-title">Beställning</h3>
    
<div class="table-responsive">
  <form action="shipping-details.php" method="POST">
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">Produktnamn</th>
      <th scope="col">Pris</th>
      <th scope="col">Antal</th>
      <th scope="col">Total Summa</th>
      <th scope="col">Ta Bort</th>
    </tr>
  </thead>
  <tbody>
  <?php if (!empty($_SESSION["shopping_cart"])) {
      $total = 0;
      foreach ($_SESSION["shopping_cart"] as $key => $value) { ?>
                <tr >
                    <td>
                      <?php echo $value["item_name"] ?>
                      <input type="hidden" name="item_name[]" value="<?php echo $value["item_name"] ?>">
                    </td>
                    <td>
                      <?php echo number_format($value["item_price"], 2) ?>
                      <input type="hidden" name="item_price[]" value="<?php echo number_format($value["item_price"], 2) ?>">
                    </td>
                    <td>
                      <?php echo $value["item_quantity"] ?>
                      <input type="hidden" name="item_quantity[]" value="<?php echo $value["item_quantity"] ?>">
                    </td>
                    <td>
                      <?php echo $item_total = number_format($value["item_quantity"] * $value["item_price"], 2) ?>
                      <input type="hidden" name="item_total[]" value="<?php echo $item_total ?>">
                    </td>
                    <td><a href="cart.php?action=delete&id=<?php echo $value["item_id"]; ?>"><i class="fas fa-times text-danger"></i></a> </td>
                    
                  </tr>
              <?php
              $total = $total + ($value["item_quantity"] * $value["item_price"]);
            }
            ?>
          <tr>
            <td colspan="3" align="right">Total</td>
            <td align="right"><?php echo number_format($total, 2) ?></td>
            <input type="hidden" name="order_total" value="<?php echo number_format($total, 2) ?>">
          </tr>
          </tbody>
        </table>
        <input type="submit" class="btn btn-success float-right" value="FORTSÄTT" >
        </form>
        </div>
          <?php } ?>

    </div >
  </div >
</div>


<?php
include "includes/footer.php";
?>