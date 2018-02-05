<!DOCTYPE html>
<html lang="en" style="padding-left: 10px; padding-right: 10px;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="contianer"> 
        <h2></h2>
        <p>
            <a href="create.php" class="btn btn-success">Create</a>
        </p>
        <table class="table table-bordered" style="padding-left: 20px; padding-right: 20px;">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Action</th>                    
                </tr>
            </thead>
            <tbody>
                    <?php
                    include 'database.php';
                    $pdo = Database::connect();
                    $sql = 'SELECT * FROM customers ORDER BY id DESC';
                    foreach ($pdo->query($sql) as $row) {
                             echo '<tr>';
                             echo '<td>'. $row['name']   . '</td>';
                             echo '<td>'. $row['email']  . '</td>';
                             echo '<td>'. $row['mobile'] . '</td>';
                             echo '<td><a class="btn" href="read.php?id='.$row['id'].'"> Read </a>';
                             echo ' ';
                             echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'"> Update </a>';
                             echo ' ';
                             echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'"> Delete </a>';
                             echo '</td>';
                             echo '</tr>';
                    }
                    Database::disconnect();
                   ?>
            </tbody>
        </table>
    </div>
</body>
<html>