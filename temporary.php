<?php
require "dbconnect.php";


// insert to db if submit button is clicked
if (isset($_POST['submit'])) {
    if (empty($_POST['gotFrom'])) {
        $errors = "Where is the money from?";
    } elseif (empty($_POST['amount'])) {
        $errors = "How much did you get paid?";
    } else {
        //first thing to submit
        $gotFrom = $_POST['gotFrom'];
        //second thing to submit
        $amount = $_POST['amount'];
        //make it submit
        $sql = "INSERT INTO gotFromList (amount, gotFrom) VALUES ('$amount', '$gotFrom')";

        mysqli_query($db, $sql);
        header('location: index.php');
    }
};

// delete gotFrom
if (isset($_GET['del_gotFrom'])) {
    $id = $_GET['del_gotFrom'];

    mysqli_query($db, "DELETE FROM gotFromList WHERE id=" . $id);
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MAASER CALCULATOR</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?=time()?>">
</head>
<body>
	<div class="heading">
		<h2>Maaser Calculation</h2>
		<h4>You do the money, we do the math</h4>
	</div>
	<form method="post" action="index.php" class="input_form">
	<?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
	<?php } ?>
        <p> Where is the payment from? <input type="text" name="gotFrom" class="gotFrom_input"></p>
		<p>Amount: <input type="text" name="amount"	class="gotFrom_input"></p>
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Payment</button>
	</form>
    
<table>
	<thead>
		<tr>
			<th>Date Entered<th>
			<th>Payment From</th>
			<th>Amount</th>
			<th style="width: 60px;">Clear Entry</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all gotFromList if page is visited or refreshed
		$gotFromList = mysqli_query($db, "SELECT * FROM gotFromList");

		$i = 1; while ($row = mysqli_fetch_array($gotFromList)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="gotFrom"><?php echo $row['gotFrom'];?></td>
				<td class="amount"><?php echo $row['amount'];?></td>
				<td class="delete"><a href="index.php?del_gotFrom=<?php echo $row['ID'] ?>">X</a></td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
</body>
</html>