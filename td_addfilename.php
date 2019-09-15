<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files included in header1.php -->
         <?php include 'td_header1.php'; ?>
        <title>Add a new filename to the database</title>
     <style>
    
     .intro { grid-area: intro; }
     .t1 { grid-area: t1; text-align: right; }
     .v1 { grid-area: v1; text-align: left; }
     .t2 { grid-area: t2; text-align: right; }
     .v2 { grid-area: v2; text-align: left; }
     .b2 { grid-area: b2; text-align: center; }
     

    .wrapper {
      display: grid;
      width: 30%;
      grid-template-columns: 20px repeat(4,1fr) 20px;
      margin: 0 0 0 0;
      padding: 5px;
      gap: 30px;
      grid-template-areas:  'intro intro  intro  intro intro intro'
                            '.     t1     v1     t2    v2    .'
                            '.     b2     .      .     .     .';
    }
    
    </style>
    </head>
    <body>
        <div class="container-fluid">
            <h1>List of existing filenames</h1>
        </div>
<?php

        // Setup database connection and exit if there is a problem
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Filename";
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        }

        // setup POST handling to add a new project. Using the project ID and
        // the new filename add them to the database.
        if(isset($_POST['pid'])) {
            $projectID = $_POST['pid'];
            $filename = $_POST['fname'];
            $sql = "INSERT INTO td_filename (idtd_filename, filename, " .
                     "idtd_project) VALUES (NULL, '$filename', " .
                     "'$projectID')";
            echo $sql . "<br>";
            $result = mysqli_query($conn, $sql);
            if(!$result ) {
               die('Could not insert data: ' . mysqli_error($conn));
             }
            } // End of the Post Handling
            
            // Setup the current table
            $sql = "SELECT td_filename.filename, "
                                . "td_projects.idtd_projects, "
                                . "td_projects.project_name FROM td_filename "
                                . "RIGHT JOIN td_projects ON "
                                . "td_filename.idtd_project = "
                                . "td_projects.idtd_projects";

            $result = mysqli_query($conn, $sql);
            if(!$result ) {
               die('Could not select data: ' . mysqli_error($conn));
             }
             $row = mysqli_fetch_array($result);
         ?>
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
        <!-- Setup the add new filename area using CSS Grid -->
        <form method="post">
            
        <div class="wrapper">
         
            <div class="intro">
             <h5>To add a new Filename select the project, enter the name
                              and submit</h5>
            
            </div>
            <div class="t1">Project</div>
            <div class="v1">
             <?php
                $sql1 = "SELECT idtd_projects, project_name FROM "
                    . "td_projects";
                $result = mysqli_query($conn, $sql1);
                // $row = mysqli_fetch_array($result);
                echo '<select name="pid">';
                    foreach ($result as $row) {
                    echo "<option value=\"{$row['idtd_projects']}\">"
                        . "{$row['project_name']}</option>";
                    }
                echo "</select>";
             ?>
            </div>
            <div class="t2">
             Filename
            </div>
            <div class="v2">
             <input name = "fname" type = "text" id = "fname">
            </div>
            <div class="b2">
              <input type="submit" class="btn btn-info" 
                                         value="Add Filename">           
            </div>
         
        </div>
            </form>
        <!-- Add the footer code -->
        <?php include 'td_footer.php'; ?>
    </body>
</html>
