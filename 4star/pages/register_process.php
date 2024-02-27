<?php

$conn = new mysqli("localhost", "root", "", "narush");

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Пользовательские данные из регистрационной формы
$fullName = $_POST['fullName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Вставка пользовательских данных в базу данных
$sql = "INSERT INTO users (full_name, phone, email, username, password) VALUES ('$fullName', '$phone', '$email', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
    // Регистрация прошла успешно, перенаправляем на главную страницу
    header("Location: index.php"); // Замените на ваш путь к главной странице
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
