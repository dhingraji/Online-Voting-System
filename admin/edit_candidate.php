<?php
require_once("<inc/config.php");

$id = $_GET['id'];

$result = mysqli_query($db,"SELECT * FROM candidate_details WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $name = mysqli_real_escape_string($db,$_POST['candidate_name']);
    $details = mysqli_real_escape_string($db,$_POST['candidate_details']);

    mysqli_query($db,"UPDATE candidate_details
                      SET candidate_name='$name',
                          candidate_details='$details'
                      WHERE id='$id'");

    header("Location: index.php?addCandidatePage=1&updated=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Candidate</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">

<h3>Edit Candidate</h3>

<form method="POST">

<div class="form-group">
<label>Candidate Name</label>
<input type="text"
       name="candidate_name"
       class="form-control"
       value="<?php echo $row['candidate_name']; ?>">
</div>

<div class="form-group">
<label>Candidate Details</label>
<input type="text"
       name="candidate_details"
       class="form-control"
       value="<?php echo $row['candidate_details']; ?>">
</div>

<br>

<input type="submit"
       name="update"
       class="btn btn-success"
       value="Update Candidate">

<a href="index.php?addCandidatePage=1" class="btn btn-secondary">Cancel</a>

</form>

</div>

</body>
</html>