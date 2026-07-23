<?php
require_once("inc/config.php");

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);

    // Get image path
    $result = mysqli_query($db, "SELECT candidate_photo FROM candidate_details WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);

    if($row)
    {
        if(file_exists($row['candidate_photo']))
        {
            unlink($row['candidate_photo']);
        }

        mysqli_query($db, "DELETE FROM candidate_details WHERE id='$id'");

        header("Location: index.php?addCandidatePage=1&deleted=1");

        exit();
    }
}
?>