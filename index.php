
<?php
session_start();
require 'connect.php';
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
    }
    if(isset($_GET['logout'])){
        session_destroy();
        header("Location: index.php");
        exit;
        }
        if(isset($_POST['add_user'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'],
            PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO
            users(username,email,password) VALUES(?,?,?)");
            $stmt->execute([$username,$email,$password]);header("Location: dashboard.php");
            exit;
            }
            if(isset($_POST['update_user'])){
                $id = $_POST['user_id'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $stmt = $pdo->prepare("UPDATE users SET
                username=?, email=? WHERE id=?");
                $stmt->execute([$username,$email,$id]);
                header("Location: dashboard.php");
                exit;
                }
                if(isset($_GET['delete'])){
                    $id = $_GET['delete'];
                    $stmt = $pdo->prepare("DELETE FROM users
                    WHERE id=?");
                    $stmt->execute([$id]);
                    header("Location: dashboard.php");
                    exit;
                    }
                    $stmt = $pdo->prepare("SELECT * FROM users
                    ORDER BY id DESC");
                    $stmt->execute();
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>