<?php
include 'db_connection.php';

$sql = "SELECT * FROM categories ORDER BY category_id DESC";
$result = $conn->query($sql);

$options = '<option value="">Select Category</option>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options .= '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
    }
}

echo $options;
?>
