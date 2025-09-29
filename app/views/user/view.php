<h1>Welcome to Profile View</h1>
<div style="width: 85%; margin: 0 auto 25px auto; text-align: right;">
	<a href="<?= site_url('user/create'); ?>" class="create-btn">+ Create New User</a>
</div>
<table>
	<tr>
		<th>ID</th>
		<th>Username</th>
		<th>Email</th>
		<th>Action</th>
	</tr>
	<?php foreach ($users as $user): ?>
		<tr>
			<td><?= $user['id']; ?></td>
			<td><?= $user['username']; ?></td>
			<td><?= $user['email']; ?></td>
			<td>
				<a href="<?= site_url('user/update/'.$user['id']); ?>" class="action-btn edit-btn">Edit</a>
				<a href="<?= site_url('user/delete/'.$user['id']); ?>" class="action-btn delete-btn" onclick="return confirm('Delete this user?');">Delete</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<?= isset($pagination) ? $pagination : ''; ?>
