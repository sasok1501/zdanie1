<?php
session_start();

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: login.php");
    exit();
}

// Получение user_id из сессии (предполагая, что вы храните user_id в сессии)
$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

if (empty($userID)) {
    echo "Ошибка: Не удалось получить идентификатор пользователя.";
    exit();
}
// Обработка отправки нового заявления
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ваши коды для обработки и сохранения заявления в базе данных
    $user_id = $_SESSION['user_id'];
    $car_number = $_POST['car_number'];
    $car_model = $_POST['car_model'];
    $violation_description = $_POST['violation_description'];
    $location = $_POST['location'];

    // Пример: вставка заявления в базу данных
    $conn = new mysqli("localhost", "root", "", "narush");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO applications (user_id, car_number, car_model, description, location, status) VALUES ('$user_id', '$car_number', '$car_model', '$violation_description', '$location', 'В обработке')";

    if ($conn->query($sql) === TRUE) {
        echo "Заявление успешно отправлено!";
    } else {
        echo "Ошибка при отправке заявления: " . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\css.css">
    <title>Новое Заявление</title>
</head>
<body>
    <img src="../img/logo.png" alt="" class="logo">
    <nav>
        <a href="index.php">Главная</a>
        <a href="zayava.php">Заявления</a>
        <a href="register.php">Регистрация</a>
    </nav>
    <header>
        <h2>Новое Заявление</h2>
    </header>

    <section>
    <form action="create_application.php" method="post">
    <label for="car_number">Гос. номер автомобиля:</label>
    <input type="text" id="car_number" name="car_number" required>

    <label for="car_model">Модель автомобиля:</label>
    <input type="text" id="car_model" name="car_model" required>

    <label for="violation_description">Описание нарушения:</label>
    <textarea id="violation_description" name="violation_description" required></textarea>

    <label for="location">Место нарушения:</label>
    <input type="text" id="location" name="location" required>

    <button type="submit">Отправить заявление</button>
</form>

    </section>

    <footer>
        <p>&copy; 2024 Нарушениям.Нет Все права защищены.</p>
    </footer>
</body>
</html>
