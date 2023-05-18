<?php
//require 'config.php'; // Include the file containing the database connection configuration
require 'components/header.php';
// Check if the employee ID is provided in the query string
if (isset($_GET['employee_id'])) {
    $employeeId = $_GET['employee_id'];

    // Retrieve the employee details from the database
    $sql = "SELECT * FROM nhanvien WHERE ma_nhanvien = :employeeId";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':employeeId', $employeeId, PDO::PARAM_INT);
    $statement->execute();
    $employee = $statement->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Employee Details</h1>
    <?php if (isset($employee)) : ?>
        <ul>
            <li><strong>Employee ID:</strong> <?php echo $employee['ma_nhanvien']; ?></li>
            <li><strong>Name:</strong> <?php echo $employee['ten_nhanvien']; ?></li>
            <li><strong>Gender:</strong> <?php echo $employee['gioi_tinh']; ?></li>
            <li><strong>Date of Birth:</strong> <?php echo $employee['ngay_sinh']; ?></li>
            <li><strong>Address:</strong> <?php echo $employee['dia_chi']; ?></li>
            <li><strong>Phone:</strong> <?php echo $employee['sdt']; ?></li>
            <li><strong>Email:</strong> <?php echo $employee['email']; ?></li>
            <li><strong>Department ID:</strong> <?php echo $employee['ma_phongban']; ?></li>
        </ul>
        <a href="nhanvien.php">Back</a>
    <?php else : ?>
        <p>Employee not found.</p>
        <a style='border-radius: 4px;'; href="nhanvien.php">Back</a>
    <?php endif; ?>
    
</body>
</html>
