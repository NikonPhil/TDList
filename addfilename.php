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
        <title>Add a new filename to the database</title>
        <!-- <link rel="stylesheet" type="text/css" href="TDList.css"> -->
    </head>
    <body>
        <?php include 'header1.php';
        // put your code here
        echo '<h1>List of existing filenames</h1>';                                // edit this line
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Filename";                                                      // edit this line
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        } 
        
        // setup POST handling to add a new project
        if(isset($_POST['pid'])) {                                                // edit this line and change variable name
            // print_r($_POST); // Added to test the _POST variable                    // to test variable handling, comment out later
            // echo '<br>';                                                            // as above
            
            $projectID = $_POST['pid'];                                            // edit to change variable names
            $filename = $_POST['fname'];
            $sql = "INSERT INTO td_filename (idtd_filename, filename, " .
                     "idtd_project) VALUES (NULL, '$filename', " .
                     "'$projectID')";                                   // edit to change variable names
            echo $sql . "<br>";
            $result = mysqli_query($conn, $sql);
            
            if(! $result ) {
               die('Could not enter data: ' . mysqli_error($conn));
             }           
            }
        $sql = "SELECT td_filename.filename, "
                                . "td_projects.idtd_projects, "
                                . "td_projects.project_name FROM td_filename "
                                . "RIGHT JOIN td_projects ON "
                                . "td_filename.idtd_project = "
                                . "td_projects.idtd_projects";                                 // Change sql table / field references
        
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        // var_dump($row);
        // echo '<br>';
        // $new = array_column($row, 'project_name');
        // var_dump($new);
        // Die();
        // show current data in a table ?>
        <!-- Show current data. -->
        <div class="container-fluid">
          <div style="height: 450px; max-height:450px; overflow-y: scroll">
           <div class="row">
              <div class="col-sm-4">
                <table class="table table-bordered table-sm table-striped">
                  <thead class="thead-dark">
                    <th>Project</th>
                    <th>Filename</th>                                                
                  </thead>
            <?php
            
          while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
              echo '<td>' . $row['project_name'] . '</td>';
              echo '<td>' . $row['filename'] . '</td>';
            echo '</tr>';
          }
          ?>
                </table>
              </div>
           </div>
          </div>
            <hr>
        </div>
        
        
        <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4">
                <p>To add a new Filename select the project, enter the name and submit</p>      
                      <form method="post">
                       <h3>Project</h3>
                       <?php
                        $sql1 = "SELECT idtd_projects, project_name FROM td_projects";
                        $result = mysqli_query($conn, $sql1);
                        // $row = mysqli_fetch_array($result);
                        echo '<select class="sel" name="sname">';
                        foreach ($result as $row) {
                        echo "<option value=\"{$row['idtd_projects']}\">"
                            . "{$row['project_name']}</option>";
                        }
                        echo "</select>";
                        ?>
                       <h3>Filename</h3> 
                        <input name = "fname" type = "text" id = "fname">   
                       <button type="button" class="btn btn-info" value="Add Category">Add Filename</button>
                      </form>
              </div>
              <div class="col-sm-8">

              </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
       
    </body>
</html>
