<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stub for priority data</title>
        <link rel="stylesheet" type="text/css" href="TDList.css">
    </head>
    <body>
        <?php include 'Header.php';
        // put your code here
        echo '<h1>List of existing priorities</h1>';
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Priority";
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        } 
        // setup POST handling to add a new priority
        if(isset($_POST['pname'])) {
            // print_r($_POST); // Added to test the _POST variable
            // echo '<br>';
            // $filename = $_POST['filename'];
            $priority = $_POST['pname'];
            $sql = "INSERT INTO td_priority (idtd_priority, priority)" . 
                    "VALUES (NULL, '$priority')";
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
        $sql = "SELECT priority FROM td_priority";
                
        $result = mysqli_query($conn, $sql);
        
        // show current data in a table
        echo '<table class="t02">';
          echo '<tr>';
              echo '<th>Priority</th>';
              
          echo '</tr>';
          while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
              echo '<td>' . $row['priority'] . '</td>';
              // echo '<td>' . $row['filename'] . '</td>';
            echo '</tr>';
          }
        echo '</table>';
        echo '<hr>';
        
        // display form to add new data, (select a project)
        // set up query for project name..
        echo '<p>To add a new priority enter the name '
                . 'and submit</p>';  
        echo '<table class="entry">';                                               // Open the main table
            echo '<tr>';                                                            // Create the first row
                echo '<td>';                                                        // Create the first cell
                    echo '<form method="post">';                                    // set up the form, note single quotes are used to allow the use of double quotes inside the statement
                    //echo '<select class="sel" name="pname">';                                   // set a name for the $_post variable
                      //  foreach ($result as $row) {                                 // output each filename to an option
                        //  echo "<option value=\"{$row['project_name']}\">"
                          //  . "{$row['project_name']}</option>";
                        //}
                    // echo "</select>";                                                   // close the selection
                echo '</td>';                                                       // Close the first cell
                echo '<td align="right">Priority</td>';
                echo '<td><input name = "pname" type = "text" . 
                           id = "pname"></td>';
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
