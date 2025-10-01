<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { max-width: 420px; margin: 5rem auto; box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Create account</h4>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= html_escape($error) ?></div>
        <?php endif; ?>
        <form method="post" action="<?= site_url('/register'); ?>">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Register</button>
            </div>
        </form>
        <div class="mt-3">
            <a href="<?= site_url('/'); ?>">Back to login</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


