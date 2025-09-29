<?php
// Error reporting is enabled in config, no need to repeat here
if (isset($all)) {
    echo '<pre>DATA TO VIEW: ' . print_r($all, true) . '</pre>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1b5e20, #a5d6a7); /* dark green + light green gradient */
            min-height: 100vh;
        }
        .search-form {
            position: sticky;
            top: 0;
            background-color: #e8f5e9; /* very light green */
            z-index: 1000;
            padding: 15px 0;
            border-bottom: 2px solid #1b5e20;
        }
        .table thead {
            background-color: #1b5e20; /* dark green */
            color: white;
        }
        .table tbody tr:hover {
            background-color: #c8e6c9; /* light green hover */
        }
        .card {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border: 1px solid #1b5e20;
        }
        .card-header {
            background-color: #2e7d32; /* slightly lighter dark green */
            color: #fff;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
        .btn-primary:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="mb-3 text-end">
        <a href="<?= site_url('author/create'); ?>" class="btn btn-success">+ Add Author</a>
        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-secondary ms-2">Logout</a>
    </div>


    <div class="mb-3 text-end">
        <a href="<?= site_url('author/create'); ?>" class="btn btn-success">+ Add Author</a>
    </div>

    <div class="search-form row mb-3">
        <div class="col-md-6">
            <h2 class="text-success">Students List</h2>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <form action="<?= site_url('author'); ?>" method="get" class="d-flex w-100" style="max-width: 400px;">
                <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                <input class="form-control me-2" name="q" type="text" placeholder="Search..." value="<?= html_escape($q); ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Students List
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Birthdate</th>
                        <th>Added</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($all) && is_array($all) && count($all) > 0): ?>
                        <?php foreach ($all as $author): ?>
                            <tr>
                                <td><?= $author['first_name']; ?></td>
                                <td><?= $author['last_name']; ?></td>
                                <td><?= $author['email']; ?></td>
                                <td><?= $author['birthdate']; ?></td>
                                <td><?= $author['added']; ?></td>
                                <td>
                                    <a href="<?= site_url('author/edit/' . $author['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="<?= site_url('author/delete/' . $author['id']); ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this author?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center text-danger">No student records found or there was a problem loading the data.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-end">
            <?= $page; ?>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
