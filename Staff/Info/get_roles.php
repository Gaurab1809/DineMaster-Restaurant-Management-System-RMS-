<?php
include 'db_connection.php';

$sql = "SELECT * FROM roles ORDER BY role_name";
$result = $conn->query($sql);

$options = '<option value="">Select Role</option>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options .= '<option value="'.$row['role_id'].'">'.$row['role_name'].'</option>';
    }
}

echo $options;
?>
