<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files added via header1.php -->
        <?php include 'td_header1.php'; ?>
        
        <title>Priority data</title>
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
                            '.     t1     v1     .     .     .'
                            '.     b2     .      .     .     .';
    }
    
    </style>    
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
        <!-- Setup the add new priority area using CSS Grid -->
        <form method="post">
            
        <div class="wrapper">
         
            <div class="intro">
             <h5>To add a new Priority enter the name and submit</h5>
            
            </div>
            <div class="t1">Priority</div>
            <div class="v1">
             <input name = "pname" type = "text" id = "pname">
            </div>
            
            <div class="b2">
              <input type="submit" class="btn btn-info" value="Add Priority">          
            </div>
         
        </div>
        </form>
        
        <!-- Set up the footer -->
       <?php  
            include 'td_footer.php'; 
       ?>
    </body>
</html>
