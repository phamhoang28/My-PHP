
<!DOCTYPE html>
<html>
<head>
    <title>List of Employees</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .employee-table {
            border-collapse: collapse;
            width: 100%;
        }
        
        .employee-table th,
        .employee-table td {
            border: 1px solid black;
            padding: 8px;
        }
        
        .employee-table th {
            background-color: #f2f2f2;
        }
        
        .employee-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .employee-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .employee-actions a {
            padding:  12px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }
        
        .employee-actions a:hover {
            background-color: #45a049;
        }
        
        .add-employee-button {
            margin-top: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php require 'components/header.php'; ?>
    <h1>List of Employees here</h1>
    <?php
    $sql = "SELECT * FROM nhanvien";
    if ($connection != null) {
        try {
            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $nhanviens = $statement->fetchAll();
            ?> 
            
            <a  href="actions\add_employee.php">Add Employee</a>
            
            <table class="employee-table" >
                <thead>
                    <tr >
                        <th >Employee ID</th>
                        <th >Name</th>
                        <th >Gender</th>
                        <th >Date of Birth</th>
                        <th >Address</th>
                        <th >Phone</th>
                        <th >Email</th>
                        <th >Department ID</th>
                        <th >Actions</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($nhanviens as $nhanvien) : ?>
                        <tr>
                            <td ><?php echo $nhanvien['ma_nhanvien'] ?? ''; ?></td>
                            <td ><?php echo $nhanvien['ten_nhanvien'] ?? ''; ?></td>
                            <td ><?php echo $nhanvien['gioi_tinh'] ?? ''; ?></td>
                            <td ><?php echo $nhanvien['ngay_sinh'] ?? ''; ?></td>
                            <td ><?php echo $nhanvien['dia_chi'] ?? ''; ?></td>
                            <td ><?php echo $nhanvien['sdt'] ?? ''; ?></td>
                            <td ><?php echo $nhanvien['email'] ?? ''; ?></td>
                            <td ><?php echo $nhanvien['ma_phongban'] ?? ''; ?></td>
                            <td class="employee-actions"> 
                                <a href="edit_employee.php?employee_id=<?php echo $nhanvien['ma_nhanvien']; ?>">Edit</a>
                                <a href="delete_employee.php?employee_id=<?php echo $nhanvien['ma_nhanvien']; ?>">Delete</a>
                                <a href="detail_employee.php?employee_id=<?php echo $nhanvien['ma_nhanvien']; ?>">Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            
        <?php
             } catch (PDOException $e) {
                   echo "Cannot query data. Error: " . $e->getMessage();
             }
    }
    
    ?>
<?php require 'components/footer.php';?>
</body>
</html>
