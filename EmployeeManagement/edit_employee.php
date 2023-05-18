<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* định dạng cho form nhập liệu */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        label {
            margin-top: 10px;
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
        }
        
        label span {
            font-size: 0.8rem;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }
        
        button[type="submit"] {
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php require 'components/header.php'; ?>
    <h1>Edit Employee</h1>
    <?php
    //require_once 'nhanvien.php';

    if (isset($_POST['submit'])) {
        $employee_id = $_POST['employee_id'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $date_of_birth = $_POST['date_of_birth'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $department_id = $_POST['department_id'];
        $sql = "UPDATE nhanvien SET ten_nhanvien=:name, gioi_tinh=:gender, ngay_sinh=:date_of_birth, dia_chi=:address, sdt=:phone, email=:email, ma_phongban=:department_id WHERE ma_nhanvien=:employee_id";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':employee_id', $employee_id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':gender', $gender);
        $statement->bindParam(':date_of_birth', $date_of_birth);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':department_id', $department_id);
        $statement->execute();
    
        header("Location: nhanvien.php");
        exit();
    } else {
        $employee_id = $_GET['employee_id'];
        $sql = "SELECT * FROM nhanvien WHERE ma_nhanvien=:employee_id";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':employee_id', $employee_id);
        $statement->execute();
        $employee = $statement->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="employee_id" value="<?php echo $employee['ma_nhanvien']; ?>">
        <label>
            <span>Name:</span>
            <input type="text" name="name" value="<?php echo $employee['ten_nhanvien']; ?>">
        </label>
        <label>
            <span>Gender:</span>
            <input type="text" name="gender" value="<?php echo $employee['gioi_tinh']; ?>">
        </label>
        <label>
            <span>Date of Birth:</span>
            <input type="date" name="date_of_birth" value="<?php echo $employee['ngay_sinh']; ?>">
        </label>
        <label>
            <span>Address:</span>
            <input type="text" name="address" value="<?php echo $employee['dia_chi']; ?>">
        </label>
        <label>
            <span>Phone:</span>
            <input type="text" name="phone" value="<?php echo $employee['sdt']; ?>">
        </label>
        <label>
            <span>Email:</span>
            <input type="text" name="email" value="<?php echo $employee['email']; ?>">
        </label>
        <label>
            <span>Department ID:</span>
            <input type="text" name="department_id" value="<?php echo $employee['ma_phongban']; ?>">
        </label>
        <button type="submit" name="submit">Save</button>
    </form>
    
    
    </body>
</html>    
