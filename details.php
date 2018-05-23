<?php 
session_start(); 
require "connect.php";


$item = $_GET['item'];
$query = "SELECT * FROM items WHERE id = $item"; 

$results = mysqli_query($conn, $query)
or die(mysqli_error($conn));


if (mysqli_num_rows($results) > 0) {
    while($row = mysqli_fetch_assoc($results)) : ?>
        
        <?php include "includes/header.php"; ?>
        <form method="POST" action="index.php?action=add&id=<?= $row['id']?>" >
        <div class="card text-left mx-auto card-display" style="width: 80%;">
            <img class="card-img-top" src="<?=$row['img']?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?=$row['name']?> <span id="price"><?= number_format($row['price'], 2)?> kr</span></h5>
                <p class="card-text"><?=$row['description']?></p>
                <span>Antal: </span><input id="quantity" name="quantity" type="number" min="0" step="1" value="1"\>
                <input type="hidden" name="hidden_name" value="<?=$row['name']?>">
                <input type="hidden" name="hidden_price" value="<?=$row['price']?>">
                <input type="submit" name="add_to_cart" class="btn btn-success card-button" value="LÄGG TILL I VARUKORG"></input>
            </div>
        </div>
        </form>
        <?php include "includes/footer.php"; ?>



<?php   endwhile ;
    
};
?>
