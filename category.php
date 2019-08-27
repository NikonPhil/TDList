<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files included in header1.php -->
        <?php include 'header1.php';?>
        <title>Category Management</title>
        
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
        <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4">
                <p>To add a new Category enter the name and submit</p>      
                      <form method="post">
                       <h3>Category</h3>
                        <input name = "cname" type = "text" id = "cname">   
                       <input type="submit" class="btn btn-info" 
                              value="Add Category">
                      </form>
              </div>
              <div class="col-sm-8">

              </div>
            </div>
        </div>
        <!-- Show the footer -->
        <?php include 'footer.php';
        ?>
    </body>
</html>
