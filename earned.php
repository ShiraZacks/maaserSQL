<!-- 
*here we put money people earned. we could have the stuff from temporary page here.
*need place to enter reason, money, and then puts it in a chart.
*chart should have an addition feature that adds everything up and should also have a
*division thing so it gives how much maaser one owes.
-->

<!-- maybe have only one page because want the data to be in one page... -->
<?php
//insert to database if submit button is clicked
if (isset($_POST['submit'])) {
    if (empty($_POST['task'])) {
        $errors = "Write the asignment!";
    }elseif(empty($_POST['due'])) {
        $errors = "Pick a due date!";
    }else{
            //first thing to submit
    $task = $_POST['task'];
            //second thing to submit
    $due = $_POST['due'];
            //make it submit
    $sql = "INSERT INTO tasks (due, task) VALUES ('$due', '$task')";

    mysqli_query($db, $sql);
    header('location: index.php');
}
};

?>