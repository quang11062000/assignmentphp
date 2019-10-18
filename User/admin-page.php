<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin-page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script language="JavaScript" type="text/javascript">
        function checkDelete() {
            return confirm("Press a button!");
        }
    </script>
</head>

<body>
                <?php
                session_start();
                ob_start();
                if (empty($_SESSION["Email"])) {
                 echo "<p style=\"color:red;text-align:center;\">Vui lòng login";
                 header("location:../bai8.php");
                 exit();
                }
        try {
            require('../connect/mysqli_connect.php'); // Connect to the database.
            // echo "Connected successfully";
            $pagerows = 5; //set the number of rows per display page
            if (isset($_GET['p']) && is_numeric($_GET['p'])) // Has the total number of pagess already been calculated?
            {
                $pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
            } else {

                // First, check for the total number of records
                $query = "SELECT count(userid) FROM users";
                $result = $conn->query($query);
                $row = $result->fetch_array(MYSQLI_NUM);
                $record = htmlspecialchars($row[0], ENT_QUOTES);

                // Calculate the number of page
                if ($record>$pagerows) { //if the number of records will fill more than one page
                    // Calculate the number of pages and round the result up to the nearest integer
                    $pages = ceil($record / $pagerows);
                } else {
                    $pages = 1;
                }
            }

            // Declare which record to start with
            if (isset($_GET['s']) && is_numeric($_GET['s'])) {
                $start = htmlspecialchars($_GET['s'], ENT_QUOTES);
            } else {
                $start = 0;
            }
            $query = "SELECT firs_tname, last_name, email,DATE_FORMAT(registration_date,'%d/%l/%Y') AS registed, userid FROM users ORDER BY registration_date ASC LIMIT ?, ?";
            $stmt = $conn->stmt_init();
            $stmt->prepare($query);

            // bind $id to SQL Statement
            $stmt->bind_param("ii", $start, $pagerows);

            // Execute query
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) { // If it ran OK (records were returned), display the records.
                echo '<table class = "table table-srtiped">
                <tr>
                <th scope = "col">Edit</th>
                <th scope = "col">Delete</th>
                <th scope = "col">Last Name</th>
                <th scope = "col">First Name</th>
                <th scope = "col">Email</th>
                <th scope = "col">Registration Date</th>
                </tr>';

                // Fetch and print all the records:
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Remove special characters that might already be in table to

                    // reduce the chance of XSS exploits
                    $userid = htmlspecialchars($row['userid'], ENT_QUOTES);
                    $last_name = htmlspecialchars($row['last_name'], ENT_QUOTES);
                    $first_name = htmlspecialchars($row['firs_tname'], ENT_QUOTES);
                    $email = htmlspecialchars($row['email'], ENT_QUOTES);
                    $registration_date = htmlspecialchars($row['registed'], ENT_QUOTES);
                    echo '<tr>
                <td><a href="edit-user.php?id=' . $userid . '">Edit</a></td>
                <td><a href="delete-user.php?id=' . $userid . '" onclick="return checkDelete();">Delete</a></td>
                <td>' . $last_name . '</td>
                <td>' . $first_name . '</td>
                <td>' . $email . '</td>
                <td>' . $registration_date . '<td>
                </tr>';
                }
                echo "</table>";
                $result->free_result(); // Free up the resources.
            } else { // Unlike

                // Error message:
                echo '<p class="text-center">The current users could not be retrieved.</p>';
            }

            // Now display the total number of records/members.
            $query = "SELECT count(userid) FROM users";
            $result = $conn->query($query);
            $row = $result->fetch_array(MYSQLI_NUM);
            $members = htmlspecialchars($row[0], ENT_QUOTES);
            $conn->close();
            $echostring = "<p class='text-center'>Total users: $members</p>";
            $echostring = "<p class ='text-center'>";
            if ($pages > 1) {

                // What number is the current page?
                $current_page = ($start / $pagerows);

                // If the page is not the first page then create a Previous link
                if ($current_page != 1) {
                    $echostring .= '<a herf="admin-page.php?s=' . ($start - $pagerows) . '&p=' . $pages . '">Previous</a>';
                }

                // Create a next link
                if ($current_page != $pages) {
                    $echostring .= '<a herf="admin-page.php?s=' . ($start + $pagerows) . '&p=' . $pages . '">Next</a>';
                }
                $echostring = '</p>';
                echo $echostring;
                echo '<input type="submit" name="un_submit" id="cancel_registration" class="btn btn-primary" value="LogOut">';
            }
        } catch (Exception $e) // We finally handle any problems here
        {
            print "An Exception occurred. Message: " . $e->getMessage();
        }
        ?>
    </div>
</body>

</html>