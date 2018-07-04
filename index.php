<?php include('server.php'); 
    if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM user WHERE id=$id");

		if (mysqli_num_rows($record) == 1) {
			$n = mysqli_fetch_array($record);
			$name = $n['username'];
            $email = $n['email'];
            $password = $n['password'];
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRUD Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>

    <?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
    <?php endif ?>

    <?php $results = mysqli_query($db, "SELECT * FROM user"); ?>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Password</th>
                <th>Email</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        
        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                </td>
                <td>
                    <a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <form method="post" action="server.php">    

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="input-group">
            <label> Name: </lable>
            <input type="text" name="name" value="">
        </div>

        <div class="input-group"> 
            <label> Password: </label>
            <input type="password" name="password" value="">
        </div>

        <div class="input-group">
            <lable> Email: </label>
            <input type="text" name="email" value="">
        </div>

        <div class="input-group">
            <?php if($update == true): ?>
                <button class="btn" type="submit" name="update"> Update </button>
            <?php else: ?>
                <button class="btn" type="submit" name="save"> Save </button>
            <?php endif ?>
        </div>
    </form>

</body>
</html>