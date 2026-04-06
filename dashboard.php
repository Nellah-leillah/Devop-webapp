
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/d
        ist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery- 3.7.0.min.js"></script>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/di
        st/js/bootstrap.bundle.min.js"></script>
        <!-- Chart.js CDN -->
         <script
         src="https://cdn.jsdelivr.net/npm/chart.js"></script>
         <!-- DataTables CDN -->

         <link rel="stylesheet"
 href="https://cdn.datatables.net/1.13.6/css/jquery.dat
 aTables.min.css">
 <script
 src="https://cdn.datatables.net/1.13.6/js/jquery.dataT
 ables.min.js"></script>
 <!-- DataTables Buttons for export -->
  <link rel="stylesheet"href="https://cdn.datatables.net/buttons/2.4.1/css/butt
  ons.dataTables.min.css">
  <script
  src="https://cdn.datatables.net/buttons/2.4.1/js/dataT
  ables.buttons.min.js"></script>
  <script
  src="https://cdn.datatables.net/buttons/2.4.1/js/butto
  ns.html5.min.js"></script>
  <script
  src="https://cdn.datatables.net/buttons/2.4.1/js/butto
  ns.print.min.js"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10. 1/jszip.min.js"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0. 2.7/pdfmake.min.js"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0. 2.7/vfs_fonts.js"></script>
  <style>
  body {display:flex; min-height:100vh; flex- direction:column;}
  .main-wrapper {display:flex; flex:1;}
  .sidebar {width:250px; background:#343a40;
  color:#fff; min-height:100vh;}
  .sidebar a {color:#fff; display:block; padding:10px;
  text-decoration:none;}
  .sidebar a:hover {background:#495057;}
  .content {flex:1; padding:20px;}
  .footer {background:#343a40; color:#fff;
  padding:15px; text-align:center;}
  </style>
  </head>
  <body>
    <!-- Responsive Hamburger Navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark
     bg-dark d-lg-none">
     <div class="container-fluid">
    <a class="navbar-brand"
    href="#">Dashboard</a>
        <button class="navbar-toggler" type="button"
         data-bs-toggle="collapse" data-bs￾target="#mobileNav">
         <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"
        id="mobileNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item"><a class="nav-link"
    href="dashboard.php">Home</a></li>
    <li class="nav-item"><a class="nav-link"
    href="dashboard.php">Users</a></li>
    <li class="nav-item"><a class="nav-link"
    href="?logout=1">Logout</a></li>
</ul>
</div>
</div>
</nav>
<div class="main-wrapper">
<!-- Sidebar (desktop) -->
 <div class="sidebar d-none d-lg-block">
     <h3 class="text-center py-3">Dashboard</h3>
     <a href="dashboard.php">Home</a>
     <a href="dashboard.php">Users</a>
     <a href="?logout=1">Logout</a>
    </div>
    <!-- Content -->
     <div class="content">
        <div class="d-flex justify-content-between align￾items-center mb-3">
            <h2>Users Table</h2
            button class="btn btn-success" data-bs￾toggle="modal" data-bs￾target="#addUserModal">Add New User</button>
        </div>
        <table id="usersTable" class="table table- striped">
            <thead>
                <tr><th>ID</th><th>Username</th><th>Em
                    ail</th><th>Created At</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-info
                                editBtn"
                                data-id="<?= $user['id'] ?>"
                                data-username="<?=
                                $user['username'] ?>"
                                data-email="<?=
                                $user['email'] ?>">Edit</button>
                                <a href="?delete=<?= $user['id'] ?>"
                                class="btn btn-sm btn-danger" onclick="return
                                confirm('Are you sure to delete this user?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Chart -->
                     <h3>Users Chart</h3>
                     <canvas id="usersChart" width="400"
                     height="150"></canvas>
                    </div>
                </div>
                <!-- Add User Modal -->
                 <div class="modal fade" id="addUserModal"
                 tabindex="-1">
                 <div class="modal-dialog">
                    <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New User</h5>
                            <button type="button" class="btn-close" data- bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control mb-2"
                            name="username" placeholder="Username"
                            required>
                            <input type="email" class="form-control mb- 2" name="email" placeholder="Email" required>
                            <input type="password" class="form-control"
                            name="password" placeholder="Password"
                            required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success"
                            name="add_user">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal -->
         <div class="modal fade" id="editModal"
         tabindex="-1">
         <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data- bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id"
                        id="editUserId">
                        <input type="text" class="form-control mb-2"
                        name="username" id="editUsername"
                        placeholder="Username" required>
                        <input type="email" class="form-control"
                        name="email" id="editEmail" placeholder="Email"
                        required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info"
                        name="update_user">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
     <div class="footer">
        Powered by ISO TECH Ltd | 2026 - 2050 <br>
        Online: 0781915307 | 0728746768 | 0734574060
    </div>
    <script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            dom: 'Bfrtip'
            ,
            buttons: ['copy'
            'csv'
            ,
            'excel'
            ,
            'pdf'
            ,
            'print']
        });
        $('.editBtn').on('click'
        , function(){
            const id = $(this).data('id');
            const username = $(this).data('username');
            const email = $(this).data('email');
            $('#editUserId').val(id);
            $('#editUsername').val(username);
            $('#editEmail').val(email);
            $('#editModal').modal('show');
        });
        // Chart.js users chart
        const ctx =
        document.getElementById('usersChart').getContext('
        2d');
        const chart = new Chart(ctx, {
            type: 'bar'
            ,
            data: {
                labels: [<?php foreach($users as $u) echo
                "'".$u['username']."'
                ,
                "; ?>],
                datasets: [{
                    label: 'User ID'
                    ,
                    data: [<?php foreach($users as $u) echo
                    $u['id'].'
                    ,
                    '; ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }]
            },
            options: {responsive:true}
        });
        });
        </script>
        </body>
        </html>