<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Skills</title>
    <link rel="stylesheet" href="../Styles/Skill_insert.css">
  </head>
  <body>
  <form method="post" enctype="multipart/form-data">
    <div class="wrapper">
      <div class="form-row">
        <label for="pr_team_skill_no">Skill Number</label>
        <input type="number" name="pr_team_skill_no" id="pr_team_skill_no" placeholder="Enter Skill Number">
      </div>

      <div class="form-row">
        <label for="pr_team_skill_person">Skills Person</label>
        <input type="number" name="pr_team_skill_person" id="pr_team_skill_person" placeholder="Enter Skill Person">
      </div>

      <div class="form-row">
        <label for="pr_team_skill_status">Skill Status</label>
        <input type="number" name="pr_team_skill_status" id="pr_team_skill_status" placeholder="Enter Skill Status">
      </div>

      <div class="form-row">
        <label for="pr_skill_name">Skill Name</label>
        <input type="text" name="pr_skill_name" id="pr_skill_name" placeholder="Enter Skill Name">
      </div>

      <div class="form-row">
        <label for="pr_skill_status">Skill Status</label>
        <input type="number" name="pr_skill_status" id="pr_skill_status" placeholder="Enter Skill Status">
      </div>

      <div class="buttonSubmit">
        <input type="submit" name="submit" value="Submit">
      </div>
    </div>
    <h3>Team Skill Details</h3>
  <table>
    <tr>
      <th>#</th>
      <th>Skill Number</th>
      <th>Skills Person</th>
      <th>Skill Status</th>
      <th>Operations</th>
    </tr>

    <?php
      $i = 1;
      $select_all_team_skills_query = "SELECT * FROM pr_team_skills";
      $select_all_team_skills_query_sql = mysqli_query($con, $select_all_team_skills_query);
      $count_select_all_team_skills_query = mysqli_num_rows($select_all_team_skills_query_sql);

      if($count_select_all_team_skills_query  > 0){
        while ($row = $select_all_team_skills_query_sql -> fetch_assoc()) {
          $id = $row['pr_team_skill_id'];
    ?>

    <tr>
      <td><?php echo $i++ ?></td>
      <td><?php echo $row['pr_team_skill_no']?></td>
      <td><?php echo $row['pr_team_skill_person']?></td>
      <td><?php echo $row['pr_team_skill_status']?></td>
      <td class="operations">
        <a href="team_skill_update.php?id=<?php echo $id; ?>" class="edit-button">Edit</a>
        <a href="team_skill_delete.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" class="delete-button">Delete</a>
      </td>
    </tr>

    <?php 
        }
      }
    ?>
  </table>

  <h3>Skill Details</h3>
  <table>
    <tr>
      <th>#</th>
      <th>Skill Name</th>
      <th>Skill Status</th>
      <th>Operations</th>
    </tr>

    <?php
      $n = 1;
      $select_all_skills_query = "SELECT * FROM pr_skills";
      $select_all_skills_query_sql = mysqli_query($con, $select_all_skills_query);
      $count_select_all_skills_query = mysqli_num_rows($select_all_skills_query_sql);

      if($count_select_all_skills_query  > 0){
        while ($row = $select_all_skills_query_sql -> fetch_assoc()) {
          $id = $row['pr_skill_id'];
    ?>

    <tr>
      <td><?php echo $n++ ?></td>
      <td><?php echo $row['pr_skill_name']?></td>
      <td><?php echo $row['pr_skill_status']?></td>
      <td class="operations">
        <a href="skill_update.php?id=<?php echo $id; ?>" class="edit-button">Edit</a>
        <a href="skill_delete.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" class="delete-button">Delete</a>
      </td>
    </tr>

    <?php 
        }
      }
    ?>
  </table>
  </body>
</html>


<?php

    // Variables to store form data
    $skill_no = $skill_person = $team_skill_status = '';
    $skill_name  = $skill_status = '';


    if(isset($_POST['submit'])){

        $skill_no               = $_POST['pr_team_skill_no'];
        $skill_person           = $_POST['pr_team_skill_person'];
        $team_skill_status      = $_POST['pr_team_skill_status'];
        $skill_name             = $_POST['pr_skill_name'];
        $skill_status           = $_POST['pr_skill_status'];
        

        
        // Insert data into the database
        $insert_team_skill_query = "INSERT INTO pr_team_skills(
                                pr_team_skill_no, 
                                pr_team_skill_person, 
                                pr_team_skill_status
                            ) VALUES (
                                '$skill_no', 
                                '$skill_person', 
                                '$team_skill_status'
                            )";

        $insert_skill_query = "INSERT INTO pr_skills(
            pr_skill_name, 
            pr_skill_status
        ) VALUES (
            '$skill_name', 
            '$skill_status'
        )";



        if (mysqli_query($con, $insert_team_skill_query)) {
            echo'<script>alert("Skill Uploaded Successfully");</script>';
            header('location: skill_insert.php');
        } else {
            echo "Error: " . $insert_team_skill_query . "<br>" . mysqli_error($con);
        }

        if (mysqli_query($con, $insert_skill_query)) {
            echo'<script>alert("Skill Uploaded Successfully");</script>';
            header('location: skill_insert.php');
        } else {
            echo "Error: " . $insert_skill_query . "<br>" . mysqli_error($con);
        }
    
    }
?>

