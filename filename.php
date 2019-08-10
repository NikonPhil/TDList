<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stub for filename data</title>
        <link rel="stylesheet" type="text/css" href="TDList.css">
    </head>
    <body>
        <?php include 'Header.php'; 
        // put your code here
        echo '<h1>Filename Control Page</h1>';
        $page_id = "Filename";
        echo '<table>';
          echo '<tr>';
            echo '<td>';
                echo '<button class="btn success" type="button">Add New Filename</button>';
            echo '</td>';
            echo '<td>';
                echo '<button class="btn success" type="button" onclick="pressed">Modify Filename</button>';
            echo '</td>';
            echo '<td>';
                echo '<button class="btn success" type="button">List Tasks</button>';
            echo '</td>';
          echo '</tr>';
        echo '</table>';
        echo '<br>';
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        } 
        // try using the idtd_filename as the selection while showing the 
        // filename
        $message = ""; // initialise variable
        if(isset($_POST['SubmitButton'])){ //check if form was submitted
            echo $_POST['filename_id'];
            echo '<br>';
            switch ($_POST) {
                case ($_POST['filename_id'] == 1):
                    echo 'File ID = 1<br>';
                    break;
                case ($_POST['filename_id'] == 2):
                    echo 'File ID = 2<br>';
                    break;
                default: 
                    echo 'In the default zone<br>';
            }
            // $input = $_POST['filename_id']; //get input text from the form
            // $message = "Success! You entered: ".$input; // assign message
            // echo '<br>';
            // echo "$message<br>"; // Display selection to confirm scess
        } else { // otherwise
            echo"<p>SubmitButton not set</p><br>"; //error
        }
        
        $sql = "SELECT * FROM td_filename order by project_name";                   // get all the fields
        
        $result = mysqli_query($conn, $sql); // issue the SQL statement
        // Could put an error trap in here in case the SQL does not work
        // put the selection in a table
        echo '<table class="select">'; // Open the table
            echo '<tr>'; // Create the first row
                echo '<td>'; // Create the first cell
                    echo '<form method="post">';                                    // set up the form, note single quotes are used to allow the use of double quotes inside the statement
                    echo '<select name="filename_id">';                             // set a name for the $_post variable
                        foreach ($result as $row) {                                 // output each filename to an option
                    echo "<option value={$row['idtd_filename']}>"
                    . "{$row['filename']}</option>";
                }
                echo "</select>"; // close the selection
                echo '</td>'; // Close the first cell
                echo '<td>';
                echo '<select name="project">';
                    foreach ($result as $row) {
                    echo '<option>' . $row['project_name'] . '</option>';
                }
                echo '</select>';
                echo '</td>';
                
            echo '</tr>'; // Close the first row
            echo '<tr>'; // Open the second row
                echo '<td>'; // open the first cell
                    
                    // create a button
                    echo '<input type="submit" value="Select ' . $page_id . '" name="SubmitButton"/>'; 
                echo '</td>'; // Close the first cell
                /* echo '<td>';
                echo '<input type="submit" name="Add"/>';
                echo '</td>';*/
            echo '</tr>'; // Close the second row
                    echo "</form"; // close the form
        echo '</table>'; // Close the table
        
        ?>
    </body>
</html>
