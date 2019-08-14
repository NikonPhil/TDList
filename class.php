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
        <title>Class Management</title>
        <!-- <link rel="stylesheet" type="text/css" href="TDList.css"> -->
    </head>
    <body>
        <?php include 'header1.php'; 
        // put your code here ?>
        <div class="container-fluid">
        <h1>List of existing Classes</h1> 
        </div>
       <?php
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Classes";
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        } else {
            echo '';
        }
        // setup POST handling to add a new priority
        if(isset($_POST['clname'])) {
            // print_r($_POST); // Added to test the _POST variable
            //echo '<br>';
            // $filename = $_POST['filename'];
            $class = $_POST['clname'];
            $sql = "INSERT INTO td_class (idtd_class, class)" . 
                    "VALUES (NULL, '$class')";
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
        $sql = "SELECT class FROM td_class";
                
        $result = mysqli_query($conn, $sql);
        
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

       <!--
        // display form to add new data, (select a project)
        // set up query for project name.. -->
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
      <?php  include 'footer.php'; ?>  
    </body>
</html>