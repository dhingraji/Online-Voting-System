<?php
require_once("inc/config.php");
session_start();
if (!isset($_GET['id'])) {
    die("Invalid Election ID");
}

$id = intval($_GET['id']);

$result = mysqli_query($db, "SELECT * FROM elections WHERE id='$id'");

if (mysqli_num_rows($result) == 0) {
    die("Election not found");
}

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $topic = mysqli_real_escape_string($db, $_POST['topic']);
    $candidates = mysqli_real_escape_string($db, $_POST['candidates']);
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $status = $_POST['status'];

    mysqli_query($db,"UPDATE elections SET
        election_topic='$topic',
        no_of_candidates='$candidates',
        starting_date='$start',
        ending_date='$end',
        status='$status'
        WHERE id='$id'");

    header("Location:index.php?addElectionPage=1&updated=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Election</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
<h2>Edit Election</h2>

<form method="POST">

<label>Election Name</label>
<input type="text" name="topic" class="form-control"
value="<?php echo $row['election_topic']; ?>" required><br>

<label>No. of Candidates</label>
<input type="number" name="candidates" class="form-control"
value="<?php echo $row['no_of_candidates']; ?>" required><br>

<label>Starting Date</label>
<input type="date" name="start_date" class="form-control"
value="<?php echo $row['starting_date']; ?>" required><br>

<label>Ending Date</label>
<input type="date" name="end_date" class="form-control"
value="<?php echo $row['ending_date']; ?>" required><br>

<label>Status</label>
<select name="status" class="form-control">
    <option value="Active" <?php if($row['status']=="Active") echo "selected"; ?>>Active</option>
    <option value="InActive" <?php if($row['status']=="InActive") echo "selected"; ?>>InActive</option>
    <option value="Expired" <?php if($row['status']=="Expired") echo "selected"; ?>>Expired</option>
</select>

<br>

<input type="submit" name="update" value="Update Election" class="btn btn-success">
<a href="index.php?addElectionPage=1" class="btn btn-secondary">Cancel</a>

</form>

</div>

</body>
</html>