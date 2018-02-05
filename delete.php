<?php
    require 'database.php';
    $id   = 0;

    if (!empty($_GET['id'])) {
        $id  = $_REQUEST['id'];
    }

    if (!empty($_POST)) {
        // keep track post value
        $id   = $_POST['id'];

        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM customers WHERE id = ?";
        $q   = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header('Location: index.php');
    } else {
        $pdo    = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT * FROM customers where id=?";
        $query  = $pdo->prepare($sql);
        $query->execute(array($id));
        $data   = $query->fetch(PDO::FETCH_ASSOC);
        $name   = $data['name'];
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Delete a customer</h3>
            </div>
            <form class="form-horizontal" action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $name; ?>" />
                <p class="alert alert-error"> <?php echo "Are you sure to delete '" . $name . "' data ?"; ?></p>
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger"> YES </button>
                    <a class="btn" href="index.php"> No </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>