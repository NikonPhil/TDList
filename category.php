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
        <title>Category Management</title>
        <!-- <link rel="stylesheet" type="text/css" href="TDList.css"> -->
    </head>
    <body>
        <?php include 'header1.php';?>
        <div class="container-fluid">
          <h1>List of existing Projects</h1> 
        </div>
        <?php
        
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Category";                                                      // edit this line
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        } else {
            echo '';
        }
        // setup POST handling to add a new priority
        if(isset($_POST['cname'])) {                                                // edit this line and change variable name
            // print_r($_POST); // Added to test the _POST variable                    // to test variable handling, comment out later
            // echo '<br>';                                                            // as above
            
            $category = $_POST['cname'];                                            // edit to change variable names
            $sql = "INSERT INTO td_category (idtd_category, category)" . 
                    "VALUES (NULL, '$category')";                                   // edit to change variable names
            $result = mysqli_query($conn, $sql);

            if(! $result ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }           
            
            //echo $sql . "<br>"; // added to check construct of the sql statement
            //echo '<p>Variable Priority = ' . $priority . '</p><br>';
        } else { // Or display the current table with an option to add a priority
            echo '<P></p>';
        }
        
        
        // setup query to select current data
        $sql = "SELECT category FROM td_category";                                  // Change sql table / field references
                
        $result = mysqli_query($conn, $sql);
        
        // show current data in a table ?>
        <!-- Show current data. -->
        <div class="container-fluid">
          <div style="height: 450px; max-height:450px; overflow-y: scroll">
           <div class="row">
              <div class="col-sm-4">
                <table class="table table-bordered table-sm table-striped">
                  <thead class="thead-dark">
                    <th>Category</th>                                                
                  </thead>
            <?php
          while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
              echo '<td>' . $row['category'] . '</td>';                             // Change variable name
              // echo '<td>' . $row['filename'] . '</td>';
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
                <p>To add a new Category enter the name and submit</p>      
                      <form method="post">
                       <h3>Category</h3>
                        <input name = "cname" type = "text" id = "cname">   
                       <button type="button" class="btn btn-info" value="Add Category">Add Category</button>
                      </form>
              </div>
              <div class="col-sm-8">

              </div>
            </div>
        </div>
        <?php include 'footer.php';
        ?>
    </body>
</html>
