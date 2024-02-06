<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project");

if (!$con) {
    die('error in db' . mysqli_error($con));
}


$id = $_GET['id'];

$delete_team_skill_query = "DELETE FROM pr_team_skills WHERE pr_team_skill_id = $id";

if (mysqli_query($con, $delete_team_skill_query)) {
    echo '<script>alert("Team Skill Deleted Successfully");</script>';
    header('location: skill_insert.php');
} else {
    echo mysqli_error($con);
}

?>