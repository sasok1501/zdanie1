<?php
$conn = new mysqli("localhost", "root", "", "narush");

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Извлекаем пользовательские данные из формы входа в систему
$username = $_POST['username'];
$password = $_POST['password'];

// Извлечение пользователя из базы данных по имени пользователя
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Пользователь найден, проверяем пароль
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Вход в систему успешен, устанавливаем сессию
        session_start();
        $_SESSION['authenticated'] = true;
        $_SESSION['user_id'] = $row['id']; // Предполагается, что в таблице users есть поле 'id'
        header("Location: index.php"); // Перенаправление на страницу с заявлениями
        exit();
    } else {
        echo "Неверный пароль. Пожалуйста, попробуйте снова.";
    }
} else {
    echo "Пользователь не найден. Пожалуйста, проверьте ваше имя пользователя.";
}

$conn->close();
?>
