<?php

include 'bokokomp.php';


if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Реєстрація успішна!');
            window.location.href = 'index.html';
        </script>";
    } else {
        echo "<script>
            alert('Даний Gmail уже існує');
            window.history.back();
        </script>";
    }
}

$conn->close();
?>
