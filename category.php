<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files included in header1.php -->
        <?php include 'header1.php';?>
        <title>Category Management</title>
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
          <h1>List of existing Categories</h1> 
        </div>
        <!-- setup database connection, exit on failure
        <?php
        
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Category";
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        }
        
        // setup POST handling to add a new priority, called from within
        if(isset($_POST['cname'])) {                                    
            
            $category = $_POST['cname'];                                            
            $sql = "INSERT INTO td_category (idtd_category, category)" . 
                    "VALUES (NULL, '$category')";
            $result = mysqli_query($conn, $sql);

            if(! $result ) {
               die('Could not insert data: ' . mysqli_error($conn));
            }           
        } // End of POST handling
        
        
        // setup query to select current data
        $sql = "SELECT category FROM td_category";
                
        $result = mysqli_query($conn, $sql);
        if(! $result ) {
               die('Could not select data: ' . mysqli_error($conn));
            }
        ?>
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
                      echo '<td>' . $row['category'] . '</td>';
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
             <h5>To add a new Category enter the name and submit</h5>
            
            </div>
            <div class="t1">Category</div>
            <div class="v1">
             <input name = "cname" type = "text" id = "cname">
            </div>
            
            <div class="b2">
              <input type="submit" class="btn btn-info" 
                              value="Add Category">           
            </div>
         
        </div>
            </form>
        
        <!-- Show the footer -->
        <?php include 'footer.php';
        ?>
    </body>
</html>
