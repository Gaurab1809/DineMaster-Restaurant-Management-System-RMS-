<?php
include 'db_connection.php';

$category_id = $_GET['category_id'];

$query = "SELECT * FROM products WHERE categorie_id = $category_id";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col-md-4 mb-3">';
        echo '<div class="card">';
        echo '<img src="' . $row['product_picture'] . '" class="card-img-top" alt="Product Image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['product_name'] . '</h5>';
        echo '<p class="card-text">Price: $' . $row['product_price'] . '</p>';
        echo '<p class="card-text">' . $row['product_description'] . '</p>';
        echo '</div></div></div>';
    }
} else {
    echo '<p>No products found for this category.</p>';
}
?>
