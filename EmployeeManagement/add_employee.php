<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php require 'components/header.php'; ?>
    <h1>Add Employee</h1>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Xử lý yêu cầu thêm nhân viên
        $ma_nhanvien = $_POST['ma_nhanvien'] ?? '';
        $ten_nhanvien = $_POST['ten_nhanvien'] ?? '';
        $gioi_tinh = $_POST['gioi_tinh'] ?? '';
        $ngay_sinh = $_POST['ngay_sinh'] ?? '';
        $dia_chi = $_POST['dia_chi'] ?? '';
        $sdt = $_POST['sdt'] ?? '';
        $email = $_POST['email'] ?? '';
        $ma_phongban = $_POST['ma_phongban'] ?? '';

        // Thực hiện câu truy vấn INSERT để thêm nhân viên vào cơ sở dữ liệu
        $sql = "INSERT INTO nhanvien (ma_nhanvien, ten_nhanvien, gioi_tinh, ngay_sinh, dia_chi, sdt, email, ma_phongban)
                VALUES (:ma_nhanvien, :ten_nhanvien, :gioi_tinh, :ngay_sinh, :dia_chi, :sdt, :email, :ma_phongban)";
        
        try {
            $statement = $connection->prepare($sql);
            $statement->bindParam(':ma_nhanvien', $ma_nhanvien);
            $statement->bindParam(':ten_nhanvien', $ten_nhanvien);
            $statement->bindParam(':gioi_tinh', $gioi_tinh);
            $statement->bindParam(':ngay_sinh', $ngay_sinh);
            $statement->bindParam(':dia_chi', $dia_chi);
            $statement->bindParam(':sdt', $sdt);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':ma_phongban', $ma_phongban);
            $statement->execute();

            echo "Employee added successfully.";
            header("Location: nhanvien.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>

    <form method="POST" action="">
        <label for="ma_nhanvien">Employee ID:</label>
        <input type="text" id="ma_nhanvien" name="ma_nhanvien"><br>

        <label for="ten_nhanvien">Name:</label>
        <input type="text" id="ten_nhanvien" name="ten_nhanvien"><br>

        <label for="gioi_tinh">Gender:</label>
        <input type="text" id="gioi_tinh" name="gioi_tinh"><br>
        <label for="ngay_sinh">Date of Birth:</label>
        <input type="text" id="ngay_sinh" name="ngay_sinh"><br>

        <label for="dia_chi">Address:</label>
        <input type="text" id="dia_chi" name="dia_chi"><br>

        <label for="sdt">Phone:</label>
        <input type="text" id="sdt" name="sdt"><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br>

        <label for="ma_phongban">Department ID:</label>
        <input type="text" id="ma_phongban" name="ma_phongban"><br>

        <input type="submit" value="Add Employee">
    </form>
<?php require 'components/footer.php'; ?>
</body>
</html>
