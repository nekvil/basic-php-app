<?php
require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/includes/header.php';
?>

<div class="container mt-5">

    <h1 class="text-center mb-4">User Management</h1>
    <div class="d-flex justify-content-end mb-3"> 
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
    </div>
    <div class="table-responsive">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">

            </tbody>
        </table>
    </div>
</div>

<input type="hidden" id="base_path" value="<?php echo BASE_PATH; ?>">

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" minlength="<?php echo MIN_NAME_LENGTH; ?>" autocomplete="on" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="on" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="<?php echo MIN_PASSWORD_LENGTH; ?>" autocomplete="current-password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block d-block mx-auto w-100 mb-2">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_PATH; ?>assets/js/user_management.js"></script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/includes/footer.php';
?>
