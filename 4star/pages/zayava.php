<?php
session_start();

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: login.php");
    exit();
}

// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "narush");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение user_id из сессии (предполагая, что вы храните user_id в сессии)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

// Извлечение заявлений из базы данных
$sql = "SELECT * FROM applications WHERE user_id = $user_id";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\css.css">
    <title>Заявления</title>
</head>
<body>
    <img src="../img/logo.png" alt="" class="logo">
    <nav>
        <a href="index.php">Главная</a>
        <a href="zayava.php">Заявления</a>
        <a href="register.php">Регистрация</a>
    </nav>
    <header>
        <h2>Мои Заявления</h2>
    </header>

    <section>
        <h3>Ваши предыдущие заявления:</h3>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>Статус: " . $row['status'] . "<br>Описание: " . $row['description'] . "</p>";
            }
        } else {
            echo "<p>У вас пока нет предыдущих заявлений.</p>";
        }

        $conn->close();
        ?>
    </section>

    <section>
        <h3>Новое заявление:</h3>
        <p><a href="create_application.php">Заполнить новое заявление</a></p>
    </section>

    <footer>
        <p>&copy; 2024 Нарушениям.Нет Все права защищены.</p>
    </footer>
</body>
</html>
