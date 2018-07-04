<?php
    session_start();
    $db = mysqli_connect('localhost', 'root', '', 'crud');
    
    $name = "";
    $email = "";
    $password = "";
    $id = 0;
    $update = false;

    if(isset($_POST['save'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        $sql = "INSERT INTO user(username, password, email) VALUE('$name', '$password', '$email') ";
        mysqli_query($db, $sql);

        $_SESSION['messeage'] = "Saved";
        header('location: index.php');
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "UPDATE user SET username='$name', password='$password', email='$email' WHERE id=$id";
        mysqli_query($db, $sql);
        $_SESSION['message'] = "Address updated!"; 
        header('location: index.php');
    }

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM user WHERE id=$id");
        $_SESSION['message'] = "Address deleted!"; 
        header('location: index.php');
    }

    $results = mysqli_query($db, "SELECT * FROM user");
    
?>