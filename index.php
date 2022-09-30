<?php
// initialize errors variable
$errors = "";

// connect to database
$db = mysqli_connect("localhost", "root", "", "maaser");
//TODO fix the if statement
// insert to db if submit button is clicked
if (isset($_POST['submit'])) /*{
			if ((empty($_POST['source'])||($_POST['date_earned'])||($_POST['earned'])&&(empty($_POST['recipient'])&&($_POST['date_given'])&&($_POST['given'])))){
				$errors = "Looks like you left something out...";
			}elseif ((empty($_POST['recipient'])||($_POST['date_given'])||($_POST['given']))&&(empty($_POST['source'])&&($_POST['date_earned'])&&($_POST['earned']))){
				$errors = "Looks like you left something out...";
			}else*/ {
	//things to submit
	$source = $_POST['source'];
	$date_earned = $_POST['date_earned'];
	$earned = $_POST['earned'];
	$recipient = $_POST['recipient'];
	$date_given = $_POST['date_given'];
	$given = $_POST['given'];
	//make it submit
	$sql = "INSERT INTO maaser (source, date_earned, earned, recipient, date_given, given) VALUES ('$source', '$date_earned', '$earned', '$recipient', '$date_given', '$given')";
	$sql1 = "SELECT earned*.1 as maaser_owed FROM `maaser`;";
	mysqli_query($db, $sql);

	header('location: index.php');
	/*	}*/
};

?>

<!DOCTYPE html>
<html>

<head>
	<title>Maaser Tracker</title>
	<link rel="stylesheet" type="text/css" href="style.css?<?= time() ?>">
</head>

<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">Maaser Tracker</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
		<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>
		<p> Source: <input type="text" name="source" class="task_input"></p>
		<p>Date Earned: <input type="text" name="date_earned" class="task_input"></p>
		<p>Amount Earned: <input type="text" name="earned" class="task_input"></p>
		<p>Recipient: <input type="text" name="recipient" class="task_input"></p>
		<p>Date Given: <input type="text" name="date_given" class="task_input"></p>
		<p>Amount Given: <input type="text" name="given" class="task_input"></p>
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add to Database</button>
	</form>

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Source</th>
				<th>Date Earned</th>
				<th>Amount Earned</th>
				<th>Maaser Owed</th>
				<th>Recipient</th>
				<th>Date Given</th>
				<th>Amount Given</th>
				<th>Total</th>
			</tr>
		</thead>

		<tbody>
			<?php
			// select all tasks if page is visited or refreshed
			$maaser = mysqli_query($db, "SELECT * FROM maaser");
		/*  $sum = mysqli_query($db, "SELECT SUM(earned) as maaser_owed FROM `maaser`;");
			$full_amount = mysqli_fetch_assoc($sum);
			$divide = ($full_amount['maaser_owed'] * .1);
			echo $divide;
			$other_sum = mysqli_query($db, "SELECT SUM(given) as maaser_given FROM `maaser`;");
			//$minus = ($divide['maaser_owed'] - $other_sum['maaser_given']);*/

			$result = mysqli_query($db, 'SELECT SUM(earned) AS added_earned FROM maaser'); 
			$row = mysqli_fetch_assoc($result); 
			$sum = intval($row['added_earned']);//intval()turn it into a in!!! yayyyy!!
			echo $sum;





			$i = 1;
			while (($row = mysqli_fetch_array($maaser)) && ($owe = mysqli_fetch_array($minus))){
		
		?>
				<tr>
					<td> <?php echo $i; ?> </td>
					<td class="source"><?php echo $row['source']; ?></td>
					<td class="date_earned"><?php echo $row['date_earned']; ?></td>
					<td class="earned"><?php echo $row['earned']; ?></td>
					<td class="maaser_owed"><?php echo $owe['maaser_owed']; ?></td>
					<td class="recipient"><?php echo $row['recipient']; ?></td>
					<td class="date_given"><?php echo $row['date_given']; ?></td>
					<td class="given"><?php echo $row['given']; ?></td>
					<td class="total"><?php echo $minus;?></td>

			<?php $i++;
			}?> 
				
				</tr>
		</tbody>
	</table>
</body>

</html>