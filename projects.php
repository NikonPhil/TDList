<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <title>Add a new project to the database</title>
        <!-- <link rel="stylesheet" type="text/css" href="TDList.css"> -->
    </head>
    <body>
        <?php include 'header1.php'; ?>
        <div class="container-fluid">
        <h1>List of existing Projects</h1> 
        </div>
        <?php
        
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Project";                                                      // edit this line
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        } 
        
        // setup POST handling to add a new project
        if(isset($_POST['prname'])) {                                                // edit this line and change variable name
            print_r($_POST); // Added to test the _POST variable                    // to test variable handling, comment out later
            echo '<br>';                                                            // as above
            
            $project = $_POST['prname'];                                            // edit to change variable names
            $project_desc = $_POST['prdesc'];
            $sql = "INSERT INTO td_projects (idtd_projects, project_name, " .
                     "project_description) VALUES (NULL, '$project', " .
                     "'$project_desc')";                                   // edit to change variable names
            // echo $sql . "<br>";
            $result = mysqli_query($conn, $sql);
            
            if(! $result ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }           
            
            //echo $sql . "<br>"; // added to check construct of the sql statement
            //echo '<p>Variable Priority = ' . $priority . '</p><br>';
            }
        
        
        // setup query to select current data
        $sql = "SELECT project_name, project_description FROM td_projects;";                                  // Change sql table / field references
        // echo $sql . "<br>";      
        $result = mysqli_query($conn, $sql);
        
        // show current data in a table ?>
        <div class="container-fluid">
           <div class="row">
              <div class="col-sm-4">
                <table class="table table-bordered table-sm table-striped">
                  <thead class="thead-dark">
                    <th>Project</th>
                    <th>Project Description</th>
                </thead>
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['project_name'] . '</td>';
                    echo '<td>' . $row['project_description'] . '</td>';
                    echo '</tr>';
                    } ?>
                </table>
              </div>
             <div class="col-sm-8">
             </div>
          </div>
             <hr>
         </div>
        <?php
        // display form to add new data, (select a project)
        // set up query for category name.. ?>
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4">
                <p>To add a new project enter the name and description and submit</p>
                  <form method="post">
                      <h3>Project Name</h3>
                        <input name = "prname" type = "text">
                      <h3>Project Description</h3>
                        <input name="prdesc" type = "text">
                        <button type="button" class="btn btn-info" value="Add Project">Add Project</button> 
                  </form>
              </div>
            </div>
          </div>
        <?php  
            include 'footer.php'; 
        ?>
    
    </body>
</html>
