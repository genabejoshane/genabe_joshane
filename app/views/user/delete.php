<h2>Delete User</h2>
<p>Are you sure you want to delete user <strong><?= $user['username']; ?></strong>?</p>
<form method="post" action="<?= site_url('user/delete/'.$user['id']); ?>">
  <button type="submit">Delete</button>
  <a href="<?= site_url('user/view'); ?>">Cancel</a>
</form>
