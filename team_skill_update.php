<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project");

if (!$con) {
    die('error in db' . mysqli_error($con));
}


// Variables to store form data
$skill_no = $skill_person = $team_skill_status = '';


// Fetch data for editing when the page loads
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check_query = "SELECT * FROM pr_team_skills WHERE pr_team_skill_id = $id";

    $check_query_sql = mysqli_query($con, $check_query);
    $count_check_query = mysqli_num_rows($check_query_sql);

    if ($count_check_query > 0) {
        $row                    = $check_query_sql->fetch_assoc();
        $skill_id               = $row['pr_team_skill_id'];
        $skill_no               = $row['pr_team_skill_no'];
        $skill_person           = $row['pr_team_skill_person'];
        $team_skill_status      = $row['pr_team_skill_status'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve form fields
    $skill_no               = $_POST['skill_no'];
    $skill_person           = $_POST['skill_person'];
    $team_skill_status      = $_POST['team_skill_status'];

    // Update data in the database
    $update_team_skill_query = "UPDATE pr_team_skills SET 
                                pr_team_skill_no          = '$skill_no', 
                                pr_team_skill_person      = '$skill_person', 
                                pr_team_skill_status      = '$team_skill_status'
                                
                            WHERE pr_team_skill_id = '$skill_id'";

    
    if (mysqli_query($con, $update_team_skill_query)) {
        echo'<script>alert("Team Skill Updated Successfully");</script>';
        header('location: skill_insert.php');
    } else {
        echo "Error: " . $update_team_skill_query . "<br>" . mysqli_error($con);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Team Skill</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="skill_id" value="<?php echo $skill_id; ?>">
        
        <label>Skill Number</label>
        <input type="number" name="skill_no" value="<?php echo $skill_no ?>" >
        <br><br>

        <label>Skill Person</label>
        <input type="number" name="skill_person" value="<?php echo $skill_person ?>" >
        <br><br>

        <label>Team Skill Status</label>
        <input type="number" name="team_skill_status" value="<?php echo $team_skill_status ?>" >
        <br><br>

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>


