<?php
session_start();
require 'connect.php';
if(isset($_POST['login1'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if($user && password_verify($password,$user['password'])){
        $_SESSION['user_id']=$user['id'];
        header("Location: dashboard.php");
        exit;
    }else{
        $error = "Invalid credentials!";
    }
}
if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");

    if($stmt->execute([$username,$email,$password])){
        $succes = "Signup successful! You can login now.";
    }else{
        $error = "Signup failed!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullstack WebApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
            </script>
            <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin> 
            </script>
            <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"crossorigin>
                </script>
                <style>
                    body {scroll-behavior: smooth;}
                    section{padding:100px 0;}
                    .navbar-nav .nav-link {cursor:pointer;}
                    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand"href="#">ISO TECH WebAPP</a>
            <button class="nav-toggler"type="button"data-bs-toggle="collapse"data-bs-target="collapse"data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
</button>
<div class="collap'se navbar-collapse"id="mainNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
        <li class="nav-item"><a class="nav-link" href="#aboutu">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">contact</a></li>
        <li clas="nav-item"><a class="nav-link"data-bs-toggle="modal"data-bs-target="#loginModal">Login</a>
</li>
<li class="nave-item"><a class="nav-link"data-bs-toggle="modal"data-bs-target="#signupModal">SignUp</a></li>
</ul>
</div>
</div>
</nav>
<section id="home" class="bg-light text-center"style="margin-top:70px;">
<div class="container">
    <h1 class="display-4">Welccome to ISO TECH WebAPP</h1>
    <?php if(isset($error)) echo "<div class='alert alert-danger mt-3'>$error</div>";?>
    <?php if(isset($success)) echo "<div clss='alert alert-danger mt-3'>$success</div>";?>
    <div class="mt-4">
        <button class="btn btn-success me-2"data-bs-toggle="modal"data-bs-target="#loginModal">Login</button>
<button class="btn btn-success me-2"data-bs-toggle="modal"data-bs-target="#signupModal">Singnup</button>
<button class="btn btn-success me-2"data-bs-toggle="modal"data-bs-target="#resetModal">Reset password</button>
</div> 
</div>
</section>
<section id="features" class="bg-white text-center">
    <div class="container">
        <h2>Features</h2>
        <p class="lead">Modern Bootstrap 5 interface, userlogin/signup/reset,dashboard with charts,tables,and full CRUD.</p>
</div>
</section>
<section id="about" class="bg-white text-center">
    <div class="container">
        <h2>About Us</h2>
        <p class="lead">Powered by ISO TECH Ltd,delivering modern web solution with responsive design and rich UX.</p>
</div>
</section>
<section id="contact" class="bg-white text-center">
    <div class="container">
        <h2>Contact</h2>
        <p class="lead">Email:isotechtraining777@gmail.com|phone:0788195307|0728746768|0734574060</p>
</div>
</section>
<div class="modal fade"id="loginModal" tabindex="-1">
<div class="modal-dialog">
    <div class="modal-content">
        <form method="POST">
        <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="btn-close"data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <input type="email" class="form-control mb-2"name="email"placeholder="Email"required>
    <input type="password" class="form-control mb-2"name="password"placeholder="Password"required>
</div>
<div class="modal-footer">
    <button class="btn btn-primary" name="login1">Login</button>
</div>
</form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="signupModal" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST">
    <div class="modal-header">
    <h5 class="modal-title">Sign Up</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <input type="text" class="form-control mb-2" name="username"placeholder="Username"required>
    <input type="email" class="form-control mb-2" name="email"placeholder="Email"required>
    <input type="password" class="form-control" name="password"placeholder="Password"required>
</div>
<div class="modal-footer">
    <button class="btn btn-success"name="signup">SignUp</button>
</div>
</form>
</div>
</div>
</div>
<div class="modal fade"id="resetModal" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal content">
    <form method="POST">
    <div class="modal-header">
    <h5 class="modal-title">Reset Password</h5>
    <button type ="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
<input type="email" class="form-control"name="reset_email" placeholder="Enter your email" required>
</div>
<div class="modal-footer">
<button class="btn btn-warning">Reset</button>
</div>
</form>
</div>
</div>
</div>
</body>
</html>