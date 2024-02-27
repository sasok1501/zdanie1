<?php
session_start();

if (isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated']) {
    header("Location: admin_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "root", "", "narush");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Обработка входа администратора
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    // Secure way to prevent SQL injection (you may use prepared statements)
    $admin_username = $conn->real_escape_string($admin_username);
    $admin_password = $conn->real_escape_string($admin_password);

    $sql = "SELECT * FROM admins WHERE username='$admin_username' AND password='$admin_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['admin_authenticated'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error_message = "Неверное имя пользователя или пароль";
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
    <link rel="stylesheet" href="../css/css.css">
    <title>Вход для администратора</title>
</head>
<body>
    <img src="../img/logo.png" alt="" class="logo">
    <nav>
        <a href="index.php">Главная</a>
        <a href="zayava.php">Заявления</a>
        <a href="register.php">Регистрация</a>
    </nav>
    <header>
        <h2>Вход для администратора</h2>
    </header>

    <section>
        <form action="admin_login.php" method="post">
            <label for="admin_username">Имя администратора:</label>
            <input type="text" id="admin_username" name="admin_username" required>

            <label for="admin_password">Пароль:</label>
            <input type="password" id="admin_password" name="admin_password" required>

            <button type="submit">Войти</button>
        </form>
        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
    </section>

    <footer>
        <p>&copy; 2024 Нарушениям.Нет Все права защищены.</p>
    </footer>
</body>
</html>
