<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stub for classes data</title>
        <link rel="stylesheet" type="text/css" href="TDList.css">
    </head>
    <body>
        <?php include 'Header.php';
        // put your code here
        echo '<h1>List of existing classes</h1>';
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
        
        // show current data in a table
        echo '<table class="t01">';
          echo '<tr>';
              echo '<th>Class</th>';
              
          echo '</tr>';
          while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
              echo '<td>' . $row['class'] . '</td>';
              // echo '<td>' . $row['filename'] . '</td>';
            echo '</tr>';
          }
        echo '</table>';
        echo '<hr>';
        
        // display form to add new data, (select a project)
        // set up query for project name..
        echo '<p>To add a new class enter the name '
                . 'and submit</p>';  
        echo '<table class="entry">';                                               // Open the main table
            echo '<tr>';                                                            // Create the first row
                echo '<td>';                                                        // Create the first cell
                    echo '<form method="post">';                                    // set up the form, note single quotes are used to allow the use of double quotes inside the statement
                    //echo '<select class="sel" name="clname">';                                   // set a name for the $_post variable
                      //  foreach ($result as $row) {                                 // output each filename to an option
                        //  echo "<option value=\"{$row['project_name']}\">"
                          //  . "{$row['project_name']}</option>";
                        //}
                    // echo "</select>";                                                   // close the selection
                echo '</td>';                                                       // Close the first cell
                echo '<td align="right">Class</td>';
                echo '<td><input name = "clname" type = "text" . 
                           id = "clname"></td>';
            echo '</tr>';                                                           // Close the first row
            echo '<tr>';                                                            // Open the second row
                echo '<td colspan="3" align="right">';                                                        // open the first cell        
                // create a button
                  echo '<input class="success" type="submit" value="' . $page_id 
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