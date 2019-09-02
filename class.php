<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files included in the header1.php file -->
         <?php include 'header1.php'; ?>
        <title>Class Management</title>
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
        <!-- Setup the add new filename area using CSS Grid -->
        <form method="post">
            
        <div class="wrapper">
         
            <div class="intro">
             <h5>To add a new Class enter the name and submit</h5>
            
            </div>
            <div class="t1">Classes</div>
            <div class="v1">
             <input name ="clname" type="text" id="clname">
            </div>
            
            <div class="b2">
              <input type="submit" class="btn btn-info" value="Add Class">           
            </div>
         
        </div>
        </form>
       
       <!-- Display the footer -->
      <?php  include 'footer.php';?>  
    </body>
</html>