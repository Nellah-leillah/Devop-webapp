<?php
session_start();
require 'connect.php';

if(!isset($_SESSION['user_id'])){
    header("Location:index.php");
    exit;
}

if(isset($_GET['logout'])){
    session_destroy();
    header("Location:index.php");
    exit;
}

if(isset($_POST['add_user'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");
    $stmt->execute([$username,$email,$password]);

    header("Location:dashboard.php");
    exit;
}

if(isset($_POST['update_user'])){
    $id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET username=?, email=? WHERE id=?");
    $stmt->execute([$username,$email,$id]);

    header("Location:dashboard.php");
    exit;
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
    $stmt->execute([$id]);

    header("Location:dashboard.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<style>
body{
display:flex;
min-height:100vh;
flex-direction:column;
}

.main-wrapper{
display:flex;
flex:1;
}

.sidebar{
width:250px;
background:#343a40;
color:#fff;
min-height:100vh;
}

.sidebar a{
color:#fff;
display:block;
padding:10px;
text-decoration:none;
}

.sidebar a:hover{
background:#495057;
}

.content{
flex:1;
padding:20px;
}

.footer{
background:#343a40;
color:#fff;
padding:15px;
text-align:center;
}
</style>

</head>

<body>

<div class="main-wrapper">

<div class="sidebar d-lg-block">

<h3 class="text-center py-3">Dashboard</h3>

<a href="dashboard.php">Home</a>
<a href="dashboard.php">User</a>
<a href="?logout=1">Logout</a>

</div>

<div class="content">

<button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
Add New User
</button>

<table id="usersTable" class="table table-striped table-bordered">

<thead class="table-dark">
<tr>
<th>ID</th>
<th>Username</th>
<th>Email</th>
<th>Created At</th>
<th>Actions</th>
</tr>
</thead>

<tbody>
<?php foreach($users as $user): ?>
<tr>
<td><?= $user['id'] ?></td>
<td><?= htmlspecialchars($user['username']) ?></td>
<td><?= htmlspecialchars($user['email']) ?></td>
<td><?= $user['created_at'] ?></td>
<td>
<button class="btn btn-sm btn-info editBtn"
data-id="<?= $user['id'] ?>"
data-username="<?= htmlspecialchars($user['username']) ?>"
data-email="<?= htmlspecialchars($user['email']) ?>">
Edit
</button>

<a href="?delete=<?= $user['id'] ?>"
class="btn btn-sm btn-danger"
onclick="return confirm('Are you sure to delete this user?')">
Delete
</a>

</td>
</tr>
<?php endforeach; ?>
</tbody>

</table>

<h3 class="mt-4">Users Chart</h3>
<canvas id="usersChart" width="400" height="150"></canvas>

</div>

</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<form method="POST">
<div class="modal-header">
<h5 class="modal-title">Add New User</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
<input type="text" class="form-control mb-2" name="username" placeholder="Username" required>
<input type="email" class="form-control mb-2" name="email" placeholder="Email" required>
<input type="password" class="form-control mb-2" name="password" placeholder="Password" required>
</div>
<div class="modal-footer">
<button class="btn btn-success" name="add_user">Add User</button>
</div>
</form>
</div>
</div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<form method="POST">
<div class="modal-header">
<h5 class="modal-title">Edit User</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
<input type="hidden" name="user_id" id="editUserId">
<input type="text" class="form-control mb-2" name="username" id="editUsername" required>
<input type="email" class="form-control" name="email" id="editEmail" required>
</div>
<div class="modal-footer">
<button class="btn btn-info" name="update_user">Update</button>
</div>
</form>
</div>
</div>
</div>

<div class="footer">
powered by ISO TECH Ltd | 2026-2050 <br>
Online: 0781915307 | 0728746768 | 0734574060
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(document).ready(function(){
    $('#usersTable').DataTable({
        dom:'Bfrtip',
        buttons:['copy','csv','excel','pdf','print']
    });

    $('.editBtn').on('click', function(){
        const id = $(this).data('id');
        const username = $(this).data('username');
        const email = $(this).data('email');

        $('#editUserId').val(id);
        $('#editUsername').val(username);
        $('#editEmail').val(email);

        var myModal = new bootstrap.Modal(document.getElementById('editModal'));
        myModal.show();
    });

    const ctx = document.getElementById('usersChart').getContext('2d');
    new Chart(ctx,{
        type:'bar',
        data:{
            labels:[<?php foreach($users as $u) echo "'".$u['username']."',"; ?>],
            datasets:[{
                label:'User ID',
                data:[<?php foreach($users as $u) echo $u['id'].','; ?>],
                backgroundColor:'rgba(54,162,235,0.6)'
            }]
        },
        options:{responsive:true}
    });
});
</script>

</body>
</html>