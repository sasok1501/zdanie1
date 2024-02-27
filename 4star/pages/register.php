<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\css.css">
    <title>Регистрация</title>
</head>
<body>
<img src="../img/logo.png" alt="" class="logo">
    <nav>
        <a href="index.php">Главная</a>
        <a href="zayava.php">Заявления</a>
        <a href="register.php">Регистрация</a>
    </nav>
    <header>
        <h2>Регистрация</h2>
    </header>
    <form action="register_process.php" method="post">
        <label for="fullName">ФИО:</label>
        <input type="text" id="fullName" name="fullName" required>

        <label for="phone">Телефон:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="username">Логин:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Зарегистрироваться</button>
        <a href="login.php">Войти</a>
    </form>


    <footer>
        <p>&copy; 2024 Нарушениям.Нет Все права защищены.</p>
    </footer>
</body>
</html>