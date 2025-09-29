<h2>Create New User</h2>
<form method="post" action="<?= site_url('user/create'); ?>">
	<label>Username:</label>
	<input type="text" name="username" required><br>
	<label>Email:</label>
	<input type="email" name="email" required><br>
	<button type="submit">Create</button>
</form>
