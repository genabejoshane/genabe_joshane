<h1>Student List</h1>
<a href="<?= site_url('student/create'); ?>" class="create-btn">+ Create New Student</a>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php foreach ($students as $student): ?>
    <tr>
        <td><?= $student['id']; ?></td>
        <td><?= $student['name']; ?></td>
        <td><?= $student['email']; ?></td>
        <td>
            <a href="<?= site_url('student/update/'.$student['id']); ?>">Edit</a>
            <a href="<?= site_url('student/delete/'.$student['id']); ?>" onclick="return confirm('Delete this student?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
