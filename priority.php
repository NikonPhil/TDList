<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files added via header1.php -->
        <?php include 'header1.php'; ?>
        
        <title>Priority data</title>
        
    </head>
    <body>
        
       
       <div class="container-fluid">
        <h1>List of existing Priorities</h1> 
        </div>
        <?php
        // Setup database connection
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Priority";
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        } 
        // setup POST handling to add a new priority
        if(isset($_POST['pname'])) {
            
            $priority = $_POST['pname'];
            $sql = "INSERT INTO td_priority (idtd_priority, priority)" . 
                    "VALUES (NULL, '$priority')";
            $result = mysqli_query($conn, $sql);

            if(! $result ) {
               die('Could not insert data: ' . mysqli_error($conn));
            }           
            
        } // End of Post processing
        
        
        // setup query to select current data
        $sql = "SELECT priority FROM td_priority";
                
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
                    <th>Status</th>                                                
                  </thead>
                    <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                             echo '<td>' . $row['priority'] . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
              </div>
              <div class="col-sm-8">
               <!-- dummy cell to maintain spacing -->
              </div>
           </div>
          </div>
           <hr>
         </div>
        <!-- Setup the section for adding a new priority -->
        <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4">
                <p>To add a new priority enter the name and submit</p>      
                      <form method="post">
                       <h3>Priority</h3>
                        <input name = "pname" type = "text" id = "pname">   
                        <input type="submit" class="btn btn-info" value="Add Priority">
                      </form>
              </div>
              <div class="col-sm-8">
                  <!-- dummy cell to maintain spacing -->
              </div>
            </div>
        </div>
        <!-- Set up the footer -->
       <?php  
            include 'footer.php'; 
       ?>
    </body>
</html>
