<?php
session_start();

// подключение к базе данных
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'PuneethReddy');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ecommerece');
$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

// регистрация пользователя
if (isset($_POST['reg_user'])) {
    // получение всех значений формы
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_1 = trim($_POST['password_1']);
    $password_2 = trim($_POST['password_2']);

    // проверка формы на корректность
    if (empty($username)) {
        $errors[] = "Имя пользователя обязательно";
    }
    if (empty($email)) {
        $errors[] = "Адрес электронной почты обязателен";
    }
    if (empty($password_1)) {
        $errors[] = "Пароль обязателен";
    }
    if ($password_1 !== $password_2) {
        $errors[] = "Два введенных пароля не совпадают";
    }

    // проверка, существует ли пользователь с таким же именем пользователя или адресом электронной почты
    if (empty($errors)) {
        $stmt = $db->prepare("SELECT * FROM register WHERE Name = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user['Name'] === $username) {
                $errors[] = "Имя пользователя уже существует";
            }
            if ($user['email'] === $email) {
                $errors[] = "Адрес электронной почты уже существует";
            }
        }
        
        $stmt->close();
    }

    // регистрация пользователя
    if (empty($errors)) {
        $hashed_password = password_hash($password_1, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO register (Name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            $_SESSION['Name'] = $username;
            $_SESSION['success'] = "Вы успешно вошли в систему";
            header('Location: index.php');
        } else {
            $errors[] = "Ошибка при регистрации пользователя. Попробуйте снова.";
        }
        
        $stmt->close();
    }
}

// вход пользователя
if (isset($_POST['login_user'])) {
    $username = trim($_POST['email']);
    $password = trim($_POST['password']);

    // проверка формы на корректность
    if (empty($username)) {
        $errors[] = "Требуется указать адрес электронной почты";
    }
    if (empty($password)) {
        $errors[] = "Требуется указать пароль";
    }

    // вход пользователя
    if (empty($errors)) {
        $stmt = $db->prepare("SELECT * FROM register WHERE email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $username;
                $_SESSION['success'] = "Вы успешно вошли в систему";
                header('Location: index.php');
            } else {
                $errors[] = "Неправильная комбинация адреса электронной почты и пароля";
            }
        } else {
            $errors[] = "Пользователь с таким адресом электронной почты не найден";
        }
        
        $stmt->close();
    }
}

$db->close();
?>
