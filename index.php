<?php
// initialize errors variable
$errors = "";

// connect to database
$db = mysqli_connect("localhost", "root", "", "maaser");
// insert to db if submit button is clicked
if (isset($_POST['submit'])) {
	if ((empty($_POST['source']) || ($_POST['date_earned']) || ($_POST['earned'])) && (empty($_POST['recipient']) && ($_POST['date_given']) && ($_POST['given']))) {
		$errors = "Looks like you left something out...";
	} elseif ((empty($_POST['recipient']) || ($_POST['date_given']) || ($_POST['given'])) && (empty($_POST['source']) && ($_POST['date_earned']) && ($_POST['earned']))) {
		$errors = "Looks like you left something out...";
	} else {
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
	}
};
?>

<!DOCTYPE html>
<html>

<head>
	<title>Maaser Tracker</title>
	<link rel="stylesheet" type="text/css" href="style.css?<?= time() ?>">
	<link rel="shortcut icon" type="image/jpeg" href="favicon.jpg" />

</head>

<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">Maaser Tracker</h2>
	</div>
	<form method="post" action="index.php" class="input_form" autocomplete="off">
		<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>
		<p>Source: <input type="text" name="source" class="task_input"></p>
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
				<th>Recipient</th>
				<th>Date Given</th>
				<th>Amount Given</th>
			</tr>
		</thead>

		<tbody>
			<?php
			// select all tasks if page is visited or refreshed
			$maaser = mysqli_query($db, "SELECT * FROM maaser");

			$result = mysqli_query($db, 'SELECT SUM(earned) AS added_earned FROM maaser');
			$row = mysqli_fetch_assoc($result);
			$earned_sum = floatval($row['added_earned']); //intval()turn it into a int!!! yayyyy!!  except that doesnt have decimals. floatval does
			$other_result = mysqli_query($db, "SELECT SUM(given) as added_given FROM `maaser`;");
			$row2 = mysqli_fetch_assoc($other_result);
			$given_sum = floatval($row2['added_given']);
			$divide = ($earned_sum / 10);
			$combined = ($divide - $given_sum);

			//s		echo "$earned_sum <br> $given_sum <br> $divide <br> $combined";



			$i = 1;
			while (($row = mysqli_fetch_array($maaser))) {

			?>
				<tr>
					<td> <?php echo $i; ?> </td>
					<td class="source"><?php echo $row['source']; ?></td>
					<td class="date_earned"><?php echo $row['date_earned']; ?></td>
					<td class="earned"><?php echo $row['earned']; ?></td>
					<td class="recipient"><?php echo $row['recipient']; ?></td>
					<td class="date_given"><?php echo $row['date_given']; ?></td>
					<td class="given"><?php echo $row['given']; ?></td>

				</tr><?php $i++;
					} ?>
		</tbody>
	</table>

	<p class="maaser_owed">Maaser To Date: <?php echo $divide; ?></p>
	<p class="total">Amount Owed:<?php echo $combined; ?></p>



</body>

</html>