<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project");

if (!$con) {
    die('error in db' . mysqli_error($con));
}


// Variables to store form data
$skill_name = $skill_status = '';


// Fetch data for editing when the page loads
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check_query = "SELECT * FROM pr_skills WHERE pr_skill_id = $id";

    $check_query_sql = mysqli_query($con, $check_query);
    $count_check_query = mysqli_num_rows($check_query_sql);

    if ($count_check_query > 0) {
        $row                    = $check_query_sql->fetch_assoc();
        $skill_id               = $row['pr_skill_id'];
        $skill_name             = $row['pr_skill_name'];
        $skill_status           = $row['pr_skill_status'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve form fields
    $skill_name               = $_POST['skill_name'];
    $skill_status             = $_POST['skill_status'];

    // Update data in the database
    $update_skill_query = "UPDATE pr_skills SET 
                                pr_skill_name           = '$skill_name', 
                                pr_skill_status         = '$skill_status'
                                
                            WHERE pr_skill_id = '$skill_id'";

    
    if (mysqli_query($con, $update_skill_query)) {
        echo'<script>alert("Skill Updated Successfully");</script>';
        header('location: skill_insert.php');
    } else {
        echo "Error: " . $update_skill_query . "<br>" . mysqli_error($con);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Skill</title>
    <link rel="stylesheet" href="../Styles/skill_update.css">
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="skill_id" value="<?php echo $skill_id; ?>">
    
    <label for="skill_name">Skill Name</label>
    <input type="text" id="skill_name" name="skill_name" value="<?php echo $skill_name ?>" >
    
    <label for="skill_status">Skill Status</label>
    <input type="number" id="skill_status" name="skill_status" value="<?php echo $skill_status ?>" >
    
    <input type="submit" name="update" value="Update">
  </form>
</body>
</html>


