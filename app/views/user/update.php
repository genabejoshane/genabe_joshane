<h2>Edit User</h2>
<form method="post" action="<?= site_url('user/update/'.$user['id']); ?>">
  <label>Username:</label>
  <input type="text" name="username" value="<?= $user['username']; ?>" required><br>
  <label>Email:</label>
  <input type="email" name="email" value="<?= $user['email']; ?>" required><br>
  <button type="submit">Update</button>
</form>
