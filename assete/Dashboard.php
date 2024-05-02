<?php
session_start();
include 'cnx.php';

// Check if the necessary session variables are set and not empty
if (
    isset($_COOKIE['id_admin'], $_COOKIE['admin']) &&
    !empty($_COOKIE['id_admin']) && !empty($_COOKIE['admin'])
) {
    $id = $_COOKIE['id_admin'];
    $admin = $_COOKIE['admin'];
} else {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="Dashboard.php">
                <h2>Dashboard</h2>
            </a>
            <ul>
                <li><a href="add.php">Add Département</a></li>
                <li><a href="logout.php">LogOut</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <h1>Gestion Département</h1>
            <div>
                <form id="nameForm" action="add.php" method="post">
                    <input type="text" id="nameInput" name="departement" placeholder="Enter Name Département" required>
                    <button type="submit" name="add" class="btn">Add Département</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name Département</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $aff = "SELECT * FROM departement";
                    $res = mysqli_query($cnx, $aff);

                    if ($res) {
                        while ($rowws = mysqli_fetch_assoc($res)) {

                            $id_dep = $rowws['id_dep'];

                    ?>
                            <tr>
                                <td><?= $id_dep ?></td>
                                <td><?= $rowws['departement'] ?></td>
                                <td>
                                    <i class="fas fa-edit action-icons" id="update" onclick="openEditModal(<?= $id_dep ?>, '<?= $rowws['departement'] ?>')"></i>
                                    <i class="fas fa-trash-alt action-icons" id="delete" onclick="openDeleteModal(<?= $id_dep ?>)"></i>
                                </td>
                            </tr>
                    <?php }
                    } elseif (!$res) {
                        die("Query failed: " . mysqli_error($cnx));
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap Modal for Update -->
    <div class="modal fade " id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Département</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="post" action="update.php">
                        <div class="form-group">
                            <input type="hidden" name="id" id="updateId">
                            <input type="text" name="departement" id="updateDepartement" class=" ">
                            <button type="submit" class="btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Département</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Département?</p>
                    <form id="deleteForm" method="post" action="delete.php">
                        <input type="hidden" name="id" id="deleteId">
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to open Update Modal
        function openEditModal(id, departement) {
            $('#updateId').val(id);
            $('#updateDepartement').val(departement);
            $('#updateModal').modal('show');
        }

        // Function to open Delete Modal
        function openDeleteModal(id) {
            $('#deleteId').val(id);
            $('#deleteModal').modal('show');
        }
    </script>
</body>

</html>