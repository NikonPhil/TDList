<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files added via header1.php -->
        <?php include 'td_header1.php'; ?>

        <title>Add a new project to the database</title>
    <style>
    
     .intro { grid-area: intro; }
     .t1 { grid-area: t1; text-align: right; }
     .v1 { grid-area: v1; text-align: left; }
     .t2 { grid-area: t2; text-align: right; }
     .v2 { grid-area: v2; text-align: left; }
     .b2 { grid-area: b2; text-align: center; }
     

    .wrapper {
      display: grid;
      width: 45%;
      grid-template-columns: 20px repeat(4,1fr) 20px;
      margin: 0 0 0 0;
      padding: 5px;
      gap: 30px;
      grid-template-areas:  'intro intro  intro  intro intro intro'
                            '.     t1     v1     t2    t2    v2'
                            '.     b2     .      .     .     .';
    }
    
    </style>
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
        <!-- Setup the add new filename area using CSS Grid -->
        <form method="post">
            
        <div class="wrapper">
         
            <div class="intro">
             <h5>To add a new project enter the name and description and submit</h5>
            
            </div>
            <div class="t1">Project Name</div>
            <div class="v1">
             <input name="prname" type="text">
            </div>
            <div class="t2">
             Project Description
            </div>
            <div class="v2">
             <input name="prdesc" type="text">
            </div>
            <div class="b2">
              <input type="submit" class="btn btn-info" value="Add Project">           
            </div>
         
        </div>
            </form>
        
        <!-- Set up the footer -->
        <?php  
            include 'td_footer.php'; 
        ?>
    
    </body>
</html>
