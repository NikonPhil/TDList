


<html>
    <head>
      <title>Add New Reference in MySQL Database</title>
      <link rel="stylesheet" type="text/css" href="TDList.css">
   </head>
   
   <body>
     <div class="menu"><?php include 'Header.php'; ?></div>
     <?php
     /* To Do List
        * Need to move all input onto one row
        * Need to make selections for the 'month' data fields
        * Need to create a format for the table
    */
     echo "<br><br>";
     echo '<hr>';
         if(isset($_POST['add'])) {
            //$dbhost = '192.168.0.13';
            //$dbuser = 'pb';
            //$dbpass = 'Vmwarent1';
            $conn = mysqli_connect($DBHost, $DBUser, $DBPassword);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            if(! get_magic_quotes_gpc() ) {
               $action = addslashes ($_POST['action']);
               $filename = addslashes ($_POST['filename']);
               $category = addslashes($_POST['category']);
               $details = addslashes($_POST['details']);
               $status = addslashes($_POST['status']);
               $entry_date = $_POST['entry_date'];
               $complete_date = $_POST['complete_date'];
               $priority = addslashes($_POST['priority']);
            }else {
               $action = $_POST['action'];
               $filename = $_POST['filename'];
               $category = $_POST['category'];
               $details = $_POST['details'];
               $status = $_POST['status'];
               $entry_date = $_POST['entry_date'];
               $complete_date = $_POST['complete_date'];
               $priority = $_POST['priority'];
            }
            
            //$height = $_POST['Height'];
            //$spread = $_POST['Spread'];
            
            $sql = "INSERT INTO to_do_list " . "(action, filename,
                category, details, status, entry_date, complete_date, "
                    . "priority) VALUES('$action','$filename','$category',"
                    . "'$details', '$status', '$entry_date', '$complete_date',"
                    . "'$priority')";
               
            mysqli_select_db($conn, 'one_to_many_trial');
            $retval = mysqli_query( $conn, $sql );
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
            
            echo "Entered data successfully\n";
            
            mysqli_close($conn);
         }else {
            ?>
            
               <form method = "post" action = "<?php $_PHP_SELF ?>">
                   <table  width = "1000" border = "0" cellspacing = "1" 
                     cellpadding = "2"> 
                  
                     <tr style="background-color:#caa">
                        <td width = "200">Action</td>
                        <td><input name = "action" type = "text" 
                           id = "action"></td>
                    <!--  </tr>
                  
                     <tr> -->
                        <td width = "200" Align = center>Filename</td>
                        <td><input name = "filename" type = "text" 
                           id = "filename"></td>
                    <!-- </tr>
                  
                     <tr -->
                        <td width = "200" Align = center>Category</td>
                        <td><input name = "category" type = "text" 
                           id = "category"></td>
                     <!-- </tr>
                    <tr> -->
                        <td width = "300" Align = center>Details</td>
                        <td><input name = "details" type = "text" 
                           id = "details"></td> 
                        
                        <td width = "100">Status</td>
                        <td><input name = "status" type = "text" 
                           id = "status"></td>
                     </tr>
                     <tr>
                        <td width = "100">Entry Date</td>
                        <td><input name = "entry_date" type = "text" 
                           id = "entry_date"></td>
                     </tr>
                     <tr>
                        <td width = "100">Completion Date</td>
                        <td><input name = "complete_date" type = "text" 
                           id = "complete_date"></td>
                     </tr>
                     <tr>
                        <td width = "100">Priority</td>
                        <td><input name = "priority" type = "text" 
                           id = "priority"></td>
                     </tr>
                     <tr>
                        <td width = "100"> </td>
                        <td> </td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> </td>
                        <td>
                           <input name = "add" type = "submit" id = "add" 
                              value = "Add Reference">
                        </td>
                     </tr>
                  
                  </table>
               </form>
            
            <?php
         }
      ?>
   
   </body>
</html>
