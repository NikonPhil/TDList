<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files added via header1.php -->
        <?php include 'header1.php'; ?>

        <title>Add a new project to the database</title>

    </head>
    <body>
        <div class="container-fluid">
        <h1>List of existing Projects</h1> 
        </div>
        <?php
        // Connect to database or exit
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Project";
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        } 
        
        // setup POST handling to add a new project
        if(isset($_POST['prname'])) {
            
            $project = $_POST['prname'];
            $project_desc = $_POST['prdesc'];
            $sql = "INSERT INTO td_projects (idtd_projects, project_name, " .
                     "project_description) VALUES (NULL, '$project', " .
                     "'$project_desc')";

            $result = mysqli_query($conn, $sql);
            
            if(! $result ) {
               die('Could not insert data: ' . mysqli_error($conn));
            }           
        } // End of POST processing
        
        
        // setup query to select current data
        $sql = "SELECT project_name, project_description FROM td_projects;";                                  // Change sql table / field references
             
        $result = mysqli_query($conn, $sql);
        if(! $result ) {
               die('Could not select data: ' . mysqli_error($conn));
            }  
        // show current data in a table ?>
        <div class="container-fluid">
          <div style="height: 450px; max-height:450px; overflow-y: scroll">
           <div class="row">
              <div class="col-sm-5">
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
             <div class="col-sm-7">
             </div>
           </div>
          </div>
           <hr>
         </div>
        
        <!-- display form to add new data, (select a project) -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4">
                <p>To add a new project enter the name and description and submit</p>
                  <form method="post">
                      <h3>Project Name</h3>
                        <input name="prname" type="text">
                      <h3>Project Description</h3>
                        <input name="prdesc" type="text">
                        <input type="submit" class="btn btn-info" value="Add Project"> 
                  </form>
              </div>
            </div>
          </div>
        <!-- Set up the footer -->
        <?php  
            include 'footer.php'; 
        ?>
    
    </body>
</html>
