<?php
session_start();

// Проверка аутентификации администратора
if (!isset($_SESSION['admin_authenticated']) || !$_SESSION['admin_authenticated']) {
    header("Location: admin_login.php");
    exit();
}

// Проверка отправки формы методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "narush");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Проверка соединения с базой данных
    $report_id = $_POST['report_id'];
    $new_status = $_POST['new_status'];

    // Обновление статуса в таблице applications
    $update_sql = "UPDATE applications SET status='$new_status' WHERE id=$report_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $conn->close();
} else {
    // Перенаправление на admin_dashboard.php при доступе без отправки формы
    header("Location: admin_dashboard.php");
    exit();
}
?>
