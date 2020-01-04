<?php
include_once "./sql/MySQLDA.php";
include_once "./sql/ConnectDB.php";
include_once "./sql/tablename.php";

error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();
$query = new MySQLDA;
$requestId = $_POST["request_id"];

$assigned = $query->select($intern_organization_request_assignment, "*", "organization_request_id = " . $requestId);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/w3-colors-2019.css">
    <link rel="stylesheet" href="css/w3-colors-2018.css">
    <title>Teacher Assignment</title>
</head>
<body class="">
    <form class="" action="teacher_screen.php">
        <button class="w3-margin-bottom w3-margin-right w3-button w3-border w3-hover-blue">Back to Teacher Screen</button>
    </form>
    <form class="" action="teacher_registered_list.php" method="POST">
        <input type="hidden" name="request_id" value="<?php echo $requestId; ?>">
        <button class="w3-center w3-button w3-border w3-hover-blue">Registerd List</button>
    </form>
    <form class="" action="teacher_unassigned_list.php" method="POST">
        <input type="hidden" name="request_id" value="<?php echo $requestId; ?>">
        <button class="w3-margin-top w3-button w3-border w3-hover-blue">Unassigned List</button>
    </form>
    <div class="w3-container w3-display-topmiddle w3-margin-top w3-half">
        <ul class="w3-ul w3-card-4">
        <?php
            if ($assigned->num_rows >= 0)
            {
                while ($row = $assigned->fetch_assoc())
                {
                    $studentId = $row["student_id"];
                    $student = $query->select($intern_students, "*", "id = " . $studentId);
                    $student = $student->fetch_assoc();
                    
                    $name = $student["last_name"] . " " . $student["sur_name"] . " " . $student["first_name"];
                    echo
                    '<li class="w3-bar">
                        <img src="img/ava.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
                        <div class="w3-bar-item">
                            <span class="w3-large">' . $name . '</span><br>
                            <span>' . $student["student_code"] . '</span>
                        </div>
                    </li>';
                }
            }
        
        ?>
        </ul>
    </div>
</body>
</html>