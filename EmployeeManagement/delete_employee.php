<?php
require 'components/header.php';

if (isset($_GET['employee_id'])) {
    $employeeId = $_GET['employee_id'];
    
    if ($connection != null) {
        try {
            // Hiển thị câu hỏi xác nhận trước khi xóa
            echo "<script>
                    var confirmed = confirm('Are you sure you want to delete this employee?');
                    if (confirmed) {
                        window.location.href = 'delete_employee.php?employee_id=$employeeId&action=delete';
                    } else {
                        window.location.href = 'nhanvien.php';
                    }
                  </script>";
        } catch (PDOException $e) {
            echo "Cannot delete employee. Error: " . $e->getMessage();
        }
    }
}

// Kiểm tra action để xác định việc xóa đã được xác nhận hay chưa
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    try {
        $sql = "DELETE FROM nhanvien WHERE ma_nhanvien = :employeeId";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':employeeId', $employeeId);
        $statement->execute();
        
        // Điều hướng về trang danh sách nhân viên sau khi xóa thành công
        header('Location: nhanvien.php');
        exit;
    } catch (PDOException $e) {
        echo "Cannot delete employee. Error: " . $e->getMessage();
    }
}

require 'components/footer.php';
?>
