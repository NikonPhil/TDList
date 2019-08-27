<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files included in the header1.php file -->
         <?php include 'header1.php'; ?>
        <title>Class Management</title>
        
    </head>
    <body>
        
        <div class="container-fluid">
        <h1>List of existing Classes</h1> 
        </div>
        <!-- Setup the database connection or exit -->
       <?php
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Classes";
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        }
        // setup POST handling to add a new class
        if(isset($_POST['clname'])) {
            
            $class = $_POST['clname'];
            $sql = "INSERT INTO td_class (idtd_class, class)" . 
                    "VALUES (NULL, '$class')";
            $result = mysqli_query($conn, $sql);

            if(! $result ) {
               die('Could not insert data: ' . mysqli_error($conn));
            }             
        } 
        
        
        // setup query to display current data
        $sql = "SELECT class FROM td_class";
                
        $result = mysqli_query($conn, $sql);
        if(! $result ) {
               die('Could not select data: ' . mysqli_error($conn));
            }
        // show current data in a table ?>
        <div class="container-fluid">
         <div style="height: 450px; max-height:450px; overflow-y: scroll">
           <div class="row">
              <div class="col-sm-4">
                <table class="table table-bordered table-sm table-striped">
                  <thead class="thead-dark">
                    <th>Classes</th>                                                
                  </thead>
                    <?php
                        while ($row = mysqli_fetch_array($result)) {
                          echo '<tr>';
                            echo '<td>' . $row['class'] . '</td>';
                            // echo '<td>' . $row['filename'] . '</td>';
                          echo '</tr>';
                        } ?>
                </table>
              </div>
               <div class="col-sm-8">

               </div>
           </div>
         </div>
           <hr>
        </div>

       <!-- display form to add new data, (select a project)
        set up query for project name.. -->
        <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4">
                    <p>To add a new Class enter the name and submit</p>
                    <form method="post"> 
                        <h3>Classes</h3>
                           <input name ="clname" type="text" id="clname">
                           <input type="submit" class="btn btn-info" value="Add Class">
                    </form>
              </div>
            </div>
        </div>
       <!-- Display the footer -->
      <?php  include 'footer.php';?>  
    </body>
</html>