<?php
// Include database connection
require_once 'db_connection.php';

// Fetch categories from database
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM categories WHERE category_name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM categories ORDER BY category_id DESC";

}

$result = $conn->query($sql);

// Display categories
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["category_id"] . "</td>";
        echo "<td>" . $row["category_name"] . "</td>";
        echo "<td>
                <a href='edit_category.php?id=" . $row["category_id"] . "' class='btn btn-sm btn-primary'>Edit</a>
                <a href='delete_category.php?id=" . $row["category_id"] . "' class='btn btn-sm btn-danger'>Delete</a>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No categories found</td></tr>";
}

// Close database connection
$conn->close();
?>
