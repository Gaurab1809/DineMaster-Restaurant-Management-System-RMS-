<?php
include 'db_connection.php';

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["employee_id"] . "</td>
                <td>" . $row["first_name"] . " " . $row["last_name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["phone"] . "</td>
                <td>" . $row["address"] . "</td>
                <td>" . $row["role_id"] . "</td>
                <td>$" . $row["salary"] . "</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "0 results";
}
$conn->close();
?>
