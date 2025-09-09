<?php
// Include database connection
require_once 'db_connection.php';

// Fetch roles from database
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM roles WHERE role_name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM roles ORDER BY role_id DESC";
}

$result = $conn->query($sql);

// Display roles
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["role_id"] . "</td>";
        echo "<td>" . $row["role_name"] . "</td>";
        echo "<td>
                <a href='edit_role.php?id=" . $row["role_id"] . "' class='btn btn-sm btn-primary'>Edit</a>
                <a href='delete_role.php?id=" . $row["role_id"] . "' class='btn btn-sm btn-danger'>Delete</a>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No roles found</td></tr>";
}

// Close database connection
$conn->close();
