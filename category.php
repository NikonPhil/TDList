<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stub for category data</title>
        <link rel="stylesheet" type="text/css" href="TDList.css">
    </head>
    <body>
        <?php include 'Header.php';
        // put your code here
        echo '<h1>List of existing Categories</h1>';                                // edit this line
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
        
        // show current data in a table
        echo '<table class="t01">';
          echo '<tr>';
              echo '<th>Category</th>';                                             // Change table header name
              
          echo '</tr>';
          while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
              echo '<td>' . $row['category'] . '</td>';                             // Change variable name
              // echo '<td>' . $row['filename'] . '</td>';
            echo '</tr>';
          }
        echo '</table>';
        echo '<hr>';
        
        // display form to add new data, (select a project)
        // set up query for category name..
        echo '<p>To add a new category enter the name '
                . 'and submit</p>';                                                 // Change the title
        echo '<table class="entry">';                                               // Open the main table
            echo '<tr>';                                                            // Create the first row
                echo '<form method="post">';                                    // set up the form, note single quotes are used to allow the use of double quotes inside the statement                                                      // Close the first cell
                echo '<td align="right">Category</td>';                             // Change the title
                echo '<td><input name = "cname" type = "text" . 
                           id = "cname"></td>';                                     // Change the reference names
            echo '</tr>';                                                           // Close the first row
            echo '<tr>';                                                           // Open the second row
            echo '<td></td>';
                echo '<td align="right">';                                                        // open the first cell        
                // create a button
                  echo '<input class="success" type="submit" value="Add ' . $page_id 
                        . '" name="SubmitButton"/>'; 
                echo '</td>';                                                       // Close the first cell
            echo '</tr>';                                                           // Close the second row
                    echo "</form>";                                                 // close the form
        echo '</table>';                                                            // Close the table
        
        // handle input data
        // post data
        
        ?>
    </body>
</html>
