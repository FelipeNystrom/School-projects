<?php session_start();

    // logga in i db
    require "connect.php";

    // skapa sql-sats
    $query = "SELECT * FROM items";
    $result = mysqli_query($conn, $query)
    or die(mysqli_error($conn));

    if (isset($_POST["add_to_cart"])){
      if(isset($_SESSION["shopping_cart"])){
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id)){
          $count = count($_SESSION["shopping_cart"]);
          $item_array = array(
            'item_id'       => $_GET["id"],
            'item_name'     => $_POST["hidden_name"],
            'item_price'    => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
          );
          $_SESSION["shopping_cart"][$count] = $item_array;
        } 
        else {
          echo '<script>alert("Item Already Added!")</script>';
          echo '<script>window.location="index.php"</script>';
        }
      } else {
        $item_array = array(
          'item_id'       => $_GET["id"],
          'item_name'     => $_POST["hidden_name"],
          'item_price'    => $_POST["hidden_price"],
          'item_quantity' => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
      }
    }

    include "includes/header.php";
    ?>
    
    

    <!-- Page Content -->
    

      <div class="row"></div>

        <div class="col-md">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="img/slide-img/slide-img-1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="img/slide-img/slide-img-2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="img/slide-img/slide-img-3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Föregående</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Nästa</span>
            </a>
          </div>

          <div class="row">
          <?php foreach ($result as $key => $value) : ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card text-center h-100">
                <a href="details.php?item=<?= $value["id"] ?>"><img class="card-img-top img-fluid" src="<?= $value["img"] ?>" alt="image of <?= $value["name"] ?>"></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="details.php?item=<?= $value["id"] ?>"><?= $value["name"] ?></a>
                  </h4>
                  <h5><?php echo number_format($value["price"], 2) ?> kr</h5>
                  <p class="card-text" style="max-height: 100rem; overflow: hidden; white-space: nowrap; text-overflow: ellipsis"><?= $value["description"] ?></p>
                </div>
                <div class="card-footer card-split">
                  <a href="details.php?item=<?= $value["id"] ?>" class="btn btn-outline-success pad-right">LÄS MER</a>
                </div>
              </div>
            </div>
            <?php endforeach ?>


          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    

    <?php include "includes/footer.php" ?>