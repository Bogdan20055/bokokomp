<?php
session_start();
include 'bokokomp.php';


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

 
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
  
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.html");
            exit();
        } else {
            
            echo "<script>
                alert('Неправильний пароль');
                window.history.back();
            </script>";
        }
    } else {
        
        echo "<script>
            alert('Користувача з таким email не знайдено');
            window.history.back();
        </script>";
    }

    $stmt->close();
}
?>
