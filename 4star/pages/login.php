<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\css.css">
    <title>Вход в Личный Кабинет</title>
</head>
<body>
<img src="../img/logo.png" alt="" class="logo">
    <nav>
        <a href="index.php">Главная</a>
        <a href="zayava.php">Заявления</a>
        <a href="register.php">Регистрация</a>
    </nav>
    <header>
        <h2>Вход в Личный Кабинет</h2>
    </header>

    <form action="login_process.php" method="post">
        <label for="username">Логин:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Войти</button>
        <a href="admin_login.php">Вход для администратора</a>
        <a href="register.php">Регистрация</a>
    </form>

    <footer>
        <p>&copy; 2024 Нарушениям.Нет Все права защищены.</p>
    </footer>
</body>
</html>
