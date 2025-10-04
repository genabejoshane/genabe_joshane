<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .search-form {
            position: sticky;
            top: 0;
            background-color: #fff;
            z-index: 1000;
            padding: 15px 0;
        }
        .table thead {
            background-color: #343a40;
            color: white;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
<div class="container py-4">

    <div class="search-form row mb-3">
        <div class="col-md-3">
            <h2>Students List</h2>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
            <form action="<?= site_url('author'); ?>" method="get" class="d-flex w-100" style="max-width: 400px;">
                <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                <input class="form-control me-2" name="q" type="text" placeholder="Search..." value="<?= html_escape($q); ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="col-md-3 d-flex justify-content-center">
            <a href="<?= site_url('student/create'); ?>" class="btn btn-success" style="background: #00fff7; color: #222; border: none; box-shadow: 0 0 8px #00fff7;">&#43; Create Student</a>
        </div>
        <div class="col-md-2 d-flex justify-content-end">
            <a href="<?= site_url('auth/logout'); ?>" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
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
                        <?php foreach (html_escape($all) as $author): ?>
                            <tr>
                                <td><?= $author['first_name']; ?></td>
                                <td><?= $author['last_name']; ?></td>
                                <td><?= $author['email']; ?></td>
                                <td><?= $author['birthdate']; ?></td>
                                <td><?= $author['added']; ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('student/edit/'.$author['id']); ?>" class="btn btn-info btn-sm" style="background: #00fff7; color: #222; border: none; box-shadow: 0 0 8px #00fff7;">&#9998; Edit</a>
                                            <a href="<?= site_url('student/delete/'.$author['id']); ?>" class="btn btn-danger btn-sm" style="background: #00fff7; color: #222; border: none; box-shadow: 0 0 8px #00fff7;" onclick="return confirm('Are you sure you want to delete this user?');">&#128465; Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
