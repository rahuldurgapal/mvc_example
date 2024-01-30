<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Student Panel</h1>
<p>Welcome, <?php echo $_SESSION['username']; ?>!</p>

<h2>Your Courses</h2>
<p><?php echo $user['courses']; ?></p>

<h2>Your Class</h2>
<p><?php echo $user['class']; ?></p>

<h2>Edit Your Profile</h2>
<form method="post" action="index.php?action=panel">
    <label for="courses">Courses:</label>
    <input type="text" id="courses" name="courses" value="<?php echo $user['courses']; ?>" required>

    <label for="class">Class:</label>
    <input type="text" id="class" name="class" value="<?php echo $user['class']; ?>" required>

    <button type="submit">Update Profile</button>
</form>

<a href="index.php?action=logout">Logout</a>

</body>
</html>