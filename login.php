<?php
//login.php

include('database_connection.php');

// if(isset($_SESSION['type']))
// {
// 	header("location:index.php");
// }

$message = '';

if(isset($_POST["login"]))
{
	if (empty($_POST['user_email']) || empty($_POST['user_password'])) {
		$message = "Username or Password is invalid";
	}
	else {
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];

		$user_email = mysqli_real_escape_string($connect, $user_email);
		$user_password = mysqli_real_escape_string($connect, $user_password);

		$query = mysqli_query($connect, "SELECT * FROM user_details WHERE user_email = '$user_email'");
		// $statement = $connect->prepare($query);
		// $statement->execute();
		
		$rowCount = mysqli_num_rows($query);
		if($rowCount == 1)
		{
			// $result = $statement->get_result();
			// $result_data = $result->fetch_all(MYSQLI_ASSOC);
			$result = mysqli_fetch_assoc($query);
			// print_r($result["user_email"]);
			if($result["user_status"] == 'Active')
			{
				
				// $pass_verify = password_verify($user_password, $result["user_password"]);
				// var_dump($pass_verify);
				if($user_password == $result["user_password"])
				{
				
					$_SESSION['type'] = $result['user_type'];
					$_SESSION['user_id'] = $result['user_id'];
					$_SESSION['user_name'] = $result['user_name'];
					header("location: index.php");
				}
				else
				{
					$message = "<label>Wrong Password</label>";
				}
			}
			else
			{
				$message = "<label>Your account is disabled, Contact Master</label>";
			}
		}
		else
		{
			$message = "<label>Wrong Email Address</labe>";
		}

	}


	
	
	// $params = array('ss', $_POST["user_email"]);
	// $tmp = array();
	// foreach ($params as $key => $value) {
	// 	$tmp[$key] = &$params[$key];
	// }
	// call_user_func_array(array($statement, 'bind_param'), $tmp);
	// $statement->execute();
	
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Inventory Management System using PHP with Ajax Jquery</title>		
		<script src="js/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h2 align="center">Inventory Management System using PHP with Ajax Jquery</h2>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					<form method="post">
						<?php echo $message; ?>
						<div class="form-group">
							<label>User Email</label>
							<input type="text" name="user_email" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="user_password" class="form-control" required />
						</div>
						<div class="form-group">
							<input type="submit" name="login" value="Login" class="btn btn-info" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>