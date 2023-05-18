<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
// if (isset($_SESSION["username"])) {
//     // Người dùng đã đăng nhập, chuyển hướng đến trang phù hợp
//     $role = $_SESSION["role"];
//     if ($role == "admin") {
//         header("Location: admin.php");
//     } elseif ($role == "moderator") {
//         header("Location: moderator.php");
//     } else {
//         header("Location: nhanvien.php");
//     }
//     exit();
// }

// Kiểm tra xem người dùng đã gửi dữ liệu đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Gọi file kết nối cơ sở dữ liệu
    require_once "components/header.php";

    // Truy vấn để kiểm tra người dùng tồn tại
    $query = "SELECT role FROM user WHERE username = :username AND password = :password";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $role = $row["role"];

        // Lưu thông tin đăng nhập vào session
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $role;

        // Chuyển hướng người dùng đến trang phù hợp
        if ($role == "admin") {
            header("Location: admin.php");
        } elseif ($role == "moderator") {
            header("Location: moderator.php");
        } else {
            header("Location: nhanvien.php");
        }
        exit();
    } else {
        echo "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>