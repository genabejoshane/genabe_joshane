<h1>Update Student</h1>
<form method="post">
    <label>Name:</label>
    <input type="text" name="name" value="<?= $student['name']; ?>" required><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?= $student['email']; ?>" required><br>
    <button type="submit">Update</button>
</form>
