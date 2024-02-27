<?php
session_start();

// Check if the admin is authenticated
if (!isset($_SESSION['admin_authenticated']) || !$_SESSION['admin_authenticated']) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "narush");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM applications";
$result = $conn->query($sql);

$violation_reports = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $violation_reports[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\css.css">
<head>
    <title>Админ панель</title>
</head>
<body>
<img src="../img/logo.png" alt="" class="logo">
    <nav>
        <a href="index.php">Главная</a>
        <a href="zayava.php">Заявления</a>
        <a href="register.php">Регистрация</a>
    </nav>

    <section>
        <h2>Заявления</h2>
        <table>
            <tr>
                <th>Report ID</th>
                <th>User ID</th>
                <th>Car Number</th>
                <th>Car Model</th>
                <th>Description</th>
                <th>Location</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php foreach ($violation_reports as $report): ?>
                <tr>
                    <td><?php echo $report['id']; ?></td>
                    <td><?php echo $report['user_id']; ?></td>
                    <td><?php echo $report['car_number']; ?></td>
                    <td><?php echo $report['car_model']; ?></td>
                    <td><?php echo $report['description']; ?></td>
                    <td><?php echo $report['location']; ?></td>
                    <td><?php echo $report['status']; ?></td>
                    <td><?php echo $report['created_at']; ?></td>
                    <td>
                        <!-- Add a form to update the status -->
                        <form action="update_status.php" method="post">
                            <input type="hidden" name="report_id" value="<?php echo $report['id']; ?>">
                            <select name="new_status">
                                <option value="Подтвержденно">Подтвержденно</option>
                                <option value="Отклоненно">Отклоненно</option>
                            </select>
                            <button type="submit">Обновить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Нарушениям.Нет Все права защищены.</p>
    </footer>
</body>
</html>
