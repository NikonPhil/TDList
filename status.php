<!DOCTYPE html>

<html>
  <head>
      <!-- CSS files added via header1.php -->
      <?php include 'header1.php'; ?>
      
    <title>Status Page</title>
            
  </head>
  <body>
      
    <div class="container-fluid">
      <h1>List of existing Statuses</h1> 
    </div>
    <!-- Connect to database or exit -->    
        <?php
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Status";
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        }
        
        // setup POST handling to add a new priority
        if(isset($_POST['sname'])) {
            
            $status = $_POST['sname'];
            $sql = "INSERT INTO td_status (idtd_status, td_status)" . 
                    "VALUES (NULL, '$status')";
            $result = mysqli_query($conn, $sql);

            if(! $result ) {
               die('Could not insert data: ' . mysqli_error($conn));
            }           
        } // End of POST processing
        
        
        // setup query to select current data
        $sql = "SELECT td_status FROM td_status";
                
        $result = mysqli_query($conn, $sql);
        if(! $result ) {
               die('Could not select data: ' . mysqli_error($conn));
            }
        ?>
        <!-- show current data in a table -->
       <div class="container-fluid">
         <div style="height: 450px; max-height:450px; overflow-y: scroll">
           <div class="row">
              <div class="col-sm-4">
                <table class="table table-bordered table-sm table-striped">
                  <thead class="thead-dark">
                    <th>Status</th>                                                
                  </thead>
                    <?php
                        while ($row = mysqli_fetch_array($result)) {
                          echo '<tr>';
                            echo '<td>' . $row['td_status'] . '</td>';
                          echo '</tr>';
                        }
                    ?>
                </table>
              </div>
           <div class="col-sm-8">
               <!-- Dummy cell to maintain layout -->
           </div>
          </div>
         </div>
          <hr>
        </div>

        <!-- display form to add new data, (select a status) -->       
        <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4">
                    <p>To add a new status enter the name and submit</p>                                                 
                        <form method="post"> 
                            <h3>Status</h3>
                                <input name ="sname" type="text" id="sname">
                           <input type="submit" class="btn btn-info" 
                                  value="Add Status"> 
                        </form>       
              </div>
              <div class="col-sm-8">
                 <!-- Dummy cell to maintain layout --> 
              </div>
            </div>
        </div>
        <!-- Setup footer display -->
        <?php  include 'footer.php'; ?>
    </body>
</html>

